@extends('frontend.layouts.master')

@section('title', 'Posts Details')

@push('frontend_style')
@endpush

@section('frontend_content')
    <main class="main">
        <!-- breadcrumb -->
        <x-frontend.pages.common.breadcrumb :title="'Posts Details'" :breadcrumb="[
            ['name' => 'Home', 'url' => route('home')],
            ['name' => 'Posts', 'url' => '#'],
            ['name' => 'Posts Details', 'url' => '#'],
        ]" />
        <!-- breadcrumb end -->


        <!-- blog single -->
        <div class="blog-single py-120">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-8">
                        <div class="blog-single-wrap">
                            <div class="blog-single-content">
                                <div class="blog-thumb-img">
                                    @if ($post->post_image)
                                        <img src="{{ asset('uploads/posts/' . $post->post_image) }}"
                                            alt="{{ $post->title }}" />
                                    @else
                                        <img src="{{ asset('assets/frontend/img/blog/single.jpg') }}"
                                            alt="{{ $post->title }}" />
                                    @endif
                                </div>
                                <div class="blog-info">
                                    <div class="blog-meta">
                                        <div class="blog-meta-left">
                                            <ul>
                                                <li><i class="far fa-user-tie-hair"></i><a
                                                        href="#">{{ $post->user->name ?? 'Admin' }}</a></li>
                                                <li><i class="far fa-comments"></i>{{ $comments->total() }} Comments</li>
                                                @if ($post->postCategory)
                                                    <li><i class="far fa-folder"></i>{{ $post->postCategory->title }}</li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="blog-details">
                                        <h3 class="blog-details-title mb-20">{{ $post->title }}</h3>
                                        <p class="mb-10">
                                            {!! $post->description !!}
                                        </p>
                                        <blockquote class="blockqoute">
                                            {!! $post->short_des !!}
                                            <h6 class="blockqoute-author">{{ $post->user->name ?? 'Author' }}</h6>
                                            <i class="fal fa-quote-right blockqoute-icon"></i>
                                        </blockquote>
                                        <p class="mb-20">
                                            {!! $post->long_des !!}
                                        </p>
                                        <hr />
                                    </div>
                                    <div class="blog-author">
                                        <div class="blog-author-img">
                                            @if ($post->user->profile && $post->user->profile->profileImage)
                                                <img src="{{ asset($post->user->profile->profileImage->profile_image) }}"
                                                    alt="author" />
                                            @elseif ($post->user->profile_photo_path)
                                                <img src="{{ asset($post->user->profile_photo_path) }}" alt="author" />
                                            @else
                                                <img src="{{ asset('assets/backend/images/faces/admin.png') }}"
                                                    alt="author" />
                                            @endif
                                        </div>
                                        <div class="author-info">
                                            <h6>Author</h6>
                                            <h3 class="author-name">{{ $post->user->name }}</h3>
                                            <p>
                                                Contributor and content creator. Passionate about sharing knowledge and
                                                educational insights.
                                            </p>
                                            <div class="author-social">
                                                @if ($post->user->profile && $post->user->profile->facebook)
                                                    <a href="{{ $post->user->profile->facebook }}" target="_blank"><i
                                                            class="fab fa-facebook-f"></i></a>
                                                @endif
                                                @if ($post->user->profile && $post->user->profile->twitter)
                                                    <a href="{{ $post->user->profile->twitter }}" target="_blank"><i
                                                            class="fab fa-x-twitter"></i></a>
                                                @endif
                                                @if ($post->user->profile && $post->user->profile->instagram)
                                                    <a href="{{ $post->user->profile->instagram }}" target="_blank"><i
                                                            class="fab fa-instagram"></i></a>
                                                @endif
                                                @if ($post->user->profile && $post->user->profile->linkedIn)
                                                    <a href="{{ $post->user->profile->linkedIn }}" target="_blank"><i
                                                            class="fab fa-linkedin-in"></i></a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- post navigation -->
                                    <div
                                        class="post-navigation d-flex justify-content-between align-items-center my-4 py-3 border-top border-bottom">
                                        <div class="nav-prev">
                                            @if ($previousPost)
                                                <a href="{{ route('news.details', $previousPost->id) }}"
                                                    class="theme-btn py-2 px-3" style="font-size: 14px;">
                                                    <i class="fas fa-arrow-left me-2"></i> Prev Post
                                                </a>
                                            @endif
                                        </div>
                                        <div class="nav-next">
                                            @if ($nextPost)
                                                <a href="{{ route('news.details', $nextPost->id) }}"
                                                    class="theme-btn py-2 px-3" style="font-size: 14px;">
                                                    Next Post <i class="fas fa-arrow-right ms-2"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="blog-comment">
                                    <h3>Comments ({{ $comments->total() }})</h3>
                                    <div class="blog-comment-wrap" id="comments-container-wrapper">
                                        @foreach ($comments as $comment)
                                            <div class="blog-comment-item mb-4" id="comment-container-{{ $comment->id }}">
                                                @if ($comment->user->profile && $comment->user->profile->profileImage)
                                                    <img src="{{ asset($comment->user->profile->profileImage->profile_image) }}"
                                                        alt="avatar" />
                                                @elseif ($comment->user->profile_photo_path)
                                                    <img src="{{ asset($comment->user->profile_photo_path) }}"
                                                        alt="avatar" />
                                                @else
                                                    <img src="{{ asset('assets/backend/images/faces/admin.png') }}"
                                                        alt="avatar" />
                                                @endif
                                                <div class="blog-comment-content w-100">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <h5>{{ $comment->user->name }}</h5>
                                                        <div class="d-flex align-items-center">
                                                            <!-- Edit Option Start-->
                                                            @if (auth()->check() && auth()->user()->id === $comment->user_id)
                                                                <a href="#" class="btn btn-sm mt-0 p-1" style="color: #15d4c9;"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#editCommentModal-{{ $comment->id }}">
                                                                    <i class="fas fa-edit fa-fw"></i>
                                                                </a>
                                                            @endif
                                                            <!-- Edit Option End-->

                                                            <!-- Delete Option Start-->
                                                            @if (auth()->check() && (auth()->user()->id === $comment->user_id || in_array(auth()->user()->role_id, [1, 2, 3])))
                                                                <form
                                                                    action="{{ route('posts.comments.destroy', [$post->id, $comment->id]) }}"
                                                                    method="POST" class="d-inline ajax-delete-form">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn btn-sm ajax-delete-btn p-1" style="color: #fd6a6a;"
                                                                        data-toggle="tooltip" data-placement="top"
                                                                        data-bs-original-title="Delete">
                                                                        <i class="fas fa-trash-alt fa-fw"></i>
                                                                    </button>
                                                                </form>
                                                            @endif
                                                            <!-- Delete Option End-->
                                                        </div>
                                                    </div>

                                                    <!-- Edit Comment Modal Start-->
                                                    <div class="modal fade" id="editCommentModal-{{ $comment->id }}"
                                                        tabindex="-1"
                                                        aria-labelledby="editCommentModalLabel-{{ $comment->id }}"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="editCommentModalLabel-{{ $comment->id }}"
                                                                        style="color: #000 !important;">Edit Comment</h5>
                                                                    <button type="button" class="border-0 bg-transparent ms-auto"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"><i class="fas fa-times" style="font-size: 20px; color: #000;"></i></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form method="POST"
                                                                        action="{{ route('posts.comments.update', [$post->id, $comment->id]) }}"
                                                                        class="ajax-edit-form"
                                                                        data-comment-id="{{ $comment->id }}">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <div class="mb-3">
                                                                            <label
                                                                                for="edit-comment-body-{{ $comment->id }}"
                                                                                class="form-label"
                                                                                style="color: #000 !important;">Edit
                                                                                Comment</label>
                                                                            <textarea name="body" id="edit-comment-body-{{ $comment->id }}" cols="45" rows="5"
                                                                                class="form-control" required>{{ $comment->body }}</textarea>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">Close</button>
                                                                            <button class="theme-btn py-2 px-3"
                                                                                type="submit">
                                                                                Update
                                                                            </button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Edit Comment Modal End-->

                                                    <span><i class="far fa-clock"></i>
                                                        {{ $comment->created_at->format('F j, Y \a\t h:i A') }}</span>
                                                    <p class="comment-body-text-{{ $comment->id }}">{{ $comment->body }}
                                                    </p>
                                                    <a href="javascript:void(0);" class="reply-toggle-btn"
                                                        data-target="replyForm-{{ $comment->id }}">
                                                        <i class="far fa-reply"></i> Reply (<span
                                                            class="reply-count-{{ $comment->id }}">{{ $comment->repliesCount() }}</span>)
                                                    </a>
                                                </div>
                                            </div>

                                            <!-- Reply Form -->
                                            <div id="replyForm-{{ $comment->id }}"
                                                class="d-none ms-5 mb-4 p-3 border rounded bg-light">
                                                <form class="comment-form ajax-comment-form" method="POST"
                                                    action="{{ route('posts.comments.store', $post->id) }}">
                                                    @csrf
                                                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                                    <div class="form-group mb-2">
                                                        <textarea name="body" class="form-control" cols="45" rows="3" placeholder="Write a reply..."
                                                            required="required"></textarea>
                                                    </div>
                                                    <button class="theme-btn py-2 px-3" type="submit"
                                                        style="font-size: 14px;">
                                                        Post Reply <i class="far fa-paper-plane"></i>
                                                    </button>
                                                </form>
                                            </div>

                                            <!-- Nested Replies -->
                                            <div id="replies-list-{{ $comment->id }}">
                                                @foreach ($comment->replies as $reply)
                                                    <div class="blog-comment-item reply ms-5 mb-3"
                                                        id="comment-container-{{ $reply->id }}">
                                                        @if ($reply->user->profile && $reply->user->profile->profileImage)
                                                            <img src="{{ asset($reply->user->profile->profileImage->profile_image) }}"
                                                                alt="avatar" />
                                                        @elseif ($reply->user->profile_photo_path)
                                                            <img src="{{ asset($reply->user->profile_photo_path) }}"
                                                                alt="avatar" />
                                                        @else
                                                            <img src="{{ asset('assets/backend/images/faces/admin.png') }}"
                                                                alt="avatar" />
                                                        @endif
                                                        <div class="blog-comment-content w-100">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <h5>{{ $reply->user->name }}</h5>
                                                                <div class="d-flex align-items-center">
                                                                    <!-- Edit Option Start-->
                                                                    @if (auth()->check() && auth()->user()->id === $reply->user_id)
                                                                        <a href="#" class="btn btn-sm mt-0 p-1" style="color: #15d4c9;"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#editCommentModal-{{ $reply->id }}">
                                                                            <i class="fas fa-edit fa-fw"></i>
                                                                        </a>
                                                                    @endif
                                                                    <!-- Edit Option End-->

                                                                    <!-- Delete Option Start-->
                                                                    @if (auth()->check() && (auth()->user()->id === $reply->user_id || in_array(auth()->user()->role_id, [1, 2, 3])))
                                                                        <form
                                                                            action="{{ route('posts.comments.destroy', [$post->id, $reply->id]) }}"
                                                                            method="POST"
                                                                            class="d-inline ajax-delete-form">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit"
                                                                                class="btn btn-sm ajax-delete-btn p-1" style="color: #fd6a6a;"
                                                                                data-toggle="tooltip" data-placement="top"
                                                                                data-bs-original-title="Delete">
                                                                                <i class="fas fa-trash-alt fa-fw"></i>
                                                                            </button>
                                                                        </form>
                                                                    @endif
                                                                    <!-- Delete Option End-->
                                                                </div>
                                                            </div>

                                                            <!-- Edit Comment Modal Start-->
                                                            <div class="modal fade"
                                                                id="editCommentModal-{{ $reply->id }}" tabindex="-1"
                                                                aria-labelledby="editCommentModalLabel-{{ $reply->id }}"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="editCommentModalLabel-{{ $reply->id }}"
                                                                                style="color: #000 !important;">Edit
                                                                                Comment</h5>
                                                                            <button type="button" class="border-0 bg-transparent ms-auto"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"><i class="fas fa-times" style="font-size: 20px; color: #000;"></i></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form method="POST"
                                                                                action="{{ route('posts.comments.update', [$post->id, $reply->id]) }}"
                                                                                class="ajax-edit-form"
                                                                                data-comment-id="{{ $reply->id }}">
                                                                                @csrf
                                                                                @method('PUT')
                                                                                <div class="mb-3">
                                                                                    <label
                                                                                        for="edit-comment-body-{{ $reply->id }}"
                                                                                        class="form-label"
                                                                                        style="color: #000 !important;">Edit
                                                                                        Comment</label>
                                                                                    <textarea name="body" id="edit-comment-body-{{ $reply->id }}" cols="45" rows="5"
                                                                                        class="form-control" required>{{ $reply->body }}</textarea>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button"
                                                                                        class="btn btn-secondary"
                                                                                        data-bs-dismiss="modal">Close</button>
                                                                                    <button class="theme-btn py-2 px-3"
                                                                                        type="submit">
                                                                                        Update
                                                                                    </button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- Edit Comment Modal End-->

                                                            <span><i class="far fa-clock"></i>
                                                                {{ $reply->created_at->format('F j, Y \a\t h:i A') }}</span>
                                                            <p class="comment-body-text-{{ $reply->id }}">
                                                                {{ $reply->body }}</p>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </div>

                                    <!-- Pagination Start-->
                                    <div class="pagination-area mt-4">
                                        {{ $comments->links() }}
                                    </div>
                                    <!-- Pagination End-->

                                    <div class="blog-comment-form">
                                        @auth
                                            <h3>Leave A Comment</h3>
                                            <form method="POST" action="{{ route('posts.comments.store', $post->id) }}"
                                                class="comment-form ajax-comment-form">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group mb-4">
                                                            <div class="form-icon">
                                                                <i class="far fa-pen"></i>
                                                                <textarea name="body" cols="30" rows="5" class="form-control" placeholder="Your Comment*" required></textarea>
                                                            </div>
                                                        </div>
                                                        <button type="submit" class="theme-btn">Post Comment <i
                                                                class="far fa-paper-plane"></i></button>
                                                    </div>
                                                </div>
                                            </form>
                                        @else
                                            <h3><a href="{{ route('login') }}" class="text-gradient">Log in</a> to leave a
                                                comment.</h3>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <aside class="blog-sidebar">
                            <!-- search-->
                            <div class="widget search">
                                <h5 class="widget-title">Search</h5>
                                <div class="search-form">
                                    <form action="{{ route('news.search') }}" method="GET">
                                        <div class="form-group">
                                            <input type="text" name="query" class="form-control"
                                                placeholder="Search Here..." />
                                            <button type="submit"><i class="far fa-search"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- category -->
                            <div class="widget category">
                                <h5 class="widget-title">Category</h5>
                                <div class="category-list">
                                    @forelse ($postCategories as $category)
                                        <a href="{{ route('news.search', ['category' => $category->id]) }}"><i
                                                class="far fa-arrow-right"></i>{{ $category->title }}<span>({{ $category->posts_count ?? 0 }})</span></a>
                                    @empty
                                    @endforelse
                                </div>
                            </div>

                            <!-- recent post -->
                            <div class="widget recent-post">
                                <h5 class="widget-title">Recent / Popular Post</h5>
                                @forelse ($popularPosts as $popPost)
                                    <div class="recent-post-item">
                                        <div class="recent-post-img">
                                            @if ($popPost->post_image)
                                                <img src="{{ asset('uploads/posts/' . $popPost->post_image) }}"
                                                    alt="{{ $popPost->title }}" />
                                            @else
                                                <img src="{{ asset('assets/frontend/img/blog/bs-1.jpg') }}"
                                                    alt="{{ $popPost->title }}" />
                                            @endif
                                        </div>
                                        <div class="recent-post-info">
                                            <h6><a
                                                    href="{{ route('news.details', $popPost->id) }}">{{ Str::limit($popPost->title, 50) }}</a>
                                            </h6>
                                            <span><i
                                                    class="far fa-clock"></i>{{ $popPost->created_at->format('M d, Y') }}</span>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-muted text-center">No posts found</p>
                                @endforelse
                            </div>

                            <!-- social share -->
                            <div class="widget social">
                                <h5 class="widget-title">Follow Us</h5>
                                <div class="social-link">
                                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#"><i class="fab fa-x-twitter"></i></a>
                                    <a href="#"><i class="fab fa-dribbble"></i></a>
                                    <a href="#"><i class="fab fa-whatsapp"></i></a>
                                    <a href="#"><i class="fab fa-youtube"></i></a>
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
        <!-- blog single end -->
    </main>
