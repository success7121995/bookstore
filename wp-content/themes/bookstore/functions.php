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
Theme_Config::get_instance();