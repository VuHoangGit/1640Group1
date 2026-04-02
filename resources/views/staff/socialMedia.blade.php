@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0 text-dark"><i class="bi bi-globe2 text-primary"></i> Topic List</h3>

        <form action="{{ url()->current() }}" method="GET">
            <div class="d-flex justify-content-end align-items-center">
                <select name="sort" class="form-select w-auto shadow-sm border-0" onchange="this.form.submit()" style="border-radius: 8px;">
                    <option value="latest" {{ $sort == 'latest' ? 'selected' : '' }}>Latest Ideas</option>
                    <option value="popular" {{ $sort == 'popular' ? 'selected' : '' }}>Most Popular</option>
                    <option value="viewed" {{ $sort == 'viewed' ? 'selected' : '' }}>Most Viewed</option>
                    <option value="comments" {{ $sort == 'comments' ? 'selected' : '' }}>Latest Comment</option>
                </select>
            </div>
        </form>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            @forelse($ideas as $idea)
                <!-- Đã thêm data-idea-id vào card để JS dễ dàng lấy ID bài viết -->
                <div class="card border-0 shadow-sm mb-4 idea-card" data-idea-id="{{ $idea->ideaId ?? $idea->id }}" style="border-radius: 15px;">
                    <div class="card-body p-4 text-center">

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle text-white d-flex justify-content-center align-items-center"
                                     style="width: 45px; height: 45px; font-weight: bold; background-color: #e83e8c;">
                                    {{ $idea->is_anonymous ? 'AN' : strtoupper(substr($idea->user->fullName ?? 'U', 0, 2)) }}
                                </div>
                                <div class="ms-3 text-start">
                                    <h6 class="fw-bold mb-0 text-dark">
                                        {{ $idea->is_anonymous ? 'Anonymous Staff' : ($idea->user->fullName ?? 'Unknown Staff') }}
                                    </h6>
                                    <div class="d-flex align-items-center">
                                        <small class="text-muted">Submitted {{ $idea->created_at->diffForHumans() }}</small>
                                        <!-- ICON LƯỢT VIEW ĐƯỢC THÊM VÀO ĐÂY -->
                                        <small class="text-muted ms-3">
                                            <i class="bi bi-eye"></i> <span id="view-count-{{ $idea->ideaId ?? $idea->id }}">{{ $idea->views ?? 0 }}</span>
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <a href="{{ route('staff.downloadIdea', $idea->ideaId ?? $idea->id) }}" class="btn btn-primary rounded-circle shadow-sm d-flex justify-content-center align-items-center" style="width: 40px; height: 40px;" title="Download Attached File">
                                <i class="bi bi-download"></i>
                            </a>
                        </div>

                        <h4 class="fw-bold text-primary mb-2 text-start">
                            <a href="#" class="text-decoration-none">{{ $idea->title }}</a>
                        </h4>
                        <p class="text-muted text-start mb-1">{{ $idea->description }}</p>
                        <p class="text-muted text-start small mb-3">Category: <span class="fw-bold">{{ $idea->category->name ?? 'Idea' }}</span></p>

                        @php
                            $deadline = \Carbon\Carbon::parse($idea->created_at)->endOfWeek();
                            $isOpen = now()->lessThanOrEqualTo($deadline);
                        @endphp

                        <div class="d-flex justify-content-center gap-3 border-top pt-3 mt-3 reaction-container" data-idea-id="{{ $idea->ideaId ?? $idea->id }}">

                            <button class="btn btn-react btn-{{ (isset($myReactions[$idea->ideaId ?? $idea->id]) && $myReactions[$idea->ideaId ?? $idea->id] == true) ? 'primary' : 'outline-primary' }} rounded-pill px-4" data-action="upvote" {{ !$isOpen ? 'disabled' : '' }}>
                                <i class="bi {{ (isset($myReactions[$idea->ideaId ?? $idea->id]) && $myReactions[$idea->ideaId ?? $idea->id] == true) ? 'bi-hand-thumbs-up-fill' : 'bi-hand-thumbs-up' }} me-2"></i>
                                <span class="upvote-count text-dark fw-bold">{{ $idea->upvotes_count ?? 0 }}</span>
                            </button>

                            <button class="btn btn-react btn-{{ (isset($myReactions[$idea->ideaId ?? $idea->id]) && $myReactions[$idea->ideaId ?? $idea->id] == false) ? 'danger' : 'outline-danger' }} rounded-pill px-4" data-action="downvote" {{ !$isOpen ? 'disabled' : '' }}>
                                <i class="bi {{ (isset($myReactions[$idea->ideaId ?? $idea->id]) && $myReactions[$idea->ideaId ?? $idea->id] == false) ? 'bi-hand-thumbs-down-fill' : 'bi-hand-thumbs-down' }} me-2"></i>
                                <span class="downvote-count text-dark fw-bold">{{ $idea->downvotes_count ?? 0 }}</span>
                            </button>
                        </div>
                        <div class="text-muted mt-2 small">Close vote on Sunday ({{ $deadline->format('d/m/Y') }})</div>

                        <div class="text-start mt-4 bg-light p-3 rounded" style="border-radius: 10px;">
                            <h6 class="fw-bold border-bottom pb-2 mb-3"><i class="bi bi-chat-dots"></i> Comments</h6>

                            <div class="mb-3" style="max-height: 250px; overflow-y: auto;">
                                @php
                                    $comments = \App\Models\Comment::where('ideaId', $idea->ideaId ?? $idea->id)->orderBy('created_at', 'asc')->get();
                                @endphp
                                @forelse($comments as $comment)
                                    <div class="bg-white p-2 rounded shadow-sm mb-2">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <strong class="{{ $comment->is_anonymous ? 'text-secondary' : 'text-primary' }}" style="font-size: 0.9rem;">
                                                {{ $comment->is_anonymous ? 'Anonymous' : ($comment->user->fullName ?? 'Staff') }}
                                            </strong>
                                            <small class="text-muted" style="font-size: 0.75rem;">{{ $comment->created_at->diffForHumans() }}</small>
                                        </div>
                                        <p class="mb-0 text-dark text-break" style="font-size: 0.9rem;">{!! nl2br(e($comment->content)) !!}</p>
                                    </div>
                                @empty
                                    <div class="text-muted small">No comments yet. Be the first to share your thoughts!</div>
                                @endforelse
                            </div>

                            <form action="{{ route('comment.store', $idea->ideaId ?? $idea->id) }}" method="POST">
                                @csrf
                                <div class="input-group mb-2 shadow-sm border-0" style="border-radius: 10px;">
                                    <textarea name="content" class="form-control border-0 bg-white comment-textarea" rows="1" placeholder="Write a comment... (Press Enter to send, Shift+Enter for new line)" required style="resize: none;"></textarea>
                                    <button class="btn btn-primary" type="submit"><i class="bi bi-send"></i></button>
                                </div>
                                <div class="form-check text-end">
                                    <input class="form-check-input float-none" type="checkbox" name="is_anonymous" id="anon_cmt_{{ $idea->ideaId ?? $idea->id }}">
                                    <label class="form-check-label text-muted" for="anon_cmt_{{ $idea->ideaId ?? $idea->id }}" style="font-size: 0.85rem; cursor: pointer;">
                                        Comment Anonymously
                                    </label>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            @empty
                <div class="alert alert-info text-center shadow-sm">No ideas found. Be the first to submit one!</div>
            @endforelse

            <div class="d-flex justify-content-center mt-4 pagination-container">
                {{ $ideas->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // 1. Xử lý Like / Dislike
    $('.btn-react').on('click', function(e) {
        e.preventDefault();
        var button = $(this);
        if (button.prop('disabled')) return;
        button.prop('disabled', true);

        var action = button.data('action');
        var container = button.closest('.reaction-container');
        var ideaId = container.data('idea-id');

        var reactUrl = '{{ url("/staff/react-idea") }}/' + ideaId;

        $.ajax({
            url: reactUrl,
            type: 'POST',
            data: { _token: '{{ csrf_token() }}', action: action },
            success: function(response) { window.location.reload(); },
            error: function(xhr) {
                button.prop('disabled', false);
                if (xhr.status === 403) alert(xhr.responseJSON.message || 'Hết thời gian đánh giá bài viết này!');
                else if (xhr.status === 401) alert('Phiên đăng nhập đã hết hạn. Vui lòng đăng nhập lại.');
            }
        });
    });

    // 2. Xử lý bấm Enter để gửi Comment
    $('.comment-textarea').on('keydown', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            var form = $(this).closest('form');
            if ($(this).val().trim() !== '') {
                form.submit();
            }
        }
    });

    // 3. TỰ ĐỘNG ĐẾM VIEW KHI CUỘN CHUỘT
    // Sử dụng IntersectionObserver để theo dõi khi một Idea hiển thị trên màn hình
    if ('IntersectionObserver' in window) {
        let viewObserver = new IntersectionObserver(function(entries, observer) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    let card = $(entry.target);
                    let ideaId = card.data('idea-id');

                    // Gửi request ngầm lên Server để tăng View
                    $.ajax({
                        url: '{{ url("/staff/increment-view") }}/' + ideaId,
                        type: 'POST',
                        data: { _token: '{{ csrf_token() }}' },
                        success: function(response) {
                            if(response.success) {
                                // Tăng số View hiển thị trên giao diện thêm 1
                                let viewCountElement = $('#view-count-' + ideaId);
                                let currentCount = parseInt(viewCountElement.text()) || 0;
                                viewCountElement.text(currentCount + 1);
                            }
                        }
                    });

                    // Quan trọng: Chỉ tăng 1 lần khi cuộn qua, sau đó ngừng theo dõi bài này
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 }); // Ngưỡng 0.5 nghĩa là bài viết phải hiện ít nhất 50% trên màn hình mới tính view

        // Bắt đầu theo dõi tất cả các bài viết
        $('.idea-card').each(function() {
            viewObserver.observe(this);
        });
    }
});
</script>
@endsection
