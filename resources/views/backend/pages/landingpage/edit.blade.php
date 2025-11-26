@extends('backend.layouts.master')

@section('title', 'Edit Landing Page')

@push('backend_style')
    @include('backend.pages.common.style')
    <link href="{{asset('assets/backend')}}/plugins/select2/css/select2.min.css" rel="stylesheet" />
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

        .multi_img {
            position: relative;
            width: 95px;
            height: 95px;
            overflow: hidden;
        }

        .remove_icon {
            position: absolute;
            top: 0;
            right: 1px;
            opacity: 0;
            z-index: 999;
        }
        .remove_icon .delete-image {
            width: 24px;
            height: 24px;
            line-height: 24px;
        }
        .remove_icon .delete-image i{
            font-size: 22px;
        }

        .multi_img:hover .remove_icon {
            opacity: 1;
            transition: all 0.5s ease;
        }

        .multi_img img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: opacity 0.5s ease;
        }

        .multi_img img:hover {
            opacity: 0.5;
        }

        .select2-container {
            width: 100% !important;
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
                    <form action="{{ route('landingpages.update', $landingPage->id) }}" method="POST" enctype="multipart/form-data">
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
                                    <label for="video">Main Video</label>
                                    <input type="file" name="video" class="form-control @error('video') is-invalid @enderror" id="video" accept="video/*">
                                    @error('video')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    @if($landingPage->video_url)
                                        <div class="mt-2">
                                            <label>Current Video:</label>
                                            <div>
                                                <video width="320" height="240" controls>
                                                    <source src="{{ asset('uploads/landingpages/' . $landingPage->video_url) }}" type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                                                <div class="mt-2">
                                                    <a href="{{ asset('uploads/landingpages/' . $landingPage->video_url) }}" target="_blank">View Current Video</a>
                                                    <button type="button" class="btn btn-danger btn-sm ml-2 delete-video" data-id="{{ $landingPage->id }}">
                                                        <i class="fa-solid fa-trash"></i> Delete Video
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <small class="form-text text-muted">Upload a video file (mp4, mov, avi, wmv, flv). Max size: 27MB</small>
                                </div>
                            </div>

                            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label for="main_call_to_action_text">Main CTA Text</label>
                                    <input type="text" name="main_call_to_action_text" class="form-control @error('main_call_to_action_text') is-invalid @enderror" id="main_call_to_action_text" value="{{ old('main_call_to_action_text', $landingPage->main_call_to_action_text) }}">
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
                                    <input type="url" name="main_call_to_action_url" class="form-control @error('main_call_to_action_url') is-invalid @enderror" id="main_call_to_action_url" value="{{ old('main_call_to_action_url', $landingPage->main_call_to_action_url) }}">
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
                                    <label for="why_buy_images">Why Buy Images</label>
                                    @if($landingPage->whyBuyImages->count() > 0)
                                        <ul class="list-inline mt-3">
                                            @foreach($landingPage->whyBuyImages as $image)
                                                <li class="list-inline-item multi_img" id="why-buy-image-{{ $image->id }}">
                                                    <img src="{{ asset('uploads/landingpages') }}/{{ $image->image_path }}" alt="" style="height: 95px">
                                                    <div class="remove_icon">
                                                        <button type="button" class="btn-outline-warning border show_confirm delete-image p-0"
                                                            data-id="{{ $image->id }}" data-toggle="tooltip"
                                                            data-placement="top" data-bs-original-title="Delete">
                                                            <i class="fa-regular fa-circle-xmark"></i>
                                                        </button>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                    <div id="whyBuyImageFields" class="mt-3">
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
                                    <input type="text" name="usage_title" class="form-control @error('usage_title') is-invalid @enderror" id="usage_title" value="{{ old('usage_title', $landingPage->usage_title) }}">
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
                                    <label for="certificate_image">Certificate Image</label>
                                    <input type="file" name="certificate_image" class="form-control @error('certificate_image') is-invalid @enderror" id="certificate_image" accept="image/*">
                                    @error('certificate_image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    @if($landingPage->certificate_image)
                                        <div class="mt-2">
                                            <label>Current Image:</label>
                                            <div>
                                                <img src="{{ asset('uploads/landingpages/' . $landingPage->certificate_image) }}" alt="Current Certificate Image" style="max-width: 200px; max-height: 150px;">
                                                <div class="mt-2">
                                                    <button type="button" class="btn btn-danger btn-sm delete-single-image" data-id="{{ $landingPage->id }}" data-field="certificate_image">
                                                        <i class="fa-solid fa-trash"></i> Delete Image
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
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
                                    @if($landingPage->reviewImages->count() > 0)
                                        <label>Current Review Images:</label>
                                        <ul class="list-unstyled mt-2" id="reviewImagesList">
                                            @foreach($landingPage->reviewImages as $reviewImage)
                                                <li class="position-relative multi_img mb-2" style="display: inline-block; width: 150px; height: 150px;">
                                                    <img src="{{ asset('uploads/landingpages/' . $reviewImage->image_path) }}" alt="Review Image" class="img-fluid h-100 w-100">
                                                    <div class="remove_icon">
                                                        <button type="button" class="btn-outline-danger border delete-review-image p-0"
                                                            data-id="{{ $reviewImage->id }}"
                                                            data-toggle="tooltip"
                                                            data-placement="top"
                                                            data-bs-original-title="Delete">
                                                            <i class="fa-regular fa-circle-xmark"></i>
                                                        </button>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                    <label class="mt-3">Add New Review Images (Screenshots)</label>
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
                                    @if($landingPage->cta_banner_image)
                                        <div class="mt-2">
                                            <label>Current Image:</label>
                                            <div>
                                                <img src="{{ asset('uploads/landingpages/' . $landingPage->cta_banner_image) }}" alt="Current CTA Banner Image" style="max-width: 200px; max-height: 150px;">
                                                <div class="mt-2">
                                                    <button type="button" class="btn btn-danger btn-sm delete-single-image" data-id="{{ $landingPage->id }}" data-field="cta_banner_image">
                                                        <i class="fa-solid fa-trash"></i> Delete Image
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cta_banner_phone">CTA Banner Phone</label>
                                    <input type="text" name="cta_banner_phone" class="form-control @error('cta_banner_phone') is-invalid @enderror" id="cta_banner_phone" value="{{ old('cta_banner_phone', $landingPage->cta_banner_phone) }}">
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
                                    <input type="text" name="cta_banner_text" class="form-control @error('cta_banner_text') is-invalid @enderror" id="cta_banner_text" value="{{ old('cta_banner_text', $landingPage->cta_banner_text) }}">
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
                                            <option value="{{ $product->id }}" {{ in_array($product->id, $selectedProductIds) ? 'selected' : '' }}>{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('product_ids')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <!-- Display selected products as tags -->
                                    @if(count($selectedProductIds) > 0)
                                        <div class="mt-2">
                                            <strong>Currently Selected Products:</strong>
                                            <div class="selected-products-tags mt-2">
                                                @foreach($landingPage->products as $product)
                                                    <span class="badge badge-success bg-success me-2 mb-1" style="font-size: 14px; padding: 6px 12px;">
                                                        {{ $product->name }}
                                                        <a href="#" class="remove-product ms-2" data-product-id="{{ $product->id }}" style="color: white; text-decoration: none;" onclick="removeProduct({{ $product->id }}); return false;">&times;</a>
                                                    </span>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
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
                                    <input type="text" name="footer_text" class="form-control @error('footer_text') is-invalid @enderror" id="footer_text" value="{{ old('footer_text', $landingPage->footer_text) }}">
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
        });

        // Delete existing why buy images
        $(document).ready(function() {
            // Delete existing why buy image
            $(document).on('click', '.delete-image', function(e) {
                e.preventDefault();

                var imageId = $(this).data('id');
                var url = "{{ route('landingpage.image.delete', ':id') }}";
                url = url.replace(':id', imageId);

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            type: 'DELETE',
                            data: {
                                "_token": "{{ csrf_token() }}",
                            },
                            success: function(response) {
                                $('#why-buy-image-' + imageId).remove();
                                Swal.fire(
                                    'Deleted!',
                                    'Your image has been deleted.',
                                    'success'
                                );
                            },
                            error: function(xhr) {
                                console.error(xhr.responseText);
                                Swal.fire(
                                    'Error!',
                                    'Something went wrong. Please try again.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });

            // Delete video
            $(document).on('click', '.delete-video', function(e) {
                e.preventDefault();

                var landingPageId = $(this).data('id');
                var url = "{{ route('landingpage.video.delete', ':id') }}";
                url = url.replace(':id', landingPageId);

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            type: 'DELETE',
                            data: {
                                "_token": "{{ csrf_token() }}",
                            },
                            success: function(response) {
                                // Reload the page or remove the video element
                                location.reload();
                            },
                            error: function(xhr) {
                                console.error(xhr.responseText);
                                Swal.fire(
                                    'Error!',
                                    'Something went wrong. Please try again.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });

            // Delete single image (certificate_image or cta_banner_image)
            $(document).on('click', '.delete-single-image', function(e) {
                e.preventDefault();

                var landingPageId = $(this).data('id');
                var field = $(this).data('field');
                var url = "{{ route('landingpage.single.image.delete', ':id') }}";
                url = url.replace(':id', landingPageId);

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            type: 'DELETE',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "field": field
                            },
                            success: function(response) {
                                // Reload the page or remove the image element
                                location.reload();
                            },
                            error: function(xhr) {
                                console.error(xhr.responseText);
                                Swal.fire(
                                    'Error!',
                                    'Something went wrong. Please try again.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });

            // Add new review image field
            var reviewImageFieldCount = 1;
            $(document).on('click', '.addReviewImageField', function(e) {
                e.preventDefault();

                var reviewImageField = `
                    <div class="d-flex justify-content-between mb-2" id="reviewImageField${reviewImageFieldCount}">
                        <input type="file" name="review_images[]" class="form-control me-4" accept="image/*" />
                        <button type="button" class="btn btn-danger removeReviewImageField">-</button>
                    </div>
                `;

                $('#reviewImageFields').append(reviewImageField);
                reviewImageFieldCount++;
            });

            // Remove review image field
            $(document).on('click', '.removeReviewImageField', function(e) {
                e.preventDefault();
                $(this).closest('div[id^="reviewImageField"]').remove();
            });

            // Delete review image
            $(document).on('click', '.delete-review-image', function(e) {
                e.preventDefault();

                var imageId = $(this).data('id');
                var url = "{{ route('landingpage.review.image.delete', ':id') }}";
                url = url.replace(':id', imageId);

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            type: 'DELETE',
                            data: {
                                "_token": "{{ csrf_token() }}",
                            },
                            success: function(response) {
                                // Remove the image element from the page
                                $(`button[data-id="${imageId}"]`).closest('li').remove();
                                Swal.fire(
                                    'Deleted!',
                                    'The review image has been deleted.',
                                    'success'
                                );
                            },
                            error: function(xhr) {
                                console.error(xhr.responseText);
                                Swal.fire(
                                    'Error!',
                                    'Something went wrong. Please try again.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
        });
    </script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            // Set the selected values BEFORE initializing Select2
            var selectedValues = <?php echo json_encode($selectedProductIds); ?>;

            // Initialize Select2 for product selection
            $('#product_ids').select2({
                placeholder: 'Select products...',
                allowClear: true,
                width: '100%'
            });

            // Set the selected values after initialization and trigger change
            $('#product_ids').val(selectedValues).trigger('change');
        });

        function removeProduct(productId) {
            // Remove the product from the select dropdown
            $('#product_ids option[value="' + productId + '"]').prop('selected', false);
            // Trigger change event to update Select2
            $('#product_ids').trigger('change');
            // Remove the tag visually
            $('[data-product-id="' + productId + '"]').closest('span').remove();
        }
    </script>
@endpush
