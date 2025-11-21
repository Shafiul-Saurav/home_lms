$(document).ready(function(){
    $("#customerReviews").owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        dots: false,
        navText: [
            "<i class='fa fa-chevron-left'></i>",
            "<i class='fa fa-chevron-right'></i>"
        ],
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 3
            }
        }
    });

    // Quantity buttons functionality
    $('#increaseQty').click(function() {
        var currentVal = parseInt($('#quantity').val());
        if(isNaN(currentVal)) currentVal = 1;
        $('#quantity').val(currentVal + 1);
        updateTotal();
    });

    $('#decreaseQty').click(function() {
        var currentVal = parseInt($('#quantity').val());
        if(isNaN(currentVal)) currentVal = 1;
        if(currentVal > 1) {
            $('#quantity').val(currentVal - 1);
            updateTotal();
        }
    });

    // Update total price when quantity changes
    $('#quantity').on('input change', function() {
        var val = parseInt($(this).val());
        if(isNaN(val) || val < 1) {
            $(this).val(1);
            updateTotal();
        } else {
            updateTotal();
        }
    });

    function updateTotal() {
        var pricePerUnit = 890; // Fixed price per unit
        var quantity = parseInt($('#quantity').val());
        var subtotal = pricePerUnit * quantity;
        var shipping = 0; // Free shipping
        var total = subtotal + shipping;

        // Update the values in the UI
        $('.col-6.text-end').eq(1).find('p').eq(0).html('<strong>' + subtotal + ' টাকা</strong>'); // Subtotal
        $('.col-6.text-end').eq(2).find('p').eq(0).html('<strong>' + shipping + ' টাকা</strong>'); // Shipping
        $('.col-6.text-end').eq(3).find('p').eq(0).html('<strong>' + total + ' টাকা</strong>'); // Total
    }

    // Initialize total on page load
    updateTotal();
});