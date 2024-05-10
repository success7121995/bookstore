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
    if (have_posts()):
        while(have_posts()):
            the_post();
            the_content();
        endwhile;
    endif;
?> 
    <!-- New Book Releases -->
    <h3 class="wp-block-heading">New Book Release</h3>
    <?php echo do_shortcode('[display_new_releases]', true); ?>
    <!-- Recommendations -->
    <h3 class="wp-block-heading">Recommendations</h3>
    <?php echo do_shortcode('[display_recommendations]', true); ?>

</div>

<?php
get_footer();
