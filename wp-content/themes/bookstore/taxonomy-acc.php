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

// Get the WP_Term_Object to learn the slug, determine what template should be loaded
$query_object = get_queried_object();
$slug = $query_object -> slug;
$heading = $query_object -> name;

// The slug detemines what kind of data should being looked for
$db_query;
if ($slug === 'favorites'):
    $db_query = $wpdb -> prepare("SELECT wishlist FROM customers WHERE id = $user_id");

    $list = $wpdb -> get_var($db_query);
endif;

get_header();
?>
<div class="container">
    <h1><?php echo wp_kses_post($heading); ?></h1>
<?php
    get_template_part('template-parts/list', null, array(
        'list' => $list
    ));
?>
</div>

<?php
get_footer();
else:   
    // Redirect to 404 page
    include('404.php');

    // Do nothing when redirect to 404 page
    exit;
endif;
