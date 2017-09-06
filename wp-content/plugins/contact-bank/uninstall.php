<?php
if (!defined('WP_UNINSTALL_PLUGIN')) {
   die;
}
if (!current_user_can("manage_options")) {
   return;
} else {
   global $wpdb;
   $contact_bank_remove_table_uninstall = get_option("contact-bank-remove-tables");
   if ($contact_bank_remove_table_uninstall == "1") {
      $wpdb->query("DROP TABLE IF EXISTS " . $wpdb->prefix . "cb_contact_form");
      $wpdb->query("DROP TABLE IF EXISTS " . $wpdb->prefix . "cb_create_control_form");
      $wpdb->query("DROP TABLE IF EXISTS " . $wpdb->prefix . "cb_dynamic_settings");
      $wpdb->query("DROP TABLE IF EXISTS " . $wpdb->prefix . "cb_email_template_admin");
      $wpdb->query("DROP TABLE IF EXISTS " . $wpdb->prefix . "cb_frontend_data_table");
      $wpdb->query("DROP TABLE IF EXISTS " . $wpdb->prefix . "cb_frontend_forms_table");
      $wpdb->query("DROP TABLE IF EXISTS " . $wpdb->prefix . "cb_form_settings_table");
      $wpdb->query("DROP TABLE IF EXISTS " . $wpdb->prefix . "cb_layout_settings_table");
      $wpdb->query("DROP TABLE IF EXISTS " . $wpdb->prefix . "cb_licensing");
      $wpdb->query("DROP TABLE IF EXISTS " . $wpdb->prefix . "cb_roles_capability");

      delete_option("contact-bank-info-popup");
      delete_option("contact-bank-wizard");
      delete_option("contact_bank_site_id");
      delete_option("contact-bank-version-number");
      delete_option("contact-bank-remove-tables");
   }
}
?>
