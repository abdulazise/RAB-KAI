<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitKerja extends Model
{
    use HasFactory;

    
    protected $table = 'pengaturan_unit_kerja';

    protected $fillable = [
        'Nama_Unit',
        'DAOP',
        
        
    ];
}
