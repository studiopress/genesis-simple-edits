<?php

class Genesis_Simple_Edits_Compat {

	/**
	 * Settings field.
	 *
	 * @since 2.2.2
	 */
	private $settings_field;

	/**
	 * The available fields.
	 *
	 * @since 2.2.2
	 */
	private $fields = array(
		'post_info' => '',
		'post_meta' => '',
		'footer_backtotop_text' => '',
		'footer_creds_text' => '',
		'footer_output' => '',
	);

	/**
	 * Constructor.
	 */
	public function __construct() {

		$this->settings_field = Genesis_Simple_Edits()->settings_field;

	}

	public function init() {

		if ( function_exists( 'pll_register_string' ) ) {

			foreach ( $this->fields as $field => $string ) {
				// Get strings. Do not use cache!
				$string = genesis_get_option( $field, $this->settings_field, false );
				// Register string in Polylang.
				pll_register_string( 'post_info', $string, 'genesis-simple-edits', true );
			}

		}

	}

}
