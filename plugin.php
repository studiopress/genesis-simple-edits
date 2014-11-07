<?php
/*
	Plugin Name: Genesis Simple Edits
	Plugin URI: http://www.studiopress.com/plugins/genesis-simple-edits
	Description: Genesis Simple Edits lets you edit the three most commonly modified areas in any Genesis theme: the post-info, the post-meta, and the footer area.
	Author: Nathan Rice
	Author URI: http://www.nathanrice.net/

	Version: 2.1.1

	License: GNU General Public License v2.0 (or later)
	License URI: http://www.opensource.org/licenses/gpl-license.php
*/

/**
 * The main class that handles the entire output, content filters, etc., for this plugin.
 *
 * @package Genesis Simple Edits
 * @since 1.0
 */
class Genesis_Simple_Edits {
	
	/** Constructor */
	function __construct() {
		
		register_activation_hook( __FILE__, array( $this, 'activation_hook' ) );
		
		define( 'GSE_SETTINGS_FIELD', 'gse-settings' );
		
		add_action( 'admin_init', array( $this, 'javascript' ) );
		add_action( 'admin_init', array( $this, 'reset' ) );
		add_action( 'admin_init', array( $this, 'register_settings' ) );
		add_action( 'admin_menu', array( $this, 'add_menu' ), 15 );
		add_action( 'admin_notices', array( $this, 'notices' ) );
		
		add_filter( 'genesis_post_info', array( $this, 'post_info_filter' ), 20 );
		add_filter( 'genesis_post_meta', array( $this, 'post_meta_filter' ), 20 );
		add_filter( 'genesis_footer_backtotop_text', array( $this, 'footer_backtotop_filter' ), 20 );
		add_filter( 'genesis_footer_creds_text', array( $this, 'footer_creds_filter' ), 20 );
		add_filter( 'genesis_footer_output', array( $this, 'footer_output_filter' ), 20 );
	
	}
	
	function activation_hook() {

		if ( ! defined( 'PARENT_THEME_VERSION' ) || ! version_compare( PARENT_THEME_VERSION, '2.1.0', '>=' ) ) {
			deactivate_plugins( plugin_basename( __FILE__ ) ); /** Deactivate ourself */
			wp_die( sprintf( __( 'Sorry, you cannot activate without <a href="%s">Genesis %s</a> or greater', 'genesis-simple-edits' ), 'http://my.studiopress.com/?download_id=91046d629e74d525b3f2978e404e7ffa', '2.1.0' ) );
		}
		
	}
	
	function javascript() {
		
		wp_enqueue_script( 'genesis-simple-edits-js', plugin_dir_url(__FILE__) . 'js/admin.js', array( 'jquery' ), '2.1.0', true );
		
	}
	
	function register_settings() {
		register_setting( GSE_SETTINGS_FIELD, GSE_SETTINGS_FIELD );
		add_option( GSE_SETTINGS_FIELD, $this->settings_defaults() );
	}
	
	function reset() {
		
		if ( ! isset( $_REQUEST['page'] ) || 'genesis-simple-edits' != $_REQUEST['page'] )
			return;

		if ( genesis_get_option( 'reset', GSE_SETTINGS_FIELD ) ) {
			update_option( GSE_SETTINGS_FIELD, $this->settings_defaults() );
			wp_redirect( admin_url( 'admin.php?page=genesis-simple-edits&reset=true' ) );
			exit;
		}
		
	}
	
	function notices() {
		
		if ( ! isset( $_REQUEST['page'] ) || 'genesis-simple-edits' != $_REQUEST['page'] )
			return;

		if ( isset( $_REQUEST['reset'] ) && 'true' == $_REQUEST['reset'] ) {
			echo '<div id="message" class="updated"><p><strong>' . __( 'Simple Edits Reset', 'genesis-simple-edits' ) . '</strong></p></div>';
		}
		elseif ( isset( $_REQUEST['updated'] ) && 'true' == $_REQUEST['updated'] ) {  
			echo '<div id="message" class="updated"><p><strong>' . __( 'Simple Edits Saved', 'genesis-simple-edits' ) . '</strong></p></div>';
		}
		
	}
	
