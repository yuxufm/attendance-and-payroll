<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ProfilPegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table = 'profil_pegawai';
        Schema::disableForeignKeyConstraints();
        DB::table($table)->truncate();
        Schema::enableForeignKeyConstraints();

        DB::table($table)->updateOrInsert([
            'id_user' => 1,
            'nama' => 'Admin',
            'jabatan' => 'administrator'
        ]);

        DB::table($table)->updateOrInsert([
            'id_user' => 2,
            'nama' => 'Pegawai 1',
            'jabatan' => 'fullstack developer'
        ]);

        DB::table($table)->updateOrInsert([
            'id_user' => 3,
            'nama' => 'Pegawai 2',
            'jabatan' => 'fullstack developer'
        ]);

        DB::table($table)->updateOrInsert([
            'id_user' => 4,
            'nama' => 'Pegawai 3',
            'jabatan' => 'project manager'
        ]);
    }
}
