<?php
/*
Plugin Name: WooCommerce ANZ eGate Gateway
Plugin URI: http://woothemes.com/woocommerce
Description: Extends WooCommerce with an ANZ eGate gateway. An ANZ Merchant (Australia) account, Curl support, and a server with SSL support and an SSL certificate is required (for security reasons) for this gateway to function.
Version: 2.1.3
Author: WooThemes
Author URI: http://woothemes.com/

	Copyright: © 2009-2011 WooThemes.
	License: GNU General Public License v3.0
	License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

/**
 * Required functions
 */
if ( ! function_exists( 'woothemes_queue_update' ) ) {
	require_once( 'woo-includes/woo-functions.php' );
}

/**
 * Plugin updates
 */
woothemes_queue_update( plugin_basename( __FILE__ ), 'a80fbcb4d8d2822daf85442b2d647add', '18739' );

/**
 * Plugin page links
 */
function wc_gateway_anz_plugin_links( $links ) {
	$plugin_links = array(
		'<a href="http://support.woothemes.com/">' . __( 'Support', 'woocommerce-gateway-anz-egate' ) . '</a>',
		'<a href="http://docs.woothemes.com/document/anz-egate/">' . __( 'Docs', 'woocommerce-gateway-anz-egate' ) . '</a>',
	);
	return array_merge( $plugin_links, $links );
}

add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'wc_gateway_anz_plugin_links' );

/**
 * wc_gateway_anz_init function.
 */
