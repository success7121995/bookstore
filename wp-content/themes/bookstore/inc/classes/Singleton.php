<?php
/**
 * Singleton
 * 
 * @package Bookstore
 * 
 * Restrict the instantiation of a class to a single object
 * Each class can ony be instantated once across the project
 */

trait Singleton {
    // The array is set to static since the method will be activated several of times depending on how many classes we have
    // Instantiated class will append to the array
    private static $instance = [];

    final public static function get_instance() {
        $called_class = get_called_class();
        
        // If the class is existed in the arry, that means it is already instantiated.
        // Otherwise, instantiate a class and append to the array
        if (!isset(self::$instance[$called_class])):
            self::$instance[$called_class] = new $called_class();
        endif;
        
        // Return new Class
        return self::$instance[$called_class];
    }
}