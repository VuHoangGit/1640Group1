@extends('layouts.app')

@section('content')
<style>
    .admin-page-title {
        font-weight: 700;
        color: #1f2937;
    }

    .table-card {
        border: 0;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 8px 24px rgba(15, 23, 42, 0.06);
    }

    .toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .table thead th {
        white-space: nowrap;
    }

    .action-buttons {
        display: flex;
        justify-content: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    @media (max-width: 767.98px) {
        .admin-page-title {
            font-size: 1.3rem;
        }

        .table {
            font-size: 0.92rem;
        }

        .action-buttons .btn {
            width: 100%;
        }
    }
</style>

<div class="container-fluid px-0">
    <div class="toolbar mb-4">
        <h2 class="admin-page-title text-center text-sm-start mb-0">Staff Management</h2>
        <a href="{{ route('admin.newUser') }}" class="btn btn-primary">
            <i class="bi bi-person-plus-fill me-1"></i> Create New User
        </a>
    </div>

    <div class="card table-card">
        <div class="card-body p-0">
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
                        <tr>
                            <td>{{ $user->userId }}</td>
                            <td>{{ $user->fullName }}</td>
                            <td>{{ $user->role }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->acceptTerms }}</td>
                            <td>{{ $user->favorite_animal }}</td>
                            <td>{{ $user->favorite_color }}</td>
                            <td>{{ $user->child_birth_year }}</td>
                            <td>
                                @if ($user->role != 'Admin')
                                <div class="action-buttons">
                                    <a href="{{ route('admin.updateUser', $user->userId) }}" class="btn btn-success btn-sm">
                                        Update Account
                                    </a>

                                    <a href="{{ route('admin.deleteUser', $user->userId) }}"
                                       class="btn btn-danger btn-sm"
                                       onclick="return confirm('Delete this account will delete all associated ideas and votes. Continue?');">
                                        Delete Account
                                    </a>
                                </div>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>
@endsection
