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
        add_action('wp_ajax_signup_form_submit', [$this, 'signup_form_submit']);
        add_action('wp_ajax_nopriv_signup_form_submit', [$this, 'signup_form_submit']);
    }

    // Submit signup form
    public function signup_form_submit() {
        $prefix = sanitize_text_field($_POST['data']['prefix']);
        $fname = sanitize_text_field($_POST['data']['fname']);
        $lname = sanitize_text_field($_POST['data']['lname']);
        $email = sanitize_text_field($_POST['data']['email']);
        $password = sanitize_text_field($_POST['data']['password']);
        $confirm_password = sanitize_text_field($_POST['data']['confirm-password']);
        echo $prefix . "\n";
        echo $fname . "\n";

        // Abort execution
        wp_die();
    }
}