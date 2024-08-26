<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Katalog Barang</title>
    <link href="assets/img/kai.png" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    @include('layout.partial.link')


</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <style>
    body {
        padding-top: 60px; /* Adjust based on the height of your header */
    }
    
    header {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000; /* Ensure header stays on top */
    }

    .container {
        margin-top:50px; /* Adjust based on the height of your header */
    }
</style>
@include('layout.partial.header')
<main class="container mt-5">
<h1>Tambah Barang</h1>
    @if ($errors->any())
        <div class="pt-3">
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
    <!-- START FORM -->
    
   
    <form action="{{ url('tambahbarang/' . $Data->kode_barang.'/editkatalog') }}" method="post" enctype="multipart/form-data">
        @csrf
       
        <div class="w-full px-4 md:px-0 md:mt-8 mb-16 text-gray-800 leading-normal">
        <div class="my-3 p-3 bg-body rounded shadow-sm container w-full mx-auto pt-20">
        <div class="mb-4 text-center" >
                <h1 class="text-2xl font-bold text-gray-800">Tambah Katalog Barang</h1>
            </div>
            <div class="mb-3 row">
    <label for="klasifikasi" class="col-sm-2 col-form-label">Klasifikasi</label>
    <div class="col-sm-10">
        <select class="form-control" name="klasifikasi" id="klasifikasi">
            <option value="">Pilih Klasifikasi</option>
            @foreach($klasifikasi as $item)
                <option value="{{ $item->inisial }}">{{ $item->klasifikasi }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="mb-3 row">
    <label for="kode_barang" class="col-sm-2 col-form-label">Kode Barang</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" name="kode_barang" id="kode_barang" readonly value="{{ old('kode_barang', $Data->kode_barang)  }}">
        @if ($errors->has('kode_barang'))
            <div class="text-danger">{{ $errors->first('kode_barang') }}</div>
        @endif
    </div>
</div>
<script>document.addEventListener('DOMContentLoaded', function() {
    const klasifikasiSelect = document.getElementById('klasifikasi');
    const kodeBarangInput = document.getElementById('kode_barang');

    klasifikasiSelect.addEventListener('change', function() {
        const selectedValue = this.value;
        if (selectedValue) {
            // Dapatkan tanggal hari ini dalam format YYYYMMDD
            const today = new Date();
            const year = today.getFullYear();
            const month = String(today.getMonth() + 1).padStart(2, '0');
            const day = String(today.getDate()).padStart(2, '0');
            const dateString = `${year}${month}${day}`;

            // Dapatkan nomor urut (misalnya dari 001-999)
            // Ini harus diimplementasikan sesuai dengan logika bisnis Anda
            const sequenceNumber = '001'; // Contoh statis, seharusnya diambil dari database

            // Buat kode barang
            const kodeBarang = `${selectedValue}${dateString}${sequenceNumber}`;
            kodeBarangInput.value = kodeBarang;
        } else {
            kodeBarangInput.value = '';
        }
    });
});</script>

            <div class="mb-3 row">
                <label for="nama" class="col-sm-2 col-form-label">Nama Barang</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" name="nama" id="nama" value="{{ old('nama', $Data->nama)  }}">
                    @if ($errors->has('nama'))
                        <div class="text-danger">{{ $errors->first('nama') }}</div>
                    @endif
                </div>
                </div>
            <div class="mb-3 row">
                <label for="detail_spesifikasi" class="col-sm-2 col-form-label">Detail Spesifikasi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="detail_spesifikasi" id="detail_spesifikasi" value="{{ old('detail_spesifikasi', $Data->detail_spesifikasi)  }}">
                    @if ($errors->has('detail_spesifikasi'))
                        <div class="text-danger">{{ $errors->first('detail_spesifikasi') }}</div>
                    @endif
                </div>
            </div>
            <div class="mb-3 row">
                <label for="brand" class="col-sm-2 col-form-label">Brand</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="brand" id="brand" value="{{ old('brand', $Data->brand)  }}">
                    @if ($errors->has('brand'))
                        <div class="text-danger">{{ $errors->first('brand') }}</div>
                    @endif
                </div>
            </div>
            <div class="mb-3 row">
                <label for="type" class="col-sm-2 col-form-label">Type</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="type" id="type" value="{{ old('type', $Data->type) }}">
                    @if ($errors->has('type'))
                        <div class="text-danger">{{ $errors->first('type') }}</div>
                    @endif
                </div>
            </div>
            <div class="mb-3 row">
    <label for="harga_asli_offline" class="col-sm-2 col-form-label">Harga Asli Offline</label>
    <div class="col-sm-10">
        <input type="number" class="form-control" name="harga_asli_offline" id="harga_asli_offline" value="{{old('harga_asli_offline', $Data->harga_asli_offline) }}">
        @if ($errors->has('harga_asli_offline'))
            <div class="text-danger">{{ $errors->first('harga_asli_offline') }}</div>
        @endif
    </div>
</div>
            
            <div class="mb-3 row">
                <label for="harga_asli_online" class="col-sm-2 col-form-label">Harga Asli Online</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="harga_asli_online" id="harga_asli_online" value="{{ old('harga_asli_online', $Data->harga_asli_online)  }}">
                    @if ($errors->has('harga_asli_online'))
                        <div class="text-danger">{{ $errors->first('harga_asli_online') }}</div>
                    @endif
                </div>
            </div>
            <div class="mb-3 row">
    <label for="harga_rab_persen" class="col-sm-2 col-form-label">Harga RAB+20%</label>
    <div class="col-sm-10">
        <input type="number" class="form-control" name="harga_rab_persen" id="harga_rab_persen" step="0.01" min="0" readonly value="{{ old('harga_rab_persen', $Data->harga_rab_persen)  }}">
        @if ($errors->has('harga_rab_persen'))
            <div class="text-danger">{{ $errors->first('harga_rab_persen') }}</div>
        @endif
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const hargaAsliOfflineInput = document.getElementById('harga_asli_offline');
        const hargaRabPersenInput = document.getElementById('harga_rab_persen');

        function updateHargaRabPersen() {
            let hargaAsliOffline = parseFloat(hargaAsliOfflineInput.value);
            if (isNaN(hargaAsliOffline) || hargaAsliOffline < 0) {
                hargaRabPersenInput.value = 0;
            } else {
                hargaRabPersenInput.value = (hargaAsliOffline * 1.20).toFixed(2);
            }
        }

        hargaAsliOfflineInput.addEventListener('input', updateHargaRabPersen);

        // Initial calculation if there's already a value
        updateHargaRabPersen();
    });
