<?php

namespace App\Exports;

use App\Models\Genangan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class GenanganExport implements FromCollection, WithHeadings, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Genangan::all();
    }

    public function headings(): array
    {
        return [
            'Id',
            'Nama Jalan',
            'Alamat',
            'Latitude',
            'Longitude',
            'CCTV ID',
            'Host',
            'Stream ID',
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