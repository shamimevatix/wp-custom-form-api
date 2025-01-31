<?php
if (!defined('ABSPATH')) {
  exit; // Prevent direct access
}

// Register a shortcode to display the form
function cfa_display_form() {
  ob_start(); ?>
  <form id="cfa-form" method="post">
      <input type="text" id="cfaFirstName" name="firstName" placeholder="First Name" required>
      <input type="text" id="cfaLastName" name="lastName" placeholder="Last Name" required>
      <input type="email" id="cfaEmail" name="email" placeholder="Your Email" required>
      <input type="hidden" name="action" value="cfa_submit_form"/>
      <button type="submit">Submit</button>
      <div id="cfa-response"></div>
  </form>
  <?php return ob_get_clean();
}
add_shortcode('custom_form', 'cfa_display_form');