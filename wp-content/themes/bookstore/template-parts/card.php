<?php
/**
 * Card Template
 * 
 * @package Bookstore
 */

// $args is imported from the Post_Queries_Card Class
$query = isset($args['query']) ? $args['query'] : null;

// Get book's ACF fields
$fields = get_fields();

// Redefine all fields
$title = $query -> post -> post_title;
$permalink = get_permalink($query -> post -> ID);
$image = $fields['image']['url'];
$for_sales = $fields['for_sales'];

// Get the genre by object ID then return an array contained WP_Term_Object. Then get the genre name from the object.
$genre = get_the_terms(get_the_ID(), 'genre')[0] -> name;
$rate = $fields['rate'];

// Price value needs to be displayed as XX.00.
// $decimal_point is predefine to '00'. 
// By concatenating the decimal point variable with the price value, we can format the price as XX.00.
$price = $fields['price'];
$decimal_point = '00';

// Indicate that a related book is found
$found_related = true;

// Only display a book for sales
if ($for_sales):
?>
<div class="card book">
    <a href="<?php echo wp_kses_post($permalink); ?>">
        <div class="card-heading">
            <img class="card-thumbnail" src="<?php echo wp_kses_post($image); ?>" alt="<?php echo wp_kses_post($title); ?>">
        </div>
        <div class="card-body">
            <h6 class="card-title card-box"><?php echo wp_kses_post($title); ?></h6>
            <div class="card-content">
                <p class="card-tags card-box"><?php echo wp_kses_post($genre); ?></p>
                <div class="card-rate card-box">
<?php
                // Loop 5 times, if the rate is greater than $i, display a star shape.    
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
                <p class="card-price card-box">
<?php                            
                // Explode the price to two part. For instance, 12.45 => '12', '45', then convert to an array.
                $digits = explode('.', $price);
                
                if (count($digits) > 1):
                    // Replace decimal_point to $digits[1] (decimal point)
                    $decimal_point = $digits[1]; 
                endif;

                echo '$' . wp_kses_post($digits[0]) . '.<span class="card-decimal">' . wp_kses_post($decimal_point) . '</span>';
?>
                </p>
                </div>
            </div>
        </div>
    </a>
    <button class="add-to-cart card-box"> Add to Cart</button>
</div>
<?php
endif;