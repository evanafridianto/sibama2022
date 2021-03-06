<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jalan extends Model
{
    use HasFactory;
    protected $table = 'jalan';
    protected $fillable = [
        'nama',
        'kelurahan_id',
        'kecamatan_id',
    ];

    public function drainase2020s()
    {
        return $this->hasMany(Drainase2020::class);
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class);
    }
}