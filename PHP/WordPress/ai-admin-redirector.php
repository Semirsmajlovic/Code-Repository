<?php

/**
 * Handles the custom 'ai_update' action in the admin area. If the action is detected,
 * it calls the `remove_organization_email` function with the given post ID and then
 * redirects the user back to the 'wp_events' post listing.
 *
 * @hook admin_action_ai_update
 *
 * @return void
 */
function handle_ai_update_action() {
    if (isset($_GET['action']) && $_GET['action'] == 'ai_update') {
        $post_id = intval($_GET['post_id']);
        $post = get_post($post_id);
        remove_organization_email($post_id);
        if ($post) {
            update_post_content_with_ai($post);
        }
        wp_redirect(admin_url('edit.php?post_type=wp_events'));
        exit;
    }
}
add_action('admin_action_ai_update', 'handle_ai_update_action');

?>