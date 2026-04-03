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

    .table tbody td {
        vertical-align: middle;
    }

    .idea-title {
        max-width: 240px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .mobile-idea-card {
        border: 1px solid #e9eef5;
        border-radius: 18px;
        padding: 16px;
        background: #fff;
        box-shadow: 0 4px 14px rgba(15, 23, 42, 0.05);
    }

    .mobile-idea-card + .mobile-idea-card {
        margin-top: 14px;
    }

    .mobile-label {
        font-size: 12px;
        font-weight: 700;
        color: #64748b;
        margin-bottom: 4px;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .mobile-value {
        font-size: 14px;
        color: #0f172a;
        word-break: break-word;
    }

    .action-stack {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
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
        <h2><i class="bi bi-folder2-open me-2"></i>Submitted Ideas Management</h2>
        <p>Review submitted ideas, download attached files, and manage entries across all devices.</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 rounded-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="content-card d-none d-lg-block">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
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
                            <small class="text-muted"><i class="bi bi-person-badge"></i> {{ $idea->user->username ?? 'N/A' }}</small>
                        </td>

                        <td>
                            <div class="fw-bold text-primary mb-1 idea-title" title="{{ $idea->title }}">{{ $idea->title }}</div>
                            <span class="badge bg-info text-dark rounded-pill" style="font-size: 0.7rem;">{{ $idea->category->name ?? 'N/A' }}</span>
                        </td>

                        <td class="text-center">
                            <span class="badge bg-light text-dark border me-1 px-2 py-1" title="Thumbs Up">
                                <i class="bi bi-hand-thumbs-up-fill text-primary"></i> {{ $idea->upvotes }}
                            </span>
                            <span class="badge bg-light text-dark border px-2 py-1" title="Thumbs Down">
                                <i class="bi bi-hand-thumbs-down-fill text-danger"></i> {{ $idea->downvotes }}
                            </span>
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
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('admin.download', $idea->ideaId) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3" title="Download File">
                                    <i class="bi bi-download"></i>
                                </a>

                                <form action="{{ route('admin.deleteIdea', $idea->ideaId) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn XÓA VĨNH VIỄN bài đăng này cùng các dữ liệu/file liên quan không?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3" title="Delete Idea">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>
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

    <div class="d-lg-none">
        @forelse($ideas as $key => $idea)
            @php
                $deadline = \Carbon\Carbon::parse($idea->created_at)->endOfWeek();
                $isVoteClosed = now()->greaterThan($deadline);
            @endphp

            <div class="mobile-idea-card">
                <div class="d-flex justify-content-between align-items-start gap-3 mb-3">
                    <div>
                        <div class="mobile-label">No.</div>
                        <div class="mobile-value fw-semibold">{{ $key + 1 }}</div>
                    </div>

                    <div class="text-end">
                        @if($isVoteClosed)
                            <span class="badge bg-danger rounded-pill"><i class="bi bi-lock-fill"></i> Closed</span>
                        @else
                            <span class="badge bg-success rounded-pill"><i class="bi bi-unlock-fill"></i> Open</span>
                        @endif
                    </div>
                </div>

                <div class="mb-3">
                    <div class="mobile-label">Staff Info</div>
                    <div class="mobile-value fw-semibold">{{ $idea->user->fullName ?? $idea->user->username ?? 'Unknown' }}</div>
                    <div class="text-muted small"><i class="bi bi-person-badge"></i> {{ $idea->user->username ?? 'N/A' }}</div>
                </div>

                <div class="mb-3">
                    <div class="mobile-label">Idea Title</div>
                    <div class="mobile-value fw-semibold text-primary">{{ $idea->title }}</div>
                    <div class="mt-2">
                        <span class="badge bg-info text-dark rounded-pill" style="font-size: 0.72rem;">{{ $idea->category->name ?? 'N/A' }}</span>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-6">
                        <div class="mobile-label">Upvotes</div>
                        <div class="mobile-value"><i class="bi bi-hand-thumbs-up-fill text-primary"></i> {{ $idea->upvotes }}</div>
                    </div>
                    <div class="col-6">
                        <div class="mobile-label">Downvotes</div>
                        <div class="mobile-value"><i class="bi bi-hand-thumbs-down-fill text-danger"></i> {{ $idea->downvotes }}</div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="mobile-label">Submitted Date</div>
                    <div class="mobile-value">{{ $idea->created_at->format('d/m/Y H:i') }}</div>
                </div>

                <div class="action-stack">
                    <a href="{{ route('admin.download', $idea->ideaId) }}" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                        <i class="bi bi-download me-1"></i>Download
                    </a>

                    <form action="{{ route('admin.deleteIdea', $idea->ideaId) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn XÓA VĨNH VIỄN bài đăng này cùng các dữ liệu/file liên quan không?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3">
                            <i class="bi bi-trash3 me-1"></i>Delete
                        </button>
                    </form>
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