@endsection

@push('frontend_script')
    <script>
        $(document).ready(function() {
            // CSRF token configuration for ajax setup
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            const csrfToken = $('meta[name="csrf-token"]').attr('content');
            const storeUrl = "{{ route('posts.comments.store', $post->id) }}";

            // Toggle Reply Form
            $(document).on('click', '.reply-toggle-btn', function(e) {
                e.preventDefault();
                let targetId = $(this).data('target');
                $('#' + targetId).toggleClass('d-none');
            });

            // AJAX Comment & Reply Submission
            $(document).on('submit', '.ajax-comment-form', function(e) {
                e.preventDefault();
                let form = $(this);
                let submitBtn = form.find('button[type="submit"]');
                let textarea = form.find('textarea[name="body"]');
                let parentId = form.find('input[name="parent_id"]').val() || null;

                if (!textarea.val().trim()) {
                    toastr.error('Please write a comment first.');
                    return;
                }

                submitBtn.prop('disabled', true).html(
                    'Submitting... <i class="fas fa-spinner fa-spin"></i>');

                $.ajax({
                    url: form.attr('action') || storeUrl,
                    type: 'POST',
                    data: form.serialize(),
                    success: function(res) {
                        if (res.status === 'success') {
                            let comment = res.comment;

                            // Generate new item HTML
                            let html = '';
                            if (parentId) {
                                html = `
                            <div class="blog-comment-item reply ms-5 mb-3" id="comment-container-${comment.id}">
                                <img src="${res.user_avatar}" alt="avatar" />
                                <div class="blog-comment-content w-100">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5>${res.user_name}</h5>
                                        <div class="d-flex align-items-center">
                                            ${res.is_owner ? `
                                                    <a href="#"
                                                        class="btn btn-sm mt-0 p-1" style="color: #15d4c9;"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editCommentModal-${comment.id}">
                                                        <i class="fas fa-edit fa-fw"></i>
                                                    </a>
                                                ` : ''}
                                            ${res.can_delete ? `
                                                    <form action="${res.destroy_url}" method="POST" class="d-inline ajax-delete-form">
                                                        <input type="hidden" name="_token" value="${csrfToken}">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="submit" class="btn btn-sm ajax-delete-btn p-1" style="color: #fd6a6a;">
                                                            <i class="fas fa-trash-alt fa-fw"></i>
                                                        </button>
                                                    </form>
                                                ` : ''}
                                        </div>
                                    </div>

                                    <!-- Edit Comment Modal Start-->
                                    <div class="modal fade" id="editCommentModal-${comment.id}"
                                        tabindex="-1" aria-labelledby="editCommentModalLabel-${comment.id}"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editCommentModalLabel-${comment.id}" style="color: #000 !important;">Edit Comment</h5>
                                                    <button type="button" class="border-0 bg-transparent ms-auto"
                                                        data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times" style="font-size: 20px; color: #000;"></i></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="${res.update_url}" class="ajax-edit-form" data-comment-id="${comment.id}">
                                                        <input type="hidden" name="_token" value="${csrfToken}">
                                                        <input type="hidden" name="_method" value="PUT">
                                                        <div class="mb-3">
                                                            <label for="edit-comment-body-${comment.id}"
                                                                class="form-label" style="color: #000 !important;">Edit Comment</label>
                                                            <textarea name="body" id="edit-comment-body-${comment.id}" cols="45" rows="5"
                                                                class="form-control" required>${comment.body}</textarea>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button class="theme-btn py-2 px-3" type="submit">
                                                                Update
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Edit Comment Modal End-->

                                    <span><i class="far fa-clock"></i> ${res.time}</span>
                                    <p class="comment-body-text-${comment.id}">${comment.body}</p>
                                </div>
                            </div>
                        `;

                                // Append to the replies list
                                $(`#replies-list-${parentId}`).append(html);
                                // Hide reply form
                                $(`#replyForm-${parentId}`).addClass('d-none');
                                // Reset reply textarea
                                textarea.val('');

                                // Update parent reply count label
                                let replyCountEl = $(`.reply-count-${parentId}`);
                                let repliesCountVal = parseInt(replyCountEl.text()) || 0;
                                replyCountEl.text(repliesCountVal + 1);

                            } else {
                                html = `
                            <div class="blog-comment-item mb-4" id="comment-container-${comment.id}">
                                <img src="${res.user_avatar}" alt="avatar" />
                                <div class="blog-comment-content w-100">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5>${res.user_name}</h5>
                                        <div class="d-flex align-items-center">
                                            ${res.is_owner ? `
                                                    <a href="#"
                                                        class="btn btn-sm mt-0 p-1" style="color: #15d4c9;"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editCommentModal-${comment.id}">
                                                        <i class="fas fa-edit fa-fw"></i>
                                                    </a>
                                                ` : ''}
                                            ${res.can_delete ? `
                                                    <form action="${res.destroy_url}" method="POST" class="d-inline ajax-delete-form">
                                                        <input type="hidden" name="_token" value="${csrfToken}">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="submit" class="btn btn-sm ajax-delete-btn p-1" style="color: #fd6a6a;">
                                                            <i class="fas fa-trash-alt fa-fw"></i>
                                                        </button>
                                                    </form>
                                                ` : ''}
                                        </div>
                                    </div>

                                    <!-- Edit Comment Modal Start-->
                                    <div class="modal fade" id="editCommentModal-${comment.id}"
                                        tabindex="-1" aria-labelledby="editCommentModalLabel-${comment.id}"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editCommentModalLabel-${comment.id}" style="color: #000 !important;">Edit Comment</h5>
                                                    <button type="button" class="border-0 bg-transparent ms-auto"
                                                        data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times" style="font-size: 20px; color: #000;"></i></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="${res.update_url}" class="ajax-edit-form" data-comment-id="${comment.id}">
                                                        <input type="hidden" name="_token" value="${csrfToken}">
                                                        <input type="hidden" name="_method" value="PUT">
                                                        <div class="mb-3">
                                                            <label for="edit-comment-body-${comment.id}"
                                                                class="form-label" style="color: #000 !important;">Edit Comment</label>
                                                            <textarea name="body" id="edit-comment-body-${comment.id}" cols="45" rows="5"
                                                                class="form-control" required>${comment.body}</textarea>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button class="theme-btn py-2 px-3" type="submit">
                                                                Update
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Edit Comment Modal End-->

                                    <span><i class="far fa-clock"></i> ${res.time}</span>
                                    <p class="comment-body-text-${comment.id}">${comment.body}</p>
                                    <a href="javascript:void(0);" class="reply-toggle-btn" data-target="replyForm-${comment.id}">
                                        <i class="far fa-reply"></i> Reply (<span class="reply-count-${comment.id}">0</span>)
                                    </a>
                                </div>
                            </div>

                            <!-- Reply Form -->
                            <div id="replyForm-${comment.id}" class="d-none ms-5 mb-4 p-3 border rounded bg-light">
                                <form class="comment-form ajax-comment-form" method="POST"
                                    action="${storeUrl}">
                                    <input type="hidden" name="_token" value="${csrfToken}">
                                    <input type="hidden" name="parent_id" value="${comment.id}">
                                    <div class="form-group mb-2">
                                        <textarea name="body" class="form-control" cols="45" rows="3" placeholder="Write a reply..." required="required"></textarea>
                                    </div>
                                    <button class="theme-btn py-2 px-3" type="submit" style="font-size: 14px;">
                                        Post Reply <i class="far fa-paper-plane"></i>
                                    </button>
                                </form>
                            </div>

                            <!-- Nested Replies -->
                            <div id="replies-list-${comment.id}"></div>
                        `;

                                // Append comment to main wrapper
                                $('#comments-container-wrapper').append(html);
                                textarea.val('');
                            }

                            // Update total comment count header
                            let totalCommentsEl = $('.blog-comment h3');
                            let currentCount = parseInt(totalCommentsEl.text().replace(/\D/g,
                                ''));
                            if (!isNaN(currentCount)) {
                                totalCommentsEl.text('Comments (' + (currentCount + 1) + ')');
                            } else {
                                totalCommentsEl.text('Comments (1)');
                            }

                            toastr.success(res.message);
                        }
                    },
                    error: function(xhr) {
                        toastr.error(xhr.responseJSON?.message ||
                            'Something went wrong. Please check your input.');
                    },
                    complete: function() {
                        submitBtn.prop('disabled', false).html(parentId ?
                            'Post Reply <i class="far fa-paper-plane"></i>' :
                            'Post Comment <i class="far fa-paper-plane"></i>');
                    }
                });
            });

            // AJAX Comment/Reply Update (Modal Form Submission)
            $(document).on('submit', '.ajax-edit-form', function(e) {
                e.preventDefault();
                let form = $(this);
                let commentId = form.data('comment-id');
                let submitBtn = form.find('button[type="submit"]');
                let textarea = form.find('textarea[name="body"]');

                submitBtn.prop('disabled', true).html('Updating... <i class="fas fa-spinner fa-spin"></i>');

                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: form.serialize(),
                    success: function(res) {
                        if (res.status === 'success') {
                            // Update comment body text in the UI
                            $(`.comment-body-text-${commentId}`).text(res.body);

                            // Close bootstrap modal
                            let modalEl = document.getElementById(
                                `editCommentModal-${commentId}`);
                            let modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap
                                .Modal(modalEl);
                            modal.hide();

                            toastr.success(res.message);
                        }
                    },
                    error: function(xhr) {
                        toastr.error(xhr.responseJSON?.message || 'Unable to update comment');
                    },
                    complete: function() {
                        submitBtn.prop('disabled', false).text('Update');
                    }
                });
            });

            // AJAX Comment/Reply Delete (SweetAlert + AJAX Delete Request)
            $(document).on('submit', '.ajax-delete-form', function(e) {
                e.preventDefault();
            });

            $(document).on('click', '.ajax-delete-btn', function(e) {
                e.preventDefault();
                let btn = $(this);
                let form = btn.closest('form');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: form.attr('action'),
                            type: 'POST',
                            data: form.serialize(),
                            success: function(res) {
                                if (res.status === 'success') {
                                    // Find the container and fade out
                                    let container = form.closest('.blog-comment-item');
                                    let commentId = container.attr('id').split('-')
                                    .pop();

                                    // If it's a nested reply, decrement parent reply count
                                    let parentRepliesWrapper = container.closest(
                                        '[id^="replies-list-"]');
                                    if (parentRepliesWrapper.length) {
                                        let parentId = parentRepliesWrapper.attr('id')
                                            .split('-').pop();
                                        let replyCountEl = $(
                                        `.reply-count-${parentId}`);
                                        let repliesCountVal = parseInt(replyCountEl
                                            .text()) || 0;
                                        replyCountEl.text(Math.max(0, repliesCountVal -
                                            1));
                                    }

                                    // Remove element
                                    container.fadeOut(500, function() {
                                        $(this).remove();
                                        // Also remove reply form and nested lists if it was a parent comment
                                        $(`#replyForm-${commentId}`).remove();
                                        $(`#replies-list-${commentId}`)
                                    .remove();
                                    });

                                    // Decrement global comment count
                                    let totalCommentsEl = $('.blog-comment h3');
                                    let currentCount = parseInt(totalCommentsEl.text()
                                        .replace(/\D/g, ''));
                                    if (!isNaN(currentCount)) {
                                        totalCommentsEl.text('Comments (' + Math.max(0,
                                            currentCount - 1) + ')');
                                    }

                                    toastr.success(res.message);
                                }
                            },
                            error: function(xhr) {
                                toastr.error(xhr.responseJSON?.message ||
                                    'Unable to delete comment');
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush
