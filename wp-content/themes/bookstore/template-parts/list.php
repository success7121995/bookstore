<?php
/**
 * List for Favorites, Cart and Orders
 * 
 * @package Bookstore
 */

// Check if $query has been set
$list = isset($args['list']) ? $args['list'] : null;

// Convert the JSON object to an array
$list_decode = json_decode($list, true); 

// Loop through IDs to retrieve all books
foreach ($list_decode['id'] as $id):
    $field = get_fields($id);

    $db_query = $wpdb -> prepare("SELECT post_title FROM wp_posts WHERE ID = $id");
    $query = $wpdb -> get_results($db_query);

    // print_r($query);
    // Redefine all fields
    $title = $query[0] -> post_title;
    $image = $field['image']['url'];

    echo $title . "<br>";

endforeach;