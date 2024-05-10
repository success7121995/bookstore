<?php
/**
 * Single Book Page
 * 
 * @package Bookstore
 */

// Query the specified post by the ID
$id = get_the_ID();

$query = new WP_Query(array(
    'post_type' => 'books',
    'p' => $id
));

get_header();
?>
<div class="container main-content">
    <div class="single-book">
        <?php
        if (!is_home() && !is_front_page()):
            if ($query -> have_posts()):
                $query -> the_post();
                get_template_part('template-parts/book', null, array('query' => $query));
            endif;
        endif;
        ?>
    </div>
    <h3 class="wp-block-heading">Recommendations</h3>
    <div style="margin-bottom: 20px;">
    <?php
    // Embed recommendations
    echo do_shortcode('[display_recommendations]', true)
    ?>
    </div>
</div>

<?php
get_footer();
