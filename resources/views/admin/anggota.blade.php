<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Anggota - Senior Resident</title>
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
            <h5 class="fw-bold mb-0">Data Anggota & PJ Gedung</h5>
            <div class="fw-semibold text-secondary">Admin</div>
        </header>

        <main class="p-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="fw-bold text-dark mb-1">Manajemen Pengguna</h4>
                    <p class="text-muted small mb-0">Kelola data seluruh Anggota dan Penanggung Jawab (PJ) Gedung.</p>
                </div>
                <button class="btn btn-primary fw-semibold" style="background: var(--primary);" data-bs-toggle="modal" data-bs-target="#modalTambahAnggota">
                    <i class="bi bi-person-plus-fill me-1"></i> Tambah Anggota
                </button>
            </div>

            <div class="card card-custom overflow-hidden">
                <div class="table-responsive">
                    <table class="table table-custom mb-0">
                        <thead>
                            <tr>
                                <th>Nama / NIM</th>
                                <th>Peran (Role)</th>
                                <th>Gedung & Kamar</th>
                                <th>Email</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($anggotas ?? [] as $user)
                                @php
                                    $userRole = strtolower(data_get($user, 'role', ''));
                                @endphp
                                <tr>
                                    <td>
                                        <div class="fw-bold text-dark">{{ data_get($user, 'name', '-') }}</div>
                                        <small class="text-muted">{{ data_get($user, 'nim', '-') }}</small>
                                    </td>
                                    <td>
                                        @if(in_array($userRole, ['pj_gedung', 'pj gedung', 'pj']))
                                            <span class="badge bg-primary-subtle text-primary border px-2 py-1">PJ Gedung</span>
                                        @elseif($userRole == 'admin')
                                            <span class="badge bg-danger-subtle text-danger border px-2 py-1">Admin</span>
                                        @else
                                            <span class="badge bg-light text-dark border px-2 py-1">Anggota</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="fw-medium text-dark">{{ data_get($user, 'gedung', 'Gedung A') }}</span>
                                        <small class="text-muted d-block">Kamar {{ data_get($user, 'kamar', '-') }}</small>
                                    </td>
                                    <td>{{ data_get($user, 'email', '-') }}</td>
                                    <td class="text-end">
                                        <button class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="modal" data-bs-target="#modalEditAnggota{{ $user->id }}"><i class="bi bi-pencil"></i></button>
                                        <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalHapusAnggota{{ $user->id }}"><i class="bi bi-trash"></i></button>
                                    </td>
                                </tr>

                                <!-- Modal Edit Anggota -->
                                <div class="modal fade" id="modalEditAnggota{{ $user->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content border-0" style="border-radius: 16px;">
                                            <div class="modal-header border-bottom">
                                                <h5 class="modal-title fw-bold">Edit Data Anggota</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('admin.anggota.update', $user->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body p-4 text-start">
                                                    <div class="mb-3">
                                                        <label class="form-label fw-semibold small">Nama Lengkap</label>
                                                        <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-semibold small">NIM</label>
                                                        <input type="text" name="nim" class="form-control" value="{{ $user->nim }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-semibold small">Email</label>
                                                        <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-semibold small">Password Baru (Opsional)</label>
                                                        <input type="password" name="password" class="form-control" placeholder="Biarkan kosong jika tidak diubah">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-semibold small">Peran</label>
                                                        <select name="role" class="form-select" required>
                                                            <option value="anggota" {{ $userRole == 'anggota' ? 'selected' : '' }}>Anggota Resident</option>
                                                            <option value="pj_gedung" {{ in_array($userRole, ['pj_gedung', 'pj gedung', 'pj']) ? 'selected' : '' }}>PJ Gedung</option>
                                                            <option value="admin" {{ $userRole == 'admin' ? 'selected' : '' }}>Admin</option>
                                                        </select>
                                                    </div>
                                                    <div class="row g-2 mb-3">
                                                        <div class="col-6">
                                                            <label class="form-label fw-semibold small">Gedung</label>
                                                            <input type="text" name="gedung" class="form-control" value="{{ $user->gedung }}">
                                                        </div>
                                                        <div class="col-6">
                                                            <label class="form-label fw-semibold small">Nomor Kamar</label>
                                                            <input type="text" name="kamar" class="form-control" value="{{ $user->kamar }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer border-top">
                                                    <button type="button" class="btn btn-light fw-semibold" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary fw-semibold" style="background: var(--primary);">Simpan Perubahan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Hapus Anggota -->
                                <div class="modal fade" id="modalHapusAnggota{{ $user->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content border-0" style="border-radius: 16px;">
                                            <div class="modal-header border-bottom">
                                                <h5 class="modal-title fw-bold">Konfirmasi Hapus</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body p-4 text-start">
                                                Apakah Anda yakin ingin menghapus data <strong>{{ $user->name }}</strong>?
                                            </div>
                                            <div class="modal-footer border-top">
                                                <button type="button" class="btn btn-light fw-semibold" data-bs-dismiss="modal">Batal</button>
                                                <form action="{{ route('admin.anggota.destroy', $user->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger fw-semibold">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-5">Belum ada data anggota tersimpan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal Tambah Anggota -->
    <div class="modal fade" id="modalTambahAnggota" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0" style="border-radius: 16px;">
                <div class="modal-header border-bottom">
                    <h5 class="modal-title fw-bold">Tambah Anggota / PJ Gedung</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.anggota.store') }}" method="POST">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="form-label fw-semibold small">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" required placeholder="Nama Lengkap">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold small">NIM</label>
                            <input type="text" name="nim" class="form-control" required placeholder="Nomor Induk Mahasiswa">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold small">Email</label>
                            <input type="email" name="email" class="form-control" required placeholder="Email Aktif">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold small">Password</label>
                            <input type="password" name="password" class="form-control" required placeholder="Minimal 6 Karakter">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold small">Peran</label>
                            <select name="role" class="form-select" required>
                                <option value="anggota">Anggota Resident</option>
                                <option value="pj_gedung">PJ Gedung</option>
                            </select>
                        </div>
                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <label class="form-label fw-semibold small">Gedung</label>
                                <select name="gedung" class="form-select" required>
                                    <option value="Gedung A">Gedung A</option>
                                    <option value="Gedung B">Gedung B</option>
                                    <option value="Gedung C">Gedung C</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label class="form-label fw-semibold small">Nomor Kamar</label>
                                <input type="text" name="kamar" class="form-control" required placeholder="Contoh: 102">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top">
                        <button type="button" class="btn btn-light fw-semibold" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary fw-semibold" style="background: var(--primary);">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>