@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="fw-bold mb-4"><i class="bi bi-folder2-open"></i> Submitted Ideas List</h2>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">No.</th>
                        <th>Staff Name</th>
                        <th>Category</th>
                        <th>File Name</th>
                        <th>Submitted Date</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ideas as $key => $idea)
                    <tr>
                        <td class="ps-4">{{ $key + 1 }}</td>
                        <td class="fw-bold text-primary">{{ $idea->user->username ?? 'Unknown' }}</td>
                        <td><span class="badge bg-info text-dark">{{ $idea->category->name ?? 'N/A' }}</span></td>
                        <td><i class="bi bi-file-earmark-text me-2"></i>{{ basename($idea->filePath) }}</td>
                        <td>{{ $idea->created_at->format('d/m/Y H:i') }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.download', $idea->ideaId) }}" class="btn btn-sm btn-success">
                                <i class="bi bi-download"></i> Download
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">No ideas submitted yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
