<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;

    protected $table = 'presensis'; 

    protected $fillable = [
        'user_id',
        'kegiatan_id',
        'status_kehadiran',
        'bukti',
        'status_verifikasi',
    ];

    // Relasi ke Model User (Wajib ada agar error 'user' hilang)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke Model Kegiatan
    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'kegiatan_id');
    }
}