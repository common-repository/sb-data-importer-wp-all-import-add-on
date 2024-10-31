<?php
 /**
	* Plugin Name: SB data importer - WP all import add-on
	* Plugin URI: https://themeforest.net/item/adforest-classified-wordpress-theme/19481695
	* Description: Import your data into scriptsbundle themes.
	* Version: 1.5.0
	* Author: Scripts Bundle
	* Author URI: https://themeforest.net/user/scriptsbundle/
	* License: GPL2
	* Text Domain: sb-data-importer
 **/


include "rapid-addon.php";
include "functions.php";

$my_theme = wp_get_theme();
$theme_name	=	$my_theme->get( 'Name' );

if( $theme_name == 'adforest' || $theme_name == 'adforest child' )
{
	include "adforest/adforest.php";
}
	
if( $theme_name == 'DWT Listing' || $theme_name == 'DWT Listing Child' )
	include "dwt/dwt.php";
	
if( $theme_name == 'Nokri' || $theme_name == 'Nokri Child' )
	include "nokri/nokri.php";

if( $theme_name == 'carspot' || $theme_name == 'carspot child' )
	include "carspot/carspot.php";


// Load text domain
add_action( 'plugins_loaded', 'sb_all_import_load_plugin_textdomain' );
function sb_all_import_load_plugin_textdomain()
{
	load_plugin_textdomain( 'sb-data-importer', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
}

