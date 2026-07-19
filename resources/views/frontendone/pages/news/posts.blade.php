@extends('frontendone.layouts.master')

@section('title', 'Posts')

@push('frontendone_style')
    @include('frontend.pages.common.style')
    <style>
        /* ─── Flash alert ─────────────────────────────── */
        .flash-alert {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-radius: 14px;
            padding: 14px 22px;
            color: #166534;
            font-weight: 600;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 24px;
        }

        /* ─── Pagination ──────────────────────────────── */
        .cp-pagination .pagination {
            gap: 6px;
            flex-wrap: wrap;
            justify-content: center;
        }
        .cp-pagination .page-item .page-link {
            border-radius: 10px !important;
            border: 1.5px solid #e5e7eb;
            color: #374151;
            font-weight: 700;
            font-size: 14px;
            padding: 8px 16px;
            transition: all 0.2s;
            background: #fff;
        }
        .cp-pagination .page-item .page-link:hover {
            background: #111827;
            border-color: #111827;
            color: #fff;
        }
        .cp-pagination .page-item.active .page-link {
            background: #76bd10;
            border-color: #76bd10;
            color: #fff;
            box-shadow: 0 4px 12px rgba(118,189,16,0.3);
        }
        .cp-pagination .page-item.disabled .page-link {
            opacity: 0.4;
            cursor: not-allowed;
        }

        /* ─── Modal overlay ───────────────────────────── */
        .cp-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.55);
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
            z-index: 9998;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
            animation: fadeOverlay 0.25s ease;
        }
        .cp-overlay.active { display: flex; }
        @keyframes fadeOverlay { from { opacity:0; } to { opacity:1; } }

        /* ─── Modal box ───────────────────────────────── */
        .cp-modal {
            background: #fff;
            border-radius: 24px;
            width: 100%;
            max-width: 760px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 40px 100px rgba(0,0,0,0.22);
            animation: slideUp 0.3s cubic-bezier(0.34,1.56,0.64,1);
            position: relative;
            scrollbar-width: thin;
        }
        @keyframes slideUp {
            from { opacity:0; transform:translateY(40px) scale(0.97); }
            to   { opacity:1; transform:translateY(0) scale(1); }
        }

        /* ─── Modal header ────────────────────────────── */
        .cp-modal-header {
            padding: 28px 36px 20px;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
            position: sticky;
            top: 0;
            background: #fff;
            z-index: 10;
            border-radius: 24px 24px 0 0;
        }
        .cp-modal-header .badge-tag {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(118,189,16,0.12);
            color: #4a8c06;
            padding: 5px 14px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 8px;
        }
        .cp-modal-header h4 {
            font-size: 22px;
            font-weight: 900;
            color: #111827;
            margin: 0 0 4px;
        }
        .cp-modal-header p {
            font-size: 13px;
            color: #6b7280;
            margin: 0;
            font-weight: 500;
        }
        .cp-close {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            border: 1.5px solid #e5e7eb;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            color: #6b7280;
            cursor: pointer;
            flex-shrink: 0;
            transition: background 0.2s, color 0.2s;
        }
        .cp-close:hover { background: #111827; color: #fff; border-color: #111827; }

        /* ─── Modal body ──────────────────────────────── */
        .cp-modal-body { padding: 28px 36px 36px; }

        /* ─── Approval notice ─────────────────────────── */
        .notice-box {
            border-radius: 12px;
            padding: 12px 16px;
            margin-bottom: 22px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            font-size: 13px;
            font-weight: 600;
        }
        .notice-box.warning { background:#fffbeb; border:1px solid #fde68a; color:#92400e; }
        .notice-box.error   { background:#fef2f2; border:1px solid #fecaca; color:#991b1b; }
        .notice-box i { flex-shrink:0; margin-top:2px; }

        /* ─── Form groups ─────────────────────────────── */
        .cp-form-group { margin-bottom: 20px; }
        .cp-form-group label {
            display: block;
            font-size: 11px;
            font-weight: 800;
            color: #374151;
            margin-bottom: 7px;
            text-transform: uppercase;
            letter-spacing: 0.6px;
        }
        .cp-form-group label .req { color:#ef4444; margin-left:2px; }

        .cp-input {
            width: 100%;
            height: 50px;
            border: 1.5px solid #e5e7eb;
            border-radius: 12px;
            padding: 0 16px;
            font-size: 14px;
            font-weight: 600;
            color: #111827;
            background: #fff;
            outline: none;
            transition: border-color 0.25s, box-shadow 0.25s;
        }
        .cp-input:focus { border-color:#76bd10; box-shadow:0 0 0 4px rgba(118,189,16,0.12); }
        .cp-input::placeholder { color:#9ca3af; }
        .cp-input.is-invalid { border-color:#ef4444 !important; }

        .cp-select {
            appearance: none; -webkit-appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%236b7280'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            background-size: 16px;
            padding-right: 40px;
        }

        .cp-textarea {
            width: 100%;
            border: 1.5px solid #e5e7eb;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 14px;
            font-weight: 600;
            color: #111827;
            background: #fff;
            resize: vertical;
            min-height: 90px;
            outline: none;
            transition: border-color 0.25s, box-shadow 0.25s;
        }
        .cp-textarea:focus { border-color:#76bd10; box-shadow:0 0 0 4px rgba(118,189,16,0.12); }
        .cp-textarea::placeholder { color:#9ca3af; }
        .cp-textarea.is-invalid { border-color:#ef4444 !important; }

        /* ─── Two-column grid for short fields ────────── */
        .cp-row { display:grid; grid-template-columns:1fr 1fr; gap:16px; }
        @media(max-width:576px){ .cp-row { grid-template-columns:1fr; } }

        /* ─── Image upload zone ───────────────────────── */
        .cp-upload-zone {
            border: 2px dashed #d1d5db;
            border-radius: 12px;
            padding: 28px 16px;
            text-align: center;
            cursor: pointer;
            transition: border-color 0.25s, background 0.25s;
            position: relative;
            background: #fafafa;
        }
        .cp-upload-zone:hover { border-color:#76bd10; background:rgba(118,189,16,0.04); }
        .cp-upload-zone input[type="file"] {
            position: absolute; inset:0; opacity:0; cursor:pointer; width:100%; height:100%;
        }
        .cp-upload-zone .upload-icon {
            width:44px; height:44px;
            background: rgba(118,189,16,0.1);
            border-radius: 12px;
            display: inline-flex; align-items:center; justify-content:center;
            color: #76bd10; font-size:20px;
            margin: 0 auto 10px;
        }
        .cp-upload-zone .upload-text { font-size:13px; font-weight:700; color:#374151; margin-bottom:3px; }
        .cp-upload-zone .upload-hint { font-size:12px; color:#9ca3af; margin:0; }
        #cpImagePreview {
            display:none; margin-top:12px;
            border-radius:10px; overflow:hidden;
        }
        #cpImagePreview img { width:100%; height:180px; object-fit:cover; }

        .cp-error {
            font-size:12px; color:#ef4444; font-weight:600;
            margin-top:5px; display:flex; align-items:center; gap:5px;
        }

        /* ─── Submit button ───────────────────────────── */
        .cp-submit-btn {
            width: 100%; height: 52px;
            background: #111827; color: #fff;
            border: none; border-radius: 50px;
            font-weight: 800; font-size: 14px;
            text-transform: uppercase; letter-spacing: 0.5px;
            display: inline-flex; align-items:center; justify-content:center; gap:8px;
            transition: background 0.3s, transform 0.2s;
            cursor: pointer; margin-top: 6px;
        }
        .cp-submit-btn:hover { background:#76bd10; transform:translateY(-2px); }

        @media(max-width:575px){
            .cp-modal-header, .cp-modal-body { padding-left:20px; padding-right:20px; }
        }
    </style>
@endpush

@section('frontendone_content')
    <main class="main">
        <!-- breadcrumb -->
        <x-frontend.pages.common.breadcrumb
            :title="'Posts'"
            :breadcrumb="[
                ['name' => 'Home', 'url' => route('home')],
                ['name' => 'Posts', 'url' => '#']
            ]"
        />
        <!-- breadcrumb end -->

        <div class="blog-area py-5">
            <div class="container">

                @if(session('message'))
                <div class="flash-alert">
                    <i class="fa-solid fa-circle-check"></i>
                    {{ session('message') }}
                </div>
                @endif

                {{-- ── Section heading + Create button ── --}}
                <div class="row mb-4">
                    <div class="col-lg-6 mx-auto text-center">
                        <div class="site-heading wow fadeInDown" data-wow-delay=".25s">
                            <span class="site-title-tagline"><i class="far fa-lightbulb-on"></i> Our Blog</span>
                            <h2 class="site-title">Our Latest News <span class="text-gradient">And Blog</span></h2>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4 mb-5">
                    @auth
                        <button type="button" class="nav-action mt-5" style="border: none;" onclick="openCpModal()">Create New Post</button>
                    @else
                        <a href="{{ route('login') }}" class="nav-action mt-5">Login to Create New Post</a>
                    @endauth
                </div>

                {{-- ── Posts grid ── --}}
                <div class="row g-4" id="newsGrid">
                    @foreach($posts as $post)
                        @php
                            $newsType = strtolower($post->postCategory->title ?? 'news');
                            if (!in_array($newsType, ['news', 'blog'])) { $newsType = 'news'; }
                        @endphp
                        <div class="col-lg-4 col-md-6" data-news-type="{{ $newsType }}">
                            <div class="news-card">
                                <div class="news-img">
                                    <img src="{{ $post->post_image ? asset('uploads/posts/' . $post->post_image) : 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=800&q=80' }}"
                                        alt="{{ $post->title }}">
                                    <span class="news-badge">{{ $post->postCategory->title ?? 'News' }}</span>
                                </div>
                                <div class="news-content">
                                    <div class="news-meta">
                                        <span><i class="fa-regular fa-calendar"></i> {{ $post->created_at?->format('d M, Y') }}</span>
                                        <span><i class="fa-regular fa-user"></i> {{ $post->user->name ?? 'Admin' }}</span>
                                    </div>
                                    <h3>{{ $post->title }}</h3>
                                    <p>{{ \Illuminate\Support\Str::words(strip_tags($post->short_des ?? $post->description), 15, '...') }}</p>
                                    <a href="{{ route('news.details', $post->id) }}" class="read-more">
                                        Read More <i class="fa-solid fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- ── Pagination ── --}}
                @if($posts->hasPages())
                <div class="d-flex justify-content-center mt-5">
                    <nav class="cp-pagination">
                        {{ $posts->onEachSide(1)->links('pagination::bootstrap-5') }}
                    </nav>
                </div>
                @endif

            </div>
        </div>

        {{-- ════════════════════════════════════════════
             CREATE POST MODAL (auth users only)
        ═══════════════════════════════════════════════ --}}
        @auth
        <div class="cp-overlay" id="cpOverlay" onclick="closeCpModalOutside(event)">
            <div class="cp-modal" id="cpModal">

                {{-- Header --}}
                <div class="cp-modal-header">
                    <div>
                        <div class="badge-tag"><i class="fa-solid fa-pen-to-square"></i> Write an Article</div>
                        <h4>Create New Post</h4>
                        <p>Share your thoughts or insights with the community.</p>
                    </div>
                    <button class="cp-close" onclick="closeCpModal()" title="Close">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                {{-- Body --}}
                <div class="cp-modal-body">

                    {{-- Approval notice --}}
                    <div class="notice-box warning">
                        <i class="fa-solid fa-triangle-exclamation" style="color:#d97706;"></i>
                        <span>Your post will be <strong>reviewed by admin</strong> before it goes live. This usually takes 1–2 business days.</span>
                    </div>

                    {{-- Validation errors (shown after page reload on fail) --}}
                    @if ($errors->any())
                    <div class="notice-box error">
                        <i class="fa-solid fa-circle-xmark" style="color:#dc2626;"></i>
                        <div>
                            <strong>Please fix the following errors:</strong>
                            <ul style="margin:5px 0 0;padding-left:16px;">
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
                            <label for="cp_category_id">Category <span class="req">*</span></label>
                            <select name="category_id" id="cp_category_id"
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
                            <label for="cp_title">Post Title <span class="req">*</span></label>
                            <input type="text" name="title" id="cp_title"
                                class="cp-input @error('title') is-invalid @enderror"
                                placeholder="Enter an engaging title…"
                                value="{{ old('title') }}" maxlength="255">
                            @error('title')
                                <div class="cp-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Short Description --}}
                        <div class="cp-form-group">
                            <label for="cp_short_des">Short Description <span class="req">*</span></label>
                            <textarea name="short_des" id="cp_short_des" rows="2"
                                class="cp-textarea @error('short_des') is-invalid @enderror"
                                placeholder="1–2 sentence summary shown on the blog card…">{{ old('short_des') }}</textarea>
                            @error('short_des')
                                <div class="cp-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Description + Long Description side by side on desktop --}}
                        <div class="cp-row">
                            <div class="cp-form-group">
                                <label for="cp_description">Description <span class="req">*</span></label>
                                <textarea name="description" id="cp_description" rows="4"
                                    class="cp-textarea @error('description') is-invalid @enderror"
                                    placeholder="Main post content…">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="cp-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                                @enderror
                            </div>
                            <div class="cp-form-group">
                                <label for="cp_long_des">Long Description <span class="req">*</span></label>
                                <textarea name="long_des" id="cp_long_des" rows="4"
                                    class="cp-textarea @error('long_des') is-invalid @enderror"
                                    placeholder="Full detail, context and depth…">{{ old('long_des') }}</textarea>
                                @error('long_des')
                                    <div class="cp-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Cover Image --}}
                        <div class="cp-form-group">
                            <label for="cp_post_image">
                                Cover Image
                                <span style="color:#6b7280;font-weight:500;text-transform:none;"> (optional · jpg/png, max 2 MB)</span>
                            </label>
                            <div class="cp-upload-zone">
                                <input type="file" name="post_image" id="cp_post_image"
                                    accept=".jpg,.jpeg,.png"
                                    onchange="cpPreviewImage(event)">
                                <div class="upload-icon"><i class="fa-solid fa-cloud-arrow-up"></i></div>
                                <p class="upload-text">Click or drag &amp; drop</p>
                                <p class="upload-hint">JPG / PNG &mdash; 600&times;450 recommended</p>
                            </div>
                            <div id="cpImagePreview">
                                <img id="cpPreviewImg" src="" alt="Preview">
                            </div>
                            @error('post_image')
                                <div class="cp-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="cp-submit-btn">
                            <i class="fa-solid fa-paper-plane"></i> Submit Post for Review
                        </button>
                    </form>
                </div>{{-- /.cp-modal-body --}}
            </div>{{-- /.cp-modal --}}
        </div>{{-- /.cp-overlay --}}
        @endauth

    </main>
@endsection

@push('frontendone_script')
    @include('frontend.pages.common.script')
    <script>
        // ── Modal open / close ────────────────────────
        function openCpModal() {
            document.getElementById('cpOverlay').classList.add('active');
            document.body.style.overflow = 'hidden';
        }
        function closeCpModal() {
            document.getElementById('cpOverlay').classList.remove('active');
            document.body.style.overflow = '';
        }
        function closeCpModalOutside(e) {
            if (e.target === document.getElementById('cpOverlay')) closeCpModal();
        }
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeCpModal();
        });

        // ── Image preview ─────────────────────────────
        function cpPreviewImage(event) {
            const file = event.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('cpPreviewImg').src = e.target.result;
                document.getElementById('cpImagePreview').style.display = 'block';
            };
            reader.readAsDataURL(file);
        }

        // ── Auto-open modal if there are validation errors ──
        @if ($errors->any())
            document.addEventListener('DOMContentLoaded', function() { openCpModal(); });
        @endif
    </script>
@endpush

