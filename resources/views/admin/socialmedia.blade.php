@extends('layouts.app')

@section('content')
<div class="container-fluid py-3">
    <h2 class="text-center fw-bold mb-4">Topic Management</h2>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="text-nowrap">ID</th>
                            <th>Topic</th>
                            <th>Author</th>
                            <th class="text-nowrap">Thumbup</th>
                            <th class="text-nowrap">Thumbdown</th>
                        </tr>
                    </thead>

                    <tbody>
                        <!-- Data will be loaded from database -->
                        <tr>
                            <td colspan="5" class="py-5 text-muted">
                                No data available yet.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
