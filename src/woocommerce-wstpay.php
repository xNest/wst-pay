<?php
/*
Plugin Name: WooCommerce wstPay
Description: Add payment via wstPay to WooCommerce
Version: 1.0.0
Text Domain: wstpay
*/

add_action('plugins_loaded', 'init_woocommerce_gateway_wstpay', 0);

/**
 * Init function that runs after plugin install.
 */
function init_woocommerce_gateway_wstpay()
{
	if(!class_exists('WC_Payment_Gateway')) {
		return;
	}

	define('WOOCOMMERCE_WSTPAY_PLUGIN_DIR', plugin_dir_path(__FILE__));
	define('WOOCOMMERCE_WSTPAY_PLUGIN_URL', plugin_dir_url(__FILE__));

	require_once('includes/class.WCGatewayWstPay.php');

	add_filter('woocommerce_payment_gateways', 'add_wstpay_gateways');
}

/**
 * @param $methods
 *
 * @return array
 */
function add_wstpay_gateways($methods)
{
	$methods[] = 'WC_Gateway_WstPay';

	return $methods;
}
