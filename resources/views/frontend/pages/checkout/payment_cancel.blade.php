@extends('frontend.layouts.master')

@section('title', 'Payment Cancelled')

@section('frontend_content')
    <main class="main">
        <x-frontend.pages.common.breadcrumb :title="'Payment Cancelled'" :breadcrumb="[['name' => 'Home', 'url' => route('home')], ['name' => 'Payment Cancelled', 'url' => '#']]" />

        <section class="mt-50 mb-50 py-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 m-auto">
                        <div class="card shadow-sm border-0 rounded-10">
                            <div class="card-header bg-warning text-white text-center py-4 rounded-top-10">
                                <h3 class="mb-0">Payment Cancelled!</h3>
                            </div>
                            <div class="card-body text-center p-5">
                                <i class="fas fa-exclamation-triangle text-warning mb-4" style="font-size: 80px;"></i>
                                <h4 class="mt-3">Transaction Cancelled</h4>
                                <p class="text-muted">You have cancelled the payment process. If this was a mistake, you can try again from the course page.</p>
                                
                                <div class="d-flex justify-content-center gap-3 mt-4">
                                    <a href="{{ route('courses') }}" class="theme-btn">Back to Courses</a>
                                    <a href="{{ route('home') }}" class="theme-btn" style="background: #6c757d;">Back to Home</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
