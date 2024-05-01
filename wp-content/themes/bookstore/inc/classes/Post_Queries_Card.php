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
    /**
     * Prevent from multiple instantiations
     */
    use Singleton;

    /**
     * Add shortcode
     */
    private function __construct() {
        add_shortcode('display_new_releases', [$this, 'display_new_releases']);
        add_shortcode('display_recommendations', [$this, 'display_recommendations']);
    }

    /**
     *  Display new releases
     */
    public function display_new_releases() {
        $feature_type = 'new-release';

        /**
         * Buffer starts
         */
        ob_start();

        $this -> feature_book_query($feature_type);
        
        /**
         * reset query data
         */
        wp_reset_postdata();

        /**
         * Buffer ends
         */
        return ob_get_clean();  
    }

    /**
     *  Display recommendations
     */
    public function display_recommendations() {
        $feature_type = 'recommendation';

        ob_start();

        $this -> feature_book_query($feature_type);


        wp_reset_postdata();
        return ob_get_clean();  
    }

    /**
     * Query featured books
     */
    private function feature_book_query($feature_type) {
        $query = new WP_Query(array(
            'post_type' => 'books'
        ));

        if ($query -> have_posts()):

            /**
             * Pass through the $query and $feature_type to the template
             */
            get_template_part('template-parts/card', null, array(
                'query' => $query,
                'feature_type' => $feature_type,
            ));

        else:
            echo wp_kses_post('<h2 class="not-found-display">Oop! No ' . str_replace('-', ' ', $feature_type) . ' yet!</h2>');
        endif;
    }
} 