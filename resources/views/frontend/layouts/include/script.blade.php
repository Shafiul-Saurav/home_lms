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
                    
                    // Track with Facebook Pixel
                    $.ajax({
                        url: "https://barggee.com/api/capi",
                        type: "GET",
                        data: {
                            'track': "track",
                            'event': "AddToCart",
                            'current_url': currentUrl,
                            'client_ip_address': "210.87.69.185",
                            'data': {
                                'content_name': productName,
                                'content_ids': productId,
                                'content_type': 'product',
                                'currency': 'BDT',
                                'contents': [{
                                    'id': productId,
                                    'title': productName,
                                    'item_price': price,
                                    'quantity': 1,
                                }],
                                'value': price,
                                'num_items': 1,
                                'event_url': currentUrl,
                            },
                            "eventID": "AddToCart.1.1756266966",
                            "event_id": "AddToCart.1756266966",
                        },
                        success: (function(data) {
                            fbq('track', 'AddToCart', data, {
                                eventID: data.event_id
                            });
                            console.log('AddToCart server event run successfully');
                        })
                    });
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
</script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

@stack('forntendscript')
