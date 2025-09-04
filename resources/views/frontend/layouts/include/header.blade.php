<header class="header-part position-relative">
    <div class="container">
        <marquee class="d-flex" scrolldelay="6">Online Shop এ আপনাকে স্বাগতম। বাংলাদেশের বিশ্বস্ত অনলাইন শপ। সারা দেশে ক্যাশ অন ডেলিভারি (৪৮ থেকে ৭২ ঘণ্টার মধ্যে নিশ্চিত ডেলিভারি) সকাল ১০ টা থেকে রাত ১০ পর্যন্ত। হট লাইন: 01859084364</marquee>
        <div class="header-content">
            <div class="header-media-group">
                <button class="header-user">
                    <i class="fas fa-bars"></i>
                </button>
                <a href="{{ route('home') }}"><img loading="lazy" src="{{ asset($logo_fav->logo??'uploads/logos/default.png') }}" alt="{{ $logo_fav->web_name ?? 'Online Shopping In Bangladesh With Home Delivery' }}"></a>
                <button class="header-src">
                    <a href="{{ route('cart.index') }}" class="header-widget header-cart" title="Cartlist">
                        <i class="fas fa-shopping-basket"></i>
                        <sup class="cart-count">0</sup>
                    </a>
                </button>
            </div>
            <a class="header-logo" href="{{ route('home') }}"><img loading="lazy" src="{{ asset($logo_fav->logo??'uploads/logos/default.png') }}" alt="{{ $logo_fav->web_name ?? 'Online Shopping In Bangladesh With Home Delivery' }}"></a>
            <form class="header-form active" action="">
                <input type="text" placeholder="Search anything..." name="q" id="search" /><button>
                    <i class="fas fa-search"></i>
                </button>
            </form>
            <div class="header-widget-group">
                <a href="{{ route('cart.index') }}" class="header-widget header-cart" title="Cartlist">
                    <i class="fas fa-shopping-basket"></i>
                    <sup class="cart-count">0</sup>
                    <span>
                        total price
                        <small>0 TK</small>
                    </span>
                </a>
            </div>
        </div>
    </div>
</header>
