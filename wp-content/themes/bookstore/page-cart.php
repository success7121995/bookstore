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

</div>

<?php
get_footer();
else:   
    // Redirect to 404 page
    include('404.php');

    // Do nothing when redirect to 404 page
    exit;
endif;
