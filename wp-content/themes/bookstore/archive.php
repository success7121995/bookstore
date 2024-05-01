<?php
/**
 * Archive
 * 
 * @package Bookstore
 */

 /**
  * Get the query object
  */
get_header();
?>
<div id="archive" class="container main-content">
    <aside>
        <?php dynamic_sidebar('category-sidebar'); ?>
    </aside>
    <h1 class="page-title"><?php echo wp_kses_post($category_name); ?></h1>
    <?php
    if (!is_home() && !is_front_page()):
        /**
         * iterate posts to the index page
         */
        if (have_posts()):
            while(have_posts()):
                the_post();
                the_title();
            endwhile;
        endif;
    endif;
    ?>
</div>

<?php
get_footer();
