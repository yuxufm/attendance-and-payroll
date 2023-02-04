<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function login(){
        return view('pegawai.login.index');
    }
}
