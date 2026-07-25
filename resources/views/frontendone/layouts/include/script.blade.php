<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Owl Carousel -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<!-- AOS (Animate On Scroll) - load dynamically and initialize after load -->
<script>
    (function () {
        try {
            var s = document.createElement('script');
            s.src = 'https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js';
            s.async = true;
            s.onload = function () {
                try {
                    if (window.AOS) {
                        AOS.init({
                            duration: 800,
                            easing: 'ease-out-cubic',
                            once: true,
                            offset: 120
                        });
                        AOS.refresh();
                    }
                } catch (e) {
                    console && console.warn && console.warn('AOS init failed', e);
                }
            };
            document.head.appendChild(s);
        } catch (e) {
            console && console.warn && console.warn('Failed to load AOS', e);
        }
    })();
</script>

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
