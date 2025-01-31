<?php
if (!defined('ABSPATH')) {
  exit; // Prevent direct access
}

function cfa_handle_form_submission() {
  // Verify nonce for security
  check_ajax_referer('cfa_ajax_nonce', 'nonce');

  if (!isset($_POST['firstName']) || !isset($_POST['lastName']) || !isset($_POST['email'])) {
      wp_send_json_error(['message' => 'Name and Email are required!']);
  }

  // Map the form data
  $data = [
      'product_id' => get_option('cfa_product_id', '1'),
      'email' => sanitize_email($_POST['email']),
      'context' => get_option('cfa_context', 'lead-gen'),
      'firstName' => sanitize_text_field($_POST['firstName']),
      'lastName' => sanitize_text_field($_POST['lastName']),      
      'source_domain' => get_option('cfa_source_domain', 'rvhumor.com'),
  ];

  // API Endpoint
  $api_url = get_option('cfa_api_endpoint', 'https://membership.harvesthosts.com/api/v2/lead');

  // Send data to the API
  $response = wp_remote_post($api_url, [
      'body'    => $data,
      //'headers' => ['Content-Type' => 'application/json'],
      'method'  => 'POST',
  ]);

  // Check the response
  if (is_wp_error($response)) {
      wp_send_json_error(['message' => 'Error submitting form']);
  }

  wp_send_json_success(['message' => 'Form submitted successfully!']);
}

add_action('wp_ajax_cfa_submit_form', 'cfa_handle_form_submission');
add_action('wp_ajax_nopriv_cfa_submit_form', 'cfa_handle_form_submission');