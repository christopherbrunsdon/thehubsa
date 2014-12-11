<?php

defined('ABSPATH') or die("No script kiddies please!");
define('SHORTCODE_THEHUBSA_FORM_JOIN', 'thehubsa_form_join');
/**
 * Sources:
 *==========
 * ref: http://www.sitepoint.com/build-your-own-wordpress-contact-form-plugin-in-5-minutes/
 * ref: http://codex.wordpress.org/Class_Reference/wpdb
*/

/**
 * Sign up form
 *
 */

function form_join_html($errors = array()) 
{
    $css_form_error = " style='color: red;' ";

    echo '<form action="' . esc_url( $_SERVER['REQUEST_URI'] ) . '" method="post">';
    echo '<input type="hidden" name="fj-submit" value="1" />';
    //+++ name

    if(array_key_exists('name', $errors)) {
        echo "<p {$css_form_error}>{$errors['name']}</p>";
    }
    echo '<p>';
    echo 'Your Name (required) <br />';
    echo '<input type="text" name="fj-name" value="' . filter_input(INPUT_POST,"fj-name") . '" size="40" />';
    echo '</p>';

    //+++ surname
    if(array_key_exists('surname', $errors)) {
        echo "<p {$css_form_error}>{$errors['surname']}</p>";
    }
    echo '<p>';
    echo 'Your Surname <br />';
    echo '<input type="text" name="fj-surname"  value="' . filter_input(INPUT_POST,"fj-surname")  . '" size="40" />';
    echo '</p>';

    //+++ email
    if(array_key_exists('email', $errors)) {
        echo "<p {$css_form_error}>{$errors['email']}</p>";
    }
    echo '<p>';
    echo 'Your Email (required) <br />';
    echo '<input type="email" name="fj-email" value="'.filter_input(INPUT_POST,"fj-email").'" size="40" />';
    echo '</p>';

    //+++ membership types
    $selected = filter_input(INPUT_POST, 'fj-membership-type', FILTER_SANITIZE_NUMBER_INT);
    if(array_key_exists('membership-type', $errors)) {
        echo "<p {$css_form_error}>{$errors['membership-type']}</p>";
    }    
    echo '<p>';
    echo 'Are you wanting to join as:<br />';
    echo '<select name="fj-membership-type">';
    echo '<option value="0">-- Please Select --</option>';
    foreach(model_thehub_membership_types::get_types() as $mType) {
    	echo "<option value='{$mType->id}' ".($selected == $mType->id ? 'selected' : '').">{$mType->MembershipType}</option>";
    }
    echo '</select>';
    echo '</p>';

    //+++ submit button
    echo '</p>';
    echo '<p><input type="submit" name="fj-submitted" value="Submit"/> &nbsp;&nbsp;|&nbsp;&nbsp;<a href="">Reset Form</a></p>';
    echo '</form>';
}

/** 
 * Thank you 
 *
 */

function form_join_thank_you_html()
{
    echo "<h2>Thank You!</h2>";
}
/**
 * Process the form here
 *
 */

function form_join_process()
{
    if(filter_input(INPUT_POST,'fj-submit') != 1) {
        return Null;
    }

    $data = array(
        'name'    => filter_input(INPUT_POST, 'fj-name'),
        'surname' => filter_input(INPUT_POST, 'fj-surname'),
        'email'   => filter_input(INPUT_POST, 'fj-email'),
        'mtype'   => filter_input(INPUT_POST, 'fj-membership-type', FILTER_SANITIZE_NUMBER_INT),
    );

    $membership = new model_thehub_memberships($data);

    $res = $membership->validate();
    
    if (empty($res['errors'])) {
        $membership->save();
        
        $subject = "Thank you for signing up to TheHubSA.org.za";
        $message = "Thank you".$membership->_name." for signing up to TheHubSA.org.za";
        $membership->email($subject, $message);
    }

    return $res;
}


/**
 * Register shortcode
 *
 */

function form_join_shortcode()
{
    $res = form_join_process();

    ob_start();

    if(empty($res)) {
        form_join_html();
    } elseif (!empty($res['errors'])) {
        form_join_html($res['errors']);
    } else {
        form_join_thank_you_html();
    }
    
    return ob_get_clean();
}

add_shortcode( SHORTCODE_THEHUBSA_FORM_JOIN, 'form_join_shortcode' );

// [eof]