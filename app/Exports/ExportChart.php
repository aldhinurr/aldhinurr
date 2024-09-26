<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Facades\Auth;

class ExportChart implements FromQuery, WithHeadings, WithStyles, ShouldAutoSize, WithColumnWidths
{
    public function query()
    {
        return DB::table('reservations as r')
            ->selectRaw("
                DATE_FORMAT(r.start_date, '%m') AS no_bulan,
                DATE_FORMAT(r.start_date, '%M') AS bulan,
                l.name,
                COUNT(r.id) AS jumlah
            ")
            ->join('layanans as l', 'l.id', '=', 'r.layanan_id')
            ->where('l.type', 'RUANG')
            ->where('l.unit_pengelola', '=', Auth::user()->itb_unit)
            ->where('r.status', 'DISETUJUI')
            ->groupBy(DB::raw("DATE_FORMAT(r.start_date, '%m'), DATE_FORMAT(r.start_date, '%M'), l.name"))
            ->orderBy(DB::raw("DATE_FORMAT(r.start_date, '%m')"), 'asc')
            ->orderBy('l.name', 'asc');
    }

    public function headings(): array
    {
        return [
            'No Bulan',
            'Bulan',
            'Layanan',
            'Jumlah'
        ];
    }

    // Styling the headers and the data cells
    public function styles(Worksheet $sheet)
    {
        // Apply bold styling to the first row (headers)
        $sheet->getStyle('A1:D1')->getFont()->setBold(true);

        // Set cell alignment to center for headers
        $sheet->getStyle('A1:D1')->getAlignment()->setHorizontal('center');
        
        // Set cell alignment for data cells
        $sheet->getStyle('A:D')->getAlignment()->setHorizontal('center');
    }

    // Set fixed column widths
    public function columnWidths(): array
    {
        return [
            'A' => 10,   // No Bulan
            'B' => 15,   // Bulan
            'C' => 30,   // Layanan
            'D' => 10,   // Jumlah
        ];
    }
}
