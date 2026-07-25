@extends('frontendone.layouts.master')

@section('title', 'Mentors')

@push('frontendone_style')
    @include('frontend.pages.common.style')
@endpush

@section('frontendone_content')
    <main class="main" data-aos="fade-up">
        <x-frontend.pages.common.breadcrumb
            :title="'Mentors'"
            :breadcrumb="[
                ['name' => 'Home', 'url' => route('home')],
                ['name' => 'Mentors', 'url' => '#']
            ]"
        />

        @include('frontendone.pages.widgets.mentor_section')
    </main>
@endsection

@push('frontendone_script')
    @include('frontend.pages.common.script')
@endpush
