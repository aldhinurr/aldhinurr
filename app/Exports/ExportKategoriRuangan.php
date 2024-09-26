<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExportKategoriRuangan implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    protected $floorsSudahKategoriData;

    public function __construct($floorsSudahKategoriData)
    {
        $this->floorsSudahKategoriData = $floorsSudahKategoriData;
    }

    /**
     * Ambil data yang akan diekspor
     */
    public function collection()
    {
        return collect($this->floorsSudahKategoriData);
    }

    /**
     * Judul kolom di Excel
     */
    public function headings(): array
    {
        return [
            'Kategori Ruangan',
            'Jumlah',
            'Luas (m²)',
        ];
    }

    /**
     * Mapping data per baris
     */
    public function map($SudahKategoriData): array
    {
        return [
            $SudahKategoriData->kategori_ruangan,
            $SudahKategoriData->jumlah,
            number_format($SudahKategoriData->luas, 2, ',', '.'),
        ];
    }

    /**
     * Style Excel
     */
    public function styles(Worksheet $sheet)
    {
        // Style untuk header
        $sheet->getStyle('A1:C1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['argb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['argb' => '538DD5'],
            ],
        ]);

        // Style untuk kolom data
        $sheet->getStyle('A1:C'.$sheet->getHighestRow())->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ]);

        // Auto ukuran untuk semua kolom
        $sheet->getDefaultColumnDimension()->setAutoSize(true);

        // Center alignment untuk jumlah dan luas
        $sheet->getStyle('B:C')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        
        return $sheet;
    }
}
