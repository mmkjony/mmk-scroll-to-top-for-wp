<?php
/**
 * Plugin Name:  MMK Scroll To Top
 * Plugin URI:   https://github.com/mmkjony/mmk-scroll-to-top-wp-plugin
 * Description:  A super simple, highly customizable and light-weight plugin that adds a smooth Scroll back to top button to your wordpress site.
 * Version:      1.0.0
 * Author:       MMK Jony
 * Author URI:   http://mmkjony.github.io/
 * License: GPLv2 or later
 *
/**
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2016, MMK Jony.
**/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
{
    exit;
}

// Set the constants for the plugin.
define( 'MMK_TOTOP_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'MMK_TOTOP_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'MMK_TOTOP_INCLUDES', MMK_TOTOP_PLUGIN_PATH . '/inc' );
define( 'MMK_TOTOP_ASSETS', MMK_TOTOP_PLUGIN_URL . '/assets' );

// Includes the main plugin functions
require_once( MMK_TOTOP_INCLUDES . '/functions.php' );
// Includes functions for the admin settings page
if ( is_admin() ) {
    require_once( MMK_TOTOP_INCLUDES . '/settings.php' );
}
