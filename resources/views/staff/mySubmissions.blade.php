@extends('layouts.app')

@section('content')
<style>
    .page-title {
        font-size: 1.9rem;
        font-weight: 700;
        color: #0f172a;
    }

    .section-card {
        border: 0;
        border-radius: 22px;
        box-shadow: 0 8px 24px rgba(15, 23, 42, 0.06);
        overflow: hidden;
        background: #fff;
    }

    .submit-header {
        background: linear-gradient(135deg, #2b99d6 0%, #63b8e8 100%);
        color: #fff;
        padding: 22px 24px;
    }

    .submit-header h5 {
        margin: 0;
        font-weight: 700;
    }

    .submit-header p {
        margin: 8px 0 0;
        opacity: 0.96;
        font-size: 14px;
    }

    .card-body-spacing {
        padding: 24px;
    }

    .form-label-custom {
        font-weight: 700;
        color: #334155;
        margin-bottom: 10px;
    }

    .form-control,
    .form-select {
        min-height: 52px;
        border-radius: 14px;
        border: 1px solid #dbe4f0;
        box-shadow: none !important;
        background: #f8fafc;
    }

    textarea.form-control {
        min-height: 120px;
        resize: vertical;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #2b99d6;
        background: #fff;
        box-shadow: 0 0 0 4px rgba(43, 153, 214, 0.10) !important;
    }

    .anonymous-box {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 14px 16px;
    }

    .submit-btn {
        min-height: 54px;
        border-radius: 999px;
        font-size: 1rem;
        font-weight: 700;
        border: none;
    }

    .history-title {
        font-weight: 700;
        color: #0f172a;
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

    .history-card-mobile {
        border: 1px solid #e9eef5;
        border-radius: 18px;
        padding: 16px;
        background: #fff;
        box-shadow: 0 4px 14px rgba(15, 23, 42, 0.05);
    }

    .history-card-mobile + .history-card-mobile {
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

    .tips-card {
        border: 0;
        border-radius: 22px;
        box-shadow: 0 8px 24px rgba(15, 23, 42, 0.06);
        top: 20px;
    }

    .tips-inner {
        background: #f8fafc;
        padding: 24px;
    }

    .tips-item {
        display: flex;
        align-items: flex-start;
        gap: 10px;
    }

    @media (max-width: 991.98px) {
        .page-title {
            font-size: 1.5rem;
        }

        .submit-header,
        .card-body-spacing,
        .tips-inner {
            padding: 18px;
        }
    }

    @media (max-width: 575.98px) {
        .section-card,
        .tips-card {
            border-radius: 16px;
        }

        .page-title {
            font-size: 1.35rem;
        }

        .submit-btn {
            min-height: 50px;
            font-size: 0.95rem;
        }
    }
</style>

<div class="container-fluid py-4">
    <h3 class="page-title mb-4"><i class="bi bi-cloud-upload text-primary me-2"></i>My Submissions</h3>

    <div class="row g-4">
        <div class="col-12 col-xl-8">
            <div class="section-card mb-4">
                <div class="submit-header">
                    <h5><i class="bi bi-plus-circle me-2"></i>Submit New Idea</h5>
                    <p>Create and upload a new idea with its description, category, and document attachment.</p>
                </div>

                <div class="card-body-spacing">
                    <form action="{{ url('/staff/submit-idea') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label-custom">Idea Title</label>
                            <input type="text" name="title" class="form-control" placeholder="Enter a brief title" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label-custom">Description</label>
                            <textarea name="description" class="form-control" rows="4" placeholder="Explain your idea..." required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label-custom">Select Category</label>
                            <select name="category_id" class="form-select" required>
                                <option value="">-- Choose a category --</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->categoryId ?? $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label-custom">Document Attachment</label>
                            <input type="file" name="document" class="form-control" accept=".pdf,.doc,.docx" required>
                        </div>

                        <div class="anonymous-box mb-4">
                            <div class="form-check mb-0">
                                <input class="form-check-input" type="checkbox" name="is_anonymous" id="anonymousIdea" style="cursor: pointer;">
                                <label class="form-check-label fw-semibold ms-1" for="anonymousIdea" style="cursor: pointer;">
                                    Submit as Anonymous
                                    <small class="text-muted fw-normal">(Hide my name from other users)</small>
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 submit-btn">
                            <i class="bi bi-cloud-arrow-up me-2"></i>Upload Idea Now
                        </button>
                    </form>
                </div>
            </div>

            <h5 class="history-title mb-3"><i class="bi bi-clock-history text-secondary me-2"></i>My Submission History</h5>

            <div class="section-card d-none d-lg-block">
                <div class="table-responsive">
                    <table class="table table-hover align-middle text-center mb-0">
                        <thead>
                            <tr>
                                <th class="py-3">No.</th>
                                <th class="py-3 text-start">Idea Title</th>
                                <th class="py-3">Category</th>
                                <th class="py-3">Status</th>
                                <th class="py-3">Submitted Date</th>
                                <th class="py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($myIdeas as $index => $idea)
                                @php
                                    $deadline = \Carbon\Carbon::parse($idea->created_at)->endOfWeek();
                                    $isOpen = now()->lessThanOrEqualTo($deadline);
                                @endphp
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td class="text-start fw-bold text-primary">{{ $idea->title }}</td>
                                    <td>{{ $idea->category->name ?? 'N/A' }}</td>
                                    <td>
                                        @if($isOpen)
                                            <span class="badge bg-success">Open</span>
                                        @else
                                            <span class="badge bg-danger">Closed</span>
                                        @endif
                                    </td>
                                    <td>{{ $idea->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        @if($isOpen)
                                            <a href="{{ route('staff.editIdea', $idea->ideaId ?? $idea->id) }}" class="btn btn-sm btn-outline-primary rounded-circle" title="Edit Idea">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                        @else
                                            <button type="button" class="btn btn-sm btn-outline-secondary rounded-circle" title="Locked" data-bs-toggle="modal" data-bs-target="#closedPostModal">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">You haven't submitted any ideas yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="d-lg-none">
                @forelse($myIdeas as $index => $idea)
                    @php
                        $deadline = \Carbon\Carbon::parse($idea->created_at)->endOfWeek();
                        $isOpen = now()->lessThanOrEqualTo($deadline);
                    @endphp

                    <div class="history-card-mobile">
                        <div class="row g-3 align-items-center">
                            <div class="col-6">
                                <div class="mobile-label">No.</div>
                                <div class="mobile-value fw-semibold">{{ $index + 1 }}</div>
                            </div>

                            <div class="col-6 text-end">
                                @if($isOpen)
                                    <span class="badge bg-success">Open</span>
                                @else
                                    <span class="badge bg-danger">Closed</span>
                                @endif
                            </div>

                            <div class="col-12">
                                <div class="mobile-label">Idea Title</div>
                                <div class="mobile-value fw-semibold text-primary">{{ $idea->title }}</div>
                            </div>

                            <div class="col-12 col-sm-6">
                                <div class="mobile-label">Category</div>
                                <div class="mobile-value">{{ $idea->category->name ?? 'N/A' }}</div>
                            </div>

                            <div class="col-12 col-sm-6">
                                <div class="mobile-label">Submitted Date</div>
                                <div class="mobile-value">{{ $idea->created_at->format('d/m/Y') }}</div>
                            </div>

                            <div class="col-12">
                                @if($isOpen)
                                    <a href="{{ route('staff.editIdea', $idea->ideaId ?? $idea->id) }}" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                        <i class="bi bi-pencil me-1"></i>Edit Idea
                                    </a>
                                @else
                                    <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#closedPostModal">
                                        <i class="bi bi-lock me-1"></i>Locked
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="section-card text-center text-muted py-4 px-3">
                        You haven't submitted any ideas yet.
                    </div>
                @endforelse
            </div>
        </div>

        <div class="col-12 col-xl-4">
            <div class="card tips-card sticky-xl-top">
                <div class="tips-inner">
                    <h6 class="fw-bold text-primary mb-3"><i class="bi bi-lightbulb me-2"></i>Quick Tips</h6>

                    <div class="tips-item mb-3">
                        <i class="bi bi-check-circle text-success mt-1"></i>
                        <div>
                            <p class="fw-bold text-dark mb-1" style="font-size: 0.95rem;">Effective Submission</p>
                            <p class="text-muted mb-0" style="font-size: 0.85rem;">Make sure your file is formatted correctly and doesn't exceed 10MB to ensure smooth processing.</p>
                        </div>
                    </div>

                    <hr class="text-secondary">

                    <div class="text-center mt-4 mb-2">
                        <i class="bi bi-shield-check text-success mb-2" style="font-size: 3rem;"></i>
                        <h6 class="fw-bold text-dark">Secure Portal</h6>
                        <p class="text-muted" style="font-size: 0.85rem;">Your documents are encrypted and safely stored.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="closedPostModal" tabindex="-1" aria-labelledby="closedPostModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 15px;">
            <div class="modal-header bg-warning border-0" style="border-top-left-radius: 15px; border-top-right-radius: 15px;">
                <h5 class="modal-title fw-bold text-dark" id="closedPostModalLabel">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> Action Restricted
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center py-5">
                <i class="bi bi-lock text-secondary mb-3" style="font-size: 3rem;"></i>
                <h5 class="text-dark">This post is closed and cannot be edited anymore.</h5>
            </div>
            <div class="modal-footer border-0 justify-content-center pb-4">
                <button type="button" class="btn btn-secondary px-5 rounded-pill" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection
