<section class="explore-area pt-170 pb-100">
    <div class="container">
        <div class="section-title">
            <span>Explore</span>
            <h2>{{ $about->sub_title??null }}</h2>
        </div>
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="explore-img">
                    <img src="{{ asset($about->about_image??null) }}" alt="Image">
                </div>
            </div>
            <div class="col-lg-6">
                {!! $about->description??null !!}
            </div>

        </div>
    </div>
</section>
