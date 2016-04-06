<?php
/**
 * Admin settings page for the plugin.
 *
 * @package    MMK_Scroll_To_Top
 * @since      1.0.0
 * @author     MMK Jony
 * @copyright  Copyright (c) 2016, MMK Jony
 * @license    GPLv2 or later
 **/

// Add a sub-page in settings menu
function mmk_totop_admin_menu()
{
    $settings = add_options_page(
        'MMK Scroll To Top Settings',
        'MMK Scroll To Top',
        'manage_options',
        'mmk-totop-settings-page',
        'mmk_totop_settings_page'
    );

    if ( ! $settings )
    {
        return;
    }

    // add scripts only on this settings page.
    add_action( 'load-' . $settings, 'mmk_totop_admin_enqueue_scripts' );
}
add_action( 'admin_menu', 'mmk_totop_admin_menu' );

// Register the plugin's settings
function mmk_totop_register_settings()
{
    register_setting(
        'mmk_totop_settings_group',
        'mmk_totop_plugin_settings',
        'mmk_totop_plugin_settings_validate'
    );
}
add_action( 'admin_init', 'mmk_totop_register_settings' );

// Register Setting Sections and Fields
function mmk_totop_setting_sections_fields()
{
    // Add General section
    add_settings_section(
        'mmk_totop_general_settings',
        '',
        '__return_false',
        'mmk_totop_settings_group'
    );

    // Add enable/disable checkbox setting field
    add_settings_field(
        'mmk_totop_enable_field',
        'Enable Scroll To Top',
        'mmk_totop_enable_field_cb',
        'mmk_totop_settings_group',
        'mmk_totop_general_settings'
    );

    // Add autohide checkbox setting field
    add_settings_field(
        'mmk_totop_autohide_field',
        'Autohide Button?',
        'mmk_totop_autohide_field_cb',
        'mmk_totop_settings_group',
        'mmk_totop_general_settings'
    );

    // Add 'offset' input setting field
    add_settings_field(
        'mmk_totop_offset_field',
        'Offset <small>(from top)</small>',
        'mmk_totop_offset_field_cb',
        'mmk_totop_settings_group',
        'mmk_totop_general_settings'
    );

    // Add 'speed' input setting field
    add_settings_field(
        'mmk_totop_speed_field',
        'Scrolling Speed',
        'mmk_totop_speed_field_cb',
        'mmk_totop_settings_group',
        'mmk_totop_general_settings'
    );

    // Add 'right' input setting field
    add_settings_field(
        'mmk_totop_right_field',
        'Position From Right',
        'mmk_totop_right_field_cb',
        'mmk_totop_settings_group',
        'mmk_totop_general_settings'
    );

    // Add 'bottom' input setting field
    add_settings_field(
        'mmk_totop_bottom_field',
        'Position From Bottom',
        'mmk_totop_bottom_field_cb',
        'mmk_totop_settings_group',
        'mmk_totop_general_settings'
    );

    // Add 'padding' input setting field
    add_settings_field(
        'mmk_totop_padding_field',
        'Padding',
        'mmk_totop_padding_field_cb',
        'mmk_totop_settings_group',
        'mmk_totop_general_settings'
    );

    // Add 'html' input setting field
    add_settings_field(
        'mmk_totop_html_field',
        'Texts inside the button',
        'mmk_totop_html_field_cb',
        'mmk_totop_settings_group',
        'mmk_totop_general_settings'
    );

    // Add 'color' input setting field
    add_settings_field(
        'mmk_totop_color_field',
        'Text Color',
        'mmk_totop_color_field_cb',
        'mmk_totop_settings_group',
        'mmk_totop_general_settings'
    );

    // Add 'background color' input setting field
    add_settings_field(
        'mmk_totop_bg_color_field',
        'Background Color',
        'mmk_totop_bg_color_field_cb',
        'mmk_totop_settings_group',
        'mmk_totop_general_settings'
    );

    // Add 'custom class' input setting field
    add_settings_field(
        'mmk_totop_class_field',
        'Add a Custom Class',
        'mmk_totop_class_field_cb',
        'mmk_totop_settings_group',
        'mmk_totop_general_settings'
    );
}
add_action( 'admin_init', 'mmk_totop_setting_sections_fields' );

