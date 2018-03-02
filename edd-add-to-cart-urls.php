<?php
/**
 * Plugin Name: EDD Add-to-Cart URLs
 * Plugin URI: https://renventura.com
 * Description: Adds the appropriate add-to-cart URL for your downloads so they can be easily copied and pasted whenever you need them.
 * Version: 1.0.0
 * Author: Ren Ventura
 * Author URI: https://renventura.com
 * Text Domain: edd-a2curl
 * Domain Path: /languages/
 *
 * License: GPL 2.0+
 * License URI: http://www.opensource.org/licenses/gpl-license.php
 */

/*
	Copyright 2018  Ren Ventura  (email : rv@renventura.com)

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License, version 2, as
	published by the Free Software Foundation.

	Permission is hereby granted, free of charge, to any person obtaining a copy of this
	software and associated documentation files (the "Software"), to deal in the Software
	without restriction, including without limitation the rights to use, copy, modify, merge,
	publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons
	to whom the Software is furnished to do so, subject to the following conditions:

	The above copyright notice and this permission notice shall be included in all copies or
	substantial portions of the Software.

	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
	IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
	FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
	AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
	LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
	OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
	THE SOFTWARE.
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'EDD_A2CURL' ) ) :

class EDD_A2CURL {

	private static $instance;

	public static function instance() {

		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof EDD_A2CURL ) ) {
			
			self::$instance = new EDD_A2CURL;

			self::$instance->hooks();
		}

		return self::$instance;
	}

	/**
	 * Action/filter hooks
	 */
	public function hooks() {

		register_activation_hook( __FILE__, array( $this, 'activate' ) );
		add_action( 'plugins_loaded', array( $this, 'loaded' ) );

		add_action( 'edd_meta_box_price_fields', array( $this, 'single_price_url' ), 99 );
		add_action( 'edd_download_price_table_row', array( $this, 'variable_price_url' ), 10, 3 );
	}

	/**
	 * Plugin activation
	 */
	public function activate() {
		if ( ! self::is_edd_active() ) {
			deactivate_plugins( __FILE__ );
			wp_die( __( 'EDD Add-to-Cart URLs requires Easy Digital Downloads to be active.', 'edd-a2curl' ) );
		}
	}

	/**
	 *	Load plugin text domain
	 */
	public function loaded() {

		$locale = is_admin() && function_exists( 'get_user_locale' ) ? get_user_locale() : get_locale();
		$locale = apply_filters( 'plugin_locale', $locale, 'edd-a2curl' );
		
		unload_textdomain( 'edd-a2curl' );
		
		load_textdomain( 'edd-a2curl', WP_LANG_DIR . '/edd-add-to-cart-urls/edd-add-to-cart-urls-' . $locale . '.mo' );
		load_plugin_textdomain( 'edd-a2curl', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}

	/**
	 * Add the URL for Downloads (no variable prices)
	 */
	public function single_price_url( $download_id ) {

		$download = new EDD_Download( $download_id );

		// Bail if dealing with variably priced Downloads (handled below)
		if ( $download->has_variable_prices() ) {
			return;
		}
		
		// Assemble query args
		$args = apply_filters( 'edd_a2curl_simple_price_query_args', array(
			'edd_action' => 'add_to_cart',
			'download_id' => $download_id
		) );

		// Assemble full URL
		$url = apply_filters(
				'edd_a2curl_simple_price_redirect_url',
				add_query_arg( $args, self::get_redirect_uri( $download_id ) ),
				$download_id
		);

		?>
		
		<div class="edd-a2c-url edd-custom-price-option-section">
			<span class="edd-custom-price-option-section-title" style="display: inline-block;"><?php _e( 'Add-to-Cart URL', 'edd-a2curl' ); ?></span>
			<span alt="f223" class="edd-help-tip dashicons dashicons-editor-help" title="<?php _e( 'Use this link to directly add a download to the user\'s cart. When clicked, the download will be added to the cart, and the user will be redirected.', 'edd-a2curl' ); ?>"></span>
			<input type="text" id="<?php echo "edd_a2curl_{$download_id}"; ?>" class="large-text" value="<?php esc_attr_e( $url ); ?>" readonly>
		</div>
	
	<?php }

	/**
	 * Add the URL for individual price options when variable pricing is enabled on the download
	 */
	function variable_price_url( $download_id, $key, $args ) {

		// Assemble query args
		$args = apply_filters( 'edd_a2curl_variable_price_query_args', array(
			'edd_action' => 'add_to_cart',
			'download_id' => $download_id,
			'edd_options' => array(
				'price_id' => $key
			)
		) );

		// Assemble full URL
		$url = apply_filters(
				'edd_a2curl_variable_price_redirect_url',
				add_query_arg( $args, self::get_redirect_uri( $download_id ) ),
				$download_id, $key
		);

		?>
		
		<div class="edd-a2c-url edd-custom-price-option-section">
			<span class="edd-custom-price-option-section-title" style="display: inline-block;"><?php _e( 'Add-to-Cart URL', 'edd-a2curl' ); ?></span>
			<span alt="f223" class="edd-help-tip dashicons dashicons-editor-help" title="<?php _e( 'Use this link to directly add this price option to the user\'s cart. When clicked, the download will be added to the cart, and the user will be redirected.', 'edd-a2curl' ); ?>"></span>
			<input type="text" id="<?php echo "edd_a2curl_{$download_id}_{$key}"; ?>" class="large-text" value="<?php esc_attr_e( $url ); ?>" readonly>
		</div>

	<?php }

	/**
	 * Gets the base Redirect URI
	 * Default: EDD checkout page
	 * @param (int) $download_id - ID of Download
	 * @return (string) - URI for the redirect
	 */
	public static function get_redirect_uri( $download_id = null ) {
		$download_id = ( get_post_type( $download_id ) === 'download' ) ? $download_id : null;
		return apply_filters( 'edd_a2curl_redirect_uri', edd_get_checkout_uri(), $download_id );
	}

	/**
	 * Check if EDD is active
	 */
	public static function is_edd_active() {
		return is_plugin_active( 'easy-digital-downloads/easy-digital-downloads.php' );
	}
}

endif;

/**
 *	Main function
 *	@return object EDD_A2CURL instance
 */
function EDD_A2CURL() {
	return EDD_A2CURL::instance();
}

/**
 *	Kick off!
 */
EDD_A2CURL();