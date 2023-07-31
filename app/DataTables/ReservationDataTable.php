<?php

namespace App\DataTables;

use App\Models\Reservation;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ReservationDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $now = new DateTime("now", new DateTimeZone('Asia/Jakarta'));
        return datatables()
            ->eloquent($query)
            ->editColumn('layanan.name', function (Reservation $model) {
                return $model->layanan->name;
            })
            ->editColumn('start_date', function (Reservation $model) {
                return Carbon::createFromFormat('Y-m-d H:i:s', $model->start_date)->format('d-m-Y');
            })
            ->editColumn('end_date', function (Reservation $model) {
                return Carbon::createFromFormat('Y-m-d H:i:s', $model->end_date)->format('d-m-Y');
            })
            ->editColumn('created_at', function (Reservation $model) {
                return Carbon::createFromFormat('Y-m-d H:i:s', $model->created_at)->format('d-m-Y H:i:s');
            })
            ->editColumn('fee', function (Reservation $model) {
                return number_format($model->fee, 2);
            })
            ->editColumn('fee_for', function (Reservation $model) {
                return $model->fee_for . " " . $model->layanan->price_for;
            })
            ->editColumn('extra_fee', function (Reservation $model) {
                return number_format($model->extra_fee, 2);
            })
            ->editColumn('total', function (Reservation $model) {
                return number_format($model->total, 2);
            })
            ->editColumn('status', function (Reservation $model) use ($now) {
                if ($model->status == "MENUNGGU UPLOAD" && ($now > $model->expired_payment)) {
                    $model->update(['status' => "EXPIRED"]);
                }
                return $model->status;
            })
            ->addColumn('action', function (Reservation $model) {
                return view('pages.reservation._action-menu', compact('model'));
            })
            ->skipTotalRecords();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Reservation $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Reservation $model)
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
            ->setTableId('reservation-table')
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
            Column::make('created_at')->title('#DIbuat')->hidden(),
            Column::make('layanan_id')->title('Layanan')->data('layanan.name')->name('layanan.name'),
            Column::make('start_date')->title("Tgl. Mulai"),
            Column::make('end_date')->title("Tgl. Selesai"),
            Column::make('fee')->title("Harga"),
            Column::make('fee_for')->title("Per"),
            Column::make('extra_fee')->title("Biaya"),
            Column::make('total')->title("Total"),
            Column::make('created_at')->title("Dibuat"),
            Column::make('status')->title("Status"),
            Column::computed('action')->title("Kelola")
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Reservation_' . date('YmdHis');
    }
}
