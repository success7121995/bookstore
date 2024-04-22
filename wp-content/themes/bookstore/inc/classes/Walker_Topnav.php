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
         * Create 'li' and 'a' class array to iterate classes to class attribute.
         */
        $li_classes = array();
        $a_classes = array();


        /**
         * Check if there is at least one menu item declared.
         */
        if (!empty($item->classes)) {
            $li_classes = $item->classes;

            /**
             * Append 'menu-' . $item->ID and 'nav-item' to the 'li' classes array
             */
            $li_classes[] = 'menu-' . $item->ID;
            $li_classes[] = 'nav-item';

            /**
             * Append 'nav-link' to hhe 'a' classes array
             */
            $a_classes[] = 'nav-link';

            /**
             * if the menu has a sub-menu, also append 'dropdown-toggler' to the array
             */
            if ($args->walker->has_children) {
                $a_classes[] = 'dropdown-toggler';
            }
        }
        
        /**
         * Implode the array elements to strings.
         */
        $li_classes_str = implode(' ', $li_classes);
        $a_classes_str = implode(' ', $a_classes);

        /**
         * Sturcture, assuming that the menu has submenu
         * <li class="menu-item menu-item-type-post_type menu-item-object-page menu-79 nav-item">
         *      <a class="nav-link dropdown-toggler">Item</a>
         * </li>
         */
        $output .= "\n" . $indent . '<li class="' . $li_classes_str . '">'; 
        $output .= "\n" . $indent .'<a class="' . $a_classes_str . '" href="' . $item -> url . '">' . $item -> title . '</a>';
    }

    public function start_lvl(&$output, $depth = 0, $args = array(), $id = 0) {
        $indent = str_repeat("\t", $depth);

        /**
         * Submenu's Structure
         */
        $output .= "\n" . $indent . '<div class="submenu dropdown-menu">';
        $output .= "\n" . $indent . '<ul class="dropdown">';
    }

}