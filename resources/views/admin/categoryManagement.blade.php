@extends('layouts.app')

@section('content')
<div class="container-fluid py-3">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <h2 class="fw-bold mb-0">Category Management</h2>
        <a href="{{ route('qa_coordinator.newCategory') }}" class="btn btn-primary btn-sm">
            Create New Category
        </a>
    </div>

    @if(Session::has('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            {{ Session::get('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3 text-nowrap">No.</th>
                            <th>Category Name</th>
                            <th class="text-nowrap">Idea Count</th>
                            <th class="text-center text-nowrap">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $key => $category)
                            @php
                                $ideaCount = App\Models\Idea::where('categoryId', $category->categoryId)->count();
                            @endphp
                            <tr>
                                <td class="ps-4 text-muted">{{ $key + 1 }}</td>

                                <td>
                                    <div class="fw-bold text-primary text-break" title="{{ $category->name }}">
                                        {{ $category->name }}
                                    </div>
                                </td>

                                <td class="text-muted">
                                    {{ $ideaCount }}
                                </td>

                                <td class="text-center">
                                    <a
                                        href="{{ route('admin.deleteCategory', $category->categoryId) }}"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Delete this category?');"
                                    >
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">
                                    <i class="bi bi-inbox display-6 d-block mb-3 opacity-50"></i>
                                    No categories found.
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
