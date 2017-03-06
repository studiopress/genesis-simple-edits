<?php

class Genesis_Simple_Edits_Core {

	/**
	 * Settings field.
	 *
	 * @since 2.1.0
	 */
	private $settings_field;

	/**
	 * Constructor.
	 */
	public function __construct() {

		$this->settings_field = Genesis_Simple_Edits()->settings_field;

	}

	public function init() {

		add_filter( 'genesis_post_info', array( $this, 'post_info_filter' ), 19 );
		add_filter( 'genesis_post_meta', array( $this, 'post_meta_filter' ), 19 );
		add_filter( 'genesis_footer_backtotop_text', array( $this, 'footer_backtotop_filter' ), 19 );
		add_filter( 'genesis_footer_creds_text', array( $this, 'footer_creds_filter' ), 19 );
		add_filter( 'genesis_footer_output', array( $this, 'footer_output_filter' ), 19 );

	}


	function post_info_filter( $output ) {

		return genesis_get_option( 'post_info', $this->settings_field );

	}

	function post_meta_filter( $output ) {

		return genesis_get_option( 'post_meta', $this->settings_field );

	}

	function footer_backtotop_filter( $output ) {

		return genesis_get_option( 'footer_backtotop_text', $this->settings_field );

	}

	function footer_creds_filter( $output ) {

		return genesis_get_option( 'footer_creds_text', $this->settings_field );

	}

	function footer_output_filter( $output ) {

		if ( genesis_get_option( 'footer_output_on', $this->settings_field ) ) {
			return genesis_get_option( 'footer_output', $this->settings_field );
		}

		return $output;

	}

}
