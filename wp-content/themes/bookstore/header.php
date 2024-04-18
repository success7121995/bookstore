<?php
/**
 * Header
 * 
 * @package Bookstore
 * 
 */
wp_head();
?>
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
        <div class="navbar container">
            <?php
            /**
             * Get custom logo
             */
            echo get_custom_logo('navbar-brand');
            ?>
            <form class="search-form">
                <input type="text">
                <button>Submit</button>
            </form>
        </div>
        <div class="container">
            <i class="bi bi-list"></i>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li>    
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                    <ul></ul>
                </li>    
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                    <ul></ul>
                </li>    
            </ul>
        </div>
    </nav>