<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genangan extends Model
{
    use HasFactory;

    protected $table = 'genangan';
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = [
        'nama_jalan',
        'alamat',
        'latitude',
        'longitude',
        'cctv_id',
        'host',
        'stream_id',
    ];
}