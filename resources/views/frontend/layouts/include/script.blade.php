<script data-pagespeed-no-defer src="https://barggee.com/frontend/vendor/bootstrap/jquery-1.12.4.min.js"></script>
<script src="https://barggee.com/frontend/vendor/bootstrap/bootstrap.min.js"></script>
<script src="https://barggee.com/frontend/vendor/slickslider/slick.min.js"></script>
<script src="https://barggee.com/frontend/js/main.js"></script>
<script src="https://barggee.com/frontend/js/sweet-alert.min.js"></script>
<script src="https://barggee.com/vendor/livewire/livewire.min.js?id=df3a17f2" data-csrf="8KWLaGDS1qcFRMcDBevjYtQ493Vbq6jf4zLohILO" data-update-uri="/livewire/update" data-navigate-once="true"></script>

<script>
    function addToCart(productId, productName, price) {
        // Get current page URL
        var currentUrl = window.location.href;
        
        // Add to custom shopping cart
        $.ajax({
            url: "/cart/add",
            type: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                product_id: productId,
                quantity: 1
            },
            success: function(response) {
                if (response.success) {
                    // Update cart count in header
                    $('.cart-count').text(response.cartCount);
                    
                    // Show success message
                    Swal.fire({
                        title: 'Added to Cart!',
                        text: productName + ' has been added to your cart.',
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false,
                    });
                    
                    // Track with Facebook Pixel (removed external API call)
                    if (typeof fbq !== 'undefined') {
                        fbq('track', 'AddToCart', {
                            content_name: productName,
                            content_ids: productId,
                            content_type: 'product',
                            currency: 'BDT',
                            value: price
                        });
                    }
                    console.log('AddToCart event tracked locally');
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    title: 'Error!',
                    text: 'There was an error adding the product to your cart.',
                    icon: 'error',
                    timer: 1500,
                    showConfirmButton: false,
                });
            }
        });
    }

    function orderNow(productId, productName, price) {
        // Add to cart and redirect to checkout
        $.ajax({
            url: "/cart/add",
            type: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                product_id: productId,
                quantity: 1
            },
            success: function(response) {
                if (response.success) {
                    // Update cart count in header
                    $('.cart-count').text(response.cartCount);
                    
                    // Redirect to cart page
                    window.location.href = "/cart";
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    title: 'Error!',
                    text: 'There was an error adding the product to your cart.',
                    icon: 'error',
                    timer: 1500,
                    showConfirmButton: false,
                });
            }
        });
    }
    
    // Function to update cart count on page load
    function updateCartCount() {
        $.ajax({
            url: "/cart/add",
            type: "GET",
            success: function(response) {
                if (response.success && response.cartCount !== undefined) {
                    $('.cart-count').text(response.cartCount);
                }
            }
        });
    }
    
    // Update cart count when page loads
    $(document).ready(function() {
        updateCartCount();
    });
</script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

@stack('forntendscript')
