<?php
/**
 * Plugin Name:     	Admission list Table
 * Plugin URI:      	http://xxx.in/
 * Description:     	This plugin have been developed to learn Admission list Table concept in wordpress.
 * Version:         	1.0
 * Author:          	http://xxx.in/
 * Author URI:      	http://xxx.in/
 * Text Domain:     	admission-list-table
 */

if( ! defined( 'ABSPATH' ) ) exit;

define( 'WLT_DIR', plugin_dir_path ( __FILE__ ) );
define( 'WLT_INCLUDES_DIR', trailingslashit ( WLT_DIR . 'includes' ) );
define( 'WLT_TEXT_DOMAIN', 'admission-list-table' );


if ( !defined( 'ABSPATH' ) ){
    die('Un-authorized access!');
}

global $wpdb;
/**
 * Add Admission list Table admin menu
 */
add_action( 'admin_menu', 'wlt_create_admin_menu' );

function wlt_create_admin_menu() {

    add_menu_page( 
        __( 'Admission list Table', WLT_TEXT_DOMAIN ), 
        __( 'Admission list Table', WLT_TEXT_DOMAIN ), 
        'read', 
        'admission-list-table', 
        'wlt_create_admin_menu_cb', 
        'dashicons-email-alt', 
        2 
    );
}


/**
 * Admission list Table menu page data/content
 */
function wlt_create_admin_menu_cb() {

    if( file_exists( WLT_INCLUDES_DIR . 'wp-list-table-data.php' ) ) {

        require_once WLT_INCLUDES_DIR . 'wp-list-table-data.php';
    }
}




if ( !defined( 'ABSPATH' ) ) exit;

// Act on plugin activation
register_activation_hook( __FILE__, "activate_myplugin" );

// Act on plugin de-activation
register_deactivation_hook( __FILE__, "deactivate_myplugin" );

// Activate Plugin
function activate_myplugin() {

    // Execute tasks on Plugin activation

    // Insert DB Tables
    init_db_myplugin();
}

// De-activate Plugin
function deactivate_myplugin() {

    // Execute tasks on Plugin de-activation
}


function init_db_myplugin() {

    // WP Globals
    global $table_prefix, $wpdb;

    // admission Table
    $admissionTable = $table_prefix . 'admission';

    // Create admission Table if not exist
    if( $wpdb->get_var( "show tables like '$admissionTable'" ) != $admissionTable ) {

        // Query - Create Table
        $sql = "CREATE TABLE `$admissionTable` (";
        $sql .= " `id` int(11) NOT NULL auto_increment, ";
        $sql .= " `fname` varchar(500) NOT NULL, ";
        $sql .= " `email` varchar(500) NOT NULL, ";
        $sql .= " `phone_no` varchar(500) NOT NULL, "; 
        $sql .= " `center` varchar(500) NOT NULL, ";
        $sql .= " `courses` varchar(500) NOT NULL, ";
        $sql .= " `address` varchar(500), ";
                $sql .= " `qualification` varchar(500) NOT NULL, ";
                $sql .= " `aadharNum` varchar(500) NOT NULL, ";
                $sql .= " `upload_aadhar` varchar(500) NOT NULL, ";
                $sql .= " `Dob` varchar(500) NOT NULL, ";

        $sql .= " `message` varchar(500) NOT NULL, ";
        $sql .= " `ad_date` varchar(500) NOT NULL, ";
     
        $sql .= " PRIMARY KEY `admission_id` (`id`) ";
        $sql .= ") ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;";

        // Include Upgrade Script
        require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
    
        // Create Table
        dbDelta( $sql );
    }

}
