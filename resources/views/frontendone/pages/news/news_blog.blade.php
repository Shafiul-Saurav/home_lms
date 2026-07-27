@extends('frontendone.layouts.master')

@section('title', 'News & Blog')

@push('frontendone_style')
    @include('frontend.pages.common.style')
    <style>
        .section-header-wrap {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 30px;
        }

        .view-all-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 22px;
            border-radius: 50px;
            background: #111827;
            color: #fff;
            font-weight: 700;
            font-size: 13px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .view-all-btn:hover {
            background: #76bd10;
            color: #fff;
            transform: translateY(-2px);
        }
    </style>
@endpush

@section('frontendone_content')
    <main class="main">
        <!-- breadcrumb -->
        <x-frontend.pages.common.breadcrumb :title="'News & Blog'" :breadcrumb="[['name' => 'Home', 'url' => route('home')], ['name' => 'News & Blog', 'url' => '#']]"
            bgImage="assets/frontend/img/breadcrumb/news-bg.png" />
        <!-- breadcrumb end -->

        <div class="blog-area py-5">
            <div class="container">

                <!-- ══════════════════ SECTION 2: LATEST BLOG POSTS ══════════════════ -->
                <div class="blog-section mb-5" data-aos="fade-up">
                    <div class="section-heading">
                        <span class="sub-title">
                            <i class="fa-regular fa-newspaper"></i>
                            Articles &amp;
                            Insights
                        </span>
                        <h2>Blog Posts</h2>
                    </div>

                    <div class="row g-4">
                        @forelse($posts as $post)
                            <div class="col-lg-4 col-md-6">
                                <div class="news-card">
                                    <div class="news-img">
                                        <img src="{{ $post->post_image ? asset('uploads/posts/' . $post->post_image) : 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=800&q=80' }}"
                                            alt="{{ $post->title }}">
                                        <span class="news-badge">{{ $post->postCategory->title ?? 'Blog' }}</span>
                                    </div>
                                    <div class="news-content">
                                        <div class="news-meta">
                                            <span><i class="fa-regular fa-calendar"></i>
                                                {{ $post->created_at?->format('d M, Y') }}</span>
                                            <span><i class="fa-regular fa-user"></i>
                                                {{ $post->user->name ?? 'Admin' }}</span>
                                        </div>
                                        <h3>{{ $post->title }}</h3>
                                        <p>{{ \Illuminate\Support\Str::words(strip_tags($post->short_des ?? $post->description), 15, '...') }}
                                        </p>
                                        <a href="{{ route('news.details', $post->id) }}" class="read-more">
                                            Read More <i class="fa-solid fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center py-4">
                                <p class="text-muted">No blog posts found.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- ══════════════════ SECTION 1: LATEST NEWS ══════════════════ -->
                <div class="news-section pt-5" data-aos="fade-up">
                    <div class="section-heading">
                        <span class="sub-title">
                            <i class="fa-regular fa-newspaper"></i>
                            Latest Updates
                        </span>
                        <h2>All News</h2>
                    </div>

                    <div class="row g-4">
                        @forelse($news as $item)
                            <div class="col-lg-4 col-md-6">
                                <div class="news-card">
                                    <div class="news-img">
                                        <img src="{{ $item->news_image ? asset('uploads/news/' . $item->news_image) : 'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?auto=format&fit=crop&w=800&q=80' }}"
                                            alt="{{ $item->title }}">
                                        <span class="news-badge">{{ $item->newsCategory->title ?? 'News' }}</span>
                                    </div>
                                    <div class="news-content">
                                        <div class="news-meta">
                                            <span><i class="fa-regular fa-calendar"></i>
                                                {{ $item->created_at?->format('d M, Y') }}</span>
                                            <span><i class="fa-regular fa-user"></i>
                                                {{ $item->user->name ?? 'Admin' }}</span>
                                        </div>
                                        <h3>{{ $item->title }}</h3>
                                        <p>{{ \Illuminate\Support\Str::words(strip_tags($item->short_des ?? $item->description), 15, '...') }}
                                        </p>
                                        <a href="{{ route('frontend.news.show', $item->id) }}" class="read-more">
                                            Read More <i class="fa-solid fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center py-4">
                                <p class="text-muted">No news articles found.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </main>
@endsection

@push('frontendone_script')
    @include('frontend.pages.common.script')
@endpush
