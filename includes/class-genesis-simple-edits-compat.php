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

				// If were on the frontend, load the translated string and populate it.
				if ( ! is_admin() ) {
					$string = pll__( $string );
					$this->fields[ $field ] = $string;
				}
			}

			// If were on the frontend, filter the genesis options for this plugin so the translated strings will be returned.
			if ( ! is_admin() ) {
				add_filter( 'genesis_options', array( $this, 'filter_genesis_options_polylang' ), 10, 2 );
			}
		}

	}

	public function filter_genesis_options_polylang( $options, $setting ) {
		if ( $setting !== $this->settings_field ) {
			return $options;
		}

		return array_replace( $options, $this->fields );
	}

}
