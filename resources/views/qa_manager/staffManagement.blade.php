@extends('layouts.app')

@section('content')
<style>
    .page-header-card {
        background: linear-gradient(135deg, #2b99d6 0%, #63b8e8 100%);
        border-radius: 20px;
        padding: 24px;
        color: #fff;
        box-shadow: 0 10px 24px rgba(43, 153, 214, 0.18);
    }

    .page-header-card h2 {
        margin: 0;
        font-weight: 700;
        font-size: 1.9rem;
    }

    .page-header-card p {
        margin: 8px 0 0;
        opacity: 0.95;
    }

    .toolbar-wrap {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .create-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        background: #fff;
        color: #2b99d6;
        border-radius: 999px;
        padding: 10px 16px;
        font-weight: 700;
        box-shadow: 0 6px 16px rgba(255,255,255,0.22);
    }

    .create-btn:hover {
        color: #217db3;
    }

    .content-card {
        background: #fff;
        border: 0;
        border-radius: 20px;
        box-shadow: 0 8px 24px rgba(15, 23, 42, 0.06);
        overflow: hidden;
    }

    .table thead th {
        background: #f8fafc;
        color: #475569;
        font-size: 14px;
        font-weight: 700;
        border-bottom: 1px solid #e9eef5;
        white-space: nowrap;
    }

    .table tbody td,
    .table tbody th {
        vertical-align: middle;
    }

    .user-cell {
        min-width: 180px;
    }

    .question-cell {
        max-width: 180px;
        word-break: break-word;
    }

    .action-wrap {
        display: flex;
        justify-content: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .mobile-staff-card {
        border: 1px solid #e9eef5;
        border-radius: 18px;
        padding: 16px;
        background: #fff;
        box-shadow: 0 4px 14px rgba(15, 23, 42, 0.05);
    }

    .mobile-staff-card + .mobile-staff-card {
        margin-top: 14px;
    }

    .mobile-label {
        font-size: 12px;
        font-weight: 700;
        color: #64748b;
        margin-bottom: 4px;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .mobile-value {
        font-size: 14px;
        color: #0f172a;
        word-break: break-word;
    }

    @media (max-width: 991.98px) {
        .page-header-card {
            padding: 20px;
        }

        .page-header-card h2 {
            font-size: 1.5rem;
        }
    }

    @media (max-width: 575.98px) {
        .page-header-card,
        .content-card {
            border-radius: 16px;
        }

        .page-header-card {
            padding: 18px;
        }
    }
</style>

<div class="container-fluid">
    <div class="page-header-card mb-4">
        <div class="toolbar-wrap">
            <div>
                <h2>Staff Management</h2>
                <p>Manage staff accounts smoothly on desktop, tablet, iPhone, and Android.</p>
            </div>

            <a href="{{ route('admin.newUser') }}" class="create-btn">
                <i class="bi bi-person-plus"></i>
                Create new User
            </a>
        </div>
    </div>

    <div class="content-card d-none d-xl-block">
        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Email</th>
                        <th>Accept terms</th>
                        <th>Question 1</th>
                        <th>Question 2</th>
                        <th>Question 3</th>
                        <th>Options</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($users as $user)
                        @if ($user->role!='Admin')
                        <tr>
                            <th>{{ $user->userId }}</th>
                            <td class="user-cell">{{ $user->fullName }}</td>
                            <td>{{ $user->role }}</td>
                            <td class="user-cell">{{ $user->email }}</td>
                            <td>{{ $user->acceptTerms }}</td>
                            <td class="question-cell">{{ $user->favorite_animal }}</td>
                            <td class="question-cell">{{ $user->favorite_color }}</td>
                            <td class="question-cell">{{ $user->child_birth_year }}</td>
                            <td>
                                <div class="action-wrap">
                                    <a href="{{ route('qa_manager.updateUser',$user->userId) }}" class="btn btn-success btn-sm rounded-pill px-3">
                                        Update Account
                                    </a>

                                    <a href="{{ route('qa_manager.deleteUser',$user->userId) }}" class="btn btn-danger btn-sm rounded-pill px-3"
                                    onclick="return confirm('Delete this account will delete all associated ideas and votes. Continue?');">
                                        Delete Account
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="d-xl-none">
        @php $hasUser = false; @endphp

        @foreach($users as $user)
            @if ($user->role!='Admin')
                @php $hasUser = true; @endphp

                <div class="mobile-staff-card">
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="mobile-label">ID</div>
                            <div class="mobile-value fw-semibold">{{ $user->userId }}</div>
                        </div>

                        <div class="col-6">
                            <div class="mobile-label">Role</div>
                            <div class="mobile-value">{{ $user->role }}</div>
                        </div>

                        <div class="col-12">
                            <div class="mobile-label">Name</div>
                            <div class="mobile-value fw-semibold">{{ $user->fullName }}</div>
                        </div>

                        <div class="col-12">
                            <div class="mobile-label">Email</div>
                            <div class="mobile-value">{{ $user->email }}</div>
                        </div>

                        <div class="col-12">
                            <div class="mobile-label">Accept terms</div>
                            <div class="mobile-value">{{ $user->acceptTerms }}</div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="mobile-label">Question 1</div>
                            <div class="mobile-value">{{ $user->favorite_animal }}</div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="mobile-label">Question 2</div>
                            <div class="mobile-value">{{ $user->favorite_color }}</div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="mobile-label">Question 3</div>
                            <div class="mobile-value">{{ $user->child_birth_year }}</div>
                        </div>

                        <div class="col-12">
                            <div class="d-flex flex-wrap gap-2">
                                <a href="{{ route('qa_manager.updateUser',$user->userId) }}" class="btn btn-success btn-sm rounded-pill px-3">
                                    Update Account
                                </a>

                                <a href="{{ route('qa_manager.deleteUser',$user->userId) }}" class="btn btn-danger btn-sm rounded-pill px-3"
                                onclick="return confirm('Delete this account will delete all associated ideas and votes. Continue?');">
                                    Delete Account
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach

        @if(!$hasUser)
            <div class="content-card text-center py-5 px-3 text-muted">
                <i class="bi bi-inbox display-4 d-block mb-3 opacity-50"></i>
                No staff accounts found.
            </div>
        @endif
    </div>
</div>

@endsection
