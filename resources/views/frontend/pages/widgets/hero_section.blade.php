<div class="hero-section hs-1">
    <div class="hero-single" style="background-image: url({{ asset('assets/frontend') }}/img/shape/01.png)">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-6">
                    <div class="hero-content">
                        <h6 class="hero-sub-title wow fadeInUp" data-delay=".25s"><i class="far fa-lightbulb-on"></i> Start
                            To New Journey</h6>
                        <h1 class="hero-title wow fadeInRight" data-delay=".50s">Best learning <span
                                class="text-gradient">platform that take</span> you next level</h1>
                        <p class="wow fadeInLeft" data-delay=".75s">
                            There are many variations of passages orem psum available but the majority have suffered
                            alteration in some form by injected humour.
                        </p>
                        <div class="hero-btn wow fadeInUp" data-delay="1s">
                            <a href="about.html" class="theme-btn">About More<i class="fas fa-arrow-right"></i></a>
                            <a href="contact.html" class="theme-btn2">Learn More<i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6">
                    <div class="hero-info-wrap">
                        @php
                            $heroStudentCountLabel = $heroStudentCountLabel ?? '250k+';
                            $heroCourseCountLabel = $heroCourseCountLabel ?? '160+';
                            $heroAvatars = $heroAvatars ?? null;
                        @endphp
                        <div class="hero-avatar-group">
                            <h6><span>{{ $heroStudentCountLabel }}</span> Students</h6>
                            @foreach ($heroAvatars as $avatar)
                                <span class="avatar"><img src="{{ $avatar }}" alt="Student avatar" /></span>
                            @endforeach
                        </div>
                        <div class="hero-course-info">
                            <div class="icon">
                                <img src="{{ asset('assets/frontend') }}/img/icon/course.svg" alt="" />
                            </div>
                            <h6 class="title"><span>{{ $heroCourseCountLabel }}</span> Courses</h6>
                        </div>
                    </div>
                    <div class="hero-img">
                        <img class="img-1" src="{{ asset('assets/frontend') }}/img/hero/01.png" alt="" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
