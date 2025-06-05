<?php

if (!function_exists('deactivation_function_called')) {
    function deactivation_function_called() {
        global $wpdb;

        $book_table    = $wpdb->prefix . 'dii_book';
        $author_table  = $wpdb->prefix . 'dii_author_table';
        $student_table = $wpdb->prefix . 'dii_student_table';

         $message_table = $wpdb->prefix . 'dii_messages';

        // Drop tables
        $wpdb->query("DROP TABLE IF EXISTS $book_table");
        $wpdb->query("DROP TABLE IF EXISTS $author_table");
        $wpdb->query("DROP TABLE IF EXISTS $student_table");
        $wpdb->query("DROP TABLE IF EXISTS $message_table");
    }
}
