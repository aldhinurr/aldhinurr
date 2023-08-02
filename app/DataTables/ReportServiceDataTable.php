<?php

namespace App\DataTables;

use App\Models\ReportService;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ReportServiceDataTable extends DataTable
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
            ->editColumn('created_at', function (ReportService $model) {
                return Carbon::createFromFormat('Y-m-d H:i:s', $model->created_at)->format('d-m-Y H:i:s');
            })
            ->editColumn('created_by', function (ReportService $model) {
                return $model->user->first_name . " " . $model->user->last_name;
            })
            ->addColumn('action', function (ReportService $model) {
                return view('pages.report._action-menu', compact('model'));
            })
            ->skipTotalRecords();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ReportService $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ReportService $model)
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
            ->setTableId('reportservice-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1, 'asc')
            ->parameters([
                "drawCallback" => "function() { KTMenu.createInstances(); }"
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
            Column::make('created_at')->title("Tanggal"),
            Column::make('jenis')->title("Laporan"),
            Column::make('keterangan')->title("Keterangan"),
            Column::make('created_by')->title("Pelapor"),
            Column::make('status')->title("Status"),
            Column::computed('action')->title("Kelola")
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
        return 'ReportService_' . date('YmdHis');
    }
}
