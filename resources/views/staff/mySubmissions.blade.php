@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <h3 class="fw-bold mb-4"><i class="bi bi-cloud-upload text-primary"></i> My Submissions</h3>

    <div class="row">
        <!-- Cột trái: Form & Lịch sử -->
        <div class="col-md-8">

            <!-- Khu vực Form: Submit New Idea -->
            <div class="card border-0 shadow-sm mb-5" style="border-radius: 12px;">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                    <h5 class="fw-bold text-primary"><i class="bi bi-plus-circle"></i> Submit New Idea</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ url('/staff/submit-idea') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-bold text-dark">Idea Title</label>
                            <input type="text" name="title" class="form-control bg-light border-0 py-2" placeholder="Enter a brief title" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold text-dark">Description</label>
                            <textarea name="description" class="form-control bg-light border-0 py-2" rows="4" placeholder="Explain your idea..." required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold text-dark">Select Category</label>
                            <select name="category_id" class="form-select bg-light border-0 py-2" required>
                                <option value="">-- Choose a category --</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->categoryId ?? $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold text-dark">Document Attachment</label>
                            <input type="file" name="document" class="form-control bg-light border-0 py-2" accept=".pdf,.doc,.docx" required>
                        </div>

                        <!-- Checkbox Ẩn danh -->
                        <div class="form-check mb-4 bg-light p-3 rounded">
                            <input class="form-check-input ms-1" type="checkbox" name="is_anonymous" id="anonymousIdea" style="cursor: pointer;">
                            <label class="form-check-label text-secondary fw-bold ms-2" for="anonymousIdea" style="cursor: pointer;">
                                Submit as Anonymous <small class="text-muted fw-normal">(Hide my name from other users)</small>
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-3 fw-bold rounded-pill" style="font-size: 1.1rem;">
                            <i class="bi bi-cloud-arrow-up"></i> Upload Idea Now
                        </button>
                    </form>
                </div>
            </div>

            <!-- Khu vực Bảng: My Submission History -->
            <h5 class="fw-bold mb-3"><i class="bi bi-clock-history text-secondary"></i> My Submission History</h5>
            <div class="card border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle text-center mb-0">
                            <thead class="table-light">
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
                                        // Kiểm tra deadline xem bài viết còn mở không
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
                                            <!-- Logic Nút Edit -->
                                            @if($isOpen)
                                                <!-- Nếu Open: Chuyển trang bình thường -->
                                                <a href="{{ route('staff.editIdea', $idea->ideaId ?? $idea->id) }}" class="btn btn-sm btn-outline-primary rounded-circle" title="Edit Idea">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                            @else
                                                <!-- Nếu Closed: Gọi Modal thay vì dùng trình duyệt alert -->
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
            </div>
        </div>

        <!-- Cột phải: Quick Tips -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm mb-4 sticky-top" style="border-radius: 12px; top: 20px;">
                <div class="card-body p-4 bg-light">
                    <h6 class="fw-bold text-primary mb-3"><i class="bi bi-lightbulb"></i> Quick Tips</h6>

                    <div class="d-flex align-items-start mb-3">
                        <i class="bi bi-check-circle text-success mt-1 me-2"></i>
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

<!-- ĐÂY LÀ MODAL THÔNG BÁO BÀI VIẾT BỊ ĐÓNG -->
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
