<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Kegiatan;
use App\Models\Presensi;
use App\Models\Perizinan;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PjController;

// Redirect Halaman Utama ke Login
Route::get('/', function () {
    return redirect()->route('login');
});

// ==============================================
// 1. ROUTE LOGIN & LOGOUT
// ==============================================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ==============================================
// 2. ROUTE ADMIN (Khusus Admin)
// ==============================================
Route::middleware(['auth', 'can:admin-only'])->prefix('admin')->group(function () {
    
    // Dashboard Admin
    Route::get('/dashboard', function () {
        $totalAnggota = User::whereIn('role', ['anggota', 'Anggota'])->count();

        $kegiatanBulanIni = Kegiatan::whereMonth('tanggal_mulai', Carbon::now()->month)
                                    ->whereYear('tanggal_mulai', Carbon::now()->year)
                                    ->count();

        $izinPending = Perizinan::where('status', 'Menunggu')->count();
        $totalPjGedung = User::whereIn('role', ['pj_gedung', 'PJ Gedung', 'pj'])->count();

        $kegiatanMendatang = Kegiatan::where('tanggal_mulai', '>=', Carbon::today())
                                    ->orderBy('tanggal_mulai', 'asc')
                                    ->take(5)
                                    ->get();

        return view('admin.dashboard', compact(
            'totalAnggota',
            'kegiatanBulanIni',
            'izinPending',
            'totalPjGedung',
            'kegiatanMendatang'
        ));
    })->name('admin.dashboard');

    // Kelola Kegiatan
    Route::get('/kegiatan', function () { 
        $kegiatans = Kegiatan::latest()->get();
        return view('admin.kegiatan', compact('kegiatans')); 
    })->name('admin.kegiatan');

    Route::post('/kegiatan/store', function (Request $request) {
        $request->validate([
            'nama_kegiatan'   => 'required|string|max:255',
            'tanggal_mulai'   => 'required',
            'tanggal_selesai' => 'required',
            'lokasi'          => 'required|string|max:255',
        ]);

        Kegiatan::create([
            'nama_kegiatan'   => $request->nama_kegiatan,
            'deskripsi'       => $request->deskripsi ?? '-',
            'tanggal'         => $request->tanggal_mulai, 
            'tanggal_mulai'   => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'lokasi'          => $request->lokasi,
            'status'          => 'Akan Datang',
        ]);

        return redirect()->route('admin.kegiatan')->with('success', 'Kegiatan berhasil ditambahkan!');
    })->name('admin.kegiatan.store');

    // Data Anggota
    Route::get('/anggota', function () {
        $anggotas = User::latest()->get();
        return view('admin.anggota', compact('anggotas'));
    })->name('admin.anggota');

    Route::post('/anggota/store', function (Request $request) {
        $request->validate([
            'name'     => 'required|string|max:255',
            'nim'      => 'required|string|unique:users,nim',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role'     => 'required|in:admin,pj_gedung,anggota',
            'gedung'   => 'nullable|string',
            'kamar'    => 'nullable|string',
        ]);

        User::create([
            'name'     => $request->name,
            'nim'      => $request->nim,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'role'     => $request->role,
            'gedung'   => $request->gedung ?? '-',
            'kamar'    => $request->kamar ?? '-',
        ]);

        return back()->with('success', 'Anggota berhasil ditambahkan!');
    })->name('admin.anggota.store');

    Route::put('/anggota/{id}', function (Request $request, $id) {
        $user = User::findOrFail($id);
        
        $request->validate([
            'name'   => 'required|string|max:255',
            'nim'    => 'required|string|unique:users,nim,' . $id,
            'email'  => 'required|email|unique:users,email,' . $id,
            'role'   => 'required|in:admin,pj_gedung,anggota',
            'gedung' => 'nullable|string',
            'kamar'  => 'nullable|string',
        ]);

        $data = [
            'name'   => $request->name,
            'nim'    => $request->nim,
            'email'  => $request->email,
            'role'   => $request->role,
            'gedung' => $request->gedung ?? '-',
            'kamar'  => $request->kamar ?? '-',
        ];

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        return back()->with('success', 'Data anggota berhasil diperbarui!');
    })->name('admin.anggota.update');

    Route::delete('/anggota/{id}', function ($id) {
        User::findOrFail($id)->delete();
        return back()->with('success', 'Anggota berhasil dihapus!');
    })->name('admin.anggota.destroy');

    // Verifikasi Presensi Anggota
    Route::get('/verifikasi', function () {
        $menunggu  = Presensi::with(['user', 'kegiatan'])->where('status_verifikasi', 'Menunggu Verifikasi')->latest()->get();
        $disetujui = Presensi::with(['user', 'kegiatan'])->where('status_verifikasi', 'Disetujui')->latest()->get();
        $ditolak   = Presensi::with(['user', 'kegiatan'])->where('status_verifikasi', 'Ditolak')->latest()->get();

        return view('admin.verifikasi', compact('menunggu', 'disetujui', 'ditolak'));
    })->name('admin.verifikasi');

    Route::post('/verifikasi/{id}/approve', function ($id) {
        $presensi = Presensi::findOrFail($id);
        $presensi->status_verifikasi = 'Disetujui';
        $presensi->save();

        return back()->with('success', 'Presensi anggota berhasil disetujui!');
    })->name('admin.verifikasi.approve');

    Route::post('/verifikasi/{id}/reject', function ($id) {
        $presensi = Presensi::findOrFail($id);
        $presensi->status_verifikasi = 'Ditolak';
        $presensi->save();

        return back()->with('success', 'Presensi anggota ditolak.');
    })->name('admin.verifikasi.reject');

    // Monitoring Absensi (Menampilkan Seluruh Anggota & PJ Gedung)
    Route::get('/absensi', function (Request $request) { 
        $kegiatans = Kegiatan::latest()->get();
        $selectedKegiatanId = $request->kegiatan_id ?? $kegiatans->first()?->id;

        $query = User::whereIn('role', ['anggota', 'pj_gedung', 'Anggota', 'PJ Gedung']);

        if ($request->filled('gedung')) {
            $query->where('gedung', $request->gedung);
        }

        $users = $query->get();

        $absens = $users->map(function($user) use ($selectedKegiatanId) {
            $presensi = Presensi::where('user_id', $user->id)
                ->when($selectedKegiatanId, function($q) use ($selectedKegiatanId) {
                    return $q->where('kegiatan_id', $selectedKegiatanId);
                })
                ->latest()
                ->first();

            return (object) [
                'user'              => $user,
                'waktu_absen'       => $presensi ? \Carbon\Carbon::parse($presensi->created_at)->format('H:i') : null,
                'status_absen'      => $presensi ? $presensi->status_kehadiran : 'Belum Absen',
                'status_verifikasi' => $presensi ? $presensi->status_verifikasi : 'Belum Absen',
            ];
        });

        return view('admin.absensi', compact('kegiatans', 'absens')); 
    })->name('admin.absensi');

    // Rapor, Laporan, & Pengaturan
    Route::get('/rapor', function () {
        $rapors = User::whereIn('role', ['anggota', 'pj_gedung', 'Anggota', 'PJ Gedung'])->get()->map(function($user) {
            $totalHadir = Presensi::where('user_id', $user->id)->where('status_kehadiran', 'Hadir')->count();
            $totalIzin  = Presensi::where('user_id', $user->id)->where('status_kehadiran', 'Izin')->count();
            $totalAlpha = Presensi::where('user_id', $user->id)->where('status_kehadiran', 'Alpha')->count();
            $total      = $totalHadir + $totalIzin + $totalAlpha;
            $persentase = $total > 0 ? round(($totalHadir / $total) * 100) : 0;

            $user->total_hadir = $totalHadir;
            $user->total_izin  = $totalIzin;
            $user->total_alpha = $totalAlpha;
            $user->persentase  = $persentase;

            return $user;
        });

        return view('admin.rapor', compact('rapors'));
    })->name('admin.rapor');

    Route::get('/laporan', function () { return view('admin.laporan'); })->name('admin.laporan');

    // Route Pengaturan Admin
    Route::get('/pengaturan', function () {
        $user = Auth::user();
        return view('admin.pengaturan', compact('user'));
    })->name('admin.pengaturan');

    Route::post('/pengaturan/update', function (Request $request) {
        $user = User::findOrFail(Auth::id());

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        return back()->with('success', 'Profil berhasil diperbarui!');
    })->name('admin.pengaturan.update');

    Route::post('/pengaturan/password', function (Request $request) {
        $request->validate([
            'current_password' => 'required',
            'new_password'     => 'required|min:6',
        ]);

        $user = User::findOrFail(Auth::id());

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini salah!']);
        }

        $user->update([
            'password' => bcrypt($request->new_password),
        ]);

        return back()->with('success', 'Password berhasil diperbarui!');
    })->name('admin.pengaturan.password');

    // Perizinan Admin
    Route::get('/perizinan', function () {
        $perizinans = Perizinan::with(['user', 'kegiatan'])->latest()->get();
        return view('admin.perizinan', compact('perizinans'));
    })->name('admin.perizinan');

    Route::put('/perizinan/{id}', function (Request $request, $id) {
        Perizinan::where('id', $id)->update([
            'status' => $request->input('status', 'Disetujui')
        ]);
        return back()->with('success', 'Status perizinan berhasil diperbarui!');
    })->name('admin.perizinan.update');

    Route::post('/perizinan/{id}/approve', function ($id) {
        Perizinan::where('id', $id)->update(['status' => 'Disetujui']);
        return back()->with('success', 'Izin disetujui!');
    })->name('admin.perizinan.approve');

    Route::post('/perizinan/{id}/reject', function ($id) {
        Perizinan::where('id', $id)->update(['status' => 'Ditolak']);
        return back()->with('success', 'Izin ditolak!');
    })->name('admin.perizinan.reject');
});

