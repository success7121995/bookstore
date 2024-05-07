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

    // Prevent from multiple instantiations
    use Singleton;


    // Action
    private function __construct() {
        add_action('init', [$this, 'custom_post_type']);
        add_action('admin_init', [$this, 'custom_post_type_support']);
    }

    public function custom_post_type() {


        // Register post type of books.
        register_post_type('books',
            array(
                'labels' => array(
                    'name' => __('Books', 'Bookstore'),
                    'singular_name' => __('Book', 'Bookstore'),
                ),
                'public' => true,
                'has_archive' => true,
                'rewrite' => array(
                    'slug' => 'books',
                ),
                'menu_icon' => 'dashicons-book',
                'hierarchical' => true
            )
        );
    }

    public function custom_post_type_support() {
        add_post_type_support('books', array(
            'page-attributes'
        ));
    }
} 