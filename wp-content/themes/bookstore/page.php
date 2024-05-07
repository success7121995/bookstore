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
    if (!is_home() && !is_front_page()):
        if (have_posts()):
            while(have_posts()):
                the_post();
                the_content();
            endwhile;
        endif;
    endif;
    ?>
</div>

<?php
get_footer();
