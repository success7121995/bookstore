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
    /**
     * Prevent from multiple instantiations
     */
    use Singleton;

    /**
     * The __construct function is set to private since it is not allowed to instantiate in in public.
     */
    private function __construct() {
        /**
         * Actions
         */
        add_action('wp_enqueue_scripts', [$this, 'register_stylesheet']);
        add_action('wp_enqueue_scripts', [$this, 'register_javascript']);
    }


    /**
     * Register and enqueue stylesheets
     */
    public function register_stylesheet() {
        
        /**
         * Register stylesheets
         */
        wp_register_style('font-Gupter', 'https://fonts.googleapis.com/css2?family=Gupter:wght@400;500;700&display=swap'); // Bootstrap Icons
        wp_register_style('bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css', array(),  '1.11.3', 'all'); // Bootstrap Icons
        wp_register_style('bookstore-main-style', get_stylesheet_uri(), array('bootstrap-icons'), '1.0.0', 'all'); // Main CSS

        /**
         * Enqueue stylesheets
         */
        wp_enqueue_style('font-Gupter');
        wp_enqueue_style('bootstrap-icons');
        wp_enqueue_style('bookstore-main-style');
    }   

    public function register_javascript() {
        
        /**
         * Register script
         */
        wp_register_script('bookstore-jquery', 'https://code.jquery.com/jquery-3.7.1.min.js', array(), '3.7.1', false); // Jquery
        wp_register_script('bookstore-main', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0.0', true);// main js

        /**
         * Enqueue Scripts
         */
        wp_enqueue_script('bookstore-jquery');
        wp_enqueue_script('bookstore-main');
    }
}