<?php

/**
 * Filters the date/time displayed for posts in the 'Date' column on the posts list screen.
 *
 * This custom filter modifies the date format specifically for posts of type 'wp_events'
 * and status 'future'. For these posts, the date format is adjusted to 'F jS, Y at g:iA'.
 *
 * @since [version]     Where [version] is the version number where this function was introduced.
 *
 * @param string   $time Current time string.
 * @param WP_Post  $post The post object.
 * 
 * @return string  Formatted date string. Returns the original time string if the conditions are not met.
 */
add_filter( 'post_date_column_time', static function ( $time, $post ) {
    if ( 'wp_events' !== get_post_type( $post ) || 'future' !== get_post_status( $post ) ) {
        return $time;
    }
    return sprintf(
        __( '%1$s at %2$s' ),
        get_the_time( __( 'F jS, Y' ), $post ),
        get_the_time( __( 'g:iA' ), $post )
    );
}, 10, 2 );

?>