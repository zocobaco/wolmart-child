<?php
defined('ABSPATH') || exit;

// === Constantes del tema ===
define('ZCB_URI', get_theme_file_uri());
define('ZCB_PATH', get_theme_file_path());
define('ZCB_ASSETS_URI', ZCB_URI . '/assets');
define('ZCB_CSS_URI', ZCB_ASSETS_URI . '/css');


// === WebP ===
add_filter('file_is_displayable_image', function ($result, $path) {
    if ($result === true) return true;
    if (!file_exists($path) || !is_readable($path)) return false;
    $info = @getimagesize($path);
    return $info !== false && $info[2] === IMAGETYPE_WEBP;
}, 10, 2);
