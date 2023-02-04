<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PendapatanPegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table = 'pendapatan_pegawai';
        Schema::disableForeignKeyConstraints();
        DB::table($table)->truncate();
        Schema::enableForeignKeyConstraints();

        DB::table($table)->updateOrInsert([
            'id_user' => 2,
            'gaji_pokok_bulanan' => 5000000
        ]);

        DB::table($table)->updateOrInsert([
            'id_user' => 3,
            'gaji_pokok_bulanan' => 10000000
        ]);

        DB::table($table)->updateOrInsert([
            'id_user' => 4,
            'gaji_pokok_bulanan' => 15000000
        ]);
    }
}
