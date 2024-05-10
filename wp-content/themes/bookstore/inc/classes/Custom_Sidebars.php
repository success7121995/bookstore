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
    // List out all categories
    public static function render_sidebar() {
        $instance = new self();
        return $instance->get_sidebar_content();
    }

    // Retrieve all genre's terms from the database
    public function get_sidebar_content() {
        // Globalize to enable the function of retrieving data from the database
        global $wpdb;

        $query = new WP_Query(array(
            'post_type' => 'books'
        ));

        $genres = $wpdb -> get_results("SELECT * FROM wp_term_taxonomy JOIN wp_terms ON wp_term_taxonomy.term_id = wp_terms.term_id WHERE taxonomy = 'genre'");

        ob_start();

        $this -> sidebar_structure($query, $genres);

        // reset query data 
        wp_reset_postdata();

        return ob_get_clean(); 
    }

    // this function constructs a sidebar structure
    private function sidebar_structure($query, $genres) {
        if ($query -> have_posts()):

            // Pass through the $query to the template
            get_template_part('template-parts/sidebar', null, array(
                'query' => $query,
                'genres' => $genres
            ));

        else:
            // echo wp_kses_post('<h2 class="not-found-display">Oop! No ' . str_replace('-', ' ', $feature_type) . ' yet!</h2>');
        endif;
    }
} 