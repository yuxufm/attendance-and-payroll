<?php

namespace App\Http\Controllers;

use App\Helpers\AdminHelpers;
use App\Models\User;
use App\Models\ProfilPegawai;
use Illuminate\Http\Request;
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

                    $profilPegawaiData = ProfilPegawai::query()
                        ->where('id_user', '=', $userData->id)
                        ->first();

                    $adminHelpers->setSession([
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
}