	function settings_defaults() {

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
	
	function add_menu() {
		
		add_submenu_page( 'genesis', __( 'Genesis - Simple Edits', 'genesis-simple-edits' ), __( 'Simple Edits','genesis-simple-edits' ), 'manage_options', 'genesis-simple-edits', array( &$this, 'admin_page' ) );
	
	}
	
	function admin_page() { ?>
	
		<div class="wrap">
			<form method="post" action="options.php">
			<?php settings_fields( GSE_SETTINGS_FIELD ); // important! ?>
			
			<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
				
				<table class="form-table"><tbody>
					
					<tr>
						<th scope="row"><p><label for="<?php echo GSE_SETTINGS_FIELD; ?>[post_info]"><b><?php _e( 'Entry Meta (above content)', 'genesis-simple-edits' ); ?></b></label></p></th>
						<td>
							<p><input type="text" name="<?php echo GSE_SETTINGS_FIELD; ?>[post_info]" id="<?php echo GSE_SETTINGS_FIELD; ?>[post_info]" value="<?php echo esc_attr( genesis_get_option( 'post_info', GSE_SETTINGS_FIELD ) ); ?>" size="125" /></p>
						</td>
					</tr>
					
					<tr>
						<th scope="row"><p><label for="<?php echo GSE_SETTINGS_FIELD; ?>[post_meta]"><b><?php _e( 'Entry Meta (below content)', 'genesis-simple-edits' ); ?></b></label></p></th>
						<td>
							<p><input type="text" name="<?php echo GSE_SETTINGS_FIELD; ?>[post_meta]" id="<?php echo GSE_SETTINGS_FIELD; ?>[post_meta]" value="<?php echo esc_attr( genesis_get_option( 'post_meta', GSE_SETTINGS_FIELD ) ); ?>" size="125" /></p>
							
							<p><small><a class="post-shortcodes-toggle" href="#"><?php _e( 'Show available entry meta shortcodes', 'genesis-simple-edits' ) ?></a></small></p>
							
						</td>
					</tr>
					
					<tr class="post-shortcodes" style="display: none;">
						<th scope="row"><p><span class="description"><?php _e( 'Shortcode Reference', 'genesis-simple-edits' ); ?></span></p></th>
						<td>
							<p><span class="description"><?php _e( 'NOTE: For a more comprehensive shortcode usage guide, <a href="http://my.studiopress.com/docs/shortcode-reference/" target="_blank">see this page</a>.', 'genesis-simple-edits' ); ?>
							<p>
								<ul>
									<li>[post_date] - <span class="description"><?php _e( 'Date the entry was published', 'genesis-simple-edits' ); ?></span></li>
									<li>[post_modified_date] - <span class="description"><?php _e( 'Date the entry was last modified', 'genesis-simple-edits' ); ?></span></li>
									<li>[post_time] - <span class="description"><?php _e( 'Time the entry was published', 'genesis-simple-edits' ); ?></span></li>
									<li>[post_modified_time] - <span class="description"><?php _e( 'Time the entry was last modified', 'genesis-simple-edits' ); ?></span></li>
									<li>[post_author] - <span class="description"><?php _e( 'Entry author display name', 'genesis-simple-edits' ); ?></span></li>
									<li>[post_author_link] - <span class="description"><?php _e( 'Entry author display name, linked to their website', 'genesis-simple-edits' ); ?></span></li>
									<li>[post_author_posts_link] - <span class="description"><?php _e( 'Entry author display name, linked to their archive', 'genesis-simple-edits' ); ?></span></li>
									<li>[post_comments] - <span class="description"><?php _e( 'Entry comments link', 'genesis-simple-edits' ); ?></span></li>
									<li>[post_tags] - <span class="description"><?php _e( 'List of entry tags', 'genesis-simple-edits' ); ?></span></li>
									<li>[post_categories] - <span class="description"><?php _e( 'List of entry categories', 'genesis-simple-edits' ); ?></span></li>
									<li>[post_edit] - <span class="description"><?php _e( 'Entry edit link (visible to admins)', 'genesis-simple-edits' ); ?></span></li>
								</ul>
							</p>
						</td>
					</tr>

					<?php if ( ! genesis_html5() ) : ?>
					<tr>
						<th scope="row"><p><label for="<?php echo GSE_SETTINGS_FIELD; ?>[footer_backtotop_text]"><b><?php _e( 'Footer "Back to Top" Link', 'genesis-simple-edits' ); ?></b></label></p></th>
						<td>
							<p><input type="text" name="<?php echo GSE_SETTINGS_FIELD; ?>[footer_backtotop_text]" id="<?php echo GSE_SETTINGS_FIELD; ?>[footer_backtotop_text]" value="<?php echo esc_attr( genesis_get_option( 'footer_backtotop_text', GSE_SETTINGS_FIELD ) ); ?>" size="125" /></p>
						</td>
					</tr>
					<?php endif; ?>
					
					<tr>
						<th scope="row"><p><label for="<?php echo GSE_SETTINGS_FIELD; ?>[footer_creds_text]"><b><?php _e( 'Footer Credits Text', 'genesis-simple-edits' ); ?></b></label></p></th>
						<td>
							<p><input type="text" name="<?php echo GSE_SETTINGS_FIELD; ?>[footer_creds_text]" id="<?php echo GSE_SETTINGS_FIELD; ?>[footer_creds_text]" value="<?php echo esc_attr( genesis_get_option( 'footer_creds_text', GSE_SETTINGS_FIELD ) ); ?>" size="125" /></p>
						</td>
					</tr>
					
					<tr>
						<th scope="row"><p><b><?php _e( 'Footer Output', 'genesis-simple-edits' ); ?></b></p></th>
						<td>
							<p><input type="checkbox" name="<?php echo GSE_SETTINGS_FIELD; ?>[footer_output_on]" id="<?php echo GSE_SETTINGS_FIELD; ?>[footer_output_on]" value="1" <?php checked( 1, genesis_get_option( 'footer_output_on', GSE_SETTINGS_FIELD ) ); ?> /> <label for="<?php echo GSE_SETTINGS_FIELD; ?>[footer_output_on]"><?php _e( 'Modify Entire Footer Text (including markup)?', 'genesis-simple-edits' ); ?></label></p>
							
							<p><span class="description"><?php _e( 'NOTE: Checking this option will use the content of the box below, and override the options above.', 'genesis-simple-edits' ); ?></span></p>
							
							<p><textarea name="<?php echo GSE_SETTINGS_FIELD; ?>[footer_output]" cols="80" rows="5"><?php echo esc_textarea( genesis_get_option( 'footer_output', GSE_SETTINGS_FIELD ) ); ?></textarea></p>
							
							<p><small><a class="footer-shortcodes-toggle" href="#"><?php _e( 'Show available footer shortcodes', 'genesis-simple-edits' ); ?></a></small></p>
						</td>
					</tr>
					
					<tr class="footer-shortcodes" style="display: none;">
						<th scope="row"><p><span class="description"><?php _e( 'Shortcode Reference', 'genesis-simple-edits' ); ?></span></p></th>
						<td>
							<p><span class="description"><?php _e( 'NOTE: For a more comprehensive shortcode usage guide, <a href="http://my.studiopress.com/docs/shortcode-reference/" target="_blank">see this page</a>.', 'genesis-simple-edits' ); ?>
							<p>
								<ul>
									<?php if ( ! genesis_html5() ) : ?>
									<li>[footer_backtotop] - <span class="description"><?php _e( 'The "Back to Top" Link', ''); ?></span></li>
									<?php endif; ?>
									<li>[footer_copyright] - <span class="description"><?php _e( 'The Copyright notice', 'genesis-simple-edits' ); ?></span></li>
									<li>[footer_childtheme_link] - <span class="description"><?php _e( 'The Child Theme Link', 'genesis-simple-edits' ); ?></span></li>
									<li>[footer_genesis_link] - <span class="description"><?php _e( 'The Genesis Link', 'genesis-simple-edits' ); ?></span></li>
									<li>[footer_studiopress_link] - <span class="description"><?php _e( 'The StudioPress Link', 'genesis-simple-edits' ); ?></span></li>
									<li>[footer_wordpress_link] - <span class="description"><?php _e( 'The WordPress Link', 'genesis-simple-edits' ); ?></span></li>
									<li>[footer_loginout] - <span class="description"><?php _e( 'Log In/Out Link', 'genesis-simple-edits' ); ?></span></li>
								</ul>
							</p>
						</td>
					</tr>
					
				</tbody></table>
				
				<div class="bottom-buttons">
					<input type="submit" class="button-primary" value="<?php _e( 'Save Settings', 'genesis-simple-edits' ); ?>" />
					<input type="submit" class="button-secondary" name="<?php echo GSE_SETTINGS_FIELD; ?>[reset]" value="<?php _e( 'Reset Settings', 'genesis-simple-edits' ); ?>" />
				</div>
				
			</form>
		</div>
		
	<?php }
	
	function post_info_filter( $output ) {
		
		return genesis_get_option( 'post_info', GSE_SETTINGS_FIELD );
		
	}
	
	function post_meta_filter( $output ) {
		
		return genesis_get_option( 'post_meta', GSE_SETTINGS_FIELD );
		
	}
	
	function footer_backtotop_filter( $output ) {
		
		return genesis_get_option( 'footer_backtotop_text', GSE_SETTINGS_FIELD );
		
	}
	
	function footer_creds_filter( $output ) {
		
		return genesis_get_option( 'footer_creds_text', GSE_SETTINGS_FIELD );
		
	}
	
	function footer_output_filter( $output ) {
		
		if ( genesis_get_option( 'footer_output_on', GSE_SETTINGS_FIELD ) )
			return genesis_get_option( 'footer_output', GSE_SETTINGS_FIELD );
			
		return $output;
		
	}
	
}

$Genesis_Simple_Edits = new Genesis_Simple_Edits;