<?php

namespace App\Exports;

use App\Models\Floor;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class ExportDataLuas implements FromQuery, WithHeadings, WithStyles, ShouldAutoSize
{
    public function query()
    {
        $user = auth()->user();

        if ($user->hasRole(['admin', 'superadmin'])) {
            return Floor::query()
                ->select(
                    'unit_itb', 
                    DB::raw("(SELECT SUM(f2.large) FROM floors f2 WHERE f2.unit_itb = floors.unit_itb AND f2.status = 'AKTIF') as total_large_all"),
                    'gedung', 
                    DB::raw('SUM(large) as total_large')
                )
                ->where('status', 'AKTIF')
                ->groupBy('unit_itb', 'gedung')
                ->orderBy('unit_itb');
        } else {
            return Floor::query()
                ->select(
                    'unit_itb', 
                    DB::raw("(SELECT SUM(f2.large) FROM floors f2 WHERE f2.unit_itb = '{$user->itb_unit}' AND f2.status = 'AKTIF') as total_large_all"),
                    'gedung', 
                    DB::raw('SUM(large) as total_large')
                )
                ->where('unit_itb', $user->itb_unit)
                ->where('status', 'AKTIF')
                ->groupBy('unit_itb', 'gedung')
                ->orderBy('unit_itb');
        }
    }
    
    public function headings(): array
    {
        return [
            'Unit ITB',
            'Total Luas',
            'Gedung',
            'Luas Gedung',
        ];
    }
    
    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true], 'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]],
            'B:B' => ['alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]],
            'D:D' => ['alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]],
        ];
    }
}
