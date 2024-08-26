<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Klasifikasi;

class KlasifikasiController extends Controller
{public function index()
{
    $klasifikasi = Klasifikasi::all();
    return view('klasifikasi.viewklasifikasi', compact('klasifikasi'));
}

public function create()
{
    return view('klasifikasi.tambahklasifikasi');
}

public function store(Request $request)
{
    $request->validate([
        'klasifikasi' => 'required|string|max:255|unique:klasifikasi,klasifikasi',
        'inisial' => 'required|string',
    ]);

    Klasifikasi::create([
        'klasifikasi' => $request->klasifikasi,
        'inisial' => $request->inisial,

    ]);

    return redirect()->route('viewklasifikasi')->with('success', 'Klasifikasi berhasil dibuat.');
}

public function edit()
{
    $item = Klasifikasi::all();
    return view('klasifikasi.editklasifikasi', compact('item'));
}

public function update(Request $request, Klasifikasi $klasifikasi)
{
    $request->validate([
        'klasifikasi' => 'required|string|max:255|unique:klasifikasi,klasifikasi',
        'inisial' => 'required|string',
    ]);

    $klasifikasi->update([
        'klasifikasi' => $request->klasifikasi,
        'inisial' => $request->inisial,
    ]);

    return redirect()->route('viewklasifikasi')->with('success', 'Berhasil edit data');
}

public function destroy($klasifikasi)
{
    Klasifikasi::where('klasifikasi', $klasifikasi)->delete();
    return redirect()->to('viewklasifikasi')->with('success','Berhasil Melakukan delete');
}

}