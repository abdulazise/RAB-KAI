<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Role</title>
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
    <a href="{{ url('indexrole') }}" class="btn btn-secondary" style="background-color: orange; border-color: orange; color: white;">Kembali</a>
</div>


<div class="pb-3">
    <form action="{{ url('viewkatalog') }}" method="get">
        <div class="row g-2 align-items-center">
            <div class="col-auto">
                <input class="form-control form-control-sm" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Cari...">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-sm btn-primary">Filter</button>
            </div>
        </div>
  </form>
</div>
        <!-- TOMBOL TAMBAH DATA -->
        <div class="pb-3">
          <a href="{{ route('tambahrole') }}" class="btn btn-primary">+ Tambah Role</a>
        </div>
        
        <table class="table table-striped">
          <thead>
            <tr>
              <th class="col-md-1">No</th>
              <th class="col-md-3">Role</th>
              <th class="col-md-4">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($roles as $item)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $item->name }}</td>
              <td>
               
                <form action="{{ url('tambahrole/' . $item->name) }}" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus role ini?')">Del</button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- AKHIR DATA -->
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  </body>
</html>
