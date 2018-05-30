<?php

class Genesis_Simple_Edits_Compat {

	/**
	 * Settings field.
	 *
	 * @since 2.2.2
	 */
	private $settings_field;

	/**
	 * Constructor.
	 */
	public function __construct() {

		$this->settings_field = Genesis_Simple_Edits()->settings_field;

	}

	public function init() {

	}

}
