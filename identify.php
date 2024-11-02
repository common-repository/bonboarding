<?php

if (! defined('ABSPATH')) {
    exit;
}


function get_identify_data()
{
    $current_user = wp_get_current_user();
    if (!$current_user->exists()) {
        return;
    }
    $user_id = $current_user->ID;
    $first_name = $current_user->user_firstname ? $current_user->user_firstname : $current_user->user_nicename;
    $last_name = $current_user->user_lastname ? $current_user->user_lastname : '';
    $email = $current_user->user_email;
    $sign_up_date = $current_user->user_registered;
    $membership_from_woocommerce = get_first_user_membership_from_woocommerce();

    $identifyData = array(
        "uniqueID" => $user_id,
        "email" => $email,
        "signUpDate" => $sign_up_date,
    );

    if (!empty($first_name)) {
        $identifyData["firstName"] = $first_name;
    }

    if (!empty($last_name)) {
        $identifyData["lastName"] = $last_name;
    }

    if (!empty($membership_from_woocommerce)) {
        $identifyData["membership"] = $membership_from_woocommerce;
    }

    return $identifyData;
}

function get_first_user_membership_from_woocommerce()
{
    // Check if the WooCommerce Memberships plugin is active and the necessary function exists
    if (! function_exists("wc_memberships")) {
        return null;
    }

    // Get the current user ID
    $user_id = get_current_user_id();

    // Get active memberships
    $args = array(
        "status" => array( "active", "complimentary", "pending" ),
    );
    $memberships = wc_memberships_get_user_memberships($user_id, $args);

    // Return the first membership's custom field if available
    if (!empty($memberships)) {
        $first_membership = $memberships[0]; // Get the first membership

        // If it's still not set, check the membership->plan_id 's title
        try {
            return get_the_title($first_membership->plan_id);
        } catch (Exception $e) {
            // It was not possible to get the title of the membership
        }

        // Check if $first_membership is an object or an array
        if (is_object($first_membership) && isset($first_membership->plan->name)) {
            return $first_membership->plan->name;
        }

        if (is_array($first_membership) && isset($first_membership["plan"]["name"])) {
            return $first_membership["plan"]["name"];
        }

        // Check if $first_membership is an object or an array
        if (is_object($first_membership) && isset($first_membership->name)) {
            return $first_membership->name;
        }

        if (is_array($first_membership) && isset($first_membership["name"])) {
            return $first_membership["name"];
        }
    }

    // Return null if plugin not available or no memberships found
    return null;
}
