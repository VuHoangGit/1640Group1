<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New User | Academic Portal</title>

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
            word-break: break-word;
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

        .btn-submit {
            width: 100%;
            border: none;
            background: #2b99d6;
            color: #fff;
            min-height: 52px;
            border-radius: 14px;
            font-weight: 700;
            letter-spacing: 0.3px;
            text-transform: uppercase;
            margin-top: 8px;
            transition: 0.2s ease;
        }

        .btn-submit:hover {
            background: #217db3;
            transform: translateY(-1px);
        }

        .bottom-link {
            text-align: center;
            margin-top: 22px;
        }

        .bottom-link a {
            color: #6b7280;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
        }

        .bottom-link a:hover {
            color: #2b99d6;
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

            .portal-text {
                text-align: left;
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
                <a href="{{ route('qa_manager.dashboard') }}" class="back-button" title="Back to Dashboard">
                    <i class="bi bi-arrow-left"></i>
                </a>

                <div class="visual-brand">
                    <div class="brand-badge">
                        <i class="bi bi-person-plus-fill"></i>
                        Academic Portal
                    </div>

                    <h1 class="visual-title">Create a new account for the system</h1>
                    <p class="visual-desc">
                        Add a new user profile and assign the correct role while keeping account creation simple and responsive.
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
                    <div class="portal-text">🌐 QA Manager Panel</div>
                </div>

                <div class="mb-4">
                    <h2 class="auth-title">Add new account</h2>
                    <p class="auth-subtitle">Create a new profile in the system.</p>
                </div>

                @if(session('success'))
                    <div class="alert alert-success py-3 mb-3">{{ session('success') }}</div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger py-3 mb-3">
                        <ul class="mb-0 ps-3">
                            @foreach($errors->all() as $error)
                                <li style="margin-bottom: 4px;">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('createNewUser') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-12 col-md-6 form-group">
                            <label class="form-label-custom">Username (Login ID)</label>
                            <input type="text" name="username" class="form-control" placeholder="Ex: trungbee" value="{{ old('username') }}" required>
                        </div>

                        <div class="col-12 col-md-6 form-group">
                            <label class="form-label-custom">Full Name</label>
                            <input type="text" name="fullName" class="form-control" placeholder="Ex: Nguyen Van Trung" value="{{ old('fullName') }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label-custom">Email Address</label>
                        <input type="email" name="email" class="form-control" placeholder="example@university.edu" value="{{ old('email') }}" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label-custom">Initial Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Minimum 5 characters" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label-custom">Assign Role</label>
                        <select name="role" class="form-select {{ $errors->has('role') ? 'is-invalid' : '' }}" required>
                            <option value="" disabled selected>Select a role</option>
                            <option value="Staff" {{ old('role') == 'Staff' ? 'selected' : '' }}>Staff</option>
                            <option value="QACoordinator" {{ old('role') == 'QACoordinator' ? 'selected' : '' }}>QA Coordinator</option>
                            <option value="QAManager" {{ old('role') == 'QAManager' ? 'selected' : '' }}>QA Manager</option>
                            <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>

                    <button type="submit" class="btn-submit">Create Account</button>

                    <div class="bottom-link">
                        <a href="{{ route('qa_manager.dashboard') }}">Cancel and go back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
