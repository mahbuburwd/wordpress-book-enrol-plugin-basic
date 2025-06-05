<?php 
/**
 * Plugin Name: Dii Book Online
 * Author: Mahbubur Rahman
 * Description: This is Book Online plugin
 */

defined('ABSPATH') or die("You can not access this file");

define('PLUGIN_DIR_PATH', plugin_dir_path(__FILE__));



require_once PLUGIN_DIR_PATH . '/inc/activation.php';
require_once PLUGIN_DIR_PATH . '/inc/deactivation.php';

register_activation_hook(__FILE__, 'activation_function_called');
register_deactivation_hook( __FILE__, 'deactivation_function_called' );

require_once PLUGIN_DIR_PATH.'/inc/class.php';








// add style sheed
add_action( 'admin_enqueue_scripts', 'dii_book_admin_scripts');

function dii_book_admin_scripts() {



     wp_enqueue_style('dii-book-bootstrap-css', plugins_url('/assets/css/bootstraps.css', __FILE__));
    wp_enqueue_style('dii-book-style-css', plugins_url('/assets/css/style.css', __FILE__));

      wp_enqueue_media();

    wp_enqueue_script('dii-book-media-upload', plugins_url('/assets/js/media-upload.js', __FILE__), ['jquery'], null, true);


   
}


add_action( 'wp_enqueue_scripts', 'dii_book_admin_scripts_frontend');

function dii_book_admin_scripts_frontend() {
    wp_enqueue_style('dii-book-bootstrap-css-frontend', plugins_url('/assets/css/bootstraps.css', __FILE__));
    wp_enqueue_style('dii-book-style-css-frontend', plugins_url('/assets/css/style.css', __FILE__));

    wp_enqueue_script('dii-bootstrap-frontend', plugins_url('/assets/js/bootstrap.js', __FILE__), ['jquery'], null, true);
    wp_enqueue_script('dii-custom-script-frontend', plugins_url('/assets/js/custom.js', __FILE__), ['jquery'], null, true);

    wp_localize_script('dii-custom-script-frontend', 'dii_ajax_obj', [
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('dii_message_nonce'),
    ]);
}



// all delete function
include_once(__DIR__.'/inc/delete-book.php');

//short code

include_once(__DIR__.'/library/shortcode.php');


add_action('wp_ajax_dii_submit_message', 'dii_handle_message_submission');
add_action('wp_ajax_nopriv_dii_submit_message', 'dii_handle_message_submission');

function dii_handle_message_submission() {
    check_ajax_referer('dii_message_nonce', 'security');

    global $wpdb;
    $table = $wpdb->prefix . 'dii_messages';

    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_email($_POST['email']);
    $phone = sanitize_text_field($_POST['phone']);
    $book_id = intval($_POST['book_id']);

    $wpdb->insert($table, [
        'book_id' => $book_id,
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
    ]);

    wp_send_json_success(['message' => 'Message submitted successfully!']);
}
