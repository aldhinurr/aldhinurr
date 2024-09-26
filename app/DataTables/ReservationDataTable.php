<?php

namespace App\DataTables;

use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
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
    protected $totalCondition = '=';
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
            ->editColumn('layanans.name', function (Reservation $model) {
                return $model->layanan->name;
            })
            ->editColumn('layanans.type', function (Reservation $model) {
                return $model->layanan->type;
            })
            ->editColumn('start_date', function (Reservation $model) {
                return Carbon::createFromFormat('Y-m-d H:i:s', $model->start_date)->format('d-m-Y H:i:s');
            })
            ->editColumn('end_date', function (Reservation $model) {
                return Carbon::createFromFormat('Y-m-d H:i:s', $model->end_date)->format('d-m-Y H:i:s');
            })
            ->editColumn('layanans.unit_pengelola', function (Reservation $model) {
                return $model->layanan->unit_pengelola;
            })
            ->editColumn('created_at', function (Reservation $model) {
                return Carbon::createFromFormat('Y-m-d H:i:s', $model->created_at)->format('d-m-Y H:i:s');
            })
            /*->editColumn('fee', function (Reservation $model) {
                return number_format($model->fee, 2);
            })
            */

            ->editColumn('fee_for', function (Reservation $model) {
                return $model->fee_for . " " . $model->layanan->price_for;
            })

            /*
            ->editColumn('extra_fee', function (Reservation $model) {
                return number_format($model->extra_fee, 2);
            })
            */

            ->editColumn('total', function (Reservation $model) {
                return number_format($model->total, 2);
            })
            // ->editColumn('diskon', function (Reservation $model) {
            //     return number_format($model->diskon, 2);
            // })
            ->editColumn('bayar', function (Reservation $model) {
                return number_format($model->bayar, 2);
            })

            ->editColumn('status', function (Reservation $model) {
                $now = new DateTime("now", new DateTimeZone('Asia/Jakarta'));
                $expired_payment = new DateTime($model->expired_payment, new DateTimeZone('Asia/Jakarta'));

                if ($model->status == "MENUNGGU UPLOAD" && $now > $expired_payment) {
                    $model->update(['status' => "WAKTU HABIS"]);
                }
                return $model->status;
            })
            ->editColumn('jml_upload', function (Reservation $model) {
                if ($model->receipt && $model->surat_permohonan) {
                    return '2';
                } elseif ($model->receipt || $model->surat_permohonan) {
                    return '1';
                } else {
                    return '-';
                }
            })         
            ->addColumn('action', function (Reservation $model) {
                return view('pages.reservation._action-menu', compact('model'));
            })
            ->skipTotalRecords();
    }

    public function setTotalCondition($condition)
    {
        $this->totalCondition = $condition;
        return $this;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Reservation $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Reservation $model)
    {
        $userUnit = Auth::user()->itb_unit;
    
        $query = $model->newQuery()
            ->join('layanans', 'reservations.layanan_id', '=', 'layanans.id')
            ->select('reservations.*', \DB::raw('reservations.total - reservations.bayar'))
            ->where('layanans.location', auth()->user()->location)
            ->where('layanans.unit_pengelola', $userUnit);
    
        // Sesuaikan kondisi berdasarkan nilai properti totalCondition
        if ($this->totalCondition === '=') {
            $query->where('reservations.total', '=', 0);
        } else {
            $query->where('reservations.total', '!=', 0);
        }
    
        return $query;
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
            ->orderBy(1, 'desc')
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
            Column::make('created_at')->title('#Dibuat')->hidden(),
            Column::make('kode_sewa')->title("Kode Sewa"),
            Column::make('layanan_id')->title('Layanan')->data('layanans.name')->name('layanans.name'),
            Column::make('layanan_id')->title('Tipe')->data('layanans.type')->name('layanans.type')->hidden(),
            Column::make('layanan_id')->title('Unit')->data('layanans.unit_pengelola')->name('layanans.unit_pengelola')->hidden(),
            Column::make('start_date')->title("Tgl. Mulai"),
            Column::make('end_date')->title("Tgl. Selesai"),
            Column::make('fee')->title("#Harga")->hidden(),
            Column::make('fee_for')->title("Per"),
            Column::make('extra_fee')->title("#Biaya")->hidden(),
            Column::make('total')->title("Total")->hidden(),
            // Column::make('diskon')->title("Diskon"),
            Column::make('bayar')->title("Bayar"),
            Column::make('created_at')->title("Dibuat"),
            Column::make('jml_upload')->title("Upload")->searchable(false),
            Column::make('verif_receipt')->title("Status Bayar")->hidden(),
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
