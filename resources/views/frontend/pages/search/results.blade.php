@extends('frontend.layouts.master')

@section('title', 'Search Results')

@section('frontend_content')
<div class="container py-4">
    <div class="row">
        <div class="col-lg-12">
            @livewire('search-results', ['query' => request()->get('q')])
        </div>
    </div>
</div>
@endsection