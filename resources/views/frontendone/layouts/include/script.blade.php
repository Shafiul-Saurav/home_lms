<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Owl Carousel -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<!-- custom js -->
<script src="{{ asset('assets/frontendone') }}/js/script.js"></script>
<script src="{{ asset('ijaboCropTool/ijaboCropTool.min.js') }}"></script>

<script>
    $(function() {
        $(document).on('profile-image-updated', function(event, imagePath) {
            $('#headerProfileImage').attr('src', imagePath);
        });
    });
</script>
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

@stack('frontendone_script')
