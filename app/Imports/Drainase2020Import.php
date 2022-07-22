<?php

namespace App\Imports;

use App\Models\Drainase2020;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class Drainase2020Import implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Drainase2020([
            'jalan_id' => $row[1],
            'jalur_jalan' => $row[2],
            'lat_awal' => $row[3],
            'long_awal' => $row[4],
            'lat_akhir' => $row[5],
            'long_akhir' => $row[6],
            'sta' => $row[7],
            'panjang' => $row[8],
            'tinggi' => $row[9],
            'lebar' => $row[10],
            'slope' => $row[11],
            'catchment_area' => $row[12],
            'luas_penampung' => $row[13],
            'keliling_penampung' => $row[14],
            'tipe' => $row[15],
            'arah_air' => $row[16],
            'kondisi_fisik_id' => $row[17],
            'kondisi_sedimen_id' => $row[18],
            'penanganan_id' => $row[19],
            'file_dimensi' => $row[20],
            'nama_file_dimensi' => $row[21],
            'file_foto' => $row[22],
            'nama_file_foto' => $row[23],
            'date' => $row[24]

        ]);
    }
    public function startRow(): int
    {
        return 2;
    }
}