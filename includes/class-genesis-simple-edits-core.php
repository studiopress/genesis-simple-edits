<?php
/**
 * Genesis Simple Edits Core
 *
 * @package genesis-simple-edits
 */

/**
 * Core Class
 */
class Genesis_Simple_Edits_Core {

	/**
	 * Settings field.
	 *
	 * @since 2.1.0
	 * @var $settings_field Settings Field
	 */
	private $settings_field;

	/**
	 * Constructor.
	 */
	public function __construct() {

		$this->settings_field = Genesis_Simple_Edits()->settings_field;

	}

	/**
	 * Init, sets up filters.
	 */
	public function init() {

		add_filter( 'genesis_post_info', array( $this, 'post_info_filter' ), 19 );
		add_filter( 'genesis_post_meta', array( $this, 'post_meta_filter' ), 19 );
		add_filter( 'genesis_footer_output', array( $this, 'footer_output_filter' ), 19 );

	}

	/**
	 * Post Info Filter
	 *
	 * @param Output $output Output.
	 */
	public function post_info_filter( $output ) {

		return genesis_get_option( 'post_info', $this->settings_field );

	}

	/**
	 * Post Meta Filter
	 *
	 * @param Output $output Output.
	 */
	public function post_meta_filter( $output ) {

		return genesis_get_option( 'post_meta', $this->settings_field );

	}

	/**
	 * Footer Output Filter
	 *
	 * @param Output $output Output.
	 */
	public function footer_output_filter( $output ) {

		if ( genesis_get_option( 'footer_output_on', $this->settings_field ) ) {
			return genesis_get_option( 'footer_output', $this->settings_field );
		}

		return $output;

	}

}
