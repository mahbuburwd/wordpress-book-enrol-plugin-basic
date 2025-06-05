<?php

        add_action('admin_menu','dii_admin_menu_function');

     function dii_admin_menu_function() {
        add_menu_page( 
            'Books',
            'Books',
            'manage_options',
            'dii-books',
            'all_book_function',
            'dashicons-admin-site'
        );

        add_submenu_page( 
            'dii-books',
            'Books',
            'Books',
            'manage_options',
            'dii-books',
            'all_book_function',
        );

        add_submenu_page( 
            'dii-books',
            'Add Book',
            'Add Book',
            'manage_options',
            'add-books',
            'add_book_function',
        );

        add_submenu_page(
            null,                    
            'Edit Book',            
            'Edit Book',            
            'manage_options',       
            'edit-book',           
             'edit_book_function',
        );



}

 function all_book_function(){

        // ✅ Then load the template
        require_once 'all-books.php';
    }

function add_book_function() {
        require_once 'add-new.php';
    }

function edit_book_function() {
        require_once 'edit-book.php';
}



