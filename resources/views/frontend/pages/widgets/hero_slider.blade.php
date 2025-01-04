<section class="eorik-slider-area">
    <div class="eorik-slider owl-carousel owl-theme">
        @forelse ($homeSliders as $slider)
        <div class="eorik-slider-item" style="background-image: url('{{ asset('uploads/home_slider') }}/{{ $slider->slider_image }}')">
            <div class="d-table">
                <div class="d-table-cell">
                    <div class="container">
                        <div class="eorik-slider-text overflow-hidden one eorik-slider-text-one">
                            <h1>{{ $slider->title }}</h1>
                            <span>{{ $slider->description }}</span>
                            <div class="slider-btn">
                                <a class="default-btn" href="book-table.html">
                                        Book To Stay
                                        <i class="flaticon-right"></i>
                                    </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty

        @endforelse
    </div>
    <div class="white-shape">
        <img src="{{asset('assets/frontend')}}/img/home-one/slider/white-shape.png" alt="Image">
    </div>
    <div class="social-link">
        <ul>
            <li>
                <a href="{{ $website_link->facebook??null }}" target="_blank">
                        <i class="bx bxl-facebook"></i>
                    </a>
            </li>
            <li>
                <a href="{{ $website_link->twitter??null }}" target="_blank">
                        <i class="bx bxl-twitter"></i>
                    </a>
            </li>
            <li>
                <a href="{{ $website_link->linkedIn??null }}" target="_blank">
                        <i class="bx bxl-linkedin"></i>
                    </a>
            </li>
        </ul>
    </div>
</section>
