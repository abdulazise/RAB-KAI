<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Klasifikasi Barang</title>
    <link href="assets/img/kai.png" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    @include('layout.partial.link')
</head>
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
<body class="bg-light">
<main class="container">
    <h1>Tambah Klasifikasi Baru</h1>
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('tambahklasifikasi') }}" method="POST">
        @csrf
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <div class="mb-3 row">
                <div class="mb-4 text-center">
                    <h1 class="text-2xl font-bold text-gray-800">Tambah Klasifikasi Barang</h1>
                </div>
                <label for="klasifikasi" class="col-sm-2 col-form-label">Klasifikasi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="klasifikasi" id="klasifikasi" value="{{ Session::get('klasifikasi') }}">
                    @if ($errors->has('klasifikasi'))
                        <div class="text-danger">{{ $errors->first('klasifikasi') }}</div>
                    @endif
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inisial" class="col-sm-2 col-form-label">Inisial</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="inisial" id="inisial" value="{{ Session::get('inisial') }}">
                    @if ($errors->has('inisial'))
                        <div class="text-danger">{{ $errors->first('inisial') }}</div>
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
    </form>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
<script>
    document.getElementById('add-kode-barang').addEventListener('click', function () {
        var container = document.getElementById('kode-barang-container');
        var inputCount = container.getElementsByTagName('input').length;
        var newInput = document.createElement('input');
        newInput.type = 'number';
        newInput.name = 'kode_barang[]';
        newInput.className = 'form-control mb-2';
        newInput.placeholder = 'Kode Barang ' + (inputCount + 1);
        container.appendChild(newInput);
    });
</script>
</body>
</html>
