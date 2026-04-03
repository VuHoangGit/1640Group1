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

    .form-control {
        min-height: 52px;
        border-radius: 14px;
        border: 1px solid #dbe4f0;
        box-shadow: none !important;
    }

    .form-control:focus {
        border-color: #2b99d6;
        box-shadow: 0 0 0 4px rgba(43, 153, 214, 0.10) !important;
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
            <h2>Update Category</h2>
            <p>Edit category information while keeping the same system behavior.</p>
        </div>

        <div class="form-page-body">
            @if(session('success'))
                <div class="alert alert-success py-3 rounded-4 border-0">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger py-3 rounded-4 border-0">
                    <ul class="mb-0 ps-3">
                        @foreach($errors->all() as $error)
                            <li style="margin-bottom: 4px;">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('updateCategory',$category->categoryId) }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-12 col-md-8 col-lg-6 mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100 btn-update">Update Category</button>

                <div class="text-center mt-3">
                    <a href="{{ route('qa_coordinator.categoryManagement') }}" class="cancel-link">Cancel and go back</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
