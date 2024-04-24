<?php
/**
 * Custom_Post_Type
 * 
 * @package Bookstore
 * 
 * This class is for registering new post type.
 * 
 */

class Custom_Post_Types {
    /**
     * Prevent from multiple instantiations
     */
    use Singleton;

    /**
     * Action
     */
    private function __construct() {
        add_action('init', [$this, 'custom_post_type']);
    }

    public function custom_post_type() {

        /**
         * Register post type of books.
         */
        register_post_type('books',
            array(
                'labels' => array(
                    'name' => __('Books', 'Bookstore'),
                    'singular_name' => __('Book', 'Bookstore'),
                ),
                'public' => true,
                'has_archive' => true,
                'rewrite' => array(
                    'slug' => ''
                ),
                'menu_icon' => 'dashicons-book',
                'show_in_rest' => true, // Switch to block editor
                'hierarchical' => true
            )
        );
    }
} 