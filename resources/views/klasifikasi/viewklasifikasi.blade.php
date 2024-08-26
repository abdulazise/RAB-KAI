<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Klasifikasi</title>
    <link href="assets/img/kai.png" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    
  </head>
  <body class="bg-light">
    <main class="container">
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
    <a href="{{ url('master') }}" class="btn btn-secondary" style="background-color: orange; border-color: orange; color: white;">Kembali</a>
</div>


        <!-- FORM PENCARIAN -->
        <div class="pb-3">
          <form class="d-flex" action="{{ url('indexrole') }}" method="get">
            <input class="form-control me-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Masukkan kata kunci" aria-label="Search">
            <button class="btn btn-secondary" type="submit">Cari</button>
          </form>
        </div>
        
        <!-- TOMBOL TAMBAH DATA -->
        <div class="pb-3">
          <a href="{{ route('tambahklasifikasi') }}" class="btn btn-primary">+ Tambah Klasifikasi</a>
        </div>
        
        <table class="table table-striped">
          <thead>
            <tr>
              <th class="col-md-1">No</th>
              <th class="col-md-4">Klasifikasi</th>
              <th class="col-md-4">Inisial</th>
              <th class="col-md-2">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($klasifikasi as $item)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $item->klasifikasi }}</td>
              <td>{{ $item->inisial }}</td>
              
              <td>
               
              <a href="{{ url('tambahklasifikasi/' . $item->klasifikasi . '/edit') }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ url('tambahklasifikasi/' . $item->klasifikasi) }}" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus Klasifikasi ini?')">Del</button>
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
