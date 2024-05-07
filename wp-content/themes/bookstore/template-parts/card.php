<?php
/**
 * Card Template
 * 
 * @package Bookstore
 */

// Check if $query, $feature_type and $genre have been set
$query = isset($args['query']) ? $args['query'] : null;
$feature_type = isset($args['feature_type']) ? $args['feature_type'] : null;

// Set to false to indicate that no related element is found 
$found_related = false;
?>

<!-- Cards -->
<div class="cards">
    <button class="scroll prev-btn"><i class="bi bi-caret-left-fill"></i></button>
    <div class="card-wrapper">
    <?php
    while ($query -> have_posts()):
        $query -> the_post();

        // Get features and the genre to filter books
        $features = get_field('features') ? get_field('features') : array();
        $genre = get_field('genre');
        
        // Get ACF fields
        $fields = get_fields();

        // In archive page, the slug means the book's category
        $queried_object = get_queried_object();
        $slug = $queried_object->slug;

        // Only display a book for sales
        if (!empty($features) && $fields['for_sales']): 
            foreach ($features as $feature):

                if ((!is_archive() && $feature -> slug === $feature_type) || (is_archive() && $feature -> slug === $feature_type && (!$genre || $genre -> slug === $slug))):
                        // Indicate that a related feature is found
                        $found_related = true;
                        ?>
                        <a href="<?php echo wp_kses_post(get_permalink($query-> post -> ID)); ?>">
                            <div class="card book">
                                <div class="card-heading">
                                    <img class="card-thumbnail" src="<?php echo wp_kses_post($fields['image']['url']); ?>" alt="<?php echo wp_kses_post($fields['title']); ?>">
                                </div>
                                <div class="card-body">
                                    <h6 class="card-title card-box"><?php echo wp_kses_post($fields['title']); ?></h6>
                                    <div class="card-content">
                                        <p class="card-tags card-box"><?php echo wp_kses_post($genre -> name); ?></p>
                                        <div class="card-rate card-box">
                                            <?php
                                            // Loop 5 times, if the rate is greater than $i, display a star shape.
                                            $rate = $fields['rate'];
                
                                            for ($i = 1; $i <= 5; $i++): 
                                                // If the rate is an integer, display a full star shape
                                                if ($i <= $rate):
                                            ?>
                                                <i class="bi bi-star-fill"></i>
                                                
                                                <?php
                                                // If the rate is a float, display a half star shape
                                                // Assume that $i is looped to 5 and $rate is 4.5, $i - 0.5 must be greater or equal to 4.5
                                                // It determines whether the last star should be a full or half shape. 
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
                                        // Assume that the price is an integer, decimal point will be presented to 00.
                                        $price = $fields['price'];
                                        $decimal_point = '00';
                                        
                                        // xplode the price to two part. For instance, 12.45 => '12', '45', then convert to an array.
                                        $digits = explode('.', $price);
                                        
                                        if (count($digits) > 1):
                                            // Replace decimal_point to $digits[1] (decimal point)
                                            $decimal_point = $digits[1]; 
                                        endif;
                
                                        echo '$' . wp_kses_post($digits[0]) . '.<span class="card-decimal">' . wp_kses_post($decimal_point) . '</span>';
                                        ?>
                                        </p>
                                    </div>
                                    <button class="add-to-cart card-box">Add to Cart</button>
                                </div>
                            </div>
                        </a>      
                        <?php
                    endif;
            endforeach;
        endif;
    endwhile;
    ?>
        
    </div>
    <button class="scroll next-btn"><i class="bi bi-caret-right-fill"></i></button>
    <?php
    /**
     * If no related book returns
     */
    if (!$found_related):
        echo wp_kses_post('<h2 class="not-found-display">Oop! No ' . str_replace('-', ' ', $feature_type) . ' yet!</h2>');
    endif;
    ?>
</div>
