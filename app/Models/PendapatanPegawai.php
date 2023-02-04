<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendapatanPegawai extends Model
{
    use HasFactory;

    protected $table = 'pendapatan_pegawai';

    protected $fillable = [
        'id_user',
        'gaji_pokok_bulanan'
    ];
}
