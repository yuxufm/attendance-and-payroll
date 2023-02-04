<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table = 'user';
        Schema::disableForeignKeyConstraints();
        DB::table($table)->truncate();
        Schema::enableForeignKeyConstraints();

        DB::table($table)->updateOrInsert([
            'id' => 1,
            'username' => 'Admin',
            'password' => Hash::make('admin'),
            'hak_akses' => 'admin'
        ]);

        DB::table($table)->updateOrInsert([
            'id' => 2,
            'username' => 'pegawai1',
            'password' => Hash::make('pegawai1'),
            'hak_akses' => 'pegawai'
        ]);

        DB::table($table)->updateOrInsert([
            'id' => 3,
            'username' => 'pegawai2',
            'password' => Hash::make('pegawai2'),
            'hak_akses' => 'pegawai'
        ]);

        DB::table($table)->updateOrInsert([
            'id' => 4,
            'username' => 'pegawai3',
            'password' => Hash::make('pegawai3'),
            'hak_akses' => 'pegawai'
        ]);
    }
}
