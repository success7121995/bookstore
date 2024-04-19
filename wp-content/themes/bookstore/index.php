<?php
/**
 * Index
 * 
 * @package Bookstore
 */
get_header();
?>
<div class="container">
    <?php
    /**
     * iterate posts on home page
     */
    if (have_posts()):
        while(have_posts()): the_post();
            the_content();
        endwhile;
    endif;
    ?>
</div>

<?php
wp_footer();
