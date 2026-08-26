<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapor Kehadiran — Senior Resident</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root { --primary: #6366f1; --primary-gradient: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%); --bg-body: #090d16; }
        body { background-color: var(--bg-body); font-family: 'Plus Jakarta Sans', sans-serif; color: #f8fafc; padding-bottom: 90px; }
        .app-container { max-width: 480px; margin: 0 auto; background: #0f172a; min-height: 100vh; padding: 20px 18px; position: relative; }
        .card-custom { background: #1e293b; border: 1px solid #334155; border-radius: 20px; padding: 18px; box-shadow: 0 4px 20px -2px rgba(0,0,0,0.25); margin-bottom: 18px; color: #f8fafc; }
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
            <h5 class="fw-bold mb-0 text-white">Rapor Kehadiran</h5>
            <a href="{{ route('anggota.profil') }}">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=6366f1&color=fff&bold=true" class="rounded-circle border border-2 border-indigo shadow-sm" width="38" height="38" alt="Profile">
            </a>
        </div>

        <div class="card card-custom text-center py-5">
            <i class="bi bi-cone-striped text-warning mb-3" style="font-size: 3.5rem;"></i>
            <h5 class="fw-bold text-white mb-2">Coming Soon!</h5>
            <p class="text-slate-400 small px-3 mb-0" style="color: #94a3b8;">Laporan rekapitulasi kehadiran (Rapor) sedang diproses dan hanya akan diterbitkan secara berkala setiap 3 bulan sekali.</p>
        </div>

        @include('anggota.navigasi')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>