<?php
namespace App\Http\Controllers;

use App\Models\NetworkCatalog;
use App\Models\Katalog;
use App\Models\ToolkitCatalog;
use App\Models\WebcamCatalog;
use App\Models\TablemonitorCatalog;
use App\Models\PcLapAioMinipcCatalog;
use App\Models\PrinterCatalog;
use App\Models\CctvCatalog;
use App\Models\Satuan;
use App\Models\Klasifikasi;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Exports\KatalogExport;
use Maatwebsite\Excel\Facades\Excel;

class KatalogController extends Controller
{
    public function getNextSequenceNumber($klasifikasi)
{
    // Ambil nomor urut terakhir dari database
    $lastBarang = Katalog::where('kode_barang', 'like', $klasifikasi.'%')
                        ->orderBy('kode_barang', 'desc')
                        ->first();

    if ($lastBarang) {
        // Jika ada, ambil 3 digit terakhir dan tambahkan 1
        $lastNumber = intval(substr($lastBarang->kode_barang, -3));
        $nextNumber = $lastNumber + 1;
    } else {
        // Jika tidak ada, mulai dari 1
        $nextNumber = 001;
    }

    return response()->json(['sequenceNumber' => $nextNumber]);
}

public function exportExcel(Request $request)
{
    $tahun = $request->input('tahun');
    
    if (!$tahun) {
        return redirect()->back()->with('error', 'Pilih tahun terlebih dahulu.');
    }

    return Excel::download(new KatalogExport($tahun), 'katalog_' . $tahun . '.xlsx');
}
    public function create()
    {
        $klasifikasi = Klasifikasi::all();
        $satuan = Satuan::all();
        return view('katalog.tambahbarang', compact('satuan','klasifikasi'));
    }

    public function view(Request $request)
    {
        $query = Katalog::query();
    
        if ($request->filled('kode_barang')) {
            $query->where('kode_barang', 'LIKE', '%' . $request->katakunci . '%');
        }
    
        if ($request->filled('katakunci')) {
            $query->where('nama', 'LIKE', '%' . $request->katakunci . '%');
        }
    
        if ($request->filled('tahun')) {
            $query->whereYear('tanggal_update', $request->tahun);
        }
    
        if ($request->filled('klasifikasi')) {
            $query->where('klasifikasi', $request->klasifikasi);
        }
    
        $katalog = $query->paginate(10); // Menambahkan paginasi
    
        $tahunOptions = Katalog::selectRaw('YEAR(tanggal_update) as tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');
    
        $klasifikasiOptions = Katalog::select('klasifikasi')
            ->distinct()
            ->orderBy('klasifikasi')
            ->pluck('klasifikasi');
    
        return view('katalog.viewkatalog', compact('katalog', 'tahunOptions', 'klasifikasiOptions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'klasifikasi' => 'required',
            'kode_barang' => 'required|unique:katalogs',
            'nama' => 'nullable',
            'detail_spesifikasi' => 'nullable',
            'brand' => 'nullable',
            'type' => 'nullable',
            'harga_asli_offline' => 'nullable|numeric',
            'harga_asli_online' => 'nullable|numeric',
            'harga_rab_persen' => 'nullable|numeric',
            'harga_rab_wajar' => 'nullable|numeric',
            'tanggal_update' => 'nullable|date',
            'vendor' => 'nullable',
            'jumlah_kebutuhan' => 'nullable|integer',
            'jumlah_ketersediaan' => 'nullable|integer',
            'satuan' => 'nullable',
            'keterangan' => 'nullable',
            'gambar_perangkat' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'nullable|url',
        ]);

        $katalog = new Katalog();
        $katalog->klasifikasi = $request->klasifikasi;
        $katalog->kode_barang = $request->kode_barang;
        $katalog->nama = $request->nama;
        $katalog->detail_spesifikasi = $request->detail_spesifikasi;
        $katalog->brand = $request->brand;
        $katalog->type = $request->type;
        $katalog->harga_asli_offline = $request->harga_asli_offline;
        $katalog->harga_asli_online = $request->harga_asli_online;
        $katalog->harga_rab_persen = $request->harga_rab_persen;
        $katalog->harga_rab_wajar = $request->harga_rab_wajar;
        $katalog->tanggal_update = $request->tanggal_update;
        $katalog->vendor = $request->vendor;
        $katalog->jumlah_kebutuhan = $request->jumlah_kebutuhan;
        $katalog->jumlah_ketersediaan = $request->jumlah_ketersediaan;
        $katalog->satuan = $request->satuan;
        $katalog->keterangan = $request->keterangan;
        $katalog->link = $request->link;

        if ($request->hasFile('gambar_perangkat')) {
            $image = $request->file('gambar_perangkat');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $katalog->gambar_perangkat = $name;
        }

        $katalog->save();

        return redirect()->route('viewkatalog')->with('success', 'Katalog berhasil ditambahkan');
    }
    
