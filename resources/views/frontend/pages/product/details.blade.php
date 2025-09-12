@extends('frontend.layouts.master')

@section('title', $product->name)

@push('frontendstyle')
<style>
.details-preview li {
    display: grid;
    place-items: center;
    aspect-ratio: 1/1;
}

.details-preview li img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
    aspect-ratio: 1/1;
}

.details-thumb li {
    aspect-ratio: 1/1;
    padding: 5px;
    cursor: pointer;
}

.details-thumb li img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border: 1px solid #684EFF;
}

.details-thumb li.slick-current img {
    border-color: red;
}

/* Slick slider arrows customization */
.details-preview .slick-prev,
.details-preview .slick-next {
    width: 40px;
    height: 40px;
    background: #684eff;
    border-radius: 50%;
    z-index: 10;
}

.details-preview .slick-prev:before,
.details-preview .slick-next:before {
    color: white;
    font-size: 20px;
}

.details-preview .slick-prev {
    left: 10px;
}

.details-preview .slick-next {
    right: 10px;
}

.details-thumb .slick-prev,
.details-thumb .slick-next {
    width: 30px;
    height: 30px;
    background: #684eff;
    border-radius: 50%;
    z-index: 10;
}

.details-thumb .slick-prev:before,
.details-thumb .slick-next:before {
    color: white;
    font-size: 16px;
}

.details-thumb .slick-prev {
    left: 5px;
}

.details-thumb .slick-next {
    right: 5px;
}

/* Ensure proper spacing for thumbnails */
.details-thumb {
    margin-top: 15px;
}

.details-thumb .slick-slide {
    margin: 0 5px;
}

/* Make sure slick arrows are visible */
.slick-prev, .slick-next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    z-index: 10;
}

.slick-prev:hover, .slick-next:hover {
    background: #5a3ce0;
}

.slick-prev:before, .slick-next:before {
    font-family: 'Font Awesome 5 Free';
    font-weight: 900;
    display: inline-block;
}

.slick-disabled {
    opacity: 0.5;
    pointer-events: none;
}
</style>
@endpush

@section('frontend_content')
    <!-- Product Details Section -->
    <section class="inner-section mb-5 mt-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="details-gallery">
                    <ul class="details-preview mb-1" wire:ignore>
                        @foreach($product->productImages as $image)
                        <li>
                            <img loading="lazy" src="{{ asset('uploads/products/' . $image->multiple_image) }}" alt="{{ $product->name }}">
                        </li>
                        @endforeach
                    </ul>
                    <ul class="details-thumb mb-1">
                        @foreach($product->productImages as $image)
                        <li>
                            <img loading="lazy" src="{{ asset('uploads/products/' . $image->multiple_image) }}" alt="{{ $product->name }}">
                        </li>
                        @endforeach
                    </ul>
                </div>
                </div>
                <div class="col-lg-7">
                    <div class="details-content">
                        <h4 class="details-name">{{ $product->name }}</h4>

                        <h3 class="details-price">
                            @if($product->discount_percentage > 0)
                                <span class="new-price mr-2 bold"><b>Tk {{ number_format($product->sale_price) }}</b></span>
                                <del class="old-price">Tk {{ number_format($product->regular_price) }}</del>
                            @else
                                <span class="price mr-2 bold"><b>Tk {{ number_format($product->sale_price) }}</b></span>
                            @endif
                        </h3>

                        <div class="mb-2">
                            <!-- Stock status could be added here if available -->
                        </div>

                        <button class="btn btn-block border-0 w-100 p-2 btn-gradient"
                            onClick="addToCart({{ $product->id }}, '{{ addslashes($product->name) }}', {{ $product->sale_price }})">
                            <i class="fas fa-shopping-basket"></i> অর্ডার করুন
                        </button>
                        <button onclick="addToCart({{ $product->id }}, '{{ addslashes($product->name) }}', {{ $product->sale_price }})"
                            class="btn-block w-100 btn btn-primary bg-primary text-white border-0 p-2 mt-2">
                            <i class="fas fa-shopping-cart"></i> কার্টে যোগ করুন
                        </button>

                        <a href="tel:01859084364" class="btn btn-info btn-block w-100 border-0 p-2 mb-2 mt-2">
                            <i class="fa fa-phone-alt"></i> কল করুন : 01859084364
                        </a>

                        <div class="mt-2 mb-3">
                            <table class="table lead">
                                <tbody>
                                    <tr>
                                        <td class="font-weight-bold">কুরিয়ার ডেলিভারি খরচ</td>
                                    </tr>
                                    <tr>
                                        <td>ঢাকায় ডেলিভারি খরচ</td>
                                        <td>৳ 80</td>
                                    </tr>
                                    <tr>
                                        <td>ঢাকার বাইরের ডেলিভারি খরচ</td>
                                        <td>৳ 150</td>
                                    </tr>
                                </tbody>
                            </table>

                            <span style="color: rgb(255, 0, 0);">
                                বিঃদ্রঃ- ছবি এবং বর্ণনার সাথে পণ্যের মিল থাকা সত্যেও আপনি পণ্য গ্রহন করতে না চাইলে কুরিয়ার চার্জ 150 টাকা কুরিয়ার ডেলিভারি ম্যানকে প্রদান করে পণ্য সাথে সাথে রিটার্ন করবেন। পরে কোন কমপ্লেইন/রিটার্ন গ্রহণযোগ্য নয়!
                            </span>
                        </div>

                        <div class="details-meta">
                            <p>Product Code: <span>{{ $product->sku ?? 'N/A' }}</span></p>
                        </div>

                        <div class="details-list-group">
                            <label class="details-list-title">tags:</label>
                            <div class="details-tag-list d-inline-block">
                                @if($product->category)
                                <a href="{{ route('category.products', $product->category->id) }}">
                                    <span class="badge bg-success display-1 mr-2">{{ $product->category->name }}</span>
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="inner-section mb-5 product-details-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="nav nav-tabs justify-content-start">
                        <li><a href="#tab-desc" class="tab-link active" data-bs-toggle="tab">পণ্যের বিস্তারিত</a></li>
                        <li><a href="#tab-spec" class="tab-link" data-bs-toggle="tab">ডেলিভারি এবং রিটার্ন পলিসি</a></li>
                        <li><a href="#tab-review" class="tab-link" data-bs-toggle="tab">রিভিউ</a></li>
                    </ul>
                    <hr class="m-0">

                    <div class="tab-content">
                        <div class="tab-pane fade active show p-3 bg-white" id="tab-desc">
                            {!! $product->description !!}
                        </div>

                        <div class="tab-pane fade p-3 bg-white" id="tab-spec">
                            <ul>
                                <li>আপনার যত প্রশ্ন আছে তা বর্ননার সাথে মিলিয়ে অথবা আমাদের কাছ থেকে জেনে পন্য অর্ডার করুন।</li>
                                <li>ছবি এবং বর্ণনার সাথে পন্যের মিল থাকলে পণ্য ফেরত নেয়া হবে না ।</li>
                                <li>তবে আপনি চাইলে আপনার গ্রহন করা পন্যের সম মুল্যের কি বা বেশি মুল্যের পণ্য নিতে পারবেন (যে টাকা বেশি হবে তা প্রদান করতে হবে ) ।</li>
                                <li>কম মুল্যের পণ্য নেয়া যাবে না ।</li>
                                <li>পণ্য আনা নেয়ার খরচ আপনাকে দিতে হবে।</li>
                                <li>যে সকল পন্যে ওয়ারেন্টি আছে তার ওয়ারেন্টি সার্ভিস আমরা প্রদান করবো।তবে কিছু কিছু ক্ষেত্রে পন্যের ব্রান্ড আপনাকে সার্ভিস প্রদান করবে তবে সে ক্ষেত্রে আপনার নিকটস্থ সার্ভিস পয়েন্ট থেকে সার্ভিস নিতে পারবেন।</li>
                                <li>পণ্য সার্ভিস করতে যাওয়া আসা বা পাঠানো এবং রিটার্ন করার খরজ আপনাকে বহন করতে হবে।</li>
                            </ul>
                        </div>

                        <div class="tab-pane fade p-3 bg-white" id="tab-review">
                            <!-- Reviews section - can be implemented later -->
                            <p>রিভিউ সংযুক্ত করা হবে।</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('frontendscript')
