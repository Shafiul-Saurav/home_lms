<section class="section-padding mentor-section" data-aos="fade-up">
    <div class="container">

        <div class="section-heading">
            <span class="sub-title">
                <i class="fa-solid fa-user-tie"></i>
                Our Mentors
            </span>
            <h2>Learn from Experienced <span style="color: #76bd10 !important;">Cybersecurity Professionals </span></h2>
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
                                @php
                                    $facebook = $teacher->facebook ?? ($teacher->user->profile->facebook ?? null);
                                    $linkedin = $teacher->linkedin ?? ($teacher->user->profile->linkedIn ?? $teacher->user->profile->linkedin ?? null);
                                    $youtube = $teacher->youtube ?? ($teacher->user->profile->youtube ?? null);
                                    $twitter = $teacher->twitter ?? ($teacher->user->profile->twitter ?? null);
                                    $instagram = $teacher->instagram ?? ($teacher->user->profile->instagram ?? null);
                                    $experienceText = $teacher->experience ?? ($teacher->user->profile->experience ?? null);
                                @endphp

                                @if(!empty($experienceText))
                                    <p class="mentor-experience mb-2"><i class="fa-solid fa-briefcase me-2"></i>{{ $experienceText }}</p>
                                @endif

                                <div class="mentor-social">
                                    @if(!empty($facebook))
                                        <a href="{{ $facebook }}" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-facebook-f"></i></a>
                                    @endif
                                    @if(!empty($linkedin))
                                        <a href="{{ $linkedin }}" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-linkedin-in"></i></a>
                                    @endif
                                    @if(!empty($twitter))
                                        <a href="{{ $twitter }}" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-twitter"></i></a>
                                    @endif
                                    @if(!empty($instagram))
                                        <a href="{{ $instagram }}" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-instagram"></i></a>
                                    @endif
                                    @if(!empty($youtube))
                                        <a href="{{ $youtube }}" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-youtube"></i></a>
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
