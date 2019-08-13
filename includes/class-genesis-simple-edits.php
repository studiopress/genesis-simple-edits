<?php
/**
 * The main class that handles the entire output, content filters, etc., for this plugin.
 *
 * @package genesis-simple-edits
 * @since 1.0
 */

/**
 * Main Class
 *
 * @since 1.0
 */
class Genesis_Simple_Edits {

	/**
	 * Minimum WordPress version.
	 *
	 * @var $min_wp_version Minimum WordPress version
	 */
	public $min_wp_version = '5.0.0';

	/**
	 * Minimum Genesis version.
	 *
	 * @var $min_genesis_version Minimum Genesis version
	 */
	public $min_genesis_version = '3.1.0';

	/**
	 * The plugin textdomain, for translations.
	 *
	 * @var $plugin_textdomain The plugin textdomain
	 */
	public $plugin_textdomain = 'genesis-simple-edits';

	/**
	 * The url to the plugin directory.
	 *
	 * @var $plugin_dir_url The url to the Plugin Directory
	 */
	public $plugin_dir_url;

	/**
	 * The path to the plugin directory.
	 *
	 * @var $plugin_dir_path The path to the plugin directory
	 */
	public $plugin_dir_path;

	/**
	 * The main settings field for this plugin.
	 *
	 * @var $settings_field The main settings field for this plugin
	 */
	public $settings_field = 'gse-settings';

	/**
	 * Core functionality.
	 *
	 * @var $core Core functionality
	 */
	public $core;

	/**
	 * Admin menu and settings page.
	 *
	 * @var $admin Admin menu and settings page
	 */
	public $admin;

	/**
	 * Constructor.
	 *
	 * @since 2.2.0
	 */
	public function __construct() {

		$this->plugin_dir_url  = GENESIS_SIMPLE_EDITS_URL;
		$this->plugin_dir_path = GENESIS_SIMPLE_EDITS_DIR;

		// For backward compatibility.
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

			// Translators: String 1 is the version of WordPress required, String 2 is the version of Genesis required. String 3 is an expected action to take, String 4 is the URL of the Genesis Plugin.
			$message = sprintf( __( 'Genesis Simple Edits requires WordPress %1$s and Genesis %2$s, or greater. Please %3$s the latest version of <a href="%4$s" target="_blank">Genesis</a> to use this plugin.', 'genesis-simple-edits' ), $this->min_wp_version, $this->min_genesis_version, $action, 'http://my.studiopress.com/?download_id=91046d629e74d525b3f2978e404e7ffa' );
			echo '<div class="notice notice-warning"><p>';
			echo wp_kses(
				$message,
				array(
					'a' => array(
						'href'   => array(),
						'target' => array(),
					),
				)
			);
			echo '</p></div>';

		}

	}

	/**
	 * Load the plugin textdomain, for translation.
	 *
	 * @since 2.2.0
	 */
	public function load_plugin_textdomain() {
		load_plugin_textdomain( $this->plugin_textdomain, false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}

	/**
	 * Include the class file, instantiate the classes, create objects.
	 *
	 * @since 2.2.0
	 */
	public function instantiate() {

		require_once $this->plugin_dir_path . 'includes/class-genesis-simple-edits-core.php';
		$this->core = new Genesis_Simple_Edits_Core();
		$this->core->init();

		if ( is_admin() ) {
			require_once $this->plugin_dir_path . 'includes/class-genesis-simple-edits-admin.php';
			$this->admin = new Genesis_Simple_Edits_Admin();
			$this->admin->init();
		}

	}

}
