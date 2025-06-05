<?php
add_action('admin_post_dii_delete_book', 'dii_handle_book_delete');

function dii_handle_book_delete() {
    if (!current_user_can('manage_options')) {
        wp_die('Unauthorized user');
    }

    if (!isset($_GET['id']) || !isset($_GET['_wpnonce'])) {
        wp_die('Invalid request');
    }

    $book_id = intval($_GET['id']);

    if (!wp_verify_nonce($_GET['_wpnonce'], 'delete_book_' . $book_id)) {
        wp_die('Security check failed');
    }

    global $wpdb;
    $table_name = $wpdb->prefix . 'dii_book';

    $deleted = $wpdb->delete($table_name, ['id' => $book_id], ['%d']);

    wp_redirect(admin_url('admin.php?page=dii-books&deleted=' . ($deleted ? '1' : '0')));
    exit;
}