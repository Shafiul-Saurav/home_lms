@extends('frontend.layouts.master')

@section('title', 'News')

@push('frontend_style')
    @include('frontend.pages.common.style')
@endpush

@section('frontend_content')
<!-- Start Page Title Area -->
<div class="page-title-area" style="background-image: url('{{ asset('assets/frontend/img/page-bg.jpg') }}')">
    <div class="container">
        <div class="page-title-content">
            <h2>News</h2>
            <ul>
                <li>
                    <a href="index.html">
                        Home
                    </a>
                </li>
                <li>News</li>
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
                    <div class="row">
                        @forelse ($posts as $post)
                        <div class="col-lg-12 col-md-6">
                            <div class="single-news">
                                <div class="news-img">
                                    <a href="{{ route('news.details', ['id' => $post->id]) }}">
                                        <img src="{{ asset('uploads/posts') }}/{{ $post->post_image }}" alt="Image">
                                    </a>
                                    <div class="dates">
                                        <span>{{ $post->postCategory->title }}</span>
                                    </div>
                                </div>
                                <div class="news-content-wrap">
                                    <ul>
                                        <li>
                                            <a href="{{ route('news.details', ['id' => $post->id]) }}">
                                                <i class="flaticon-user"></i>
                                                {{ $post->user->name }}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('news.details', ['id' => $post->id]) }}">
                                                <i class="flaticon-conversation"></i>
                                                Comment
                                            </a>
                                        </li>
                                    </ul>
                                    <a href="{{ route('news.details', ['id' => $post->id]) }}">
                                        <h3>{{ $post->title }}</h3>
                                    </a>
                                    <p>{{ $post->short_des }}</p>
                                    <a class="read-more" href="{{ route('news.details', ['id' => $post->id]) }}">
                                        Read More
                                        <i class="flaticon-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @empty
                            No Post Found
                        @endforelse

                        <div class="col-lg-12">
                            <div class="page-navigation-area">
                                {{ $posts->links(data: ['scrollTo' => false]) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12">
                <aside class="widget-area" id="secondary">
                    <div class="widget widget_search">
                        <h3 class="widget-title">Search Here</h3>
                        <div class="post-wrap">
                            <form class="search-form" action="{{ route('news.search') }}" method="GET">
                                <label>
                                    <span class="screen-reader-text">Search for:</span>
                                    <input type="search" name="query" class="search-field" placeholder="Search...">
                                </label>
                                <button type="submit"><i class='bx bx-search'></i></button>
                            </form>
                        </div>
                    </div>

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
                                        <a href="news-details.html">{{ $category->title }} <span>({{ $category->posts->count() }})</span></a>
                                    </li>
                                @empty

                                @endforelse
                            </ul>
                        </div>
                    </section>

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
