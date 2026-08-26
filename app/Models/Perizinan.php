<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perizinan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kegiatan_id', // Ditambahkan agar kolom kegiatan_id bisa disimpan
        'jenis_izin',
        'tanggal_mulai',
        'tanggal_selesai',
        'alasan',
        'bukti_lampiran',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Ditambahkan untuk mengatasi error RelationNotFoundException
    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }
}