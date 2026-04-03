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

    .table thead th {
        white-space: nowrap;
    }

    @media (max-width: 767.98px) {
        .admin-page-title {
            font-size: 1.3rem;
        }

        .table {
            font-size: 0.92rem;
        }
    }
</style>

<div class="container-fluid px-0">
    <h2 class="admin-page-title text-center mb-4">Topic Management</h2>

    <div class="card table-card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered text-center align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Topic</th>
                            <th>Author</th>
                            <th>Thumbup</th>
                            <th>Thumbdown</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox display-6 d-block mb-3 opacity-50"></i>
                                Data will be loaded from database.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
