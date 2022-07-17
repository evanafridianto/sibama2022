<?php

namespace App\Exports;

use App\Models\Drainase2022;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class Drainase2022Export implements FromCollection, WithHeadings, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Drainase2022::all();
    }

    public function headings(): array
    {
        return [
            'Id',
            'Kode Saluran',
            'Kecamatn',
            'Kelurahan',
            'Nama Jalan',
            'Sisi',
            'Panjang',
            'Tinggi',
            'Lebar Atas',
            'Lebar Bawah',
            'Arah',
            'Tipe',
            'Kondisi Fisik',
            'Foto',
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