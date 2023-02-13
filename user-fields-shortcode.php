<?php
/**
 * Plugin Name: User Fields Shortcode
 * Plugin URI: http://www.yoohooplugins.com/plugins/
 * Description: This plugin allows you to display user fields in your posts and pages using shortcodes.
 * Version: 1.0
 * Author: Yoohoo Plugins
 * Author URI: http://www.yoohooplugins.com/
 * License: GPLv2 or later
 */

function yh_user_fields_shortcode( $atts ) {
    global $current_user;
    // Return nothing if the user is logged-out.
    if ( ! is_user_logged_in() ) {
        return;
    }
    
    // Get the key from the shortcode attribute.
    $key = esc_attr( $atts['key'] );
    
    if ( empty( $value ) ) {
        $value = $current_user->{$key};
    }

    return $value;

}
add_shortcode( 'user_field', 'yh_user_fields_shortcode' );