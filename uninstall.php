<?php
/**
 *
 */

if (!defined( 'WP_UNINSTALL_PLUGIN')) {
    exit;
}
include_once('includes/class-thehubsa-install.php');

$status_options = get_option('thehubsa_status_options', array());

if (!empty($status_options['uninstall_data'])) {
    global $wpdb;

    // Pages
    wp_trash_post(get_option('thehubsa_test'));
}

# [eof]