<?php
/**
 * Content Nav Menu
 * 
 * @package Bookstore
 */

// Check if session is set (if set, it means user logged in)
$session = isset($_SESSION['AuthnUser']) ? $_SESSION['AuthnUser'] : null;

// Connect to database then retrieve the user data if the user is authenticated
if ($session):
    global $wpdb;

    // Find user by ID that stored in session (Set at Custom_Form.php) 
    $user_id = $session;
    $user = $wpdb -> get_results("SELECT * FROM customers WHERE id = $user_id");

    // User data
    $user_prefix = $user[0] -> prefix;
    $user_lname = $user[0] -> lname;
endif;

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
<?php
        if ($session):
            echo '<span>Good Day! ' . $user_prefix . '. ' . $user_lname . '</span>';
        endif;
?>
            <a class="nav-link" href="#">Service</a>
            
<?php
        if (!$session):
?>
            <a class="nav-link" href="<?php echo wp_kses_post(get_site_url()) . '/login';?>">Login</a>
<?php   
        else:
?>
            <a id="logout" class="nav-link" href="<?php echo wp_kses_post(get_site_url()) . '/logout';?>">Logout</a>
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