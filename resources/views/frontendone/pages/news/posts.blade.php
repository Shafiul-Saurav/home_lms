@extends('frontendone.layouts.master')

@section('title', 'Posts')

@push('frontendone_style')
    @include('frontend.pages.common.style')
@endpush

@section('frontendone_content')
    <main class="main">
        <!-- breadcrumb -->
        <x-frontend.pages.common.breadcrumb
            :title="'Posts'"
            :breadcrumb="[
                ['name' => 'Home', 'url' => route('home')],
                ['name' => 'Posts', 'url' => '#']
            ]"
        />
        <!-- breadcrumb end -->
        <div class="blog-area py-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mx-auto">
                        <div class="site-heading text-center wow fadeInDown" data-wow-delay=".25s">
                            <span class="site-title-tagline"><i class="far fa-lightbulb-on"></i> Our Blog</span>
                            <h2 class="site-title">Our Latest News <span class="text-gradient">And Blog</span></h2>
                        </div>
                    </div>
                </div>

                <div class="row g-4" id="newsGrid">
                    @foreach($posts as $post)
                        @php
                            $newsType = strtolower($post->postCategory->title ?? 'news');
                            if (!in_array($newsType, ['news', 'blog'])) {
                                $newsType = 'news';
                            }
                        @endphp
                        <div class="col-lg-4 col-md-6" data-news-type="{{ $newsType }}">
                            <div class="news-card">
                                <div class="news-img">
                                    <img src="{{ $post->post_image ? asset('uploads/posts/' . $post->post_image) : 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=800&q=80' }}"
                                        alt="{{ $post->title }}">
                                    <span class="news-badge">{{ $post->postCategory->title ?? 'News' }}</span>
                                </div>

                                <div class="news-content">
                                    <div class="news-meta">
                                        <span><i class="fa-regular fa-calendar"></i> {{ $post->created_at ? $post->created_at->format('d M, Y') : '' }}</span>
                                        <span><i class="fa-regular fa-user"></i> {{ $post->user->name ?? 'Admin' }}</span>
                                    </div>

                                    <h3>{{ $post->title }}</h3>

                                    <p>
                                        {{ \Illuminate\Support\Str::words(strip_tags($post->short_des ?? $post->description), 15, '...') }}
                                    </p>

                                    <a href="{{ route('news.details', $post->id) }}" class="read-more">
                                        Read More <i class="fa-solid fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        
    </main>
@endsection

@push('frontendone_script')
    @include('frontend.pages.common.script')
@endpush