<?php
/**
 * WP W3C API (https://validator.w3.org/docs/api.html) & https://api.w3.org/doc
 *
 * @package WP-W3c-API
 */

/* Exit if accessed directly */
if ( ! defined( 'ABSPATH' ) ) { exit; }

/* Check if class exists. */
if ( ! class_exists( 'W3cAPI' ) ) {

	/**
	 * W3cAPI class.
	 */
	class W3cAPI {

		/**
		 * Return format. XML or JSON or GNU.
		 *
		 * @var [string
		 */
		static private $output;

		 /**
		 * URL to the API.
		 *
		 * @var string
		 */
		private $base_uri = 'https://validator.nu/';

		/**
		 * __construct function.
		 *
		 * @access public
		 * @return void
		 */
		public function __construct() {

			static::$api_key = $api_key;
			static::$output = $output;

		}

		 /**
		 * Fetch the request from the API.
		 *
		 * @access private
		 * @param mixed $request Request URL.
		 * @return $body Body.
		 */
		private function fetch( $request ) {

			$response = wp_remote_get( $request );
			$code = wp_remote_retrieve_response_code( $response );

			if ( 200 !== $code ) {
				return new WP_Error( 'response-error', sprintf( __( 'Server response code: %d', 'text-domain' ), $code ) );
			}

			$body = wp_remote_retrieve_body( $response );

			return json_decode( $body );

		}

		/**
		 * Validate HTML.
		 *
		 * @access public
		 * @param mixed $url
		 * @return void
		 */
		public function validate_html( $url ) {

			$request = $this->base_uri;

			return $this->fetch( $request );

		}

	}

}
