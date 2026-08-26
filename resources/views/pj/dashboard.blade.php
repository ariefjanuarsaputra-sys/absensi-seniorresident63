<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard PJ Gedung — Senior Resident</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root { --primary: #6366f1; --primary-gradient: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%); --bg-body: #090d16; }
        body { background-color: var(--bg-body); font-family: 'Plus Jakarta Sans', sans-serif; color: #f8fafc; padding-bottom: 90px; }
        .app-container { max-width: 480px; margin: 0 auto; background: #0f172a; min-height: 100vh; padding: 20px 18px; position: relative; }
        .hero-card { background: var(--primary-gradient); border-radius: 24px; padding: 22px; color: #ffffff; position: relative; overflow: hidden; box-shadow: 0 12px 30px -8px rgba(99, 102, 241, 0.5); }
        .hero-card::after { content: ''; position: absolute; right: -20px; bottom: -20px; width: 120px; height: 120px; background: rgba(255,255,255,0.15); border-radius: 50%; filter: blur(10px); }
        .card-custom { background: #1e293b; border: 1px solid #334155; border-radius: 20px; padding: 18px; box-shadow: 0 4px 20px -2px rgba(0,0,0,0.25); margin-bottom: 18px; color: #f8fafc; }
        .badge-status { font-size: 0.72rem; font-weight: 700; padding: 6px 12px; border-radius: 100px; display: inline-flex; align-items: center; gap: 4px; }
        .badge-warning-custom { background: rgba(245, 158, 11, 0.2); color: #fbbf24; border: 1px solid rgba(245, 158, 11, 0.3); }
        .badge-success-custom { background: rgba(16, 185, 129, 0.2); color: #34d399; border: 1px solid rgba(16, 185, 129, 0.3); }
        .badge-danger-custom { background: rgba(239, 68, 68, 0.2); color: #f87171; border: 1px solid rgba(239, 68, 68, 0.3); }
        .bottom-nav-container { position: fixed; bottom: 16px; left: 50%; transform: translateX(-50%); width: 100%; max-width: 480px; padding: 0 16px; z-index: 1000; }
        .bottom-nav { background: rgba(30, 41, 59, 0.85); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 100px; display: flex; justify-content: space-around; padding: 8px 6px; box-shadow: 0 10px 30px rgba(0,0,0,0.5); }
        .nav-link-custom { text-align: center; color: #94a3b8; text-decoration: none; font-size: 0.68rem; font-weight: 600; width: 20%; padding: 6px 0; border-radius: 100px; transition: all 0.2s; }
        .nav-link-custom i { font-size: 1.25rem; display: block; margin-bottom: 2px; }
        .nav-link-custom.active { color: #ffffff; background: var(--primary); font-weight: 700; }
        .btn-primary-gradient { background: var(--primary-gradient); border: none; color: white; font-weight: 600; border-radius: 14px; padding: 10px 16px; }
    </style>
</head>
<body>

    <div class="app-container">
        <!-- Top Header -->
        <div class="d-flex align-items-center justify-content-between mb-3">
            <span class="badge rounded-pill fw-bold" style="background: rgba(99, 102, 241, 0.2); color: #818cf8; font-size: 0.72rem; padding: 8px 12px;">
                <i class="bi bi-building me-1"></i> Penanggung Jawab Gedung
            </span>
            <a href="{{ route('pj.profil') }}">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'PJ Gedung') }}&background=6366f1&color=fff&bold=true" class="rounded-circle border border-2 border-indigo shadow-sm" width="40" height="40" alt="Avatar">
            </a>
        </div>

        <!-- Banner Hero Card -->
        <div class="hero-card mb-4">
            <p class="text-white-50 small mb-0 fw-medium">Pengawas Area</p>
            <h5 class="fw-extrabold mb-1 text-white">{{ auth()->user()->name ?? 'PJ Gedung' }} 👋</h5>
            <div class="d-flex align-items-center gap-2 mt-2">
                <span class="badge fw-semibold" style="background: rgba(255, 255, 255, 0.2); color: #ffffff; font-size: 0.72rem;">
                    <i class="bi bi-geo-alt-fill me-1"></i>Gedung {{ auth()->user()->gedung ?? '-' }}
                </span>
                <span class="badge fw-semibold" style="background: rgba(255, 255, 255, 0.2); color: #ffffff; font-size: 0.72rem;">
                    <i class="bi bi-shield-check me-1"></i>Otoritas Verifikator
                </span>
            </div>
        </div>

        <!-- Alert Success -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 rounded-4 shadow-sm mb-3" style="background: rgba(16, 185, 129, 0.2); color: #34d399;" role="alert">
                <small class="fw-semibold"><i class="bi bi-check-circle-fill me-1"></i> {{ session('success') }}</small>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Section: Agenda Hari Ini -->
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h6 class="fw-bold m-0 text-white">Kegiatan & Presensi PJ</h6>
            <span class="badge bg-slate-800 text-slate-300 rounded-pill px-2 py-1" style="font-size: 0.7rem;">{{ count($kegiatans) }} Agenda</span>
        </div>

        @forelse($kegiatans as $kegiatan)
            <div class="card card-custom">
                <div class="d-flex align-items-start justify-content-between mb-3">
                    <div class="d-flex gap-3">
                        <div style="width: 46px; height: 46px; background: rgba(99, 102, 241, 0.2); color: #818cf8; border-radius: 14px;" class="d-flex align-items-center justify-content-center fs-5 flex-shrink-0">
                            <i class="bi bi-calendar2-check-fill"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1 text-white" style="font-size: 0.92rem;">{{ $kegiatan->nama_kegiatan }}</h6>
                            <p class="text-slate-400 small mb-1" style="font-size: 0.75rem; color: #94a3b8;">
                                <i class="bi bi-clock me-1 text-indigo" style="color:#818cf8;"></i> {{ \Carbon\Carbon::parse($kegiatan->tanggal)->translatedFormat('d M Y • H:i') }} WIB
                            </p>
                            <span class="badge bg-slate-800 text-slate-300 border border-slate-700 fw-normal" style="font-size: 0.68rem;">
                                <i class="bi bi-geo-alt me-1"></i>{{ $kegiatan->lokasi }}
                            </span>
                        </div>
                    </div>
                    <div>
                        @if($kegiatan->data_presensi)
                            <span class="badge-status badge-success-custom"><i class="bi bi-check-circle-fill"></i> Hadir</span>
                        @else
                            <span class="badge-status badge-warning-custom"><i class="bi bi-exclamation-circle-fill"></i> Belum Absen</span>
                        @endif
                    </div>
                </div>

                @if(!$kegiatan->data_presensi)
                    <button class="btn btn-primary-gradient w-100 py-2 small shadow-sm" data-bs-toggle="modal" data-bs-target="#modalAbsen{{ $kegiatan->id }}">
                        <i class="bi bi-camera-fill me-1"></i> Isi Absensi Mandiri (PJ)
                    </button>
                @else
                    <button class="btn bg-slate-800 text-slate-400 w-100 py-2 small rounded-3 fw-semibold border border-slate-700" disabled style="background:#0f172a; color:#94a3b8;">
                        <i class="bi bi-check2-all me-1"></i> Presensi Selesai
                    </button>
                @endif
            </div>

            <!-- MODAL ABSENSI MANDIRI PJ -->
            <div class="modal fade" id="modalAbsen{{ $kegiatan->id }}" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-slate-700 text-white shadow-lg rounded-4" style="background: #1e293b;">
                        <div class="modal-header border-bottom-0 pb-0">
                            <h6 class="modal-title fw-bold text-white">Absensi Mandiri PJ — {{ $kegiatan->nama_kegiatan }}</h6>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <form action="{{ route('pj.presensi.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="kegiatan_id" value="{{ $kegiatan->id }}">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label small fw-semibold text-slate-300">Status Kehadiran</label>
                                    <select name="status" class="form-select text-white rounded-3 py-2" style="background:#0f172a; border-color:#334155;" required>
                                        <option value="Hadir">Hadir</option>
                                        <option value="Izin">Izin</option>
                                        <option value="Sakit">Sakit</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label small fw-semibold text-slate-300">Foto Lampiran / Bukti Dokumentasi</label>
                                    <input type="file" name="bukti" class="form-control text-white rounded-3" style="background:#0f172a; border-color:#334155;" accept="image/*" required>
                                </div>
                            </div>
                            <div class="modal-footer border-top-0 pt-0">
                                <button type="button" class="btn btn-secondary rounded-3 btn-sm px-3" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary-gradient btn-sm px-4">Kirim & Auto Verifikasi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="card card-custom text-center py-4 text-slate-400 small">
                <i class="bi bi-calendar-x fs-2 d-block text-slate-500 opacity-50 mb-1"></i>
                Tidak ada agenda kegiatan aktif hari ini.
            </div>
        @endforelse

        <!-- Section: Riwayat Terbaru -->
        <div class="d-flex align-items-center justify-content-between mb-2 mt-4">
            <h6 class="fw-bold m-0 text-white">Riwayat Absensi Mandiri</h6>
            <a href="#" class="text-indigo text-decoration-none small fw-bold" style="color: #818cf8;">Lihat Semua</a>
        </div>

        <div class="card card-custom p-2">
            <div class="list-group list-group-flush">
                @forelse($riwayats as $riwayat)
                    <div class="list-group-item d-flex align-items-center justify-content-between border-0 px-2 py-2 bg-transparent text-white">
                        <div class="d-flex align-items-center gap-3">
                            <i class="bi bi-journal-check text-indigo fs-5" style="color: #818cf8;"></i>
                            <div>
                                <h6 class="fw-semibold mb-0 text-white" style="font-size: 0.82rem;">{{ optional($riwayat->kegiatan)->nama_kegiatan ?? 'Kegiatan Telah Dihapus' }}</h6>
                                <small class="text-slate-400" style="font-size: 0.7rem; color: #94a3b8;">{{ $riwayat->created_at->translatedFormat('d M Y • H:i') }} WIB</small>
                            </div>
                        </div>
                        <div>
                            @if($riwayat->status_kehadiran == 'Hadir')
                                <span class="badge-status badge-success-custom">Hadir</span>
                            @elseif($riwayat->status_kehadiran == 'Izin')
                                <span class="badge-status badge-warning-custom">Izin</span>
                            @else
                                <span class="badge-status badge-danger-custom">{{ $riwayat->status_kehadiran }}</span>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="text-center text-slate-400 py-3 small">Belum ada riwayat absensi.</div>
                @endforelse
            </div>
        </div>

        @include('pj.navigasi')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>