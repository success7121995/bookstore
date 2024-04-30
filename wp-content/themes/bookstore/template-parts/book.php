<?php
/**
 * Single Book Template
 * 
 * @package Bookstore
 */

/**
 * Check if $query has been set
 */
$query = isset($args['query']) ? $args['query'] : null;

/**
 * Grab the ID from $query and get ACF fields by ID
*/
$id = $query -> post -> ID;
$field = get_fields($id);

?>

<div class="single-heading">
    <img class="single-thumbnail" src="<?php echo $field['image']['url']; ?>" alt="<?php echo $field['title']; ?>">
    <div class="single-heading-content">
        <div>
            <h4 class="single-title"><?php echo $field['title']; ?></h4>
            <p class="single-author">By <?php echo $field['author']; ?></p>
            <p class="single-tags"><?php echo $field['tags']; ?></p>
        </div>
        <div>
            <div>
                <div class="btn-group">
                    <a href="#"><i class="bi bi-heart"></i></a>
                    <a href="#"><i class="bi bi-share"></i></a>
                </div>
                <p class="single-price">
                <?php
                /**
                 * Assume that the price is an integer, decimal point will be presented to 00.
                 */
                $price = $field['price'];
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

                echo '$' . $digits[0] . '.<span style="font-size: 12px;">' . $decimal_point . '</span>';
                ?>
                </p>
                <div class="single-rate">
                <?php
                $rate = $field['rate'];

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
            </div>
            <button class="add-to-cart">Add to Cart</button>
        </div>
    </div>
</div>
<div class="single-body">
    <h3>Single Body</h3>
</div>
