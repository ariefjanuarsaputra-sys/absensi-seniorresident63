<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perizinan — Senior Resident</title>
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
        
        .form-control, .form-select { background-color: #0f172a !important; border-color: #334155 !important; color: #ffffff !important; }
        .form-control:focus, .form-select:focus { border-color: #6366f1 !important; box-shadow: 0 0 0 0.25rem rgba(99, 102, 241, 0.25); }
        input[type="datetime-local"]::-webkit-calendar-picker-indicator { filter: invert(1); }
    </style>
</head>
<body>

    <div class="app-container">
        <!-- Top Header -->
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h5 class="fw-bold mb-0 text-white">Pengajuan Izin</h5>
            <a href="{{ route('anggota.profil') }}">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=6366f1&color=fff&bold=true" class="rounded-circle border border-2 border-indigo shadow-sm" width="38" height="38" alt="Profile">
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-3 border-0 rounded-4 shadow-sm" style="background: rgba(16, 185, 129, 0.2); color: #34d399;" role="alert">
                <small class="fw-semibold"><i class="bi bi-check-circle-fill me-1"></i> {{ session('success') }}</small>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Form Card -->
        <div class="card card-custom p-4 mb-4">
            <h6 class="fw-bold mb-3 d-flex align-items-center gap-2 text-white"><i class="bi bi-file-earmark-plus text-indigo fs-5" style="color:#818cf8;"></i> Form Perizinan Baru</h6>
            
            <form action="{{ route('anggota.perizinan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-slate-300">Jenis Perizinan</label>
                    <select name="jenis_izin" class="form-select rounded-3 py-2" required>
                        <option value="" selected disabled>-- Pilih Jenis Izin --</option>
                        <option value="Izin Kegiatan">Tidak Ikut Kegiatan</option>
                        <option value="Izin Bermalam">Bermalam di Luar Asrama</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-semibold text-slate-300">Pilih Kegiatan (Opsional)</label>
                    <select name="kegiatan_id" class="form-select rounded-3 py-2">
                        <option value="" selected>-- Tanpa Kegiatan / Bermalam --</option>
                        @foreach($kegiatans as $kegiatan)
                            <option value="{{ $kegiatan->id }}">{{ $kegiatan->nama_kegiatan }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="row g-2 mb-3">
                    <div class="col-6">
                        <label class="form-label small fw-semibold text-slate-300">Waktu Mulai</label>
                        <input type="datetime-local" name="tanggal_mulai" class="form-control rounded-3" required>
                    </div>
                    <div class="col-6">
                        <label class="form-label small fw-semibold text-slate-300">Waktu Selesai</label>
                        <input type="datetime-local" name="tanggal_selesai" class="form-control rounded-3" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-semibold text-slate-300">Alasan / Keterangan</label>
                    <textarea name="alasan" class="form-control rounded-3" rows="3" placeholder="Jelaskan alasan perizinan kamu..." required></textarea>
                </div>

                <div class="mb-4">
                    <label class="form-label small fw-semibold text-slate-300">Upload Bukti Lampiran (Opsional)</label>
                    <input type="file" name="bukti_lampiran" class="form-control rounded-3" accept="image/*,.pdf">
                    <small class="text-slate-400 d-block mt-1" style="font-size: 0.68rem; color:#94a3b8;">Format: JPG, PNG, PDF (Maks. 2MB)</small>
                </div>

                <button type="submit" class="btn btn-primary w-100 rounded-3 py-2 fw-semibold shadow-sm" style="background: var(--primary-gradient); border: none;">
                    <i class="bi bi-send-fill me-1"></i> Kirim Permohonan Izin
                </button>
            </form>
        </div>

        <!-- Riwayat Card -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="fw-bold mb-0 text-white">Riwayat Perizinan Saya</h6>
            <span class="badge bg-slate-800 text-slate-300 rounded-pill px-2 py-1">{{ count($riwayat_izin) }}</span>
        </div>

        <div class="card card-custom p-3">
            @forelse($riwayat_izin as $izin)
                <div class="d-flex justify-content-between align-items-center py-2 border-bottom border-slate-700">
                    <div class="d-flex gap-3 align-items-center">
                        <div class="p-2 rounded-3 text-indigo" style="background: rgba(99, 102, 241, 0.2); color:#818cf8;">
                            <i class="bi bi-envelope-open fs-5"></i>
                        </div>
                        <div>
                            <span class="d-block fw-bold small text-white">{{ $izin->jenis_izin }}</span>
                            <small class="text-slate-400 d-block" style="font-size: 0.7rem; color:#94a3b8;">
                                {{ \Carbon\Carbon::parse($izin->tanggal_mulai)->translatedFormat('d M Y • H:i') }} - 
                                {{ \Carbon\Carbon::parse($izin->tanggal_selesai)->translatedFormat('d M Y • H:i') }}
                            </small>
                            <small class="text-slate-400 d-block mt-1" style="font-size: 0.72rem; color:#94a3b8;">
                                <em>"{{ $izin->alasan }}"</em>
                            </small>
                        </div>
                    </div>
                    <div>
                        @if($izin->status == 'Disetujui')
                            <span class="badge-status badge-success-custom">Disetujui</span>
                        @elseif($izin->status == 'Ditolak')
                            <span class="badge-status badge-danger-custom">Ditolak</span>
                        @else
                            <span class="badge-status badge-warning-custom">Pending</span>
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-center py-4 text-slate-400">
                    <i class="bi bi-inbox fs-2 d-block mb-1 text-slate-500 opacity-50"></i>
                    <small>Belum ada riwayat perizinan.</small>
                </div>
            @endforelse
        </div>

        @include('anggota.navigasi')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>