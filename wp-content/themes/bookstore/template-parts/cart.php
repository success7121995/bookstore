<?php
/**
 * Cart Template
 * 
 * @package Bookstore
 */

// Check if $query has been set
$cart = isset($args['cart']) ? $args['cart'] : null;

if ($cart):
    // Convert the JSON object to an array
    $cart_decode = json_decode($cart, true); 

    // Preset subtotal to 0
    $subtotal = 0;
?>
<form id="cart" class="cart">
<?php
    // Check if $cart_decode['id'] is an array
    if (is_array($cart) && !empty($cart_decode['id'])):
        // Loop through IDs to retrieve all books
        foreach ($cart_decode['id'] as $id):
            $field = get_fields($id);

            $db_query = $wpdb -> prepare("SELECT post_title FROM wp_posts WHERE ID = $id");
            $query = $wpdb -> get_results($db_query);

            // Redefine all fields
            $title = $query[0] -> post_title;
            $permalink = get_permalink($id);
            $image = $field['image']['url'];
            $unit_price = $field['price'];
            $decimal_point = '00';

        ?>

        <li id="book-<?php echo $id; ?>" class="item">
            <h4><?php echo $unit_price; ?></h4>
            <div class="item-checkbox">
                <input type="checkbox" name="check" checked>
            </div>
            <div class="item-qty"> 
                <i class="qty-btn bi bi-dash-square-fill minus"></i>
                <label for="qty">Quantity</label>
                <input type="text" name="qty" value="1">
                <i class="qty-btn bi bi-plus-square-fill plug"></i>
            </div>
        </li>
    <?php
        endforeach;
    else:
        echo 'The cart is empty.';
    endif;
?>
</form>
<?php
else: 
    echo 'The cart is not set.';
endif;
?>