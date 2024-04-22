<?php
/**
 * Header
 * 
 * @package Bookstore
 * 
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
    <title><?php echo get_the_title(); ?></title>
</head>
<body>
    <!-- Topnav Header -->
    <nav id="topnav-header">
        <div class="navbar container">
            <div class="nav-item">
                <p>Tel: 123-456-789</p>
            </div>
            <div class="nav-item">
                <a class="nav-link" href="#">Service</a>
                <a class="nav-link" href="#">Login</a>
            </div>
        </div>
    </nav>

    <!-- Topnav Footer -->
    <nav id="topnav-footer">
        <div id="" class="navbar container">
            <?php
            /**
             * Get custom logo
             */
            echo get_custom_logo('navbar-brand');
            ?>
            <form id="search-box" class="search-form">
                <input type="text">
                <button><i class="bi bi-search"></i></button>
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
                'theme_location' => 'primary',
                'walker' => new Walker_Topnav
            ));
            ?>
        </div>
    </nav>
