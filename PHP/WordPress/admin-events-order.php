<?php

/**
 * Orders the 'wp_events' post type by date in ascending order in the admin area
 * for posts with the 'future' status, if the 'orderby' parameter is not set in the URL.
 *
 * @param WP_Query $query The current WP_Query object, passed by reference.
 *
 * @hook pre_get_posts
 *
 * @return void
 */
function order_wp_events_by_date_asc_admin($query) {
    // Check if it's an admin query, the main query, if it's querying 'wp_events' post type, and if the post status is 'future'
    if (is_admin() && $query->is_main_query() && $query->get('post_type') == 'wp_events' && $query->get('post_status') == 'future' && !isset($_GET['orderby'])) {
        // Set the order and orderby parameters
        $query->set('orderby', 'date'); // Order by the default date column
        $query->set('order', 'ASC');   // For descending order
    }
}
add_action('pre_get_posts', 'order_wp_events_by_date_asc_admin');

?>