</script>
            <div class="mb-3 row">
                <label for="harga_rab_wajar" class="col-sm-2 col-form-label">Harga Rab Wajar</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="harga_rab_wajar" id="harga_rab_wajar" value="{{ old('harga_rab_wajar', $Data->harga_rab_wajar)  }}">
                    @if ($errors->has('harga_rab_wajar'))
                        <div class="text-danger">{{ $errors->first('harga_rab_wajar') }}</div>
                    @endif
                </div>
            </div>
            <div class="mb-3 row">
                <label for="tanggal_update" class="col-sm-2 col-form-label">Tanggal Update</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" name="tanggal_update" id="tanggal_update" value="{{ old('tanggal_update', $Data->tanggal_update)  }}">
                    @if ($errors->has('tanggal_update'))
                        <div class="text-danger">{{ $errors->first('tanggal_update') }}</div>
                    @endif
                </div>
            </div>
            <div class="mb-3 row">
                <label for="vendor" class="col-sm-2 col-form-label">Vendor</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="vendor" id="vendor" value="{{ old('vendor', $Data->vendor)  }}">
                    @if ($errors->has('vendor'))
                        <div class="text-danger">{{ $errors->first('vendor') }}</div>
                    @endif
                </div>
            </div>
            <div class="mb-3 row">
                <label for="jumlah_kebutuhan" class="col-sm-2 col-form-label">Jumlah Kebutuhan</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="jumlah_kebutuhan" id="jumlah_kebutuhan" value="{{old('jumlah_kebutuhan', $Data->jumlah_kebutuhan)  }}">
                    @if ($errors->has('jumlah_kebutuhan'))
                        <div class="text-danger">{{ $errors->first('jumlah_kebutuhan') }}</div>
                    @endif
                </div>
            </div>
            <div class="mb-3 row">
                <label for="jumlah_ketersediaan" class="col-sm-2 col-form-label">Jumlah Ketersediaan</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="jumlah_ketersediaan" id="jumlah_ketersediaan" value="{{ old('jumlah_ketersediaan', $Data->jumlah_ketersediaan)  }}">
                    @if ($errors->has('jumlah_ketersediaan'))
                        <div class="text-danger">{{ $errors->first('jumlah_ketersediaan') }}</div>
                    @endif
                </div>
            </div>
              <div class="mb-3 row">
    <label for="role" class="col-sm-2 col-form-label">Satuan</label>
    <div class="col-sm-10">
        <select class="form-select" name="satuan" id="satuan">
            <option value="" selected disabled>Pilih satuan</option>
            @foreach($satuan as $satuans)
                <option value="{{ $satuans->satuan }}" {{ old('satuan', $Data->satuan)  == $satuans->satuan ? 'selected' : '' }}>
                    {{ $satuans->satuan }}
                </option>
            @endforeach
        </select>
        @if ($errors->has('satuan'))
            <div class="text-danger">{{ $errors->first('satuan') }}</div>
        @endif
    </div>
</div>
            <div class="mb-3 row">
                <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="keterangan" id="keterangan" value="{{ old('keterangan', $Data->keterangan)  }}">
                    @if ($errors->has('keterangan'))
                        <div class="text-danger">{{ $errors->first('keterangan') }}</div>
                    @endif
                </div>
            </div>
            <div class="mb-3 row">
                <label for="gambar_perangkat" class="col-sm-2 col-form-label">Gambar Perangkat</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" name="gambar_perangkat" id="gambar_perangkat" value="{{ old('gambar_perangkat', $Data->gambar_perangkat)  }}>
                    @if ($errors->has('gambar_perangkat'))
                        <div class="text-danger">{{ $errors->first('gambar_perangkat') }}</div>
                    @endif
                </div>
            </div>

            <div class="mb-3 row">
                <label for="link" class="col-sm-2 col-form-label">Link</label>
                <div class="col-sm-10">
                    <input type="link" class="form-control" name="link" id="link" value="{{ old('link', $Data->link)  }}">
                    @if ($errors->has('link'))
                        <div class="text-danger">{{ $errors->first('link') }}</div>
                    @endif
                </div>
            </div>
   

            
            <div class="mb-3 row">
                <div class="col-sm-10 offset-sm-2">
                    <button type="submit" class="btn btn-primary" name="submit">SIMPAN</button>
                    <img src="assets/img/kai.png" width="60px" height="50px" alt="logo" style="float: right;">
                </div>
            </div>
</div>
            </div>
        </div>
        </div>    
        
        
    </form>
    <!-- AKHIR FORM -->
</main>
@yield('content')
@include('layout.partial.script')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>
</html>
