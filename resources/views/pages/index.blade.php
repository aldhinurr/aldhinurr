<x-base-layout>

<style>
    .box {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Shadow effect */
        padding: 15px; /* Padding inside the box */
        margin: 10px; /* Margin outside the box */
        border-radius: 5px; /* Rounded corners */
        background-color: #fff; /* Optional: background color */
    }
</style>
        
@if (auth()->user()->hasRole(['gedung','lantai']))
<div class="card">
    <!--begin::Card header-->
    <div class="card-header cursor-pointer">
        <!--begin::Card title-->
        <div class="card-title m-7">
            <div class="fw-bolder m-0">Informasi Data Luas Inventarisasi Ruangan Berdasarkan Kategori<br></div>
        </div>
        <!--end::Card title-->
    </div>
    <!--begin::Card header-->
    <div class="card-body pt-6" style="overflow: auto;">
        <table class="table table-row-bordered gy-15" style="width: 60%; text-align: center;">
            @if (Auth::check())
                @if (Auth::user()->location || Auth::user()->itb_unit)
                    <small>Lokasi : <b>{{ Auth::user()->location }}</b></small><br>
                    <small>Unit : <b>{{ Auth::user()->itb_unit }}</b></small>
                @else
                    <small>Data lokasi tidak ditemukan.</small>
                @endif
            @endif
            <br><br>
            <thead>
                <tr style="background-color: #f2f2f2;">
                    <th><b>Kategori Ruangan</b></th>
                    <th><b>Jumlah</b></th>
                    <th><b>Luas</b></th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalLuas = 0;
                    $totalJumlah = 0;
                @endphp
                @foreach($floorsData as $floorData)
                    <tr>
                        <td align="left">{{ $floorData->kategori_ruangan }}</td>
                        <td align="right">{{ $floorData->jumlah }}</td>
                        <td align="right">{{ number_format($floorData->luas,2,',','.') }}</td>
                    </tr>
                    @php
                        $totalLuas += $floorData->luas;
                        $totalJumlah += $floorData->jumlah;
                    @endphp
                @endforeach
                <tr style="background-color: #f2f2f2;">
                    <td><b>Total</b></td>
                    <td><b>{{ $totalJumlah }}</b></td>
                    <td><b>{{ $totalLuas }}</b></td>
                </tr>
            </tbody>
        </table>
        <br>
    </div>
</div>
<br>
@endif 

