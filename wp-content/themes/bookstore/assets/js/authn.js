$(document).ready(() => {
    // Get the path to determine what page we are here
    const path = window.location.pathname.split('/')[2];

    // Submit form
    $('#authn').submit((function(e) {
        e.preventDefault();
        // Retrieve the signup form input
        
        const form = $(this);

        // Send related data 
        const data = path === 'signup'?
        {
            // Signup
            prefix: form.find('input[name="prefix"]:checked').val(),
            fname: form.find('input[name="fname"]').val(),
            lname: form.find('input[name="lname"]').val(),
            email: form.find('input[name="email"]').val(),
            password: form.find('input[name="password"]').val(),
            confirmPassword: form.find('input[name="confirm-password"').val()
        }:
        {
            // Login
            email: form.find('input[name="email"]').val(),
            password: form.find('input[name="password"]').val(),
        }

        // Detemine what action should take
        action = path === 'signup' ? 'signup_form_submit' : 'login_form_submit' // the function is defined in Custom_Form Class 
        
        // Fire off the request to the /admin-ajax.php
        $.ajax({
            type: 'post',
            url: bookstore_authn.ajaxurl, // // This is the URL for the WordPress AJAX endpoint from Register_Script_Style class 
            data: {
                action,
                data
            },
            success: res => {
                // $('#response').html(res.message);
                console.log(res);
            },
            error: err => {
                console.log(err);
            }
        })
    }));
}); 