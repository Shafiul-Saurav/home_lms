@extends('frontend.layouts.master')

@section('title', 'Posts')

@push('frontend_style')
@endpush

@section('frontend_content')
    <main class="main">
        <!-- breadcrumb -->
        <x-frontend.pages.common.breadcrumb :title="'Posts'" :breadcrumb="[['name' => 'Home', 'url' => route('home')], ['name' => 'Posts', 'url' => '#']]" />
        <!-- breadcrumb end -->


        <!-- blog-area -->
        <div class="blog-area py-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mx-auto">
                        <div class="site-heading text-center wow fadeInDown" data-wow-delay=".25s">
                            <span class="site-title-tagline"><i class="far fa-lightbulb-on"></i> Our Blog</span>
                            <h2 class="site-title">Our Latest News <span class="text-gradient">And Blog</span></h2>
                        </div>
                    </div>
                </div>
                <div class="row g-4">
                    @forelse ($posts as $post)
                        <div class="col-md-6 col-lg-4">
                            <div class="blog-item wow fadeInUp" data-wow-delay=".25s">
                                <div class="blog-date">{{ $post->created_at->format('M d, Y') }}</div>
                                <div class="blog-img">
                                    @if ($post->post_image)
                                        <img src="{{ asset('uploads/posts/' . $post->post_image) }}" alt="{{ $post->title }}" />
                                    @else
                                        <img src="{{ asset('assets/frontend/img/blog/01.jpg') }}" alt="{{ $post->title }}" />
                                    @endif
                                </div>
                                <div class="blog-meta">
                                    <ul>
                                        <li>
                                            <a href="{{ route('news.details', $post->id) }}"><i class="far fa-user-circle"></i> By {{ $post->user->name ?? 'Admin' }}</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('news.details', $post->id) }}"><i class="far fa-comments"></i> {{ $post->comments->count() }} Comments</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="blog-info">
                                    @if ($post->postCategory)
                                        <span class="badge bg-primary mb-2" style="font-size: 11px; background-color: var(--theme-color) !important;">{{ $post->postCategory->title }}</span>
                                    @endif
                                    <h4 class="blog-title">
                                        <a href="{{ route('news.details', $post->id) }}">{{ $post->title }}</a>
                                    </h4>
                                    <p>{{ Str::limit($post->short_des, 120) }}</p>
                                    <a class="theme-btn" href="{{ route('news.details', $post->id) }}">Read More<i class="fas fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5">
                            <h3>No Posts Found</h3>
                            <p>Try searching for something else or view all posts.</p>
                        </div>
                    @endforelse
                </div>
                <!-- pagination -->
                <div class="pagination-area">
                    {{ $posts->links() }}
                </div>
                <!-- pagination end -->
            </div>
        </div>
        <!-- blog-area end -->
    </main>
@endsection

@push('frontend_script')
@endpush
