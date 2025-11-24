@extends('backend.layouts.master')

@section('title', 'Edit Landing Page')

@push('backend_style')
    @include('backend.pages.common.style')
    <style>
        .form-group {
            margin-bottom: 1.5rem;
        }
        
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
    </style>
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Edit Landing Page</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('landingpages.index') }}">Landing Page</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Edit Landing Page</h3>
                    <a href="{{ route('landingpages.index') }}" class="btn btn-info"><i class="fa-solid fa-angles-left fa-fw"></i> Back</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('landingpages.update', $landingPage->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-12">
                                <h4 class="section-title">Main Header Section</h4>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="main_heading">Main Heading <span class="text-danger">*</span></label>
                                    <input type="text" name="main_heading" class="form-control @error('main_heading') is-invalid @enderror" id="main_heading" value="{{ old('main_heading', $landingPage->main_heading) }}">
                                    @error('main_heading')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="video_url">Video URL</label>
                                    <input type="url" name="video_url" class="form-control @error('video_url') is-invalid @enderror" id="video_url" value="{{ old('video_url', $landingPage->video_url) }}">
                                    @error('video_url')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="main_call_to_action_text">Main CTA Text</label>
                                    <input type="text" name="main_call_to_action_text" class="form-control @error('main_call_to_action_text') is-invalid @enderror" id="main_call_to_action_text" value="{{ old('main_call_to_action_text', $landingPage->main_call_to_action_text) }}">
                                    @error('main_call_to_action_text')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="main_call_to_action_url">Main CTA URL</label>
                                    <input type="url" name="main_call_to_action_url" class="form-control @error('main_call_to_action_url') is-invalid @enderror" id="main_call_to_action_url" value="{{ old('main_call_to_action_url', $landingPage->main_call_to_action_url) }}">
                                    @error('main_call_to_action_url')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="main_description">Main Description</label>
                                    <textarea name="main_description" id="main_description" class="form-control @error('main_description') is-invalid @enderror" rows="3">{{ old('main_description', $landingPage->main_description) }}</textarea>
                                    @error('main_description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="section-divider"></div>
                        
                        <div class="row">
                            <div class="col-12">
                                <h4 class="section-title">Benefits Section</h4>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="benefits_title">Benefits Title</label>
                                    <input type="text" name="benefits_title" class="form-control @error('benefits_title') is-invalid @enderror" id="benefits_title" value="{{ old('benefits_title', $landingPage->benefits_title) }}">
                                    @error('benefits_title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="benefits_list">Benefits List (Enter each benefit on a new line)</label>
                                    <textarea name="benefits_list[]" id="benefits_list" class="form-control @error('benefits_list') is-invalid @enderror" rows="4" placeholder="Enter one benefit per line">{{ old('benefits_list') ? implode("\n", old('benefits_list')) : ($landingPage->benefits_list ? implode("\n", $landingPage->benefits_list) : '') }}</textarea>
                                    @error('benefits_list')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="section-divider"></div>
                        
                        <div class="row">
                            <div class="col-12">
                                <h4 class="section-title">Why Buy Section</h4>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="why_buy_title">Why Buy Title</label>
                                    <input type="text" name="why_buy_title" class="form-control @error('why_buy_title') is-invalid @enderror" id="why_buy_title" value="{{ old('why_buy_title', $landingPage->why_buy_title) }}">
                                    @error('why_buy_title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="why_buy_call_to_action_text">Why Buy CTA Text</label>
                                    <input type="text" name="why_buy_call_to_action_text" class="form-control @error('why_buy_call_to_action_text') is-invalid @enderror" id="why_buy_call_to_action_text" value="{{ old('why_buy_call_to_action_text', $landingPage->why_buy_call_to_action_text) }}">
                                    @error('why_buy_call_to_action_text')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="why_buy_call_to_action_url">Why Buy CTA URL</label>
                                    <input type="url" name="why_buy_call_to_action_url" class="form-control @error('why_buy_call_to_action_url') is-invalid @enderror" id="why_buy_call_to_action_url" value="{{ old('why_buy_call_to_action_url', $landingPage->why_buy_call_to_action_url) }}">
                                    @error('why_buy_call_to_action_url')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="why_buy_description">Why Buy Description</label>
                                    <textarea name="why_buy_description" id="why_buy_description" class="form-control @error('why_buy_description') is-invalid @enderror" rows="3">{{ old('why_buy_description', $landingPage->why_buy_description) }}</textarea>
                                    @error('why_buy_description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="why_buy_images">Why Buy Images (Enter each image path on a new line)</label>
                                    <textarea name="why_buy_images[]" id="why_buy_images" class="form-control @error('why_buy_images') is-invalid @enderror" rows="3" placeholder="Enter one image path per line">{{ old('why_buy_images') ? implode("\n", old('why_buy_images')) : ($landingPage->why_buy_images ? implode("\n", $landingPage->why_buy_images) : '') }}</textarea>
                                    @error('why_buy_images')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="section-divider"></div>
                        
                        <div class="row">
                            <div class="col-12">
                                <h4 class="section-title">Usage Instructions Section</h4>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="usage_title">Usage Title</label>
                                    <input type="text" name="usage_title" class="form-control @error('usage_title') is-invalid @enderror" id="usage_title" value="{{ old('usage_title', $landingPage->usage_title) }}">
                                    @error('usage_title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="usage_call_to_action_text">Usage CTA Text</label>
                                    <input type="text" name="usage_call_to_action_text" class="form-control @error('usage_call_to_action_text') is-invalid @enderror" id="usage_call_to_action_text" value="{{ old('usage_call_to_action_text', $landingPage->usage_call_to_action_text) }}">
                                    @error('usage_call_to_action_text')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="usage_call_to_action_url">Usage CTA URL</label>
                                    <input type="url" name="usage_call_to_action_url" class="form-control @error('usage_call_to_action_url') is-invalid @enderror" id="usage_call_to_action_url" value="{{ old('usage_call_to_action_url', $landingPage->usage_call_to_action_url) }}">
                                    @error('usage_call_to_action_url')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="usage_instructions">Usage Instructions</label>
                                    <textarea name="usage_instructions" id="usage_instructions" class="form-control @error('usage_instructions') is-invalid @enderror" rows="3">{{ old('usage_instructions', $landingPage->usage_instructions) }}</textarea>
                                    @error('usage_instructions')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="section-divider"></div>
                        
                        <div class="row">
                            <div class="col-12">
                                <h4 class="section-title">Certificate Section</h4>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="certificate_title">Certificate Title</label>
                                    <input type="text" name="certificate_title" class="form-control @error('certificate_title') is-invalid @enderror" id="certificate_title" value="{{ old('certificate_title', $landingPage->certificate_title) }}">
                                    @error('certificate_title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="certificate_subtitle">Certificate Subtitle</label>
                                    <input type="text" name="certificate_subtitle" class="form-control @error('certificate_subtitle') is-invalid @enderror" id="certificate_subtitle" value="{{ old('certificate_subtitle', $landingPage->certificate_subtitle) }}">
                                    @error('certificate_subtitle')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="certificate_image">Certificate Image Path</label>
                                    <input type="text" name="certificate_image" class="form-control @error('certificate_image') is-invalid @enderror" id="certificate_image" value="{{ old('certificate_image', $landingPage->certificate_image) }}">
                                    @error('certificate_image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="section-divider"></div>
                        
                        <div class="row">
                            <div class="col-12">
                                <h4 class="section-title">Customer Reviews Section</h4>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="reviews_title">Reviews Title</label>
                                    <input type="text" name="reviews_title" class="form-control @error('reviews_title') is-invalid @enderror" id="reviews_title" value="{{ old('reviews_title', $landingPage->reviews_title) }}">
                                    @error('reviews_title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="customer_reviews">Customer Reviews (Enter each review on a new line)</label>
                                    <textarea name="customer_reviews[]" id="customer_reviews" class="form-control @error('customer_reviews') is-invalid @enderror" rows="4" placeholder="Enter one review per line">{{ old('customer_reviews') ? implode("\n", old('customer_reviews')) : ($landingPage->customer_reviews ? implode("\n", $landingPage->customer_reviews) : '') }}</textarea>
                                    @error('customer_reviews')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="section-divider"></div>
                        
                        <div class="row">
                            <div class="col-12">
                                <h4 class="section-title">Cover & Pricing Section</h4>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cover_image">Cover Image Path</label>
                                    <input type="text" name="cover_image" class="form-control @error('cover_image') is-invalid @enderror" id="cover_image" value="{{ old('cover_image', $landingPage->cover_image) }}">
                                    @error('cover_image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="original_price">Original Price</label>
                                    <input type="text" name="original_price" class="form-control @error('original_price') is-invalid @enderror" id="original_price" value="{{ old('original_price', $landingPage->original_price) }}">
                                    @error('original_price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="offer_price">Offer Price</label>
                                    <input type="text" name="offer_price" class="form-control @error('offer_price') is-invalid @enderror" id="offer_price" value="{{ old('offer_price', $landingPage->offer_price) }}">
                                    @error('offer_price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pricing_subtitle">Pricing Subtitle</label>
                                    <input type="text" name="pricing_subtitle" class="form-control @error('pricing_subtitle') is-invalid @enderror" id="pricing_subtitle" value="{{ old('pricing_subtitle', $landingPage->pricing_subtitle) }}">
                                    @error('pricing_subtitle')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="cover_description">Cover Description</label>
                                    <textarea name="cover_description" id="cover_description" class="form-control @error('cover_description') is-invalid @enderror" rows="3">{{ old('cover_description', $landingPage->cover_description) }}</textarea>
                                    @error('cover_description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="section-divider"></div>
                        
                        <div class="row">
                            <div class="col-12">
                                <h4 class="section-title">CTA Banner Section</h4>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cta_banner_image">CTA Banner Image Path</label>
                                    <input type="text" name="cta_banner_image" class="form-control @error('cta_banner_image') is-invalid @enderror" id="cta_banner_image" value="{{ old('cta_banner_image', $landingPage->cta_banner_image) }}">
                                    @error('cta_banner_image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cta_banner_phone">CTA Banner Phone</label>
                                    <input type="text" name="cta_banner_phone" class="form-control @error('cta_banner_phone') is-invalid @enderror" id="cta_banner_phone" value="{{ old('cta_banner_phone', $landingPage->cta_banner_phone) }}">
                                    @error('cta_banner_phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cta_banner_text">CTA Banner Text</label>
                                    <input type="text" name="cta_banner_text" class="form-control @error('cta_banner_text') is-invalid @enderror" id="cta_banner_text" value="{{ old('cta_banner_text', $landingPage->cta_banner_text) }}">
                                    @error('cta_banner_text')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cta_banner_call_to_action_text">CTA Banner CTA Text</label>
                                    <input type="text" name="cta_banner_call_to_action_text" class="form-control @error('cta_banner_call_to_action_text') is-invalid @enderror" id="cta_banner_call_to_action_text" value="{{ old('cta_banner_call_to_action_text', $landingPage->cta_banner_call_to_action_text) }}">
                                    @error('cta_banner_call_to_action_text')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cta_banner_call_to_action_url">CTA Banner CTA URL</label>
                                    <input type="url" name="cta_banner_call_to_action_url" class="form-control @error('cta_banner_call_to_action_url') is-invalid @enderror" id="cta_banner_call_to_action_url" value="{{ old('cta_banner_call_to_action_url', $landingPage->cta_banner_call_to_action_url) }}">
                                    @error('cta_banner_call_to_action_url')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="section-divider"></div>
                        
                        <div class="row">
                            <div class="col-12">
                                <h4 class="section-title">Products Association</h4>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="product_ids">Associated Products</label>
                                    <select name="product_ids[]" id="product_ids" class="form-control select2 @error('product_ids') is-invalid @enderror" multiple>
                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}" {{ in_array($product->id, $selectedProductIds) ? 'selected' : '' }}>{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('product_ids')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <small class="form-text text-muted">Hold Ctrl/Cmd to select multiple products</small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="section-divider"></div>
                        
                        <div class="row">
                            <div class="col-12">
                                <h4 class="section-title">Footer & Settings</h4>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="footer_text">Footer Text</label>
                                    <input type="text" name="footer_text" class="form-control @error('footer_text') is-invalid @enderror" id="footer_text" value="{{ old('footer_text', $landingPage->footer_text) }}">
                                    @error('footer_text')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-check">
                                        <input type="checkbox" name="is_active" class="form-check-input @error('is_active') is-invalid @enderror" id="is_active" value="1" {{ old('is_active', $landingPage->is_active) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">Active</label>
                                        @error('is_active')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success"><i class="fa-solid fa-paper-plane fa-fw"></i> Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('backend_script')
    @include('backend.pages.common.script')
    <script>
        // Convert textareas with multiple values to arrays
        document.addEventListener('DOMContentLoaded', function() {
            const textAreas = document.querySelectorAll('textarea[name$="[]"]');
            textAreas.forEach(function(textarea) {
                textarea.addEventListener('blur', function() {
                    const lines = this.value.split('\n');
                    const filteredLines = lines.filter(line => line.trim() !== '');
                    
                    // Create a hidden input for each line
                    this.parentNode.querySelectorAll('.dynamic-array-input').forEach(el => el.remove());
                    
                    filteredLines.forEach(function(line, index) {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = textarea.name.replace('[]', '') + '[]';
                        input.value = line.trim();
                        input.className = 'dynamic-array-input';
                        textarea.parentNode.appendChild(input);
                    });
                });
                
                // Trigger the blur event on initial load
                textarea.dispatchEvent(new Event('blur'));
            });
        });
    </script>
@endpush