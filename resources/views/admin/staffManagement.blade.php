@extends('layouts.app')

@section('content')
<div class="container-fluid py-3">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <h2 class="fw-bold mb-0">Staff Management</h2>
        <a href="{{ route('admin.newUser') }}" class="btn btn-primary btn-sm">
            Create New User
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle mb-0">
                    <thead class="table-light text-center">
                        <tr>
                            <th class="text-nowrap">ID</th>
                            <th>Name</th>
                            <th class="text-nowrap">Role</th>
                            <th>Email</th>
                            <th class="text-nowrap">Accept Terms</th>
                            <th class="text-nowrap">Question 1</th>
                            <th class="text-nowrap">Question 2</th>
                            <th class="text-nowrap">Question 3</th>
                            <th class="text-nowrap">Options</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td class="text-center">{{ $user->userId }}</td>
                                <td class="fw-semibold">{{ $user->fullName }}</td>
                                <td class="text-center">
                                    <span class="badge bg-info text-dark">{{ $user->role }}</span>
                                </td>
                                <td class="text-break">{{ $user->email }}</td>
                                <td class="text-center">{{ $user->acceptTerms }}</td>
                                <td>{{ $user->favorite_animal }}</td>
                                <td>{{ $user->favorite_color }}</td>
                                <td>{{ $user->child_birth_year }}</td>
                                <td class="text-center">
                                    @if($user->role != 'Admin')
                                        <div class="d-flex flex-column flex-sm-row gap-2 justify-content-center">
                                            <a href="{{ route('admin.updateUser', $user->userId) }}" class="btn btn-success btn-sm">
                                                Update Account
                                            </a>

                                            <a
                                                href="{{ route('admin.deleteUser', $user->userId) }}"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Delete this account will delete all associated ideas and votes. Continue?');"
                                            >
                                                Delete Account
                                            </a>
                                        </div>
                                    @else
                                        <span class="text-muted small">Protected</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-5 text-muted">
                                    No users found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
