<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Presensi — Senior Resident</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root { --primary: #6366f1; --primary-gradient: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%); --bg-body: #090d16; }
        body { background-color: var(--bg-body); font-family: 'Plus Jakarta Sans', sans-serif; color: #f8fafc; padding-bottom: 90px; }
        .app-container { max-width: 480px; margin: 0 auto; background: #0f172a; min-height: 100vh; padding: 20px 18px; position: relative; }
        .card-custom { background: #1e293b; border: 1px solid #334155; border-radius: 20px; padding: 18px; box-shadow: 0 4px 20px -2px rgba(0,0,0,0.25); margin-bottom: 18px; color: #f8fafc; }
        .badge-status { font-size: 0.72rem; font-weight: 700; padding: 6px 12px; border-radius: 100px; display: inline-flex; align-items: center; }
        .badge-warning-custom { background: rgba(245, 158, 11, 0.2); color: #fbbf24; border: 1px solid rgba(245, 158, 11, 0.3); }
        .badge-success-custom { background: rgba(16, 185, 129, 0.2); color: #34d399; border: 1px solid rgba(16, 185, 129, 0.3); }
        .badge-danger-custom { background: rgba(239, 68, 68, 0.2); color: #f87171; border: 1px solid rgba(239, 68, 68, 0.3); }
        .bottom-nav-container { position: fixed; bottom: 16px; left: 50%; transform: translateX(-50%); width: 100%; max-width: 480px; padding: 0 16px; z-index: 1000; }
        .bottom-nav { background: rgba(30, 41, 59, 0.85); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 100px; display: flex; justify-content: space-around; padding: 8px 6px; box-shadow: 0 10px 30px rgba(0,0,0,0.5); }
        .nav-link-custom { text-align: center; color: #94a3b8; text-decoration: none; font-size: 0.68rem; font-weight: 600; width: 20%; padding: 6px 0; border-radius: 100px; transition: all 0.2s; }
        .nav-link-custom i { font-size: 1.25rem; display: block; margin-bottom: 2px; }
        .nav-link-custom.active { color: #ffffff; background: var(--primary); font-weight: 700; }
    </style>
</head>
<body>

    <div class="app-container">
        <!-- Top Header -->
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h5 class="fw-bold mb-0 text-white">Riwayat Presensi</h5>
            <a href="{{ route('anggota.profil') }}">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=6366f1&color=fff&bold=true" class="rounded-circle border border-2 border-indigo shadow-sm" width="38" height="38" alt="Profile">
            </a>
        </div>

        <div class="card card-custom p-2">
            <div class="list-group list-group-flush">
                @forelse($semua_riwayat as $riwayat)
                    <div class="list-group-item d-flex align-items-center justify-content-between border-0 px-2 py-3 bg-transparent text-white">
                        <div class="d-flex align-items-center gap-3">
                            <i class="bi bi-journal-text text-indigo fs-5" style="color: #818cf8;"></i>
                            <div>
                                <h6 class="fw-semibold mb-0 text-white" style="font-size: 0.85rem;">{{ $riwayat->kegiatan->nama_kegiatan ?? 'Kegiatan Telah Dihapus' }}</h6>
                                <small class="text-slate-400" style="font-size: 0.72rem; color: #94a3b8;">{{ \Carbon\Carbon::parse($riwayat->created_at)->translatedFormat('d M Y • H:i') }} WIB</small>
                            </div>
                        </div>
                        <div>
                            @if($riwayat->status_verifikasi == 'Disetujui') 
                                <span class="badge-status badge-success-custom">{{ $riwayat->status_kehadiran }}</span>
                            @elseif($riwayat->status_verifikasi == 'Menunggu Verifikasi') 
                                <span class="badge-status badge-warning-custom">Pending</span>
                            @else 
                                <span class="badge-status badge-danger-custom">Ditolak</span> 
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="text-center text-slate-400 py-5 small">Kamu belum pernah mengisi absensi.</div>
                @endforelse
            </div>
        </div>

        @include('anggota.navigasi')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>