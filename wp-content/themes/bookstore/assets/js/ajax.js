$(document).ready(() => {
    // Logout
    $('#logout').click(e => {
        e.preventDefault();

        // Fire off the request to the /admin-ajax.php
        $.ajax({
            type: 'get',
            url: bookstore_ajax.ajaxurl, // This is the URL for the WordPress AJAX endpoint from Register_Script_Style class
            data: {
                action: 'logout',
                data: ''
            },
            success: () => {
                // Redirect to home page
                window.location.href = '/bookstore';
            },
            error: err => {
                console.log(err);
            }
        });
    });

    // Add to wish list
    $('#add-to-wishlist').click(function(e) {
        e.preventDefault();

        id = $(this).attr('data-tab');

        // Fire off the request to the /admin-ajax.php
        $.ajax({
            type: 'post',
            url: bookstore_ajax.ajaxurl, // This is the URL for the WordPress AJAX endpoint from Register_Script_Style class
            datatype: 'json',
            data: {
                action: 'add_to_wishlist',
                data: id
            },
            success: res => {
                console.log(res);
            },
            error: () => {
                
            }
        });
        
    })
});