<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — YaariBlog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #003F5C 0%, #0A1628 60%, #002D42 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            position: relative;
            overflow: hidden;
        }

        /* Ambient glow effect */
        body::before {
            content: '';
            position: absolute;
            top: -30%;
            left: 50%;
            transform: translateX(-50%);
            width: 700px;
            height: 700px;
            background: radial-gradient(circle, rgba(168,216,200,0.08) 0%, transparent 65%);
            pointer-events: none;
        }

        .login-card {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.10);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 2.8rem 2.4rem;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 25px 60px rgba(0,0,0,0.5);
            position: relative;
            z-index: 1;
        }

        .login-logo {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-logo .logo-icon {
            width: 72px;
            height: 72px;
            background: linear-gradient(135deg, #A8D8C8, #87B6A6);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.2rem;
            font-size: 2rem;
            color: #003F5C;
            box-shadow: 0 10px 25px rgba(168,216,200,0.4);
        }

        .login-logo h1 {
            color: #F1F5F9;
            font-size: 1.6rem;
            font-weight: 800;
            letter-spacing: -0.5px;
        }

        .login-logo h1 span { color: #A8D8C8; }

        .login-logo p {
            color: #64748B;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .form-label {
            color: #94A3B8;
            font-size: 0.82rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.4rem;
            display: block;
        }

        .form-group { margin-bottom: 1.2rem; }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #475569;
            font-size: 0.9rem;
        }

        .form-input {
            width: 100%;
            padding: 0.85rem 1rem 0.85rem 2.8rem;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.10);
            border-radius: 12px;
            color: #F1F5F9;
            font-family: 'Inter', sans-serif;
            font-size: 0.95rem;
            outline: none;
            transition: all 0.25s;
        }

        .form-input::placeholder { color: #475569; }

        .form-input:focus {
            border-color: #A8D8C8;
            background: rgba(255,255,255,0.09);
            box-shadow: 0 0 0 3px rgba(168,216,200,0.18);
        }

        .form-input.is-invalid { border-color: #EF4444; }

        .error-text {
            color: #F87171;
            font-size: 0.8rem;
            margin-top: 0.4rem;
            display: block;
        }

        .remember-row {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .remember-row input[type="checkbox"] { accent-color: #A8D8C8; width: 16px; height: 16px; }
        .remember-row label { color: #64748B; font-size: 0.875rem; cursor: pointer; }

        .btn-login {
            width: 100%;
            padding: 0.9rem;
            background: linear-gradient(135deg, #A8D8C8, #87B6A6);
            border: none;
            border-radius: 12px;
            color: #003F5C;
            font-family: 'Inter', sans-serif;
            font-size: 1rem;
            font-weight: 800;
            cursor: pointer;
            transition: all 0.25s;
            letter-spacing: 0.3px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(168,216,200,0.45);
        }

        .btn-login:active { transform: translateY(0); }

        .alert-box {
            background: rgba(239,68,68,0.12);
            border: 1px solid rgba(239,68,68,0.3);
            border-radius: 10px;
            padding: 0.85rem 1rem;
            margin-bottom: 1.4rem;
            color: #FCA5A5;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .success-box {
            background: rgba(16,185,129,0.12);
            border: 1px solid rgba(16,185,129,0.3);
            border-radius: 10px;
            padding: 0.85rem 1rem;
            margin-bottom: 1.4rem;
            color: #6EE7B7;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .back-link {
            text-align: center;
            margin-top: 1.5rem;
        }

        .back-link a {
            color: #475569;
            font-size: 0.875rem;
            text-decoration: none;
            transition: color 0.2s;
        }

        .back-link a:hover { color: #A8D8C8; }
    </style>
</head>
<body>

<div class="login-card">
    {{-- ── Logo ── --}}
    <div class="login-logo">
        <div class="logo-icon">
            <i class="fas fa-user-shield"></i>
        </div>
        <h1>Yaari<span>Blog</span></h1>
        <p>Admin Panel — Sign in to continue</p>
    </div>

    {{-- ── Flash Messages ── --}}
    @if(session('success'))
        <div class="success-box">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert-box">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
        </div>
    @endif

    {{-- ── Login Form ── --}}
    <form method="POST" action="{{ route('admin.login.post') }}">
        @csrf

        {{-- Email --}}
        <div class="form-group">
            <label class="form-label" for="email">Email Address</label>
            <div class="input-wrapper">
                <i class="fas fa-envelope"></i>
                <input
                    type="email"
                    id="email"
                    name="email"
                    class="form-input {{ $errors->has('email') ? 'is-invalid' : '' }}"
                    value="{{ old('email') }}"
                    placeholder="admin@yaariblog.com"
                    required
                    autofocus
                    autocomplete="email"
                >
            </div>
            @error('email')
                <span class="error-text"><i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}</span>
            @enderror
        </div>

        {{-- Password --}}
        <div class="form-group">
            <label class="form-label" for="password">Password</label>
            <div class="input-wrapper">
                <i class="fas fa-lock"></i>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-input {{ $errors->has('password') ? 'is-invalid' : '' }}"
                    placeholder="Enter your password"
                    required
                    autocomplete="current-password"
                >
            </div>
            @error('password')
                <span class="error-text"><i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}</span>
            @enderror
        </div>

        {{-- Remember Me --}}
        <div class="remember-row">
            <input type="checkbox" id="remember" name="remember">
            <label for="remember">Remember me</label>
        </div>

        <button type="submit" class="btn-login">
            <i class="fas fa-sign-in-alt me-2"></i> Sign In
        </button>
    </form>

    <div class="back-link">
        <a href="{{ route('blogs.index') }}">← Back to public site</a>
    </div>
</div>

</body>
</html>
