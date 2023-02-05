<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlipGajiBulanan extends Model
{
    use HasFactory;

    protected $table = 'slip_gaji_bulanan';

    protected $fillable = [
        'id_user',
        'bulan_gaji',
        'tahun_gaji',
        'gaji_pokok_bulanan',
        'potongan_bpjs_pekerja',
        'potongan_ketenagakerjaan_pekerja',
        'potongan_absen_jam_kerja',
        'benefit_bpjs_dari_perusahaan',
        'benefit_ketenagakerjaan_dari_perusahaan',
        'total_jam_kerja',
        'total_absen_jam_kerja'
    ];
}
