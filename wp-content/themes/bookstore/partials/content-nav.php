<?php
/**
 * Content Nav Menu
 * 
 * @package Bookstore
 */
// Check if cookie is set
$isset_cookie = isset($_COOKIE["AuthnUser"]) ? $_COOKIE["AuthnUser"] : null;

// Globalize to enable the function of retrieving data from the database
global $wpdb;

// Will not show the entire navbar in login and signup page
if (!is_page('login') && !is_page('signup')):
?>
<!-- Topnav Header -->
<nav id="topnav-header">
    <div class="navbar container">
        <div class="nav-item">
            <p>Tel: 123-456-789</p>
        </div>
        <div class="nav-item">
            <a class="nav-link" href="#">Service</a>
            
<?php
            if(!$isset_cookie):
?>
                <a class="nav-link" href="<?php echo wp_kses_post(get_site_url()) . '/login';?>">Login</a>
<?php           
            endif;
?>
        </div>
    </div>
</nav>

<!-- Topnav Footer -->
<nav id="topnav-footer">
    <div class="navbar container">
<?php
        // Get custom logo
        echo wp_kses_post(get_custom_logo());
?>
        <form id="search-box" class="search-form">
            <input type="text">
            <button id="search-btn"><i class="bi bi-search"></i></button>
        </form>
    </div>
    <div id="topnav-nav">
        <div class="navbar container navbar-toggler-wrapper">
            <button class="navbar-toggler" data-target="navbar-nav">
                <i class="bi bi-list"></i>
            </button>
        </div>
<?php
        wp_nav_menu(array(
            'menu' => 'topnav',
            'menu_id' => 'navbar-nav',
            'menu_class' => 'navbar-nav',
            'container' => 'ul',
            'walker' => new Walker_Topnav
        ));
?>
    </div>
</nav>
<?php
else:
?>
    <div style="text-align: center; width: 100%; margin-top: 75px; margin-bottom: 30px;"><?php echo get_custom_logo(); ?></div>
<?php
endif;