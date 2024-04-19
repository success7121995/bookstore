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
        <div id="" class="navbar container">
            <?php
            /**
             * Get custom logo
             */
            echo get_custom_logo('navbar-brand');
            ?>
            <form class="search-form">
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
            <ul id="navbar-nav" class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li>    
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggler" href="#">Home</a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-item">
                            <a class="dropdown-link" href="#">Test</a>
                        </li>
                        <li class="dropdown-item">
                            <a class="dropdown-link" href="#">Test</a>
                        </li>
                        <li class="dropdown-item">
                            <a class="dropdown-link" href="#">Test</a>
                        </li>
                    </ul>
                </li>    
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggler" href="#">Home</a>
                    <ul class="dropdown-menu">  
                        <li class="dropdown-item">
                            <a class="dropdown-link" href="#">Test</a>
                        </li>
                        <li class="dropdown-item">
                            <a class="dropdown-link" href="#">Test</a>
                        </li>
                        <li class="dropdown-item">
                            <a class="dropdown-link" href="#">Test</a>
                        </li>
                        <li class="dropdown-item">
                            <a class="dropdown-link" href="#">Test</a>
                        </li>
                        <li class="dropdown-item">
                            <a class="dropdown-link" href="#">Test</a>
                        </li>
                    </ul>
                </li>    
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                    <ul></ul>
                </li>    
            </ul>
        </div>
    </nav>