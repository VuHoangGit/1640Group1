@extends('layouts.app')

@section('content')
<style>
    .welcome-banner {
        background: linear-gradient(135deg, #2b99d6 0%, #63b8e8 100%);
        color: #fff;
        padding: 24px;
        border-radius: 22px;
        box-shadow: 0 10px 24px rgba(43, 153, 214, 0.18);
    }

    .welcome-banner h3 {
        margin: 0;
        font-size: 1.9rem;
        font-weight: 700;
    }

    .welcome-banner p {
        margin: 8px 0 0;
        opacity: 0.96;
        font-size: 15px;
    }

    .dashboard-card {
        border: 0;
        border-radius: 20px;
        box-shadow: 0 8px 24px rgba(15, 23, 42, 0.06);
        height: 100%;
    }

    .dashboard-card .card-body {
        padding: 24px;
    }

    .metric-title {
        color: #64748b;
        font-weight: 700;
        font-size: 13px;
        letter-spacing: 0.4px;
    }

    .metric-value {
        font-size: 2rem;
        font-weight: 700;
        color: #0f172a;
        margin: 12px 0 18px;
    }

    .cta-card {
        border: 0;
        border-radius: 22px;
        box-shadow: 0 8px 24px rgba(15, 23, 42, 0.06);
        overflow: hidden;
    }

    .cta-inner {
        padding: 40px 24px;
    }

    .cta-btn {
        border-radius: 999px;
        padding: 12px 22px;
        font-weight: 700;
    }

    @media (max-width: 991.98px) {
        .welcome-banner h3 {
            font-size: 1.5rem;
        }

        .metric-value {
            font-size: 1.7rem;
        }
    }

    @media (max-width: 575.98px) {
        .welcome-banner,
        .dashboard-card,
        .cta-card {
            border-radius: 16px;
        }

        .welcome-banner {
            padding: 18px;
        }

        .dashboard-card .card-body,
        .cta-inner {
            padding: 18px;
        }

        .cta-btn {
            width: 100%;
        }
    }
</style>

<div class="container-fluid">

    <div class="welcome-banner mb-4">
        <h3>Welcome back, {{ Auth::user()->username ?? 'QA Manager' }}! 👋</h3>
        <p>Ready to share your brilliant ideas with the community?</p>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-12 col-md-6 col-xl-4">
            <div class="card dashboard-card">
                <div class="card-body">
                    <h6 class="metric-title">YOUR TOTAL IDEAS</h6>
                    <h2 class="metric-value">12</h2>
                    <div class="progress" style="height: 8px; border-radius: 999px;">
                        <div class="progress-bar bg-success" style="width: 100%; border-radius: 999px;"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-xl-4">
            <div class="card dashboard-card">
                <div class="card-body">
                    <h6 class="metric-title">GLOBAL ENGAGEMENT</h6>
                    <h2 class="metric-value">85%</h2>
                    <div class="progress" style="height: 8px; border-radius: 999px;">
                        <div class="progress-bar bg-primary" style="width: 85%; border-radius: 999px;"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-xl-4">
            <div class="card dashboard-card">
                <div class="card-body">
                    <h6 class="metric-title">SYSTEM STATUS</h6>
                    <h2 class="metric-value text-success">Active</h2>
                    <div class="progress" style="height: 8px; border-radius: 999px;">
                        <div class="progress-bar bg-warning" style="width: 100%; border-radius: 999px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card cta-card mt-4 text-center">
        <div class="card-body cta-inner">
            <i class="bi bi-inbox display-4 text-muted opacity-50 mb-3 d-block"></i>
            <h5 class="fw-bold text-dark">Have a new concept?</h5>
            <p class="text-muted mb-4">Head over to the submissions page to upload your documents.</p>
            <a href="{{ route('staff.mySubmissions') }}" class="btn btn-primary cta-btn shadow-sm">
                <i class="bi bi-arrow-right-circle me-2"></i> Go to My Submissions
            </a>
        </div>
    </div>

</div>
@endsection
