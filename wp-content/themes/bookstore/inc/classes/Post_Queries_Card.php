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

        ob_start();

        $this -> feature_post_query($feature_type);
        
        wp_reset_postdata();
        return ob_get_clean();  
    }

    /**
     *  Display recommendations
     */
    public function display_recommendations() {
        $feature_type = 'recommendation';

        ob_start();

        $this -> feature_post_query($feature_type);

        wp_reset_postdata();
        return ob_get_clean();  
    }

    /**
     * Query featured books
     */
    private function feature_post_query($feature_type) {
        $query = new WP_Query(array(
            'post_type' => 'books'
        ));

        /**
         * Assume that there is no related book
         */
        $found_related = false;

        if ($query -> have_posts()):
        /**
         * Card container wraps all post contents
         */
        ?>

        <div class="cards">
            <button class="scroll prev-btn"><i class="bi bi-caret-left-fill"></i></button>
            <div class="card-wrapper">
            <?php
            while ($query -> have_posts()):
                $query -> the_post();

                /**
                 * It returns an array of WP_Term Object
                 */
                $features = get_field('features') ? get_field('features') : array();

                if (!empty($features)):
                    foreach ($features as $feature):
                        if ($feature -> slug === $feature_type):

                            $found_related = true;
                            $this -> card_html_structure($query);
                        endif;
                    endforeach;
                endif;
            endwhile;
            ?>
                
            </div>
            <button class="scroll next-btn"><i class="bi bi-caret-right-fill"></i></button>
        </div>

            <?php
            /**
             * If $found_related remains false, displays 'No result found'
             */
            if ($found_related === false):
                echo wp_kses_post('<h2 class="not-found-display">Oop! No ' . str_replace('-', ' ', $feature_type) . ' yet!</h2>');
            endif; 
        else:
            echo wp_kses_post('<h2 class="not-found-display">Oop! No ' . str_replace('-', ' ', $feature_type) . ' yet!</h2>');
        endif;

    } 

    /**
     * Display structure in HTML
     */
    private function card_html_structure($query) {            
        /**
         * Get ACF field values
         */
        $fields = get_fields();
        ?>
        <a href="<?php echo get_permalink($query-> post -> ID); ?>">
            <div class="card book">
                <div class="card-heading">
                    <img class="card-thumbnail" src="<?php echo $fields['image']['url']; ?>" alt="<?php echo $fields['title']; ?>">
                </div>
                <div class="card-body">
                    <h6 class="card-title card-box"><?php echo $fields['title']; ?></h6>
                    <div class="card-content">
                        <p class="card-tags card-box"><?php echo $fields['tags']; ?></p>
                        <div class="card-rate card-box">
                            <?php
                            /**
                             * Loop 5 times, if the rate is greater than $i, display a star shape.
                             */
                            $rate = $fields['rate'];

                            for ($i = 1; $i <= 5; $i++): 
                                /**
                                 * If the rate is an integer, display a full star shape
                                 */
                                if ($i <= $rate):
                            ?>
                                <i class="bi bi-star-fill"></i>
                                
                                <?php
                                /**
                                 * If the rate is a float, display a half star shape
                                 * 
                                 * Assume that $i is looped to 5 and $rate is 4.5, $i - 0.5 must be greater or equal to 4.5
                                 * 
                                 * It determines whether the last star should be a full or half shape. 
                                 */
                                elseif ($i - 0.5 <= $rate):     
                                ?>

                                <i class="bi bi-star-half"></i>
                            <?php
                                endif;
                            endfor;
                            ?>

                        </div>
                        <p class="card-price card-box">
                        <?php
                        /**
                         * Assume that the price is an integer, decimal point will be presented to 00.
                         */
                        $price = $fields['price'];
                        $decimal_point = '00';
                        
                        /**
                         * Explode the price to two part. For instance, 12.45 => '12', '45', then convert to an array.
                         */
                        $digits = explode('.', $price);
                        
                        if (count($digits) > 1):
                            /**
                             * Replace decimal_point to $digits[1] (decimal point)
                             */
                            $decimal_point = $digits[1]; 
                        endif;

                        echo '$' . $digits[0] . '.<span style="font-size: 10px;">' . $decimal_point . '</span>';
                        ?>
                        </p>
                    </div>
                    <button class="add-to-cart card-box">Add to Cart</button>
                </div>
            </div>
        </a>      
        <?php
    }
} 