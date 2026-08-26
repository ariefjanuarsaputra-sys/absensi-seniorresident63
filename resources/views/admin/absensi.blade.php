<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring Absensi - Senior Resident</title>
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
        .table-custom thead th { background-color: #f8fafc; color: #64748b; font-size: 0.75rem; text-transform: uppercase; font-weight: 700; padding: 0.875rem 1.25rem; }
        .table-custom tbody td { padding: 1rem 1.25rem; font-size: 0.875rem; vertical-align: middle; }
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
            <h5 class="fw-bold mb-0">Monitoring Absensi Anggota</h5>
            <div class="fw-semibold text-secondary">Admin</div>
        </header>

        <main class="p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="fw-bold text-dark mb-1">Status Absensi Real-Time</h4>
                    <p class="text-muted small mb-0">Pantau kehadiran anggota, verifikasi PJ Gedung, dan daftar yang belum absen.</p>
                </div>
            </div>

            <!-- Filter Panel -->
            <div class="card card-custom p-3 mb-4">
                <form method="GET" action="{{ route('admin.absensi') }}" class="row g-3 align-items-end">
                    <div class="col-md-5">
                        <label class="form-label small fw-semibold">Pilih Kegiatan</label>
                        <select name="kegiatan_id" class="form-select">
                            @foreach($kegiatans ?? [] as $kegiatan)
                                @php
                                    $mulaiRaw = data_get($kegiatan, 'tanggal_mulai');
                                    $selesaiRaw = data_get($kegiatan, 'tanggal_selesai');

                                    $mulai = $mulaiRaw ? \Carbon\Carbon::parse($mulaiRaw)->format('d M, H:i') : data_get($kegiatan, 'tanggal', '-');
                                    $selesai = $selesaiRaw ? \Carbon\Carbon::parse($selesaiRaw)->format('d M, H:i') : '-';
                                    
                                    $labelWaktu = $selesaiRaw ? "{$mulai} s.d {$selesai} WIB" : "{$mulai} WIB";
                                @endphp
                                <option value="{{ data_get($kegiatan, 'id') }}" {{ request('kegiatan_id') == data_get($kegiatan, 'id') ? 'selected' : '' }}>
                                    {{ data_get($kegiatan, 'nama_kegiatan') }} ({{ $labelWaktu }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small fw-semibold">Filter Gedung / PJ</label>
                        <select name="gedung" class="form-select">
                            <option value="">-- Semua Gedung --</option>
                            @php
                                $daftarGedung = ['A1', 'A2', 'A3', 'A4', 'A5', 'C1', 'C3', 'SED1', 'SED2'];
                            @endphp
                            @foreach($daftarGedung as $g)
                                <option value="{{ $g }}" {{ request('gedung') == $g ? 'selected' : '' }}>{{ $g }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary w-100 fw-semibold" style="background: var(--primary);">
                            <i class="bi bi-funnel-fill me-1"></i> Tampilkan
                        </button>
                    </div>
                </form>
            </div>

            <!-- Table Status Absensi -->
            <div class="card card-custom overflow-hidden">
                <div class="table-responsive">
                    <table class="table table-custom mb-0">
                        <thead>
                            <tr>
                                <th>Nama Anggota</th>
                                <th>Gedung & PJ</th>
                                <th>Waktu Absen</th>
                                <th>Status Absensi</th>
                                <th>Verifikasi PJ Gedung</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($absens ?? [] as $item)
                                <tr>
                                    <td>
                                        <div class="fw-bold text-dark">{{ data_get($item, 'user.name', '-') }}</div>
                                        <small class="text-muted">{{ data_get($item, 'user.nim', '-') }}</small>
                                    </td>
                                    <td>
                                        <div class="fw-semibold text-dark">{{ data_get($item, 'user.gedung', '-') }}</div>
                                        <small class="text-muted">PJ: {{ data_get($item, 'user.pj_gedung', '-') }}</small>
                                    </td>
                                    <td>
                                        @if(data_get($item, 'waktu_absen'))
                                            <span class="fw-medium text-dark"><i class="bi bi-clock me-1 text-primary"></i>{{ data_get($item, 'waktu_absen') }} WIB</span>
                                        @else
                                            <span class="text-muted small">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if(data_get($item, 'status_absen') == 'Hadir')
                                            <span class="badge bg-success-subtle text-success border px-2 py-1">Hadir</span>
                                        @elseif(data_get($item, 'status_absen') == 'Izin')
                                            <span class="badge bg-warning-subtle text-warning border px-2 py-1">Izin</span>
                                        @else
                                            <span class="badge bg-danger-subtle text-danger border px-2 py-1">Belum Absen</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if(data_get($item, 'status_verifikasi') == 'Disetujui')
                                            <span class="badge bg-success text-white px-2 py-1"><i class="bi bi-check-circle me-1"></i> Diverifikasi PJ</span>
                                        @elseif(data_get($item, 'status_absen') == 'Belum Absen')
                                            <span class="badge bg-secondary-subtle text-secondary border px-2 py-1">Tidak Ada Data</span>
                                        @else
                                            <span class="badge bg-warning-subtle text-warning border px-2 py-1"><i class="bi bi-hourglass-split me-1"></i> Menunggu PJ</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-5">
                                        <i class="bi bi-card-checklist fs-2 d-block mb-2 text-secondary"></i>
                                        Tidak ada data anggota ditemukan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>