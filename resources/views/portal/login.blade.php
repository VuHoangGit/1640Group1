<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Student Portal</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        * {
            box-sizing: border-box;
        }

        html, body {
            width: 100%;
            overflow-x: hidden;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f4f7fe;
            margin: 0;
            min-height: 100dvh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            -webkit-text-size-adjust: 100%;
        }

        img,
        svg,
        canvas {
            max-width: 100%;
            height: auto;
        }

        input,
        select,
        textarea,
        .form-control,
        .form-select {
            font-size: 16px !important;
        }

        .auth-shell {
            width: 100%;
            max-width: 1120px;
        }

        .auth-card {
            background: #fff;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 12px 40px rgba(15, 23, 42, 0.08);
        }

        .auth-row {
            min-height: 700px;
        }

        .auth-visual {
            background: linear-gradient(180deg, #eef5ff 0%, #f7fbff 100%);
            padding: 36px 32px;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }

        .back-button {
            position: absolute;
            top: 24px;
            left: 24px;
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: #ffffff;
            color: #2b99d6;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            box-shadow: 0 6px 16px rgba(43, 153, 214, 0.14);
            transition: 0.2s ease;
        }

        .back-button:hover {
            background: #2b99d6;
            color: #fff;
        }

        .visual-brand {
            padding-top: 70px;
        }

        .brand-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 10px 16px;
            border-radius: 999px;
            background: #ffffff;
            color: #2b99d6;
            font-weight: 600;
            font-size: 14px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.05);
        }

        .visual-title {
            font-size: 2rem;
            line-height: 1.25;
            font-weight: 700;
            color: #162033;
            margin: 22px 0 12px;
        }

        .visual-desc {
            color: #6b7280;
            font-size: 15px;
            max-width: 420px;
            margin-bottom: 24px;
        }

        .visual-illustration-wrap {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px 0 0;
        }

        .visual-illustration {
            max-width: 92%;
            width: 100%;
            max-height: 360px;
            object-fit: contain;
        }

        .auth-form {
            padding: 44px 52px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100%;
        }

        .top-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 28px;
            flex-wrap: wrap;
        }

        .portal-text {
            color: #8b95a7;
            font-size: 13px;
            word-break: break-word;
        }

        .mini-brand {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-weight: 700;
            color: #2b99d6;
            font-size: 14px;
        }

        .logo-wrap {
            text-align: center;
            margin-bottom: 30px;
        }

        .university-logo {
            width: 84px;
            height: auto;
            margin-bottom: 18px;
            object-fit: contain;
        }

        .portal-title {
            font-size: 1.9rem;
            font-weight: 700;
            color: #162033;
            margin-bottom: 8px;
        }

        .portal-subtitle {
            color: #2b99d6;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 1px;
            margin-bottom: 0;
        }

        .alert {
            border: 0;
            border-radius: 14px;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 22px;
        }

        .form-label-custom {
            display: block;
            margin-bottom: 10px;
            color: #6b7280;
            font-size: 13px;
            font-weight: 600;
        }

        .form-control {
            border: 1px solid #dbe4f0;
            background: #fff;
            border-radius: 14px;
            min-height: 52px;
            padding: 12px 16px;
            color: #111827;
            box-shadow: none !important;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .form-control:focus {
            border-color: #2b99d6;
            box-shadow: 0 0 0 4px rgba(43, 153, 214, 0.10) !important;
        }

        .form-links {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            margin-top: -4px;
            margin-bottom: 22px;
            gap: 10px;
            flex-wrap: wrap;
        }

        .form-links a {
            text-decoration: none;
            color: #6b7280;
            font-size: 14px;
            font-weight: 500;
        }

        .form-links a:hover {
            color: #2b99d6;
        }

        .btn-signin {
            width: 100%;
            border: none;
            background: #2b99d6;
            color: #fff;
            min-height: 52px;
            border-radius: 14px;
            font-weight: 700;
            letter-spacing: 0.3px;
            transition: 0.2s ease;
        }

        .btn-signin:hover {
            background: #217db3;
            transform: translateY(-1px);
        }

        @media (max-width: 991.98px) {
            body {
                padding: 18px;
                align-items: stretch;
            }

            .auth-card {
                border-radius: 20px;
            }

            .auth-row {
                min-height: auto;
            }

            .auth-visual {
                padding: 32px 24px 20px;
            }

            .visual-brand {
                padding-top: 62px;
            }

            .visual-title {
                font-size: 1.7rem;
            }

            .auth-form {
                padding: 36px 28px;
            }
        }

        @media (max-width: 767.98px) {
            body {
                padding: 0;
                display: block;
            }

            .auth-shell {
                max-width: 100%;
            }

            .auth-card {
                min-height: 100dvh;
                border-radius: 0;
                box-shadow: none;
            }

            .auth-visual {
                padding: 24px 18px 18px;
            }

            .back-button {
                top: 18px;
                left: 18px;
                width: 40px;
                height: 40px;
                font-size: 20px;
            }

            .visual-brand {
                padding-top: 56px;
            }

            .brand-badge {
                font-size: 13px;
                padding: 8px 14px;
            }

            .visual-title {
                font-size: 1.45rem;
                margin-top: 18px;
            }

            .visual-desc {
                font-size: 14px;
                margin-bottom: 18px;
            }

            .visual-illustration {
                max-width: 80%;
                max-height: 240px;
            }

            .auth-form {
                padding: 24px 18px 30px;
            }

            .top-meta {
                margin-bottom: 22px;
                gap: 10px;
            }

            .portal-title {
                font-size: 1.55rem;
            }
        }

        @media (max-width: 575.98px) {
            .auth-visual {
                padding: 22px 14px 16px;
            }

            .auth-form {
                padding: 22px 14px 28px;
            }

            .top-meta {
                flex-direction: column;
                align-items: flex-start;
            }

            .portal-text {
                text-align: left;
            }

            .logo-wrap {
                margin-bottom: 24px;
            }

            .university-logo {
                width: 72px;
            }

            .visual-illustration {
                max-width: 86%;
            }

            .form-group {
                margin-bottom: 18px;
            }

            .form-control,
            .btn-signin {
                min-height: 50px;
            }
        }
    </style>
</head>
<body>
    <div class="auth-shell">
        <div class="auth-card">
            <div class="row g-0 auth-row">
                <div class="col-lg-6 auth-visual">
                    <a href="#" class="back-button">
                        <i class="bi bi-arrow-left"></i>
                    </a>

                    <div class="visual-brand">
                        <div class="brand-badge">
                            <i class="bi bi-mortarboard-fill"></i>
                            Academic Portal
                        </div>

                        <h1 class="visual-title">Welcome back to the university portal</h1>
                        <p class="visual-desc">
                            Sign in to access your academic workspace, manage your account, and continue using the system securely.
                        </p>
                    </div>

                    <div class="visual-illustration-wrap">
                        <img src="https://tse4.mm.bing.net/th/id/OIP.Vz3Ijf4o6TBKRvx2gZiqDwHaB2?rs=1&pid=ImgDetMain&o=7&rm=3" alt="Illustration" class="visual-illustration">
                    </div>
                </div>

                <div class="col-lg-6 auth-form">
                    <div class="top-meta">
                        <div class="mini-brand">
                            <i class="bi bi-mortarboard-fill"></i>
                            ACADEMIC
                        </div>
                        <div class="portal-text">🌐 www.universityname.ac.in</div>
                    </div>

                    <div class="logo-wrap">
                        <img src="https://tse4.mm.bing.net/th/id/OIP.Vz3Ijf4o6TBKRvx2gZiqDwHaB2?rs=1&pid=ImgDetMain&o=7&rm=3" alt="Logo" class="university-logo">
                        <h2 class="portal-title">UNIVERSITY PORTAL</h2>
                        <p class="portal-subtitle">LOGIN PANEL</p>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success text-center py-3 mb-3" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger py-3 mb-3" role="alert">
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li style="margin-bottom: 4px;">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- @if(Session::has('fail'))
                        <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                        @endif() --}}

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <label class="form-label-custom">Email</label>
                            <input type="text" name="email" class="form-control" placeholder="" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label-custom">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="" required>
                        </div>

                        <div class="form-links">
                            <a href="{{ route('forgotPassword') }}">Forgot Password?</a>
                        </div>

                        <button type="submit" class="btn-signin">Sign in</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
