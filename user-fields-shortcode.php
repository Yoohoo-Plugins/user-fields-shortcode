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
    
    $value = $current_user->{$key};

    // If it's a date, let's format it better.
    if ( $key === 'user_registered' ) {
        $value = date_i18n( get_option( 'date_format' ), strtotime( $value ) );
    }

    return esc_html( $value );

}
add_shortcode( 'user_field', 'yh_user_fields_shortcode' );


/**
 * Shortcode for displaying EDD information
 */
function yh_edd_user_fields_shortcode( $atts ) {
    global $current_user;
    // Return nothing if the user is logged-out.
    if ( ! is_user_logged_in() ) {
        return;
    }

    // Make sure EDD is installed.
    if ( ! class_exists( 'EDD_Customer' ) ) {
        return;
    }

    ////// Possible Keys.
    // $customer->name;
    // $customer->email;
    // $customer->date_created;
    // $customer->purchase_count;
    // $customer->purchase_value;
    // $customer->id; // Customer ID
    // $customer->user_id; // WordPress user ID
    // $customer->payment_ids

    // Get the key from the shortcode attribute.
    $key = esc_attr( $atts['key'] );

    // Customer information
    $customer = new EDD_Customer( $current_user->ID );

    $value = $customer->{$key};

    return esc_html( $value );

}
add_shortcode( 'edd_user_field', 'yh_edd_user_fields_shortcode' );
