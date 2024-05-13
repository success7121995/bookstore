<?php
/**
 * Archive Page
 * 
 * @package Bookstore
 */

// Get the WP_Term_Object to know what taxonomy and term we are looking for on the page
$query_object = get_queried_object();
$term = $query_object -> slug;
$taxonomy = $query_object -> taxonomy;
$heading = $query_object -> name;

// Get the current page number
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$query = new WP_Query(array(
    'post_type' => 'books',
    'tax_query' => array(
        array(
            'taxonomy' => $taxonomy,
            'field' => 'slug',
            'terms' => $term
        )
    ),
    'orderby' => 'title',
    'order' => 'ASC',
    'paged' => $paged
));

// get the custom sidebar
$custom_sidebar = new Custom_Sidebars();
$sidebar = $custom_sidebar -> render_sidebar();

// need an unlikely integer
$big = 999999999;

get_header();
?>
<div id="archive" class="container main-content">
    <aside><?php echo wp_kses_post($sidebar); ?></aside>
<?php
    if ($query -> have_posts()):
?>
    <!-- Cards -->
    <div class="cards archive">
        <h1><?php echo wp_kses_post($heading); ?></h1>
        <div class="card-wrapper">
<?php
        while ($query -> have_posts()):
            $query -> the_post();
            get_template_part('template-parts/card', null, array('query' => $query));
        endwhile;
    endif;
?>
        </div>
    </div>
    <!-- Pagination -->
    <div class="pagination">
<?php
    // Pagination
    echo paginate_links(array(
        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'total' => $query->max_num_pages,
        'current' => $paged,
        'prev_next' => false
    ));
?>
    </div>
</div>

<?php
get_footer();
