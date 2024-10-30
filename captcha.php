<?php

/*
  Plugin Name: Comment Captcha Anti-spam
  Plugin URI: http://www.unicodesystems.in
  Description: This plugin generates the captcha images with numbers, letters, etc which can be used in the web pages for verification purpose.
  Version: 1.0
  Author: Ranjita Gupta
  Author URI: http://www.unicodesytems.in
 */

if (!defined('CAPTCHA_PLUGIN_PATH'))
    define('CAPTCHA_PLUGIN_PATH', plugin_dir_path(__FILE__));

if (!defined('CAPTCHA_PLUGIN_URL'))
    define('CAPTCHA_PLUGIN_URL', plugin_dir_url(__FILE__));

if (!defined('CAPTCHA_PLUGIN_JS_URL'))
    define('CAPTCHA_PLUGIN_JS_URL', CAPTCHA_PLUGIN_URL . 'js');

// Add fields after default fields above the comment box, always visible

add_action('comment_form_logged_in_after', 'additional_fields');
add_action('comment_form_after_fields', 'additional_fields');

function additional_fields() {
    echo '<p id="imgdiv">' .
    '<label for="captcha">' . __('Captcha') . '</label>' .
    '<img id="im" src="' . CAPTCHA_PLUGIN_URL . 'image.php"></p>
     <img id="reload" src="' . CAPTCHA_PLUGIN_URL . 'images/reload.png">';
    echo '<p class="comment-form-title">' .
    '<label for="Enter Image Text">' . __('Enter Image Text') . '</label>' .
    '<input id="captcha1" name="captcha" type="text" size="30"  tabindex="5" /></p>';
}

// Validating CAPTCHA with user input text.
add_action('pre_comment_on_post', 'pre_comment_pocess_captcha');

function pre_comment_pocess_captcha($comment_id) {
    session_start();
    if ($_SESSION["code"] != $_POST['captcha']) {
        wp_die('Captcha does not match');
    }
}

//Add custom scripts
add_action('wp_enqueue_scripts', 'add_scripts');

function add_scripts() {
    wp_enqueue_script('script-name', CAPTCHA_PLUGIN_JS_URL . '/script.js', array('jquery'));
    wp_localize_script('script-name', 'captcha', array('url' => CAPTCHA_PLUGIN_URL));
}

