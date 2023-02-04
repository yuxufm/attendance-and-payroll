<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilPegawaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profil_pegawai', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->references('id')->on('user')->cascadeOnUpdate()->restrictOnDelete();
            $table->string('nama');
            $table->enum('jabatan', ['administrator', 'fullstack developer', 'project manager']);
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
        Schema::dropIfExists('profil_pegawai');
    }
}
