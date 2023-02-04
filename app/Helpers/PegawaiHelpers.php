<?php

namespace App\Helpers;

class PegawaiHelpers
{
    public function setSession($data = [])
    {
        session($data);
        session([
            'hak_akses' => 'pegawai',
            'isLoggedIn' => true
        ]);
    }

    public function getAllSession()
    {
        return session()->all();
    }

    public function isLoggedIn()
    {
        if (session()->get('username') && session()->get('isLoggedIn') === true && session()->get('hak_akses') === 'pegawai') {
            return true;
        }

        return false;
    }

    public function logout()
    {
        session()->flush();
    }
}
