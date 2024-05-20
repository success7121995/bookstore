$(document).ready(() => {
    // Get the path to recognize the current page
    const path = window.location.pathname.split('/')[2];

    // Submit form
    $('#authn').submit((function(e) {
        e.preventDefault();
        const form = $(this);

        // Prepare the data to be sent based on the current page
        let data;
        let action; 

        // Send related data based on the current page
        if (path === 'signup') {
            action = 'signup_form_submit';  // The function is defined in Custom_Form Class 
            data = {
                prefix: form.find('input[name="prefix"]:checked').val(),
                fname: form.find('input[name="fname"]').val(),
                lname: form.find('input[name="lname"]').val(),
                email: form.find('input[name="email"]').val(),
                password: form.find('input[name="password"]').val(),
                confirmPassword: form.find('input[name="confirm-password"').val(),
                terms: form.find('input[name="terms"]:checked').val()
            }
        } else if (path === 'login') {
            action = 'login_form_submit';  // The function is defined in Custom_Form Class 
            data = {
                email: form.find('input[name="email"]').val(),
                password: form.find('input[name="password"]').val(),
                terms: form.find('input[name="terms"]:checked').val()
            }
        }
        
        // Fire off the request to the /admin-ajax.php
        $.ajax({
            type: 'post',
            url: bookstore_authn.ajaxurl, // This is the URL for the WordPress AJAX endpoint from Register_Script_Style class 
            datatype: 'json',
            data: {
                action,
                data
            },
            success: res => {
                if (path === 'signup') {
                    // Temporary redirect to home page
                    // Redirect to the previous page (if preivous page is login page, redirect to home page)
                    window.location.href = '/bookstore';
                } else if (path === 'login') {
                    console.log(res);
                    console.log('hihs');
                }
            },
            error: err => {
                if (!err.responseJSON) {
                    console.log('Error: ' + err);
                } else {
                    // Reset error fields
                    $('.error').html('');
                    $('#authn input').css({
                        'padding': '3px 8px',
                        'padding-top': '10px',
                        'border': 'none',
                        'border-bottom': '1px solid var(--var-divider-color)',
                        'border-radius': '0'
                    });
                    $('.eye').css({
                        'top': '25px'
                    });

                    // Display JSON responses in html format
                    err.responseJSON.data.forEach(res => {
                        // Retrieve the class name by spliting up the string to slices
                        const className = res.split('"')[1].split(' ')[1];
                        
                        const errorField = $(`.error.${className}`);
                        const inputField = $(`[name="${className}"]`); 
                        const passwordShowToggler = inputField.next();
                        const errorMessage = $(`.error-message.${className}`);

                        errorField.html('');

                        // Show the error message in the particular field
                        errorField.html(res);

                        if (inputField.has(errorMessage)) {
                            inputField.css({
                                'padding': '10px 15px',
                                'border': '2px solid #C40000',
                                'border-radius': '5px',
                            });

                            if (passwordShowToggler.hasClass('eye')) {
                                passwordShowToggler.css({
                                    'top': '35px'
                                });
                            }
                        }
                    });
                }
            }
        });
    }));
}); 