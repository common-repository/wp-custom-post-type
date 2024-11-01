<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://codethemes.co
 * @since             1.0.0
 * @package           WP_Custom_Post_Type
 *
 * @wordpress-plugin
 * Plugin Name:       WP Custom Post Type
 * Plugin URI:        https://codethemes.co/plugins/wp-custom-post-type
 * Description:       WP Custom Post Type Plugin is used to generate most common post types. The plugin now creates shortcodes so you can show the posts anywhere you want to with the shortcodes.
 * Version:           2.0.0
 * Author:            codepixelzmedia
 * Author URI:        https://codethemes.co
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       wp-custom-post-type
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WP_CUSTOM_POST_TYPE_VERSION', '2.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-custom-post-type-activator.php
 */
function activate_wp_custom_post_type() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-custom-post-type-activator.php';
	Wp_Custom_Post_Type_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-custom-post-type-deactivator.php
 */
function deactivate_wp_custom_post_type() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-custom-post-type-deactivator.php';
	Wp_Custom_Post_Type_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wp_custom_post_type' );
register_deactivation_hook( __FILE__, 'deactivate_wp_custom_post_type' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-custom-post-type.php';
require plugin_dir_path( __FILE__ ) . 'includes/Custom-function.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wp_custom_post_type() {

	$plugin = new Wp_Custom_Post_Type();
	$plugin->run();

}
run_wp_custom_post_type();

function delete_post_type(){
    if (in_array('wp-custom-post-type/wp-custom-post-type.php', apply_filters('active_plugins', get_option('active_plugins')))){
        $my_theme = wp_get_theme();
        $theme = $my_theme->get( 'TextDomain' );
        if($theme=='pasal-ecommerce'){
            unregister_post_type('Portfolio');
            unregister_post_type('Testimonial');
            unregister_post_type('Team');
            unregister_post_type('Client');
             unregister_post_type('Call Out');
        }


        else{
            return;
        }

    }
}
add_action('init','delete_post_type');

add_image_size('portfolio-image', 800, 700, true);
add_image_size('team-image', 800, 600, true);
add_image_size('testimonial-image', 300, 300, true);

function wp_custom_posttype_enqueue_custom()
{
   wp_enqueue_style('wp-custom-public-css', plugin_dir_url(__FILE__) . 'public/css/wp-custom-post-type-public.css', array(), 2018731, 'all');
    wp_enqueue_script('wp-custom-bootstrap-js', plugin_dir_url(__FILE__) . 'public/js/bootstrap.js', array('jquery'), false, true);

        wp_enqueue_script('wp-custom-slick-js', plugin_dir_url(__FILE__) . 'public/js/slick.js', array('jquery'), false, true);
  wp_enqueue_script('wp-custom-public-type-js', plugin_dir_url(__FILE__) . 'public/js/wp-custom-post-type-public.js', array('jquery'), false, true);
}

add_action('wp_enqueue_scripts', 'wp_custom_posttype_enqueue_custom');