    public function edit(string $id)
    {
        $satuan = Satuan::all();
        $katalog = Katalog::where('kode_barang', $id)->first();
        return view('katalog.editkatalog', ['Data' => $katalog], compact('satuan'));
    }

    public function update(Request $request, $kode_barang)
    {
        $katalog = Katalog::where('kode_barang', $kode_barang)->firstOrFail();
    
        $request->validate([
            'klasifikasi' => 'required',
            'kode_barang' => 'required|unique:katalogs,kode_barang,' . $katalog->id,
            'nama' => 'nullable',
            'detail_spesifikasi' => 'nullable',
            'brand' => 'nullable',
            'type' => 'nullable',
            'harga_asli_offline' => 'nullable|numeric',
            'harga_asli_online' => 'nullable|numeric',
            'harga_rab_persen' => 'nullable|numeric',
            'harga_rab_wajar' => 'nullable|numeric',
            'tanggal_update' => 'nullable|date',
            'vendor' => 'nullable',
            'jumlah_kebutuhan' => 'nullable|integer',
            'jumlah_ketersediaan' => 'nullable|integer',
            'satuan' => 'nullable',
            'keterangan' => 'nullable',
            'gambar_perangkat' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'nullable|url',
        ]);
    
        $katalog->klasifikasi = $request->klasifikasi;
        $katalog->kode_barang = $request->kode_barang;
        $katalog->nama = $request->nama;
        $katalog->detail_spesifikasi = $request->detail_spesifikasi;
        $katalog->brand = $request->brand;
        $katalog->type = $request->type;
        $katalog->harga_asli_offline = $request->harga_asli_offline;
        $katalog->harga_asli_online = $request->harga_asli_online;
        $katalog->harga_rab_persen = $request->harga_rab_persen;
        $katalog->harga_rab_wajar = $request->harga_rab_wajar;
        $katalog->tanggal_update = Carbon::parse($request->tanggal_update)->format('Y-m-d');
        $katalog->vendor = $request->vendor;
        $katalog->jumlah_kebutuhan = $request->jumlah_kebutuhan;
        $katalog->jumlah_ketersediaan = $request->jumlah_ketersediaan;
        $katalog->satuan = $request->satuan;
        $katalog->keterangan = $request->keterangan;
        $katalog->link = $request->link;
    
        if ($request->hasFile('gambar_perangkat')) {
            // Hapus gambar lama jika ada
            if ($katalog->gambar_perangkat) {
                Storage::delete('public/images/' . $katalog->gambar_perangkat);
            }
    
            $image = $request->file('gambar_perangkat');
            $name = time().'.'.$image->getClientOriginalExtension();
            $image->storeAs('public/images', $name);
            $katalog->gambar_perangkat = $name;
        }
    
        $katalog->save();
    
        return redirect('viewkatalog')->with('success', 'Berhasil mengedit katalog barang');
    }

    public function destroy($id)
    {
        Katalog::where('kode_barang', $id)->delete();
        return redirect()->to('viewkatalog')->with('success', 'Berhasil menghapus data katalog barang');
    }
}
