<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drainase2020 extends Model
{
    use HasFactory;
    protected $table = 'drainase2020';
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = [
        'jalan_id',
        'jalur_jalan',
        'lat_awal',
        'long_awal',
        'lat_akhir',
        'long_akhir',
        'sta',
        'panjang',
        'tinggi',
        'lebar',
        'slope',
        'catchment_area',
        'luas_penampung',
        'keliling_penampung',
        'tipe',
        'arah_air',
        'kondisi_fisik_id',
        'kondisi_sedimen_id',
        'penanganan_id',
        'file_dimensi',
        'nama_file_dimensi',
        'file_foto',
        'nama_file_foto',
        'date',
    ];

    public function jalan()
    {
        return $this->belongsTo(Jalan::class);
    }
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kondisi_fisik_id');
    }
}