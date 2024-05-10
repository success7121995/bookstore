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
    'paged' => $paged
));

// get the custom sidebar
$custom_sidebar = new Custom_Sidebars();
$sidebar = $custom_sidebar -> render_sidebar();

get_header();
?>
<div id="archive" class="container main-content">
    <aside><?php echo wp_kses_post($sidebar); ?></aside>
<?php
if ($query -> have_posts()):
    while ($query -> have_posts()):
        $query -> the_post();
        get_template_part('template-parts/card', null, array('query' => $query));
    endwhile;

    // Pagination
    echo paginate_links(array(
        'total' => $query->max_num_pages,
        'current' => $paged
    ));
endif;
?>
</div>

<?php
get_footer();
