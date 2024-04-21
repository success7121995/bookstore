<?php
/**
 * Add_Theme_Support
 * 
 * @package Bookstore
 * 
 * This class is used to registers theme support for a given feature.
 * Menu registration is also included.
 */
class Add_Themes {
    /**
     * Prevent from multiple instantiations
     */
    use Singleton;

    /**
     * The __construct function is set to private since it is not allowed to instantiate in the public.
     */
    private function __construct() {
        /**
         * Actions
         */
        add_action('after_setup_theme', [$this, 'adding_themes']);
        add_action('after_setup_theme', [$this, 'register_custom_menus']);
    }

    public function adding_themes() {
        /**
         * Array of themes that we want to add to wordpress
         * "string $features" => "$array args" (Optional extra arguments to pass along the feature), default to null.)
         */
        $features = array(
            'custom-logo' => array(),
            'title-tag' => array(),
            'widgets' => array()
        );

        /**
        * loop through the args to activate theme supports
        */
        foreach ($features as $feature => $arg) {         
            add_theme_support($feature, $arg);
        }
    }

    /**
     * This function enables and register nav menu locations for a theme
     */
    public function register_custom_menus() {
        /**
         * Array of nav menu locations, add custom menus here
         */
        $location = array(
            'topnav' => __('Topnav', 'Bookstore'),
            'footer' => __('Footer', 'Bookstore')
        );

        register_nav_menus($location);
    } 
}