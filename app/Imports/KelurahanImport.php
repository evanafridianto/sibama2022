<?php

namespace App\Imports;

use App\Models\Kelurahan;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class KelurahanImport implements ToModel, WithStartRow
{
    /**
     * @param Collection $collection
     */
    public function model(array $row)
    {
        return new Kelurahan([
            // 'id' => null,
            'nama' => $row[1],
            'kecamatan_id' => $row[2],
        ]);
    }
    public function startRow(): int
    {
        return 2;
    }
}