<script>
    // Initialize Slick sliders for product gallery with a more robust approach
    function initializeProductSliders() {
        // Check if jQuery and Slick are available
        if (typeof $ === 'undefined' || typeof $.fn.slick === 'undefined') {
            setTimeout(initializeProductSliders, 500);
            return;
        }

        // Check if we have images to sliderize
        if ($('.details-preview li').length === 0) {
            return;
        }

        // Destroy existing instances if they exist
        if ($('.details-preview').hasClass('slick-initialized')) {
            $('.details-preview').slick('unslick');
        }

        if ($('.details-thumb').hasClass('slick-initialized')) {
            $('.details-thumb').slick('unslick');
        }

        // Initialize the preview slider (main image)
        $('.details-preview').not('.slick-initialized').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            infinite: true,
            autoplay: false,
            fade: true,
            asNavFor: '.details-thumb',
            prevArrow: '<button type="button" class="slick-prev"><i class="fas fa-chevron-left"></i></button>',
            nextArrow: '<button type="button" class="slick-next"><i class="fas fa-chevron-right"></i></button>'
        });

        // Initialize the thumbnail slider
        $('.details-thumb').not('.slick-initialized').slick({
            slidesToShow: 5,
            slidesToScroll: 1,
            asNavFor: '.details-preview',
            dots: false,
            arrows: true,
            centerMode: false,
            focusOnSelect: true,
            vertical: false,
            infinite: true,
            prevArrow: '<button type="button" class="slick-prev"><i class="fas fa-chevron-left"></i></button>',
            nextArrow: '<button type="button" class="slick-next"><i class="fas fa-chevron-right"></i></button>',
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 4
                    }
                },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 5
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 4
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 400,
                    settings: {
                        slidesToShow: 2
                    }
                }
            ]
        });
    }

    // Initialize on document ready
    $(document).ready(function() {
        initializeProductSliders();
    });

    // Also initialize on window load for safety
    $(window).on('load', function() {
        setTimeout(initializeProductSliders, 100);
    });

    // Reinitialize after Livewire updates if applicable
    if (typeof Livewire !== 'undefined') {
        Livewire.hook('message.processed', (message, component) => {
            setTimeout(initializeProductSliders, 100);
        });
    }

    // Fallback for dynamic content
    setTimeout(initializeProductSliders, 2000);
</script>
@endpush
