<?php

namespace App\Http\Controllers;

use App\Models\Mengetahui;
use App\Models\Menyetujui;
use App\Models\PembuatDokumen;
use App\Models\UnitKerja;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Satuan;
use App\Models\Katalog;
use Spatie\Permission\Models\Role;
use App\Models\daop;

class MasterController extends Controller
{
    public function index(Request $request)
    {  
        $totalUsers = User::count();
        $totalRole = Role::count();
        $satuantotal = Satuan::count();
        $totalKatalog = Katalog::count();
        $totalDaop= daop::count();
        $totalUnit= UnitKerja::count();
        $totalMenyetujui= Menyetujui::count();
        $totalMengetahui= Mengetahui::count();
        $totalDokumen= PembuatDokumen::count();
        return view('admin.master', compact('totalUsers', 'totalRole', 'satuantotal','totalKatalog','totalDaop','totalUnit','totalMenyetujui','totalMengetahui','totalDokumen'));
    }

    }

