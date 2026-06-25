<!--Toaster Popup message CSS -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<style>
    /* Custom SweetAlert2 styles */
    .swal2-popup {
        background: rgba(0, 0, 0, 0.8) !important;
        /* Semi-transparent background */
        color: #ffffff;
        /* Light text color */
    }

    .swal2-title,
    .swal2-content {
        color: #ffffff !important;
        /* Light text color for title and content */
    }

    /* Optional: Customize button colors to match the light theme */
    .swal2-confirm {
        background-color: #3085d6 !important;
        border-color: #3085d6 !important;
    }

    .swal2-cancel {
        background-color: #d33 !important;
        border-color: #d33 !important;
    }

    /* Scoped styling for modernized breadcrumbs */
    .site-breadcrumb {
        padding: 120px 0 60px 0;
        text-align: center;
        background-size: cover !important;
        background-position: center !important;
        position: relative;
    }

    .site-breadcrumb::before {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(13, 15, 18, 0.75);
        /* Dark matching deep black */
    }

    .site-breadcrumb .container {
        position: relative;
        z-index: 2;
    }

    .breadcrumb-title {
        color: #fff;
        font-size: 32px;
        font-weight: 900;
        margin-bottom: 12px;
    }

    .breadcrumb-menu {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        justify-content: center;
        gap: 10px;
    }

    .breadcrumb-menu li,
    .breadcrumb-menu li a {
        color: #aeb5bf;
        font-size: 14px;
        font-weight: 700;
        text-decoration: none;
        transition: 0.3s;
    }

    .breadcrumb-menu li a:hover {
        color: var(--primary);
    }

    .breadcrumb-menu li.active {
        color: var(--primary);
    }

    .breadcrumb-menu li:not(:last-child)::after {
        content: '/';
        margin-left: 10px;
        color: #aeb5bf;
    }
</style>
