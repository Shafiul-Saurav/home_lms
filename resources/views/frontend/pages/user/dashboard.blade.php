@extends('frontend.layouts.master')

@section('title', Auth::user()->name)

@push('frontend_style')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="{{ asset('ijaboCropTool/ijaboCropTool.min.css') }}">
    <style>
        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            color: #fff;
            background-color: #cc8c18;
            border-radius: 0;
        }
        .custom_link {
            color: #cc8c18;
            border: 1px solid #cc8c18;
            border-radius: 0 !important;
            font-size: 20px;
            font-weight: 700
        }
        .custom_link i {
            font-size: 24px;
            margin-right: 10px;
        }
        .custom_link:hover {
            color: #cc8c18;
        }
        input[type="radio"] {
            appearance: none;
            width: 18px;
            height: 18px;
            border: 3px solid #8a8a8a;
            border-radius: 50%;
            outline: none;
            cursor: pointer;
            position: relative;
        }

        /* Selected radio button styling */
        input[type="radio"]:checked {
            border-color: #cc8c18;
        }

        input[type="radio"]:checked::before {
            content: "";
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: #cc8c18;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        @media (max-width: 767px) {

            .responsive-tab-content,
            .responsive-tab-menu {
                display: block !important;
            }

            .nav-pills.nav-tabs-dropdown,
            .nav-tabs-dropdown {
                border: 1px solid #dddddd;
                border-radius: 5px;
                overflow: hidden;
                position: relative;
            }

            .nav-pills.nav-tabs-dropdown::after,
            .nav-tabs-dropdown::after {
                content: "☰";
                position: absolute;
                /* top: 8px; */
                right: 15px;
                z-index: 2;
                font-size: 24px;
                color: #fff;
                pointer-events: none;
            }

            .nav-pills.nav-tabs-dropdown.open a,
            .nav-tabs-dropdown.open a {
                position: relative;
                display: block;
            }

            .nav-pills.nav-tabs-dropdown li,
            .nav-tabs-dropdown li {
                display: block;
                padding: 0;
                vertical-align: bottom;
            }

            .nav-pills.nav-tabs-dropdown>li>a,
            .nav-tabs-dropdown>li>a {
                position: absolute;
                top: 0;
                left: 0;
                margin: 0;
                width: 100%;
                height: 100%;
                display: inline-block;
                border-color: transparent;
            }

            .nav-pills.nav-tabs-dropdown>li>a:focus,
            .nav-tabs-dropdown>li>a:focus,
            .nav-pills.nav-tabs-dropdown>li>a:hover,
            .nav-tabs-dropdown>li>a:hover,
            .nav-pills.nav-tabs-dropdown>li>a:active,
            .nav-tabs-dropdown>li>a:active {
                border-color: transparent;
            }

            /* hh */
            .nav-pills.nav-tabs-dropdown>li>a.active,
            .nav-tabs-dropdown>li>a.active {
                display: block;
                border-color: transparent;
                position: relative;
                z-index: 1;
                /* background: #222; */
            }

            .nav-pills.nav-tabs-dropdown>li.active>a:focus,
            .nav-tabs-dropdown>li.active>a:focus,
            .nav-pills.nav-tabs-dropdown>li.active>a:hover,
            .nav-tabs-dropdown>li.active>a:hover,
            .nav-pills.nav-tabs-dropdown>li.active>a:active,
            .nav-tabs-dropdown>li.active>a:active {
                border-color: transparent;
            }
        }
    </style>
@endpush