function wc_gateway_anz_init() {
	if ( ! class_exists( 'WC_Payment_Gateway' ) ) {
		return;
	}

    /**
     * Localisation
     */
    load_plugin_textdomain( 'woocommerce-gateway-anz-egate', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

	/**
 	 * Gateway class
 	 */
	class WC_Gateway_ANZ_Egate extends WC_Payment_Gateway {

		/**
		 * __construct function.
		 *
		 * @access public
		 * @return void
		 */
		public function __construct() {
			$this->id                 = 'anz_egate';
			$this->method_title       = __( 'ANZ eGate', 'woocommerce-gateway-anz-egate' );
			$this->method_description = __( 'ANZ eGate offers a complete payment gateway service allowing credit card processing via the internet.', 'woocommerce-gateway-anz-egate' );
			$this->icon               = WP_PLUGIN_URL . "/" . plugin_basename( dirname( __FILE__ ) ) . '/assets/images/cards.png';
			$this->has_fields		  = true;

			// Load the form fields.
			$this->init_form_fields();

			// Load the settings.
			$this->init_settings();

			// Define user set variables
			$this->access_code = $this->settings['access_code'];
			$this->title       = $this->settings['title'];
			$this->testmode    = $this->settings['testmode'];
			$this->description = $this->settings['description'];
			$this->merchant    = $this->settings['merchant'];
			$this->endpoint    = 'https://migs.mastercard.com.au/vpcdps';

			if ( $this->testmode == 'yes' && substr( $this->merchant, 0, 4 ) !== 'TEST' ) {
				$this->merchant = 'TEST' . $this->merchant;
			}

			add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ) );
		}

		/**
	     * Initialise Gateway Settings Form Fields
	     */
	    public function init_form_fields() {
	    	$this->form_fields = array(
				'enabled'         => array(
					'title'       => __( 'Enable/Disable', 'woocommerce-gateway-anz-egate' ),
					'label'       => __( 'Enable ANZ eGate', 'woocommerce-gateway-anz-egate' ),
					'type'        => 'checkbox',
					'description' => '',
					'default'     => 'no'
				),
				'title'           => array(
					'title'       => __( 'Title', 'woocommerce-gateway-anz-egate' ),
					'type'        => 'text',
					'description' => __( 'This controls the title which the user sees during checkout.', 'woocommerce-gateway-anz-egate' ),
					'default'     => __( 'Credit card (ANZ)', 'woocommerce-gateway-anz-egate' ),
					'desc_tip'    => true
				),
				'description'     => array(
					'title'       => __( 'Description', 'woocommerce-gateway-anz-egate' ),
					'type'        => 'text',
					'description' => __( 'This controls the description which the user sees during checkout.', 'woocommerce-gateway-anz-egate' ),
					'default'     => __( 'Pay with your credit card via ANZ eGate.', 'woocommerce-gateway-anz-egate' ),
					'desc_tip'    => true
				),
				'testmode'        => array(
					'title'       => __( 'Test Mode', 'woocommerce-gateway-anz-egate' ),
					'label'       => __( 'Enable Test Mode', 'woocommerce-gateway-anz-egate' ),
					'type'        => 'checkbox',
					'description' => __( 'Place the payment gateway in development mode.', 'woocommerce-gateway-anz-egate' ),
					'default'     => 'no',
					'desc_tip'    => true
				),
				'merchant'   => array(
					'title'       => __( 'Merchant ID', 'woocommerce-gateway-anz-egate' ),
					'type'        => 'text',
					'description' => __( 'This will be provided by ANZ.', 'woocommerce-gateway-anz-egate' ),
					'default'     => '',
					'desc_tip'    => true
				),
				'access_code' => array(
					'title'       => __( 'Access Code', 'woocommerce-gateway-anz-egate' ),
					'type'        => 'password',
					'description' => __( 'This will be provided by ANZ.', 'woocommerce-gateway-anz-egate' ),
					'default'     => '',
					'desc_tip'    => true
				)
			);
		}

		/**
		 * is_available function.
		 * @return bool
		 */
		public function is_available() {
			if ( "yes" === $this->enabled ) {
				if ( ! is_ssl() && $this->testmode == "no" ) {
					return false;
				}
				// Currency check
				if ( ! in_array( get_woocommerce_currency(), array( 'AUD', 'NZD' ) ) ) {
					return false;
				}
				// Required fields check
				if ( ! $this->access_code || ! $this->merchant ) {
					return false;
				}
				return true;
			}
			return false;
		}

		/**
	     * Payment form on checkout page
	     */
		public function payment_fields() {
			if ( $this->testmode == 'yes' ) {
				$this->description .= ' ' . __( 'TEST MODE/SANDBOX ENABLED', 'woocommerce-gateway-anz-egate' );
			}
			if ( $this->description ) {
				echo wpautop( wptexturize( $this->description ) );
			}
			$this->credit_card_form();
		}

		/**
		 * Process the payment and return the result
		 */
		public function process_payment( $order_id ) {
			$order          = wc_get_order( $order_id );
			$card_number    = ! empty( $_POST['anz_egate-card-number'] ) ? str_replace( array( ' ', '-' ), '', wc_clean( $_POST['anz_egate-card-number'] ) ) : '';
			$card_csc       = ! empty( $_POST['anz_egate-card-cvc'] ) ? wc_clean( $_POST['anz_egate-card-cvc'] ) : '';
			$card_expiry    = ! empty( $_POST['anz_egate-card-expiry'] ) ? wc_clean( $_POST['anz_egate-card-expiry'] ) : '';
			$card_expiry    = implode( '', array_map( 'trim', explode( '/', $card_expiry ) ) );
			$card_exp_year  = substr( $card_expiry, 2, 2 );
			$card_exp_month = substr( $card_expiry, 0, 2 );

			$order_ref = $order_id . '/' . md5( microtime() );
			if ( strlen( $order_ref ) > 40 ) {
				$order_ref = substr( $order_ref, 0, 40 );
			}

			$request                       = new stdClass();
			$request->vpc_Version          = 1;
			$request->vpc_Command          = 'pay';
			$request->vpc_MerchTxnRef      = $order_ref;
			$request->vpc_AccessCode       = $this->access_code;
			$request->vpc_Merchant         = $this->merchant;
			$request->vpc_OrderInfo        = preg_replace( '/[^\da-z]/i', '', $order->get_order_number() );
			$request->vpc_Amount           = $order->get_total() * 100;
			$request->vpc_CardNum          = $card_number;
			$request->vpc_CardExp          = $card_exp_year . $card_exp_month;
			$request->vpc_CardSecurityCode = $card_csc;

			try {
				if ( empty( $card_number ) ) {
					throw new Exception( __( 'Please enter your card number.', 'woocommerce-gateway-anz-egate' ) );
				}

				$response = wp_remote_post( $this->endpoint, array(
				    'method'    => 'POST',
				    'body'      => http_build_query( $request ),
				    'timeout'   => 70
				) );

				if ( is_wp_error( $response ) ) {
					throw new Exception( __( 'There was a problem connecting to the payment gateway.', 'woocommerce-gateway-anz-egate' ) );
				}

				if ( empty( $response['body'] ) ) {
					throw new Exception( __( 'Empty response.', 'woocommerce-gateway-anz-egate' ) );
				}

				parse_str( $response['body'], $parsed_response );

				$response_code = $parsed_response['vpc_TxnResponseCode'];

				switch ( $response_code ) {
					case "0" :
						// Add order note
						$order->add_order_note( sprintf( __( 'ANZ payment completed (Transaction # %s)', 'woocommerce-gateway-anz-egate' ), $parsed_response['vpc_TransactionNo'] ) );

						// Payment complete
						$order->payment_complete();

						// Remove cart
						WC()->cart->empty_cart();

						// Return thank you page redirect
						return array(
							'result' 	 => 'success',
							'redirect'	 => $this->get_return_url( $order )
						);
					break;
					default :
						// Payment failed :(
						$order->update_status( 'failed', sprintf( __( 'ANZ payment failed. Payment was rejected due to an error: %s', 'woocommerce-gateway-anz-egate' ), $parsed_response['vpc_Message'] ) );
						$message = ( sprintf( __( 'Payment failed: %s', 'woocommerce-gateway-anz-egate' ), $parsed_response['vpc_Message'] ) );
						wc_add_notice( $message, 'error' );
						return;
					break;
				}
			} catch ( Exception $e ) {
				$message( sprintf( __( 'Error: %s', 'woocommerce-gateway-anz-egate' ), $e->getMessage() ) );
				wc_add_notice( $message, 'error' );
				return;
			}
		}
	}

	/**
	 * wc_gateway_anz_add function.
	 *
	 * @access public
	 * @param mixed $methods
	 * @return void
	 */
	function wc_gateway_anz_add( $methods ) {
		$methods[] = 'WC_Gateway_ANZ_Egate';
		return $methods;
	}
	add_filter( 'woocommerce_payment_gateways', 'wc_gateway_anz_add' );
}

add_action( 'plugins_loaded', 'wc_gateway_anz_init', 0 );
