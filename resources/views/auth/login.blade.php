<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Academic Portal</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        html, body {
            width: 100%;
            overflow-x: hidden;
        }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #edf4ff 0%, #f8fbff 100%);
            min-height: 100dvh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px 12px;
            -webkit-text-size-adjust: 100%;
        }

        .auth-card {
            width: 100%;
            max-width: 480px;
            background: #fff;
            border-radius: 22px;
            box-shadow: 0 20px 50px rgba(15, 23, 42, 0.10);
            padding: 30px 24px;
        }

        .auth-logo {
            width: 74px;
            height: 74px;
            border-radius: 50%;
            background: #e9f5ff;
            color: #2b99d6;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.7rem;
            font-weight: 700;
            margin: 0 auto 18px;
        }

        .auth-title {
            text-align: center;
            font-size: 1.8rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 8px;
        }

        .auth-subtitle {
            text-align: center;
            color: #6b7280;
            margin-bottom: 24px;
        }

        .form-label {
            font-weight: 600;
            color: #6b7280;
            margin-bottom: 8px;
            font-size: 0.92rem;
        }

        .form-control {
            min-height: 48px;
            border-radius: 12px;
            border: 1px solid #dbe3ee;
            box-shadow: none !important;
            font-size: 16px;
            padding: 12px 14px;
        }

        .form-control:focus {
            border-color: #2b99d6;
        }

        .link-custom {
            color: #2b99d6;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.92rem;
        }

        .link-custom:hover {
            text-decoration: underline;
        }

        .btn-login {
            min-height: 48px;
            border: none;
            border-radius: 12px;
            background: #111827;
            color: white;
            font-weight: 700;
            width: 100%;
        }

        .btn-login:hover {
            background: #000;
        }

        @media (max-width: 576px) {
            body {
                padding: 12px;
            }

            .auth-card {
                padding: 24px 16px;
                border-radius: 18px;
            }

            .auth-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>

<div class="auth-card">
    <div class="auth-logo">A</div>

    <h1 class="auth-title">Login</h1>
    <p class="auth-subtitle">Sign in to continue to the Academic Portal.</p>

    <form action="#" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" placeholder="Enter your username" required>
        </div>

        <div class="mb-2">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="text-end mb-4">
            <a href="/forgotPassword" class="link-custom">Forgot Password?</a>
        </div>

        <button type="submit" class="btn btn-login">Login</button>
    </form>
</div>

</body>
</html>
