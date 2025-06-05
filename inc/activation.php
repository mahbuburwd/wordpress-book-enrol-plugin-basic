<?php 

function activation_functoin_called(){
            global $wpdb;
            $table_name = $wpdb->prefix . 'dii_book';

            // Include the upgrade file for dbDelta()
            require_once ABSPATH . 'wp-admin/includes/upgrade.php';

            $charset_collate = $wpdb->get_charset_collate();

            $sql = "CREATE TABLE $table_name (
                id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                name VARCHAR(255) NOT NULL,
                author VARCHAR(255) NOT NULL,
                about TEXT,
                book_image VARCHAR(255),
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (id)
            ) $charset_collate;";

            dbDelta($sql);
}