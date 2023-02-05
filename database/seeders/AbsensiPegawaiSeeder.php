<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AbsensiPegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table = 'absensi_pegawai';
        Schema::disableForeignKeyConstraints();
        DB::table($table)->truncate();
        Schema::enableForeignKeyConstraints();

        for ($tgl = 1; $tgl <= 25; $tgl++) {
            DB::table($table)->updateOrInsert([
                'id_user' => 2,
                'tgl_absensi' => '2023-01-' . $tgl,
                'jam_masuk' => '08:00:00',
                'jam_keluar' => '15:00:00',
            ]);
        }

        for ($tgl = 1; $tgl <= 20; $tgl++) {
            DB::table($table)->updateOrInsert([
                'id_user' => 3,
                'tgl_absensi' => '2023-01-' . $tgl,
                'jam_masuk' => '08:00:00',
                'jam_keluar' => '15:00:00',
            ]);
        }

        for ($tgl = 1; $tgl <= 20; $tgl++) {
            DB::table($table)->updateOrInsert([
                'id_user' => 4,
                'tgl_absensi' => '2023-01-' . $tgl,
                'jam_masuk' => '08:00:00',
                'jam_keluar' => '15:00:00',
            ]);
        }
    }
}
