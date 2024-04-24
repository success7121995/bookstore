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
    /**
     * iterate posts to the home page
     */    
    if (have_posts()):
        while(have_posts()):
            the_post();
            the_content();
        endwhile;
    endif;
    ?>
</div>

<?php
get_footer();
