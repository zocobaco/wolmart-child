<?php
/**
 * Zocoba Market - Theme Functions
 * Arquitectura Modular Orientada a Objetos.
 * * @package Wolmart Child
 */
defined( 'ABSPATH' ) || exit; // Seguridad: Evita acceso directo

// 1. Definir Constantes Globales
define( 'ZCB_VERSION', '1.0.0' );
define( 'ZCB_PATH', get_stylesheet_directory() );
define( 'ZCB_URI',  get_stylesheet_directory_uri() );

// 2. Autocarga de Clases (Manual simplificado para Child Themes)
require_once ZCB_PATH . '/inc/class-setup.php';
require_once ZCB_PATH . '/inc/class-assets.php';

// 3. Inicializar el Tema
// Instanciamos las clases para que sus hooks se activen.
new \Zocoba\inc\Setup();
new \Zocoba\inc\Assets();
