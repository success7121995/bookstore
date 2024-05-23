<?php
/**
 * Authentication Pages
 * 
 * @package Bookstore
 */

// Unauthorize logged user to access any authn page
if (!isset($_SESSION['AuthnUser'])):

// Get the WP_Term_Object to learn the slug, determine what template should be loaded
$query_object = get_queried_object();
$slug = $query_object -> slug;
$heading = $query_object -> name;

get_header();
?>
<div class="authn main-content">
    <h1><?php echo wp_kses_post($heading); ?></h1>
<?php
    if ($slug === 'login'):
        get_template_part('template-parts/login');
    elseif ($slug === 'signup'):
        get_template_part('template-parts/signup');
    endif;
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
