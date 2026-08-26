<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Presensi — Senior Resident</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #6366f1;
            --primary-gradient: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            --bg-body: #090d16;
            --card-bg: #1e293b;
        }
        
        body { 
            background-color: var(--bg-body); 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            color: #f8fafc; 
            padding-bottom: 90px; 
        }

        a { text-decoration: none !important; }

        .app-container { 
            max-width: 480px; 
            margin: 0 auto; 
            background: #0f172a; 
            min-height: 100vh; 
            padding: 20px 18px; 
            position: relative; 
        }

        .card-custom { 
            background: var(--card-bg); 
            border: 1px solid #334155; 
            border-radius: 20px; 
            padding: 18px; 
            box-shadow: 0 4px 20px -2px rgba(0,0,0,0.25); 
            margin-bottom: 18px; 
            color: #f8fafc; 
        }

        .verifikasi-item { 
            border-bottom: 1px solid rgba(255, 255, 255, 0.08); 
            padding: 14px 0; 
        }
        .verifikasi-item:last-child { border-bottom: none; }

        .btn-action { 
            width: 38px; 
            height: 38px; 
            display: inline-flex; 
            align-items: center; 
            justify-content: center; 
            border-radius: 12px; 
            transition: transform 0.1s; 
        }
        .btn-action:active { transform: scale(0.95); }

        .nav-pills-custom .nav-link { 
            color: #94a3b8; 
            font-weight: 700; 
            border-radius: 100px; 
            font-size: 0.72rem; 
            padding: 8px 10px; 
            border: 1px solid rgba(255, 255, 255, 0.08); 
            background: #0d1424; 
        }
        .nav-pills-custom .nav-link.active { 
            background: var(--primary-gradient); 
            color: #ffffff; 
            border-color: transparent; 
        }

        /* Floating Bottom Navigation Dock */
        .bottom-nav-container { 
            position: fixed; 
            bottom: 16px; 
            left: 50%; 
            transform: translateX(-50%); 
            width: 100%; 
            max-width: 480px; 
            padding: 0 16px; 
            z-index: 1000; 
        }
        .bottom-nav { 
            background: rgba(30, 41, 59, 0.85); 
            backdrop-filter: blur(16px); 
            -webkit-backdrop-filter: blur(16px); 
            border: 1px solid rgba(255, 255, 255, 0.1); 
            border-radius: 100px; 
            display: flex; 
            justify-content: space-around; 
            padding: 8px 6px; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.5); 
        }
        .nav-link-custom { 
            text-align: center; 
            color: #94a3b8 !important; 
            text-decoration: none !important; 
            font-size: 0.68rem; 
            font-weight: 600; 
            width: 20%; 
            padding: 6px 0; 
            border-radius: 100px; 
            transition: all 0.2s; 
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .nav-link-custom i { 
            font-size: 1.25rem; 
            display: block; 
            margin-bottom: 2px; 
        }
        .nav-link-custom.active { 
            color: #ffffff !important; 
            background: var(--primary); 
            font-weight: 700; 
        }
    </style>
</head>
<body>

    <div class="app-container">
        <!-- Header Gedung PJ -->
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h5 class="fw-bold mb-0 text-white">Verifikasi Presensi</h5>
                <small style="font-size:0.75rem; color:#94a3b8;">
                    Gedung {{ auth()->user()->gedung ?? '-' }} • Penanggung Jawab
                </small>
            </div>
            <a href="{{ route('pj.verifikasi') }}" class="btn rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; background: #1e293b; border: 1px solid #334155; color: #fff;">
                <i class="bi bi-arrow-clockwise fs-6"></i>
            </a>
        </div>

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="alert alert-success border-0 rounded-4 shadow-sm py-2 px-3 small mb-3" style="background: rgba(16, 185, 129, 0.2); color: #34d399;" role="alert">
                <i class="bi bi-check-circle-fill me-1"></i> {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger border-0 rounded-4 shadow-sm py-2 px-3 small mb-3" style="background: rgba(239, 68, 68, 0.2); color: #f87171;" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-1"></i> {{ session('error') }}
            </div>
        @endif

        <!-- Card Container Tabs -->
        <div class="card card-custom p-3">
            <ul class="nav nav-pills nav-pills-custom nav-justified mb-3 gap-1" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active w-100" id="pills-menunggu-tab" data-bs-toggle="pill" data-bs-target="#pills-menunggu" type="button" role="tab">
                        Pending ({{ $menunggu->count() }})
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link w-100" id="pills-disetujui-tab" data-bs-toggle="pill" data-bs-target="#pills-disetujui" type="button" role="tab">
                        Disetujui ({{ $disetujui->count() }})
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link w-100" id="pills-ditolak-tab" data-bs-toggle="pill" data-bs-target="#pills-ditolak" type="button" role="tab">
                        Ditolak ({{ $ditolak->count() }})
                    </button>
                </li>
            </ul>

            <div class="tab-content" id="pills-tabContent">

                <!-- TAB PENDING -->
                <div class="tab-pane fade show active" id="pills-menunggu" role="tabpanel">
                    @forelse($menunggu as $item)
                        @php
                            $namaUser = optional($item->user)->name ?? optional($item->user)->nama ?? 'Anggota ID #'.$item->user_id;
                            $nimUser  = optional($item->user)->nim ?? 'NIM -';
                            $kamarUser = optional($item->user)->kamar ?? '-';
                            $namaKegiatan = optional($item->kegiatan)->nama_kegiatan ?? 'Kegiatan Presensi';
                        @endphp
                        <div class="verifikasi-item">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div class="d-flex align-items-center gap-2">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($namaUser) }}&background=6366f1&color=fff&bold=true" class="rounded-circle" width="36" height="36" alt="Avatar">
                                    <div>
                                        <span class="d-block fw-bold text-white" style="font-size: 0.85rem;">{{ $namaUser }}</span>
                                        <span class="d-block" style="font-size: 0.7rem; color:#94a3b8;">
                                            {{ $nimUser }} • Kamar {{ $kamarUser }}
                                        </span>
                                    </div>
                                </div>
                                <span class="badge rounded-pill fw-bold" style="background: rgba(245, 158, 11, 0.2); color: #fbbf24; border: 1px solid rgba(245, 158, 11, 0.3); font-size: 0.65rem;">Pending</span>
                            </div>

                            <div class="mb-2" style="font-size: 0.75rem; color: #a5b4fc;">
                                <i class="bi bi-calendar-event me-1"></i> {{ $namaKegiatan }}
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-2">
                                @if(!empty($item->bukti))
                                    <a href="{{ asset('storage/' . $item->bukti) }}" target="_blank" class="btn btn-sm rounded-pill px-3 py-1 fw-semibold" style="background: rgba(99, 102, 241, 0.2); color: #818cf8; font-size: 0.72rem; border: 1px solid rgba(99, 102, 241, 0.3);">
                                        <i class="bi bi-image me-1"></i> Lihat Bukti
                                    </a>
                                @else
                                    <span class="small" style="font-size: 0.72rem; color:#94a3b8;">Tidak ada foto</span>
                                @endif

                                <div class="d-flex gap-2">
                                    <form action="{{ route('pj.verifikasi.approve', $item->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-action border-0 shadow-sm" style="background: rgba(16, 185, 129, 0.2); color: #34d399; border: 1px solid rgba(16, 185, 129, 0.3);" title="Setujui">
                                            <i class="bi bi-check-lg fs-6"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('pj.verifikasi.reject', $item->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-action border-0 shadow-sm" style="background: rgba(239, 68, 68, 0.2); color: #f87171; border: 1px solid rgba(239, 68, 68, 0.3);" title="Tolak">
                                            <i class="bi bi-x-lg fs-6"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4">
                            <i class="bi bi-check-all fs-1 opacity-50 mb-1 d-block" style="color: #818cf8;"></i>
                            <p class="small mb-0 fw-medium" style="color:#94a3b8;">Tidak ada permohonan pending.</p>
                        </div>
                    @endforelse
                </div>

                <!-- TAB DISETUJUI -->
                <div class="tab-pane fade" id="pills-disetujui" role="tabpanel">
                    @forelse($disetujui as $item)
                        @php
                            $namaUser = optional($item->user)->name ?? optional($item->user)->nama ?? 'Anggota ID #'.$item->user_id;
                            $waktu = $item->updated_at ? $item->updated_at->diffForHumans() : '-';
                        @endphp
                        <div class="verifikasi-item">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <div class="d-flex align-items-center gap-2">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($namaUser) }}&background=10b981&color=fff&bold=true" class="rounded-circle" width="36" height="36" alt="Avatar">
                                    <div>
                                        <span class="d-block fw-bold text-white" style="font-size: 0.85rem;">{{ $namaUser }}</span>
                                        <span class="d-block" style="font-size: 0.7rem; color:#94a3b8;">Disetujui: {{ $waktu }}</span>
                                    </div>
                                </div>
                                <span class="badge rounded-pill fw-bold" style="background: rgba(16, 185, 129, 0.2); color: #34d399; font-size: 0.65rem;">
                                    <i class="bi bi-check-circle-fill me-1"></i> Disetujui
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4 small" style="color:#94a3b8;">Belum ada presensi yang disetujui.</div>
                    @endforelse
                </div>

                <!-- TAB DITOLAK -->
                <div class="tab-pane fade" id="pills-ditolak" role="tabpanel">
                    @forelse($ditolak as $item)
                        @php
                            $namaUser = optional($item->user)->name ?? optional($item->user)->nama ?? 'Anggota ID #'.$item->user_id;
                            $waktu = $item->updated_at ? $item->updated_at->diffForHumans() : '-';
                        @endphp
                        <div class="verifikasi-item">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <div class="d-flex align-items-center gap-2">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($namaUser) }}&background=ef4444&color=fff&bold=true" class="rounded-circle" width="36" height="36" alt="Avatar">
                                    <div>
                                        <span class="d-block fw-bold text-white" style="font-size: 0.85rem;">{{ $namaUser }}</span>
                                        <span class="d-block" style="font-size: 0.7rem; color:#94a3b8;">Ditolak: {{ $waktu }}</span>
                                    </div>
                                </div>
                                <span class="badge rounded-pill fw-bold" style="background: rgba(239, 68, 68, 0.2); color: #f87171; font-size: 0.65rem;">
                                    <i class="bi bi-x-circle-fill me-1"></i> Ditolak
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4 small" style="color:#94a3b8;">Belum ada presensi yang ditolak.</div>
                    @endforelse
                </div>

            </div>
        </div>

        <!-- Floating Navigation Dock Include -->
        @include('pj.navigasi')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>