@section('frontend_content')
    <!-- Start Page Title Area -->
    <div class="page-title-area" style="background-image: url('{{ asset('assets/frontend/img/page-bg.jpg') }}')">
        <div class="container">
            <div class="page-title-content">
                <h2>{{ Auth::user()->name }}</h2>
                <ul>
                    <li>
                        <a href="index.html">
                            Home
                        </a>
                    </li>
                    <li>Pages</li>
                    <li>User</li>
                    <li>{{ Auth::user()->name }}</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->

    <!-- User Dashboard Start -->
    <div class="container main-contact-area py-5">
        <div class="row contact-wrap">
            <div class="contact-form">
                <div class="col-12 mb-3">
                    <div class="d-none d-lg-block">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h2 class="font-weight-bold py-3 mb-4">Account settings</h2>
                            </div>
                            <div>
                                <h4 class="text_custom">Welcome Back, {{ Auth::user()->name }}!</h4>
                            </div>
                        </div>
                    </div>
                    <div class="d-lg-none">
                        <h4 class="font-weight-bold">Account settings</h4>
                        <div>
                            <h4 class="text_custom">Welcome Back, {{ Auth::user()->name }}!</h4>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="responsive-tab-menu">
                        <div class="row">
                            <div class="col-md-4">
                                <ul class="nav flex-column nav-pills nav-tabs-dropdown me-3" id="v-pills-tab" role="tablist"
                                    aria-orientation="vertical">
                                    <li class="nav-item">
                                        <a class="nav-link custom_link py-3 text-start active" href="#"
                                            id="v-pills-general-tab" data-bs-toggle="pill" data-bs-target="#v-pills-general"
                                            role="tab" aria-controls="v-pills-general" aria-selected="true"><i class="fa-solid fa-house-user"></i> General
                                            Setting</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link custom_link py-3 text-start" href="#"
                                            id="v-pills-personal-tab" data-bs-toggle="pill" data-bs-target="#v-pills-personal"
                                            role="tab" aria-controls="v-pills-personal" aria-selected="false"><i class="fa-solid fa-user"></i> Personal
                                            Setting</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link custom_link py-3 text-start" href="#"
                                            id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile"
                                            role="tab" aria-controls="v-pills-profile" aria-selected="false"><i class="fa-solid fa-camera"></i> Profile Setting
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link custom_link py-3 text-start" href="#"
                                            id="v-pills-password-tab" data-bs-toggle="pill" data-bs-target="#v-pills-password"
                                            role="tab" aria-controls="v-pills-password" aria-selected="false"><i class="fa-solid fa-lock"></i> Password Setting
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link custom_link py-3 text-start" href="#"
                                            id="v-pills-booking-tab" data-bs-toggle="pill" data-bs-target="#v-pills-booking"
                                            role="tab" aria-controls="v-pills-booking" aria-selected="false"><i class="fa-solid fa-hotel"></i> Booking History
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link custom_link py-3 text-start" href="#"
                                            id="v-pills-contact-tab" data-bs-toggle="pill" data-bs-target="#v-pills-contact"
                                            role="tab" aria-controls="v-pills-profile" aria-selected="false"><i class="fa-solid fa-comments"></i> Contact</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link custom_link py-3 text-start" onclick="event.preventDefault(); document.getElementById('logoutForm').submit()" href="#"
                                            id="v-pills-contact-tab" data-bs-toggle="pill" data-bs-target="#v-pills-contact"
                                            role="tab" aria-controls="v-pills-profile" aria-selected="false"><i class="fa-solid fa-power-off"></i> Logout</a>
                                            <form action="{{route('user.logout')}}" id="logoutForm" method="POST">
                                                @csrf
                                            </form>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-8">
                                <div class="tab-content responsive-tab-content" id="v-pills-tabContent">
                                    <!-- User General Setting Start -->
                                    <div class="tab-pane fade show active" id="v-pills-general" role="tabpanel"
                                        aria-labelledby="v-pills-general-tab" tabindex="0">
                                        <h4>General Information</h4>
                                        @if ($profile)
                                            @if ($profileImage && $profileImage->profile_image)
                                                <img src="{{ asset($profileImage->profile_image) }}" class="profile_image" alt="Profile Image" style="width: 200px; height: 200px; border: 5px solid #cc8c18;  border-radius: 50%;">
                                            @else
                                                <img src="{{ asset('profile/default_profile.png') }}" class="profile_image" style="width: 200px; height: 200px; border-radius: 50%;">
                                            @endif
                                        @endif

                                        <form action="{{ route('general.store') }}" method="POST" class="mt-4">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$user->id}}">
                                            <div class="form-group mb-3">
                                                <input type="text" name="name" placeholder="Username *"
                                                    class="form-control rounded-5" value="{{ $user->name }}" disabled>
                                            </div>
                                            <div class="form-group mb-3">
                                                <input type="email" name="email" placeholder="Email *"
                                                    class="form-control rounded-5" value="{{ $user->email }}" disabled>
                                            </div>
                                            <div class="form-group mb-3">
                                                <input type="tel" name="phone" placeholder="Phone *"
                                                    class="form-control rounded-5" value="{{ old('phone', $user->phone ?? '') }}">
                                            </div>
                                            <div class="mb-3">
                                                <button type="submit" class="default-btn mx-0"
                                                    style="pointer-events: all; cursor: pointer;" fdprocessedid="w7cgf3">
                                                    Save Change
                                                    <i class="flaticon-right"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- User Personal Setting Start -->
                                    <div class="tab-pane fade" id="v-pills-personal" role="tabpanel"
                                        aria-labelledby="v-pills-personal-tab" tabindex="0">
                                        <h4>Personal Information</h4>
                                        <form action="{{ route('profile.store') }}" method="POST" class="mt-4">
                                            @csrf
                                            <div class="form-group mb-3">
                                                <input type="number" name="nid_num" placeholder="NID Number" class="form-control rounded-5" value="{{ old('nid_num', $profile->nid_num ?? '') }}">
                                            </div>
                                            <div class="form-group mb-3">
                                                <input type="text" name="address" placeholder="Address" class="form-control rounded-5" value="{{ old('address', $profile->address ?? '') }}">
                                            </div>
                                            <div class="d-flex mb-3">
                                                <label for="" class="mx-4"><strong>Select Gender</strong></label>
                                                <div class="d-flex me-4 align-items-center">
                                                    <div class="me-2">
                                                        <input class="" type="radio" name="gender" id="male" value="male" {{ old('gender', $profile->gender ?? '') == 'male' ? 'checked' : '' }}>
                                                    </div>
                                                    <div class="mb-2"><label class="form-check-label" for="male">Male</label></div>
                                                </div>
                                                <div class="d-flex me-4 align-items-center">
                                                    <div class="me-2">
                                                        <input class="" type="radio" name="gender" id="female" value="female" {{ old('gender', $profile->gender ?? '') == 'female' ? 'checked' : '' }}>
                                                    </div>
                                                    <div class="mb-2"><label class="form-check-label" for="female">Female</label></div>
                                                </div>
                                                <div class="d-flex me-4 align-items-center">
                                                    <div class="me-2">
                                                        <input class="" type="radio" name="gender" id="other" value="other" {{ old('gender', $profile->gender ?? '') == 'other' ? 'checked' : '' }}>
                                                    </div>
                                                    <div class="mb-2"><label class="form-check-label" for="other">Other</label></div>
                                                </div>
                                            </div>
                                            <div class="form-group mb-3">
                                                <input type="text" name="facebook" placeholder="Facebook (url)" class="form-control rounded-5" value="{{ old('facebook', $profile->facebook ?? '') }}">
                                            </div>
                                            <div class="form-group mb-3">
                                                <input type="text" name="twitter" placeholder="Twitter (url)" class="form-control rounded-5" value="{{ old('twitter', $profile->twitter ?? '') }}">
                                            </div>
                                            <div class="form-group mb-3">
                                                <input type="text" name="linkedIn" placeholder="LinkedIn (url)" class="form-control rounded-5" value="{{ old('linkedIn', $profile->linkedIn ?? '') }}">
                                            </div>
                                            <div class="form-group mb-3">
                                                <input type="text" name="instagram" placeholder="Instagram (url)" class="form-control rounded-5" value="{{ old('instagram', $profile->instagram ?? '') }}">
                                            </div>
                                            <div class="mb-3">
                                                <button type="submit" class="default-btn mx-0" style="pointer-events: all; cursor: pointer;">
                                                    Save Change <i class="flaticon-right"></i>
                                                </button>
                                            </div>
                                        </form>

                                    </div>

                                    <!-- User Profile Setting Start -->
                                    @if($profile)
                                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                                        aria-labelledby="v-pills-profile-tab" tabindex="0">
                                        <h4>Upload Your Profile Picture</h4>
                                        @if ($profileImage && $profileImage->profile_image)
                                            <img src="{{ asset($profileImage->profile_image) }}" class="profile_image" alt="Profile Image" style="width: 200px; height: 200px; border: 5px solid #cc8c18;  border-radius: 50%;">
                                        @else
                                        <img src="{{ asset('profile/default_profile.png') }}" class="profile_image" style="width: 200px; height: 200px; border-radius: 50%;">
                                        @endif
                                        <div class="form-group mt-4">
                                            <label for="">Change Picture</label>
                                            <input type="file" name="profile_image" class="form-control rounded-5" id="profile_image">
                                        </div>
                                    </div>
                                    @endif
                                    <div class="tab-pane fade" id="v-pills-password" role="tabpanel"
                                        aria-labelledby="v-pills-password-tab" tabindex="0">
                                        <h4>Change Password</h4>
                                        <form action="{{ route('mypostupdate.password') }}" method="POST" class="mt-4">
                                            @csrf
                                            <div class="form-group mb-3">
                                                <input type="password" name="old_password" placeholder="Enter Old Password *"
                                                    class="form-control rounded-5 @error('old_password')
                                            is-invalid
                                            @enderror">
                                            @error('old_password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            </div>
                                            <div class="form-group mb-3">
                                                <input type="password" name="password" placeholder="Enter New Password *"
                                                    class="form-control rounded-5 @error('password')
                                            is-invalid
                                            @enderror">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            </div>
                                            <div class="form-group mb-3">
                                                <input type="password" name="password_confirmation" placeholder="Re-type New Password *"
                                                    class="form-control rounded-5">
                                            </div>
                                            <div class="mb-3">
                                                <button type="submit" class="default-btn mx-0"
                                                    style="pointer-events: all; cursor: pointer;" fdprocessedid="w7cgf3">
                                                    Save Change
                                                    <i class="flaticon-right"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-booking" role="tabpanel"
                                        aria-labelledby="v-pills-booking-tab" tabindex="0">Booking List
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-contact" role="tabpanel"
                                        aria-labelledby="v-pills-contact-tab" tabindex="0">Contact content
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- User Dashboard End -->
@endsection

@push('frontend_script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="{{ asset('ijaboCropTool/ijaboCropTool.min.js') }}"></script>
    <script>
        $('.nav-tabs-dropdown')
            .on("click", ".nav-link:not('.active')", function(event) {
                $(this).closest('ul').removeClass("open");
            })
            .on("click", ".nav-link.active", function(event) {
                $(this).closest('ul').toggleClass("open");
            });
    </script>
    <script>
        @if(Session::has('message'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true,
        }
                toastr.success("{{ session('message') }}");
        @endif

        @if(Session::has('error'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.error("{{ session('error') }}");
        @endif

        @if(Session::has('info'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.info("{{ session('info') }}");
        @endif

        @if(Session::has('warning'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.warning("{{ session('warning') }}");
        @endif
    </script>
    <script>
        $(document).ready(function() {
            $('#profile_image').ijaboCropTool({
                preview: '.profile_image',
                processUrl: '{{ route("image.crop") }}',
                withCSRF: ['_token', '{{ csrf_token() }}'],
                buttonsText: ['CROP & SAVE', 'QUIT NOW'],
                buttonsColor: ['#30bf7d', '#ee5155', -15],
                onSuccess: function(message, element, status) {
                    $('.loader').hide();
                    toastr.success('Image updated successfully!');
                },
                onError: function(message, element, status) {
                    $('.loader').hide();
                    toastr.error('Failed to update image. Please try again.');
                },
                onBefore: function() {
                    $('.loader').show();
                },
            });

            // Show the loader when the CROP & SAVE button is clicked
            $(document).on('click', '.ijaboCropTool_btn.c_save', function() {
                $('.loader').show();
            });
        });
    </script>
@endpush
