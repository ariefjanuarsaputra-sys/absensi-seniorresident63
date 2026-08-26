<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Perizinan - Senior Resident</title>
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
            <h5 class="fw-bold mb-0">Manajemen Perizinan</h5>
            <div class="fw-semibold text-secondary">Admin</div>
        </header>

        <main class="p-4">
            <!-- Alert Notifikasi -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="fw-bold text-dark mb-1">Pengajuan Perizinan Anggota</h4>
                    <p class="text-muted small mb-0">Verifikasi dan kelola permohonan izin atau sakit anggota resident.</p>
                </div>
            </div>

            <div class="card card-custom overflow-hidden">
                <div class="table-responsive">
                    <table class="table table-custom align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Nama / NIM</th>
                                <th>Kegiatan</th>
                                <th>Alasan & Keterangan</th>
                                <th>Periode Izin</th>
                                <th>Dokumentasi</th>
                                <th>Tanggal Pengajuan</th>
                                <th>Status</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($perizinans ?? [] as $izin)
                                <tr>
                                    <td>
                                        <div class="fw-bold text-dark">{{ data_get($izin, 'user.name', data_get($izin, 'nama', '-')) }}</div>
                                        <small class="text-muted">{{ data_get($izin, 'user.nim', data_get($izin, 'nim', '-')) }}</small>
                                    </td>
                                    <td>
                                        <span class="fw-medium text-dark">{{ data_get($izin, 'kegiatan.nama_kegiatan', data_get($izin, 'nama_kegiatan', '-')) }}</span>
                                    </td>
                                    <td>
                                        <div class="fw-semibold text-dark">{{ data_get($izin, 'jenis_izin', '-') }}</div>
                                        <small class="text-muted">{{ data_get($izin, 'alasan', '-') }}</small>
                                    </td>
                                    <td>
                                        @if(data_get($izin, 'tanggal_mulai'))
                                            <div class="small fw-semibold text-primary">
                                                {{ \Carbon\Carbon::parse(data_get($izin, 'tanggal_mulai'))->translatedFormat('d M Y, H:i') }}
                                            </div>
                                            <small class="text-muted d-block line-height-1" style="font-size: 0.7rem;">s/d</small>
                                            <div class="small fw-semibold text-danger">
                                                {{ \Carbon\Carbon::parse(data_get($izin, 'tanggal_selesai'))->translatedFormat('d M Y, H:i') }}
                                            </div>
                                        @else
                                            <span class="text-muted small">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if(data_get($izin, 'bukti_lampiran'))
                                            <a href="{{ asset('storage/' . data_get($izin, 'bukti_lampiran')) }}" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill px-3 py-1" style="font-size: 0.75rem;">
                                                <i class="bi bi-file-earmark-image me-1"></i> Lihat Bukti
                                            </a>
                                        @else
                                            <span class="text-muted small">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <small class="text-muted">{{ \Carbon\Carbon::parse(data_get($izin, 'created_at'))->translatedFormat('d M Y, H:i') }}</small>
                                    </td>
                                    <td>
                                        @if(data_get($izin, 'status') == 'Disetujui')
                                            <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">Disetujui</span>
                                        @elseif(data_get($izin, 'status') == 'Ditolak')
                                            <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-1">Ditolak</span>
                                        @else
                                            <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-2 py-1">Menunggu</span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        @if(data_get($izin, 'status') == 'Menunggu' || data_get($izin, 'status') == 'Pending')
                                            <div class="d-inline-flex gap-1">
                                                <form action="{{ route('admin.perizinan.approve', data_get($izin, 'id', 0)) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-success rounded-2 px-3"><i class="bi bi-check-lg me-1"></i> Setujui</button>
                                                </form>
                                                <form action="{{ route('admin.perizinan.reject', data_get($izin, 'id', 0)) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-2 px-3"><i class="bi bi-x-lg me-1"></i> Tolak</button>
                                                </form>
                                            </div>
                                        @else
                                            <span class="text-muted small">Selesai</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-5">Belum ada pengajuan perizinan.</td>
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