<header class="header-part position-relative">
    <style>
        /* Beautiful Header Notification Bar */
        .header-notification-bar {
            background: linear-gradient(90deg, #684EFF 0%, #8E2EF5 100%);
            color: white;
            padding: 8px 0;
            overflow: hidden;
            position: relative;
        }

        .header-notification-bar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(90deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.1) 100%);
            animation: shine 3s infinite;
        }

        @keyframes shine {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        .notification-content {
            display: flex;
            align-items: center;
            max-width: 100%;
            margin: 0 auto;
            padding: 0 15px;
        }

        .notification-icon {
            font-size: 18px;
            margin-right: 15px;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }

        .notification-text {
            display: flex;
            width: 100%;
            overflow: hidden;
            position: relative;
        }

        .notification-marquee {
            display: flex;
            width: max-content;
            animation: marquee 40s linear infinite;
        }

        .notification-text:hover .notification-marquee {
            animation-play-state: paused;
        }



        .notification-item {
            white-space: nowrap;
            padding: 0 20px;
        }

        @keyframes marquee {
            0% { transform: translateX(0); }
            90% { transform: translateX(-50%); }
            100% { transform: translateX(-50%); }
        }

        /* Reduced Header Height Styles - Subtle Reduction */
        .header-content {
            padding: 15px 0 !important; /* Reduced from 18px to 15px (17% reduction) */
        }

        .header-logo img {
            max-height: 100px !important; /* Slightly reduced logo height */
        }

        .header-form input {
            height: 40px !important; /* Slightly reduced form input height */
        }

        .header-form button {
            height: 40px !important; /* Slightly reduced form button height */
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .notification-content {
                padding: 0 10px;
            }

            .notification-icon {
                font-size: 16px;
                margin-right: 10px;
            }

            .notification-item {
                font-size: 14px;
                padding: 0 15px;
            }

            .header-content {
                padding: 8px 0 !important; /* Reduced from 10px to 8px (20% reduction) */
            }

            .header-logo img {
                max-height: 45px !important;
            }

            .header-form input {
                height: 35px !important;
            }

            .header-form button {
                height: 35px !important;
            }
        }

        @media (max-width: 576px) {
            .header-notification-bar {
                padding: 6px 0;
            }

            .notification-content {
                padding: 0 5px;
            }

            .notification-icon {
                font-size: 14px;
                margin-right: 8px;
            }

            .notification-item {
                font-size: 12px;
                padding: 0 10px;
            }

            .header-content {
                padding: 8px 0 !important; /* Reduced from 10px to 8px (20% reduction) */
            }

            .header-logo img {
                max-height: 40px !important;
            }

            .header-form {
                max-width: 170px !important;
            }

            .header-form input {
                height: 32px !important;
                font-size: 13px !important;
            }

            .header-form button {
                height: 32px !important;
                width: 35px !important;
            }
        }
    </style>

    <div class="container-fluid mx-0 px-0">
        <!-- Beautiful Marquee/Notification Bar -->
        <div class="header-notification-bar">
            <div class="notification-content">
                <i class="fas fa-bell notification-icon"></i>
                <div class="notification-text">
                    <div class="notification-marquee">
                        <span class="notification-item">🎉 Online Shop এ আপনাকে স্বাগতম! বাংলাদেশের বিশ্বস্ত অনলাইন শপ।</span>
                        <span class="notification-item">🚚 সারা দেশে ক্যাশ অন ডেলিভারি (৪৮ থেকে ৭২ ঘণ্টার মধ্যে নিশ্চিত ডেলিভারি)</span>
                        <span class="notification-item">⏰ সকাল ১০ টা থেকে রাত ১০ পর্যন্ত খোলা</span>
                        <span class="notification-item">📞 হট লাইন: 01859084364</span>
                        <!-- Duplicate items for seamless looping -->
                        <span class="notification-item">🎉 Online Shop এ আপনাকে স্বাগতম! বাংলাদেশের বিশ্বস্ত অনলাইন শপ।</span>
                        <span class="notification-item">🚚 সারা দেশে ক্যাশ অন ডেলিভারি (৪৮ থেকে ৭২ ঘণ্টার মধ্যে নিশ্চিত ডেলিভারি)</span>
                        <span class="notification-item">⏰ সকাল ১০ টা থেকে রাত ১০ পর্যন্ত খোলা</span>
                        <span class="notification-item">📞 হট লাইন: 01859084364</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="header-content">
            <div class="header-media-group">
                <button class="header-user">
                    <i class="fas fa-bars"></i>
                </button>
                @php
                    $logo_fav = \App\Models\LogoFavicon::first();
                @endphp
                <a href="{{ route('home') }}"><img loading="lazy" src="{{ asset($logo_fav->logo ?? 'uploads/logos/default.png') }}" alt="{{ $logo_fav->web_name ?? 'Online Shopping In Bangladesh With Home Delivery' }}"></a>
                <button class="header-src">
                    <a href="{{ route('cart.index') }}" class="header-widget header-cart" title="Cartlist">
                        <i class="fas fa-shopping-basket"></i>
                        <sup class="cart-count">0</sup>
                    </a>
                </button>
            </div>
            <a class="header-logo" href="{{ route('home') }}"><img loading="lazy" src="{{ asset($logo_fav->logo ?? 'uploads/logos/default.png') }}" alt="{{ $logo_fav->web_name ?? 'Online Shopping In Bangladesh With Home Delivery' }}"></a>
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
