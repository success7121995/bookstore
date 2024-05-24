<?php
/**
 * Register_Scripts_Style
 * 
 * @package Bookstore
 * 
 * Register and enqueue script and stylesheet
 * 
 */

class Register_Scripts_Style {
    // Prevent from multiple instantiations
    use Singleton;

    // The __construct function is set to private since it is not allowed to instantiate in in public.
    private function __construct() {
        // Actions
        add_action('wp_enqueue_scripts', [$this, 'register_stylesheet']);
        add_action('wp_enqueue_scripts', [$this, 'register_javascript']);
    }

    // Register and enqueue stylesheets
    public function register_stylesheet() {
        
        // Register stylesheets
        wp_register_style('bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css', array(),  '1.11.3', 'all'); // Bootstrap Icons
        wp_register_style('bookstore-main-style', get_stylesheet_uri(), array('bootstrap-icons'), '1.0.0', 'all'); // Main CSS

        // Enqueue stylesheets
        wp_enqueue_style('bootstrap-icons');
        wp_enqueue_style('bookstore-main-style');
    }   

    public function register_javascript() {
        // Get the current page slug's that is mainly for login and signup page)
        $query_object = get_queried_object();

        $slug = !empty($query_object) ? $query_object -> slug : null;

        

        // Register script
        wp_register_script('bookstore-jquery', 'https://code.jquery.com/jquery-3.7.1.min.js', array(), '3.7.1', false); // Jquery
        wp_register_script('bookstore-main', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0.0', true); // main.js
    
        // it allows to pass PHP-generated data to JQuery.
        // 'ajaxurl' will be the URL for the WP AJAX endpoint, which allows to make AJAX requests to the WP backend (admin-ajax.php).
        wp_localize_script('bookstore-main', 'bookstore_ajax', array('ajaxurl' => admin_url('admin-ajax.php')));

        // Enqueue Scripts
        wp_enqueue_script('bookstore-jquery');
        wp_enqueue_script('bookstore-main');

        // Only register authn.js in login and signup page
        if ($slug === 'login' || $slug === 'signup'):
            wp_register_script('bookstore-authn', get_template_directory_uri() . '/assets/js/authn.js', array('bookstore-main'), '1.0.0', true);// authn.js
            
            // This is for authentication form submission
            wp_localize_script( 'bookstore-authn', 'bookstore_authn',
            array('ajaxurl' => admin_url('admin-ajax.php')));

            wp_enqueue_script('bookstore-authn');
        endif;

        $slug = !empty($query_object) ? $query_object -> post_name : null;

        // Only show in cart page
        if ($slug === 'cart'):
            wp_register_script('bookstore-cart', get_template_directory_uri() . '/assets/js/cart.js', array('bookstore-main'), '1.0.0', true);// authn.js
            
            // This is for authentication form submission
            wp_localize_script( 'bookstore-cart', 'bookstore_cart',
            array('ajaxurl' => admin_url('admin-ajax.php')));

            wp_enqueue_script('bookstore-cart');
        endif;
    }
}