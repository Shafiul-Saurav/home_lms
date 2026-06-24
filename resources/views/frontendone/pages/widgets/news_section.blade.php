<section class="section-padding news-section">
    <div class="container">

        <div class="section-heading">
            <span class="sub-title">
                <i class="fa-regular fa-newspaper"></i>
                Latest News
            </span>
            <h2>Cyber Security News & Blog</h2>
            <p>
                Latest cyber security updates, training news, career guidelines and technology awareness for
                Bangladeshi learners.
            </p>
        </div>

        <div class="course-filter-wrap">
            <div class="course-filter-dots" aria-hidden="true">
                <span></span><span></span><span></span>
                <span></span><span></span><span></span>
                <span></span><span></span><span></span>
            </div>

            <div class="course-filter-bar" id="newsFilterBar">
                <button type="button" class="filter-btn" data-filter="blog">Blog</button>
                <button type="button" class="filter-btn active" data-filter="news">News</button>
            </div>

            <div class="course-filter-dots" aria-hidden="true">
                <span></span><span></span><span></span>
                <span></span><span></span><span></span>
                <span></span><span></span><span></span>
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
</section>