@if (auth()->user()->hasRole(['admin', 'superadmin', 'fasilitas', 'sewa']))
<div class="card">
    <!--begin::Card header-->
    <div class="card-header cursor-pointer" id="cardHeader2" style="cursor: pointer;">
        <!--begin::Card title-->
        <div class="card-title m-7">
            <div class="fw-bolder m-0">Informasi Status Sewa<br></div>
             <!--begin::Separator-->
            <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
            <!--end::Separator-->
            <i id="toggleIcon2" class="bi bi-caret-up"></i>
        </div>
        <!--end::Card title-->
    </div>

    <!--begin::Card header-->
    <div class="card-body pt-6" id="cardBody2">
        <table class="table table-row-bordered gy-15" style="width: 60%; text-align: center;">
            @if (Auth::check())
                @if (Auth::user()->location || Auth::user()->itb_unit)
                    <small>Lokasi : <b>{{ Auth::user()->location }}</b></small><br>
                    <small>Unit : <b>{{ Auth::user()->itb_unit }}</b></small>
                @else
                    <small>Data lokasi tidak ditemukan.</small>
                @endif
            @endif
            <br><br>
            <thead>
                <tr style="background-color: #f2f2f2;">
                    <th><b>Layanan Sewa</b></th>
                    <th><b>Menunggu Upload</b></th>
                    <th><b>Menunggu Verifikasi</b></th>
                    <th><b>Disetujui</b></th>
                    <th><b>Ditolak</b></th>
                    <th><b>Jumlah Sewa</b></th>
                    <th><b>Sudah Bayar</b></th>
                </tr>
            </thead>
            <tbody>
                @php
                    $unitMapping = [
                        'Direktorat Sarana dan Prasarana' => ['LAPANGAN', 'RUANG', 'RUMAH SUSUN', 'SELASAR'],
                        'Direktorat Pendidikan' => ['RKU'],
                        'Direktorat ITB Kampus Cirebon' => ['RUANG', 'KENDARAAN'],
                        'Default' => ['RUANG']
                    ];
                @endphp

                @foreach ($unitMapping[Auth::user()->itb_unit] ?? $unitMapping['Default'] as $layananType)
                    <tr>
                        <td>{{ $layananType }}</td>
                        <td>{{ $reservations->firstWhere('type', $layananType)->menunggu_upload ?? 0 }}</td>
                        <td>{{ $reservations->firstWhere('type', $layananType)->menunggu_verifikasi ?? 0 }}</td>
                        <td>{{ $reservations->firstWhere('type', $layananType)->disetujui ?? 0 }}</td>
                        <td>{{ $reservations->firstWhere('type', $layananType)->ditolak ?? 0 }}</td>
                        <td>{{ $reservations->firstWhere('type', $layananType)->total_reservations ?? 0 }}</td>
                        <td>{{ $reservations->firstWhere('type', $layananType)->verif_receipt ?? 0 }}</td>
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
</div>
<br>
@endif 
<!-- Your existing HTML -->
<!--begin::Card-->
<div class="card">
    <!--begin::Card header-->
    <div class="card-header cursor-pointer" id="cardHeader" style="cursor: pointer;">
        <div class="card-title m-7">
            <div class="fw-bolder m-0">Informasi Jumlah Penggunaan Ruang<br></div>
            <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
            <i id="toggleIcon" class="bi bi-caret-down"></i>
        </div>
        <div class="d-flex my-4">
            <a href="{{ route('chart.export') }}" class="btn btn-success btn-sm align-self-center">
                <i class="bi bi-filetype-xls"></i> {{ __('Unduh Data Excel') }}</a> &nbsp;&nbsp;
        </div>
    </div>
    <!--end::Card title-->
    <!--begin::Card body-->
    <div class="card-body pt-6" id="cardBody" style="display: none;">
        <div style="margin: auto;">
            <div class="box">
            <h6> Pilih Bulan: </h6>
                <select id="monthDropdown" class="form-control" style="width: 20%;">
                    <option value="13">Semua Bulan</option>
                    <option value="01">Januari</option>
                    <option value="02">Februari</option>
                    <option value="03">Maret</option>
                    <option value="04">April</option>
                    <option value="05">Mei</option>
                    <option value="06">Juni</option>
                    <option value="07">Juli</option>
                    <option value="08">Agustus</option>
                    <option value="09">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>
                <canvas id="reservationChart"></canvas>
                <div style="text-align: center; margin-top: 20px;">
                    <button id="downloadChart" class="btn btn-primary btn-sm">Unduh Grafik</button>
                </div>
            </div>
        </div>
    </div>
    <!--end::Card body-->
