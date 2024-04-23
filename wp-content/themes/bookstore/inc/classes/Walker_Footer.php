<?php
/**
 * Walker_TVertical_Footer
 * 
 * @package Bookstore
 * 
 * Custom vertical footer's structure
 */
class Walker_Footer extends Walker_Nav_Menu {
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
         * To maintain the layout consistency, no submenu registration is allowed.
         * If the $depth exceeds 1, it indicates that a submenu is registered, which will not be displayed.
         */
        if ($depth < 1):

            /**
             * Check if there is at least one menu item registered.
             */
            if (!empty($item -> classes)):
                $li_classes = $item->classes;

                /**
                 * Append 'menu-' . $item->ID and 'nav-item' to the 'li' classes array
                 */
                $li_classes[] = 'menu-' . $item->ID;
                $li_classes[] = 'nav-item';
                
                /**
                 * Implode the array elements to strings.
                 */
                $li_classes_str = implode(' ', $li_classes);
                
                /**
                 * Sturcture:
                 * <li class="menu-item menu-item-type-post_type menu-item-object-page menu-79 nav-item">
                 *      <a class="nav-link">Item</a>
                 * </li>
                 */
                $output .= "\n" . $indent . '<li class="' . $li_classes_str . '">';
                $output .= "\n" . $indent . '<a class="nav-link" href="' . $item -> url . '">' . $item -> title . '</a>';

            endif;
        endif;
    }
}