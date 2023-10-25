<x-base-layout>

    <div class="card">
    <!--begin::Card header-->
        <div class="card-header cursor-pointer">
        <!--begin::Card title-->
            <div class="card-title m-0">
                <div class="fw-bolder m-0">Informasi Status Sewa<br>
                @if (Auth::check())
                    @if (Auth::user()->location)
                        <small>Lokasi : <b>{{ Auth::user()->location }}</b></small>
                    @else
                        <small>Data lokasi tidak ditemukan.</small>
                    @endif
                @endif
                </div>
            </div>
        <!--end::Card title-->
        </div>
    
    <!--begin::Card header-->
    <div class="card-body pt-6" style="overflow: auto;">
        <table class="table table-row-bordered gy-15" 
        style="width: 60%; text-align: center;">
            <thead>
                <tr style="background-color: #f2f2f2;">
                    <th><b>Layanan Sewa</b></th>
                    <th><b>Menunggu Upload</b></th>
                    <th><b>Menunggu Verifikasi</b></th>
                    <th><b>Disetujui</b></th>
                    <th><b>Ditolak</b></th>
                </tr>
            </thead>
            <tbody>
                @foreach (['RUANG', 'KENDARAAN', 'SELASAR', 'LAPANGAN'] as $layananType)
                    <tr>
                        <td>{{ $layananType }}</td>
                        <td>{{ $reservations->firstWhere('type', $layananType)->menunggu_upload ?? 0 }}</td>
                        <td>{{ $reservations->firstWhere('type', $layananType)->menunggu_verifikasi ?? 0 }}</td>
                        <td>{{ $reservations->firstWhere('type', $layananType)->disetujui ?? 0 }}</td>
                        <td>{{ $reservations->firstWhere('type', $layananType)->ditolak ?? 0 }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <br>
        <b> Keterangan : </b>
        <ul>
            <li>Status <b>Menunggu Verifikasi</b> kemungkinan baru satu yang diupload.</li>
            <li>Status <b>Disetujui</b> kemungkinan masih ada yang belum diupload.</li>
        </ul>
    </div>

</x-base-layout>