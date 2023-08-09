<?php

/**
 * Removes the 'organizer_email' meta value for a specific post and saves the post with the same status.
 *
 * This function retrieves the post with the given ID, checks if it exists, and then clears the 'organizer_email'
 * meta value if it's not already empty. The post is then updated with the same status it had before.
 *
 * @param int $post_id The ID of the post whose 'organizer_email' meta value needs to be removed.
 *
 * @return void Outputs a success message if the meta value is cleared, or an error message if the post does not exist.
 * 
 * @author Semir Smajlovic
 */
function remove_organization_email($post_id) {
    $post = get_post($post_id);
    if ($post) {
        $post_status = $post->post_status;
        $organizer_email = get_post_meta($post_id, 'organizer_email', true);
        if ($organizer_email !== '') {
            update_post_meta($post_id, 'organizer_email', '');
        }
        $post->post_status = $post_status;
        echo 'Hello, the organizer_email meta value has been cleared and the post has been saved with the same status.';
    } else {
        echo 'Hello, the post with the given ID does not exist.';
    }
}

?>