<?php

namespace App\Imports;

use App\Models\Drainase2022;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class Drainase2022Import implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Drainase2022([
            // 'id' => null,
            'kode_saluran' => $row[1],
            'kecamatan' => $row[2],
            'kelurahan' => $row[3],
            'nama_jalan' => $row[4],
            'sisi' => $row[5],
            'panjang' => $row[6],
            'tinggi' => $row[7],
            'lebar_atas' => $row[8],
            'lebar_bawah' => $row[9],
            'arah' => $row[10],
            'tipe' => $row[11],
            'kondisi_fisik' => $row[12],
            'foto' => $row[13],
            'file_kmz' =>  strtolower(str_replace(' ', '', $row[3])) . '/' . trim($row[1] . '.kmz'),
        ]);
    }
    public function startRow(): int
    {
        return 2;
    }
}