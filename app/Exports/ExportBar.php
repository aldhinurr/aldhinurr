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

class ExportBar implements FromQuery, WithHeadings, WithStyles, ShouldAutoSize, WithColumnWidths
{
    public function query()
    {
        return DB::table('reservations as r')
            ->selectRaw("
                DATE_FORMAT(r.start_date, '%m') AS no_bulan,
                DATE_FORMAT(r.start_date, '%M') AS bulan,
                r.unit,
                l.name,
                COUNT(r.id) AS jumlah
            ")
            ->join('layanans as l', function($join) {
                $join->on('l.id', '=', 'r.layanan_id')
                    ->where('l.type', 'RUANG')
                    ->where('l.unit_pengelola', '=', Auth::user()->itb_unit);
            })
            ->where('r.status', 'DISETUJUI')
            //->whereRaw("DATE_FORMAT(r.start_date, '%m') = '01'") // Uncomment this line if needed
            //->where('r.unit', 'Direktorat Sarana dan Prasarana') // Uncomment this line if needed
            ->groupBy(DB::raw("DATE_FORMAT(r.start_date, '%m'), DATE_FORMAT(r.start_date, '%M'), r.unit, l.name"))
            ->orderBy(DB::raw("DATE_FORMAT(r.start_date, '%m')"), 'asc')
            ->orderBy('r.unit', 'asc')
            ->orderBy('l.name', 'asc');
    }

    public function headings(): array
    {
        return [
            'No Bulan',
            'Bulan',
            'Unit', // New column for unit
            'Layanan',
            'Jumlah'
        ];
    }

    // Styling the headers and the data cells
    public function styles(Worksheet $sheet)
    {
        // Apply bold styling to the first row (headers)
        $sheet->getStyle('A1:E1')->getFont()->setBold(true);

        // Set cell alignment to center for headers
        $sheet->getStyle('A1:E1')->getAlignment()->setHorizontal('center');
        
        // Set cell alignment for data cells
        $sheet->getStyle('A:E')->getAlignment()->setHorizontal('center');
    }

    // Set fixed column widths
    public function columnWidths(): array
    {
        return [
            'A' => 10,   // No Bulan
            'B' => 15,   // Bulan
            'C' => 30,   // Unit (New column for unit)
            'D' => 30,   // Layanan
            'E' => 10,   // Jumlah
        ];
    }
}
