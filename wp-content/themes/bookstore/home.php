<?php
/**
 * Home Page
 * 
 * @package Bookstore
 */
get_header();

/**
 * iterate all books on sales
 */
if (have_posts()):
    while(have_posts()): the_post();
        the_content();
    endwhile;
endif;

wp_footer();
