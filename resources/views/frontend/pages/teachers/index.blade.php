@extends('frontend.layouts.master')

@section('title', 'Instructors')

@section('frontend_content')
<main class="main">
    <div class="instructor-list py-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <div class="site-heading">
                        <span class="site-title-tagline"><i class="far fa-lightbulb-on"></i> Instructors</span>
                        <h2 class="site-title">All <span class="text-gradient">Instructors</span></h2>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                @foreach($teachers as $teacher)
                    <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
                        <div class="instructor-item">
                            <div class="instructor-img">
                                @php
                                    $imgUrl = asset('assets/frontend/img/instructor/01.jpg');
                                    if(!empty($teacher->profile_image) && $teacher->profile_image !== 'default_profile_image.jpg') {
                                        $imgUrl = asset('uploads/teachers/' . $teacher->profile_image);
                                    } elseif(optional(optional($teacher->user)->profile)->profileImage && optional(optional($teacher->user->profile)->profileImage)->profile_image) {
                                        $imgUrl = asset(optional(optional($teacher->user->profile)->profileImage)->profile_image);
                                    }
                                @endphp
                                <img src="{{ $imgUrl }}" alt="" />
                            </div>
                            <div class="instructor-content">
                                <h5><a href="#">{{ optional($teacher->user)->name ?? 'Instructor' }}</a></h5>
                                <p>{{ $teacher->qualification ?? 'Instructor' }}</p>
                            </div>
                            <div class="instructor-bottom">
                                <div class="price">
                                    <span class="text">Start From</span>
                                    <span class="amount">৳{{ number_format($teacher->salary ?? 0, 0) }}</span>
                                </div>
                                <a href="#" class="theme-border-btn">Enroll<i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    {{ $teachers->links() }}
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
