<?php 
if (!function_exists('activation_function_called')) {
    function activation_function_called() {
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';

        $book_table = $wpdb->prefix . 'dii_book';


        $sql_book = "CREATE TABLE $book_table (
            id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
            name VARCHAR(255) NOT NULL,
            author VARCHAR(255) NOT NULL,
            about TEXT,
            book_image VARCHAR(255),
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id)
        ) $charset_collate;";

        $author_table = $wpdb->prefix . 'dii_author_table';
        $sql_author = "CREATE TABLE $author_table (
            id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
            name VARCHAR(255) NOT NULL,
            links TEXT,
            about TEXT,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id)
        ) $charset_collate;";

        $student_table = $wpdb->prefix . 'dii_student_table';
        $sql_student = "CREATE TABLE $student_table (
            id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            user_login_id BIGINT(20) UNSIGNED,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id)
        ) $charset_collate;";


    // front end

        $message_table = $wpdb->prefix . 'dii_messages';
        $sql_message = "CREATE TABLE $message_table (
            id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
            book_id BIGINT(20) UNSIGNED NOT NULL,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            phone VARCHAR(20) NOT NULL,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id)
        ) $charset_collate;";

        dbDelta($sql_message);

        dbDelta($sql_book);
        dbDelta($sql_author);
        dbDelta($sql_student);


        //dynamic page createion while activation the plugin

        // Create "My Books" page if it doesn't already exist
        $existing_page = get_page_by_path('my-books');

        if (!$existing_page) {
            $page_data = [
                'post_title'   => 'My Books',
                'post_name'    => 'my-books',
                'post_content' => '[dii_books_table]', // The shortcode
                'post_status'  => 'publish',
                'post_type'    => 'page',
            ];

            wp_insert_post($page_data);
        }
    }
}



