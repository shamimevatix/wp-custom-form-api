<?php
if (!defined('ABSPATH')) {
  exit; // Prevent direct access
}

// Create a settings menu in WP Admin
function cfa_add_settings_menu() {
  add_menu_page(
      'Custom Form Settings',
      'Form API Settings',
      'manage_options',
      'cfa-settings',
      'cfa_settings_page',
      'dashicons-admin-generic'
  );
}
add_action('admin_menu', 'cfa_add_settings_menu');

// Register settings
function cfa_register_settings() {
  register_setting('cfa_settings_group', 'cfa_api_endpoint');
  register_setting('cfa_settings_group', 'cfa_product_id');
  register_setting('cfa_settings_group', 'cfa_context');
  register_setting('cfa_settings_group', 'cfa_source_domain');
}
add_action('admin_init', 'cfa_register_settings');

// Create the settings page
function cfa_settings_page() { ?>
  <div class="wrap">
      <h1>Custom Form API Settings</h1>
      <form method="post" action="options.php">
          <?php settings_fields('cfa_settings_group'); ?>
          <?php do_settings_sections('cfa_settings_group'); ?>
          <table class="form-table">
              <tr valign="top">
                  <th scope="row">API Endpoint:</th>
                  <td>
                      <input type="text" name="cfa_api_endpoint" value="<?php echo esc_attr(get_option('cfa_api_endpoint', 'https://example.com/api/submit-data')); ?>" style="width: 100%;">
                      <p class="description">Enter the API endpoint URL where form data should be submitted.</p>
                  </td>
              </tr>
              <tr valign="top">
                  <th scope="row">product_id:</th>
                  <td>
                      <input type="text" name="cfa_product_id" value="<?php echo esc_attr(get_option('cfa_product_id', '1')); ?>" style="width: 100%;">
                      <p class="description">Fixed product id</p>
                  </td>
              </tr>
              <tr valign="top">
                  <th scope="row">context:</th>
                  <td>
                      <input type="text" name="cfa_context" value="<?php echo esc_attr(get_option('cfa_context', 'lead-gen')); ?>" style="width: 100%;">
                      <p class="description">Fixed Context</p>
                  </td>
              </tr>
              <tr valign="top">
                  <th scope="row">Source Domain:</th>
                  <td>
                      <input type="text" name="cfa_source_domain" value="<?php echo esc_attr(get_option('cfa_source_domain', 'rvhumor.com')); ?>" style="width: 100%;">
                      <p class="description">Fixed Source Domain</p>
                  </td>
              </tr>
          </table>
          <?php submit_button(); ?>
      </form>
  </div>
<?php }
?>