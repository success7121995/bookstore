<?php
/**
 * Autoloader
 * 
 * @package Bookstore
 */

spl_autoload_register(function($class) {
    /**
     * Locate the file in /inc/classes/, the file name must be same as the class name.
     */
    $file = get_template_directory() . '/inc/classes/' . str_replace('\\', '/', $class) . '.php';
    
    /**
     * Check if the file exists, load the existed file otherwise skip it.
     */
    if (file_exists($file)):
        require_once $file;

    else:  return;
    endif;
});
?>