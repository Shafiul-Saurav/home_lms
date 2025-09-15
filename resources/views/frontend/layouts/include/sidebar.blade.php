<aside class="nav-sidebar">
    <div class="nav-header">
        @php
            $logo_fav = \App\Models\LogoFavicon::first();
        @endphp
        <a href="{{ route('home') }}"><img loading="lazy" src="{{ asset($logo_fav->logo ?? 'uploads/logos/default.png') }}" alt="{{ $logo_fav->web_name ?? 'Online Shopping In Bangladesh With Home Delivery' }}"></a>
        <button class="nav-close"> <i class="fas fa-times"></i></button>
    </div>
    <div class="nav-content">
        <ul class="nav-list">
            @php
                $categories = \App\Models\Category::where('is_active', 1)->get();
            @endphp
            @foreach($categories as $category)
            <li>
                <a class="navbar-link" href="{{ route('category.products', $category->id) }}">
                    {{ $category->name }}
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</aside>
