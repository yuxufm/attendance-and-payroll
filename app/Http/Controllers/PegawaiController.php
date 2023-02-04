<?php

namespace App\Http\Controllers;

use App\Helpers\PegawaiHelpers;
use App\Models\AbsensiPegawai;
use App\Models\ProfilPegawai;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class PegawaiController extends Controller
{
    public function index()
    {
        return view('pegawai.beranda.index', ['nama' => session()->get('nama')]);
    }

    public function login(Request $request)
    {
        $pegawaiHelpers = new PegawaiHelpers;

        if ($request->method() === 'GET') {
            if ($pegawaiHelpers->isLoggedIn() === true) {
                return redirect('pegawai/');
            } else {
                return view('pegawai.login.index');
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
                    ->where('hak_akses', '=', 'pegawai')
                    ->first();

                // success login
                if ($userData && Hash::check($password, $userData->password)) {

                    $idUser = $userData->id;
                    $profilPegawaiData = ProfilPegawai::query()
                        ->where('id_user', '=', $idUser)
                        ->first();

                    $pegawaiHelpers->setSession([
                        'id_user' => $idUser,
                        'username' => $username,
                        'nama' => $profilPegawaiData->nama
                    ]);
                    return redirect('pegawai/');
                } else {
                    return Redirect::back()->withErrors(['Username atau password salah.']);
                }
            }
        }
    }

    public function logout()
    {
        $pegawai = new PegawaiHelpers;
        $pegawai->logout();

        return redirect('pegawai/login');
    }

    public function lihatAbsensi()
    {
        $idUser = session()->get('id_user');
        $data = AbsensiPegawai::query()->where('id_user', '=', $idUser)->get()->sortByDesc('id');

        $hariIni = Carbon::now()->format('Y-m-d');
        $dataAbsenHariIni = AbsensiPegawai::query()
            ->where('id_user', '=', $idUser)
            ->where('tgl_absensi', '=', $hariIni)->first();

        return view('pegawai.absensi.index', [
            'data' => $data,
            'tgl' => date('l, d F Y'),
            'dataAbsenHariIni' => $dataAbsenHariIni
        ]);
    }

    public function masukKerja()
    {
        $idUser = session()->get('id_user');
        $hariIni = Carbon::now()->format('Y-m-d');
        $jamMasuk = Carbon::now()->format('H:i:s');

        AbsensiPegawai::updateOrCreate(
            // find / create if not found
            ['id_user' => $idUser, 'tgl_absensi' => $hariIni],
            // update data if found
            ['jam_masuk' => $jamMasuk]
        );

        return redirect()->back()->with('message', 'Jam masuk kerja berhasil disimpan.');
    }

    public function selesaiKerja()
    {
        $idUser = session()->get('id_user');
        $hariIni = Carbon::now()->format('Y-m-d');
        $jamKeluar = Carbon::now()->format('H:i:s');

        AbsensiPegawai::updateOrCreate(
            // find / create if not found
            ['id_user' => $idUser, 'tgl_absensi' => $hariIni],
            // update data if found
            ['jam_keluar' => $jamKeluar]
        );

        return redirect()->back()->with('message', 'Jam selesai kerja berhasil disimpan.');
    }
}
