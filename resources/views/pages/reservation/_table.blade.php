<!--begin::filter--->
<div class="form-group-container" style="display: inline-block;">
    <!--beign::filter type-->
    <div class="form-group" style="display: inline-block; margin-right: 10px;">
        <select id="tipe_layanan" class="form-control form-control-solid w-250px">
            <option value=""> ~ PILIH TIPE LAYANAN ~</option>
            <option value="RUANG">RUANG</option>
            <option value="KENDARAAN">KENDARAAN</option>
            <option value="SELASAR">SELASAR</option>
            <option value="LAPANGAN">LAPANGAN</option>
        </select>
    </div>
    <!--end::filter type-->
    <!--begin::filter status-->
    <div class="form-group" style="display: inline-block;">
        <select id="status_filter" class="form-control form-control-solid w-250px">
            <option value=""> ~ PILIH STATUS SEWA ~</option>
            <option value="MENUNGGU UPLOAD">MENUNGGU UPLOAD</option>
            <option value="MENUNGGU VERIFIKASI">MENUNGGU VERIFIKASI</option>
            <option value="DISETUJUI">DISETUJUI</option>
            <option value="DIBATALKAN">DIBATALKAN</option>
            <option value="DITOLAK">DITOLAK</option>
        </select>
    </div>
    <!--end::filter status-->
</div>
<!--end::filter-->

<!--begin::Table-->
{{ $dataTable->table(['class' => 'table table-row-bordered gy-5']) }}
<!--end::Table-->

{{-- Inject Scripts --}}
@section('scripts')
  {{ $dataTable->scripts() }}
  <!-- Javascript function filter -->
  <script>
    $(document).ready(function() {
        var table = window.LaravelDataTables['reservation-table'];

        // fitler status sewa
        $('#status_filter').on('change', function() {
            var status = $(this).val();
            table.column('status:name').search(status).draw();
        });

        // filter type layanan
        $('#tipe_layanan').on('change', function () {
            var tipeLayanan = $(this).val();
            table.column(4).search(tipeLayanan).draw();
        });
    });
  </script>
@endsection
