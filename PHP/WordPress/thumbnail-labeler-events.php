<?php

/**
 * Adds specific labels to the post thumbnail HTML in the WordPress admin panel for 'wp_events' post type.
 *
 * This function appends additional information to the content for 'wp_events' post type, 
 * specifying the expected image sizes in various orientations (Square, Landscape, Portrait).
 *
 * @param string $content      The existing HTML content for the post thumbnail.
 * @param int    $post_id      The ID of the post for which the thumbnail is being displayed.
 * @param int    $thumbnail_id The ID of the thumbnail being used.
 *
 * @return string Returns the modified content if the post type is 'wp_events'; otherwise, returns the original content.
 *
 * @author Semir Smajlovic
 */
function swd_admin_post_thumbnail_add_label($content, $post_id, $thumbnail_id)
{
    $post = get_post($post_id);
    if ($post->post_type == 'wp_events') {
				$content .= '<small><i>Square (Same width and height):</i></small><br>';
				$content .= '<small><i>600 x 600, 800 x 800, 1200 x 1200, etc..</i></small>';
				$content .= '<br><br>';
				$content .= '<small><i>Landscape:</i></small><br>';
				$content .= '<small><i>800 x 600, 1200 x 800, 1500 x 1200, etc..</i></small>';
				$content .= '<br><br>';
				$content .= '<small><i>Portrait (4:5):</i></small><br>';
				$content .= '<small><i>800 x 1000, 1200 x 1500, 1500 x 1800, 1080 x 1920, etc..</i></small>';
        return $content;
    }

    return $content;
}
add_filter('admin_post_thumbnail_html', 'swd_admin_post_thumbnail_add_label', 10, 3);

?>