<section class="news-area pb-60">
    <div class="container">
        <div class="section-title">
            <span>Our BLog</span>
            <h2>News & articles updates </h2>
        </div>
        <div class="row">
            @forelse ($posts as $post)
            <div class="col-lg-4 col-md-6">
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
                                        Comment: {{ $post->comments->count() }}
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
                No Data Found!
            @endforelse
        </div>
    </div>
</section>
