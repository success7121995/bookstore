<?php
/**
 * Home Page
 * 
 * @package Bookstore
 */
$query = new WP_Query(array(
    'post_type' => 'books'
)); 

get_header();
?>
<div class="container main-content">
    <?php 
    if ($query -> have_posts()):
        while($query -> have_posts()):
            print_r(get_field('genre'));

            $query -> the_post();
        endwhile;
    endif;
    ?>
</div>

<?php
get_footer();
