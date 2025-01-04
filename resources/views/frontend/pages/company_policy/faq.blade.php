@extends('frontend.layouts.master')

@section('title', 'FAQ')

@push('frontend_style')
    @include('frontend.pages.common.style')
@endpush

@section('frontend_content')
<!-- Start Page Title Area -->
<div class="page-title-area" style="background-image: url('{{ asset('assets/frontend/img/page-bg.jpg') }}')">
    <div class="container">
        <div class="page-title-content">
            <h2>FAQ</h2>
            <ul>
                <li>
                    <a href="index.html">
                        Home
                    </a>
                </li>
                <li>FAQ</li>
            </ul>
        </div>
    </div>
</div>
<!-- End Page Title Area -->

<!-- Start FAQ Area -->
<section class="faq-area ptb-100">
    <div class="container">
        <div class="section-title">
            <span>FAQ,s</span>
            <h2>Frequently Asked  Questions</h2>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="faq-accordion">
                    <ul class="accordion">
                        @foreach ($faqs as $index => $faq)
                            <li class="accordion-item">
                                <a class="accordion-title {{ $loop->first ? 'active' : '' }}" href="javascript:void(0)">
                                    <i class='bx bx-chevron-down'></i>
                                    {{ $faq->faq_question }}
                                </a>

                                <div class="accordion-content {{ $loop->first ? 'show' : '' }}">
                                    <p>{{ $faq->faq_answer }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="faq-img" style="background-image: url('{{ asset('assets/frontend/img/faq-img.jpg') }}')">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End FAQ Area -->

@endsection

@push('frontend_script')
    @include('frontend.pages.common.script')
@endpush
