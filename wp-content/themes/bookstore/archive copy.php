<?php
/**
 * Archive
 * 
 * @package Bookstore
 */

get_header();
?>
<div id="archive" class="container main-content">
    <aside style="display: none;">
        <?php dynamic_sidebar('category-sidebar'); ?>
    </aside>
    <h1 class="page-title"><?php echo wp_kses_post($category_name); ?></h1>
    <!-- Cards Wrapper -->
    <section>
    <?php
    if (!is_home() && !is_front_page()):
        // iterate posts to the archive page
        if (have_posts()):
            echo do_shortcode('[display_genres]', true);
        endif;
    endif;
    ?>
    </section>
</div>

<?php
get_footer();
