<?php
/**
 * Walker_Topnav
 * 
 * @package Bookstore
 * 
 * Custom topnav menu's structure
 */
class Walker_Topnav extends Walker_Nav_Menu {
    /**
     * Prevent from multiple instantiations
     */
    use Singleton;

    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {

        /**
         * The depth level will increase by 1 and produce '\t' characters depending on the depth level at the time. 
         * 
         * For example:
         * 
         * <ul>Menu</ul>
         *      <li>Item</li>
         * </ul>
         */
        $indent = str_repeat("\t", $depth);
    }

}