$(document).ready(() => {
    // Submit form
    $('#authn').submit((function(e) {
        e.preventDefault();
        
        const form = $(this);
        const formData = {
            prefix: form.find('input[name="prefix"]:checked').val()
        };
        
        // Fire off the request to the /admin-ajax.php
        $.ajax({
            type: 'post',
            url: bookstore_authn.ajax_url, // // This is the URL for the WordPress AJAX endpoint from Register_Script_Style class 
            data: {
                action: 'signup_form_submit',
                data: formData,
            },
            success: res => {
                console.log('res: ' + res);
            },
            error: err => {
                console.log('err: ' + err);
            }
        })
    }));
}); 