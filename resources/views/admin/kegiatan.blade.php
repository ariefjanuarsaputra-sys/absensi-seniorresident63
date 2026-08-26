<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kegiatan - Senior Resident</title>
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
            <h5 class="fw-bold mb-0">Kelola Agenda Kegiatan</h5>
            <div class="fw-semibold text-secondary">Admin</div>
        </header>

        <main class="p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="fw-bold text-dark mb-1">Daftar Agenda & Kegiatan</h4>
                    <p class="text-muted small mb-0">Atur jadwal kegiatan wajib dan rutinitas Senior Resident.</p>
                </div>
                <button class="btn btn-primary fw-semibold" style="background: var(--primary);" data-bs-toggle="modal" data-bs-target="#modalTambahKegiatan">
                    <i class="bi bi-plus-lg me-1"></i> Buat Kegiatan Baru
                </button>
            </div>

            <div class="card card-custom overflow-hidden">
                <div class="table-responsive">
                    <table class="table table-custom mb-0">
                        <thead>
                            <tr>
                                <th>Nama Kegiatan</th>
                                <th>Waktu Mulai</th>
                                <th>Waktu Selesai</th>
                                <th>Lokasi</th>
                                <th>Toleransi Absen</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kegiatans ?? [] as $k)
                                @php
                                    $rawMulai = data_get($k, 'tanggal_mulai');
                                    $rawSelesai = data_get($k, 'tanggal_selesai');

                                    $mulai = $rawMulai ? \Carbon\Carbon::parse($rawMulai)->format('d M Y, H:i') : '-';
                                    $selesai = $rawSelesai ? \Carbon\Carbon::parse($rawSelesai)->format('d M Y, H:i') : '-';
                                @endphp
                                <tr>
                                    <td><div class="fw-bold text-dark">{{ data_get($k, 'nama_kegiatan', '-') }}</div></td>
                                    <td><span class="text-dark fw-medium">{{ $mulai }} WIB</span></td>
                                    <td><span class="text-dark fw-medium">{{ $selesai }} WIB</span></td>
                                    <td>{{ data_get($k, 'lokasi', '-') }}</td>
                                    <td><span class="badge bg-secondary-subtle text-secondary border">{{ data_get($k, 'toleransi', '15 Menit') }}</span></td>
                                    <td class="text-end">
                                        <button class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-pencil-square"></i></button>
                                        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-5">Belum ada agenda kegiatan yang dibuat.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal Tambah Kegiatan -->
    <div class="modal fade" id="modalTambahKegiatan" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 style-card" style="border-radius: 16px;">
                <div class="modal-header border-bottom">
                    <h5 class="modal-title fw-bold">Tambah Kegiatan Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.kegiatan.store') }}" method="POST">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="form-label fw-semibold small">Nama Kegiatan</label>
                            <input type="text" name="nama_kegiatan" class="form-control" required placeholder="Contoh: Pembekalan Senior Resident">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold small">Tanggal & Jam Mulai</label>
                            <input type="datetime-local" name="tanggal_mulai" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold small">Tanggal & Jam Selesai</label>
                            <input type="datetime-local" name="tanggal_selesai" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold small">Lokasi</label>
                            <input type="text" name="lokasi" class="form-control" required placeholder="Contoh: Aula Gedung Utama">
                        </div>
                    </div>
                    <div class="modal-footer border-top">
                        <button type="button" class="btn btn-light fw-semibold" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary fw-semibold" style="background: var(--primary);">Simpan Agenda</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>