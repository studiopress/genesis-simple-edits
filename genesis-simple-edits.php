<?php

/**
 * The main class that handles the entire output, content filters, etc., for this plugin.
 *
 * @package Genesis Simple Edits
 * @since 1.0
 */
class Genesis_Simple_Edits {

	/**
	 * Plugin version
	 */
	public $plugin_version = '2.2.0';

	/**
	 * Minimum WordPress version.
	 */
	public $min_wp_version = '4.7.2';

	/**
	 * Minimum Genesis version.
	 */
	public $min_genesis_version = '2.4.2';

	/**
	 * The plugin textdomain, for translations.
	 */
	public $plugin_textdomain = 'genesis-simple-edits';

	/**
	 * The url to the plugin directory.
	 */
	public $plugin_dir_url;

	/**
	 * The path to the plugin directory.
	 */
	public $plugin_dir_path;

	/**
	 * The main settings field for this plugin.
	 */
	public $settings_field = 'gse-settings';

	/**
	 * Core functionality.
	 */
	public $core;

	/**
	 * Admin menu and settings page.
	 */
	public $admin;

	/**
	 * Constructor.
	 *
	 * @since 2.2.0
	 */
	function __construct() {

		$this->plugin_dir_url  = plugin_dir_url( __FILE__ );
		$this->plugin_dir_path = plugin_dir_path( __FILE__ );

		// For backward compatibility
		define( 'GSE_SETTINGS_FIELD', $this->settings_field );

	}

	/**
	 * Initialize.
	 *
	 * @since 2.2.0
	 */
	public function init() {

		$this->load_plugin_textdomain();

		add_action( 'admin_notices', array( $this, 'requirements_notice' ) );
		add_action( 'genesis_setup', array( $this, 'instantiate' ) );

	}

	/**
	 * Show admin notice if minimum requirements aren't met.
	 *
	 * @since 2.2.0
	 */
	public function requirements_notice() {

		if ( ! defined( 'PARENT_THEME_VERSION' ) || ! version_compare( PARENT_THEME_VERSION, $this->min_genesis_version, '>=' ) ) {

			$action = defined( 'PARENT_THEME_VERSION' ) ? __( 'upgrade to', 'genesis-simple-edits' ) : __( 'install and activate', 'genesis-simple-edits' );

			$message = sprintf( __( 'Genesis Simple Edits requires WordPress %s and Genesis %s, or greater. Please %s the latest version of <a href="%s" target="_blank">Genesis</a> to use this plugin.', 'genesis-simple-edits' ), $this->min_wp_version, $this->min_genesis_version, $action, 'http://my.studiopress.com/?download_id=91046d629e74d525b3f2978e404e7ffa' );
			echo '<div class="notice notice-warning"><p>' . $message . '</p></div>';

		}

	}

	/**
	 * Load the plugin textdomain, for translation.
	 *
	 * @since 2.2.0
	 */
	function load_plugin_textdomain() {
		load_plugin_textdomain( $this->plugin_textdomain, false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}

	/**
	 * Include the class file, instantiate the classes, create objects.
	 *
	 * @since 2.2.0
	 */
	public function instantiate() {

		require_once( $this->plugin_dir_path . 'includes/class-genesis-simple-edits-core.php' );
		$this->core = new Genesis_Simple_Edits_Core;
		$this->core->init();

		require_once( $this->plugin_dir_path . 'includes/class-genesis-simple-edits-admin.php' );
		$this->admin = new Genesis_Simple_Edits_Admin;
		$this->admin->init();

	}

}

/**
 * Helper function to retrieve the static object without using globals.
 *
 * @since 2.2.0
 */
function Genesis_Simple_Edits() {

	static $object;

	if ( null == $object ) {
		$object = new Genesis_Simple_Edits;
	}

	return $object;

}

/**
 * Initialize the object on `plugins_loaded`.
 */
add_action( 'plugins_loaded', array( Genesis_Simple_Edits(), 'init' ) );
