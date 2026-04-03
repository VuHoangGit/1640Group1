<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login via Phone | Academic Portal</title>

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
            background: linear-gradient(135deg, #eef6ff 0%, #f9fbff 100%);
            min-height: 100dvh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px 12px;
            -webkit-text-size-adjust: 100%;
        }

        .auth-card {
            width: 100%;
            max-width: 500px;
            background: white;
            border-radius: 22px;
            box-shadow: 0 20px 50px rgba(15, 23, 42, 0.10);
            padding: 30px 24px;
        }

        .auth-title {
            text-align: center;
            font-size: 1.75rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 10px;
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

        .send-btn {
            min-height: 48px;
            white-space: nowrap;
            border-radius: 12px;
            padding: 0 16px;
        }

        .error-text {
            color: #dc3545;
            font-size: 0.92rem;
            margin: 0 0 18px;
        }

        .confirm-btn {
            min-height: 48px;
            width: 100%;
            border: none;
            border-radius: 12px;
            background: #111827;
            color: white;
            font-weight: 700;
        }

        .confirm-btn:hover {
            background: #000;
        }

        @media (max-width: 576px) {
            .auth-card {
                padding: 24px 16px;
                border-radius: 18px;
            }

            .auth-title {
                font-size: 1.5rem;
            }

            .phone-row {
                flex-direction: column;
            }

            .phone-row .send-btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>

<div class="auth-card">
    <h1 class="auth-title">Login</h1>
    <p class="auth-subtitle">Use your phone number and confirmation code.</p>

    <form action="#" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Phone number</label>
            <div class="d-flex gap-2 phone-row">
                <input type="text" name="phone" class="form-control w-100">
                <button type="button" class="btn btn-outline-dark send-btn">Send code</button>
            </div>
        </div>

        <div class="mb-3">
            <input type="text" name="otp" class="form-control" placeholder="Enter confirmation code">
        </div>

        <p class="error-text">Your phone number or code is incorrect</p>

        <div class="text-center">
            <button type="submit" class="confirm-btn">Confirm</button>
        </div>
    </form>
</div>

</body>
</html>
