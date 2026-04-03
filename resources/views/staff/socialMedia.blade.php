@extends('layouts.app')

@section('content')
<style>
    .topic-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        flex-wrap: wrap;
    }

    .topic-title {
        font-size: 1.9rem;
        font-weight: 700;
        color: #0f172a;
        margin: 0;
    }

    .sort-select {
        min-width: 180px;
        border: 1px solid #dbe4f0 !important;
        border-radius: 12px !important;
        min-height: 46px;
        box-shadow: none !important;
    }

    .sort-select:focus {
        border-color: #2b99d6 !important;
        box-shadow: 0 0 0 4px rgba(43, 153, 214, 0.10) !important;
    }

    .idea-post-card {
        border: 0;
        border-radius: 22px;
        box-shadow: 0 8px 24px rgba(15, 23, 42, 0.06);
        overflow: hidden;
    }

    .idea-post-body {
        padding: 24px;
    }

    .avatar-badge {
        width: 45px;
        height: 45px;
        font-weight: bold;
        background-color: #e83e8c;
        flex-shrink: 0;
    }

    .download-btn {
        width: 40px;
        height: 40px;
        flex-shrink: 0;
    }

    .post-title-link {
        color: #2b99d6;
        text-decoration: none;
    }

    .reaction-wrap {
        gap: 12px;
        flex-wrap: wrap;
    }

    .comment-box {
        background: #f8fafc;
        padding: 16px;
        border-radius: 14px;
    }

    .comment-scroll {
        max-height: 250px;
        overflow-y: auto;
    }

    .comment-item {
        background: #fff;
        padding: 10px 12px;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(15, 23, 42, 0.05);
    }

    .comment-textarea {
        min-height: 44px;
    }

    .pagination-container nav {
        display: inline-block;
    }

    @media (max-width: 767.98px) {
        .topic-title {
            font-size: 1.45rem;
        }

        .idea-post-body {
            padding: 18px;
        }

        .reaction-wrap {
            justify-content: stretch !important;
        }

        .reaction-wrap .btn {
            flex: 1 1 calc(50% - 6px);
        }

        .download-btn {
            width: 38px;
            height: 38px;
        }
    }

    @media (max-width: 575.98px) {
        .topic-header {
            align-items: stretch;
        }

        .sort-select {
            width: 100% !important;
        }

        .idea-post-card {
            border-radius: 16px;
        }

        .idea-post-body {
            padding: 14px;
        }

        .reaction-wrap .btn {
            flex: 1 1 100%;
        }
    }
</style>

<div class="container-fluid py-4">
    <div class="topic-header mb-4">
        <h3 class="topic-title"><i class="bi bi-globe2 text-primary me-2"></i>Topic List</h3>

        <form action="{{ url()->current() }}" method="GET">
            <div class="d-flex justify-content-end align-items-center">
                <select name="sort" class="form-select w-auto shadow-sm sort-select" onchange="this.form.submit()">
                    <option value="latest" {{ $sort == 'latest' ? 'selected' : '' }}>Latest Ideas</option>
                    <option value="popular" {{ $sort == 'popular' ? 'selected' : '' }}>Most Popular</option>
                    <option value="viewed" {{ $sort == 'viewed' ? 'selected' : '' }}>Most Viewed</option>
                    <option value="comments" {{ $sort == 'comments' ? 'selected' : '' }}>Latest Comment</option>
                </select>
            </div>
        </form>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-xl-8">
            @forelse($ideas as $idea)
                <div class="card idea-post-card mb-4 idea-card" data-idea-id="{{ $idea->ideaId ?? $idea->id }}">
                    <div class="card-body idea-post-body">

                        <div class="d-flex justify-content-between align-items-start gap-3 mb-3 flex-wrap">
                            <div class="d-flex align-items-start flex-grow-1">
                                <div class="rounded-circle text-white d-flex justify-content-center align-items-center avatar-badge">
                                    {{ $idea->is_anonymous ? 'AN' : strtoupper(substr($idea->user->fullName ?? 'U', 0, 2)) }}
                                </div>

                                <div class="ms-3 text-start">
                                    <h6 class="fw-bold mb-0 text-dark">
                                        {{ $idea->is_anonymous ? 'Anonymous Staff' : ($idea->user->fullName ?? 'Unknown Staff') }}
                                    </h6>

                                    <div class="d-flex align-items-center flex-wrap gap-2 mt-1">
                                        <small class="text-muted">Submitted {{ $idea->created_at->diffForHumans() }}</small>
                                        <small class="text-muted">
                                            <i class="bi bi-eye"></i> <span id="view-count-{{ $idea->ideaId ?? $idea->id }}">{{ $idea->views ?? 0 }}</span>
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <a href="{{ route('staff.downloadIdea', $idea->ideaId ?? $idea->id) }}"
                               class="btn btn-primary rounded-circle shadow-sm d-flex justify-content-center align-items-center download-btn"
                               title="Download Attached File">
                                <i class="bi bi-download"></i>
                            </a>
                        </div>

                        <h4 class="fw-bold mb-2 text-start">
                            <a href="#" class="post-title-link">{{ $idea->title }}</a>
                        </h4>

                        <p class="text-muted text-start mb-1">{{ $idea->description }}</p>
                        <p class="text-muted text-start small mb-3">Category: <span class="fw-bold">{{ $idea->category->name ?? 'Idea' }}</span></p>

                        @php
                            $deadline = \Carbon\Carbon::parse($idea->created_at)->endOfWeek();
                            $isOpen = now()->lessThanOrEqualTo($deadline);
                        @endphp

                        <div class="d-flex justify-content-center border-top pt-3 mt-3 reaction-container reaction-wrap" data-idea-id="{{ $idea->ideaId ?? $idea->id }}">
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

                        <div class="text-start mt-4 comment-box">
                            <h6 class="fw-bold border-bottom pb-2 mb-3"><i class="bi bi-chat-dots me-2"></i>Comments</h6>

                            <div class="mb-3 comment-scroll">
                                @php
                                    $comments = \App\Models\Comment::where('ideaId', $idea->ideaId ?? $idea->id)->orderBy('created_at', 'asc')->get();
                                @endphp

                                @forelse($comments as $comment)
                                    <div class="comment-item mb-2">
                                        <div class="d-flex justify-content-between align-items-center mb-1 gap-2 flex-wrap">
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
                <div class="alert alert-info text-center shadow-sm border-0 rounded-4">No ideas found. Be the first to submit one!</div>
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

    $('.comment-textarea').on('keydown', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            var form = $(this).closest('form');
            if ($(this).val().trim() !== '') {
                form.submit();
            }
        }
    });

    if ('IntersectionObserver' in window) {
        let viewObserver = new IntersectionObserver(function(entries, observer) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    let card = $(entry.target);
                    let ideaId = card.data('idea-id');

                    $.ajax({
                        url: '{{ url("/staff/increment-view") }}/' + ideaId,
                        type: 'POST',
                        data: { _token: '{{ csrf_token() }}' },
                        success: function(response) {
                            if(response.success) {
                                let viewCountElement = $('#view-count-' + ideaId);
                                let currentCount = parseInt(viewCountElement.text()) || 0;
                                viewCountElement.text(currentCount + 1);
                            }
                        }
                    });

                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        $('.idea-card').each(function() {
            viewObserver.observe(this);
        });
    }
});
</script>
@endsection
