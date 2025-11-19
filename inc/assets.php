<?php
defined('ABSPATH') || exit;

add_action('wp_enqueue_scripts', function () {
    
    // 1. Cargar Tema Padre
    wp_enqueue_style('wolmart-theme');

    // 2. FontAwesome 6 (Para iconos pro tipo Amazon)
    wp_enqueue_style('zcb-icons', ZCB_URI . '/assets/fontawesone/css/all.min.css', [], '6.4.0');

    // 3. Tu Estilo Maestro (Compilado de SCSS)
    // Dependencia: 'elementor-frontend' asegura que cargue DESPUÉS de Elementor
    wp_enqueue_style(
        'zcb-global',
        ZCB_URI . '/assets/css/style.css',
        ['wolmart-theme', 'elementor-frontend'], 
        filemtime(ZCB_PATH . '/assets/css/style.css')
    );

}, 9999); // Prioridad máxima