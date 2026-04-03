@extends('layouts.app')

@section('content')
<style>
    .admin-page-title {
        font-weight: 700;
        color: #1f2937;
    }

    .toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
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

    .category-name {
        max-width: 260px;
    }

    @media (max-width: 767.98px) {
        .admin-page-title {
            font-size: 1.3rem;
        }

        .table {
            font-size: 0.92rem;
        }

        .category-name {
            max-width: 180px;
        }
    }
</style>

<div class="container-fluid px-0">
    <div class="toolbar mb-4">
        <h2 class="admin-page-title text-center text-sm-start mb-0">Category Management</h2>
        <a href="{{ route('qa_coordinator.newCategory') }}" class="btn btn-primary">
            <i class="bi bi-folder-plus me-1"></i> Create New Category
        </a>
    </div>

    @if(Session::has('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            {{ Session::get('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card table-card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3">No.</th>
                            <th>Category name</th>
                            <th>Idea count</th>
                            <th class="text-center pe-4">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $key => $category)
                        <tr>
                            <td class="ps-4 text-muted">{{ $key + 1 }}</td>

                            <td>
                                <div class="fw-bold text-primary mb-1 text-truncate category-name" title="{{ $category->name }}">
                                    {{ $category->name }}
                                </div>
                            </td>

                            @php
                                $ideaCount = App\Models\Idea::where('categoryId', $category->categoryId)->count();
                            @endphp

                            <td class="text-muted">
                                {{ $ideaCount }}
                            </td>

                            <td class="text-center pe-4">
                                <a href="{{ route('admin.deleteCategory', $category->categoryId) }}"
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Delete this category?');">
                                    Delete
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox display-4 d-block mb-3 opacity-50"></i>
                                No categories available.
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
