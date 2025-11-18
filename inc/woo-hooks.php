<?php
/**
 * ZOCOBA - Hooks Personalizados de WooCommerce y Dokan
 *
 * Aquí modificamos la plantilla de producto estilo MercadoLibre
 * y otras personalizaciones de la tienda.
 */
defined( 'ABSPATH' ) || exit;


/*
 * =========================================================================
 * HOOKS DE PÁGINA DE PRODUCTO (Estilo MercadoLibre)
 * =========================================================================
 */

// 1. Mover el bloque "Vendido por" de Dokan
// Lo quitamos de su posición original (alta) para moverlo más abajo.
remove_action( 'woocommerce_single_product_summary', 'dokan_get_store_info', 10 );

// 2. Añade información de envío (como "Llega gratis mañana") después del precio.
// Prioridad 15 para que se muestre después del precio (prioridad 10).
add_action( 'woocommerce_single_product_summary', 'zocoba_add_shipping_info', 15 );
function zocoba_add_shipping_info() {
    
    // Aquí puedes añadir tu lógica de PHP para el envío.
    // Por ahora, es un ejemplo estático.
    
    // Usamos el color --brand-accent (verde) que definimos en el CSS.
    // Nota: Usamos Font Awesome 6 Pro (fas fa-truck) como definimos en los assets.
    echo '<div class="zocoba-shipping-info">
            <i class="fas fa-truck"></i>
            <span>Llega gratis mañana</span>
          </div>';
}

// 3. Añade los "Trust Badges" (Compra Protegida) después del botón de añadir al carrito.
// Prioridad 35 para que se muestre después de los botones (prioridad 30).
add_action( 'woocommerce_single_product_summary', 'zocoba_add_trust_badges', 35 );
function zocoba_add_trust_badges() {
    echo '<div class="zocoba-trust-badges">
            <div class="zocoba-trust-badge protected">
                <i class="fas fa-shield-alt"></i>
                <span>Compra Protegida con Zocoba</span>
            </div>
            <div class="zocoba-trust-badge warranty">
                <i class="fas fa-award"></i>
                <span>Garantía de 30 días</span>
            </div>
          </div>';
}

// 4. Volvemos a añadir el bloque "Vendido por" de Dokan al final.
// Prioridad 37, para que aparezca después de los Trust Badges.
add_action( 'woocommerce_single_product_summary', 'dokan_get_store_info', 37 );


/*
 * =========================================================================
 * HOOKS DE PÁGINA DE TIENDA (Shop/Archive)
 * =========================================================================
 */

// (Aquí puedes añadir más hooks para la página de tienda si los necesitas)