</div>
<!--end::Card-->
<br>
<!--begin::Card-->
<div class="card">
    <!--begin::Card header-->
    <div class="card-header cursor-pointer" id="cardHeader4" style="cursor: pointer;">
        <!--begin::Card title-->
        <div class="card-title m-7">
            <div class="fw-bolder m-0">Informasi Data Unit Kerja Penggunaan Ruangan<br></div>
            <!--begin::Separator-->
            <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
            <!--end::Separator-->
            <i id="toggleIcon4" class="bi bi-caret-down"></i>
        </div>
        <div class="d-flex my-4">
            <a href="{{ route('bar.export') }}" class="btn btn-success btn-sm align-self-center">
                <i class="bi bi-filetype-xls"></i> {{ __('Unduh Data Excel') }}</a> &nbsp;&nbsp;
        </div>
        <!--end::Card title-->
    </div>
    <!--begin::Card header-->
    <!--begin::Card body-->
    <div class="card-body pt-6" id="cardBody4" style="display: none;">
        <div style="margin: auto;">
        <div class="box">
            <h6> Pilih Bulan: </h6>
            <select id="monthDropdownBar" class="form-control" style="width: 20%;">
                <option value="13">Semua Bulan</option>
                <option value="01">Januari</option>
                <option value="02">Februari</option>
                <option value="03">Maret</option>
                <option value="04">April</option>
                <option value="05">Mei</option>
                <option value="06">Juni</option>
                <option value="07">Juli</option>
                <option value="08">Agustus</option>
                <option value="09">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>
            </select>
            <br>
                <canvas id="reservationBar"></canvas>
                <div style="text-align: center; margin-top: 20px;">
                    <button id="downloadBar" class="btn btn-primary btn-sm">Unduh Grafik</button>
                </div>
            </div>
            <br>
            <table id="table-bar" class="table table-bordered mt-3">
                <thead>
                    <tr style="background-color: #f2f2f2;">
                        <th><b>No Bulan</b></th>
                        <th><b>Bulan</b></th>
                        <th><b>Unit</b></th>
                        <th><b>Nama Layanan</b></th>
                        <th><b>Jumlah</b></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tableBar as $tableBar)
                        <tr>
                            <td>{{ $tableBar->no_bulan }}</td>
                            <td>{{ $tableBar->bulan }}</td>
                            <td>{{ $tableBar->unit }}</td>
                            <td>{{ $tableBar->name }}</td>
                            <td>{{ $tableBar->jumlah }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!--end::Card body-->
</div>

<br>

@if (auth()->user()->hasRole(['admin', 'superadmin']))
<div class="card">
    <div class="card-header cursor-pointer" id="cardHeader3" style="cursor: pointer;">
        <div class="card-title m-7">
            <div class="fw-bolder m-0">Informasi Data Luas Inventarisasi Ruangan Unit Kerja<br></div>
            <!--begin::Separator-->
            <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
            <!--end::Separator-->
            <i id="toggleIcon3" class="bi bi-caret-down"></i>
        </div>
    </div>
    
    <div class="card-body pt-6" id="cardBody3" style="display: none;">
        <h6>Berdasarkan Kategori Ruangan</h6>        
        <button type="button" class="btn btn-success btn-sm" onclick="window.location.href='{{ route('ruangan.excel') }}'">Unduh Data Excel</button>
        <br><br>

        <div class="box">
            <label for="dataSelect">Pilih Kategori Grafik:</label>
            <select id="dataSelect" class="form-control" style="width: 20%;">
                <option value="jumlah">Per Jumlah</option>
                <option value="luas">Per Luas (m²)</option>
            </select>

            <canvas id="kategoriChart" width="100%" height="100%"></canvas>
            <div style="text-align: center; margin-top: 20px;">
                <button id="tombol_ruangan" class="btn btn-primary btn-sm">Unduh Grafik</button>
            </div>
        </div>

{{--
        <table class="table table-row-bordered gy-15" style="width: 60%; text-align: center;">
            <thead>
                <tr style="background-color: #f2f2f2; font-weight: bold;">
                    <th>Kategori Ruangan</th>
                    <th>Jumlah</th>
                    <th>Luas (m²)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($floorsSudahKategoriData as $SudahKategoriData)
                    <tr>
                        <td align="left"><a href="#" class="sudah-kategori-link" sudah-kategori="{{ $SudahKategoriData->kategori_ruangan }}">
                            {{ $SudahKategoriData->kategori_ruangan }}</a></td>
                        <td align="right">{{ $SudahKategoriData->jumlah }}</td>
                        <td align="right">{{ number_format($SudahKategoriData->luas,2,',','.') }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr style="background-color: #f2f2f2; font-weight: bold;">
                    <td align="left">Total</td>
                    <td align="right">{{ $floorsSudahKategoriData->sum('jumlah') }}</td>
                    <td align="right">{{ number_format($floorsSudahKategoriData->sum('luas'),2,',','.') }}</td>
                </tr>
            </tfoot>
        </table>
--}}

    <br>
    <hr style="border: 1px solid gray;">
    <br>

    <h6>Berdasarkan Unit Kerja</h6>
    <button type="button" class="btn btn-success btn-sm" onclick="window.location.href='{{ route('unit.excel') }}'">Unduh Data Excel</button>
    <br><br>

    <div class="box">
        <label for="dataSelect2">Pilih Kategori Grafik:</label>
        <select id="dataSelect2" class="form-control" style="width: 20%;">
            <option value="sudah_kategori">Sudah Kategori (m²)</option>
            <option value="belum_kategori">Belum Kategori (m²)</option>
        </select>
        <canvas id="kategoriChart2" width="100%" height="100%"></canvas>
        <div style="text-align: center; margin-top: 20px;">
            <button id="tombol_unit" class="btn btn-primary btn-sm">Unduh Grafik</button>
        </div>
    </div>

{{--
    <table class="table table-row-bordered gy-15" style="width: 60%; text-align: center;">
        <thead>
            <tr style="background-color: #f2f2f2; font-weight: bold;">
                <th align="left">Unit ITB</th>
                <th>Sudah Kategori (m²)</th>
                <th>Belum Kategori (m²)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($floors as $floor)
                <tr>
                    <td align="left"><a href="#" class="unit-itb-link" data-unit="{{ $floor->unit_itb }}">{{ $floor->unit_itb }}</a></td>
                    <td align="right">{{ number_format($floor->sudah_kategori,2,',','.') }}</td>
                    <td align="right">{{ number_format($floor->belum_kategori,2,',','.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr style="background-color: #f2f2f2; font-weight: bold;">
                <td align="left">Total</td>
                <td align="right">
                    {{ number_format($floors->sum('sudah_kategori'),2,',','.') }}
                </td>
                <td align="right">
                    {{ number_format($floors->sum('belum_kategori'),2,',','.') }}
                </td>
            </tr>
        </tfoot>
    </table>
--}}

        <br>
    </div>
</div>

@endif

<!-- Modal and script Berdasarkan Kategori Ruangan -->
<div class="modal fade" id="sudahKategoriModal" tabindex="-1" aria-labelledby="unitModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sudahKategori"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-row-bordered gy-15" style="text-align: center;">
                        <thead>
                            <p style="font-weight: bold; text-align: center;">Detail Data Jumlah dan Luas Ruangan</p>                            
                            <tr style="background-color: #f2f2f2; font-weight: bold;">
                                <th>Unit Kerja</th>
                                <th>Jumlah</th>
                                <th>Luas (m²)</th>
                            </tr>
                        </thead>
                        <tbody id="floorSudahKategoriData"></tbody>
                        <tfoot>
                            <tr style="background-color: #f2f2f2; font-weight: bold;">
                                <td>Total</td>
                                <td id="totalJumlah"></td>
                                <td id="totalLuas"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->

<!-- Modal and script Berdasarkan Kategori Unit -->
<div class="modal fade" id="unitModal" tabindex="-1" aria-labelledby="unitModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="unitDetail"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-row-bordered gy-15" style="text-align: center;">
                        <thead>
                            <p style="font-weight: bold; text-align: center;">Detail Data Luas Inventarisasi Ruangan</p>                            
                            <tr style="background-color: #f2f2f2; font-weight: bold;">
                                <th>Kategori Ruangan</th>
                                <th>Jumlah</th>
                                <th>Luas (m²)</th>
                            </tr>
                        </thead>
                        <tbody id="floorData"></tbody>
                        <tfoot>
                            <tr style="background-color: #f2f2f2; font-weight: bold;">
                                <td>Total</td>
                                <td align="right" id="totalJumlah"></td>
                                <td align="right" id="totalLuas"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->

<!-- Start Javascript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
// ---------- START KONFIGURASI MODAL KATEGORI RUANG  -----------------------------
    document.addEventListener('DOMContentLoaded', function () {
        var kategori_ruang = @json($floorsSudahKategoriData->pluck('kategori_ruangan'));
        var jumlah = @json($floorsSudahKategoriData->pluck('jumlah'));
        var luas = @json($floorsSudahKategoriData->pluck('luas'));

        // Pastikan unitITB sudah terdefinisi
        var unitITB = @json($floorsSudahKategoriData->pluck('unit_itb')); // Sesuaikan dengan data unit ITB

        // Filter out "Belum Kategori" from the dataset
        var filteredData = kategori_ruang.map((kategori, index) => {
            return {
                kategori_ruangan: kategori,
                jumlah: jumlah[index],
                luas: luas[index]
            };
        }).filter(item => item.kategori_ruangan !== "Belum Kategori");

        // Separate the filtered data back into individual arrays
        var filteredKategori = filteredData.map(item => item.kategori_ruangan);
        var filteredJumlah = filteredData.map(item => item.jumlah);
        var filteredLuas = filteredData.map(item => item.luas);

        // Inisialisasi chart
        var ctx = document.getElementById('kategoriChart').getContext('2d');
        var kategori_chart = new Chart(ctx, {
            type: 'bar', // Tipe grafik bar
            data: {
                labels: filteredKategori, // Label pada sumbu Y (horizontal)
                datasets: [{
                    label: 'Per Jumlah', // Label default pada grafik
                    data: filteredJumlah, // Data default pada sumbu X (vertical)
                    backgroundColor: 'rgba(75, 134, 192, 0.2)',
                    borderColor: 'rgba(75, 134, 192, 1)',
                    borderWidth: 1 // Lebar border batang
                }]
            },
            options: {
                indexAxis: 'y', // Membalikkan sumbu menjadi grafik horizontal
                onClick: function (evt, activeElements) { // Menambahkan event handler untuk klik
                    if (activeElements.length > 0) {
                        var elementIndex = activeElements[0].index; // Mendapatkan indeks bar yang diklik
                        var selectedUnit = filteredKategori[elementIndex]; // Mendapatkan unit ITB berdasarkan indeks
                        showKategoriModal(selectedUnit); // Memanggil fungsi untuk menampilkan modal
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true, // Mulai grafik dari nol
                        ticks: {
                            callback: function(value, index, values) {
                                return value.toLocaleString('id-ID'); // Format angka menggunakan koma
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + context.raw.toLocaleString('id-ID') + ' m²';
                            }
                        }
                    }
                }
            }
        });

        // Event listener untuk dropdown
        document.getElementById('dataSelect').addEventListener('change', function () {
            var selected_value = this.value; // Mendapatkan nilai yang dipilih

            // Update label dan data pada chart sesuai dengan pilihan dropdown
            if (selected_value === 'jumlah') {
                kategori_chart.data.datasets[0].label = 'Per Jumlah';
                kategori_chart.data.datasets[0].data = filteredJumlah;
            } else if (selected_value === 'luas') {
                kategori_chart.data.datasets[0].label = 'Per Luas (m²)';
                kategori_chart.data.datasets[0].data = filteredLuas;
            }

            // Update chart
            kategori_chart.update();
        });

        // Fungsi untuk menampilkan modal berdasarkan unit ITB yang diklik pada chart
        function showKategoriModal(kategori_ruang) {
            document.getElementById("sudahKategori").innerText = kategori_ruang;

            // Menggunakan AJAX untuk memuat data dari rute /floor-data/{unit}
            fetch(`admin/sudah-kategori/${kategori_ruang}`)
                .then(response => response.json())
                .then(data => {
                    // Membuat tampilan data untuk dimasukkan ke dalam modal-body
                    let tableRows = "";
                    let totalJumlah = 0;
                    let totalLuas = 0;
                    data.forEach(sudahKategori_detail => {
                        tableRows += `<tr>
                            <td align="left">${sudahKategori_detail.unit_itb}</td>
                            <td align="right">${sudahKategori_detail.jumlah}</td>
                            <td align="right">${sudahKategori_detail.luas.toFixed(2).replace(/\.?0+$/, '')}</td>
                        </tr>`;
                        totalJumlah += sudahKategori_detail.jumlah;
                        totalLuas += sudahKategori_detail.luas;
                    });

                    // Menyisipkan konten data ke dalam tabel tbody
                    const floorDataBody = document.getElementById("floorSudahKategoriData");
                    floorDataBody.innerHTML = tableRows;

                    // Menampilkan total Jumlah dan Luas
                    document.getElementById("totalJumlah").textContent = totalJumlah;
                    document.getElementById("totalLuas").textContent = totalLuas.toFixed(2).replace(/\.?0+$/, '') + " m²";

                    // Menampilkan modal
                    const modal = new bootstrap.Modal(document.getElementById('sudahKategoriModal'));
                    modal.show();
                })
                .catch(error => console.error('Error fetching floor data:', error));
        }
        // Add event listener for download button
        document.getElementById('tombol_ruangan').addEventListener('click', function () {
            var selectedValue = document.getElementById('dataSelect').value; // Get the dropdown value
            var chartName = (selectedValue === 'jumlah') ? 'Jumlah' : 'Luas'; // Set the name based on the selection

            // Create the download link
            var link = document.createElement('a');
            link.href = kategori_chart.toBase64Image(); // Convert chart to base64 image format
            link.download = `Grafik_Kategori_${chartName}.png`; // Set the file name dynamically

            // Trigger download
            link.click();
        });
    });

// ---------- START KONFIGURASI MODAL KATEGORI UNIT  -----------------------------
    document.addEventListener('DOMContentLoaded', function () {
        // Data dari server
        var unitITB = @json($floors->pluck('unit_itb'));
        var sudahKategori = @json($floors->pluck('sudah_kategori'));
        var belumKategori = @json($floors->pluck('belum_kategori'));

        // Inisialisasi chart
        var ctx = document.getElementById('kategoriChart2').getContext('2d');
        var kategoriChart = new Chart(ctx, {
            type: 'bar', // Tipe grafik bar
            data: {
                labels: unitITB, // Label pada sumbu Y (horizontal)
                datasets: [{
                    label: 'Sudah Kategori (m²)', // Label pada grafik
                    data: sudahKategori, // Data pada sumbu X (vertical)
                    backgroundColor: 'rgba(75, 134, 192, 0.2)',
                    borderColor: 'rgba(75, 134, 192, 1)',
                    borderWidth: 1 // Lebar border batang
                }]
            },
            options: {
                indexAxis: 'y', // Membalikkan sumbu menjadi grafik horizontal
                onClick: function (evt, activeElements) { // Menambahkan event handler untuk klik
                    if (activeElements.length > 0) {
                        var elementIndex = activeElements[0].index; // Mendapatkan indeks bar yang diklik
                        var selectedUnit = unitITB[elementIndex]; // Mendapatkan unit ITB berdasarkan indeks
                        showUnitModal(selectedUnit); // Memanggil fungsi untuk menampilkan modal
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true, // Mulai grafik dari nol
                        ticks: {
                            callback: function(value, index, values) {
                                return value.toLocaleString('id-ID'); // Format angka menggunakan koma
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + context.raw.toLocaleString('id-ID') + ' m²';
                            }
                        }
                    }
                }
            }
        });

        // Event listener untuk dropdown
        document.getElementById('dataSelect2').addEventListener('change', function () {
            var selectedValue = this.value; // Mendapatkan nilai yang dipilih

            // Update label dan data pada chart sesuai dengan pilihan dropdown
            if (selectedValue === 'sudah_kategori') {
                kategoriChart.data.datasets[0].label = 'Sudah Kategori (m²)';
                kategoriChart.data.datasets[0].data = sudahKategori;
            } else if (selectedValue === 'belum_kategori') {
                kategoriChart.data.datasets[0].label = 'Belum Kategori (m²)';
                kategoriChart.data.datasets[0].data = belumKategori;
            }

            // Update chart
            kategoriChart.update();
        });

        // Fungsi untuk menampilkan modal berdasarkan unit ITB yang diklik pada chart
        function showUnitModal(unit) {
            document.getElementById("unitDetail").innerText = unit;

            // Menggunakan AJAX untuk memuat data dari rute /floor-data/{unit}
            fetch(`admin/floor-data/${unit}`)
                .then(response => response.json())
                .then(data => {
                    // Membuat tampilan data untuk dimasukkan ke dalam modal-body
                    let tableRows = "";
                    let totalJumlah = 0;
                    let totalLuas = 0;
                    data.forEach(floor_detail => {
                        tableRows += `<tr>
                            <td align="left">${floor_detail.kategori_ruangan}</td>
                            <td align="right">${floor_detail.jumlah}</td>
                            <td align="right">${floor_detail.luas.toFixed(2).replace(/\.?0+$/, '')}</td>
                        </tr>`;
                        totalJumlah += floor_detail.jumlah;
                        totalLuas += floor_detail.luas;
                    });

                    // Menyisipkan konten data ke dalam tabel tbody
                    const floorDataBody = document.getElementById("floorData");
                    floorDataBody.innerHTML = tableRows;

                    // Menampilkan total Jumlah dan Luas
                    document.getElementById("totalJumlah").textContent = totalJumlah;
                    document.getElementById("totalLuas").textContent = totalLuas.toFixed(2).replace(/\.?0+$/, '') + "";

                    // Menampilkan modal
                    const modal = new bootstrap.Modal(document.getElementById('unitModal'));
                    modal.show();
                })
                .catch(error => console.error('Error fetching floor data:', error));
        }
        // Add event listener for download button
        document.getElementById('tombol_unit').addEventListener('click', function () {
            var selectedValue = document.getElementById('dataSelect').value; // Get the dropdown value
            var chartName = (selectedValue === 'sudah_kategori') ? 'Sudah_Kategori' : 'Belum_Kategori'; // Set the name based on the selection

            // Create the download link
            var link = document.createElement('a');
            link.href = kategoriChart.toBase64Image(); // Convert chart to base64 image format
            link.download = `Grafik_${chartName}.png`; // Set the file name dynamically

            // Trigger download
            link.click();
        });
    });

// ---------- START KONFIGURASI UP/DOWN CARD -----------------------------
    $(document).ready(function() {
        function toggleCard(cardHeaderId, cardBodyId, toggleIconId) {
            $(cardHeaderId).on('click', function() {
                $(cardBodyId).slideToggle();  // Slide toggle effect for smooth dropdown
                let toggleIcon = $(toggleIconId);
                
                // Toggle icon between caret down and caret up
                if (toggleIcon.hasClass('bi-caret-down')) {
                    toggleIcon.removeClass('bi-caret-down').addClass('bi-caret-up');
                } else {
                    toggleIcon.removeClass('bi-caret-up').addClass('bi-caret-down');
                }
            });
        }

        // Initialize toggle for both cards
        toggleCard('#cardHeader', '#cardBody', '#toggleIcon');
        toggleCard('#cardHeader2', '#cardBody2', '#toggleIcon2');
        toggleCard('#cardHeader3', '#cardBody3', '#toggleIcon3');
        toggleCard('#cardHeader4', '#cardBody4', '#toggleIcon4');
    });

// ---------- START KONFIGURASI GRAFIK JUMLAH PENGGUNAAN RUANGAN ----------------
    document.addEventListener('DOMContentLoaded', function() {
        const data = @json($chart);
        const ctx = document.getElementById('reservationChart').getContext('2d');
        const monthDropdown = document.getElementById('monthDropdown');
        const currentMonth = new Date().getMonth() + 1;

        // Fungsi untuk mendapatkan nama bulan
        const getMonthName = (month) => ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"][month - 1];

        // Fungsi untuk mengupdate data grafik
        const updateChart = (month) => {
            let filteredData;
            if (month === '13') {
                // Akumulasi jumlah berdasarkan nama yang sama
                const totalData = {};
                data.forEach(item => {
                    if (totalData[item.name]) {
                        totalData[item.name] += item.jumlah;
                    } else {
                        totalData[item.name] = item.jumlah;
                    }
                });

                filteredData = Object.keys(totalData).map(name => ({
                    name,
                    jumlah: totalData[name]
                }));
            } else {
                filteredData = data.filter(item => item.no_bulan === month);
            }

            chart.data.labels = filteredData.map(item => item.name);
            chart.data.datasets[0].data = filteredData.map(item => item.jumlah);
            chart.options.plugins.title.text = month === '13' ? 
                `Grafik Total Semua Bulan ${new Date().getFullYear()}` : 
                `Grafik Bulan ${getMonthName(month)} ${new Date().getFullYear()}`;
            chart.update();
        };

        // Inisialisasi grafik
        const initialData = data.filter(item => item.no_bulan == String(currentMonth).padStart(2, '0'));
        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: initialData.map(item => item.name),
                datasets: [{ 
                    label: 'Jumlah', 
                    data: initialData.map(item => item.jumlah), 
                    backgroundColor: 'rgba(75, 134, 192, 0.2)', 
                    borderColor: 'rgba(75, 134, 192, 1)', 
                    borderWidth: 1 
                }]
            },
            options: {
                scales: { 
                    x: { beginAtZero: true }, 
                    y: { beginAtZero: true } 
                },
                plugins: {
                    title: { 
                        display: true, 
                        text: `Grafik Bulan ${getMonthName(currentMonth)} ${new Date().getFullYear()}`, 
                        font: { size: 16 } 
                    },
                    subtitle: { 
                        display: true, 
                        text: `{{ Auth::user()->itb_unit }}`, 
                        font: { size: 14 } 
                    }
                }
            }
        });

        monthDropdown.value = String(currentMonth).padStart(2, '0');
        monthDropdown.addEventListener('change', function() { 
            updateChart(this.value); 
        });

        // Unduh grafik dengan nama file berisi bulan
        document.getElementById('downloadChart').addEventListener('click', function() {
            const selectedMonth = monthDropdown.value === '13' ? 'Semua Bulan' : getMonthName(monthDropdown.value);
            const link = document.createElement('a');
            link.href = chart.toBase64Image();
            link.download = `Jumlah_Penggunaan_Ruang_${selectedMonth}.png`;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        });
    });

// ---------- START KONFIGURASI GRAFIK DATA UNIT KERJA PENGGUNAAN RUANGAN ------------
    document.addEventListener('DOMContentLoaded', function() {
        const data = @json($bar);
        const ctx = document.getElementById('reservationBar').getContext('2d');
        const monthDropdown = document.getElementById('monthDropdownBar');
        const currentMonth = new Date().getMonth() + 1;

        // Fungsi untuk mendapatkan nama bulan
        const getMonthName = (month) => 
            ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"][month - 1];

        // Fungsi untuk menjumlahkan 'jumlah' berdasarkan 'unit'
        const sumByUnit = (data) => {
            return data.reduce((acc, item) => {
                if (!acc[item.unit]) {
                    acc[item.unit] = 0;
                }
                acc[item.unit] += item.jumlah;
                return acc;
            }, {});
        };

        // Fungsi untuk mengupdate data grafik
        const updateChart = (month) => {
            let filteredData;
            if (month === '13') {
                // Totalkan 'jumlah' berdasarkan 'unit'
                const summedData = sumByUnit(data);
                filteredData = Object.keys(summedData).map(unit => ({
                    unit: unit,
                    jumlah: summedData[unit]
                }));
            } else {
                filteredData = data.filter(item => item.no_bulan === month);
            }

            chart.data.labels = filteredData.map(item => item.unit);
            chart.data.datasets[0].data = filteredData.map(item => item.jumlah);
            chart.options.plugins.title.text = month === '13' ? 
                `Grafik Semua Bulan ${new Date().getFullYear()}` : 
                `Grafik Bulan ${getMonthName(month)} ${new Date().getFullYear()}`;
            chart.update();
        };

        // Inisialisasi grafik
        const initialData = data.filter(item => item.no_bulan == String(currentMonth).padStart(2, '0'));
        const chart = new Chart(ctx, {
            type: 'bar', // Ubah ke 'horizontalBar' jika ingin grafik horizontal
            data: {
                labels: initialData.map(item => item.unit),
                datasets: [{
                    label: 'Jumlah',
                    data: initialData.map(item => item.jumlah),
                    backgroundColor: 'rgba(75, 134, 192, 0.2)',
                    borderColor: 'rgba(75, 134, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: 'y', // Ubah ke 'x' jika grafik vertikal
                scales: {
                    x: {
                        beginAtZero: true
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            autoSkip: false // Nonaktifkan auto skip untuk label
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: (tooltipItem) => {
                                return `${tooltipItem.label}: ${tooltipItem.raw}`;
                            }
                        }
                    },
                    title: {
                        display: true,
                        text: `Grafik Bulan ${getMonthName(currentMonth)} ${new Date().getFullYear()}`,
                        font: { size: 16 }
                    },
                    subtitle: {
                        display: true,
                        text: "{{ Auth::user()->itb_unit }}",
                        font: { size: 14 }
                    }
                }
            }
        });

        monthDropdown.value = String(currentMonth).padStart(2, '0');
        monthDropdown.addEventListener('change', function() { updateChart(this.value); });

        // Unduh grafik dengan nama file berisi bulan
        document.getElementById('downloadBar').addEventListener('click', function() {
            const selectedMonth = monthDropdown.value === '13' ? 'Semua Bulan' : getMonthName(monthDropdown.value);
            const link = document.createElement('a');
            link.href = chart.toBase64Image();
            link.download = `Data_Unit_Penggunaan_Ruangan_${selectedMonth}.png`;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        });
    });

// ---------- START KONFIGURASI TABEL DATA UNIT KERJA PENGGUNAAN RUANGAN ------------
    document.addEventListener('DOMContentLoaded', function() {
        // Ambil bulan saat ini
        const currentMonth = new Date().getMonth() + 1; // Bulan dimulai dari 0
        const monthStr = String(currentMonth).padStart(2, '0'); // Format ke dua digit

        // Set dropdown ke bulan saat ini
        document.getElementById('monthDropdownBar').value = monthStr;

        // Memicu event change untuk memuat data bulan saat ini
        loadTableData(monthStr);

        // Update tabel berdasarkan bulan yang dipilih
        document.getElementById('monthDropdownBar').addEventListener('change', function() {
            const selectedMonth = this.value;
            loadTableData(selectedMonth);
        });

        // Fungsi untuk memuat data tabel
        function loadTableData(month) {
            $.ajax({
                type: 'GET',
                url: '{{ route("reservations.tableBar") }}', // Rute yang sesuai
                data: { month: month },
                success: function(data) {
                    $('#table-bar tbody').empty(); // Kosongkan tbody tabel tertentu
                    $.each(data.tableBar, function(tableBar, tableBar) {
                        $('#table-bar tbody').append(`
                            <tr>
                                <td>${tableBar.no_bulan}</td>
                                <td>${tableBar.bulan}</td>
                                <td>${tableBar.unit}</td>
                                <td>${tableBar.name}</td>
                                <td>${tableBar.jumlah}</td>
                            </tr>
                        `);
                    });
                }
            });
        }
    });
</script>
<!-- End Javascript -->

</x-base-layout>