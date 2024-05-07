<?php
/**
 * Siderber
 * 
 * @package Bookstore
 * 
 * This class constructs a sidebar for listing all category of books
 * 
 */

class Custom_Sidebars {
    // Prevent from multiple instantiations
    use Singleton;

    // Add shortcode
    private function __construct() {
        add_shortcode('list_out_all_categories_in_sidebar',  [$this, 'list_out_all_categories_in_sidebar']);
    }

    
    // List out all categories
    public function list_out_all_categories_in_sidebar() {
        // Globalize to enable the function of retrieving data from the database
        global $wpdb;

        $query = new WP_Query(array(
            'post_type' => 'books'
        ));
 
        // Retrieve all genre's taxonomies from the database
        $genres = $wpdb -> get_results("SELECT * FROM wp_term_taxonomy JOIN wp_terms ON wp_term_taxonomy.term_id = wp_terms.term_id WHERE taxonomy = 'genre'");

        // Buffer starts
        ob_start();

        $this -> siderbar_structure($query, $genres);

        // reset query data 
        wp_reset_postdata();

        // Buffer ends
        return ob_get_clean(); 
    }

    // this function constructs a sidebar structure
    private function siderbar_structure($query, $genres) {
        if ($query -> have_posts()):

            // Pass through the $query to the template
            get_template_part('template-parts/categories-sidebar', null, array(
                'query' => $query,
                'genres' => $genres
            ));

        else:
            // echo wp_kses_post('<h2 class="not-found-display">Oop! No ' . str_replace('-', ' ', $feature_type) . ' yet!</h2>');
        endif;
    }
} 