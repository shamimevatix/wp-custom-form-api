<?php
/**
 * Plugin Name: Custom Form API
 * Description: A simple form that submits data to a specific API endpoint. use the short code [custom_form] to display the form.
 * Version: 1.0
 * Author: Your Name
 */
if (!defined('ABSPATH')) {
  exit; // Prevent direct access
}

require_once plugin_dir_path(__FILE__) . 'settings.php';
require_once plugin_dir_path(__FILE__) . 'form.php';
require_once plugin_dir_path(__FILE__) . 'enqueue.php';
require_once plugin_dir_path(__FILE__) . 'ajax-handler.php';