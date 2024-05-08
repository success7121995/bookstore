<?php
/**
 * Home Page
 * 
 * @package Bookstore
 */

get_header();
?>
<div class="container main-content">
<?php 
    echo do_shortcode('[display_genres]', true);
?>
</div>

<?php
get_footer();
