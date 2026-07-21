@extends('frontendone.layouts.master')

@section('title', $news->title ?? 'News Details')

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
    <main class="main">
        <x-frontend.pages.common.breadcrumb :title="$news->title ?? 'News Details'" :breadcrumb="[
            ['name' => 'Home', 'url' => route('home')],
            ['name' => 'News', 'url' => route('frontend.news.index')],
            ['name' => $news->title ?? 'News Details', 'url' => '#'],
        ]" />

        <section class="section-padding py-5">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-8">
                        <article class="blog-single-wrap">
                            <div class="blog-thumb-img rounded overflow-hidden mb-4">
                                @if($news->news_image && $news->news_image != 'default_news.jpg')
                                    <img src="{{ asset('uploads/news/' . $news->news_image) }}" alt="{{ $news->title }}" class="img-fluid w-100" />
                                @else
                                    <img src="{{ asset('assets/frontend/img/blog/single.jpg') }}" alt="{{ $news->title }}" class="img-fluid w-100" />
                                @endif
                            </div>

                            <div class="blog-info mb-4">
                                <div class="d-flex flex-column flex-sm-row gap-3 align-items-start align-items-sm-center justify-content-between">
                                    <div class="blog-meta" style="font-size: 13px; color: #6b7280;">
                                        <span><i class="fa-solid fa-calendar"></i> {{ $news->created_at->format('d M Y') }}</span>
                                        @if($news->newsCategory)
                                            <span class="ms-3"><i class="fa-solid fa-tag"></i> {{ $news->newsCategory->title }}</span>
                                        @endif
                                        @if($news->user)
                                            <span class="ms-3"><i class="fa-solid fa-user"></i> {{ $news->user->name }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="blog-details mb-5">
                                <h2 class="mb-3">{{ $news->title }}</h2>
                                @if($news->description)
                                    <div class="mb-4">{!! $news->description !!}</div>
                                @endif

                                @if($news->short_des)
                                    <blockquote class="blockquote p-4 rounded shadow-sm bg-white border-start border-4" style="border-color: #76bd10 !important;">
                                        {!! $news->short_des !!}
                                    </blockquote>
                                @endif

                                @if($news->long_des)
                                    <div class="mt-4">{!! $news->long_des !!}</div>
                                @endif
                            </div>

                            @if($news->user)
                            <div class="blog-author d-flex align-items-center gap-3 rounded p-4 bg-white shadow-sm mb-5" style="border: 1px solid #edf0f5;">
                                <div class="author-thumb rounded-circle overflow-hidden" style="width:72px; height:72px;">
                                    @if($news->user->profile && $news->user->profile->profileImage)
                                        <img src="{{ asset($news->user->profile->profileImage->profile_image) }}" alt="{{ $news->user->name }}" class="img-fluid" />
                                    @elseif($news->user->profile_photo_path)
                                        <img src="{{ asset($news->user->profile_photo_path) }}" alt="{{ $news->user->name }}" class="img-fluid" />
                                    @else
                                        <img src="{{ asset('assets/default-avatar.png') }}" alt="{{ $news->user->name }}" class="img-fluid" />
                                    @endif
                                </div>
                                <div>
                                    <h6 class="mb-1" style="color: #111827;">{{ $news->user->name }}</h6>
                                    <p class="mb-0" style="font-size: 13px; color: #6b7280;">Published {{ $news->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            @endif
                        </article>
                    </div>

                    <div class="col-lg-4">
                        <div class="sidebar-widget p-4 bg-white mb-4 rounded-3 shadow-sm" style="border: 1px solid #edf0f5;">
                            <h5 class="mb-3" style="color: #76bd10; font-weight: 700;">Categories</h5>
                            <div class="category-list">
                                @foreach($newsCategories as $category)
                                    <a href="{{ route('frontend.news.search', ['category' => $category->id]) }}" style="display: block; padding: 8px 0; color: #374151; text-decoration: none; border-bottom: 1px dotted #e5e7eb;">
                                        {{ $category->title }}
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        <div class="sidebar-widget p-4 bg-white rounded-3 shadow-sm" style="border: 1px solid #edf0f5;">
                            <h5 class="mb-3" style="color: #76bd10; font-weight: 700;">Related News</h5>
                            @foreach($popularNews as $popular)
                                <div class="sidebar-item">
                                    <a href="{{ route('frontend.news.show', $popular->id) }}" style="text-decoration: none; color: #374151; font-size: 13px; font-weight: 600;">
                                        {{ Str::limit($popular->title, 50) }}
                                    </a>
                                    <small style="color: #9ca3af; display: block; margin-top: 4px;">{{ $popular->created_at->format('d M Y') }}</small>
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
