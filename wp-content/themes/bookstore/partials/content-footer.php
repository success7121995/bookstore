<?php
/**
 * Content Footer
 * 
 * @package Bookstore
 */

function render_footer($menu_name, $menu_id, $menu_class) {
    wp_nav_menu(array(
        'menu' => $menu_name,
        'menu_id' => $menu_id,
        'menu_class' => $menu_class,
        'container' => 'ul',
        'walker' => new Walker_Footer()
    ));
}
?>

<footer>
    <div id="top-footer" class="top-footer">
        <div class="container">
            <div class="footer-wrapper">
                <h4>Get To Know Us</h4>
                <?php render_footer('get-to-know-us', 'get-to-know-us', 'footer-nav', 'ul'); ?>
            </div>
            <div id="help" class="footer-wrapper">
                <h4>Help</h4>
                <?php render_footer('help', 'help', 'footer-nav', 'ul'); ?>
            </div>
            <div id="legal" class="footer-wrapper">
                <h4>Legal</h4>
                <?php render_footer('legal', 'legal', 'footer-nav', 'ul'); ?>
            </div>
            <div class="footer-wrapper">
                <div id="follow-us">
                    <h4>Follow Us</h4>
                    <?php render_footer('follow-us', 'follow-us', 'footer-nav footer-flex-rows', 'ul'); ?>
                </div>
                <div id="payment-method">
                    <h4>Payment Method</h4>
                    <?php render_footer('payment-methods', 'payment-methods', 'footer-nav footer-flex-rows', 'ul'); ?>
                </div>
            </div>
        </div>
    </div>
    <div id="second-footer" class="second-footer">
        <div class="container">
            <p>Copyright &copy; <?php echo wp_kses_post(date('Y')); ?>. All Rights Reserved</p>
        </div>
    </div>
</footer>