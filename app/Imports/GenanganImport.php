<?php

namespace App\Imports;

use App\Models\Genangan;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class GenanganImport implements ToModel, WithStartRow
{
    /**
     * @param Collection $collection
     */
    public function model(array $row)
    {
        return new Genangan([
            // 'id' => null,
            'nama_jalan' => $row[1],
            'alamat' => $row[2],
            'latitude' => $row[3],
            'longitude' => $row[4],
            'cctv_id' => str_replace(',', '', $row[5]),
            'host' => str_replace(',', '', $row[6]),
            'stream_id' => str_replace(',', '', $row[7]),
        ]);
    }
    public function startRow(): int
    {
        return 2;
    }
}