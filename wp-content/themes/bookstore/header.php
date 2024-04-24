<?php
/**
 * Header
 * 
 * @package Bookstore
 * 
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
    <title><?php esc_html_e(get_the_title()); ?></title>
</head>
<body>

<?php get_template_part('partials/content', 'nav'); ?>