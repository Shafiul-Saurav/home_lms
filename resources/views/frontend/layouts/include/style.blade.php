<link rel="stylesheet" href="{{ asset('assets/frontend/frontend/vendor/bootstrap/bootstrap.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/frontend/frontend/fonts/fontawesome/fontawesome.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/frontend/frontend/vendor/slickslider/slick.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/frontend/frontend/css/all.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/frontend/frontend/css/custom.css') }}" />

<style>
    :root {
        --primary: #684EFF;
        --primary-hover: #5A3CE0;
        --secondary: green;
        --secondary-hover: #9828c7;
        --text2: white;
        --text: black;
    }

    .btn-jump {
        animation: pulse 2000ms infinite;
        font-size: 1.5em;
    }

    @keyframes pulse {
        0% {
            transform: scale(.9);
        }
        50% {
            transform: scale(1.05);
        }
        100% {
            transform: scale(.8);
        }
    }

    /* Gradient button style */
    .btn-gradient {
        background: linear-gradient(135deg, #00a6ff, #7b2fff);
        border: none;
        color: white;
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .btn-gradient:hover {
        background: linear-gradient(135deg, #0095e6, #6a28e6);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        color: white;
    }

    .btn-gradient:active {
        transform: translateY(0);
    }
</style>

<style>
    /* First-level dropdown */
    .navbar-list li {
        position: relative;
    }

    .navbar-list .dropdown-position-list {
        display: none;
        position: absolute;
        top: 100%;
        /* below parent */
        left: 0;
        background: #fff;
        list-style: none;
        padding: 0;
        margin: 0;
        min-width: 200px;
        z-index: 999;
        border: 1px solid #ddd;
    }

    .navbar-list li:hover>.dropdown-position-list {
        display: block;
    }

    /* Second-level dropdown (grandchild) */
    .navbar-list .dropdown-position-list li {
        position: relative;
    }

    .navbar-list .dropdown-position-list li .dropdown-position-list {
        display: none;
        position: absolute;
        top: 0;
        /* align with parent */
        left: 100%;
        /* show to the right of parent */
        background: #fff;
        min-width: 200px;
        border: 1px solid #ddd;
    }

    .navbar-list .dropdown-position-list li:hover>.dropdown-position-list {
        display: block;
    }

    /* Optional styling */
    .navbar-list a {
        display: block;
        padding: 10px 15px;
        text-decoration: none;
    }

    .navbar-list a:hover {
        background: #f0f0f0;
    }
</style>

@stack('frontendstyle')
