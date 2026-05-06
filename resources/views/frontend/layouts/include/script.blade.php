<script src="{{ asset('assets/frontend') }}/js/jquery-3.7.1.min.js"></script>
<script src="{{ asset('assets/frontend') }}/js/modernizr.min.js"></script>
<script src="{{ asset('assets/frontend') }}/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/frontend') }}/js/imagesloaded.pkgd.min.js"></script>
<script src="{{ asset('assets/frontend') }}/js/jquery.magnific-popup.min.js"></script>
<script src="{{ asset('assets/frontend') }}/js/isotope.pkgd.min.js"></script>
<script src="{{ asset('assets/frontend') }}/js/jquery.appear.min.js"></script>
<script src="{{ asset('assets/frontend') }}/js/jquery.easing.min.js"></script>
<script src="{{ asset('assets/frontend') }}/js/owl.carousel.min.js"></script>
<script src="{{ asset('assets/frontend') }}/js/counter-up.js"></script>
<script src="{{ asset('assets/frontend') }}/js/jquery.nice-select.min.js"></script>
<script src="{{ asset('assets/frontend') }}/js/wow.min.js"></script>
<script src="{{ asset('assets/frontend') }}/js/main.js"></script>
<script src="{{ asset('assets/frontend') }}/js/apexcharts.min.js"></script>
<script src="{{ asset('assets/frontend') }}/js/apexchart-custom.js"></script>
<script src="{{ asset('ijaboCropTool/ijaboCropTool.min.js') }}"></script>

<script>
    $(function() {
        if (window.profileImageUploaderInitialized) {
            return;
        }

        const $profileImageInput = $('#profileImageInput');

        if (!$profileImageInput.length) {
            return;
        }

        window.profileImageUploaderInitialized = true;

        $profileImageInput.ijaboCropTool({
            preview: '#profileImagePreview',
            setRatio: 1,
            allowedExtensions: ['jpg', 'jpeg', 'png'],
            buttonsText: ['CROP', 'CANCEL'],
            buttonsColor: ['#0d6efd', '#dc3545', -15],
            processUrl: '{{ route('image.crop') }}',
            withCSRF: ['_token', $('meta[name="csrf-token"]').attr('content')],
            fileName: 'profile_image',
            onSuccess: function(message, element, status) {
                const imagePath = $('#profileImagePreview').attr('src');
                $('#headerProfileImage').attr('src', imagePath);
                $(document).trigger('profile-image-updated', [imagePath]);
                toastr.success(message);
            },
            onError: function(message, element, status) {
                toastr.error(message);
            }
        });
    });
</script>

@stack('frontend_script')
