<?php

if (! defined('ABSPATH')) {
    exit;
}

require_once(plugin_dir_path(__FILE__) . 'identify.php');

/**
 * Inject the Bonboarding integration to the pages, if the settings are enabled and there's an API key
 */

function bonboarding_inject_script_to_public_pages()
{
    if (!bonboarding_can_inject_script()) {
        return;
    }

    $options = get_option('bonboarding_settings');

    if (!isset($options['include_on_public_pages']) || !$options['include_on_public_pages']) {
        return;
    }

    bonboarding_inject_integration_script($options['api_key']);
    bonboarding_inject_user_identification_script();
}

function bonboarding_inject_script_to_admin_pages()
{
    if (!bonboarding_can_inject_script()) {
        return;
    }

    $options = get_option('bonboarding_settings');

    if (!isset($options['include_on_admin_pages']) || !$options['include_on_admin_pages']) {
        return;
    }

    bonboarding_inject_integration_script($options['api_key']);
    bonboarding_inject_user_identification_script();
}

function bonboarding_inject_integration_script($apiKey)
{
    echo "<script data-bb-key=\"" . esc_attr($apiKey) . "\" src=\"https://go.bonboarding.com\"></script>";
}

function bonboarding_inject_user_identification_script()
{
    $current_user = wp_get_current_user();
    if (!$current_user->exists()) {
        return;
    }

    $identifyData = get_identify_data();
    $identifyJson = wp_json_encode($identifyData, JSON_UNESCAPED_SLASHES);

    echo "<script type='text/javascript'>
            Bonboarding.identify(" . $identifyJson . ");
          </script>";
}

function bonboarding_can_inject_script()
{
    $options = get_option('bonboarding_settings');

    if (!isset($options['api_key']) || empty($options['api_key'])) {
        return false;
    }

    if (isset($options['only_authenticated_users']) && $options['only_authenticated_users'] && !is_user_logged_in()) {
        return false;
    }

    return true;

}

add_action('wp_head', 'bonboarding_inject_script_to_public_pages');
add_action('admin_head', 'bonboarding_inject_script_to_admin_pages');
