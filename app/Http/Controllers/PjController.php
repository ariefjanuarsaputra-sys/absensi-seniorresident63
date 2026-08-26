<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PjController extends Controller
{
    public function verifikasi()
    {
        /** @var User|null $currentUser */
        $currentUser = Auth::user();
        
        $pjGedung = $currentUser && $currentUser->gedung ? trim($currentUser->gedung) : null;

        if (empty($pjGedung)) {
            return view('pj.verifikasi', [
                'menunggu'  => collect(),
                'disetujui' => collect(),
                'ditolak'   => collect(),
            ]);
        }

        // Filter presensi hanya untuk user di gedung yang sama dengan PJ
        $allPresensi = Presensi::with(['user', 'kegiatan'])
            ->whereHas('user', function ($query) use ($pjGedung) {
                $query->whereRaw('TRIM(LOWER(gedung)) = ?', [strtolower($pjGedung)]);
            })
            ->latest()
            ->get();

        // Sertakan 'Menunggu Verifikasi' sesuai nilai yang diisi oleh Anggota
        $menunggu  = $allPresensi->whereIn('status_verifikasi', ['Menunggu Verifikasi', 'Menunggu', 'Pending', null]);
        $disetujui = $allPresensi->where('status_verifikasi', 'Disetujui');
        $ditolak   = $allPresensi->where('status_verifikasi', 'Ditolak');

        return view('pj.verifikasi', compact('menunggu', 'disetujui', 'ditolak'));
    }

    public function approve(int $id)
    {
        $presensi = Presensi::with('user')->findOrFail($id);

        /** @var User|null $currentUser */
        $currentUser = Auth::user();

        $pjGedung   = $currentUser && $currentUser->gedung ? trim($currentUser->gedung) : null;
        $userGedung = optional($presensi->user)->gedung ? trim($presensi->user->gedung) : null;

        if (!$presensi->user || empty($pjGedung) || empty($userGedung) || strcasecmp($pjGedung, $userGedung) !== 0) {
            return back()->with('error', 'Anda tidak berhak memverifikasi anggota dari gedung lain.');
        }

        $presensi->update(['status_verifikasi' => 'Disetujui']);

        return back()->with('success', 'Presensi berhasil disetujui.');
    }

    public function reject(int $id)
    {
        $presensi = Presensi::with('user')->findOrFail($id);

        /** @var User|null $currentUser */
        $currentUser = Auth::user();

        $pjGedung   = $currentUser && $currentUser->gedung ? trim($currentUser->gedung) : null;
        $userGedung = optional($presensi->user)->gedung ? trim($presensi->user->gedung) : null;

        if (!$presensi->user || empty($pjGedung) || empty($userGedung) || strcasecmp($pjGedung, $userGedung) !== 0) {
            return back()->with('error', 'Anda tidak berhak memverifikasi anggota dari gedung lain.');
        }

        $presensi->update(['status_verifikasi' => 'Ditolak']);

        return back()->with('success', 'Presensi berhasil ditolak.');
    }
}