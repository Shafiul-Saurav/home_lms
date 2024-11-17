@extends('frontend.layouts.master')

@section('title', 'News Details')

@push('frontend_style')
    @include('frontend.pages.common.style')
@endpush

@section('frontend_content')
    <!-- Start Page Title Area -->
    <div class="page-title-area" style="background-image: url('{{ asset('assets/frontend/img/page-bg.jpg') }}')">
        <div class="container">
            <div class="page-title-content">
                <h2>News Details</h2>
                <ul>
                    <li>
                        <a href="index.html">
                            Home
                        </a>
                    </li>
                    <li>News Details</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->

    <!-- Start News Details Area -->
    <section class="news-details-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="news-details-desc">
                        <div class="article-image">
                            <img src="{{ asset('uploads/posts') }}/{{ $post->post_image }}" alt="image">
                        </div>

                        <div class="article-content">
                            <div class="entry-meta">
                                <ul>
                                    <li><span>Posted On:</span> <a
                                            href="news-details.html">{{ $post->created_at->format('F j, Y') }}</a></li>
                                    <li><span>Posted By:</span> <a href="news-details.html">{{ $post->user->name }}</a></li>
                                </ul>
                            </div>

                            <h3>{{ $post->title }}</h3>

                            <p>{{ $post->description }}</p>

                            <blockquote class="flaticon-quote">
                                <p>{{ $post->short_des }}</p>
                            </blockquote>

                            <p>{{ $post->long_des }}</p>

                        </div>

                        <div class="article-footer">
                            <div class="article-tags">
                                <span><i class='bx bx-share-alt'></i></span>

                                <a href="javascript:;">Share</a>
                            </div>

                            <div class="article-share">
                                <ul class="social">
                                    <li>
                                        <a href="https://www.facebook.com/" target="_blank">
                                            <i class='bx bxl-facebook'></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.twitter.com/" target="_blank">
                                            <i class='bx bxl-twitter'></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.linkedin.com/" target="_blank">
                                            <i class='bx bxl-linkedin'></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.linkedin.com/" target="_blank">
                                            <i class='bx bxl-pinterest-alt'></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="post-navigation">
                            <div class="navigation-links">
                                <div class="nav-previous">
                                    @if ($previousPost)
                                        <a href="{{ route('news.details', $previousPost->id) }}"><i
                                                class='bx bx-left-arrow-alt'></i> Prev Post</a>
                                    @endif
                                </div>

                                <div class="nav-next">
                                    @if ($nextPost)
                                        <a href="{{ route('news.details', $nextPost->id) }}">Next Post <i
                                                class='bx bx-right-arrow-alt'></i></a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Comment Area Start -->
                        <div class="comments-area">
                            <!-- Comment Form for Authenticated Users Start-->
                            @auth
                                <div class="comment-respond">
                                    <h3 class="comment-reply-title">Leave a Reply (Comments({{ $post->comments->count() }}))
                                    </h3>

                                    <form class="comment-form" method="POST"
                                        action="{{ route('posts.comments.store', $post->id) }}">
                                        @csrf
                                        <p class="comment-form-comment">
                                            <label>Comment</label>
                                            <textarea name="body" id="comment" cols="45" rows="5" maxlength="65525" required="required"></textarea>
                                        </p>
                                        <p class="form-submit">
                                            <button class="default-btn btn-two" type="submit" fdprocessedid="ovgpxa">
                                                Post A Comment
                                                <i class="flaticon-right"></i>
                                            </button>
                                        </p>
                                    </form>
                                </div>
                            @endauth
                            <!-- Comment Form for Authenticated Users End-->

                            <!-- For Guest Start-->
                            @guest
                                <div class="comment-respond">
                                    <h3 class="comment-reply-title"><a href="{{ route('login') }}">Log in</a> to leave a
                                        comment.</h3>
                                </div>
                            @endguest
                            <!-- For Guest End-->
                            <ol class="comment-list">
                                @foreach ($comments->where('parent_id', null) as $comment)
                                    <li class="comment">
                                        <div class="comment-body comment-respond">
                                            <footer class="comment-meta">
                                                <div class="comment-author vcard d-flex justify-content-between">
                                                    @if ($comment->user->profile->profileImage??null)
                                                        <img src="{{$comment->user->profile->profileImage ? asset($comment->user->profile->profileImage->profile_image ?? null) : asset('profile/default_profile.png') }}"
                                                        class="avatar" alt="avatar">
                                                    @else
                                                        <img src="{{$comment->user->profile_photo_path ? asset($comment->user->profile_photo_path) : asset('assets/backend/images/faces/admin.png') }}"
                                                        class="avatar" alt="avatar">
                                                    @endif

                                                    <b class="fn">{{ $comment->user->name }}</b>
                                                    <span class="says">says:</span>
                                                    <div class="d-flex">
                                                        <!-- Edit Option Start-->
                                                        @if (auth()->check() && (auth()->user()->id === $comment->user_id))
                                                            <a href="#"
                                                                class="btn btn-sm btn-outline-info border me-2"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#editCommentModal-{{ $comment->id }}">
                                                                <i class="fa-solid fa-pen fa-fw"></i>
                                                            </a>
                                                        @endif
                                                        <!-- Edit Option End-->

                                                        <!-- Delete Option Start-->
                                                        @if (auth()->check() && (auth()->user()->id === $comment->user_id || in_array(auth()->user()->role_id, [1, 2, 3])))
                                                            <form
                                                                action="{{ route('posts.comments.destroy', [$post->id, $comment->id]) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-sm btn-outline-danger border show_confirm"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    data-bs-original-title="Delete">
                                                                    <i class="fa-solid fa-trash-can fa-fw"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                        <!-- Delete Option Start-->
                                                    </div>
                                                </div>
                                                <!-- Edit Comment Modal Start-->
                                                <div class="modal fade" id="editCommentModal-{{ $comment->id }}"
                                                    tabindex="-1" aria-labelledby="editCommentModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="editCommentModalLabel">Edit
                                                                    Comment</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="POST"
                                                                    action="{{ route('posts.comments.update', [$post->id, $comment->id]) }}">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="mb-3">
                                                                        <label for="edit-comment-body-{{ $comment->id }}"
                                                                            class="form-label">Edit Comment</label>
                                                                        <textarea name="body" id="edit-comment-body-{{ $comment->id }}" cols="45" rows="5"
                                                                            class="form-control" required>{{ $comment->body }}</textarea>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button class="default-btn btn-two" type="submit"
                                                                            fdprocessedid="ovgpxa">
                                                                            Update
                                                                            <i class="flaticon-right"></i>
                                                                        </button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Edit Comment Modal End-->

                                                <div class="comment-metadata">
                                                    <span>{{ $comment->created_at->format('F j, Y \a\t h:i A') }}</span>
                                                </div>
                                            </footer>

                                            <div class="comment-content pb-4">
                                                <p>{{ $comment->body }}</p>
                                            </div>

                                            <div class="reply">
                                                <a href="javascript:void(0);" class="comment-reply-link"
                                                    onclick="document.getElementById('replyForm-{{ $comment->id }}').classList.toggle('d-none')">Reply
                                                    ({{ $comment->repliesCount() }})</a>
                                            </div>

                                            <!-- Reply Form -->
                                            <div id="replyForm-{{ $comment->id }}" class="d-none">
                                                <form class="comment-form" method="POST"
                                                    action="{{ route('posts.comments.store', $post->id) }}">
                                                    @csrf
                                                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                                    <p class="comment-form-comment">
                                                        <label>Comment</label>
                                                        <textarea name="body" cols="45" rows="5" maxlength="65525" required="required"></textarea>
                                                    </p>
                                                    <button class="default-btn btn-two" type="submit"
                                                        fdprocessedid="ovgpxa">
                                                        Post Reply
                                                        <i class="flaticon-right"></i>
                                                    </button>
                                                </form>

                                                <!-- Nested Replies -->
                                                <ol class="children pt-4">
                                                    @foreach ($comment->replies as $reply)
                                                        <li class="comment">
                                                            <div class="comment-body">
                                                                <footer class="comment-meta">
                                                                    <div
                                                                        class="comment-author vcard d-flex justify-content-between">
                                                                        @if ($reply->user->profile->profileImage??null)
                                                                            <img src="{{$reply->user->profile->profileImage ? asset($reply->user->profile->profileImage->profile_image ?? null) : asset('profile/default_profile.png') }}"
                                                                            class="avatar" alt="avatar">
                                                                        @else
                                                                            <img src="{{$reply->user->profile_photo_path ? asset($reply->user->profile_photo_path) : asset('assets/backend/images/faces/admin.png') }}"
                                                                            class="avatar" alt="avatar">
                                                                        @endif
                                                                        {{-- <img src="{{ asset($reply->user->profile->profileImage->profile_image ?? null) }}"
                                                                            class="avatar" alt="avatar"> --}}
                                                                        <b class="fn">{{ $reply->user->name }}</b>
                                                                        <span class="says">says:</span>

                                                                        <div class="d-flex">
                                                                            <!-- Edit Option Start-->
                                                                            @if (auth()->check() && (auth()->user()->id === $reply->user_id))
                                                                                <a href="#"
                                                                                    class="btn btn-sm btn-outline-info border me-2"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#editCommentModal-{{ $reply->id }}">
                                                                                    <i class="fa-solid fa-pen fa-fw"></i>
                                                                                </a>
                                                                            @endif
                                                                            <!-- Edit Option End-->

                                                                            <!-- Delete Option Start-->
                                                                            @if (auth()->check() && (auth()->user()->id === $reply->user_id || in_array(auth()->user()->role_id, [1, 2, 3])))
                                                                                <form
                                                                                    action="{{ route('posts.comments.destroy', [$post->id, $reply->id]) }}"
                                                                                    method="POST">
                                                                                    @csrf
                                                                                    @method('DELETE')
                                                                                    <button type="submit"
                                                                                        class="btn btn-sm btn-outline-danger border show_confirm"
                                                                                        data-toggle="tooltip"
                                                                                        data-placement="top"
                                                                                        data-bs-original-title="Delete">
                                                                                        <i
                                                                                            class="fa-solid fa-trash-can fa-fw"></i>
                                                                                    </button>
                                                                                </form>
                                                                            @endif
                                                                            <!-- Delete Option End-->
                                                                        </div>
                                                                    </div>
                                                                    <!-- Edit Comment Modal Start-->
                                                                    <div class="modal fade"
                                                                        id="editCommentModal-{{ $reply->id }}"
                                                                        tabindex="-1"
                                                                        aria-labelledby="editCommentModalLabel"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"
                                                                                        id="editCommentModalLabel">Edit
                                                                                        Comment</h5>
                                                                                    <button type="button"
                                                                                        class="btn-close"
                                                                                        data-bs-dismiss="modal"
                                                                                        aria-label="Close"></button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <form method="POST"
                                                                                        action="{{ route('posts.comments.update', [$post->id, $reply->id]) }}">
                                                                                        @csrf
                                                                                        @method('PUT')
                                                                                        <div class="mb-3">
                                                                                            <label
                                                                                                for="edit-comment-body-{{ $reply->id }}"
                                                                                                class="form-label">Edit
                                                                                                Comment</label>
                                                                                            <textarea name="body" id="edit-comment-body-{{ $reply->id }}" cols="45" rows="5"
                                                                                                class="form-control" required>{{ $reply->body }}</textarea>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button
                                                                                                class="default-btn btn-two"
                                                                                                type="submit"
                                                                                                fdprocessedid="ovgpxa">
                                                                                                Update
                                                                                                <i
                                                                                                    class="flaticon-right"></i>
                                                                                            </button>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- Edit Comment Modal End-->

                                                                    <div class="comment-metadata">
                                                                        <span>{{ $reply->created_at->format('F j, Y \a\t h:i A') }}</span>
                                                                    </div>
                                                                </footer>

                                                                <div class="comment-content">
                                                                    <p>{{ $reply->body }}</p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ol>
                                            </div>

                                        </div>
                                    </li>
                                @endforeach
                            </ol>
                            {{-- @php
                            $post->comments->paginate(1);
                        @endphp --}}
                            <div class="col-lg-12">
                            <div class="page-navigation-area">
                                {{ $comments->links() }}
                            </div>
                        </div>
                        </div>
                        <!-- Comment Area End-->
                    </div>
                </div>

                <div class="col-lg-4 col-md-12">
                    <aside class="widget-area" id="secondary">
                        <section class="widget widget-peru-posts-thumb">
                            <h3 class="widget-title">Popular Posts</h3>
                            <div class="post-wrap">
                                @forelse ($popularPosts as $post)
                                    <article class="item">
                                        <a href="{{ route('news.details', ['id' => $post->id]) }}" class="thumb">
                                            <span class="fullimage cover"
                                                style="background-image: url('{{ asset('uploads/posts') }}/{{ $post->post_image }}'); background-size: cover; background-position: center;"
                                                role="img"></span>
                                        </a>
                                        <div class="info">
                                            <time datetime="2024-06-30">{{ $post->created_at->format('M d, Y') }}</time>
                                            <h4 class="title usmall">
                                                <a href="{{ route('news.details', ['id' => $post->id]) }}">
                                                    {{ $post->title }}
                                                </a>
                                            </h4>
                                        </div>
                                        <div class="clear"></div>
                                    </article>
                                @empty
                                    No Post Found
                                @endforelse

                            </div>
                        </section>

                        {{-- <section class="widget widget_categories">
                        <h3 class="widget-title">Archives</h3>
                        <div class="post-wrap">
                            <ul>
                                <li>
                                    <a href="news-details.html">January <span>2024</span></a>
                                </li>
                                <li>
                                    <a href="news-details.html">February <span>2024</span></a>
                                </li>
                                <li>
                                    <a href="news-details.html">March <span>2024</span></a>
                                </li>
                                <li>
                                    <a href="news-details.html">April <span>2024</span></a>
                                </li>
                                <li>
                                    <a href="news-details.html">May <span>2024</span></a>
                                </li>
                                <li>
                                    <a href="news-details.html">June <span>2024</span></a>
                                </li>
                            </ul>
                        </div>
                    </section> --}}

                        <section class="widget widget_categories">
                            <h3 class="widget-title">Categories</h3>
                            <div class="post-wrap">
                                <ul>
                                    @forelse ($postCategories as $category)
                                        <li>
                                            <a href="news-details.html">{{ $category->title }}
                                                <span>({{ $category->posts->count() }})</span></a>
                                        </li>
                                    @empty
                                    @endforelse
                                </ul>
                            </div>
                        </section>

                        {{-- <section class="widget widget_meta">
                        <h3 class="widget-title">Meta</h3>
                        <div class="post-wrap">
                            <ul>
                                <li><a href="log-in.html">Log in</a></li>
                                <li><a href="news-details.html">Entries <abbr title="Really Simple Syndication">RSS</abbr></a></li>
                                <li><a href="news-details.html">Comments <abbr title="Really Simple Syndication">RSS</abbr></a></li>
                                <li><a href="news-details.html">WordPress.org</a></li>
                            </ul>
                        </div>
                    </section> --}}

                        {{-- <section class="widget widget_tag_cloud">
                        <h3 class="widget-title">Tags</h3>
                        <div class="post-wrap">
                            <div class="tagcloud">
                                <a href="news-details.html">Hotel (3)</a>
                                <a href="news-details.html">Booking (3)</a>
                                <a href="news-details.html">Tips (2)</a>
                                <a href="news-details.html">Uncategorized (2)</a>
                                <a href="news-details.html">Guarantee (1)</a>
                                <a href="news-details.html">Privacy (1)</a>
                                <a href="news-details.html">Reservations (1)</a>
                            </div>
                        </div>
                    </section> --}}
                    </aside>
                </div>
            </div>
        </div>
    </section>
    <!-- End News Details Area -->

@endsection

@push('frontend_script')
    @include('frontend.pages.common.script')
@endpush
