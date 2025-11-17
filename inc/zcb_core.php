<?php
defined('ABSPATH') || exit;

// === Constantes del tema ===
define('ZCB_URI', get_theme_file_uri());
define('ZCB_PATH', get_theme_file_path());
define('ZCB_ASSETS_URI', ZCB_URI . '/assets');
define('ZCB_CSS_URI', ZCB_ASSETS_URI . '/css');
define('WCFM_PATH', ZCB_PATH . '/wcfm');
define('WCFM_CSS_URI', WCFM_PATH . '/css');

if (file_exists(WCFM_PATH . '/core-wcfm.php')) {
    include_once WCFM_PATH . '/core-wcfm.php';
}

// === GZIP ===
add_action('init', function () {
    if (!headers_sent() && extension_loaded('zlib') && !ini_get('zlib.output_compression')) {
        ini_set('zlib.output_compression', 'On');
        ini_set('zlib.output_compression_level', '6');
    }
});

// === Canonical SEO ===
add_action('wp_head', function () {
    if (!is_singular()) return;
    global $wp_query;
    $obj = $wp_query->get_queried_object();
    if (!empty($obj->ID) && is_numeric($obj->ID)) {
        echo '<link rel="canonical" href="' . esc_url(get_permalink($obj->ID)) . '">' . "\n";
    }
});

// === WebP ===
add_filter('file_is_displayable_image', function ($result, $path) {
    if ($result === true) return true;
    if (!file_exists($path) || !is_readable($path)) return false;
    $info = @getimagesize($path);
    return $info !== false && $info[2] === IMAGETYPE_WEBP;
}, 10, 2);
