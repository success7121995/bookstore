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

    // Query
    public function display_new_releases() {
        // Start Buffer
        ob_start();
        print_r($query);
        // $this -> book_query($query);

        // Reset query data
        wp_reset_postdata();

        //  Buffer ends
        return ob_get_clean(); 
    }

    private function book_query() {
        
    }
} 