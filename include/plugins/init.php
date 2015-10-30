<?php
//Cyr to lat for Hashtag
function transliterate($textcyr = null, $textlat = null)
{
    $cyr = array(
        'ы', ' ', 'є', 'ї', 'ж', 'ч', 'щ', 'ш', 'ю', 'а', 'б', 'в', 'г', 'д', 'е', 'з', 'и', 'й', 'і', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ъ', 'ь', 'я',
        'Ы', 'Є', 'Ї', 'Ж', 'Ч', 'Щ', 'Ш', 'Ю', 'А', 'Б', 'В', 'Г', 'Д', 'Е', 'З', 'И', 'Й', 'І', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ъ', 'Ь', 'Я');
    $lat = array(
        'y', '_', 'ye', 'yi', 'zh', 'ch', 'sht', 'sh', 'yu', 'a', 'b', 'v', 'g', 'd', 'e', 'z', 'i', 'j', 'i', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'y', 'x', 'ya',
        'Y', 'Ye', 'Yi', 'Zh', 'Ch', 'Sht', 'Sh', 'Yu', 'A', 'B', 'V', 'G', 'D', 'E', 'Z', 'I', 'J', 'I', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'c', 'Y', 'X', 'Ya');
    if ($textcyr) {
        return str_replace($cyr, $lat, $textcyr);
    } else if ($textlat) {
        return str_replace($lat, $cyr, $textlat);
    } else {
        return null;
    }
}

/*
Plugin Name: Cyr to Lat enhanced
Plugin URI: http://wordpress.org/plugins/cyr3lat/
Description: Converts Cyrillic, European and Georgian characters in post, term slugs and media file names to Latin characters. Useful for creating human-readable URLs. Based on the original plugin by Anton Skorobogatov.
Author: Sol, Sergey Biryukov, Nikolay Karev, Dmitri Gogelia
Author URI: http://karevn.com/
Version: 3.5
 */
function ctl_sanitize_title($title)
{
    global $wpdb;
    $iso9_table = array(
        'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Ѓ' => 'G',
        'Ґ' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'YO', 'Є' => 'YE',
        'Ж' => 'ZH', 'З' => 'Z', 'Ѕ' => 'Z', 'И' => 'I', 'Й' => 'J',
        'Ј' => 'J', 'І' => 'I', 'Ї' => 'YI', 'К' => 'K', 'Ќ' => 'K',
        'Л' => 'L', 'Љ' => 'L', 'М' => 'M', 'Н' => 'N', 'Њ' => 'N',
        'О' => 'O', 'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T',
        'У' => 'U', 'Ў' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'TS',
        'Ч' => 'CH', 'Џ' => 'DH', 'Ш' => 'SH', 'Щ' => 'SHH', 'Ъ' => '',
        'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'YU', 'Я' => 'YA',
        'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'ѓ' => 'g',
        'ґ' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'є' => 'ye',
        'ж' => 'zh', 'з' => 'z', 'ѕ' => 'z', 'и' => 'i', 'й' => 'j',
        'ј' => 'j', 'і' => 'i', 'ї' => 'yi', 'к' => 'k', 'ќ' => 'k',
        'л' => 'l', 'љ' => 'l', 'м' => 'm', 'н' => 'n', 'њ' => 'n',
        'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't',
        'у' => 'u', 'ў' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'ts',
        'ч' => 'ch', 'џ' => 'dh', 'ш' => 'sh', 'щ' => 'shh', 'ъ' => '',
        'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu', 'я' => 'ya',
    );
    $geo2lat = array(
        'ა' => 'a', 'ბ' => 'b', 'გ' => 'g', 'დ' => 'd', 'ე' => 'e', 'ვ' => 'v',
        'ზ' => 'z', 'თ' => 'th', 'ი' => 'i', 'კ' => 'k', 'ლ' => 'l', 'მ' => 'm',
        'ნ' => 'n', 'ო' => 'o', 'პ' => 'p', 'ჟ' => 'zh', 'რ' => 'r', 'ს' => 's',
        'ტ' => 't', 'უ' => 'u', 'ფ' => 'ph', 'ქ' => 'q', 'ღ' => 'gh', 'ყ' => 'qh',
        'შ' => 'sh', 'ჩ' => 'ch', 'ც' => 'ts', 'ძ' => 'dz', 'წ' => 'ts', 'ჭ' => 'tch',
        'ხ' => 'kh', 'ჯ' => 'j', 'ჰ' => 'h',
    );
    $iso9_table = array_merge($iso9_table, $geo2lat);
    $locale = get_locale();
    switch ($locale) {
        case 'bg_BG':
            $iso9_table['Щ'] = 'SHT';
            $iso9_table['щ'] = 'sht';
            $iso9_table['Ъ'] = 'A';
            $iso9_table['ъ'] = 'a';
            break;
        case 'uk':
            $iso9_table['И'] = 'Y';
            $iso9_table['и'] = 'y';
            break;
        case 'uk_ua':
            $iso9_table['И'] = 'Y';
            $iso9_table['и'] = 'y';
            break;
    }
    $is_term = false;
    $backtrace = debug_backtrace();
    foreach ($backtrace as $backtrace_entry) {
        if ($backtrace_entry['function'] == 'wp_insert_term') {
            $is_term = true;
            break;
        }
    }
    $term = $is_term ? $wpdb->get_var("SELECT slug FROM {$wpdb->terms} WHERE name = '$title'") : '';
    if (empty($term)) {
        $title = strtr($title, apply_filters('ctl_table', $iso9_table));
        if (function_exists('iconv')) {
            $title = iconv('UTF-8', 'UTF-8//TRANSLIT//IGNORE', $title);
        }
        $title = preg_replace("/[^A-Za-z0-9'_\-\.]/", '-', $title);
        $title = preg_replace('/\-+/', '-', $title);
        $title = preg_replace('/^-+/', '', $title);
        $title = preg_replace('/-+$/', '', $title);
    } else {
        $title = $term;
    }
    return $title;
}

add_filter('sanitize_title', 'ctl_sanitize_title', 9);
add_filter('sanitize_file_name', 'ctl_sanitize_title');
function ctl_convert_existing_slugs()
{
    global $wpdb;
    $posts = $wpdb->get_results("SELECT ID, post_name FROM {$wpdb->posts} WHERE post_name REGEXP('[^A-Za-z0-9\-]+') AND post_status IN ('publish', 'future', 'private')");
    foreach ((array)$posts as $post) {
        $sanitized_name = ctl_sanitize_title(urldecode($post->post_name));
        if ($post->post_name != $sanitized_name) {
            add_post_meta($post->ID, '_wp_old_slug', $post->post_name);
            $wpdb->update($wpdb->posts, array('post_name' => $sanitized_name), array('ID' => $post->ID));
        }
    }
    $terms = $wpdb->get_results("SELECT term_id, slug FROM {$wpdb->terms} WHERE slug REGEXP('[^A-Za-z0-9\-]+') ");
    foreach ((array)$terms as $term) {
        $sanitized_slug = ctl_sanitize_title(urldecode($term->slug));
        if ($term->slug != $sanitized_slug) {
            $wpdb->update($wpdb->terms, array('slug' => $sanitized_slug), array('term_id' => $term->term_id));
        }
    }
}

function ctl_schedule_conversion()
{
    add_action('shutdown', 'ctl_convert_existing_slugs');
}

register_activation_hook(__FILE__, 'ctl_schedule_conversion');

require_once 'TGM-Plugin.php';
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.4.0
 * @author     Thomas Griffin <thomasgriffinmedia.com>
 * @author     Gary Jones <gamajo.com>
 * @copyright  Copyright (c) 2014, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/thomasgriffin/TGM-Plugin-Activation
 */
/**
 * Include the TGM_Plugin_Activation class.
 */
// require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';
add_action('tgmpa_register', 'my_theme_register_required_plugins');
function my_theme_register_required_plugins()
{

    $plugins = array(
        array(
            'name' => 'Contact Form 7',
            'slug' => 'contact-form-7',
            'required' => false,
        ),
        array(
            'name' => 'WP Migrate DB',
            'slug' => 'wp-migrate-db',
            'required' => false,
        ),
        array(
            'name' => 'Wp-scss',
            'slug' => 'wp-scss',
            'required' => true,
        ),
            array(
            'name' => 'Better WordPress Minify',
            'slug' => 'bwp-minify',
            'required' => false,
        ),
        array(
            'name' => 'Quick Bulk Post & Page Creator',
            'slug' => 'quick-bulk-post-page-creator',
            'required' => false,
        ),
        array(
            'name' => 'WP No Category Base',
            'slug' => 'wp-no-category-base',
            'required' => false,
        ),
        array(
            'name' => 'Post Thumbnail Editor',
            'slug' => 'post-thumbnail-editor',
            'required' => false,
        ),
             array(
            'name' => 'Resize Image After Upload',
            'slug' => 'resize-image-after-upload',
            'required' => false,
        ),

        array(
            'name' => 'TinyMCE Advanced',
            'slug' => 'tinymce-advanced',
            'required' => false,
        ),
             array(
            'name' => 'Duplicate post',
            'slug' => 'duplicate-post',
            'required' => false,
        ),
        array(
            'name' => 'AJAX Thumbnail Rebuild',
            'slug' => 'ajax-thumbnail-rebuild',
            'required' => false,
        ),
        array(
            'name' => 'Optimize Database after Deleting Revisions',
            'slug' => 'rvg-optimize-database',
            'required' => false,
        ),

        array(
            'name' => 'Advanced Custom Fields: PRO',
            'slug' => 'advanced-custom-fields-pro',
            'source' => get_stylesheet_directory() . '/include/plugins/advanced-custom-fields-pro.zip',
            'required' => false,
            'version' => '',
            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url' => 'http://www.advancedcustomfields.com/pro/', // If set, overrides default API URL and points to an external URL.
        ),
    );

    $config = array(
        'default_path' => '', // Default absolute path to pre-packaged plugins.
        'menu' => 'tgmpa-install-plugins', // Menu slug.
        'has_notices' => true, // Show admin notices or not.
        'dismissable' => true, // If false, a user cannot dismiss the nag message.
        'dismiss_msg' => '', // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false, // Automatically activate plugins after installation or not.
        'message' => '', // Message to output right before the plugins table.
        'strings' => array(
            'page_title' => __('Install Required Plugins', 'tgmpa'),
            'menu_title' => __('Install Plugins', 'tgmpa'),
            'installing' => __('Installing Plugin: %s', 'tgmpa'), // %s = plugin name.
            'oops' => __('Something went wrong with the plugin API.', 'tgmpa'),
            'notice_can_install_required' => _n_noop('This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.'), // %1$s = plugin name(s).
            'notice_can_install_recommended' => _n_noop('This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.'), // %1$s = plugin name(s).
            'notice_cannot_install' => _n_noop('Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.'), // %1$s = plugin name(s).
            'notice_can_activate_required' => _n_noop('The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.'), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop('The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.'), // %1$s = plugin name(s).
            'notice_cannot_activate' => _n_noop('Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.'), // %1$s = plugin name(s).
            'notice_ask_to_update' => _n_noop('The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.'), // %1$s = plugin name(s).
            'notice_cannot_update' => _n_noop('Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.'), // %1$s = plugin name(s).
            'install_link' => _n_noop('Begin installing plugin', 'Begin installing plugins'),
            'activate_link' => _n_noop('Begin activating plugin', 'Begin activating plugins'),
            'return' => __('Return to Required Plugins Installer', 'tgmpa'),
            'plugin_activated' => __('Plugin activated successfully.', 'tgmpa'),
            'complete' => __('All plugins installed and activated successfully. %s', 'tgmpa'), // %s = dashboard link.
            'nag_type' => 'updated', // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        ),
    );
    tgmpa($plugins, $config);
}
