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
        Schema::create('drainase2020', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('jalan_id');
            $table->enum('jalur_jalan', ['Kiri', 'Kanan']);
            $table->double('lat_awal');
            $table->double('long_awal');
            $table->double('lat_akhir');
            $table->double('long_akhir');
            $table->string('sta');
            $table->double('panjang');
            $table->double('tinggi');
            $table->double('lebar');
            $table->double('slope');
            $table->double('catchment_area');
            $table->double('luas_penampung');
            $table->double('keliling_penampung');
            $table->enum('tipe', ['Terbuka', 'Tertutup']);
            $table->enum('arah_air', ['Atas', 'Bawah']);
            $table->bigInteger('kondisi_fisik_id');
            $table->bigInteger('kondisi_sedimen_id');
            $table->bigInteger('penanganan_id');
            $table->string('file_dimensi');
            $table->string('nama_file_dimensi');
            $table->string('file_foto');
            $table->string('nama_file_foto');
            $table->date('date');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drainase2020s');
    }
};