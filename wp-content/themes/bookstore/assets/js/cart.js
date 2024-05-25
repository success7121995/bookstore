$(document).ready(() => {
    

    retrieveCartData();

    // Async retrieve cart data
    function retrieveCartData() {
        $.ajax({
            type: 'get',
            url: bookstore_cart.ajaxurl, // This is the URL for the WordPress AJAX endpoint from Register_Script_Style class
            datatype: 'json',
            data: {
                action: 'get_cart_data'
            },
            success: res => {
                console.log(res);
            }
        })
    }

    // Change QTY
    $('.qty-btn').click(function(e) {
        e.preventDefault();

        // Get the QTY value
        let qty = $(this).closest('.item-qty').find('input');
        let currentQty = qty.attr('value');

        // Identify whether minus button or plug button is being clicked
        const minusBtn = $(this).hasClass('minus');
        const plugBtn = $(this).hasClass('plug');

        // 
        if (minusBtn) currentQty--;
        else if (plugBtn) currentQty++;
        
        qty.attr('value', currentQty);
    });
});