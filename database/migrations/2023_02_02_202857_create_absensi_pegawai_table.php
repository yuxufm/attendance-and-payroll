<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsensiPegawaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absensi_pegawai', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->references('id')->on('user')->cascadeOnUpdate()->restrictOnDelete();
            $table->date('tgl_absensi');
            $table->time('jam_masuk');
            $table->time('jam_keluar');
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('absensi_pegawai');
    }
}
