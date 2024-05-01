<?php
/**
 * Custom_Themes
 * 
 * @package Bookstore
 * 
 * This class is used to registers theme support for a given feature.
 * Menu registration is also included.
 */
class Custom_Themes {
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
        add_action('after_setup_theme', [$this, 'register_custom_widgets']);
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
     * This function enables and registers nav menu locations for a theme
     */
    public function register_custom_menus() {
        /**
         * Array of nav menu locations, add custom menus here
         */
        $location = array(
            'topnav' => __('Topnav', 'Bookstore'),
            'get-to-know-us' => __('Get To Know Us', 'Bookstore'),
            'help' => __('Help', 'Bookstore'),
            'legal' => __('Legal', 'Bookstore'),
            'follow-us' => __('follow Us', 'Bookstore'),
            'payment-methods' => __('Payment Methods', 'Bookstore'),
        );

        register_nav_menus($location);
    }

    /**
     * This function enables and registers custom widgets including sidebar
     */
    public function register_custom_widgets() {
        register_sidebar(array(
            'name'          => 'Category Sidebar',
            'id'            => 'category-sidebar',
            'class'         => '',
        ));
    }
}