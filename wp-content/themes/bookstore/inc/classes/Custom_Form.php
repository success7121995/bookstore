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
    public static function signup_form_submit() {
        $prefix = sanitize_text_field($_POST['prefix']);
        echo $prefix;
        echo 'hi';
    }
}