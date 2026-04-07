@extends('layouts.app')

@section('content')
<div class="container-fluid py-3">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8 col-xl-7">
            <div class="card shadow-sm border-0">
                <div class="card-body p-3 p-md-4">
                    <h2 class="text-center fw-bold mb-4">Update User</h2>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0 ps-3">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('updateUser', $user->userId) }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-12 col-md-6 mb-3">
                                <label class="form-label">Username (Login ID)</label>
                                <input
                                    type="text"
                                    name="username"
                                    class="form-control"
                                    value="{{ old('username', $user->username) }}"
                                    readonly
                                    style="background-color: bisque"
                                >
                            </div>

                            <div class="col-12 col-md-6 mb-3">
                                <label class="form-label">Full Name</label>
                                <input
                                    type="text"
                                    name="fullName"
                                    class="form-control"
                                    value="{{ old('fullName', $user->fullName) }}"
                                    readonly
                                    style="background-color: bisque"
                                >
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                value="{{ old('email', $user->email) }}"
                                readonly
                                style="background-color: bisque"
                            >
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                placeholder="Leave empty if no change"
                            >
                        </div>

                        <div class="form-check mb-3">
                            <input
                                type="checkbox"
                                name="resetQuestion"
                                id="resetQuestion"
                                class="form-check-input"
                                {{ old('resetQuestion') ? 'checked' : '' }}
                            >
                            <label for="resetQuestion" class="form-check-label">
                                Reset Authentication Questions
                            </label>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Assign Role</label>
                            <select name="role" class="form-select {{ $errors->has('role') ? 'is-invalid' : '' }}" required>
                                <option value="" disabled>Select a role</option>
                                <option value="Staff" {{ old('role', $user->role) == 'Staff' ? 'selected' : '' }}>Staff</option>
                                <option value="QACoordinator" {{ old('role', $user->role) == 'QACoordinator' ? 'selected' : '' }}>QA Coordinator</option>
                                <option value="QAManager" {{ old('role', $user->role) == 'QAManager' ? 'selected' : '' }}>QA Manager</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex flex-column flex-sm-row gap-2">
                            <button type="submit" class="btn btn-primary w-100 btn-create">
                                Update Account
                            </button>
                            <a href="{{ route('admin.staffManagement') }}" class="btn btn-outline-secondary w-100">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