// Enable/disable field callback.
function mmk_totop_enable_field_cb()
{
    $settings = mmk_totop_options( 'mmk_totop_enable' );

    $output = '<label for="mmk_totop_enable">';
    $output .= '<input id="mmk_totop_enable" type="checkbox" name="mmk_totop_plugin_settings[mmk_totop_enable]" value="1" ' . checked( 1, $settings, false ) . ' />';
    $output .= 'Enable Scroll To Top Button';
    $output .= '</label>';

    echo $output;
}

// Auto hide/unhide field callback function
function mmk_totop_autohide_field_cb()
{
    $settings = mmk_totop_options( 'mmk_totop_autohide' );

    $output = '<label for="mmk_totop_autohide">';
    $output .= '<input id="mmk_totop_autohide" type="checkbox" name="mmk_totop_plugin_settings[mmk_totop_autohide]" value="1" ' . checked( 1, $settings, false ) . ' />';
    $output .= 'Yes, Autohide';
    $output .= '</label>';

    echo $output;
}

// Offset from top field callback function
function mmk_totop_offset_field_cb()
{
    $settings = mmk_totop_options( 'mmk_totop_offset' );

    $output = '<input class="small-text" id="mmk_totop_offset" type="number" name="mmk_totop_plugin_settings[mmk_totop_offset]" value="' . $settings . '" />';
    $output .= ' <span class="description">( in pixels )</span>';
    $output .= '<p class="description">' . 'Set a distance from top to auto show the button if it is auto hidden.';

    echo $output;
}

// Speed field callback function
function mmk_totop_speed_field_cb()
{
    $settings = mmk_totop_options( 'mmk_totop_speed' );

    $output = '<input class="small-text" id="mmk_totop_speed" type="number" name="mmk_totop_plugin_settings[mmk_totop_speed]" value="' . $settings . '" />';
    $output .= ' <span class="description">( in milliseconds )</span>';
    $output .= '<p class="description">' . 'Set a duration to animate the auto scrolling to top.' . '</p>';

    echo $output;
}

// Position from right field callback function
function mmk_totop_right_field_cb()
{
    $settings = mmk_totop_options( 'mmk_totop_right' );

    $output = '<input class="small-text" id="mmk_totop_right" type="number" name="mmk_totop_plugin_settings[mmk_totop_right]" value="' . $settings . '" />';
    $output .= ' <span class="description">( in pixels )</span>';
    $output .= '<p class="description">' . 'Set a position from right for the button.' . '</p>';

    echo $output;
}

// Position from bottom field callback function
function mmk_totop_bottom_field_cb()
{
    $settings = mmk_totop_options( 'mmk_totop_bottom' );

    $output = '<input class="small-text" id="mmk_totop_bottom" type="number" name="mmk_totop_plugin_settings[mmk_totop_bottom]" value="' . $settings . '" />';
    $output .= ' <span class="description">( in pixels )</span>';
    $output .= '<p class="description">' . 'Set a position from bottom for the button.' . '</p>';

    echo $output;
}

// Padding field callback function
function mmk_totop_padding_field_cb()
{
    $settings = mmk_totop_options( 'mmk_totop_padding' );

    $output = '<input class="" id="mmk_totop_padding" type="text" name="mmk_totop_plugin_settings[mmk_totop_padding]" value="' . $settings . '" />';
    $output .= '<p class="description">' . 'Use padding for the button in css syntax. Example: "5px" or "5px 10px"' . '</p>';

    echo $output;
}

// Html inside the button field callback function
function mmk_totop_html_field_cb()
{
    $settings = mmk_totop_options( 'mmk_totop_html' );

    $output = '<input class="regular-text" id="mmk_totop_html" type="text" name="mmk_totop_plugin_settings[mmk_totop_html]" value="' . $settings . '" />';
    $output .= '<p class="description">' . 'You can use html elements too. Example: &lt;span class="icon some-icon"&gt;&lt;/span&gt;' . '</p>';

    echo $output;
}

