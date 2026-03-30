@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <h2 class="text-center fw-bold mb-4">Category Management</h2>

    <a href="{{ route('qa_coordinator.newCategory') }}">Create new Category   </a>
    <div class="card shadow-sm border-0">
        <div class="card-body">

            <table class="table table-bordered text-center align-middle">

                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Options</th>
                    </tr>
                </thead>

                <tbody>
                    <!-- Data will be loaded from database -->
                    @foreach($categories as $category)
                    <tr>
                        <th>{{ $category->categoryId }}</th>
                        <th>{{ $category->name }}</th>

                        <th>
                            {{-- Update Button --}}
                            <a href="{{ route('qa_coordinator.updateCategory',$category->categoryId) }}" class="btn btn-success">
                            Update Category
                            </a>

                            {{-- Delete Button --}}
                            <a href="{{ route('qa_coordinator.deleteCategory',$category->categoryId) }}" class="btn btn-danger"
                            onclick="return confirm('Are you sure to delete this account ?');">
                            Delete Category
                            </a>
                        </th>
                    </tr>
                    @endforeach
                </tbody>

            </table>

        </div>
    </div>

</div>

@endsection
