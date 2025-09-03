<header class="header-part position-relative">
    <div class="container">
        <marquee class="d-flex" scrolldelay="6">Online Shop এ আপনাকে স্বাগতম। বাংলাদেশের বিশ্বস্ত অনলাইন শপ। সারা দেশে ক্যাশ অন ডেলিভারি (৪৮ থেকে ৭২ ঘণ্টার মধ্যে নিশ্চিত ডেলিভারি) সকাল ১০ টা থেকে রাত ১০ পর্যন্ত। হট লাইন: 01859084364</marquee>
        <div class="header-content">
            <div class="header-media-group">
                <button class="header-user">
                    <i class="fas fa-bars"></i>
                </button>
                <a href="{{ url('/') }}"><img loading="lazy" src="{{ asset($logo_fav->logo??'uploads/logos/default.png') }}" alt="{{ $logo_fav->web_name ?? 'Online Shopping In Bangladesh With Home Delivery' }}"></a>
                <button class="header-src">
                    <a href="{{ route('cart.index') }}" class="header-widget header-cart" title="Cartlist">
                        <i class="fas fa-shopping-basket"></i>
                        <sup class="cart-count">0</sup>
                    </a>
                </button>
            </div>
            <a class="header-logo" href="{{ url('/') }}"><img loading="lazy" src="{{ asset($logo_fav->logo??'uploads/logos/default.png') }}" alt="{{ $logo_fav->web_name ?? 'Online Shopping In Bangladesh With Home Delivery' }}"></a>
            <form class="header-form active" action="https://barggee.com/search">
                <input type="text" placeholder="Search anything..." name="q" id="search" /><button>
                    <i class="fas fa-search"></i>
                </button>
            </form>
            <div class="header-widget-group">
                <div wire:snapshot="{&quot;data&quot;:[],&quot;memo&quot;:{&quot;id&quot;:&quot;Iddx3ze2rX7NQtpdlG3c&quot;,&quot;name&quot;:&quot;cart-count&quot;,&quot;path&quot;:&quot;\/&quot;,&quot;method&quot;:&quot;GET&quot;,&quot;children&quot;:[],&quot;scripts&quot;:[],&quot;assets&quot;:[],&quot;errors&quot;:[],&quot;locale&quot;:&quot;en&quot;},&quot;checksum&quot;:&quot;51347b9c76deebb4e60edc552a12e5422db7f401d4c3fc3b21c50acbe602fd63&quot;}"
                    wire:effects="{&quot;listeners&quot;:[&quot;CartCount&quot;]}" wire:id="Iddx3ze2rX7NQtpdlG3c">
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
    </div>
</header>