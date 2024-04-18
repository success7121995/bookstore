<?php
/**
 * Add_Theme_Support
 * 
 * @package Bookstore
 * 
 * This class is used to Registers theme support for a given feature.
 */
class Add_Themes {
    /**
     * Prevent from multiple instantiations
     */
    use Singleton;

    /**
     * Array of themes we want to add to wordpress
     * "string $features" => "$array args" (Optional extra arguments to pass along the feature), default to null.)
     */
    private $features = array(
        'custom-logo' => array(),
        'title-tag' => array(),
        'widgets' => array()
    );

    /**
     * The __construct function is set to private since it is not allowed to instantiate in in public.
     */
    private function __construct() {
        /**
         * Actions
         */
        add_action('after_setup_theme', [$this, 'adding_themes']);
    }

    /**
     * loop through the args to activate theme supports
     */
    public function adding_themes() {
        foreach ($this -> features as $feature => $arg) {         
            add_theme_support($feature, $arg);
        }
    }
}