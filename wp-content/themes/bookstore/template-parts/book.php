<?php
/**
 * Single Book Template
 * 
 * @package Bookstore
 */

// Check if $query has been set
$query = isset($args['query']) ? $args['query'] : null;

// Get specific book's ACF field by ID
$id = $query -> post -> ID;
$field = get_fields($id);

echo $id;

// Redefine all fields
$title = $query -> post -> post_title;
$content = $query -> post -> post_content;
$permalink = get_permalink($query -> post -> ID);
$image = $field['image']['url'];
$author = $field['author'];
$isbn = $field['isbn'];
$rate = $field['rate'];
$price = $field['price'];
$decimal_point = '00';

// Get the genre by object ID then return an array contained WP_Term_Object. Then get the genre name from the object.
$genre = get_the_terms(get_the_ID(), 'genre')[0] -> name;
?>

<div class="single-heading">
    <img class="single-thumbnail" src="<?php echo wp_kses_post($image); ?>" alt="<?php echo wp_kses_post($title); ?>">
    <div style="display: flex; flex-direction: column; justify-content: space-between;">
        <div>
            <h4 class="single-title single-box"><?php echo wp_kses_post($title); ?></h4>
            <p class="single-author single-box">By <?php echo wp_kses_post($author); ?></p>
            <p class="single-tags single-box"><?php echo wp_kses_post($genre); ?></p>
            <p class="single-isbn single-box">ISBN: <?php echo wp_kses_post($field['isbn']); ?></p>
        </div>
        <div class="single-heading-content-container">
            <div>
                <div class="btn-group">
                <i id="add-to-wishlist" class="bi bi-heart icon-btn" data-tab="<?php echo $id; ?>"></i>
                <i id="share-link" class="bi bi-share icon-btn"></i>
                </div>
                <p class="single-price">
<?php           
                // Explode the price to two part. For instance, 12.45 => '12', '45', then convert to an array.
                $digits = explode('.', $price);
                
                if (count($digits) > 1):
                    // Replace decimal_point to $digits[1] (decimal point)
                    $decimal_point = $digits[1]; 
                endif;

                echo '$' . wp_kses_post($digits[0]) . '.<span class="single-decimal">' . wp_kses_post($decimal_point) . '</span>';
?>
                </p>
                <div class="single-rate">
<?php
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
            </div>
            <div>
                <button class="add-to-cart" data-value="<?php echo $id; ?>">Add to Cart</button>
            </div>
        </div>
    </div>
</div>
<div class="single-body">
    <h3>Description</h3>
    <article><?php echo wp_kses_post($content); ?></article>
</div>