<?php
/**
 * Plugin Name: Eazyproo Product Meta
 * Description: Standalone plugin for Eazyproo product meta tabs, settings, and requirements. Extracted from the Ticone theme.
 * Version: 1.1.7
 * Author: Your Name
 * Text Domain: eazyproo-product-meta
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Define Plugin Constants
define('EAZYPROO_VERSION', '1.1.7');
define('EAZYPROO_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('EAZYPROO_PLUGIN_URL', plugin_dir_url(__FILE__));

// Load Eazyproo Core Files
require_once EAZYPROO_PLUGIN_DIR . 'includes/helper.php';
require_once EAZYPROO_PLUGIN_DIR . 'includes/settings.php';
require_once EAZYPROO_PLUGIN_DIR . 'includes/custom-meta-fields.php';

// Load Global Admin Assets for Product Edit Screen
add_action('admin_enqueue_scripts', 'eazyproo_global_admin_assets');
function eazyproo_global_admin_assets($hook_suffix) {
    if (in_array($hook_suffix, array('post.php', 'post-new.php'))) {
        $screen = get_current_screen();
        if ($screen && $screen->post_type === 'product') {
            wp_enqueue_style('eazyproo-custom-admin', EAZYPROO_PLUGIN_URL . 'assets/css/admin-style.css', [], EAZYPROO_VERSION);
            wp_enqueue_script('eazyproo-custom-admin', EAZYPROO_PLUGIN_URL . 'assets/js/admin-script.js', array('jquery'), EAZYPROO_VERSION, true);
        }
    }
}
