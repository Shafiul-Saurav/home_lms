<script data-pagespeed-no-defer src="https://barggee.com/frontend/vendor/bootstrap/jquery-1.12.4.min.js"></script>
<script src="https://barggee.com/frontend/vendor/bootstrap/bootstrap.min.js"></script>
<script src="https://barggee.com/frontend/vendor/slickslider/slick.min.js"></script>
<script src="https://barggee.com/frontend/js/main.js"></script>
<script src="https://barggee.com/frontend/js/sweet-alert.min.js"></script>
<script src="https://barggee.com/vendor/livewire/livewire.min.js?id=df3a17f2" data-csrf="8KWLaGDS1qcFRMcDBevjYtQ493Vbq6jf4zLohILO" data-update-uri="/livewire/update" data-navigate-once="true"></script>

<script>
    function addToCart(id, title, price) {
        // Get current page URL
        var currentUrl = window.location.href;
        
        $.ajax({
            url: "https://barggee.com/api/capi",
            type: "GET",
            data: {
                'track': "track",
                'event': "AddToCart",
                'current_url': currentUrl,
                'client_ip_address': "210.87.69.185",
                'data': {
                    'content_name': title,
                    'content_ids': id,
                    'content_type': 'product',
                    'currency': 'BDT',
                    'contents': [{
                        'id': id,
                        'title': title,
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

    function orderNow(id, title, price) {
        // Get current page URL
        var currentUrl = window.location.href;
        
        $.ajax({
            url: "https://barggee.com/api/capi",
            type: "GET",
            data: {
                'track': "track",
                'event': "AddToCart",
                'current_url': currentUrl,
                'client_ip_address': "210.87.69.185",
                'data': {
                    'content_name': title,
                    'content_ids': id,
                    'content_type': 'product',
                    'currency': 'BDT',
                    'contents': [{
                        'id': id,
                        'title': title,
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
</script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

@stack('forntendscript')
