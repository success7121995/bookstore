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

        /**
         * Append all preset $item classes to a class array
         */
        $li_classes = empty($item -> classes) ? array() : array($item -> classes);

        /**
         * This array is created for storing classes for 'a' tag.
         */
        $a_classes = array();

        /**
         * 
         */
        if (!$args -> walker -> has_children):
             
        endif;

        $classes[] = !$args -> walker -> has_children ?
            'nav-item':
            array_push($classes, 'nav-item', 'dropdown');

        // $paramlink_classes = array('nav-link', '')




        

        // if (!$args -> walker -> has_children):
        //     $output .= "\n" . $indent . '<li class="nav-item">';
        //     $output .= "\n" . $indent . '<a class="nav-link" href="' . $item -> url . '">' . $item -> title . '</a>';
        // else:
        //     $output .= "\n" . $indent . '<li class="nav-item">';
        //     $output .= "\n" . $indent . '<a class="nav-link dropdown-toggler" href="' . $item -> url . '">' . $item -> title . '</a>';
        // endif;
    }

    public function start_lvl(&$output, $depth = 0, $args = array(), $id = 0) {
        $indent = str_repeat("\t", $depth);

        $output .= "\n" . $indent . '<div class="dropdown-menu">';
        $output .= "\n" . $indent . '<ul class="dropdown-grid">';
    }

}