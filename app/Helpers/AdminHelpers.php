<?php

namespace App\Helpers;

class AdminHelpers
{
    public function setSession($data = [])
    {
        session($data);
        session([
            'hak_akses' => 'admin',
            'isLoggedIn' => true
        ]);
    }

    public function getAllSession()
    {
        return session()->all();
    }

    public function isLoggedIn()
    {
        if (session()->get('username') && session()->get('isLoggedIn') === true && session()->get('hak_akses') === 'admin') {
            return true;
        }

        return false;
    }

    public function logout()
    {
        session()->flush();
    }
}
