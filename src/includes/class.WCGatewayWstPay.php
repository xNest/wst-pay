<?php

/**
 * Class WC_Gateway_WstPay
 */
class WC_Gateway_WstPay extends WC_Payment_Gateway
{

	/**
	 * @var string
	 */
	const PAYMENT_METHOD = 'wstpay';

	/**
	 * @var string
	 */
	const VERSION = '1.0.0';

	/**
	 * initialise gateway with custom settings
	 */
	public function __construct()
	{

		$this->setup_properties();

		$this->title = $this->get_option('wstpay_title');
		$this->description = 'WstPay payments';

		$this->init_form_fields();
		$this->init_settings();

		$this->icon = self::get_image_src('wstpay.png');

		// region actions
		add_action('woocommerce_update_options_payment_gateways_' . $this->id, [
			$this,
			'process_admin_options',
		]);
		// endregion
	}

	/**
	 * Initialize form in admin panel.
	 */
	public function init_form_fields()
	{
		$this->form_fields = [
			'wstpay_enabled' => [
				'title'   => 'Enable / Disable',
				'type'    => 'checkbox',
				'label'   => 'Enable plugin',
				'default' => 'yes',
			],

		];
	}

	/**
	 * @param int $order_id
	 *
	 * @return array
	 */
	public function process_payment($order_id)
	{
		global $woocommerce;
		$order = new WC_Order($order_id);

		$order->payment_complete();

		// Remove cart
		$woocommerce->cart->empty_cart();

		// Return thankyou redirect
		return [
			'result'   => 'success',
			'redirect' => $this->get_return_url($order),
		];
	}

	/**
	 * @param string $file
	 *
	 * @return string
	 */
	public function get_image_src($file)
	{
		return WOOCOMMERCE_WSTPAY_PLUGIN_URL . 'resources/images/' . $file;
	}

	/**
	 * Setup general properties for the gateway.
	 */
	protected function setup_properties()
	{
		$this->id = self::PAYMENT_METHOD;
		$this->method_title = 'WstPay';
		$this->method_description = 'WstPay payments';
		$this->has_fields = false;
	}
}
