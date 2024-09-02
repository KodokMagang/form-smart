<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permit extends Model
{
    use HasFactory;


    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }

    protected $fillable = [
        
        'karyawan_id',
        'keperluan',
        'mulai_tanggal',
        'sd_tanggal',
        'mulai_jam',
        'sd_jam'
    ];
}
