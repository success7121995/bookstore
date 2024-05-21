<?php
/**
 * Index
 * 
 * @package Bookstore
 */
global $wp_query;

$wp_query -> set_404();
status_header(404);

get_header();
?>
<div id="page-404" class="container main-content">
    <h1>404 Not Found</h1>
</div>

<?php
get_footer();
