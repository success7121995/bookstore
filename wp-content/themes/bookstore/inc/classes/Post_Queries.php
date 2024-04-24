<?php
/**
 * Post_Queries
 * 
 * @package Bookstore
 * 
 * This class queries posts and formats them into a shortcode for embedding on a web page.
 * 
 */

class Post_Queries {
    /**
     * Prevent from multiple instantiations
     */
    use Singleton;

    /**
     * Add shortcode??
     */
    private function __construct() {
        add_shortcode('display_all_posts', [$this, 'display_all_posts']);
    }

    /**
     * Posts  
     */
    public function display_all_posts() {
        ob_start();

        /**
         * Queries
         */
        $query = new WP_Query(array(
            'post_type' => 'post'
        ));

        /**
         * Display structure,
         * 
         * Display all the post related to the query in custom layout and style
         */
        if ($query -> have_posts()):
            while ($query -> have_posts()):
                $query->the_post();
                
                /**
                 * Related contents 
                 */
                
                // the_content();
            endwhile;
        else:
            echo wp_kses_post('<h2 class="not-found-display">Oop! No new book released yet!</h2>');
        endif;

        wp_reset_postdata();
        return ob_get_clean();
    }
} 