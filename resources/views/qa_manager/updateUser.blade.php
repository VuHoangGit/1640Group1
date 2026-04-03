@extends('layouts.app')

@section('content')
<style>
    .form-page-card {
        background: #fff;
        border: 0;
        border-radius: 22px;
        box-shadow: 0 10px 26px rgba(15, 23, 42, 0.06);
        overflow: hidden;
    }

    .form-page-header {
        background: linear-gradient(135deg, #2b99d6 0%, #63b8e8 100%);
        color: #fff;
        padding: 24px;
    }

    .form-page-header h2 {
        margin: 0;
        font-size: 1.8rem;
        font-weight: 700;
    }

    .form-page-header p {
        margin: 8px 0 0;
        opacity: 0.95;
    }

    .form-page-body {
        padding: 28px;
    }

    .form-label {
        font-weight: 600;
        color: #475569;
        margin-bottom: 10px;
    }

    .form-control,
    .form-select {
        min-height: 52px;
        border-radius: 14px;
        border: 1px solid #dbe4f0;
        box-shadow: none !important;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #2b99d6;
        box-shadow: 0 0 0 4px rgba(43, 153, 214, 0.10) !important;
    }

    .readonly-input {
        background-color: bisque !important;
    }

    .check-wrap {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
        min-height: 52px;
        padding: 0 4px;
    }

    .check-wrap input[type="checkbox"] {
        width: 18px;
        height: 18px;
    }

    .btn-update {
        min-height: 52px;
        border-radius: 14px;
        font-weight: 700;
        border: none;
        background: #2b99d6;
    }

    .btn-update:hover {
        background: #217db3;
    }

    .cancel-link {
        color: #64748b;
        text-decoration: none;
        font-weight: 500;
    }

    .cancel-link:hover {
        color: #2b99d6;
    }

    @media (max-width: 575.98px) {
        .form-page-header {
            padding: 18px;
        }

        .form-page-header h2 {
            font-size: 1.4rem;
        }

        .form-page-body {
            padding: 18px;
        }
    }
</style>

<div class="container-fluid">
    <div class="form-page-card">
        <div class="form-page-header">
            <h2>Update User</h2>
            <p>Edit user permissions and account settings without changing the current logic.</p>
        </div>

        <div class="form-page-body">
            <form action="{{ route('updateUser',$user->userId) }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-12 col-lg-6 mb-3">
                        <label class="form-label">Username (Login ID)</label>
                        <input type="text" name="username" class="form-control readonly-input" value="{{ $user->username }}" readonly>
                    </div>

                    <div class="col-12 col-lg-6 mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="fullName" class="form-control readonly-input" value="{{ $user->fullName }}" readonly>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control readonly-input" value="{{ $user->email }}" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Leave empty if no change">
                </div>

                <div class="mb-3">
                    <label class="form-label d-block">Reset Authentication Questions</label>
                    <div class="check-wrap">
                        <input type="checkbox" name="resetQuestion" id="resetQuestion">
                        <label for="resetQuestion" class="mb-0">Reset Authentication Questions</label>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Assign Role</label>
                    <select name="role" class="form-select {{ $errors->has('role') ? 'is-invalid' : '' }}" required>
                        <option value="" disabled>Select a role</option>
                        <option value="Staff" {{ $user->role == 'Staff' ? 'selected' : '' }}>Staff</option>
                        <option value="QACoordinator" {{ $user->role == 'QACoordinator' ? 'selected' : '' }}>QA Coordinator</option>
                        <option value="QAManager" {{ $user->role == 'QAManager' ? 'selected' : '' }}>QA Manager</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary w-100 btn-update">Update Account</button>

                <div class="text-center mt-3">
                    <a href="{{ route('qa_manager.staffManagement') }}" class="cancel-link">Cancel and go back</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
