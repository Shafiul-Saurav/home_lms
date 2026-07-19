@extends('frontendone.layouts.master')

@section('title', 'Create New Post')

@push('frontendone_style')
    @include('frontend.pages.common.style')
    <style>
        /* ── Page wrapper ───────────────────────────────── */
        .create-post-area {
            background: #f8fafc;
            padding: 80px 0;
            min-height: 80vh;
        }

        /* ── Card ───────────────────────────────────────── */
        .create-post-card {
            background: #fff;
            border: 1px solid #edf0f5;
            border-radius: 24px;
            padding: 50px 48px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.06);
            transition: box-shadow 0.3s;
        }
        .create-post-card:hover {
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.1);
        }

        /* ── Header ─────────────────────────────────────── */
        .create-post-header {
            margin-bottom: 36px;
            padding-bottom: 24px;
            border-bottom: 1px solid #f1f5f9;
        }
        .create-post-header .badge-tag {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(118, 189, 16, 0.12);
            color: #4a8c06;
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 14px;
        }
        .create-post-header h2 {
            font-size: 30px;
            font-weight: 900;
            color: #111827;
            margin-bottom: 8px;
        }
        .create-post-header p {
            font-size: 14px;
            color: #6b7280;
            font-weight: 500;
            margin: 0;
        }

        /* ── Form fields ────────────────────────────────── */
        .cp-form-group {
            margin-bottom: 24px;
        }
        .cp-form-group label {
            display: block;
            font-size: 12px;
            font-weight: 800;
            color: #374151;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.6px;
        }
        .cp-form-group label .req { color: #ef4444; margin-left: 2px; }

        .cp-input {
            width: 100%;
            height: 52px;
            border: 1.5px solid #e5e7eb;
            border-radius: 14px;
            padding: 0 18px;
            font-size: 14px;
            font-weight: 600;
            color: #111827;
            background: #fff;
            transition: border-color 0.25s, box-shadow 0.25s;
            outline: none;
        }
        .cp-input:focus {
            border-color: #76bd10;
            box-shadow: 0 0 0 4px rgba(118, 189, 16, 0.14);
        }
        .cp-input::placeholder { color: #9ca3af; }

        .cp-select {
            appearance: none;
            -webkit-appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%236b7280'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 16px center;
            background-size: 18px;
            padding-right: 44px;
        }

        .cp-textarea {
            width: 100%;
            border: 1.5px solid #e5e7eb;
            border-radius: 14px;
            padding: 14px 18px;
            font-size: 14px;
            font-weight: 600;
            color: #111827;
            background: #fff;
            resize: vertical;
            min-height: 110px;
            transition: border-color 0.25s, box-shadow 0.25s;
            outline: none;
        }
        .cp-textarea:focus {
            border-color: #76bd10;
            box-shadow: 0 0 0 4px rgba(118, 189, 16, 0.14);
        }
        .cp-textarea::placeholder { color: #9ca3af; }

        /* ── Image upload zone ──────────────────────────── */
        .cp-upload-zone {
            border: 2px dashed #d1d5db;
            border-radius: 14px;
            padding: 36px 20px;
            text-align: center;
            cursor: pointer;
            transition: border-color 0.25s, background 0.25s;
            position: relative;
            background: #fafafa;
        }
        .cp-upload-zone:hover {
            border-color: #76bd10;
            background: rgba(118, 189, 16, 0.04);
        }
        .cp-upload-zone input[type="file"] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
            width: 100%;
            height: 100%;
        }
        .cp-upload-zone .upload-icon {
            width: 52px;
            height: 52px;
            background: rgba(118, 189, 16, 0.1);
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #76bd10;
            font-size: 22px;
            margin: 0 auto 14px;
        }
        .cp-upload-zone .upload-text {
            font-size: 14px;
            font-weight: 700;
            color: #374151;
            margin-bottom: 4px;
        }
        .cp-upload-zone .upload-hint {
            font-size: 12px;
            color: #9ca3af;
            margin: 0;
        }
        #imagePreview {
            display: none;
            margin-top: 16px;
            border-radius: 12px;
            overflow: hidden;
        }
        #imagePreview img {
            width: 100%;
            height: 220px;
            object-fit: cover;
        }

        /* ── Errors ─────────────────────────────────────── */
        .cp-error {
            font-size: 12px;
            color: #ef4444;
            font-weight: 600;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .cp-input.is-invalid,
        .cp-textarea.is-invalid { border-color: #ef4444 !important; }

        /* ── Notices ─────────────────────────────────────── */
        .notice-box {
            border-radius: 12px;
            padding: 14px 18px;
            margin-bottom: 24px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            font-size: 13px;
            font-weight: 600;
        }
        .notice-box.warning {
            background: #fffbeb;
            border: 1px solid #fde68a;
            color: #92400e;
        }
        .notice-box.error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
        }
        .notice-box i { flex-shrink: 0; margin-top: 1px; }

        /* ── Submit button ──────────────────────────────── */
        .cp-submit-btn {
            width: 100%;
            height: 56px;
            background: #111827;
            color: #fff;
            border: none;
            border-radius: 50px;
            font-weight: 800;
            font-size: 15px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: background 0.3s, transform 0.2s;
            cursor: pointer;
            margin-top: 8px;
        }
        .cp-submit-btn:hover {
            background: #76bd10;
            transform: translateY(-2px);
        }

        /* ── Back link ──────────────────────────────────── */
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            font-size: 13px;
            font-weight: 700;
            color: #6b7280;
            text-decoration: none;
            margin-bottom: 28px;
            transition: color 0.2s;
        }
        .back-link:hover { color: #111827; }

        /* ── Sidebar ────────────────────────────────────── */
        .info-sidebar { position: sticky; top: 100px; }
        .info-card {
            background: #fff;
            border: 1px solid #edf0f5;
            border-radius: 20px;
            padding: 28px 24px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
            margin-bottom: 20px;
        }
        .info-card h5 {
            font-size: 15px;
            font-weight: 900;
            color: #111827;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .info-card h5 i { color: #76bd10; }
        .info-card ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .info-card ul li {
            font-size: 13px;
            color: #4b5563;
            font-weight: 600;
            padding: 8px 0;
            border-bottom: 1px solid #f3f4f6;
            display: flex;
            align-items: flex-start;
            gap: 8px;
            line-height: 1.5;
        }
        .info-card ul li:last-child { border-bottom: none; }
        .info-card ul li .li-icon { color: #76bd10; margin-top: 2px; flex-shrink: 0; }
        .info-card ul li .li-icon.danger { color: #ef4444; }

        @media (max-width: 991px) {
            .create-post-card { padding: 28px 20px; }
        }
    </style>
@endpush

@section('frontendone_content')
<main class="main">

    {{-- Breadcrumb --}}
    <x-frontend.pages.common.breadcrumb
        :title="'Create New Post'"
        :breadcrumb="[
            ['name' => 'Home', 'url' => route('home')],
            ['name' => 'Posts', 'url' => route('news.search')],
            ['name' => 'Create New Post', 'url' => '#']
        ]"
    />

    <div class="create-post-area">
        <div class="container">

            <a href="{{ route('news.search') }}" class="back-link">
                <i class="fa-solid fa-arrow-left"></i> Back to Blog
            </a>

            <div class="row g-5">

                {{-- ── FORM CARD ──────────────────────────────── --}}
                <div class="col-lg-8">
                    <div class="create-post-card">

                        <div class="create-post-header">
                            <div class="badge-tag">
                                <i class="fa-solid fa-pen-to-square"></i> Write an Article
                            </div>
                            <h2>Create New Post</h2>
                            <p>Share your thoughts, stories or insights with the community.</p>
                        </div>

                        {{-- Approval notice --}}
                        <div class="notice-box warning">
                            <i class="fa-solid fa-triangle-exclamation" style="color:#d97706;"></i>
                            <span>Your post will be reviewed by our admin before it appears publicly. This typically takes 1–2 business days.</span>
                        </div>

                        {{-- Validation errors --}}
                        @if ($errors->any())
                        <div class="notice-box error">
                            <i class="fa-solid fa-circle-xmark" style="color:#dc2626;"></i>
                            <div>
                                <strong>Please fix the following errors:</strong>
                                <ul style="margin:6px 0 0; padding-left:16px;">
                                    @foreach ($errors->all() as $error)
                                        <li style="font-size:13px;">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endif

                        <form action="{{ route('user.posts.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            {{-- Category --}}
                            <div class="cp-form-group">
                                <label for="category_id">Category <span class="req">*</span></label>
                                <select name="category_id" id="category_id"
                                    class="cp-input cp-select @error('category_id') is-invalid @enderror">
                                    <option value="">— Select a Category —</option>
                                    @foreach ($postCategories as $cat)
                                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->title }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="cp-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Title --}}
                            <div class="cp-form-group">
                                <label for="title">Post Title <span class="req">*</span></label>
                                <input type="text" name="title" id="title"
                                    class="cp-input @error('title') is-invalid @enderror"
                                    placeholder="Enter an engaging title…"
                                    value="{{ old('title') }}" maxlength="255">
                                @error('title')
                                    <div class="cp-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Short Description --}}
                            <div class="cp-form-group">
                                <label for="short_des">Short Description <span class="req">*</span></label>
                                <textarea name="short_des" id="short_des" rows="3"
                                    class="cp-textarea @error('short_des') is-invalid @enderror"
                                    placeholder="A brief 1–2 sentence summary (shown on the blog card)…">{{ old('short_des') }}</textarea>
                                @error('short_des')
                                    <div class="cp-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Description --}}
                            <div class="cp-form-group">
                                <label for="description">Description <span class="req">*</span></label>
                                <textarea name="description" id="description" rows="5"
                                    class="cp-textarea @error('description') is-invalid @enderror"
                                    placeholder="Write the main content of your post…">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="cp-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Long Description --}}
                            <div class="cp-form-group">
                                <label for="long_des">Long Description <span class="req">*</span></label>
                                <textarea name="long_des" id="long_des" rows="8"
                                    class="cp-textarea @error('long_des') is-invalid @enderror"
                                    placeholder="Provide full detail, background context and depth…">{{ old('long_des') }}</textarea>
                                @error('long_des')
                                    <div class="cp-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Cover Image --}}
                            <div class="cp-form-group">
                                <label for="post_image">
                                    Cover Image
                                    <span style="color:#6b7280;font-weight:500;text-transform:none;"> (optional · jpg / png)</span>
                                </label>
                                <div class="cp-upload-zone">
                                    <input type="file" name="post_image" id="post_image"
                                        accept=".jpg,.jpeg,.png"
                                        onchange="previewImage(event)">
                                    <div class="upload-icon">
                                        <i class="fa-solid fa-cloud-arrow-up"></i>
                                    </div>
                                    <p class="upload-text">Click or drag &amp; drop to upload</p>
                                    <p class="upload-hint">JPG / PNG &mdash; max 2 MB &mdash; 600&times;450 recommended</p>
                                </div>
                                <div id="imagePreview">
                                    <img id="previewImg" src="" alt="Cover preview">
                                </div>
                                @error('post_image')
                                    <div class="cp-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="cp-submit-btn">
                                <i class="fa-solid fa-paper-plane"></i> Submit Post for Review
                            </button>
                        </form>

                    </div>{{-- /.create-post-card --}}
                </div>{{-- /col-lg-8 --}}

                {{-- ── SIDEBAR ─────────────────────────────────── --}}
                <div class="col-lg-4">
                    <div class="info-sidebar">

                        <div class="info-card">
                            <h5><i class="fa-solid fa-lightbulb"></i> Writing Tips</h5>
                            <ul>
                                <li><i class="fa-solid fa-check li-icon"></i> Use a clear, attention-grabbing title.</li>
                                <li><i class="fa-solid fa-check li-icon"></i> Keep the short description under 30 words.</li>
                                <li><i class="fa-solid fa-check li-icon"></i> Use the long description for full detail &amp; depth.</li>
                                <li><i class="fa-solid fa-check li-icon"></i> Upload a high-quality 600&times;450 cover image.</li>
                                <li><i class="fa-solid fa-check li-icon"></i> Choose the most relevant category.</li>
                            </ul>
                        </div>

                        <div class="info-card">
                            <h5><i class="fa-solid fa-shield-halved"></i> Review Process</h5>
                            <ul>
                                <li><i class="fa-solid fa-clock li-icon"></i> Posts are reviewed within 1–2 business days.</li>
                                <li><i class="fa-solid fa-toggle-on li-icon"></i> Admin activates approved posts from the dashboard.</li>
                                <li><i class="fa-solid fa-xmark li-icon danger"></i> Inappropriate content will be rejected without notice.</li>
                            </ul>
                        </div>

                    </div>{{-- /.info-sidebar --}}
                </div>{{-- /col-lg-4 --}}

            </div>{{-- /row --}}
        </div>{{-- /container --}}
    </div>{{-- /.create-post-area --}}

</main>
@endsection

@push('frontendone_script')
    @include('frontend.pages.common.script')
    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('previewImg').src = e.target.result;
                document.getElementById('imagePreview').style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    </script>
@endpush
