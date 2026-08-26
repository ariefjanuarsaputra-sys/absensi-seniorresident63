<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya — Senior Resident</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root { --primary: #6366f1; --primary-gradient: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%); --bg-body: #090d16; }
        body { background-color: var(--bg-body); font-family: 'Plus Jakarta Sans', sans-serif; color: #f8fafc; padding-bottom: 90px; }
        .app-container { max-width: 480px; margin: 0 auto; background: #0f172a; min-height: 100vh; padding: 20px 18px; position: relative; }
        .card-custom { background: #1e293b; border: 1px solid #334155; border-radius: 24px; padding: 20px; box-shadow: 0 4px 20px -2px rgba(0,0,0,0.25); margin-bottom: 18px; color: #f8fafc; }
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
            <h5 class="fw-bold mb-0 text-white">Profil Saya</h5>
            <span class="badge bg-slate-800 text-slate-300 rounded-pill px-3 py-2" style="font-size:0.7rem;">Senior Resident</span>
        </div>

        <div class="card card-custom text-center pt-4 pb-4">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=6366f1&color=fff&bold=true&size=128" class="rounded-circle shadow-sm mx-auto mb-3 border border-3 border-indigo" width="84" height="84" alt="Profile">
            <h5 class="fw-bold mb-0 text-white">{{ auth()->user()->name }}</h5>
            <p class="text-indigo small fw-semibold mb-3" style="color: #818cf8;">{{ auth()->user()->email }}</p>

            <div class="d-flex justify-content-center gap-2 mb-4">
                <span class="badge bg-slate-800 text-slate-300 px-3 py-2 rounded-pill" style="font-size: 0.72rem;">Angkatan {{ auth()->user()->angkatan ?? '-' }}</span>
                <span class="badge bg-slate-800 text-slate-300 px-3 py-2 rounded-pill" style="font-size: 0.72rem;">Lini: {{ auth()->user()->lini ?? '-' }}</span>
            </div>

            <div class="px-2 text-start">
                <div class="p-3 mb-2 rounded-3 d-flex justify-content-between align-items-center" style="background: #0f172a;">
                    <small class="text-slate-400 fw-medium" style="color:#94a3b8;">NIM</small>
                    <span class="fw-bold text-white">{{ auth()->user()->nim }}</span>
                </div>
                <div class="p-3 mb-2 rounded-3 d-flex justify-content-between align-items-center" style="background: #0f172a;">
                    <small class="text-slate-400 fw-medium" style="color:#94a3b8;">Gedung / Kamar</small>
                    <span class="fw-bold text-white">{{ auth()->user()->gedung ?? '-' }} / {{ auth()->user()->kamar ?? '-' }}</span>
                </div>
                <div class="p-3 mb-4 rounded-3 d-flex justify-content-between align-items-center" style="background: #0f172a;">
                    <small class="text-slate-400 fw-medium" style="color:#94a3b8;">Departemen</small>
                    <span class="fw-bold text-white text-end" style="font-size: 0.8rem; max-width: 60%;">{{ auth()->user()->departemen ?? '-' }}</span>
                </div>
                
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger w-100 rounded-3 py-2 fw-bold">
                        <i class="bi bi-box-arrow-right me-1"></i> Keluar dari Akun
                    </button>
                </form>
            </div>
        </div>

        @include('anggota.navigasi')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>