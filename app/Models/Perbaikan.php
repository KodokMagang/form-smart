<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perbaikan extends Model
{
    use HasFactory;

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }

    public function indikasi()
    {
        return $this->belongsTo(IndikasiKerusakan::class);
    }

    protected $fillable = [
        'karyawan_id',
        'merk_noseri',
        'nama_supplier',
        'kontak_supplier',
        'indikasi_id',
        'alasan'
    ];
}
