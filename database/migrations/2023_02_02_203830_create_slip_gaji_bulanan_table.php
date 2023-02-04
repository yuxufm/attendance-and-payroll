<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlipGajiBulananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slip_gaji_bulanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->references('id')->on('user')->cascadeOnUpdate()->restrictOnDelete();
            $table->enum('bulan_gaji', [1,2,3,4,5,6,7,8,9,10,11,12]);
            $table->year('tahun_gaji');
            $table->integer('gaji_pokok_bulanan');
            $table->integer('potongan_bpjs_pekerja');
            $table->integer('potongan_ketenagakerjaan_pekerja');
            $table->integer('potongan_absen_kerja');
            $table->integer('benefit_bpjs_dari_perusahaan');
            $table->integer('benefit_ketenagakerjaan_dari_perusahaan');
            $table->integer('total_absen_jam_kerja');
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
        Schema::dropIfExists('gaji_bulanan');
    }
}
