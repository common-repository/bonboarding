<?php

if (! defined('ABSPATH')) {
    exit;
}

require_once(plugin_dir_path(__FILE__) . 'identify.php');

add_action('admin_menu', 'bonboarding_menu');
add_action('admin_init', 'bonboarding_settings_init');
add_action('admin_enqueue_scripts', 'bonboarding_enqueue_scripts');

function bonboarding_menu()
{
    add_options_page(
        'Bonboarding Settings',
        'Bonboarding',
        'manage_options',
        'bonboarding-settings',
        'bonboarding_settings_page'
    );
}

function bonboarding_settings_page()
{
    $logo_url = plugins_url('logo.svg', __FILE__);
    $new_tab_icon_url = plugins_url('new-tab.svg', __FILE__);
    $video_icon_url = plugins_url('video.svg', __FILE__);

    ?>
    <div class="wrap bonboarding-settings">
        <div class="flex">
            <div class="logo-container">
                <h1>
                    <a href="https://bonboarding.com" target="_blank" title="Boost your user adoption with Bonboarding">
                        <img src='<?php echo esc_url($logo_url); ?>' alt='Bonboarding' />
                    </a>
                </h1>
            </div>
            <div class="flows-button-container">
                <a href="https://app.bonboarding.com/flows" class="flows-button" target="_blank" title="Check your flows in Bonboarding">
                    Edit Flows
                    <img src='<?php echo esc_url($new_tab_icon_url); ?>' alt='Edit flows in new tab' />
                </a>
                <a href="#TB_inline?width=600&height=550&inlineId=tutorial-video" class="thickbox watch-video">
                    <img src='<?php echo esc_url($video_icon_url); ?>' alt='Watch video' />
                    Watch tutorial video
                </a>
            </div>

            <div class="logo-circle"></div>
            <div class="header-circle-1"></div>
            <div class="header-circle-2"></div>
        </div>
        
        <form method="post" action="options.php">
            <?php
            settings_fields('bonboarding-settings-group');
    do_settings_sections('bonboarding-settings');
    submit_button();
    ?>
        </form>

    </div>
    <div class="circle-1"></div>
    <div class="circle-2"></div>
    <div class="circle-3"></div>

    <div id="tutorial-video">
        <h2>Your Setup Guide: Product Tour In Minutes!</h2>
        <p>We've prepared a brief video to guide you through the setup process, so you can get started right away!</p>

        <div class="video-container">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/c-dHK7aiBHE?si=E1MO0TF72tUWA3Yp" title="Easily Add Product Tours to Your WordPress Site" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        </div>

        <div class="tutorial-actions">
            <button class="button" onclick="tb_remove();">Let's go!</button>
        </div>
    </div>

    <style type='text/css'>
        .bonboarding-settings {
            position: relative;
            z-index: 2;
        }

        .bonboarding-settings .flex {
            display: flex;
            height: 160px;
            margin-top: -10px;
            margin-left: -160px;
            margin-right: -20px;
            padding-left: 160px;
            align-items: flex-start;
            margin-bottom: 100px;
            background-color: #E0DBE4;
            box-shadow: 0 10px 15px -3px rgb(0 0 0/0.1),0 4px 6px -4px rgb(0 0 0/0.1);
        }

        .bonboarding-settings .logo-container {
            position: relative;
            z-index: 2;
            width: 200px;
        }

        .bonboarding-settings h1 a {
            display: block;
            margin-top: 10px;
        }

        .bonboarding-settings h1 img {
            width: auto;
            height: 100px;
        }

        .bonboarding-settings .flows-button-container {
            margin-left: 50px;
            margin-top: 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .bonboarding-settings .flows-button {
            display: flex;
            font-family: 'Open Sans', Helvetica, sans-serif;
            align-items: center;
            padding: 1rem 1.5rem;
            border-radius: 3rem;
            font-size: 20px;
            font-weight: 900;
            background-color: #46344E;
            color: #fff;
            text-decoration: none;
            text-transform: uppercase;
            transition: all 0.3s ease-in-out;
        }

        .bonboarding-settings .flows-button:hover {
            box-shadow: 0 10px 15px -3px rgb(0 0 0/0.1),0 4px 6px -4px rgb(0 0 0/0.1);
            transform: translateY(-2px);
        }

        .bonboarding-settings .flows-button:active {
            transition: none;
            filter: brightness(0.9);
            transform: translateY(0);
        }

        .bonboarding-settings .flows-button img {
            width: 20px;
            height: 20px;
            margin-left: 14px;
            margin-right: -4px;
            margin-top: -2px;
        }

        .bonboarding-settings .watch-video {
            display: flex;
            align-items: center;
            margin-top: 12px;
            font-size: 14px;
            color: #46344E;
            font-weight: 600;
            cursor: pointer;
        }

        .bonboarding-settings .watch-video:hover {
            text-decoration: underline;
        }

        .bonboarding-settings .watch-video img {
            width: 20px;
            height: 20px;
            margin-right: 10px;
        }

        .bonboarding-settings .user-data {
            width: fit-content;
            margin-top: 10px;
            border-radius: 3px;
            background-color: rgba(255, 255, 255, 0.8);
            box-shadow: 0 10px 15px -3px rgb(0 0 0/0.1),0 4px 6px -4px rgb(0 0 0/0.1);
            padding: 10px 20px;
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        .bonboarding-settings .user-data-title {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .logo-circle {
            position: absolute;
            top: -50px;
            left: -40px;
            width: 240px;
            height: 240px;
            border-radius: 50%;
            background-color: #CCC4D1;
        }

        .header-circle-1 {
            position: absolute;
            top: 50px;
            right: 0;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #46344E;
        }

        .header-circle-2 {
            position: absolute;
            top: 20px;
            right: 30px;
            width: 15px;
            height: 15px;
            border-radius: 50%;
            background-color: #9B786F;
        }

        .circle-1 {
            position: absolute;
            top: 170px;
            right: 0px;
            width: 40px;
            height: 200px;
            overflow: hidden;
        }

        .circle-1::after {
            content: '';
            display: block;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background-color: #FAED26;
        }

        .circle-2 {
            position: absolute;
            top: 300px;
            left: -310px;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background-color: #D3B6AE;
        }

        .circle-3 {
            position: absolute;
            bottom: 10px;
            right: 130px;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: #B9AAAC;
        }

        #update-nag, .update-nag {
            position: relative;
            z-index: 3;
        }

        #api_key_feedback {
            margin-left: 10px;
            font-weight: bold;
        }
        .valid {
            color: #46B450;
        }
        .invalid {
            color: #DC3232;
        }

        #tutorial-video {
            display: none;
        }

        .video-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }

        .tutorial-actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
        }

        @media screen and (max-width: 600px) {
            .bonboarding-settings .flex {
                flex-direction: column;
                align-items: center;
                height: auto;
                margin-left: -12px;
                margin-right: -12px;
                padding-left: 0;
                margin-bottom: 40px;
            }

            .bonboarding-settings .logo-container {
                display: flex;
                flex-direction: column;
                align-items: center;
                width: 100%;
            }

            .bonboarding-settings .logo-circle {
                display: none;
            }

            .bonboarding-settings .flows-button-container {
                margin-left: 0;
                margin-top: 20px;
                margin-bottom: 20px;
            }
        }
    </style>
    <?php
}

