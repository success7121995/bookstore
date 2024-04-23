<?php
/**
 * Content Footer
 * 
 * @package Bookstore
 */
?>
    <footer>
        <div id="top-footer" class="top-footer">
            <div class="container">
                <div class="footer-wrapper">
                    <h4>Get To Know Us</h4>
                    <?php
                    wp_nav_menu(array(
                        'menu' => 'get-to-know-us',
                        'menu_id' => 'get-to-know-us',
                        'menu_class' => 'footer-nav',
                        'container' => 'ul',
                        'walker' => new Walker_Footer()
                    ));
                    ?>
                </div>
                <div id="help" class="footer-wrapper">
                    <h4>Help</h4>
                    <?php
                    wp_nav_menu(array(
                        'menu' => 'help',
                        'menu_id' => 'help',
                        'menu_class' => 'footer-nav',
                        'container' => 'ul',
                        'walker' => new Walker_Footer()
                    ));
                    ?>
                </div>
                <div id="legal" class="footer-wrapper">
                    <h4>Legal</h4>
                    <?php
                    wp_nav_menu(array(
                        'menu' => 'legal',
                        'menu_id' => 'legal',
                        'menu_class' => 'footer-nav',
                        'container' => 'ul',
                        'walker' => new Walker_Footer()
                    ));
                    ?>
                </div>
                <div class="footer-wrapper">
                    <div id="follow-us">
                        <h4>Follow Us</h4>
                        <?php
                        wp_nav_menu(array(
                            'menu' => 'follow-us',
                            'menu_id' => 'follow-us',
                            'menu_class' => 'footer-nav footer-flex-rows',
                            'container' => 'ul',
                            'walker' => new Walker_Footer()
                        ));
                        ?>
                    </div>
                    <div id="payment-method">
                        <h4>Payment Method</h4>
                        <?php
                        wp_nav_menu(array(
                            'menu' => 'payment-methods',
                            'menu_id' => 'payment-methods',
                            'menu_class' => 'footer-nav footer-flex-rows',
                            'container' => 'ul',
                            'walker' => new Walker_Footer()
                        ));
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div id="second-footer" class="second-footer">
            <div class="container">
                <p>Copyright &copy; <?php echo date('Y'); ?>. All Rights Reserved</p>
            </div>
        </div>
    </footer>