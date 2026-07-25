@extends('frontendone.layouts.master')

@section('title', $post->title ?? 'Post Details')

@push('frontendone_style')
    @include('frontend.pages.common.style')
    <style>
        .sidebar-widget .sidebar-item {
            padding-bottom: 0.85rem;
            margin-bottom: 0.85rem;
            border-bottom: 1px dotted rgba(118, 189, 16, 0.35);
        }
        .sidebar-widget .sidebar-item:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }
        .sidebar-widget .sidebar-item a {
            text-decoration: none;
        }
    </style>
@endpush

@section('frontendone_content')
    <main class="main" data-aos="fade-up">
        <x-frontend.pages.common.breadcrumb :title="$post->title ?? 'Post Details'" :breadcrumb="[
            ['name' => 'Home', 'url' => route('home')],
            ['name' => 'Posts', 'url' => route('news.search')],
            ['name' => $post->title ?? 'Post Details', 'url' => '#'],
        ]" />

        <section class="section-padding py-5">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-8">
                        <article class="blog-single-wrap">
                            <div class="blog-thumb-img rounded overflow-hidden mb-4">
                                @if($post->post_image)
                                    <img src="{{ asset('uploads/posts/' . $post->post_image) }}" alt="{{ $post->title }}" class="img-fluid w-100" />
                                @else
                                    <img src="{{ asset('assets/frontend/img/blog/single.jpg') }}" alt="{{ $post->title }}" class="img-fluid w-100" />
                                @endif
                            </div>

                            <div class="blog-info mb-4">
                                <div class="d-flex flex-column flex-sm-row gap-3 align-items-start align-items-sm-center justify-content-between">
                                    <div class="blog-meta">
                                        <ul class="list-unstyled d-flex flex-wrap gap-3 mb-0">
                                            <li><i class="far fa-user-circle"></i> {{ $post->user->name ?? 'Admin' }}</li>
                                            <li><i class="far fa-calendar"></i> {{ $post->created_at?->format('d M, Y') }}</li>
                                            {{-- <li><i class="far fa-comments"></i> {{ $comments->total() }} Comments</li> --}}
                                            @if($post->postCategory)
                                                <li><i class="far fa-folder"></i> {{ $post->postCategory->title }}</li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="blog-details mb-5">
                                <h2 class="mb-3">{{ $post->title }}</h2>
                                @if($post->description)
                                    <div class="mb-4">{!! $post->description !!}</div>
                                @endif

                                @if($post->short_des)
                                    <blockquote class="blockquote p-4 rounded shadow-sm bg-white border-start border-4" style="border-color: #76bd10 !important;">
                                        <p class="mb-2">{!! $post->short_des !!}</p>
                                        <footer class="blockquote-footer">{{ $post->user->name ?? 'Author' }}</footer>
                                    </blockquote>
                                @endif

                                @if($post->long_des)
                                    <div class="mt-4">{!! $post->long_des !!}</div>
                                @endif
                            </div>

                            <div class="blog-author d-flex align-items-center gap-3 rounded p-4 bg-white shadow-sm mb-5">
                                <div class="author-thumb rounded-circle overflow-hidden" style="width:72px; height:72px;">
                                    @if($post->user->profile && $post->user->profile->profileImage)
                                        <img src="{{ asset($post->user->profile->profileImage->profile_image) }}" alt="{{ $post->user->name }}" class="img-fluid" />
                                    @elseif($post->user->profile_photo_path)
                                        <img src="{{ asset($post->user->profile_photo_path) }}" alt="{{ $post->user->name }}" class="img-fluid" />
                                    @else
                                        <img src="{{ asset('assets/backend/images/faces/admin.png') }}" alt="{{ $post->user->name ?? 'Author' }}" class="img-fluid" />
                                    @endif
                                </div>
                                <div>
                                    <h5 class="mb-1">{{ $post->user->name ?? 'Author' }}</h5>
                                    <p class="mb-0 text-muted">Contributor and content creator sharing insights and news.</p>
                                </div>
                            </div>

                            <div class="post-navigation d-flex flex-column flex-md-row justify-content-between gap-3 mb-5">
                                <div class="nav-prev">
                                    @if($previousPost)
                                        <a href="{{ route('news.details', $previousPost->id) }}" class="enroll-btn">
                                            <i class="fas fa-arrow-left me-2"></i> Prev Post
                                        </a>
                                    @endif
                                </div>
                                <div class="nav-next text-md-end">
                                    @if($nextPost)
                                        <a href="{{ route('news.details', $nextPost->id) }}" class="enroll-btn">
                                            Next Post <i class="fas fa-arrow-right ms-2"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>

                            {{-- <div class="blog-comment">
                                <h4 class="mb-4">Comments ({{ $comments->total() }})</h4>
                                <div class="comment-list">
                                    @forelse($comments as $comment)
                                        <div class="comment-item mb-4 p-4 bg-white border rounded shadow-sm">
                                            <div class="d-flex align-items-start gap-3 mb-3">
                                                <div class="comment-avatar rounded-circle overflow-hidden" style="width:56px; height:56px;">
                                                    @if($comment->user->profile && $comment->user->profile->profileImage)
                                                        <img src="{{ asset($comment->user->profile->profileImage->profile_image) }}" alt="{{ $comment->user->name }}" class="img-fluid" />
                                                    @elseif($comment->user->profile_photo_path)
                                                        <img src="{{ asset($comment->user->profile_photo_path) }}" alt="{{ $comment->user->name }}" class="img-fluid" />
                                                    @else
                                                        <img src="{{ asset('assets/backend/images/faces/admin.png') }}" alt="{{ $comment->user->name }}" class="img-fluid" />
                                                    @endif
                                                </div>
                                                <div>
                                                    <h6 class="mb-1">{{ $comment->user->name }}</h6>
                                                    <span class="text-muted">{{ $comment->created_at->format('F j, Y \a\t h:i A') }}</span>
                                                </div>
                                            </div>
                                            <p>{!! nl2br(e($comment->body)) !!}</p>
                                        </div>
                                    @empty
                                        <div class="alert alert-warning">No comments yet. Be the first to comment.</div>
                                    @endforelse
                                </div>

                                @if($comments->hasPages())
                                    <div class="mt-4">
                                        {{ $comments->links('pagination::bootstrap-5') }}
                                    </div>
                                @endif
                            </div> --}}
                        </article>
                    </div>

                    <div class="col-lg-4">
                        <div class="sidebar-widget p-4 bg-white mb-4" style="border-radius:24px; box-shadow:0 15px 45px rgba(0,0,0,0.06); border:1px solid var(--border-light);">
                            <h5 class="mb-4" style="color: #76bd10;">Category</h5>
                            <ul class="list-unstyled mb-0">
                                @foreach($postCategories ?? [] as $category)
                                    <li class="sidebar-item">
                                        <a href="{{ route('news.search', ['category' => $category->id]) }}" class="text-dark d-flex justify-content-between align-items-center">
                                            <span>{{ $category->title }}</span>
                                            <small class="text-muted">({{ $category->posts_count ?? 0 }})</small>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="sidebar-widget p-4 bg-white" style="border-radius:24px; box-shadow:0 15px 45px rgba(0,0,0,0.06); border:1px solid var(--border-light);">
                            <h5 class="mb-4" style="color: #76bd10;">Related Posts</h5>
                            @foreach($popularPosts ?? [] as $popular)
                                <div class="related-post sidebar-item d-flex gap-3 align-items-center">
                                    <div class="flex-shrink-0 rounded overflow-hidden" style="width:70px; height:70px;">
                                        <img src="{{ $popular->post_image ? asset('uploads/posts/' . $popular->post_image) : asset('assets/frontend/img/blog/single.jpg') }}" alt="{{ $popular->title }}" class="img-fluid" />
                                    </div>
                                    <div>
                                        <a href="{{ route('news.details', $popular->id) }}" class="d-block fw-semibold" style="color: #2c3e50; text-decoration:none;">{{ Str::limit($popular->title, 55) }}</a>
                                        <span class="text-muted" style="font-size:13px;">{{ $popular->created_at?->format('d M, Y') }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('frontendone_script')
    @include('frontend.pages.common.script')
@endpush
