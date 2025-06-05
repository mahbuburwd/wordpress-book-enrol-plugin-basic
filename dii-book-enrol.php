<?php 
/**
 * Plugin Name: Dii Book Online
 * Author: Mahbubur Rahman
 * Description: This is Book Online plugin
 */

defined('ABSPATH') or die("You can not access this file");

define('PLUGIN_DIR_PATH', plugin_dir_path(__FILE__));



register_activation_hook( __FILE__,  'activation_functoin_called');

require_once PLUGIN_DIR_PATH.'/inc/activation.php';

require_once PLUGIN_DIR_PATH.'/inc/class.php';








// add style sheed
add_action( 'admin_enqueue_scripts', 'dii_book_admin_scripts');

function dii_book_admin_scripts() {
    wp_enqueue_style('dii-book-bootstrap-css', plugins_url('/assets/css/bootstraps.css', __FILE__));
    wp_enqueue_style('dii-book-style-css', plugins_url('/assets/css/style.css', __FILE__));

      wp_enqueue_media();

    wp_enqueue_script('dii-book-media-upload', plugins_url('/assets/js/media-upload.js', __FILE__), ['jquery'], null, true);

    wp_enqueue_script('dii-custom-script', plugins_url('/assets/js/custom.js', __FILE__), ['jquery'], null, true);
}


include_once(__DIR__.'/inc/delete-book.php');
