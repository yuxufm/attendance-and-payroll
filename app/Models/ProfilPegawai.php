<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilPegawai extends Model
{
    use HasFactory;

    protected $table = 'profil_pegawai';

    protected $fillable = [
        'id_user',
        'nama',
        'jabatan'
    ];
}
