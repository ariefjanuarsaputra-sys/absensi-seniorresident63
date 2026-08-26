<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Senior Resident</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root { --primary: #4f46e5; --sidebar-bg: #0f172a; --bg-main: #f8fafc; --card-border: #f1f5f9; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: var(--bg-main); color: #334155; }
        .sidebar { width: 270px; background-color: var(--sidebar-bg); min-height: 100vh; position: fixed; top: 0; left: 0; z-index: 1040; box-shadow: 4px 0 24px rgba(0,0,0,0.04); }
        .brand-logo { padding: 1.5rem; display: flex; align-items: center; gap: 12px; }
        .brand-icon { width: 40px; height: 40px; background: linear-gradient(135deg, #6366f1, #4f46e5); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 800; }
        .nav-section-title { font-size: 0.7rem; text-transform: uppercase; color: #64748b; font-weight: 700; padding: 1.25rem 1.5rem 0.5rem; }
        .sidebar-menu { list-style: none; padding: 0 0.75rem; margin: 0; }
        .sidebar-menu a { color: #94a3b8; text-decoration: none; padding: 0.7rem 1rem; display: flex; align-items: center; gap: 12px; font-size: 0.875rem; border-radius: 8px; font-weight: 500; }
        .sidebar-menu a:hover { color: #f8fafc; background-color: #1e293b; }
        .sidebar-menu a.active { color: #fff; background-color: var(--primary); font-weight: 600; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.25); }
        .main-wrapper { margin-left: 270px; min-height: 100vh; }
        .topbar { height: 70px; background: #fff; border-bottom: 1px solid var(--card-border); padding: 0 2rem; display: flex; align-items: center; justify-content: space-between; }
        .card-custom { border: 1px solid var(--card-border); border-radius: 16px; background: #fff; box-shadow: 0 1px 3px rgba(0,0,0,0.02); }
        .stat-icon { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; }
    </style>
</head>
<body>

    <aside class="sidebar">
        <div class="brand-logo">
            <div class="brand-icon">SR</div>
            <div><h6 class="fw-bold mb-0 text-white">Senior Resident</h6><small style="color: #64748b; font-size: 0.72rem;">Attendance System</small></div>
        </div>
        <div class="nav-section-title">Menu Utama</div>
        <ul class="sidebar-menu">
            <li><a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="bi bi-grid-1x2-fill"></i> Dashboard</a></li>
            <li><a href="{{ route('admin.kegiatan') }}" class="{{ request()->routeIs('admin.kegiatan*') ? 'active' : '' }}"><i class="bi bi-calendar-week-fill"></i> Kegiatan</a></li>
            <li><a href="{{ route('admin.absensi') }}" class="{{ request()->routeIs('admin.absensi*') ? 'active' : '' }}"><i class="bi bi-check-circle-fill"></i> Monitoring Absensi</a></li>
            <li><a href="{{ route('admin.perizinan') }}" class="{{ request()->routeIs('admin.perizinan*') ? 'active' : '' }}"><i class="bi bi-envelope-paper-fill"></i> Perizinan</a></li>
            <li><a href="{{ route('admin.anggota') }}" class="{{ request()->routeIs('admin.anggota*') ? 'active' : '' }}"><i class="bi bi-people-fill"></i> Data Anggota</a></li>
        </ul>
        <div class="nav-section-title">Laporan & Pengaturan</div>
        <ul class="sidebar-menu">
            <li><a href="{{ route('admin.rapor') }}" class="{{ request()->routeIs('admin.rapor*') ? 'active' : '' }}"><i class="bi bi-file-earmark-bar-graph-fill"></i> Rekap & Rapor</a></li>
            <li><a href="{{ route('admin.pengaturan') }}" class="{{ request()->routeIs('admin.pengaturan*') ? 'active' : '' }}"><i class="bi bi-gear-fill"></i> Pengaturan</a></li>
        </ul>
    </aside>

    <div class="main-wrapper">
        <header class="topbar">
            <h5 class="fw-bold mb-0">Dashboard Overview</h5>
            <div class="fw-semibold text-secondary">Admin</div>
        </header>

        <main class="p-4">
            <div class="row g-3 mb-4">
                <div class="col-md-3">
                    <div class="card card-custom p-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="stat-icon bg-primary-subtle text-primary"><i class="bi bi-people-fill"></i></div>
                            <div>
                                <small class="text-muted fw-semibold">Total Anggota</small>
                                <h4 class="fw-bold mb-0">{{ $totalAnggota ?? 0 }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-custom p-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="stat-icon bg-success-subtle text-success"><i class="bi bi-calendar-check-fill"></i></div>
                            <div>
                                <small class="text-muted fw-semibold">Kegiatan Bulan Ini</small>
                                <h4 class="fw-bold mb-0">{{ $kegiatanBulanIni ?? 0 }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-custom p-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="stat-icon bg-warning-subtle text-warning"><i class="bi bi-envelope-paper-fill"></i></div>
                            <div>
                                <small class="text-muted fw-semibold">Izin Pending</small>
                                <h4 class="fw-bold mb-0">{{ $izinPending ?? 0 }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-custom p-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="stat-icon bg-info-subtle text-info"><i class="bi bi-building-fill"></i></div>
                            <div>
                                <small class="text-muted fw-semibold">PJ Gedung</small>
                                <h4 class="fw-bold mb-0">{{ $totalPjGedung ?? 0 }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Grid -->
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="card card-custom p-4">
                        <h6 class="fw-bold text-dark mb-3">Kegiatan Mendatang</h6>
                        <ul class="list-group list-group-flush">
                            @forelse($kegiatanMendatang ?? [] as $kegiatan)
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-3">
                                    <div>
                                        <h6 class="fw-bold text-dark mb-1">{{ data_get($kegiatan, 'nama_kegiatan', '-') }}</h6>
                                        <small class="text-muted">
                                            <i class="bi bi-geo-alt me-1"></i>{{ data_get($kegiatan, 'lokasi', '-') }} | 
                                            <i class="bi bi-clock me-1"></i>{{ data_get($kegiatan, 'tanggal_mulai', '-') }}
                                        </small>
                                    </div>
                                    <span class="badge bg-primary-subtle text-primary border px-3 py-2">{{ data_get($kegiatan, 'tanggal', '-') }}</span>
                                </li>
                            @empty
                                <li class="list-group-item text-center text-muted py-4">Belum ada kegiatan mendatang.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card card-custom p-4">
                        <h6 class="fw-bold text-dark mb-3">Aksi Cepat</h6>
                        <div class="d-grid gap-2">
                            <a href="{{ route('admin.kegiatan') }}" class="btn btn-outline-primary text-start fw-semibold py-2">
                                <i class="bi bi-plus-circle me-2"></i> Tambah Agenda Kegiatan
                            </a>
                            <a href="{{ route('admin.absensi') }}" class="btn btn-outline-secondary text-start fw-semibold py-2">
                                <i class="bi bi-check2-square me-2"></i> Pantau Absensi Real-Time
                            </a>
                            <a href="{{ route('admin.perizinan') }}" class="btn btn-outline-warning text-start fw-semibold py-2">
                                <i class="bi bi-envelope me-2"></i> Tinjau Permohonan Izin
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>