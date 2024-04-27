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
     * Add shortcode??
     */
    private function __construct() {
        add_shortcode('display_new_releases', [$this, 'display_new_releases']);
    }

    /**
     * Books 
     */

    public function display_new_releases() {
        ob_start();

        /**
         * Query the post type of book
         */
        $query = new WP_Query(array(
            'post_type' => 'books'
        ));

        if ($query -> have_posts()):

            $features = get_field('features');

            while ($query -> have_posts()):
                $query -> the_post();

                $this -> card_html_structure($query);

            endwhile;
        else:
            echo wp_kses_post('<h2 class="not-found-display">Oop! No new book released yet!</h2>');
        endif;


        wp_reset_postdata();
        return ob_get_clean();  
    } 

    /**
     * Display structure in HTML
     */
    private function card_html_structure($query) {            
        /**
         * Get ACF field values
         */
        $fields = get_fields();
        /**         
         * End point of PHP
         */
        ?>
        <!-- HTML Structure -->
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
                         * Get the rate value
                         */
                        $rate = $fields['rate'];

                        /**
                         * Loop though the rate and display in star shapes
                         * Rate must be less than 5
                         */
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
                     * Get price value
                     * 
                     * Assume that the price is an integer, decimal point will be presented to 00.
                     */
                    $price = $fields['price'];
                    $decimal_point = '00';
                    
                    if ($price > 0):
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
                    endif;
                    ?>
                    </p>
                </div>
                <button class="add-to-cart card-box">Add to Cart</button>
            </div>
        </div>       
        <?php
    }
} 