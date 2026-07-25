<section class="section-padding mentor-section" data-aos="fade-up">
    <div class="container">

        <div class="section-heading">
            <span class="sub-title">
                <i class="fa-solid fa-user-tie"></i>
                Our Mentors
            </span>
            <h2>Learn from Experienced Cybersecurity Professionals</h2>
            <p>
                 Learn from experienced trainers and cybersecurity professionals with industry expertise, dedicated to delivering practical, hands-on learning and real-world guidance.
            </p>
        </div>

        <div class="mentor-carousel-wrap">
            <div class="owl-carousel owl-theme mentor-carousel">
                @foreach($teachers as $teacher)
                    @php
                        $mentorImage = 'https://via.placeholder.com/150';
                        if ($teacher->profile_image && $teacher->profile_image !== 'default_profile_image.jpg') {
                            $mentorImage = asset('uploads/teachers/' . $teacher->profile_image);
                        } elseif ($teacher->user->profile && $teacher->user->profile->profileImage) {
                            $mentorImage = asset($teacher->user->profile->profileImage->profile_image);
                        }
                    @endphp
                    <div class="item">
                        <div class="mentor-card">
                            <div class="mentor-img mentor-avatar">
                                <img src="{{ $mentorImage }}" alt="{{ $teacher->user->name }}">
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
