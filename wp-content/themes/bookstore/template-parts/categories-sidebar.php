<?php
/**
 * Sidebar in archive page. It contains a shortcode of genres and custom HTML structure
 * 
 * @package Bookstore
 */

// Check if $query and $genres have been set
$query = isset($args['query']) ? $args['query'] : null;
$genres = isset($args['genres']) ? $args['genres'] : null;
?>

<ul id="sidenav" class="sidenav">
    <?php
    foreach ($genres as $genre):
    ?>

    <li class="nav-item">
        <a class="nav-link" href="<?php echo wp_kses_post(get_site_url() . '/genre/' . $genre -> slug); ?>"><?php echo wp_kses_post($genre -> name); ?></a>
    </li>

    <?php
    endforeach;
    ?>
</ul>
