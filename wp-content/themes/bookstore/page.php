<?php
/**
 * Page
 * 
 * All parent pages will display here
 * 
 * @package Bookstore
 */
get_header();
?>
<div class="container">
    <?php
    /**
     * iterate posts to the post page
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
