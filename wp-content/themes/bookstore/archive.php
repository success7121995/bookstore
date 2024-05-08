<?php
/**
 * Archive Page
 * 
 * @package Bookstore
 */
$totel_pages = 0;

get_header();
?>
<div class="container main-content">
<?php 
if (have_posts() && is_archive()):
    // Check what taxonomy is queried.
    // Determine what books should be displayed by the taxonomy.
    $shortcode = is_tax('features') ? '[display_features]' : '[display_genres]';

    echo do_shortcode($shortcode, true);
endif;
?>
</div>

<?php
get_footer();
