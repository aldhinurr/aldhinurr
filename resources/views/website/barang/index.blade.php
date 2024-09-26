@extends('layout.efacility.master')

@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
<style>
    .center-align {
        text-align: center;
    }

    .tooltip-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: rgba(0, 0, 0, 0.7);
        color: #fff;
        padding: 5px;
        border-radius: 5px;
        z-index: 1; /* Untuk memastikan teks tampil di atas gambar */
        display: none; /* Sembunyikan teks awalnya */
    }
</style>

<div class="search-fields-container margin-top-30px">
    <div class="container">
        <div class="col-lg-12">
            <div class="section-heading center-align"> <!-- Menambahkan kelas center-align -->
                <h2 class="sec__title line-height-30" style="font-size: 25px;">
                Informasi Barang Tidak Digunakan
                </h2>
            </div>
            <br>
                <p>Apabila ada yang memerlukan Barang Tidak Digunakan, silahkan menghubungi:</p>
                <p>&bull; &nbsp; &nbsp;Nurman (+62 857-2258-7818)</p>
                <p>&bull; &nbsp; &nbsp;Atqiya (+62 821-1157-3950)</p>
            <br>
            <table id="barangTable" class="display">
                <thead>
                    <tr class="center-align"> <!-- Menambahkan kelas center-align -->
                        <th>No</th>
                        <th>Nomor Aset</th>
                        <th>Nama Barang</th>
                        <th>Merk/Type</th>
                        <th>Jumlah</th>
                        <th>Lokasi Penyimpanan</th>
                        <th>Kondisi Barang</th>
                        <th>Unit</th>
                        <th>Foto</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1 @endphp <!-- Inisialisasi nomor urutan -->
                    @foreach ($barangs->sortByDesc('created_at') as $barang)
                    <tr class="center-align"> <!-- Menambahkan kelas center-align -->
                        <td>{{ $no++ }}</td> <!-- Tampilkan nomor urutan -->
                        <td>{{ $barang->nomor_aset }}</td>
                        <td>{{ $barang->nama_barang }}</td>
                        <td>{{ $barang->merk }}</td>
                        <td>{{ $barang->jumlah }}</td>
                        <td>{{ $barang->lokasi }}</td>
                        <td>{{ $barang->kondisi }}</td>
                        <td>{{ $barang->unit_itb }}</td>
                        <td>
                            <button type="button" class="btn btn-primary view-photo" data-toggle="modal" data-target="#photoModal{{ $barang->id }}">
                                Lihat
                            </button>
                        </td>
                    </tr>

                    <!-- Start Modal -->
                    <div class="modal fade" id="photoModal{{ $barang->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Foto Barang: {{ $barang->nama_barang }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <img src="{{ asset($barang->foto) }}" class="img-fluid" alt="{{ $barang->nama_barang }}" 
                                    data-toggle="tooltip" title="Klik gambar untuk melihat lebih jelas.">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal -->
                    
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
<br>
@endsection

@section('scripts')
<!-- JavaScript -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
<script>
    $(document).ready(function() {
        $('#barangTable').DataTable({
            responsive: true, // Aktifkan mode responsif
            language: {
                sProcessing:   "Sedang memproses...",
                sLengthMenu:   "Tampilkan _MENU_ entri",
                sZeroRecords:  "Data tidak ditemukan",
                sInfo:         "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                sInfoEmpty:    "Menampilkan 0 sampai 0 dari 0 entri",
                sInfoFiltered: "(disaring dari _MAX_ entri keseluruhan)",
                sInfoPostFix:  "",
                sSearch:       "Cari:",
                sUrl:          "",
                oPaginate: {
                    sFirst:    "Pertama",
                    sPrevious: "Sebelumnya",
                    sNext:     "Selanjutnya",
                    sLast:     "Terakhir"
                }
            }
        });

        // Inisialisasi tooltip
        $('[data-toggle="tooltip"]').tooltip();

        // Event handler untuk menangani klik pada tooltip
        $('[data-toggle="tooltip"]').on('click', function() {
            // Dapatkan URL gambar dari atribut src
            var imgUrl = $(this).attr('src');
            // Buka URL gambar dalam tab baru
            window.open(imgUrl, '_blank');
        });
    });
</script>
@endsection
