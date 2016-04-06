<?php
/**
 * Uninstall procedure for the plugin.
 *
 * @package    MMK_Scroll_To_Top
 * @since      1.0.0
 * @author     MMK Jony
 * @copyright  Copyright (c) 2016, MMK Jony
 * @license    GPLv2 or later
 **/

// If uninstall not called from WordPress exit.
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) )
	exit();

// Delete plugin settings
delete_option( 'mmk_totop_plugin_settings' );
