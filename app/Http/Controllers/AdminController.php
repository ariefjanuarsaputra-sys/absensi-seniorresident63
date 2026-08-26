<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalAnggota = User::whereIn('role', ['anggota', 'pj_gedung'])->count();
        $kegiatanAktif = 0;
        $menungguVerifikasi = 0;
        $sudahDiverifikasi = 0;
        $totalHadir = 0;
        $totalIzin = 0;
        $totalAlpha = 0;
        $persentaseRataRata = 0;
        $kegiatanTerbaru = [];

        return view('admin.dashboard', compact(
            'totalAnggota',
            'kegiatanAktif',
            'menungguVerifikasi',
            'sudahDiverifikasi',
            'totalHadir',
            'totalIzin',
            'totalAlpha',
            'persentaseRataRata',
            'kegiatanTerbaru'
        ));
    }

    public function anggota()
    {
        $anggotas = User::latest()->get();

        return view('admin.anggota', compact('anggotas'));
    }
}