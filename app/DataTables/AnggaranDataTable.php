<?php

namespace App\DataTables;

use App\Models\Anggaran;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AnggaranDataTable extends DataTable
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
            ->eloquent($query)
            ->editColumn('jumlah_anggaran', function (Anggaran $model) {
                return number_format($model->jumlah_anggaran, 2);
            })
            ->editColumn('realisasi', function (Anggaran $model) {
                return number_format($model->realisasi, 2);
            })
            ->editColumn('saldo', function (Anggaran $model) {
                return number_format($model->saldo, 2);
            })
            ->addColumn('action', 'pages.anggaran._action-menu')
            ->skipTotalRecords();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Anggaran $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Anggaran $model)
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
            ->setTableId('anggaran-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id')->title('ID'),
            Column::make('user_id')->title('User ID'),
            Column::make('bulan'),
            Column::make('jumlah_anggaran'),
            Column::make('realisasi'),
            Column::make('saldo'),
            Column::computed('action')
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
        return 'Anggaran_' . date('YmdHis');
    }
}
