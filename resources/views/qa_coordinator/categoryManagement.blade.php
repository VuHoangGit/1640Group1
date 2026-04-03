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

    .mobile-category-card {
        border: 1px solid #e9eef5;
        border-radius: 18px;
        padding: 16px;
        background: #fff;
        box-shadow: 0 4px 14px rgba(15, 23, 42, 0.05);
    }

    .mobile-category-card + .mobile-category-card {
        margin-top: 14px;
    }

    .mobile-label {
        font-size: 12px;
        font-weight: 700;
        color: #64748b;
        margin-bottom: 4px;
        text-transform: uppercase;
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
        .page-header-card {
            padding: 18px;
            border-radius: 16px;
        }

        .content-card {
            border-radius: 16px;
        }
    }
</style>

<div class="container-fluid">
    <div class="page-header-card mb-4">
        <div class="toolbar-wrap">
            <div>
                <h2>Category Management</h2>
                <p>Manage categories comfortably on desktop, tablet, iPhone, and Android.</p>
            </div>

            <a href="{{ route('qa_coordinator.newCategory') }}" class="create-btn">
                <i class="bi bi-plus-circle"></i>
                Create new Category
            </a>
        </div>
    </div>

    @if(Session::has('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-4 border-0 rounded-4 shadow-sm" role="alert">
            {{ Session::get('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="content-card d-none d-lg-block">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
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
                            <span class="badge bg-info text-dark rounded-pill" style="font-size: 0.78rem;">{{ $category->name ?? 'N/A' }}</span>
                        </td>

                        @php
                            $ideaCount = App\Models\Idea::where('categoryId', $category->categoryId)->count();
                        @endphp

                        <td class="text-muted">
                            {{ $ideaCount }}
                        </td>

                        <td class="text-center pe-4">
                            <a href="{{ route('qa_coordinator.deleteCategory',$category->categoryId) }}" class="btn btn-danger rounded-pill px-3"
                               onclick="return confirm('Delete this category?');">
                                Delete
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox display-4 d-block mb-3 opacity-50"></i>
                            No ideas submitted yet.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="d-lg-none">
        @forelse($categories as $key => $category)
            @php
                $ideaCount = App\Models\Idea::where('categoryId', $category->categoryId)->count();
            @endphp

            <div class="mobile-category-card">
                <div class="row g-3 align-items-center">
                    <div class="col-12 col-sm-6">
                        <div class="mobile-label">No.</div>
                        <div class="mobile-value fw-semibold">{{ $key + 1 }}</div>
                    </div>

                    <div class="col-12 col-sm-6">
                        <div class="mobile-label">Idea Count</div>
                        <div class="mobile-value fw-semibold">{{ $ideaCount }}</div>
                    </div>

                    <div class="col-12">
                        <div class="mobile-label">Category Name</div>
                        <div class="mobile-value">
                            <span class="badge bg-info text-dark rounded-pill" style="font-size: 0.78rem;">{{ $category->name ?? 'N/A' }}</span>
                        </div>
                    </div>

                    <div class="col-12">
                        <a href="{{ route('qa_coordinator.deleteCategory',$category->categoryId) }}" class="btn btn-danger w-100 rounded-pill"
                           onclick="return confirm('Delete this category?');">
                            Delete
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="content-card text-center py-5 px-3 text-muted">
                <i class="bi bi-inbox display-4 d-block mb-3 opacity-50"></i>
                No ideas submitted yet.
            </div>
        @endforelse
    </div>
</div>
@endsection
