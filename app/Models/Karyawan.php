<?php

namespace App\Models;

use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Karyawan extends Model
{
    use HasFactory;

    public function divisi()
    {
        return $this->belongsTo(Divisi::class);
    }

    public function roles()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    
    protected $fillable = [
        'nik_karyawan',
        'nama_karyawan',
        'tanggal_lahir',
        'tempat_lahir',
        'role_id',
        'divisi_id',
        
    ];
}
