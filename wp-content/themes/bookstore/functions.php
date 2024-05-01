<?php
/**
 * Functions
 * 
 * @package Bookstore
 */

/**
 * Autoloader will iterate and include all Classes in inc/classes at once.
 */
require_once __DIR__ . '/inc/helpers/autoloader.php';

/**
 * Register and enqueue scripts and stylesheets
 */
Register_Scripts_Style::get_instance();

/**
 * Add theme support
 */
Custom_Themes::get_instance();

/**
 * Custom topnav menu
 */
Walker_Topnav::get_instance();

/**
 * Custom vertical footer menu
 */
Walker_Footer::get_instance();

/**
 * Sidebar
 */
Custom_Sidebars::get_instance();

/**
 * Query posts then format to shortcode for embeding the posts to the webpage's block.
 */
Post_Queries_Card::get_instance();

/**
 * Register post types (This class must be called after the Custom_themes)
 */
Custom_Post_Types::get_instance();