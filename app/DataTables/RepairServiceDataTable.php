<?php

namespace App\DataTables;

use App\Models\RepairService;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RepairServiceDataTable extends DataTable
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
            ->eloquent($query->where('status', "!=", "Draft"))
            ->editColumn('created_at', function (RepairService $model) {
                return Carbon::createFromFormat('Y-m-d H:i:s', $model->created_at)->format('d-m-Y');
            })
            ->editColumn('created_by', function (RepairService $model) {
                return view('pages.repair.columns._pengguna-column', compact('model'));
            })
            ->editColumn('title', function (RepairService $model) {
                return view('pages.repair.columns._title-column', compact('model'));
            })
            ->editColumn('status', function (RepairService $model) {
                return view('pages.repair.columns._status-column', compact('model'));
            })
            ->editColumn('total', function (RepairService $model) {
                return number_format($model->total, 2);
            })
            ->addColumn('action', function (RepairService $model) {
                return view('pages.repair.columns._action-menu', compact('model'));
            })
            ->skipTotalRecords();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\RepairService $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(RepairService $model)
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
            ->setTableId('repairservice-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1, 'desc')
            ->parameters([
                'drawCallback' => 'function() { KTMenu.createInstances(); }',
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
            Column::make('created_at')->title('Tanggal'),
            Column::make('created_by')->title('Pengguna'),
            Column::make('title')->title('Judul'),
            Column::make('total')->title('Total'),
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
        return 'RepairService_' . date('YmdHis');
    }
}
