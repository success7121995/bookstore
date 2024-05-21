<?php
/**
 * Wisthlist
 * 
 * @package Bookstore
 * 
 * This class handles all wishlist's related actions, including add, remove and notifiction
 * 
 */

class Wishlist {
    // Prevent from multiple instantiations
    use Singleton;

    // Action
    private function __construct() {
        add_action('wp_ajax_add_to_wishlist', [$this, 'add_to_wishlist']);
        add_action('wp_ajax_nopriv_add_to_wishlist', [$this, 'add_to_wishlist']);
    }

    // Add to wish list
    public function add_to_wishlist() {
        // Connect to database
        global $wpdb;

        $data = array('id' => sanitize_text_field($_POST['data'])); // This data is not an array

        // Check if the data is not empty and user is authenticated
        if (empty($data)):
            wp_send_json_error('Error: No book is found, please try again later.', 400, 0); // It is not supposed to happen unless the user tempers or remove the data-tab value deliberately
        elseif (!isset($_SESSION['AuthnUser'])):
            // It indicates that the user has not logged in, redirect to login page.
            wp_send_json_error(get_site_url() . '/login', 400, 0);
        else: 
            wp_send_json_success($data, 203, 0);
        endif;
    }
} 