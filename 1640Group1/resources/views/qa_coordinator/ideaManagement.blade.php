@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <h2 class="text-center fw-bold mb-4">Idea Management</h2>
    <div class="card shadow-sm border-0">
        <div class="card-body">

            <table class="table table-bordered text-center align-middle">

                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>UserId</th>
                        <th>CategoryId</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>File Path</th>
                        <th>Options</th>
                    </tr>
                </thead>

                <tbody>
                    <!-- Data will be loaded from database -->
                    @foreach($ideas as $idea)
                    <tr>
                        <th>{{ $idea->ideaId }}</th>
                        <th>{{ $idea->userId }}</th>
                        <th>{{ $idea->categoryId }}</th>
                        <th>{{ $idea->title }}</th>
                        <th>{{ $idea->description }}</th>
                        <th>{{ $idea->filePath }}
                            {{-- <a href="{{ route('staff.downloadIdea', $idea->ideaId) }}" class="btn btn-primary rounded-circle shadow-sm" style="width: 45px; height: 45px; display: flex; align-items: center; justify-content: center;" title="Download File">
                                <i class="bi bi-cloud-arrow-down-fill fs-5"></i>
                            </a> --}}
                        </th>

                        <th>

                            {{-- Delete Button --}}
                            <a href="{{ route('qa_coordinator.deleteCategory',$idea->ideaId) }}" class="btn btn-danger"
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
