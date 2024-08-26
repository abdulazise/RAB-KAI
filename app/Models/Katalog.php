<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Katalog extends Model
{
    use HasFactory;
    public function klasifikasiRelasi()
    {
        return $this->belongsTo(Klasifikasi::class, 'klasifikasi', 'inisial');
    }
    protected $table = 'katalogs';
    
    protected $fillable = [
        'klasifikasi',
        'kode_barang',
        'nama',
        'detail_spesifikasi',
        'brand',
        'type',
        'harga_asli_offline',
        'harga_asli_online',
        'harga_rab_persen',
        'harga_rab_wajar',
        'tanggal_update',
        'vendor',
        'satuan',
        'keterangan',
        'gambar_perangkat',
        'link'
    ];

    public $timestamps = true; // Jika Anda menggunakan timestamps
}

