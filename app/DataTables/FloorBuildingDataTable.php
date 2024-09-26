<?php

namespace App\DataTables;

use App\Models\Floor;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Auth;

class FloorBuildingDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query->where('status', '!=', 'DIHAPUS'))
            ->addColumn('action', function (Floor $model) {
                return view('pages.floor.columns._action-menu-floorbuilding', compact('model'));
            })

             // edited 280324
            ->editColumn('room_classification', function (Floor $model) {
                return $model->floor_classification . " " . $model->room_classification;
            })
            ->editColumn('large', function (Floor $model) {
                return view('pages.floor.columns._large-column', compact('model'));
            })
            ->editColumn('capacity', function (Floor $model) {
                return $model->capacity . " Orang";
            })
            ->addColumn('action', function (Floor $model) {
                return view('pages.floor.columns._action-menu', compact('model'));
            })
            ->skipTotalRecords();            
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\FloorBuilding $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    // public function query(Building $model)
    // edited 280324
    public function query(Floor $model)
    {
        // Jika pengguna adalah admin atau superadmin, kembalikan semua data
        if (auth()->user()->hasRole(['admin', 'superadmin'])) {
            return $model->newQuery();
        }
    
        // Jika bukan admin atau superadmin, filter berdasarkan unit_itb pengguna
        $userUnit = Auth::user()->itb_unit;
        return $model->newQuery()->where('unit_itb', $userUnit);
    }
    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('floorbuilding-table')
            ->columns($this->getColumns())
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1, 'desc')
            ->parameters([
                // 'drawCallback' => 'function() {KTMenu.createInstances(); }',
                // edited 280324
                'drawCallback' => 'function() { handleDeleteRows(); KTMenu.createInstances(); }',
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        // return [
        //     Column::make('id')->title('#ID')->hidden(),
        //     Column::make('created_at')->title('#Dibuat')->hidden(),
        //     Column::make('name')->title('Gedung'),
        //     Column::computed('action')->title('Kelola')
        //         ->exportable(false)
        //         ->printable(false)
        //         ->width(60)
        //         ->addClass('text-center'),
        // ];
        // edited 280324
        return [
            Column::make('id')->title('#ID')->hidden(),
            Column::make('created_at')->title('#Dibuat')->hidden(),
            Column::make('unit_itb')->title('Unit'),
            Column::make('number')->title('Lantai'),
            Column::make('room_classification')->title('Kategori Ruangan')->hidden(),
            Column::make('kategori_ruangan')->title('Kategori Ruangan'),
            Column::make('gedung')->title('Gedung'),
            Column::make('room_description')->title('Uraian Ruangan'),
            Column::make('large')->title('Luas'),
            Column::make('capacity')->title('Kapasitas'),
            Column::computed('action')->title('Kelola')
            ->exportable(false)
            ->printable(false)
            ->width(60)
            ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'FloorBuilding_' . date('YmdHis');
    }
}
