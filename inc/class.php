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

        // dii author page create

        add_submenu_page( 
            'dii-books', 
            'Author', 
            'Author', 
            'manage_options', 
            'dii-authors', 
            'dii_authors', 
            null,
        );

         add_submenu_page( 
            'dii-books', 
            'Add Author', 
            'Add Author', 
            'manage_options', 
            'dii-add-authiurs', 
            'dii_add_authurs', 
            null,
        );

         add_submenu_page( 
            null, 
            'Edit Author', 
            'Edit Author', 
            'manage_options', 
            'dii-edit-author', 
            'dii_edit_author', 
            null,
        );


        //students

        //  add_submenu_page( 
        //     'dii-books',
        //     'Student',
        //     'Student',
        //     'manage_options',
        //     'dii-students',
        //     'all_student_function',
        // );

        // add_submenu_page( 
        //     'dii-books',
        //     'Add Student',
        //     'Add Student',
        //     'manage_options',
        //     'add-student',
        //     'add_student_function',
        // );

        // add_submenu_page( 
        //     null,
        //     'Edit Student',
        //     'Edit Student',
        //     'manage_options',
        //     'edit-student',
        //     'edit_student_function',
        // );
        add_submenu_page( 
            'dii-books',
            'Customar Message',
            'Customar Message',
            'manage_options',
            'customar-message',
            'customar_message_function',
        );




}


// author function page
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


// authors
function dii_authors(){
    require_once 'dii-authors.php';
}

function dii_add_authurs(){
    require_once 'dii-add-author.php';
}

function dii_edit_author(){
    require_once 'dii-edit-author.php';
}


// dii students

function add_student_function(){
    require_once 'dii-add-student.php';

}

function all_student_function(){
    require_once 'dii-students.php';
}

function edit_student_function(){
    require_once 'dii-edit-students.php';
}

function customar_message_function(){
    require_once 'customar-info.php';
}

