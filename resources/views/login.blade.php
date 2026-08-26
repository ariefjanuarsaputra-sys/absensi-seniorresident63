<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Senior Resident</title>
    <!-- Font & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        :root {
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --bg-gradient: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #312e81 100%);
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg-gradient);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
        }
        .login-card {
            border-radius: 24px;
            border: 1px solid rgba(255, 255, 255, 0.15);
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.35);
            width: 100%;
            max-width: 420px;
        }
        .brand-icon {
            width: 56px;
            height: 56px;
            background: linear-gradient(135deg, #6366f1, #4f46e5);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 800;
            font-size: 1.35rem;
            margin: 0 auto 1.25rem;
            box-shadow: 0 10px 25px rgba(79, 70, 229, 0.35);
        }
        .form-control {
            border-radius: 12px;
            padding: 0.75rem 1rem;
            border: 1px solid #e2e8f0;
            font-size: 0.9rem;
            background-color: #f8fafc;
        }
        .form-control:focus {
            background-color: #fff;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.12);
        }
        .input-group-text {
            border-radius: 12px;
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            color: #94a3b8;
        }
        .btn-primary {
            background-color: var(--primary);
            border: none;
            border-radius: 12px;
            padding: 0.8rem;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.2s ease;
        }
        .btn-primary:hover {
            background-color: var(--primary-hover);
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(79, 70, 229, 0.35);
        }
        .btn-toggle-password {
            cursor: pointer;
            border-left: none;
        }
    </style>
</head>
<body>

    <div class="login-card p-4 p-sm-5">
        <!-- Logo & Header -->
        <div class="text-center">
            <div class="brand-icon">SR</div>
            <h4 class="fw-bold text-dark mb-1">Selamat Datang</h4>
            <p class="text-muted small mb-4">Masuk ke sistem absensi Senior Resident</p>
        </div>

        <!-- Alert Error -->
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show border-0 rounded-3 small mb-4" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                {{ $errors->first() }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Form Login -->
        <form action="{{ route('login') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label class="form-label small fw-semibold text-secondary">Alamat Email</label>
                <div class="input-group">
                    <span class="input-group-text border-end-0"><i class="bi bi-envelope-fill"></i></span>
                    <input type="email" name="email" class="form-control border-start-0 ps-0" placeholder="nama@sr.com" value="{{ old('email') }}" required autofocus>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label small fw-semibold text-secondary">Password</label>
                <div class="input-group">
                    <span class="input-group-text border-end-0"><i class="bi bi-lock-fill"></i></span>
                    <input type="password" id="passwordInput" name="password" class="form-control border-start-0 border-end-0 ps-0" placeholder="••••••••" required>
                    <span class="input-group-text btn-toggle-password" onclick="togglePassword()">
                        <i class="bi bi-eye-slash-fill" id="toggleIcon"></i>
                    </span>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100 fw-bold">
                Masuk ke Akun <i class="bi bi-arrow-right-short ms-1 fs-5 align-middle"></i>
            </button>
        </form>

        <div class="text-center mt-4">
            <small class="text-muted" style="font-size: 0.75rem;">&copy; {{ date('Y') }} Senior Resident Attendance System</small>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('passwordInput');
            const toggleIcon = document.getElementById('toggleIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('bi-eye-slash-fill');
                toggleIcon.classList.add('bi-eye-fill');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('bi-eye-fill');
                toggleIcon.classList.add('bi-eye-slash-fill');
            }
        }
    </script>
</body>
</html>