function bonboarding_settings_init()
{
    register_setting('bonboarding-settings-group', 'bonboarding_settings');

    add_settings_section(
        'bonboarding-settings-section',
        'Settings',
        null,
        'bonboarding-settings'
    );

    add_settings_field(
        'api_key',
        'API Key',
        'bonboarding_api_key_callback',
        'bonboarding-settings',
        'bonboarding-settings-section'
    );

    add_settings_field(
        'include_on_public_pages',
        'Include on Public Pages',
        'bonboarding_include_public_callback',
        'bonboarding-settings',
        'bonboarding-settings-section'
    );

    add_settings_field(
        'include_on_admin_pages',
        'Include on Admin Pages',
        'bonboarding_include_admin_callback',
        'bonboarding-settings',
        'bonboarding-settings-section'
    );

    add_settings_field(
        'only_authenticated_users',
        'Only include for authenticated users',
        'bonboarding_only_authenticated_users_callback',
        'bonboarding-settings',
        'bonboarding-settings-section'
    );

    // add a HTML block
    add_settings_section(
        'bonboarding-settings-section-example-user',
        'Example User Data',
        'bonboarding_example_user_callback',
        'bonboarding-settings'
    );
}

function bonboarding_api_key_callback()
{
    $options = get_option('bonboarding_settings');
    $api_key = isset($options['api_key']) ? $options['api_key'] : '';
    echo "<input id='api_key' name='bonboarding_settings[api_key]' size='40' type='text' value='" . esc_attr($api_key) . "' />";
    echo "<span id='api_key_feedback'></span>";
    echo "<p class='description'>Copy your BB Key from the <a href='https://app.bonboarding.com/integration' target='_blank'>Integration</a> page</p>";

    // Also detect if the user pasted the entire script tag by accident,
    // and verify that the API key is 10 alphanumeric characters
    echo "<script type='text/javascript'>
            jQuery(document).ready(function($) {
                var apiKeyInput = document.getElementById('api_key');
                var apiKeyFeedback = document.getElementById('api_key_feedback');
                var saveButton = document.querySelector('input[type=\"submit\"]');

                apiKeyInput.addEventListener('input', function() {
                    var value = this.value;
                    var match = value.match(/data-bb-key=\"(.*?)\"/);
                    if (match) {
                        this.value = match[1];
                    }
                    checkApiKey(this.value);
                });

                function checkApiKey(value, allowEmpty = false) {
                    var saveButton = document.querySelector('input[type=\"submit\"]');

                    if (allowEmpty && value.length == 0) {
                        apiKeyFeedback.textContent = '';
                        apiKeyFeedback.className = '';
                        saveButton.disabled = true;
                        return;
                    }
                    var isValid = /^[a-zA-Z0-9]{10}$/.test(value);
                    apiKeyFeedback.textContent = isValid ? 'Looks good' : 'This doesn\'t look like a valid API key';
                    apiKeyFeedback.className = isValid ? 'valid' : 'invalid';
                    saveButton.disabled = !isValid;
                }

                // Initial check
                checkApiKey(apiKeyInput.value, true);

                // Check if URL contains ?show-tutorial, and then show the tutorial modal
                if (window.location.href.indexOf('show-tutorial') > -1) {
                    setTimeout(function() {
                        tb_show('', '#TB_inline?width=600&height=500&inlineId=tutorial-video');
                    }, 100);
                }
            });
        </script>";
}

function bonboarding_include_public_callback()
{
    $options = get_option('bonboarding_settings');
    $checked = isset($options['include_on_public_pages']) ? 'checked' : '';
    echo "<input id='include_on_public_pages' name='bonboarding_settings[include_on_public_pages]' type='checkbox' value='1' " . esc_attr($checked) . " />";
}

function bonboarding_include_admin_callback()
{
    $options = get_option('bonboarding_settings');
    $checked = isset($options['include_on_admin_pages']) ? 'checked' : '';
    echo "<input id='include_on_admin_pages' name='bonboarding_settings[include_on_admin_pages]' type='checkbox' value='1' " . esc_attr($checked) . " />";
}

function bonboarding_only_authenticated_users_callback()
{
    $options = get_option('bonboarding_settings');
    $checked = isset($options['only_authenticated_users']) ? 'checked' : '';
    echo "<input id='include_on_admin_pages' name='bonboarding_settings[only_authenticated_users]' type='checkbox' value='1' " . esc_attr($checked) . " />";
}

function bonboarding_example_user_callback()
{
    $current_user = wp_get_current_user();
    if (!$current_user->exists()) {
        echo '';
    }

    $identifyData = get_identify_data();

    echo "<p class='description'>Example user data, that is sent to Bonboarding about your logged-in users.</p>";
    echo "<p class='description'>You can use it for targeting users for specific flows in Bonboarding.</p>";
    echo "<div class='user-data'>";
    foreach ($identifyData as $key => $value) {
        echo "<div class='user-data-title'>$key:</div><div class='user-data-value'>$value</div>";
    }
    echo '</div>';
}

function bonboarding_enqueue_scripts()
{
    if (is_admin()) {
        wp_enqueue_script('thickbox');
        wp_enqueue_style('thickbox');
    }
}
