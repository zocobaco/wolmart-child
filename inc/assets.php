<?php
defined('ABSPATH') || exit;

add_action('wp_enqueue_scripts', function () {
    
    // 1. Cargar Tema Padre (Wolmart)
    wp_enqueue_style('wolmart-theme');

    // 2. Cargar Iconos (FontAwesome 6 - Necesario para el diseño ML)
    wp_enqueue_style(
        'zcb-fontawesome', 
        ZCB_URI . '/assets/fontawesone/css/all.min.css', 
        [], 
        '6.4.0'
    );

    // 3. Cargar Estilo UNIFICADO (Compilado desde SCSS)
    // Este archivo contendrá TODO tu diseño personalizado.
    wp_enqueue_style(
        'zcb-main',
        ZCB_URI . '/assets/css/style.css',
        ['wolmart-theme'], 
        filemtime(ZCB_PATH . '/assets/css/style.css') 
    );

}, 9999); // Prioridad alta para sobrescribir al padre