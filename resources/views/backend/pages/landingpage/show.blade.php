@extends('backend.layouts.master')

@section('title', 'Landing Page Details')

@push('backend_style')
    @include('backend.pages.common.style')
    <style>
        .section-divider {
            border-top: 2px solid #dee2e6;
            margin: 2rem 0;
            padding-top: 1rem;
        }
        
        .section-title {
            font-size: 1.25rem;
            margin-bottom: 1rem;
            color: #495057;
        }
        
        .info-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .info-table th {
            width: 30%;
            text-align: left;
            padding: 8px;
            vertical-align: top;
            border-bottom: 1px solid #dee2e6;
        }
        
        .info-table td {
            text-align: left;
            padding: 8px;
            vertical-align: top;
            border-bottom: 1px solid #dee2e6;
        }
    </style>
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Landing Page Details</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('landingpages.index') }}">Landing Page</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Details</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Landing Page Details</h3>
                    <a href="{{ route('landingpages.index') }}" class="btn btn-primary">Back to Landing Pages</a>
                </div>
                <div class="card-body">
                    <h4 class="section-title">Main Header Section</h4>
                    <table class="info-table">
                        <tr>
                            <th>Main Heading:</th>
                            <td>{{ $landingPage->main_heading ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Video URL:</th>
                            <td>{{ $landingPage->video_url ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Main CTA Text:</th>
                            <td>{{ $landingPage->main_call_to_action_text ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Main CTA URL:</th>
                            <td>{{ $landingPage->main_call_to_action_url ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Main Description:</th>
                            <td>{!! $landingPage->main_description ? Str::limit($landingPage->main_description, 200) : 'N/A' !!}</td>
                        </tr>
                    </table>
                    
                    <div class="section-divider"></div>
                    
                    <h4 class="section-title">Benefits Section</h4>
                    <table class="info-table">
                        <tr>
                            <th>Benefits Title:</th>
                            <td>{{ $landingPage->benefits_title ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Benefits List:</th>
                            <td>
                                @if($landingPage->benefits_list && is_array($landingPage->benefits_list))
                                    <ul>
                                        @foreach($landingPage->benefits_list as $benefit)
                                            <li>{{ $benefit }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    N/A
                                @endif
                            </td>
                        </tr>
                    </table>
                    
                    <div class="section-divider"></div>
                    
                    <h4 class="section-title">Why Buy Section</h4>
                    <table class="info-table">
                        <tr>
                            <th>Why Buy Title:</th>
                            <td>{{ $landingPage->why_buy_title ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Why Buy CTA Text:</th>
                            <td>{{ $landingPage->why_buy_call_to_action_text ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Why Buy CTA URL:</th>
                            <td>{{ $landingPage->why_buy_call_to_action_url ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Why Buy Description:</th>
                            <td>{!! $landingPage->why_buy_description ? Str::limit($landingPage->why_buy_description, 200) : 'N/A' !!}</td>
                        </tr>
                        <tr>
                            <th>Why Buy Images:</th>
                            <td>
                                @if($landingPage->why_buy_images && is_array($landingPage->why_buy_images))
                                    <ul>
                                        @foreach($landingPage->why_buy_images as $image)
                                            <li>{{ $image }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    N/A
                                @endif
                            </td>
                        </tr>
                    </table>
                    
                    <div class="section-divider"></div>
                    
                    <h4 class="section-title">Usage Instructions Section</h4>
                    <table class="info-table">
                        <tr>
                            <th>Usage Title:</th>
                            <td>{{ $landingPage->usage_title ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Usage CTA Text:</th>
                            <td>{{ $landingPage->usage_call_to_action_text ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Usage CTA URL:</th>
                            <td>{{ $landingPage->usage_call_to_action_url ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Usage Instructions:</th>
                            <td>{!! $landingPage->usage_instructions ? Str::limit($landingPage->usage_instructions, 200) : 'N/A' !!}</td>
                        </tr>
                    </table>
                    
                    <div class="section-divider"></div>
                    
                    <h4 class="section-title">Certificate Section</h4>
                    <table class="info-table">
                        <tr>
                            <th>Certificate Title:</th>
                            <td>{{ $landingPage->certificate_title ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Certificate Subtitle:</th>
                            <td>{{ $landingPage->certificate_subtitle ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Certificate Image:</th>
                            <td>{{ $landingPage->certificate_image ?? 'N/A' }}</td>
                        </tr>
                    </table>
                    
                    <div class="section-divider"></div>
                    
                    <h4 class="section-title">Customer Reviews Section</h4>
                    <table class="info-table">
                        <tr>
                            <th>Reviews Title:</th>
                            <td>{{ $landingPage->reviews_title ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Customer Reviews:</th>
                            <td>
                                @if($landingPage->customer_reviews && is_array($landingPage->customer_reviews))
                                    <ul>
                                        @foreach($landingPage->customer_reviews as $review)
                                            <li>{{ $review }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    N/A
                                @endif
                            </td>
                        </tr>
                    </table>
                    
                    <div class="section-divider"></div>
                    
                    <h4 class="section-title">Cover & Pricing Section</h4>
                    <table class="info-table">
                        <tr>
                            <th>Cover Image:</th>
                            <td>{{ $landingPage->cover_image ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Original Price:</th>
                            <td>{{ $landingPage->original_price ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Offer Price:</th>
                            <td>{{ $landingPage->offer_price ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Pricing Subtitle:</th>
                            <td>{{ $landingPage->pricing_subtitle ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Cover Description:</th>
                            <td>{!! $landingPage->cover_description ? Str::limit($landingPage->cover_description, 200) : 'N/A' !!}</td>
                        </tr>
                    </table>
                    
                    <div class="section-divider"></div>
                    
                    <h4 class="section-title">CTA Banner Section</h4>
                    <table class="info-table">
                        <tr>
                            <th>CTA Banner Image:</th>
                            <td>{{ $landingPage->cta_banner_image ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>CTA Banner Phone:</th>
                            <td>{{ $landingPage->cta_banner_phone ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>CTA Banner Text:</th>
                            <td>{{ $landingPage->cta_banner_text ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>CTA Banner CTA Text:</th>
                            <td>{{ $landingPage->cta_banner_call_to_action_text ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>CTA Banner CTA URL:</th>
                            <td>{{ $landingPage->cta_banner_call_to_action_url ?? 'N/A' }}</td>
                        </tr>
                    </table>
                    
                    <div class="section-divider"></div>
                    
                    <h4 class="section-title">Products Association</h4>
                    <table class="info-table">
                        <tr>
                            <th>Associated Products:</th>
                            <td>
                                @if($landingPage->products && $landingPage->products->count() > 0)
                                    <ul>
                                        @foreach($landingPage->products as $product)
                                            <li>{{ $product->name }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    No products associated
                                @endif
                            </td>
                        </tr>
                    </table>
                    
                    <div class="section-divider"></div>
                    
                    <h4 class="section-title">Footer & Settings</h4>
                    <table class="info-table">
                        <tr>
                            <th>Footer Text:</th>
                            <td>{{ $landingPage->footer_text ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Status:</th>
                            <td>
                                @if ($landingPage->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Created At:</th>
                            <td>{{ $landingPage->created_at->format('d M, Y h:i A') }}</td>
                        </tr>
                        <tr>
                            <th>Updated At:</th>
                            <td>{{ $landingPage->updated_at->format('d M, Y h:i A') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('backend_script')
    @include('backend.pages.common.script')
@endpush