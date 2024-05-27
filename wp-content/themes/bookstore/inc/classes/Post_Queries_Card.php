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
    }

    // Display new releases
    public function display_new_releases() {
        $terms = 'new-releases';

        ob_start();

        $query = new WP_Query(array(
            'post_type' => 'books',
            'tax_query' => array(
                array(
                    'taxonomy' => 'features',
                    'field' => 'slug',
                    'terms' => array($terms)
                )
            ),
            'orderby' => 'title',
            'order' => 'ASC',
            'posts_per_page' => 20
        ));

        $this -> book_query($query, $terms);

        // Reset query data
        wp_reset_postdata();

        return ob_get_clean(); 
    }

    // Display new releases
    public function display_recommendations() {
        $terms = 'recommendations';

        ob_start();

        $query = new WP_Query(array(
            'post_type' => 'books',
            'tax_query' => array(
                array(
                    'taxonomy' => 'features',
                    'field' => 'slug',
                    'terms' => array($terms)
                )
            ),
            'orderby' => 'title',
            'order' => 'ASC',
        ));

        // print_r($query);

        $this -> book_query($query, $terms);

        // Reset query data
        wp_reset_postdata();

        return ob_get_clean(); 
    }

    // Query books
    private function book_query($query, $terms) { 
        if ($query -> have_posts()):
?>
        <div class="cards slider">
            <button class="scroll prev-btn"><i class="bi bi-caret-left-fill"></i></button>
            <div class="card-wrapper">
<?php
            while ($query -> have_posts()):
                $query -> the_post();
                get_template_part('template-parts/card', null, array('query' => $query));
            endwhile;
?>
            </div>
            <button class="scroll next-btn"><i class="bi bi-caret-right-fill"></i></button>
        </div>
<?php
        else:
            echo '<h2 class="not-found-display">No ' . substr($terms, 0, -1) . ' is avaiable yet!</h2>';
        endif;
    }
} 