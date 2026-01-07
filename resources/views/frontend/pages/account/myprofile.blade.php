@extends('frontend.layouts.master')

@section('title', 'Dashboard')

@push('frontend_style')
@endpush

@section('frontend_content')
    <main class="main">
        <!-- breadcrumb -->
        <x-frontend.pages.common.breadcrumb
            :title="'My Profile'"
            :breadcrumb="[
                ['name' => 'Home', 'url' => route('home')],
                ['name' => 'My Profile', 'url' => '#']
            ]"
        />
        <!-- breadcrumb end -->

        <!-- user profile -->
        <div class="user-account py-100">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-4 col-xl-3">
                        @include('frontend.pages.account.sidebarmenu.sidebar')
                    </div>
                    <div class="col-lg-8 col-xl-9">
                        <div class="user-wrapper">
                            <div class="user-card">
                                <h4 class="title">Summary</h4>
                                <div class="row">
                                    <div class="col-md-6 col-lg-6 col-xl-4">
                                        <div class="user-widget c1">
                                            <div class="info">
                                                <h1>50</h1>
                                                <span>Completed Courses</span>
                                            </div>
                                            <div class="icon">
                                                <i class="fal fa-book-open-cover"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-4">
                                        <div class="user-widget c2">
                                            <div class="info">
                                                <h1>25</h1>
                                                <span>Enrolled Courses</span>
                                            </div>
                                            <div class="icon">
                                                <i class="fal fa-books-medical"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-4">
                                        <div class="user-widget c3">
                                            <div class="info">
                                                <h1>$900</h1>
                                                <span>My Balance</span>
                                            </div>
                                            <div class="icon">
                                                <i class="fal fa-wallet"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-4">
                                <div class="col-lg-12">
                                    <div class="user-card">
                                        <h4 class="title">Profile Info</h4>
                                        <div class="user-form">
                                            <form action="#">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">First Name</label>
                                                            <input type="text" class="form-control" value="Antoni"
                                                                placeholder="First Name" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Last Name</label>
                                                            <input type="text" class="form-control" value="Jonson"
                                                                placeholder="Last Name" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Email</label>
                                                            <input type="text" class="form-control"
                                                                value="antoni@example.com" placeholder="Email" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Phone</label>
                                                            <input type="text" class="form-control"
                                                                value="+2 134 562 458" placeholder="Phone" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Address</label>
                                                            <input type="text" class="form-control" value="New York, USA"
                                                                placeholder="Address" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="form-label">About Me</label>
                                                            <textarea class="form-control" rows="4" placeholder="Write Here...">
It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.
                                </textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" class="theme-btn"><span class="far fa-save"></span>
                                                    Save Changes</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="user-card">
                                        <h4 class="title">Change Password</h4>
                                        <div class="col-lg-12">
                                            <div class="user-form">
                                                <form action="#">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="form-label">Old Password</label>
                                                                <input type="password" class="form-control"
                                                                    placeholder="Old Password" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="form-label">New Password</label>
                                                                <input type="password" class="form-control"
                                                                    placeholder="New Password" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="form-label">Re-Type Password</label>
                                                                <input type="password" class="form-control"
                                                                    placeholder="Re-Type Password" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="theme-btn"><span
                                                            class="far fa-key"></span> Change Password</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- user profile end -->

    </main>
@endsection

@push('frontend_script')
@endpush
