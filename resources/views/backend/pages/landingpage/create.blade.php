@extends('backend.layouts.master')

@section('title', 'Create Landing Page')

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
                    <h1 class="page-title">Create Landing Page</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('landingpages.index') }}">Landing Page</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Create New Landing Page</h3>
                    <a href="{{ route('landingpages.index') }}" class="btn btn-info"><i class="fa-solid fa-angles-left fa-fw"></i> Back</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('landingpages.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-12">
                                <h4 class="section-title">Main Header Section</h4>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="main_heading">Main Heading <span class="text-danger">*</span></label>
                                    <input type="text" name="main_heading" class="form-control @error('main_heading') is-invalid @enderror" id="main_heading" value="{{ old('main_heading') }}">
                                    @error('main_heading')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="video">Main Video</label>
                                    <input type="file" name="video" class="form-control @error('video') is-invalid @enderror" id="video" accept="video/*">
                                    @error('video')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <small class="form-text text-muted">Upload a video file (mp4, mov, avi, wmv, flv). Max size: 27MB</small>
                                </div>
                            </div>

                            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label for="main_call_to_action_text">Main CTA Text</label>
                                    <input type="text" name="main_call_to_action_text" class="form-control @error('main_call_to_action_text') is-invalid @enderror" id="main_call_to_action_text" value="{{ old('main_call_to_action_text') }}">
                                    @error('main_call_to_action_text')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div> --}}

                            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label for="main_call_to_action_url">Main CTA URL</label>
                                    <input type="url" name="main_call_to_action_url" class="form-control @error('main_call_to_action_url') is-invalid @enderror" id="main_call_to_action_url" value="{{ old('main_call_to_action_url') }}">
                                    @error('main_call_to_action_url')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div> --}}

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="main_description">Main Description</label>
                                    <textarea name="main_description" id="main_description" class="form-control @error('main_description') is-invalid @enderror" rows="3">{{ old('main_description') }}</textarea>
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
                                    <input type="text" name="benefits_title" class="form-control @error('benefits_title') is-invalid @enderror" id="benefits_title" value="{{ old('benefits_title') }}">
                                    @error('benefits_title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="benefits_list">Benefits Description</label>
                                    <textarea name="benefits_list" id="summernote-benefits" class="form-control @error('benefits_list') is-invalid @enderror" rows="4" placeholder="Enter benefits with HTML formatting">{{ old('benefits_list') }}</textarea>
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
                                    <input type="text" name="why_buy_title" class="form-control @error('why_buy_title') is-invalid @enderror" id="why_buy_title" value="{{ old('why_buy_title') }}">
                                    @error('why_buy_title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="why_buy_description">Why Buy Description</label>
                                    <textarea name="why_buy_description" id="why_buy_description" class="form-control @error('why_buy_description') is-invalid @enderror" rows="3">{{ old('why_buy_description') }}</textarea>
                                    @error('why_buy_description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="why_buy_images">Why Buy Images</label>
                                    <div id="whyBuyImageFields">
                                        <div class="d-flex justify-content-between mb-2" id="whyBuyImageField0">
                                            <input type="file" name="why_buy_images[]" class="form-control me-4" multiple accept="image/*" />
                                            <button type="button" class="btn btn-secondary addWhyBuyImageField">+</button>
                                        </div>
                                    </div>
                                    <small class="form-text text-muted">Upload multiple images. Click the + button to add more image fields.</small>
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
                                    <input type="text" name="usage_title" class="form-control @error('usage_title') is-invalid @enderror" id="usage_title" value="{{ old('usage_title') }}">
                                    @error('usage_title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="usage_instructions">Usage Instructions</label>
                                    <textarea name="usage_instructions" id="usage_instructions" class="form-control @error('usage_instructions') is-invalid @enderror" rows="3">{{ old('usage_instructions') }}</textarea>
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
                                    <input type="text" name="certificate_title" class="form-control @error('certificate_title') is-invalid @enderror" id="certificate_title" value="{{ old('certificate_title') }}">
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
                                    <input type="text" name="certificate_subtitle" class="form-control @error('certificate_subtitle') is-invalid @enderror" id="certificate_subtitle" value="{{ old('certificate_subtitle') }}">
                                    @error('certificate_subtitle')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="certificate_image">Certificate Image</label>
                                    <input type="file" name="certificate_image" class="form-control @error('certificate_image') is-invalid @enderror" id="certificate_image" accept="image/*">
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
                                <h4 class="section-title">Review Images Section</h4>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="review_images">Review Images (Screenshots)</label>
                                    <div id="reviewImageFields" class="mt-3">
                                        <div class="d-flex justify-content-between mb-2" id="reviewImageField0">
                                            <input type="file" name="review_images[]" class="form-control me-4" accept="image/*" />
                                            <button type="button" class="btn btn-secondary addReviewImageField">+</button>
                                        </div>
                                    </div>
                                    <small class="form-text text-muted">Upload multiple images. Click the + button to add more image fields.</small>
                                    @error('review_images')
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
                                    <label for="cta_banner_image">CTA Banner Image</label>
                                    <input type="file" name="cta_banner_image" class="form-control @error('cta_banner_image') is-invalid @enderror" id="cta_banner_image" accept="image/*">
                                    @error('cta_banner_image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cta_banner_phone">CTA Banner Phone</label>
                                    <input type="text" name="cta_banner_phone" class="form-control @error('cta_banner_phone') is-invalid @enderror" id="cta_banner_phone" value="{{ old('cta_banner_phone') }}">
                                    @error('cta_banner_phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div> --}}

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cta_banner_text">CTA Banner Text</label>
                                    <input type="text" name="cta_banner_text" class="form-control @error('cta_banner_text') is-invalid @enderror" id="cta_banner_text" value="{{ old('cta_banner_text') }}">
                                    @error('cta_banner_text')
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
                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('product_ids')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- <div class="section-divider"></div> --}}

                        <div class="row">
                            {{-- <div class="col-12">
                                <h4 class="section-title">Footer & Settings</h4>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="footer_text">Footer Text</label>
                                    <input type="text" name="footer_text" class="form-control @error('footer_text') is-invalid @enderror" id="footer_text" value="{{ old('footer_text') }}">
                                    @error('footer_text')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div> --}}

                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-check">
                                        <input type="checkbox" name="is_active" class="form-check-input @error('is_active') is-invalid @enderror" id="is_active" value="1" {{ old('is_active') ? 'checked' : '' }}>
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
                                    <button type="submit" class="btn btn-success"><i class="fa-solid fa-paper-plane fa-fw"></i> Submit</button>
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
        $(document).ready(function() {
            // Initialize Summernote for benefits
            $('#summernote-benefits').summernote({
                placeholder: 'Enter benefits with formatting...',
                tabsize: 2,
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });

            // Add Why Buy Image field
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('addWhyBuyImageField')) {
                    const fieldCount = document.querySelectorAll('#whyBuyImageFields .d-flex').length;
                    const newField = document.createElement('div');
                    newField.className = 'd-flex justify-content-between mb-2';
                    newField.id = 'whyBuyImageField' + fieldCount;
                    newField.innerHTML = `
                        <input type="file" name="why_buy_images[]" class="form-control me-4" multiple accept="image/*" />
                        <button type="button" class="btn btn-danger removeWhyBuyImageField">-</button>
                    `;
                    document.getElementById('whyBuyImageFields').appendChild(newField);
                }
            });

            // Remove Why Buy Image field
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('removeWhyBuyImageField')) {
                    e.target.closest('.d-flex').remove();
                }
            });

            // Add Review Image field
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('addReviewImageField')) {
                    const fieldCount = document.querySelectorAll('#reviewImageFields .d-flex').length;
                    const newField = document.createElement('div');
                    newField.className = 'd-flex justify-content-between mb-2';
                    newField.id = 'reviewImageField' + fieldCount;
                    newField.innerHTML = `
                        <input type="file" name="review_images[]" class="form-control me-4" accept="image/*" />
                        <button type="button" class="btn btn-danger removeReviewImageField">-</button>
                    `;
                    document.getElementById('reviewImageFields').appendChild(newField);
                }
            });

            // Remove Review Image field
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('removeReviewImageField')) {
                    e.target.closest('.d-flex').remove();
                }
            });
        });
    </script>
@endpush
