<?php
if (!defined('ABSPATH')) {
  exit; // Prevent direct access
}

function cfa_plugin_enqueue_scripts() {
  wp_enqueue_style(
      'cfa-style', // Handle
      plugin_dir_url(__FILE__) . 'stylesheet/style.css', // CSS file URL
      array(), // Dependencies (if any)
      '1.0', // Version number
      'all' // Media (e.g., 'all', 'screen', 'print')
  );

  wp_enqueue_script('cfa-ajax-script', 
    plugin_dir_url(__FILE__) . 'js/script.js', 
    array('jquery'), 
    null, 
    true
  );

  // Localize script to pass AJAX URL to JavaScript
  wp_localize_script('cfa-ajax-script', 'cfa_ajax_object', array(
      'ajax_url' => admin_url('admin-ajax.php'),
      'nonce'    => wp_create_nonce('cfa_ajax_nonce') // Add a nonce for security
  ));
}

add_action('wp_enqueue_scripts', 'cfa_plugin_enqueue_scripts');