// Text color field callback function
function mmk_totop_color_field_cb() {
    $settings = mmk_totop_options( 'mmk_totop_color' );

    $output = '<input class="mmk-totop-color" type="text" name="mmk_totop_plugin_settings[mmk_totop_color]" value="' . $settings . '" />';
    $output .= '<p class="description">' . 'Select the text color for the scroll top button.' . '</p>';

    echo $output;
}

// Background color field callback function
function mmk_totop_bg_color_field_cb() {
    $settings = mmk_totop_options( 'mmk_totop_bg_color' );

    $output = '<input class="mmk-totop-color" type="text" name="mmk_totop_plugin_settings[mmk_totop_bg_color]" value="' . $settings . '" />';
    $output .= '<p class="description">' . 'Select the background color for the scroll top button.' . '</p>';

    echo $output;
}

// Custom class field callback function
function mmk_totop_class_field_cb()
{
    $settings = mmk_totop_options( 'mmk_totop_class' );

    $output = '<input class="" id="mmk_totop_class" type="text" name="mmk_totop_plugin_settings[mmk_totop_class]" value="' . $settings . '" />';
    $output .= '<p class="description">' . 'Add a custom class for the button. If you use some css to that class, "!important" is recommended.' . '</p>';

    echo $output;
}

// Validate the settings values
function mmk_totop_plugin_settings_validate( $settings )
{
    $settings['mmk_totop_enable']   = ( isset( $settings['mmk_totop_enable'] ) && 1 == $settings['mmk_totop_enable'] ? 1 : 0 );
    $settings['mmk_totop_autohide'] = ( isset( $settings['mmk_totop_autohide'] ) && 1 == $settings['mmk_totop_autohide'] ? 1 : 0 );
    $settings['mmk_totop_offset']   = absint( $settings['mmk_totop_offset'] );
    $settings['mmk_totop_speed']    = absint( $settings['mmk_totop_speed'] );
    $settings['mmk_totop_right']    = absint( $settings['mmk_totop_right'] );
    $settings['mmk_totop_bottom']   = absint( $settings['mmk_totop_bottom'] );
    $settings['mmk_totop_padding']  = sanitize_text_field( $settings['mmk_totop_padding'] );
    $settings['mmk_totop_html']     = sanitize_text_field( $settings['mmk_totop_html'] );
    $settings['mmk_totop_color']    = sanitize_text_field( $settings['mmk_totop_color'] );
    $settings['mmk_totop_bg_color'] = sanitize_text_field( $settings['mmk_totop_bg_color'] );
    $settings['mmk_totop_class']    = sanitize_text_field( $settings['mmk_totop_class'] );

    return $settings;
}

// Render the plugin's settings page
function mmk_totop_settings_page()
{
?>
<div class="wrap">

    <h2 class="settings-page-header">MMK Scroll To Top Settings</h2>

    <div id="post-body" class="mmk-totop-settings metabox-holder">

        <div id="post-body-content">
            <form method="post" action="options.php">
                <?php settings_fields( 'mmk_totop_settings_group' ); ?>
                <?php do_settings_sections( 'mmk_totop_settings_group' ); ?>
                <?php submit_button( 'Update Settings', 'primary large' ); ?>
            </form>
        </div><!--/ .post-body-content -->

    </div><!--/ .scroll-top-settings -->

</div><!--/ .wrap -->
<?php
}

// Add scripts on this settings page
function mmk_totop_admin_enqueue_scripts()
{
    // Load wp picker css
    wp_enqueue_style( 'wp-color-picker');
    // Load admin styles
    wp_enqueue_style( 'mmk-totop-admin-css', MMK_TOTOP_ASSETS . '/css/mmk-totop-admin.css', array(), null );

    // Load plugin admin script.
    wp_enqueue_script( 'mmk-totop-admin-scripts', MMK_TOTOP_ASSETS . '/js/mmk-totop-admin.js', array( 'jquery', 'wp-color-picker' ), null, true );
}
