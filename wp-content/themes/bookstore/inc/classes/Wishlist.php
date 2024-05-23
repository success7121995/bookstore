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

        $book_id = sanitize_text_field($_POST['data']);

        // Check if the data is not empty and user is authenticated
        if (empty($book_id)):
            wp_send_json_error('book_not_found', 404, 0); // It is not supposed to happen unless the user tempers or remove the data-tab value deliberately
        elseif (!isset($_SESSION['AuthnUser'])):
            // It indicates that the user has not logged in, redirect to login page.
            wp_send_json_error(get_site_url() . '/login', 401, 0);
        else: 
            try {
                // Get user ID from session and retrieve the wish list
                $user_id = $_SESSION['AuthnUser'];  
                $db_query = $wpdb -> prepare("SELECT wishlist FROM customers WHERE id = $user_id");
                $wishlist = $wpdb -> get_var($db_query);

                // Convert the JSON object to an array
                $wishlist_decode = json_decode($wishlist, true);

                // Add the book to the wish list
                if (!is_array($wishlist_decode)): // Wishlist would be NULL if no data is stored, in contrast the wishlist will perform as an array.
                    $wishlist_decode = array('id' => array($book_id));
                else:
                    $wishlist_data = $wishlist_decode['id'];

                    for ($i = 0; $i < count($wishlist_data); $i++):
                        // Return error since the book already existed in the list 
                        if ($wishlist_data[$i] === $book_id):

                            wp_send_json_error('book_already_in_wishlist', 409, 0);
                        endif;

                        // Amount of wishlist exceeds
                        if (count($wishlist_data) > 4):
                            wp_send_json_error('max_wishlist_reached', 403, 0);
                        endif;
                    endfor;

                    // Append the book to the wish list array
                    $wishlist_decode['id'][] = $book_id;
                endif;

                // Convert the wish list array to JSON 
                $wishlist_encode = json_encode($wishlist_decode);

                $wpdb -> update('customers', array('wishlist' => $wishlist_encode), array('id' => $user_id));

                wp_send_json_success(null, 201  , 0);
            } catch (Exception $e) {
                wp_send_json_error($e, 500, 0);
            }
        endif;
    }
} 