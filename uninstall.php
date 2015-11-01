<?php
// If uninstall is not called from WordPress, exit
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit();
}
 
// delete movies post type
global $wpdb;
$wpdb->query( "DELETE FROM {$wpdb->posts} WHERE post_type = 'movies';" );
$wpdb->query( "DELETE FROM {$wpdb->postmeta} meta LEFT JOIN {$wpdb->posts} posts ON posts.ID = meta.post_id WHERE wp.ID IS NULL;" );
