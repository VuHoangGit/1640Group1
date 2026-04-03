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
        font-size: 0.95rem;
    }

    .idea-title {
        max-width: 220px;
    }

    .action-group {
        display: flex;
        justify-content: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .reaction-badges {
        display: inline-flex;
        gap: 6px;
        flex-wrap: wrap;
        justify-content: center;
    }

    @media (max-width: 767.98px) {
        .admin-page-title {
            font-size: 1.3rem;
        }

        .table {
            font-size: 0.92rem;
        }

        .idea-title {
            max-width: 170px;
        }

        .action-group .btn {
            width: 36px;
            height: 36px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
    }
</style>

<div class="container-fluid px-0">
    <h2 class="admin-page-title mb-4"><i class="bi bi-folder2-open me-2"></i>Submitted Ideas Management</h2>

    <div class="card table-card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3">No.</th>
                            <th>Staff Info</th>
                            <th>Idea Title & Category</th>
                            <th class="text-center">Reactions</th>
                            <th class="text-center">Status</th>
                            <th>Submitted Date</th>
                            <th class="text-center pe-4">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ideas as $key => $idea)
                        <tr>
                            <td class="ps-4 text-muted">{{ $key + 1 }}</td>

                            <td>
                                <div class="fw-bold text-dark">{{ $idea->user->fullName ?? $idea->user->username ?? 'Unknown' }}</div>
                                <small class="text-muted d-block"><i class="bi bi-person-badge"></i> {{ $idea->user->username ?? 'N/A' }}</small>
                            </td>

                            <td>
                                <div class="fw-bold text-primary mb-1 text-truncate idea-title" title="{{ $idea->title }}">
                                    {{ $idea->title }}
                                </div>
                                <span class="badge bg-info text-dark rounded-pill" style="font-size: 0.72rem;">
                                    {{ $idea->category->name ?? 'N/A' }}
                                </span>
                            </td>

                            <td class="text-center">
                                <div class="reaction-badges">
                                    <span class="badge bg-light text-dark border px-2 py-1" title="Thumbs Up">
                                        <i class="bi bi-hand-thumbs-up-fill text-primary"></i> {{ $idea->upvotes }}
                                    </span>
                                    <span class="badge bg-light text-dark border px-2 py-1" title="Thumbs Down">
                                        <i class="bi bi-hand-thumbs-down-fill text-danger"></i> {{ $idea->downvotes }}
                                    </span>
                                </div>
                            </td>

                            @php
                                $deadline = \Carbon\Carbon::parse($idea->created_at)->endOfWeek();
                                $isVoteClosed = now()->greaterThan($deadline);
                            @endphp

                            <td class="text-center">
                                @if($isVoteClosed)
                                    <span class="badge bg-danger rounded-pill"><i class="bi bi-lock-fill"></i> Closed</span>
                                @else
                                    <span class="badge bg-success rounded-pill"><i class="bi bi-unlock-fill"></i> Open</span>
                                @endif
                            </td>

                            <td class="small text-muted">
                                {{ $idea->created_at->format('d/m/Y H:i') }}
                            </td>

                            <td class="text-center pe-4">
                                <div class="action-group">
                                    <a href="{{ route('admin.download', $idea->ideaId ?? $idea->id) }}"
                                       class="btn btn-sm btn-outline-primary"
                                       title="Download File">
                                        <i class="bi bi-download"></i>
                                    </a>

                                    <button type="button"
                                            class="btn btn-sm btn-outline-danger"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteConfirmModal"
                                            data-delete-url="{{ route('admin.deleteIdea', $idea->ideaId ?? $idea->id) }}"
                                            title="Delete Idea">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </div>
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
    </div>
</div>

<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 15px;">
            <div class="modal-header bg-danger border-0" style="border-top-left-radius: 15px; border-top-right-radius: 15px;">
                <h5 class="modal-title fw-bold text-white" id="deleteConfirmModalLabel">
                    <i class="bi bi-exclamation-octagon-fill me-2"></i> System Confirmation
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body text-center py-4">
                <i class="bi bi-trash3 text-danger mb-3" style="font-size: 4rem;"></i>
                <h5 class="text-dark fw-bold mb-3">Are you sure you want to PERMANENTLY DELETE this idea?</h5>
                <p class="text-muted mb-0" style="font-size: 0.95rem;">
                    This action will remove all associated data, documents, and comments.
                    <strong class="text-danger">This cannot be undone!</strong>
                </p>
            </div>

            <div class="modal-footer border-0 justify-content-center pb-4 gap-3 flex-wrap">
                <button type="button" class="btn btn-light px-4 rounded-pill fw-bold" data-bs-dismiss="modal">Cancel</button>

                <form id="deleteForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger px-4 rounded-pill fw-bold shadow-sm">Yes, Delete It</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var deleteModal = document.getElementById('deleteConfirmModal');

    if (deleteModal) {
        deleteModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var deleteUrl = button.getAttribute('data-delete-url');
            var deleteForm = deleteModal.querySelector('#deleteForm');
            deleteForm.setAttribute('action', deleteUrl);
        });
    }
});
</script>
@endsection
