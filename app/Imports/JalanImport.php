<?php

namespace App\Imports;

use App\Models\Jalan;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class JalanImport implements ToModel, WithStartRow
{
    /**
     * @param Collection $collection
     */
    public function model(array $row)
    {
        return new Jalan([
            // 'id' => null,
            'nama' => $row[1],
            'kelurahan_id' => $row[2],
            'kecamatan_id' => $row[3],
        ]);
    }
    public function startRow(): int
    {
        return 2;
    }
}