<?php

add_action( 'wp_enqueue_scripts', 'wolmart_child_css', 1001 );

// Load CSS
function wolmart_child_css() {
	// wolmart child theme styles
	wp_deregister_style( 'styles-child' );
	wp_register_style( 'styles-child', esc_url( get_theme_file_uri() ) . '/style.css' );
	wp_enqueue_style( 'styles-child' );
}
// Remove the generator tag
function grd_woocommerce_script_cleaner() {
remove_action( 'wp_head', array( $GLOBALS['woocommerce'], 'generator' ) );
// Unless we're in the store, remove all the cruft!
if ( ! is_woocommerce() && ! is_cart() && ! is_checkout() ) {
wp_dequeue_style( 'woocommerce_frontend_styles' );
wp_dequeue_style( 'woocommerce-general');
wp_dequeue_style( 'woocommerce-layout' );
wp_dequeue_style( 'woocommerce-smallscreen' );
wp_dequeue_style( 'woocommerce_fancybox_styles' );
wp_dequeue_style( 'woocommerce_chosen_styles' );
wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
wp_dequeue_script( 'selectWoo' );
wp_deregister_script( 'selectWoo' );
wp_dequeue_script( 'wc-add-payment-method' );
wp_dequeue_script( 'wc-lost-password' );
wp_dequeue_script( 'wc_price_slider' );
wp_dequeue_script( 'wc-single-product' );
wp_dequeue_script( 'wc-add-to-cart' );
wp_dequeue_script( 'wc-cart-fragments' );
wp_dequeue_script( 'wc-credit-card-form' );
wp_dequeue_script( 'wc-checkout' );
wp_dequeue_script( 'wc-add-to-cart-variation' );
wp_dequeue_script( 'wc-single-product' );
wp_dequeue_script( 'wc-cart' );
wp_dequeue_script( 'wc-chosen' );
wp_dequeue_script( 'woocommerce' );
wp_dequeue_script( 'prettyPhoto' );
wp_dequeue_script( 'prettyPhoto-init' );
wp_dequeue_script( 'jquery-blockui' );
wp_dequeue_script( 'jquery-placeholder' );
wp_dequeue_script( 'jquery-payment' );
wp_dequeue_script( 'fancybox' );
wp_dequeue_script( 'jqueryui' );
}
}
add_action( 'wp_enqueue_scripts', 'grd_woocommerce_script_cleaner', 99 );
/**
 * Limpieza de wp_head()
 *
 * Elimina enlaces innecesarios
 * Elimina el CSS utilizado por el widget de comentarios recientes
 * Elimina el  CSS utilizado en las galerías
 * Elimina el cierre automático de etiquetas y cambia de ''s a "'s en rel_canonical()
 */
function nowp_head_cleanup() {
    // Eliminamos lo que sobra de la cabecera
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'feed_links', 2);
    remove_action('wp_head', 'index_rel_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'feed_links_extra', 3);
    remove_action('wp_head', 'start_post_rel_link', 10, 0);
    remove_action('wp_head', 'parent_post_rel_link', 10, 0);
    remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
    remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
    remove_action('wp_head', 'feed_links', 2);
    remove_action('wp_head', 'feed_links_extra', 3);
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    global $wp_widget_factory;
    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
    if (!class_exists('WPSEO_Frontend')) {
        remove_action('wp_head', 'rel_canonical');
        add_action('wp_head', 'nowp_rel_canonical');
    }
}
function nowp_rel_canonical() {
    global $wp_the_query;
    if (!is_singular()) {
        return;
    }
    if (!$id = $wp_the_query->get_queried_object_id()) {
        return;
    }
    $link = get_permalink($id);
    echo "\t<link rel=\"canonical\" href=\"$link\">\n";
}
add_action('init', 'nowp_head_cleanup');

// Remover hojas de estilos de pluginsfunction remover()
add_action( 'wp_enqueue_scripts', 'wcfm_style', 10000 );
function wcfm_style() {
    $url =  esc_url( home_url() ) . '/cdn';
    wp_deregister_style(  'wcfm_fa_icon_css');
    wp_deregister_style( 'fontawesome-free');
    wp_deregister_style( 'wcfm_menu_css');
    wp_register_style('core-store', "{$url}/store/store.css", array(), '1.0');
    wp_enqueue_style( 'core-store');
}
// Agregar SVG
function add_svg($mimes){$mimes['svg'] = 'image/svg+xml';return $mimes;}
add_filter('upload_mimes', 'add_svg');
/**
* Add Font
*/
function fa_import(){
// point the wp enqueue script to your wanted CSS files, for example the all.min.css
wp_enqueue_style( 'i-font', esc_url( get_theme_file_uri("assets") ) . '/font/css/all.min.css' );
}
add_action('wp_enqueue_scripts', 'fa_import');
// Remove Old Font Awesome CSS, optional if you don't want to load unnecessary font awesome files from elementor
add_action( 'elementor/frontend/after_register_styles',function() {
foreach( [ 'solid', 'regular', 'brands' ] as $style ) {
wp_deregister_style( 'elementor-icons-fa-' . $style );
}
}, 20 );

