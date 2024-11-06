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
                                <li><span>Posted On:</span> <a href="news-details.html">{{ $post->created_at->format('F j, Y') }}</a></li>
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
                                @if($previousPost)
                                    <a href="{{ route('news.details', $previousPost->id) }}"><i class='bx bx-left-arrow-alt'></i> Prev Post</a>
                                @endif
                            </div>

                            <div class="nav-next">
                                @if($nextPost)
                                    <a href="{{ route('news.details', $nextPost->id) }}">Next Post <i class='bx bx-right-arrow-alt'></i></a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="comments-area">
                        <h3 class="comments-title">2 Comments:</h3>

                        <ol class="comment-list">
                            <li class="comment">
                                <div class="comment-body">
                                    <footer class="comment-meta">
                                        <div class="comment-author vcard">
                                            <img src="assets/img/news-details/comment-img-1.jpg" class="avatar" alt="image">
                                            <b class="fn">John Jones</b>
                                            <span class="says">says:</span>
                                        </div>

                                        <div class="comment-metadata">
                                            <a href="news-details.html">
                                                <span>January  24, 2024 at 10:59 am</span>
                                            </a>
                                        </div>
                                    </footer>

                                    <div class="comment-content">
                                        <p>Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type.</p>
                                    </div>

                                    <div class="reply">
                                        <a href="news-details.html" class="comment-reply-link">Reply</a>
                                    </div>
                                </div>

                                <ol class="children">
                                    <li class="comment">
                                        <div class="comment-body">
                                            <footer class="comment-meta">
                                                <div class="comment-author vcard">
                                                    <img src="assets/img/news-details/comment-img-2.jpg" class="avatar" alt="image">
                                                    <b class="fn">Steven Smith</b>
                                                    <span class="says">says:</span>
                                                </div>

                                                <div class="comment-metadata">
                                                    <a href="news-details.html">
                                                        <span>January  24, 2024 at 10:59 am</span>
                                                    </a>
                                                </div>
                                            </footer>

                                            <div class="comment-content">
                                                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim</p>
                                            </div>

                                            <div class="reply">
                                                <a href="news-details.html" class="comment-reply-link">Reply</a>
                                            </div>
                                        </div>
                                    </li>
                                </ol>
                            </li>

                            <li class="comment">
                                <div class="comment-body">
                                    <footer class="comment-meta">
                                        <div class="comment-author vcard">
                                            <img src="assets/img/news-details/comment-img-3.jpg" class="avatar" alt="image">
                                            <b class="fn">John Doe</b>
                                            <span class="says">says:</span>
                                        </div>

                                        <div class="comment-metadata">
                                            <a href="news-details.html">
                                                <span>January  24, 2024 at 10:59 am</span>
                                            </a>
                                        </div>
                                    </footer>

                                    <div class="comment-content">
                                        <p>Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type.</p>
                                    </div>

                                    <div class="reply">
                                        <a href="news-details.html" class="comment-reply-link">Reply</a>
                                    </div>
                                </div>
                            </li>
                        </ol>

                        <div class="comment-respond">
                            <h3 class="comment-reply-title">Leave a Reply</h3>

                            <form class="comment-form">
                                <p class="comment-notes">
                                    <span id="email-notes">Your email address will not be published.</span>
                                    Required fields are marked
                                    <span class="required">*</span>
                                </p>
                                <p class="comment-form-author">
                                    <label>Name <span class="required">*</span></label>
                                    <input type="text" id="author" name="author" required="required">
                                </p>
                                <p class="comment-form-email">
                                    <label>Email <span class="required">*</span></label>
                                    <input type="email" id="email" name="email" required="required">
                                </p>
                                <p class="comment-form-url">
                                    <label>Website</label>
                                    <input type="url" id="url" name="url">
                                </p>
                                <p class="comment-form-comment">
                                    <label>Comment</label>
                                    <textarea name="comment" id="comment" cols="45" rows="5" maxlength="65525" required="required"></textarea>
                                </p>
                                <p class="form-submit">
                                    <input type="submit" name="submit" id="submit" class="submit" value="Post A Comment">
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12">
                <aside class="widget-area" id="secondary">
                    <section class="widget widget-peru-posts-thumb">
                        <h3 class="widget-title">Popular Posts</h3>
                        <div class="post-wrap">
                            @forelse ($popularPosts as $post)
                            <article class="item">
                                <a href="news-details.html" class="thumb">
                                    <span class="fullimage cover" style="background-image: url('{{ asset('uploads/posts') }}/{{ $post->post_image }}'); background-size: cover; background-position: center;" role="img"></span>
                                </a>
                                <div class="info">
                                    <time datetime="2024-06-30">March 05, 2024</time>
                                    <h4 class="title usmall">
                                        <a href="news-details.html">
                                            Celebrating Decade Years Of Hotel In 2024
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
