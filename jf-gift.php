<?php
/**
* Plugin Name: Regala una sesión
* Description: Plugin utilizado para regalar sesiones de productos simples y variables. Guarda en una sesión a quién quieres regalar un producto y continúa navegando por la tienda sin preocupación.
* Version: 0.6
* Author: JF Desarrollo
* Author URI: https://jfdesarrollo.com/
**/


define( 'JF_DIR', plugin_dir_path( __FILE__ ) );

$gift = isset($_POST['is_gift']);

add_action( 'template_redirect', 'check_if_product' );
function check_if_product() {
    global $post;
    $product = wc_get_product( $post->ID );

    if ( is_product() ) {

        add_action('wp_enqueue_scripts', 'jf_script');
        function jf_script() {
        wp_enqueue_script('validation', plugin_dir_url(__FILE__) .'js/gift-validation.js', array(), false, true);
        wp_enqueue_style( 'gift-style', plugin_dir_url(__FILE__) .'style/gift.css');
        }

        if ( $product->is_type( 'variable' ) ) {
            add_action('wp_enqueue_scripts', 'jf_script_variable');
            function jf_script_variable() {
                wp_enqueue_script('variables', plugin_dir_url(__FILE__) .'js/variations.js',  array(), false, true);
            }
        }

        require(JF_DIR . 'single-button.php');
        require(JF_DIR . 'gift-form.php');
    }
}

require_once(JF_DIR . "validation.php");
require_once(JF_DIR . "display.php");
require_once(JF_DIR . "emails.php");

