<?php

namespace App\DataTables;

use App\Models\Floor;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class FloorDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $building_id = $this->building_id;
        return datatables()
            ->eloquent(
                $query->where('status', '!=', 'DIHAPUS')->where('building_id', $building_id)
            )
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
     * @param \App\Models\Floor $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Floor $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('floor-table')
            ->columns($this->getColumns())
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(3, 'asc')
            ->parameters([
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
        return [
            Column::make('id')->title('#ID')->hidden(),
            Column::make('created_at')->title('#Dibuat')->hidden(),
            Column::make('number')->title('Lantai'),
            Column::make('unit_itb')->title('Unit'),
            Column::make('room_classification')->title('Klasifikasi Ruangan'),
            Column::make('room_description')->title('Uraian Ruangan')->hidden(),
            Column::make('kategori_ruangan')->title('Uraian Ruangan'),
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
        return 'Floor_' . date('YmdHis');
    }
}
