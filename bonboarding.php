<?php
/**
 * Plugin Name: Bonboarding
 * Plugin URI: https://bonboarding.com/wordpress-plugin
 * Description: Create stunning <strong>product tours</strong> to enhance user adoption and engagement with Bonboarding. <strong>No coding required</strong> – design interactive guides, highlight new features, and analyze user interactions to continuously improve the user experience, on any of your WordPress pages.
 * License: GPLv2 or later
 * Version: 1.0.7
 * Author: Bonboarding
 * Author URI: https://bonboarding.com/
 */

if (! defined('ABSPATH')) {
    exit;
}

include_once(plugin_dir_path(__FILE__) . 'settings.php');
include_once(plugin_dir_path(__FILE__) . 'integration.php');

/**
 * On page activation
 * - Add default settings
 * - Redirect to settings page
 */
function bonboarding_activation($plugin)
{
    if($plugin == plugin_basename(__FILE__)) {
        // Set default options
        $default_options = array(
            'include_on_public_pages' => 1,
            'include_on_admin_pages' => 1
        );
        if (false === get_option('bonboarding_settings')) {
            add_option('bonboarding_settings', $default_options);
        }

        // Redirect to settings page
        exit(wp_redirect(admin_url('options-general.php?page=bonboarding-settings#show-tutorial')));
    }
}
add_action('activated_plugin', 'bonboarding_activation');
