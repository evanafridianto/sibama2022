<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drainase2022', function (Blueprint $table) {
            $table->id();
            $table->string('kode_saluran');
            $table->string('kecamatan');
            $table->string('kelurahan');
            $table->string('nama_jalan');
            $table->string('sisi');
            $table->string('panjang');
            $table->string('tinggi');
            $table->string('lebar_atas');
            $table->string('lebar_bawah');
            $table->string('arah');
            $table->string('tipe');
            $table->string('kondisi_fisik');
            $table->string('foto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drainase2022s');
    }
};