<?php
/**
 * Custom Form
 * 
 * @package Bookstore
 * 
 * 
 */

class Custom_Form {
    // Prevent from multiple instantiations
    use Singleton;

    // The __construct function is set to private since it is not allowed to instantiate in in public.
    private function __construct() {
        // Actions
        // Signup
        add_action('wp_ajax_signup_form_submit', [$this, 'signup_form_submit']);
        add_action('wp_ajax_nopriv_signup_form_submit', [$this, 'signup_form_submit']);
    }

    // Submit signup form
    public function signup_form_submit() {
        // Connect to database
        global $wpdb;

        // Get form data from AJAX
        $data = array(
            'prefix' => sanitize_text_field($_POST['data']['prefix']),
            'fname' => sanitize_text_field($_POST['data']['fname']),
            'lname' => sanitize_text_field($_POST['data']['lname']),
            'email' => sanitize_email($_POST['data']['email']),
            'password' => sanitize_text_field($_POST['data']['password']),
            'confirm-password' => sanitize_text_field($_POST['data']['confirmPassword']),
            'terms' => sanitize_text_field($_POST['data']['terms']),
        );

        // Validate all form data
        $this -> form_data_validation($data);
        
        // Abort execution
        wp_die();
    }

    private function form_data_validation($data = null) {
        if (isset($data)):
            // Redefine all data's name
            $prefix = $data['prefix'];
            $fname = $data['fname'];
            $lname = $data['lname'];
            $email = $data['email'];
            $password = $data['password'];
            $confirm_password = $data['confirm-password'];
            $terms = $data['terms'];

            // Call out WP_Error to handle error and send back JSON error message to the front end
            $error = new WP_Error;

            // Check if there is any empty field
            if (empty($prefix) || empty($fname) || empty($lname) || empty($email) || empty($password)):
                $error -> add('empty_field', '<p class="error-message">Please fill in all the fields.</p>');
            endif;

            // Check if the password is matched with the confirm password.
            // The message should be only showed while the user tries to type the confirm password field
            if (!empty($confirm_password)):
                if ($password !== $confirm_password):
                    $error -> add('confirm_password_not_match', '<p class="error-message">Password is not matched.</p>');
                endif;
            endif;

            // Check if the new user agrees with the terms
            if (empty($terms)):            
                $error -> add('agree_terms', '<p class="error-message">Please view the terms and the privacy policy then check the checkbox to continue.</p>');
            endif; 

            // Check if there are any errors
            if ($error -> has_errors()):
                wp_send_json_error($error -> get_error_messages(), 400, 0);
            else:
                wp_send_json_success(null, 200, 0);
            endif;
        endif;
    }
}