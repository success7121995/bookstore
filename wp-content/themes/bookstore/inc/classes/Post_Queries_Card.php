<?php
/**
 * Post_Queries_Card
 * 
 * @package Bookstore
 * 
 * This class queries posts and formats them into a shortcode for a card
 * 
 */

class Post_Queries_Card {
    //  Prevent from multiple instantiations
    use Singleton;
 
    //  Add shortcode
    private function __construct() {
        add_shortcode('display_new_releases', [$this, 'display_new_releases']);
        add_shortcode('display_recommendations', [$this, 'display_recommendations']);
        add_shortcode('display_genres', [$this, 'display_genres']);
    }

    // Display new releases
    public function display_new_releases() {
        ob_start();

        $args = array(
            'post_type' => 'books',
            'tax_query' => array(
                array(
                    'taxonomy' => 'features',
                    'field' => 'slug',
                    'terms' => array('for-sales')
                ),
                array(
                    'taxonomy' => 'features',
                    'field' => 'slug',
                    'terms' => array('new-releases')
                )
            ),
            'orderby' => 'title',
            'order' => 'ASC',
        );

        $this -> book_query($args);

        // Reset query data
        wp_reset_postdata();

        return ob_get_clean(); 
    }

    // Display new releases
    public function display_recommendations() {
        ob_start();

        $args = array(
            'post_type' => 'books',
            'tax_query' => array(
                array(
                    'taxonomy' => 'features',
                    'field' => 'slug',
                    'terms' => array('recommendations')
                )
            ),
            'orderby' => 'title',
            'order' => 'ASC',
        );

        $this -> book_query($args);

        // Reset query data
        wp_reset_postdata();

        return ob_get_clean(); 
    }

    // Display related books
    public function display_genres() {
        // Get the slug to determine what genre of books we are looking for.
        $query_object = get_queried_object();
        $slug = $query_object -> slug;

        ob_start();

        $args = array(
            'post_type' => 'books',
            'tax_query' => array(
                array(
                    'taxonomy' => 'genre',
                    'field' => 'slug',
                    'terms' => array($slug)
                )
            ),
            'orderby' => 'title',
            'order' => 'ASC',
            'posts_per_page' => 3
        );

        $this -> book_query($args);

        // Reset query data
        wp_reset_postdata();

        return ob_get_clean(); 
    }

    // Query books
    private  function book_query($args) { 
        get_template_part('template-parts/card', null, array(
            'args' => $args
        ));
    }
} 