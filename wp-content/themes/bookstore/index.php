<?php
/**
 * Index
 * 
 * @package Bookstore
 */
get_header();
?>
<div class="container">
    <h2>Test</h2>
    <?php
    /**
     * iterate posts to the index page
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
