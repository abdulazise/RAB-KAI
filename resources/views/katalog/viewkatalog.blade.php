<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Katalog Barang</title>
    <link href="assets/img/kai.png" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    @include('layout.partial.link')
    <style>
        .table thead th, .table tbody td {
            white-space: nowrap;
            border-right: 1px solid #dee2e6; /* Menambahkan garis pembatas samping */
            border-top: 1px solid #dee2e6;
        }
        .table thead th {
            width: auto;
        }
        .col-no { width: 50px; }
        .col-id { width: 100px; }
        .col-nama { width: 200px; }
        .col-detail { 
    width: 300px; 
    max-width: 300px;
}
td.col-detail {
    white-space: normal;
    word-wrap: break-word;
    vertical-align: top;
}
        .col-klasifikasi { width: 100px; }
        .col-brand { width: 150px; }
        .col-type { width: 150px; }
        .col-harga { width: 400px; }
        .col-tanggal { width: 150px; }
        .col-vendor { width: 150px; }
        .col-jumlah { width: 100px; }
        .col-satuan { width: 100px; }
        .col-keterangan { width: 300px; }
        .col-gambar { width: 200px; }
        .col-link { width: 200px; }
        .col-aksi { width: 150px; }
    </style>
</head>

<body class="bg-light">
    <style>
        body {
            padding-top: 60px; /* Sesuaikan berdasarkan tinggi header Anda */
        }
        
        header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000; /* Pastikan header tetap di atas */
        }

        .container {
            margin-top: 50px; /* Sesuaikan berdasarkan tinggi header Anda */
        }
    </style>
    @include('layout.partial.header')
    <main class="container">
        <h1>View Katalog</h1>
        @if (Session::has('success'))
            <div class="pt-3">
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            </div>
        @endif

        <!-- START DATA -->
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <div class="brand">
                <img src="assets/img/kai.png" width="60px" height="50px" alt="logo" style="float: right;">
            </div>

            <div class="pb-3">
                <a href="{{ url('tambahbarang') }}" class="btn btn-secondary" style="background-color: orange; border-color: orange; color: white;">Kembali</a>
            </div>

            <!-- TOMBOL UNDUH EXCEL -->
<div class="pb-3">
    <form action="{{ route('export.excel') }}" method="get" class="d-inline">
        <select name="tahun" class="form-select form-select-sm d-inline-block w-auto">
            <option value="">Pilih Tahun</option>
            @foreach($tahunOptions as $tahun)
                <option value="{{ $tahun }}">{{ $tahun }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-sm btn-success">Unduh Excel</button>
    </form>
</div>
          
                <!-- FORM PENCARIAN DAN FILTER -->
    <div class="pb-3">
        <form action="{{ url('viewkatalog') }}" method="get">
            <div class="row g-2 align-items-center">
                <div class="col-auto">
                    <input class="form-control form-control-sm" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Cari...">
                </div>
                <div class="col-auto">
                    <select class="form-select form-select-sm" name="tahun">
                        <option value="">Tahun</option>
                        @foreach($tahunOptions as $tahun)
                            <option value="{{ $tahun }}" {{ request('tahun') == $tahun ? 'selected' : '' }}>{{ $tahun }}</option>
                        @endforeach
                    </select>
                </div>
            <div class="col-auto">
                <select class="form-select form-select-sm" name="klasifikasi">
                    <option value="">Klasifikasi</option>
                    @foreach($klasifikasiOptions as $klasifikasi)
                        <option value="{{ $klasifikasi }}" {{ request('klasifikasi') == $klasifikasi ? 'selected' : '' }}>{{ $klasifikasi }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-sm btn-primary">Filter</button>
            </div>
        </div>
    </form>
</div>

            <!-- TOMBOL TAMBAH DATA -->
            <div class="pb-3">
                <a href="{{ route('tambahbarang') }}" class="btn btn-primary">+ Tambah Data</a>
            </div>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="col-no">No</th>
                            <th class="col-klasifikasi">Klasifikasi</th>
                            <th class="col-id">Kode Barang</th>
                            <th class="col-nama">Nama</th>
                            <th class="col-detail">Detail Spesifikasi</th>
                            <th class="col-brand">Brand</th>
                            <th class="col-type">Type</th>
                            <th class="col-harga">Harga Asli OFF</th>
                            <th class="col-harga">Harga Asli ON</th>
                            <th class="col-harga">Harga RAB+20%</th>
                            <th class="col-harga">Harga RAB Wajar</th>
                            <th class="col-tanggal">Tanggal Update</th>
                            <th class="col-vendor">Vendor</th>
                            <th class="col-satuan">Satuan</th>
                            <th class="col-keterangan">Keterangan</th>
                            <th class="col-gambar">Gambar</th>
                            <th class="col-link">Link</th>
                            <th class="col-aksi">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($katalog as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->klasifikasiRelasi->klasifikasi ?? $item->klasifikasi }}</td>
                            <td>{{ $item->kode_barang }}</td>
                            <td>{{ $item->nama }}</td>
                            <td class="col-detail" style="white-space: pre-line;">{{ $item->detail_spesifikasi }}</td>
                            <td>{{ $item->brand }}</td>
                            <td>{{ $item->type }}</td>
                            <td>{{ $item->harga_asli_offline }}</td>
                            <td>{{ $item->harga_asli_online }}</td>
                            <td>{{ $item->harga_rab_persen }}</td>
                            <td>{{ $item->harga_rab_wajar }}</td>
                            <td>{{ $item->tanggal_update }}</td>
                            <td>{{ $item->vendor }}</td>
                            <td>{{ $item->satuan }}</td>
                            <td>{{ $item->keterangan }}</td>
                            <td>
                                <img src="{{ asset('images/' . $item->gambar_perangkat) }}" alt="Gambar" width="50">
                            </td>
                            <td>{{ $item->link }}</td>
                            <td>
                                <a href="{{ url('tambahbarang/' . $item->kode_barang . '/editkatalog') }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ url('tambahbarang/' . $item->kode_barang) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data katalog ini?')">Del</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- AKHIR DATA -->
    </main>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBogGzog5XcjQ/1FhZlRX6pIWQuL3HBT6hB2yl1L82Qtm/Id" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-pprn3073KE6tl6qLUGE7oNNyi6Rkbb8e2e5l2a5LWmJ5UwQf0h+TQ5PaZeD2z4In" crossorigin="anonymous"></script>
</body>
</html>
