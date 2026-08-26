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
        :root {
            --bg-app: #0a0f1d;
            --card-bg: #161f33;
            --box-bg: #0d1424;
            --primary-purple: #6366f1;
            --accent-purple: #818cf8;
            --text-muted: #94a3b8;
            --danger-red: #ef4444;
        }
        body {
            background-color: var(--bg-app);
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #f8fafc;
            padding-bottom: 110px;
        }
        .app-container {
            max-width: 480px;
            margin: 0 auto;
            background: var(--bg-app);
            min-height: 100vh;
            padding: 24px 18px;
            position: relative;
        }

        /* Top Header */
        .page-header-title {
            font-size: 1.5rem;
            font-weight: 800;
            color: #ffffff;
            margin: 0;
        }
        .role-subtitle {
            font-size: 0.82rem;
            font-weight: 700;
            color: #ffffff;
        }

        /* Main Profile Card */
        .profile-card {
            background: var(--card-bg);
            border-radius: 28px;
            padding: 32px 20px 24px 20px;
            border: 1px solid rgba(255, 255, 255, 0.05);
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }
        .avatar-circle {
            width: 90px;
            height: 90px;
            background: linear-gradient(135deg, #6366f1 0%, #7c3aed 100%);
            color: #ffffff;
            font-size: 2.2rem;
            font-weight: 800;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px auto;
            box-shadow: 0 8px 20px rgba(99, 102, 241, 0.35);
        }
        .user-fullname {
            font-size: 1.35rem;
            font-weight: 800;
            color: #ffffff;
            margin-bottom: 2px;
        }
        .user-email {
            font-size: 0.88rem;
            font-weight: 600;
            color: var(--accent-purple);
            margin-bottom: 20px;
        }
        .user-subinfo {
            font-size: 0.82rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 24px;
        }

        /* Info Item Box */
        .info-box {
            background: var(--box-bg);
            border-radius: 16px;
            padding: 18px 20px;
            margin-bottom: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid rgba(255, 255, 255, 0.03);
        }
        .info-label {
            color: var(--text-muted);
            font-size: 0.88rem;
            font-weight: 600;
        }
        .info-value {
            color: #ffffff;
            font-size: 0.95rem;
            font-weight: 800;
            letter-spacing: 0.3px;
        }

        /* Logout Button */
        .btn-logout {
            background: transparent;
            border: 1px solid var(--danger-red);
            color: var(--danger-red);
            border-radius: 16px;
            padding: 14px;
            font-weight: 800;
            font-size: 0.95rem;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.2s ease;
            margin-top: 20px;
        }
        .btn-logout:hover, .btn-logout:active {
            background: rgba(239, 68, 68, 0.15);
            color: #f87171;
            border-color: #f87171;
        }

        /* Styles Navigasi Bottom Floating Dock */
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
            background: rgba(22, 31, 51, 0.9);
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
            background: #6366f1;
            font-weight: 700;
        }
    </style>
</head>
<body>

    <div class="app-container">
        <!-- Top Header -->
        <div class="d-flex align-items-center justify-content-between mb-4 px-1">
            <h4 class="page-header-title">Profil Saya</h4>
            <span class="role-subtitle">Senior Resident</span>
        </div>

        @php
            $userName = auth()->user()->name ?? 'Arief Januar Saputra';
            $words = explode(' ', trim($userName));
            $initials = strtoupper(substr($words[0], 0, 1) . (count($words) > 1 ? substr(end($words), 0, 1) : ''));
        @endphp

        <!-- Profile Main Card -->
        <div class="profile-card text-center">
            <!-- Avatar Circle -->
            <div class="avatar-circle">
                {{ $initials }}
            </div>

            <!-- Name & Email -->
            <h5 class="user-fullname">{{ $userName }}</h5>
            <p class="user-email">{{ auth()->user()->email ?? 'ajs_24arief@apps.ipb.ac.id' }}</p>

            <!-- Sub Information Row -->
            <div class="d-flex justify-content-around user-subinfo px-2">
                <span>Angkatan {{ auth()->user()->angkatan ?? '61' }}</span>
                <span>Lini: {{ auth()->user()->lini ?? 'PJ Gedung ' . (auth()->user()->gedung ?? 'C3') }}</span>
            </div>

            <!-- Detail Data List -->
            <div class="info-box">
                <span class="info-label">NIM</span>
                <span class="info-value">{{ auth()->user()->nim ?? 'G2401241033' }}</span>
            </div>

            <div class="info-box">
                <span class="info-label">Gedung / Kamar</span>
                <span class="info-value">{{ auth()->user()->gedung ?? 'C3' }} / {{ auth()->user()->kamar ?? '244' }}</span>
            </div>

            <div class="info-box">
                <span class="info-label">Departemen</span>
                <span class="info-value">{{ auth()->user()->departemen ?? 'Geofisika dan Meteorologi/FMIPA' }}</span>
            </div>

            <!-- Logout Form -->
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-logout">
                    <i class="bi bi-box-arrow-right fs-5"></i> Keluar dari Akun
                </button>
            </form>
        </div>

        <!-- Navigation Dock Include -->
        @include('pj.navigasi')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>