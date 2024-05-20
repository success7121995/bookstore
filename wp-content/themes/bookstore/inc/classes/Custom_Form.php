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

        //Login
        add_action('wp_ajax_login_form_submit', [$this, 'login_form_submit']);
        add_action('wp_ajax_nopriv_login_form_submit', [$this, 'login_form_submit']);
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
            'email' => sanitize_text_field($_POST['data']['email']),
            'password' => sanitize_text_field($_POST['data']['password']),
            'confirm-password' => sanitize_text_field($_POST['data']['confirmPassword']),
            'terms' => sanitize_text_field($_POST['data']['terms'])
        );

        $form_validate = $this -> form_data_validation($data);

        // Send to database if all data pass the validation
        if ($form_validate -> has_errors()):
            // Send a JSON response to frontend to display error messages
            wp_send_json_error($form_validate -> get_error_messages(), 400, 0);
        else:
            $password_hash = password_hash($data['password'], PASSWORD_DEFAULT);

            // Pass validation, send to datebase
            $wpdb -> insert('customers', array(
                'prefix' => $data['prefix'],
                'fname' => $data['fname'],
                'lname' => $data['lname'],
                'email' => $data['email'],
                'password' => $password_hash,
                'is_agree_terms' => $data['terms']
            ));
            // Send a JSON response to frontend to access
            wp_send_json_success(null, 200, 0);
        endif;
        
        // Abort execution
        wp_die();
    }

    // Form Validation
    private function form_data_validation($data = null) {
        if (isset($data)):
            // Redefine all data's name
            $email = $data['email'];
            $password = $data['password'];
            $confirm_password = $data['confirm-password'];
            $terms = $data['terms'];

            // Pack required fields for checking if there is any empty field
            $required_fields = array(
                'prefix' => 'prefix',
                'fname' => 'first name',
                'lname' => 'last name',
                'email' => 'email',
                'password' => 'password'
            );

            // Call out WP_Error to handle error and send back JSON error message to the front end
            $error = new WP_Error;
            
            // Handling empty fields error
            foreach ($required_fields as $field => $label):
                if (empty($data[$field])):
                    $error->add("empty_$field", '<p class="error-message ' . $field . '">Please enter your ' . $label . '.</p>');
                endif;
            endforeach;

            // Check the validation of the email
            if (!sanitize_email($email) && !empty($email)):
                $error -> add('invalid_email', '<p class="error-message email">Email is not valid.</p>');
            endif;

            // Check if the email is registered
            if ($this -> email_exist($email)):
                $error -> add('exist_email', '<p class="error-message email">This email is registered.</p>');
            endif;

            // Password validation
            if (!$this -> password_validation($password) && !empty($password)):
                $error -> add('invalid_password', '<p class="error-message password">Password must be 6-20 characters long and include at least one uppercase letter.</p>');
            endif;  

            // Check if passwords matches. 
            if (!empty($confirm_password) || empty($password)):
                if ($password !== $confirm_password):
                    $error -> add('confirm_password_not_match', '<p class="error-message confirm-password">Password is not matched.</p>');
                endif;
            endif;

            // Check if the new user agrees with the terms
            if (empty($terms)):
                $error -> add('agree_terms', '<p class="error-message terms">Please view the terms and the privacy policy then check the checkbox to continue.</p>');
            endif; 

            // Return errors
            return $error;
        endif;
    }

    // Email Uniqueness
    private function email_exist($email) {
        global $wpdb;
        return $wpdb -> query("SELECT * FROM customers WHERE email = '$email'");
    }

    // Password Validation
    private function password_validation($password) {
        // Regex pattern
        $regex = '/[A-Za-z0-9]+/i';
        $preg_match = preg_match($regex, $password);

        // Check the password's length
        $str_len = strlen($password);

        return $str_len > 6 && $str_len < 20 && $preg_match;
    }

    // Submit login form
    public function login_form_submit() {
        // Connect to database
        global $wpdb;

        // Get form data from AJAX
        $data = array(
            'email' => sanitize_text_field($_POST['data']['email']),
            'password' => sanitize_text_field($_POST['data']['password']),
            'terms' => sanitize_text_field($_POST['data']['terms'])
        );

        $email = $data['email'];
        $password = $data['password'];

        $login_validate = $this -> login_form_validation($data);

        // Send to database if all data pass the validation
        if ($login_validate -> has_errors()):
            // Send a JSON response to frontend to display error messages
            wp_send_json_error($login_validate -> get_error_messages(), 400, 0);
        else:
            // Send a JSON response to frontend to access
            wp_send_json_success(null, 200, 0);
        endif;

        // Abort execution
        wp_die();
    }

    // Login Validation
    private function login_form_validation($data) {
        if (isset($data)):
            // Redefine all data's name
            $email = $data['email'];
            $password = $data['password'];
            $terms = $data['terms'];

            // Pack required fields for checking if there is any empty field
            $required_fields = array(
                'email' => 'email',
                'password' => 'password'
            );

            // Call out WP_Error to handle error and send back JSON error message to the front end
            $error = new WP_Error;
            
            // Handling empty fields error
            foreach ($required_fields as $field => $label):
                if (empty($data[$field])):
                    $error->add("empty_$field", '<p class="error-message ' . $field . '">Please enter your ' . $label . '.</p>');
                endif;
            endforeach;

            // Authenication
            if (!$this -> login_authnication($email, $password)):
                $error -> add('login_authn', '<p class="error-message password">Email or password is incorrect.</p>');
            endif;

            // Check if the new user agrees with the terms
            if (empty($terms)):
                $error -> add('agree_terms', '<p class="error-message terms">Please view the terms and the privacy policy then check the checkbox to continue.</p>');
            endif;

            return $error;
        endif;
    }

    // Login authication
    private function login_authnication($email, $password) {
        global $wpdb;

        // Query email from database
        $email_exist = $wpdb -> get_results("SELECT * FROM customer WHERE = '$email'");

        // If email is exist, check 
        if ($email_exist):
           $password_hash = $email_exist[0] -> password;

           return password_verify($data['password'], $password_hash);
        endif;

        return $email_exist;
    }
}