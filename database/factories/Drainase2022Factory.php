<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Drainase2022>
 */
class Drainase2022Factory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        return [
            'kode_saluran' => $this->faker->nik(),
            'kecamatan' => $this->faker->randomElement(['SUKUN', 'KEDUNGKANDANG', 'KLOJEN', 'BLIMBING', 'LOWOKWARU']),
            'kelurahan' => $this->faker->city(),
            'nama_jalan' => $this->faker->address(),
            'sisi' => $this->faker->randomElement(['KIRI', 'KANAN']),
            'panjang' => $this->faker->randomFloat(1, 20, 30),
            'tinggi' => $this->faker->randomFloat(1, 20, 30),
            'lebar_atas' => $this->faker->randomFloat(1, 20, 30),
            'lebar_bawah' => $this->faker->randomFloat(1, 20, 30),
            'arah' => $this->faker->randomElement(['TIMUR', 'BARAT', 'SELATAN', 'UTARA']),
            'tipe' => $this->faker->randomElement(['TERTUTUP', 'TERBUKA']),
            'kondisi_fisik' => "NORMAL",
            'foto' => $this->faker->imageUrl(640, 480, 'animals', true),
        ];
    }
}