<?php

namespace App\DataTables;

use App\Models\Barang;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\View;

class BarangDataTable extends DataTable
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
            ->editColumn('status', function (Barang $model) {
                return view('pages.barang.columns._status-column', compact('model'));
            })
            ->addColumn('foto', function (Barang $model) {
                return view('pages.barang.columns._image-column', compact('model'));
            })
            ->addColumn('action', function (Barang $model) {
                return view('pages.barang.columns._action-menu', compact('model'));
            })
            ->skipTotalRecords();
    }    

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Barang $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Barang $model)
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
            ->setTableId('barang-table')
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
            Column::make('nomor_aset')->title('Nomor Aset')->className('text-center'),
            Column::make('nama_barang')->title('Nama Barang')->className('text-center'),
            Column::make('merk')->title('Merk/Type')->className('text-center'),
            Column::make('jumlah')->title('Jumlah')->className('text-center'),
            Column::make('lokasi')->title('Lokasi')->className('text-center'),
            Column::make('kondisi')->title('Kondisi Barang')->className('text-center'),
            Column::make('unit_itb')->title('Unit')->className('text-center'),
            Column::computed('foto')->className('text-center'),       
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
        return 'Barang_' . date('YmdHis');
    }
}
