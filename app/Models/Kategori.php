<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $table = 'kategori';
    protected $fillable = [
        'nama',
        'induk',
    ];

    public function drainase2020s()
    {
        return $this->hasMany(Drainase2020::class, 'kondisi_fisik_id');
    }
}