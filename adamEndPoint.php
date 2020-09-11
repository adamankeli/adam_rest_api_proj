<?php
/*
  Plugin Name: Adam API Project
  Plugin URI: https://github.com/adamankeli
  Description: This plugin sends an HTTP request to a REST API endpoint and displays the JSON response on a table. 
  Author: Adam Ankeli
  Author URI: https://github.com/adamankeli
  Version:  1.1
  License: GPL3
 */

defined( 'ABSPATH' ) or die();
if (!defined ('ABSPATH')) {
    die;
}

define ( 'WP_DEBUG', false);
define ( 'WP_DEBUG_LOG', false);
define ( 'WP_DEBUG_DISPLAY', false);

define( 'AdamCustomEndpoint__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );



require_once( AdamCustomEndpoint__PLUGIN_DIR . 'class.adamEndPoint.php' );
require_once( AdamCustomEndpoint__PLUGIN_DIR . 'class.adamEndPoint.processRequest.php' );

class MyClass {

    public function addHooks() {
        add_action( 'init', array( 'adamEndPoint', 'init' ) );
        add_action( 'parse_request', array( 'adamEndPoint', 'endpoint' ) , 0);
    }
}

$MyClass = new MyClass();
$MyClass->addHooks();