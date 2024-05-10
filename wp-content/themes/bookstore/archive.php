<?php
/**
 * Archive Page
 * 
 * @package Bookstore
 */



get_header();
?>
<div class="container main-content">
<?php 
    do_shortcode('[display_genre]', true)
?>
</div>

<?php
get_footer();
