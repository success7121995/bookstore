$(document).ready(() => {
    const form = $('#cart');
    retrieveCartData();

    // Retrieve cart data
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
            },
            error: err => {
                console.log(err);
            }
        })
    }

    // Submit cart form
    form.on('keydown', e => {
        if (e.key === 'Enter') {
            e.preventDefault();
        }
    });
});