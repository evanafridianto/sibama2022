<?php

namespace App\Exports;

use App\Models\Drainase2020;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class Drainase2020Export implements FromCollection, WithHeadings, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Drainase2020::all();
    }

    public function headings(): array
    {
        return [
            'Id',
            'jalan_id',
            'jalur_jalan',
            'lat_awal',
            'long_awal',
            'lat_akhir',
            'long_akhir',
            'sta',
            'panjang',
            'tinggi',
            'lebar',
            'slope',
            'catchment_area',
            'luas_penampung',
            'keliling_penampung',
            'tipe',
            'arah_air',
            'kondisi_fisik_id',
            'kondisi_sedimen_id',
            'penanganan_id',
            'file_dimensi',
            'nama_file_dimensi',
            'file_foto',
            'nama_file_foto',
            'date',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }
}