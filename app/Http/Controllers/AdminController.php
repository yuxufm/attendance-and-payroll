<?php

namespace App\Http\Controllers;

use App\Helpers\AdminHelpers;
use App\Models\AbsensiPegawai;
use App\Models\PendapatanPegawai;
use App\Models\User;
use App\Models\ProfilPegawai;
use App\Models\SlipGajiBulanan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.beranda.index', ['nama' => session()->get('nama')]);
    }

    public function login(Request $request)
    {
        $adminHelpers = new AdminHelpers;

        if ($request->method() === 'GET') {
            if ($adminHelpers->isLoggedIn() === true) {
                return redirect('admin/');
            } else {
                return view('admin.login.index');
            }
        }

        if ($request->method() === 'POST') {
            $validated = $request->validate([
                'username' => 'required',
                'password' => 'required',
            ]);

            if ($validated) {
                $username = $request->username;
                $password = $request->password;

                $userData = User::query()
                    ->where('username', '=', $username)
                    ->where('hak_akses', '=', 'admin')
                    ->first();

                // success login
                if ($userData && Hash::check($password, $userData->password)) {

                    $idUser = $userData->id;
                    $profilPegawaiData = ProfilPegawai::query()
                        ->where('id_user', '=', $idUser)
                        ->first();

                    $adminHelpers->setSession([
                        'id_user' => $idUser,
                        'username' => $username,
                        'nama' => $profilPegawaiData->nama
                    ]);
                    return redirect('admin/');
                } else {
                    return Redirect::back()->withErrors(['Username atau password salah.']);
                }
            }
        }
    }

    public function logout()
    {
        $admin = new AdminHelpers;
        $admin->logout();

        return redirect('admin/login');
    }

    public function lihatAbsensi()
    {
        $data = AbsensiPegawai::query()->join('profil_pegawai', 'profil_pegawai.id_user', '=', 'absensi_pegawai.id_user')->get()->sortByDesc('id');

        return view('admin.absensi.index', [
            'data' => $data
        ]);
    }

    public function lihatPayslip()
    {
        $data = SlipGajiBulanan::query()->join('profil_pegawai', 'profil_pegawai.id_user', '=', 'slip_gaji_bulanan.id_user')->get()->sortByDesc('id');

        foreach ($data as $item) {
            $item['total_penghasilan_bruto'] = $item->gaji_pokok_bulanan + $item->benefit_bpjs_dari_perusahaan + $item->benefit_ketenagakerjaan_dari_perusahaan;
            $item['total_potongan'] = $item->potongan_bpjs_pekerja + $item->potongan_ketenagakerjaan_pekerja + $item->potongan_absen_jam_kerja;
            $item['total_penerimaan'] = $item->gaji_pokok_bulanan - $item['total_potongan'];
        }

        return view('admin.payslip.index', [
            'data' => $data
        ]);
    }

    // menghitung total jam masuk pegawai
    public function hitungTotalJamKerjaPegawai($id_user, $tglAwal, $tglAkhir)
    {
        $absensiPerPegawai = AbsensiPegawai::query()
            ->where('id_user', '=', $id_user)
            ->where('tgl_absensi', '>=', $tglAwal)
            ->where('tgl_absensi', '<=', $tglAkhir)
            ->get();

        $totalJamKerja = 0;

        foreach ($absensiPerPegawai as $absensi) {
            $jamMasuk = $absensi['jam_masuk'] ? Carbon::parse($absensi['jam_masuk']) : null;
            $jamKeluar = $absensi['jam_keluar'] ? Carbon::parse($absensi['jam_keluar']) : null;
            $totalDurasiDalamMenit = $jamMasuk === null || $jamKeluar === null ? 0 : $jamMasuk->diffInRealMinutes($jamKeluar);
            $totalJamKerja += $totalDurasiDalamMenit / 60;
        }

        return (float) number_format((float)$totalJamKerja, 2, '.', '');
    }

    public function buatPayslip(Request $request)
    {
        if ($request->method() === 'POST') {
            $tahun = $request->tahun;
            $bulan = $request->bulan;

            $tglAwalPerBulan = Carbon::parse($tahun . '-' . $bulan . '-' . '01')->format('Y-m-d');
            $tglAkhirPerBulan = Carbon::parse($tahun . '-' . $bulan . '-' . '01')->endOfMonth()->format('Y-m-d');

            // get semua pegawai
            $semuaPegawai = User::query()->where('hak_akses', '=', 'pegawai')->get();

            DB::beginTransaction();
            try {
                // lihat absensi per pegawai
                foreach ($semuaPegawai as $pegawai) {

                    // menghitung data-data yang akan di inputkan ke tabel
                    $idUser = $pegawai->id;

                    $totalJamKerja = $this->hitungTotalJamKerjaPegawai($idUser, $tglAwalPerBulan, $tglAkhirPerBulan);
                    $gajiPokokBulanan = PendapatanPegawai::query()->where('id_user', '=', $idUser)->first()->gaji_pokok_bulanan;

                    $totalJamKerjaPerBulan = 160;
                    $totalAbsenJamKerja = $totalJamKerja >= $totalJamKerjaPerBulan ? 0 : $totalJamKerjaPerBulan - $totalJamKerja;
                    $potonganAbsenJamKerja = $totalAbsenJamKerja * ($gajiPokokBulanan / $totalJamKerjaPerBulan);


                    $potonganBPJSPekerja = (1 / 100) * $gajiPokokBulanan; // potongan 1%
                    $potonganKetenagaKerjaanPekerja = (2 / 100) * $gajiPokokBulanan; // potongan 2%

                    $benefitBPJSDariPerusahaan = (4 / 100) * $gajiPokokBulanan; // benefit 4%
                    $benefitKetenagakerjaanDariPerusahaan = (4.24 / 100) * $gajiPokokBulanan; // benefit 4.24%

                    $dataSlipGajiBulanan = [
                        'gaji_pokok_bulanan' => $gajiPokokBulanan,
                        'potongan_bpjs_pekerja' => $potonganBPJSPekerja,
                        'potongan_ketenagakerjaan_pekerja' => $potonganKetenagaKerjaanPekerja,
                        'potongan_absen_jam_kerja' => $potonganAbsenJamKerja,
                        'benefit_bpjs_dari_perusahaan' => $benefitBPJSDariPerusahaan,
                        'benefit_ketenagakerjaan_dari_perusahaan' => $benefitKetenagakerjaanDariPerusahaan,
                        'total_jam_kerja' => $totalJamKerja,
                        'total_absen_jam_kerja' => $totalAbsenJamKerja,
                    ];

                    // simpan payslip per pegawai per bulan
                    SlipGajiBulanan::updateOrCreate(
                        // find / create if not found
                        [
                            'id_user' => $idUser,
                            'bulan_gaji' => $bulan,
                            'tahun_gaji' => $tahun
                        ],
                        // update data if found
                        $dataSlipGajiBulanan
                    );
                }
                DB::commit();
                return redirect()->back()->with('message', 'Payslip semua pegawai berhasil dibuat.');
            } catch (\Throwable $th) {
                DB::rollBack();
                throw $th;
            }
        } else if ($request->method() === 'GET') {
            return view('admin.payslip.tambah');
        }
    }
}
