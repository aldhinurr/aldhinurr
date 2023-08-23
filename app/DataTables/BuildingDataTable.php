<?php

namespace App\DataTables;

use App\Models\Building;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BuildingDataTable extends DataTable
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
            ->editColumn('status', function (Building $model) {
                return view('pages.building.columns._status-column', compact('model'));
            })
            ->addColumn('action', function (Building $model) {
                return view('pages.building.columns._action-menu', compact('model'));
            })
            ->skipTotalRecords();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Building $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Building $model)
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
            ->setTableId('building-table')
            ->columns($this->getColumns())
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1, 'desc')
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
            Column::make('name')->title('Nama'),
            Column::make('status')->title('Status'),
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
        return 'Building_' . date('YmdHis');
    }
}
