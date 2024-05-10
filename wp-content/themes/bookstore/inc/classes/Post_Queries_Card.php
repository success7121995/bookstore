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
        ob_start();

        $query = new WP_Query(array(
            'post_type' => 'books',
            'tax_query' => array(
                array(
                    'taxonomy' => 'features',
                    'field' => 'slug',
                    'terms' => array('new-releases')
                )
            ),
            'orderby' => 'title',
            'order' => 'ASC',
            'posts_per_page' => 20
        ));

        $this -> book_query($query);

        // Reset query data
        wp_reset_postdata();

        return ob_get_clean(); 
    }

    // Display new releases
    public function display_recommendations() {
        ob_start();

        $query = new WP_Query(array(
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
        ));

        // print_r($query);

        $this -> book_query($query);

        // Reset query data
        wp_reset_postdata();

        return ob_get_clean(); 
    }

    // Display all features
    public function display_features() {
        // Get the taxonomy to determine what genre of books we are looking for.
        $query_object = get_queried_object();
        $slug = $query_object -> slug;

        ob_start();

        $args = array(
            'post_type' => 'books',
            'tax_query' => array(
                array(
                    'taxonomy' => 'features',
                    'field' => 'slug',
                    'terms' => array($slug)
                )
            ),
            'orderby' => 'title',
            'order' => 'ASC',
            'posts_per_page' => 10
        );

        $this -> book_query($args);

        // Reset query data
        wp_reset_postdata();

        return ob_get_clean(); 
    }

    // Query books
    private function book_query($query) { 
        if ($query -> have_posts()):
?>
        <div class="cards">
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
        endif;
    }
} 