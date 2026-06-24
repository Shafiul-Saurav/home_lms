<section class="section-padding mentor-section">
    <div class="container">

        <div class="section-heading">
            <span class="sub-title">
                <i class="fa-solid fa-user-tie"></i>
                Our Mentors
            </span>
            <h2>Meet Our Bangladeshi Mentors</h2>
            <p>
                Learn from experienced trainers, cyber security professionals and software engineers from
                Bangladesh.
            </p>
        </div>

        <div class="mentor-carousel-wrap">
            <div class="owl-carousel owl-theme mentor-carousel">
                @foreach($teachers as $teacher)
                    <div class="item">
                        <div class="mentor-card">
                            <div class="mentor-img mentor-avatar">
                                <img src="{{ $teacher->user->profile && $teacher->user->profile->profileImage ? asset($teacher->user->profile->profileImage->profile_image) : 'https://via.placeholder.com/150' }}" alt="{{ $teacher->user->name }}">
                            </div>
                            <div class="mentor-info">
                                <h4>{{ $teacher->user->name }}</h4>
                                <p>{{ $teacher->qualification ?? 'Mentor' }}</p>
                                <div class="mentor-social">
                                    @if(isset($teacher->facebook))
                                        <a href="{{ $teacher->facebook }}"><i class="fa-brands fa-facebook-f"></i></a>
                                    @endif
                                    @if(isset($teacher->linkedin))
                                        <a href="{{ $teacher->linkedin }}"><i class="fa-brands fa-linkedin-in"></i></a>
                                    @endif
                                    @if(isset($teacher->youtube))
                                        <a href="{{ $teacher->youtube }}"><i class="fa-brands fa-youtube"></i></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
