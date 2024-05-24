<?php
/**
 * Cart
 * 
 * @package Bookstore
 * 
 * This class handles all cart functions
 * 
 */

class Cart {
    // Prevent from multiple instantiations
    use Singleton;

    // Action
    private function __construct() {
        add_action('wp_ajax_add_to_cart', [$this, 'add_to_cart']);
        add_action('wp_ajax_nopriv_add_to_cart', [$this, 'add_to_cart']);
    }

    // Add to cart
    public function add_to_cart() {
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
                // Get user ID from session and retrieve the cart
                $user_id = $_SESSION['AuthnUser'];  
                $db_query = $wpdb -> prepare("SELECT cart FROM customers WHERE id = $user_id");
                $cart = $wpdb -> get_var($db_query);

                // Convert the JSON object to an array
                $cart_decode = json_decode($cart, true);

                // Add the book to the cart
                if (!is_array($cart_decode)): // cart would be NULL if no data is stored, in contrast the cart will perform as an array.
                    $cart_decode = array('book' => array(
                        'id' => $book_id,
                        'qty' => 1
                    ));
                else:
                    $cart_data = $cart_decode;

                    for ($i = 0; $i < count($cart_data); $i++):
                        // Return error since the book already existed in the list 
                        if ($cart_data[$i] === $book_id):

                            wp_send_json_error('book_already_in_cart', 409, 0);
                        endif;

                        // Amount of cart exceeds
                        if (count($cart_data) > 4):
                            wp_send_json_error('max_cart_reached', 403, 0);
                        endif;
                    endfor;

                    // Append the book to the cart array
                    // $cart_decode['book']['id'] = $book_id;
                    // $cart_decode['book']['qty'] = 1;

                    array_push($cart_decode['book'], array(
                        'id' => $book_id,
                        'qty' => 1
                    ));
                endif;

                // Convert the cart array to JSON 
                $cart_encode = json_encode($cart_decode);

                $wpdb -> update('customers', array('cart' => $cart_encode), array('id' => $user_id));

                wp_send_json_success($cart_data, 201  , 0);
            } catch (Exception $e) {
                wp_send_json_error($e, 500, 0);
            }
        endif;
    }
} 