@extends('frontend.layouts.master')

@section('title', $product->name)

@push('forntendstyle')
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
}

.details-thumb li img {
    width: 100%;
    height: 100%;
    object-fit: cover;
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
                            <li style="display: grid; place-items: center;">
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
                        
                        <button class="btn-jump btn btn-secondary bg-secondary btn-block w-100 text-white border-0 p-2"
                            onClick="addToCart({{ $product->id }},'{{ $product->name }}',{{ $product->sale_price }})"
                            wire:click="orderNow({{ $product->id }})">
                            <i class="fas fa-shopping-basket"></i> অর্ডার করুন
                        </button>
                        
                        <button wire:click="addToCart({{ $product->id }})"
                            onclick="addToCart({{ $product->id }},'{{ $product->name }}',{{ $product->sale_price }})"
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

@push('forntendscript')
<script>
    // Initialize Slick sliders for product gallery
    $(document).ready(function() {
        $(".details-thumb").not('.slick-initialized').slick({
            slidesToShow: 6,
            slidesToScroll: 1,
            asNavFor: ".details-preview",
            dots: !1,
            arrows: true,
            infinite: true,
            autoplay: true,
            focusOnSelect: !0,
            responsive: [
                { breakpoint: 1200, settings: { slidesToShow: 3, slidesToScroll: 1 } },
                { breakpoint: 992, settings: { slidesToShow: 5, slidesToScroll: 1 } },
                { breakpoint: 768, settings: { slidesToShow: 4, slidesToScroll: 1 } },
                {
                    breakpoint: 576,
                    settings: { slidesToShow: 5, slidesToScroll: 1},
                },
                {
                    breakpoint: 400,
                    settings: { slidesToShow: 5, slidesToScroll: 1 },
                },
            ],
        });
        
        $(".details-preview").not('.slick-initialized').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            infinite: true,
            autoplay: true,
            fade: true,
            asNavFor: ".details-thumb",
            prevArrow: '<i class="fa fa-arrow-right dandik"></i>',
            nextArrow: '<i class="fa fa-arrow-left bamdik"></i>',
            responsive: [
                {
                    breakpoint: 576,
                    settings: { slidesToShow: 1, slidesToScroll: 1, arrows: !0 },
                },
            ]
        });

        Livewire.hook('message.processed', component => {
            $(".details-thumb").not('.slick-initialized').slick('setPosition');
            $(".details-preview").not('.slick-initialized').slick('setPosition');
        });
    });

    // Track product view
    $(document).ready(function() {
        $.ajax({
            url: "https://barggee.com/api/capi",
            type: "GET",
            data: {
                'track' : "track",
                'event' : "ViewContent",
                'current_url' : window.location.href,
                'data' : {
                    'content_name': '{{ $product->name }}',
                    'content_ids': [{{ $product->id }}],
                    'content_type' : 'product',
                    'currency' : 'BDT',
                    'contents':[{
                        "id": {{ $product->id }},
                        "title": "{{ $product->name }}",
                        "item_price": "{{ $product->sale_price }}",
                        "quantity": 1
                    }],
                    'value' : {{ $product->sale_price }},
                    'num_items': 1,
                    'event_url' : window.location.href,
                },
            },
            success: (function (data) {
                fbq('track', 'ViewContent', data, { eventID: data.event_id });
                console.log('ViewContent server event run successfully');
            })
        });
    });
</script>
@endpush