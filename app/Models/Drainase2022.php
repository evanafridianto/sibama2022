<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Drainase2022 extends Model
{
    use HasFactory;

    protected $table = 'drainase2022';
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = [
        'kode_saluran',
        'kecamatan',
        'kelurahan',
        'nama_jalan',
        'sisi',
        'panjang',
        'tinggi',
        'lebar_atas',
        'lebar_bawah',
        'arah',
        'tipe',
        'kondisi_fisik',
        'foto',
        'file_kmz',
    ];

    protected function koddeSaluran(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => strtoupper($value),
        );
    }

    protected function kecamatan(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => strtoupper($value),
        );
    }

    protected function kelurahan(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => strtoupper($value),
        );
    }

    protected function namaJalan(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => strtoupper($value),
        );
    }
    protected function sisi(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => strtoupper($value),
        );
    }
    protected function arah(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => strtoupper($value),
        );
    }
    protected function tipe(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => strtoupper($value),
        );
    }
    protected function kondisiFisik(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => strtoupper($value),
        );
    }
}