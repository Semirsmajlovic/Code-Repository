<?php

/**
 * Adds a custom "AI Update" link to the row actions for the 'wp_events' post type in the admin area.
 *
 * @param array    $actions An associative array of action names to anchor tags.
 * @param WP_Post  $post    The current post object.
 *
 * @hook post_row_actions
 *
 * @return array   Returns the modified actions array with the "AI Update" link added for 'wp_events' post type.
 */
function add_ai_update_link($actions, $post) {
    if ($post->post_type == 'wp_events') {
        // Add the custom link with a specific action
        $url = admin_url('admin.php?action=ai_update&post_id=' . $post->ID);
        $actions['ai_update'] = '<a href="' . $url . '">' . __('AI Update', 'textdomain') . '</a>';
    }

    return $actions;
}
add_filter('post_row_actions', 'add_ai_update_link', 10, 2);

?>