<?php

class Genesis_Simple_Edits_Admin extends Genesis_Admin_Form {

	/**
	 * Settings field.
	 *
	 * @since 2.1.0
	 */
	public $settings_field;

	/**
	 * Constructor.
	 */
	public function __construct() {

		$this->settings_field = Genesis_Simple_Edits()->settings_field;

	}

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
				'page_title'  => __( 'Genesis - Simple Edits', 'genesis-simple-sidebars' ),
				'menu_title'  => __( 'Simple Edits', 'genesis-simple-sidebars' )
			)
		);

		// Use Genesis default
		$page_ops = array();

		$this->create( $page_id, $menu_ops, $page_ops, $this->settings_field, $this->get_default_settings() );

	}

	/**
	 * Get the default settings.
	 *
	 * @since 2.2.0
	 */
	public function get_default_settings() {

		$footer_html5 = sprintf( '<p>[footer_copyright before="%s "] &middot; [footer_childtheme_link before="" after=" %s"] [footer_genesis_link url="http://www.studiopress.com/" before=""] &middot; [footer_wordpress_link] &middot; [footer_loginout]</p>', __( 'Copyright', 'genesis-simple-edits' ), __( 'On', 'genesis-simple-edits' ) );
		$footer_xhtml = '<div class="gototop"><p>[footer_backtotop]</p></div><div class="creds"><p>' . __( 'Copyright', 'genesis-simple-edits' ) . ' [footer_copyright] [footer_childtheme_link] &middot; [footer_genesis_link] [footer_studiopress_link] &middot; [footer_wordpress_link] &middot; [footer_loginout]</p></div>';

		return array(
			'post_info'             => '[post_date] ' . __( 'By', 'genesis-simple-edits' ) . ' [post_author_posts_link] [post_comments] [post_edit]',
			'post_meta'             => '[post_categories] [post_tags]',
			'footer_backtotop_text' => '[footer_backtotop]',
			'footer_creds_text'     => sprintf( '[footer_copyright before="%s "] &middot; [footer_childtheme_link before="" after=" %s"] [footer_genesis_link url="http://www.studiopress.com/" before=""] &middot; [footer_wordpress_link] &middot; [footer_loginout]', __( 'Copyright', 'genesis-simple-edits' ), __( 'On', 'genesis-simple-edits' ) ),
			'footer_output_on'      => 0,
			'footer_output'         => current_theme_supports( 'html5' ) ? $footer_html5 : $footer_xhtml,
		);

	}

	public function scripts() {

		wp_enqueue_script( 'genesis-simple-edits-admin-js', Genesis_Simple_Edits()->plugin_dir_url . 'assets/js/admin.js', array( 'jquery' ), Genesis_Simple_Edits()->plugin_version, true );

	}

	/**
	 * Callback for displaying the Simple Sidebars admin form.
	 *
	 * @since 2.1.0
	 *
	 */
	public function form() {

		require_once( Genesis_Simple_Edits()->plugin_dir_path . 'includes/views/admin.php' );

	}

}
