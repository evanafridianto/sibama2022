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
        Schema::create('genangan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_jalan');
            $table->text('alamat');
            $table->double('latitude');
            $table->double('longitude');
            $table->string('cctv_id');
            $table->string('host');
            $table->string('stream_id');
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
        Schema::dropIfExists('genangans');
    }
};