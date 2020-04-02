<?php
/**
 * Genesis Simple Edits
 *
 * @package genesis-simple-edits
 */

define( 'GENESIS_SIMPLE_EDITS_DIR', plugin_dir_path( __FILE__ ) );
define( 'GENESIS_SIMPLE_EDITS_URL', plugins_url( '', __FILE__ ) );
define( 'GENESIS_SIMPLE_EDITS_VERSION', '2.3.1' );

require_once GENESIS_SIMPLE_EDITS_DIR . '/includes/class-genesis-simple-edits.php';

/**
 * Helper function to retrieve the static object without using globals.
 *
 * @since 2.2.0
 */
function genesis_simple_edits() {

	static $object;

	if ( null === $object ) {
		$object = new Genesis_Simple_Edits();
	}

	return $object;

}

/**
 * Initialize the object on `plugins_loaded`.
 */
add_action( 'plugins_loaded', array( Genesis_Simple_Edits(), 'init' ) );
