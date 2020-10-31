<?php

/*

@package sunsettheme

=============================
    ADMIN PAGE
==============================

*/

function sunset_add_admin_page() {
    //Generate Sunset Admin Page
    add_menu_page( 'Sunset Theme Options', 'Sunset', 'manage_options', 'raza_sunset', 'sunset_theme_create_page', 'dashicons-menu-alt3', 110);

    //Generate Sunset Admin Sub Pages
    add_submenu_page('raza_sunset', 'Sunset Sidebar Options', 'Sidebar', 'manage_options', 'raza_sunset', 'sunset_theme_create_page');

    //Theme Option Sub Menu Page
    add_submenu_page('raza_sunset', 'Sunset Theme Options', 'Theme Options', 'manage_options', 'raza_sunset_theme', 'sunset_theme_support_page');
    add_submenu_page('raza_sunset', 'Sunset CSS Options', 'Custom CSS', 'manage_options', 'raza_sunset_css', 'sunset_theme_settings_page');


    // Activate custom settings
    add_action('admin_init', 'sunset_custom_settings');
}

add_action('admin_menu', 'sunset_add_admin_page');

function sunset_custom_settings() {
    // sidebar options
    register_setting('sunset-settings-group', 'profile_picture');
    register_setting('sunset-settings-group', 'first_name');
    register_setting('sunset-settings-group', 'last_name');
    register_setting('sunset-settings-group', 'user_description');
    register_setting('sunset-settings-group', 'twitter_handler', 'sunset_sanitize_twitter_handler');
    register_setting('sunset-settings-group', 'facebook_handler');
    register_setting('sunset-settings-group', 'gplus_handler');



    add_settings_section('sunset-sidebar-options', 'Sidebar Options', 'sunset_sidebar_options', 'raza_sunset');
    add_settings_field('sidebar-profile-picture', 'Profile Picture', 'sunset_sidebar_profile', 'raza_sunset', 'sunset-sidebar-options');
    add_settings_field('sidebar-name', 'Full Name', 'sunset_sidebar_name', 'raza_sunset', 'sunset-sidebar-options');
    add_settings_field('sidebar-description', 'Description', 'sunset_sidebar_description', 'raza_sunset', 'sunset-sidebar-options');
    add_settings_field('sidebar-twitter', 'Twitter handler', 'sunset_sidebar_twitter', 'raza_sunset', 'sunset-sidebar-options');
    add_settings_field('sidebar-facebook', 'Facebook handler', 'sunset_sidebar_facebook', 'raza_sunset', 'sunset-sidebar-options');
    add_settings_field('sidebar-gplus', 'Google+ handler', 'sunset_sidebar_gplus', 'raza_sunset', 'sunset-sidebar-options');

    //Theme Support options
    register_setting('sunset-theme-support', 'post_formats', 'sunset_post_formats_callback');

    add_settings_section('sunset-theme-options', 'Theme Options', 'sunset_theme_options', 'raza_sunset_theme');
    add_settings_field('post_formats', 'POST Formats', 'sunset_post_formats', 'raza_sunset_theme', 'sunset-theme-options' );

}

function sunset_sidebar_options() {
    echo 'Customize your sidebard information';
}

function sunset_sidebar_profile() {
    $picture = esc_attr(get_option('profile_picture'));
    if( empty($picture) ) {

        echo ' <input type="button" class="button button-secondary" value="Upload Profile Picture" id="upload-button" />
        <input type="hidden" id="profile-picture" name="profile_picture" value=""  /> ';

    } else {
        echo ' <input type="button" class="button button-secondary" value="Replace Profile Picture" id="upload-button" />
        <input type="hidden" id="profile-picture" name="profile_picture" value="'.$picture.'"  /> 
        <input type="button" class="button button-secondary" value="Remvoe" id="remove-picture" />
        ';
    }
  
}

function sunset_sidebar_name() {
    $firstName = esc_attr(get_option('first_name'));
    $lastName = esc_attr(get_option('last_name'));

    echo '<input type="text" name="first_name" value="'.$firstName.'" placeholder="First Name" /> 
    <input type="text" name="last_name" value="'.$lastName.'" placeholder="Last Name" />';
}
function sunset_sidebar_description() {
    $description = esc_attr(get_option('user_description'));

    echo '<input type="text" name="user_description" value="'.$description.'" placeholder="Description" />
    <p class="description">write somthing smart </p>';

    // echo '<input type="text" name="user_description" value="'.$description.'" placeholder="Description" />
    // <p class="description">write somthing smart </p>';

//    echo ' <textarea name="description" id="description" rows="5" cols="30" value="'.$description.'">'.$description.'</textarea> 
//    <p class="description">write somthing smart </p>
//    ';
}

function sunset_sidebar_twitter() {
    $twitter = esc_attr(get_option('twitter_handler'));
    echo '<input type="text" name="twitter_handler" value="'.$twitter.'" placeholder="Twitter Handler" />
    <p class="description">Input your Twitter username without the @ character</p> ';
}
function sunset_sidebar_facebook() {
    $facebook = esc_attr(get_option('facebook_handler'));
    echo '<input type="text" name="facebook_handler" value="'.$facebook.'" placeholder="Facebook Handler" /> ';
}

function sunset_sidebar_gplus() {
    $gplus = esc_attr(get_option('gplus_handler'));
    echo '<input type="text" name="gplus_handler" value="'.$gplus.'" placeholder="Google+ Handler" /> ';
}

// Sanitization Settings
function sunset_sanitize_twitter_handler($input) {
    $output = sanitize_text_field($input);
    $output = str_replace('@', '', $output);
    return $output;
}


function sunset_theme_create_page() {
    // generation of our admin page
    require_once(get_template_directory() . '/inc/templates/sunset-admin.php');
}

function sunset_theme_settings_page() {
    // generation of admin page
}

// Template submenu functions

function sunset_theme_support_page() {
    // generation of our admin page
    require_once(get_template_directory() . '/inc/templates/sunset_theme_support.php');
}

// Theme Support Options 

function sunset_post_formats_callback($input) {
    return $input;
} 

function sunset_theme_options() {
    echo 'Activate and Deactivate specific Theme Supoort Options';
}

//Sidebar options functions 
function sunset_post_formats() {
    $options = get_option('post_formats');
    $formats = array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' );
    $output = '';
    foreach($formats as $format) {
        $checked = ( @$options[$format] == 1 ? 'checked' : '');
        $output .= '<label><input type="checkbox" id="'.$format.'" name="post_formats['.$format.']" value="1" '.$checked.' /> '.$format.'</label><br>';
    }

    echo $output;
}