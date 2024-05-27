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
        // Add to cart
        add_action('wp_ajax_add_to_cart', [$this, 'add_to_cart']);
        add_action('wp_ajax_nopriv_add_to_cart', [$this, 'add_to_cart']);

        // Get cart data
        add_action('wp_ajax_get_cart_data', [$this, 'get_cart_data']);
        add_action('wp_ajax_nopriv_get_cart_data', [$this, 'get_cart_data']);

        // Remove cart item
        add_action('wp_ajax_remove_cart_item', [$this, 'remove_cart_item']);
        add_action('wp_ajax_nopriv_remove_cart_item', [$this, 'remove_cart_item']);
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

                // Parse the JSON string
                $cart_decode = json_decode($cart, true);

                // Add the book to the cart
                if (!is_array($cart_decode)): // cart would be NULL if no data is stored, in contrast the cart will perform as an array.
                    $cart_decode = array(array(
                        'id' => $book_id,
                        'qty'=> 1
                    ));
                else:
                    for ($i = 0; $i < count($cart_decode); $i++):
                        // Return error since the book already existed in the list 
                        if ($cart_decode[$i]['id'] === $book_id):

                            wp_send_json_error('book_already_in_cart', 409, 0);
                        endif;

                        // Amount of cart exceeds
                        if (count($cart_decode) >= 4):
                            wp_send_json_error('max_cart_reached', 403, 0);
                        endif;
                    endfor;

                    // Append the book to the cart array
                    $cart_decode[] = array( 
                        'id' => $book_id,
                        'qty' => 1
                    );
                endif;

                // Stringigy to JSON
                $cart_encode = json_encode($cart_decode, JSON_FORCE_OBJECT);

                // Update the cart
                $wpdb -> update('customers', array('cart' => $cart_encode), array('id' => $user_id));

                wp_send_json_success($cart_decode, 201  , 0);
            } catch (Exception $e) {
                wp_send_json_error($e, 500, 0);
            }
        endif;

        // Abort execution
        wp_die();
    }

    // Get cart data
    public function get_cart_data() {
        // Connect to database
        global $wpdb;

        // Check if the user has logged in
        $user_id = isset($_SESSION['AuthnUser']) ? $_SESSION['AuthnUser'] : null;

        // Retrieve the user's cart from database
        if (!$user_id):
            
            wp_send_json_error('unauthn_user', 403, 0);
        else:
            try {
                $wp_query = $wpdb -> prepare("SELECT cart FROM customers WHERE id = $user_id");

                // Parse the JSON string
                $cart = $wpdb -> get_var($wp_query);

                // Convert the JSON object to an array
                $cart_decode = json_decode($cart, true);

                $cart_data = $this -> get_books_data($cart_decode);

                // Response cart data to frontend
                wp_send_json_success($cart_data, 200, 0);
            } catch (Exception $e) {
                wp_send_json_error($e, 500, 0);
            }
        endif;

        // Abort execution
        wp_die();
    }

    // Remove cart items
    public function remove_cart_item() {
        // Connect to database
        global $wpdb;

        $book_id = sanitize_text_field($_POST['data']);

        // Check if the user has logged in
        $user_id = isset($_SESSION['AuthnUser']) ? $_SESSION['AuthnUser'] : null;

        if (!$user_id):
            
            wp_send_json_error('unauthn_user', 403, 0);
        else:
            try {    
                $wp_query = $wpdb -> prepare("SELECT cart FROM customers WHERE id = $user_id");

                // Parse the JSON string
                $cart = $wpdb -> get_var($wp_query);

                // Convert the JSON object to an array
                $cart_decode = json_decode($cart, true);

                // Search corresponding ID from cart array, once it is found, remove it from the cart 
                $key = array_search($book_id, array_column($cart_decode, 'id'));
                if ($key !== false):
                    array_splice($cart_decode, $key, 1);
                endif;

                // Stringigy to JSON
                $cart_encode = json_encode($cart_decode, JSON_FORCE_OBJECT);

                // Update the cart
                $wpdb -> update('customers', array('cart' => $cart_encode), array('id' => $user_id));

                $cart_data = $this -> get_books_data($cart_decode);

                // Remove the specified book from the cart by its ID
                wp_send_json_success($cart_data, 200, 0);

            } catch (Exception $e) {
                wp_send_json_error($e, 500, 0);
            }
        endif;

        // Abort execution
        wp_die();
    }

    // Get books data by the cart data
    private function get_books_data($cart_data) {
        // Connect to database
        global $wpdb;


        // predefine an array for storing retrieved cart data
        $cart_array = array();

        if (!empty($cart_data)):
            foreach ($cart_data as $cart => $value):
                $book_id = $value['id'];
                $qty = $value['qty'];
      
                // Get book's ACF field, book's title and book's permalink by ID
                $wp_query = $wpdb -> prepare("SELECT post_title, guid FROM wp_posts WHERE id = $book_id");
                $query = $wpdb -> get_results($wp_query);
                $field = get_fields($book_id);

                // Define return variables
                $price = $field['price'];
                $title = $query[0] -> post_title;
                $permalink = $query[0] -> guid;
                $image = $field['image']['url'];
                $items = count($cart_data);

                // Retrieve the number of stock
                $stock = (int)$field['inventory']; // Convert string to Integer
                $in_stock = $stock < 0 ? 'out-of-stock' : 'in-stock';

                // Append all books data to the cart array
                $cart_array[] = array(
                    'id' => $book_id,
                    'qty' => $qty,
                    'price' => $price,
                    'title' => $title,
                    'permalink' => $permalink,
                    'image' => $image,
                    'items' => $items,
                    'stock' => $stock,
                    'in_stock' => $in_stock,
                    'subtotal' => $price * $qty
                );
            endforeach;
        endif;

        return $cart_array;
    }
} 