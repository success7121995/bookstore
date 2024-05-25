<?php
/**
 * Favorite, Cart and Orders List
 * 
 * @package Bookstore
 */
if (isset($_SESSION['AuthnUser'])):

// Get user ID from session to query the user data from database
$user_id = $_SESSION['AuthnUser'];

// Connect to database
global $wpdb;

// Get the post title from WP_Term_Object
$query_object = get_queried_object();
$heading = $query_object -> post_title;

get_header();
?>
<div class="container">
    <h1><?php echo wp_kses_post($heading); ?></h1>
    <form id="cart">
        <div class="item">
            <div class="item-heading">
                <input type="checkbox" name="cart-check" checked>
                <img class="cart-image" src="http://localhost/bookstore/wp-content/uploads/2024/05/Barash-Cullen-and-Stoeltings-Clinical-Anesthesia-Print-eBook-with-Multimedia-Ninth-Edition.jpg" alt="">
            </div>
            <div class="item-body">
                <h4 class="item-title">CUET PG Psychology 2024 - Masters MSc MA Psychology Entrance Exam Preparation Book with MCQ Questions Bank - (2 Books Set) by Power Within Psychology - Edition 3</h4>
                <div class="btn-group">
                    <i class="qty-btn minus bi bi-dash-square-fill"></i>
                    <input class="item-qty" type="text" name="qty" value="1">
                    <i class="qty-btn plug bi bi-plus-square-fill"></i>
                </div>
                <p class="item-price">$100</p>
            </div>
        </div>
        <input type="button" value="Buy Now"/>
    </form>
</div>

<?php
get_footer();
else:   
    // Redirect to 404 page
    include('404.php');

    // Do nothing when redirect to 404 page
    exit;
endif;
