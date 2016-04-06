<?php
/**
 * Main functions for the plugin.
 *
 * @package    MMK_Scroll_To_Top
 * @since      1.0.0
 * @author     MMK Jony
 * @copyright  Copyright (c) 2016, MMK Jony
 * @license    GPLv2 or later
 **/

// Set default values for the plugin.
function mmk_totop_default_values()
{
    $default_values = array(
        'mmk_totop_enable'      => '1',
        'mmk_totop_autohide'    => '1',
        'mmk_totop_offset'      => '420',   //px (from top)
        'mmk_totop_speed'       => '500',   //ms
        'mmk_totop_right'       => '15',    //px
        'mmk_totop_bottom'      => '30',    //px
        'mmk_totop_padding'     => '5px',   //css format
        'mmk_totop_html'        => 'Top &uarr;',
        'mmk_totop_color'       => '#ffffff',
        'mmk_totop_bg_color'    => '#444444',
        'mmk_totop_class'       => ''
    );

    return $default_values;
}

// Get quick settings values
function mmk_totop_options( $option = '' )
{
    $options = get_option( 'mmk_totop_plugin_settings', mmk_totop_default_values() );

    if($option != '')
    {
        return $options[$option];
    }
    return $options;
}

// Enqueue scripts for this plugin
function mmk_totop_enqueue_scripts()
{
    // Get the enable option.
    $enable  = mmk_totop_options( 'mmk_totop_enable' );

    if( $enable == '1' )
    {
        // Load the jQuery.totop() plugin.
        wp_enqueue_script( 'mmk-jquery-to-top', MMK_TOTOP_ASSETS . '/js/jquery.toTop.min.js', array( 'jquery' ), null, true );
    }

}
add_action( 'wp_enqueue_scripts', 'mmk_totop_enqueue_scripts' );

// Load the button's html
function mmk_totop_btn_html()
{
    // Required values
    $enabled    = mmk_totop_options( 'mmk_totop_enable' );
    $html       = mmk_totop_options( 'mmk_totop_html' );
    $class      = mmk_totop_options( 'mmk_totop_class' );
    $color      = mmk_totop_options( 'mmk_totop_color' );
    $bg_color   = mmk_totop_options( 'mmk_totop_bg_color' );
    $padding    = mmk_totop_options( 'mmk_totop_padding' );

    if($enabled == 1)
    {
        echo '<!-- MMK Scroll to top button -->' . "\n" . '<button id="mmk-toTop" class="' . $class . '" style="color: ' . $color . '; background-color: ' . $bg_color . '; padding: ' . $padding . '; border: 0; outline: 0">' . $html . '</button>' . "\n";
    }
}
add_action( 'wp_footer', 'mmk_totop_btn_html' );

// Initialize the jquery plugin
function mmk_totop_plugin_init()
{
    // Get the settings values
    $options = mmk_totop_options();

    echo '
		<script id="mmk-toTop-custom-js">
		var $ = jQuery.noConflict();
		$(document).ready(function(){
			$("#mmk-toTop").toTop({
				autohide: '.$options['mmk_totop_autohide'].',
                offset: '.$options['mmk_totop_offset'].',
                speed: '.$options['mmk_totop_speed'].',
                right: '.$options['mmk_totop_right'].',
                bottom: '.$options['mmk_totop_bottom'].'
			});
		});
		</script>' . "\n";
}
add_action( 'wp_footer', 'mmk_totop_plugin_init' );
