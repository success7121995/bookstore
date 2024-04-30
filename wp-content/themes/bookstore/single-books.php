<?php
/**
 * Single Book Page
 * 
 * @package Bookstore
 */

/**
 * Query the specified post by the ID
 */
$id = get_the_ID();

$query = new WP_Query(array(
    'post_type' => 'books',
    'p' => $id
));

get_header();
?>

<div class="container single-book">
    <?php
    if (!is_home() && !is_front_page()):
        if ($query -> have_posts()):
            $query -> the_post();
            
            /**
             * Pass through the query to the template
             */
            get_template_part('template-parts/book', null, array('query' => $query));
        endif;
    endif;
    ?>
</div>

<?php
get_footer();
