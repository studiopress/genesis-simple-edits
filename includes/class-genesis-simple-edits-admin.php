<?php
/**
 * Genesis Simple Edits Admin
 *
 * @package genesis-simple-edits
 */

/**
 * Admin Class
 *
 * @package genesis-simple-edits
 */
class Genesis_Simple_Edits_Admin extends Genesis_Admin_Form {

	/**
	 * Settings field.
	 *
	 * @var settings_field Settings Field
	 * @since 2.1.0
	 */
	public $settings_field;

	/**
	 * Constructor.
	 */
	public function __construct() {

		$this->settings_field = Genesis_Simple_Edits()->settings_field;

	}

	/**
	 * Initializes Admin Menu.
	 */
	public function init() {

		add_action( 'genesis_admin_menu', array( $this, 'admin_menu' ) );

	}

	/**
	 * Create an admin menu item and settings page.
	 *
	 * @since 1.0.0
	 *
	 * @uses Genesis_Admin::create() Register the admin page
	 *
	 * @see Genesis_Admin_Import_Export::actions() Handle creating, editing, and deleting sidebars.
	 */
	public function admin_menu() {

		$page_id = 'genesis-simple-edits';

		$menu_ops = array(
			'submenu' => array(
				'parent_slug' => 'genesis',
				'page_title'  => __( 'Genesis - Simple Edits', 'genesis-simple-edits' ),
				'menu_title'  => __( 'Simple Edits', 'genesis-simple-edits' ),
			),
		);

		// Use Genesis default.
		$page_ops = array();

		$this->create( $page_id, $menu_ops, $page_ops, $this->settings_field, $this->get_default_settings() );

	}

	/**
	 * Get the default settings.
	 *
	 * @since 2.2.0
	 */
	public function get_default_settings() {

		return array(
			'post_info'        => '[post_date] ' . __( 'By', 'genesis-simple-edits' ) . ' [post_author_posts_link] [post_comments] [post_edit]',
			'post_meta'        => '[post_categories] [post_tags]',
			'footer_output_on' => 0,
			'footer_output'    => sprintf( '<p>[footer_copyright before="%s "] &middot; [footer_childtheme_link before="" after=" %s"] [footer_genesis_link url="http://www.studiopress.com/" before=""] &middot; [footer_wordpress_link] &middot; [footer_loginout]</p>', __( 'Copyright', 'genesis-simple-edits' ), __( 'On', 'genesis-simple-edits' ) ),
		);

	}

	/**
	 * Sets up Javascript scripts.
	 */
	public function scripts() {

		wp_enqueue_script( 'genesis-simple-edits-admin-js', Genesis_Simple_Edits()->plugin_dir_url . '/assets/js/admin.js', array( 'jquery' ), GENESIS_SIMPLE_EDITS_VERSION, true );

	}

	/**
	 * Callback for displaying the Simple Sidebars admin form.
	 *
	 * @since 2.1.0
	 */
	public function form() {

		require_once Genesis_Simple_Edits()->plugin_dir_path . 'includes/views/admin.php';

	}

}
