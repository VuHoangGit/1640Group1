<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Security Setup | Academic Portal</title>

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
            min-height: 680px;
        }

        .auth-visual {
            background: linear-gradient(180deg, #eef5ff 0%, #f7fbff 100%);
            padding: 36px 32px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }

        .visual-brand {
            padding-top: 24px;
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
        }

        .mini-brand {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-weight: 700;
            color: #2b99d6;
            font-size: 14px;
        }

        .auth-title {
            font-size: 2rem;
            font-weight: 700;
            color: #162033;
            margin-bottom: 10px;
        }

        .auth-subtitle {
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 4px;
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

        .form-control,
        .form-select {
            border: 1px solid #dbe4f0;
            background: #fff;
            border-radius: 14px;
            min-height: 52px;
            padding: 12px 16px;
            color: #111827;
            box-shadow: none !important;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #2b99d6;
            box-shadow: 0 0 0 4px rgba(43, 153, 214, 0.10) !important;
        }

        .terms-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 14px 16px;
        }

        .btn-submit {
            width: 100%;
            border: none;
            background: #2b99d6;
            color: #fff;
            min-height: 52px;
            border-radius: 14px;
            font-weight: 700;
            letter-spacing: 0.3px;
            margin-top: 8px;
            transition: 0.2s ease;
        }

        .btn-submit:hover {
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

            .auth-card {
                min-height: 100dvh;
                border-radius: 0;
                box-shadow: none;
            }

            .auth-visual {
                padding: 24px 18px 18px;
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

            .auth-title {
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

            .visual-illustration {
                max-width: 86%;
            }

            .form-group {
                margin-bottom: 18px;
            }

            .form-control,
            .form-select,
            .btn-submit {
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
                <div class="visual-brand">
                    <div class="brand-badge">
                        <i class="bi bi-shield-lock-fill"></i>
                        Academic Portal
                    </div>

                    <h1 class="visual-title">Complete your security setup before continuing</h1>
                    <p class="visual-desc">
                        Set a security question and answer to help verify your identity if you ever forget your password.
                    </p>
                </div>

                <div class="visual-illustration-wrap">
                    <img src="https://tse4.mm.bing.net/th/id/OIP.Vz3Ijf4o6TBKRvx2gZiqDwHaB2?rs=1&pid=ImgDetMain&o=7&rm=3" alt="Welcome Illustration" class="visual-illustration">
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

                <div class="mb-4">
                    <h2 class="auth-title">Set up your security question</h2>
                    <p class="auth-subtitle">This will be used to verify your identity when you forget your password.</p>
                </div>

                @if($errors->any())
                    <div class="alert alert-danger py-3 mb-3" role="alert">
                        <ul class="mb-0 ps-3">
                            @foreach($errors->all() as $error)
                                <li style="margin-bottom: 4px;">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('createAuthAnswer') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label class="form-label-custom">Choose a security question</label>
                        <select name="security_question" class="form-select @error('security_question') is-invalid @enderror">
                            <option value="favorite_animal" {{ old('security_question') == 'favorite_animal' ? 'selected' : '' }}>What is your favorite animal?</option>
                            <option value="favorite_color" {{ old('security_question') == 'favorite_color' ? 'selected' : '' }}>What is your favorite color?</option>
                            <option value="child_birth_year" {{ old('security_question') == 'child_birth_year' ? 'selected' : '' }}>What is your child's birth year?</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label-custom">Your answer</label>
                        <input type="text" name="answer" value="{{ old('answer') }}" class="form-control @error('answer') is-invalid @enderror" required>
                    </div>

                    <div class="terms-box mb-3">
                        <div class="form-check mb-0">
                            <input type="checkbox" name="term" id="term" required class="form-check-input">
                            <label for="term" class="form-check-label ms-1">I accept the terms &amp; service</label>
                        </div>
                    </div>

                    <button type="submit" class="btn-submit">Finish Setup</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
