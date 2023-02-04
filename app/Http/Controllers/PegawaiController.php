<?php

namespace App\Http\Controllers;

use App\Helpers\PegawaiHelpers;
use App\Models\ProfilPegawai;
use App\Models\User;
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

                    $profilPegawaiData = ProfilPegawai::query()
                        ->where('id_user', '=', $userData->id)
                        ->first();

                    $pegawaiHelpers->setSession([
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
}
