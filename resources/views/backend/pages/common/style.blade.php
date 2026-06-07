<!--Toaster Popup message CSS -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<style>
    // Custom styles for select2 options with images
    .select2-option-with-image img {
        object-fit: cover;
        border: 2px solid #ddd;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        display: flex;
        align-items: center;
    }

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
</style>
