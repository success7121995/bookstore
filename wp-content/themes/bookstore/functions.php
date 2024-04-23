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