// ==============================================
// 3. ROUTE ANGGOTA (Terautentikasi)
// ==============================================
Route::middleware(['auth'])->prefix('anggota')->group(function () {

    Route::get('/dashboard', function () {
        $userId = Auth::id();

        $kegiatans = Kegiatan::latest()->get()->map(function($kegiatan) use ($userId) {
            $kegiatan->data_presensi = Presensi::where('kegiatan_id', $kegiatan->id)
                                        ->where('user_id', $userId)
                                        ->latest()
                                        ->first();
            return $kegiatan;
        });

        $riwayats = Presensi::with('kegiatan')->where('user_id', $userId)->latest()->take(5)->get();

        return view('anggota.dashboard', compact('kegiatans', 'riwayats'));
    })->name('anggota.dashboard');

    Route::post('/presensi/store', function (Request $request) {
        $request->validate([
            'kegiatan_id' => 'required',
            'status'      => 'required',
            'bukti'       => 'required|file' 
        ]);

        $buktiPath = '';
        if ($request->hasFile('bukti')) {
            $buktiPath = $request->file('bukti')->store('bukti_presensi', 'public');
        }

        $presensi = new Presensi();
        $presensi->user_id = Auth::id();
        $presensi->kegiatan_id = $request->kegiatan_id;
        $presensi->status_kehadiran = $request->status;
        $presensi->bukti = $buktiPath;
        $presensi->status_verifikasi = 'Menunggu Verifikasi';
        $presensi->save();

        return redirect()->route('anggota.dashboard')->with('success', 'Presensi berhasil dikirim dan tersimpan!');
    })->name('anggota.presensi.store');

    Route::get('/riwayat', function () {
        $userId = Auth::id();
        $semua_riwayat = Presensi::with('kegiatan')->where('user_id', $userId)->latest()->get();
        return view('anggota.riwayat', compact('semua_riwayat'));
    })->name('anggota.riwayat');

    Route::get('/perizinan', function () {
        $userId = Auth::id();
        $riwayat_izin = Perizinan::where('user_id', $userId)->latest()->get();
        $kegiatans = Kegiatan::latest()->get();
        return view('anggota.perizinan', compact('riwayat_izin', 'kegiatans'));
    })->name('anggota.perizinan');

    Route::post('/perizinan/store', function (Request $request) {
        $request->validate([
            'kegiatan_id'     => 'nullable',
            'jenis_izin'      => 'required',
            'tanggal_mulai'   => 'required',
            'tanggal_selesai' => 'required',
            'alasan'          => 'required',
            'bukti_lampiran'  => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $buktiPath = null;
        if ($request->hasFile('bukti_lampiran')) {
            $buktiPath = $request->file('bukti_lampiran')->store('bukti_perizinan', 'public');
        }

        Perizinan::create([
            'user_id'         => Auth::id(),
            'kegiatan_id'     => $request->kegiatan_id,
            'jenis_izin'      => $request->jenis_izin,
            'tanggal_mulai'   => Carbon::parse($request->tanggal_mulai)->format('Y-m-d H:i:s'),
            'tanggal_selesai' => Carbon::parse($request->tanggal_selesai)->format('Y-m-d H:i:s'),
            'alasan'          => $request->alasan,
            'bukti_lampiran'  => $buktiPath,
            'status'          => 'Menunggu'
        ]);

        return back()->with('success', 'Pengajuan izin berhasil dikirim!');
    })->name('anggota.perizinan.store');

    Route::get('/rapor', function () { return view('anggota.rapor'); })->name('anggota.rapor');
    Route::get('/profil', function () { return view('anggota.profil'); })->name('anggota.profil');
});


// ==============================================
// 4. ROUTE PJ GEDUNG (Khusus PJ Gedung & Admin)
// ==============================================
Route::middleware(['auth', 'can:pj-or-admin'])->prefix('pj_gedung')->group(function () {

    Route::get('/dashboard', function () {
        $userId = Auth::id();

        $kegiatans = Kegiatan::latest()->get()->map(function($kegiatan) use ($userId) {
            $kegiatan->data_presensi = Presensi::where('kegiatan_id', $kegiatan->id)
                                        ->where('user_id', $userId)
                                        ->latest()
                                        ->first();
            return $kegiatan;
        });

        $riwayats = Presensi::with('kegiatan')->where('user_id', $userId)->latest()->take(5)->get();

        return view('pj.dashboard', compact('kegiatans', 'riwayats'));
    })->name('pj.dashboard');

    Route::post('/presensi/store', function (Request $request) {
        $request->validate([
            'kegiatan_id' => 'required',
            'status'      => 'required',
            'bukti'       => 'required|file' 
        ]);

        $buktiPath = '';
        if ($request->hasFile('bukti')) {
            $buktiPath = $request->file('bukti')->store('bukti_presensi', 'public');
        }

        $presensi = new Presensi();
        $presensi->user_id = Auth::id();
        $presensi->kegiatan_id = $request->kegiatan_id;
        $presensi->status_kehadiran = $request->status;
        $presensi->bukti = $buktiPath;
        $presensi->status_verifikasi = 'Disetujui';
        $presensi->save();

        return redirect()->route('pj.dashboard')->with('success', 'Presensi berhasil dikirim & otomatis terverifikasi!');
    })->name('pj.presensi.store');

    Route::get('/verifikasi', [PjController::class, 'verifikasi'])->name('pj.verifikasi');
    Route::post('/verifikasi/{id}/approve', [PjController::class, 'approve'])->name('pj.verifikasi.approve');
    Route::post('/verifikasi/{id}/reject', [PjController::class, 'reject'])->name('pj.verifikasi.reject');

    Route::get('/perizinan', function () {
        $userId = Auth::id();
        $riwayat_izin = Perizinan::where('user_id', $userId)->latest()->get();
        $riwayats = $riwayat_izin; 
        $kegiatans = Kegiatan::latest()->get();

        return view('pj.perizinan', compact('riwayat_izin', 'riwayats', 'kegiatans'));
    })->name('pj.perizinan');

    Route::post('/perizinan/store', function (Request $request) {
        $request->validate([
            'kegiatan_id'     => 'nullable',
            'jenis_izin'      => 'required',
            'tanggal_mulai'   => 'required',
            'tanggal_selesai' => 'required',
            'alasan'          => 'required',
            'bukti_lampiran'  => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $buktiPath = null;
        if ($request->hasFile('bukti_lampiran')) {
            $buktiPath = $request->file('bukti_lampiran')->store('bukti_perizinan', 'public');
        }

        Perizinan::create([
            'user_id'         => Auth::id(),
            'kegiatan_id'     => $request->kegiatan_id,
            'jenis_izin'      => $request->jenis_izin,
            'tanggal_mulai'   => Carbon::parse($request->tanggal_mulai)->format('Y-m-d H:i:s'),
            'tanggal_selesai' => Carbon::parse($request->tanggal_selesai)->format('Y-m-d H:i:s'),
            'alasan'          => $request->alasan,
            'bukti_lampiran'  => $buktiPath,
            'status'          => 'Menunggu'
        ]);

        return back()->with('success', 'Pengajuan izin berhasil dikirim ke Admin!');
    })->name('pj.perizinan.store');

    Route::get('/riwayat', function () {
        $semua_riwayat = Presensi::with('kegiatan')->latest()->get();
        return view('pj.riwayat', compact('semua_riwayat'));
    })->name('pj.riwayat');

    Route::get('/rapor', function () { return view('pj.rapor'); })->name('pj.rapor');
    Route::get('/profil', function () { return view('pj.profil'); })->name('pj.profil');
});