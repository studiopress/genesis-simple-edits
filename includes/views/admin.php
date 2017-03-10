<table class="form-table"><tbody>

	<tr>
		<th scope="row"><p><label for="<?php $this->field_id( 'post_info' ); ?>"><b><?php _e( 'Entry Meta (above content)', 'genesis-simple-edits' ); ?></b></label></p></th>
		<td>
			<p><input type="text" name="<?php $this->field_name( 'post_info' ); ?>" id="<?php $this->field_id( 'post_info' ); ?>" value="<?php echo esc_attr( $this->get_field_value( 'post_info' ) ); ?>" size="125" /></p>
		</td>
	</tr>

	<tr>
		<th scope="row"><p><label for="<?php $this->field_id( 'post_meta' ); ?>"><b><?php _e( 'Entry Meta (below content)', 'genesis-simple-edits' ); ?></b></label></p></th>
		<td>
			<p><input type="text" name="<?php $this->field_name( 'post_meta' ); ?>" id="<?php $this->field_id( 'post_meta' ); ?>" value="<?php echo esc_attr( $this->get_field_value( 'post_meta' ) ); ?>" size="125" /></p>

			<p><small><a class="post-shortcodes-toggle" href="#"><?php _e( 'Show available entry meta shortcodes', 'genesis-simple-edits' ) ?></a></small></p>

		</td>
	</tr>

	<tr class="post-shortcodes" style="display: none;">
		<th scope="row"><p><span class="description"><?php _e( 'Shortcode Reference', 'genesis-simple-edits' ); ?></span></p></th>
		<td>
			<p><span class="description"><?php printf( __( 'NOTE: For a more comprehensive shortcode usage guide, see the <a href="%s" target="_blank">post shortcode reference</a>.', 'genesis-simple-edits' ), 'http://my.studiopress.com/documentation/customization/shortcodes-reference/post-shortcode-reference/' ); ?></span></p>
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
		<th scope="row"><p><label for="<?php $this->field_id( 'footer_backtotop_text' ); ?>"><b><?php _e( 'Footer "Back to Top" Link', 'genesis-simple-edits' ); ?></b></label></p></th>
		<td>
			<p><input type="text" name="<?php $this->field_name( 'footer_backtotop_text' ); ?>" id="<?php $this->field_id( 'footer_backtotop_text' ); ?>" value="<?php echo esc_attr( $this->get_field_value( 'footer_backtotop_text' ) ); ?>" size="125" /></p>
		</td>
	</tr>
	<?php endif; ?>

	<tr>
		<th scope="row"><p><label for="<?php $this->field_id( 'footer_creds_text' ); ?>"><b><?php _e( 'Footer Credits Text', 'genesis-simple-edits' ); ?></b></label></p></th>
		<td>
			<p><input type="text" name="<?php $this->field_name( 'footer_creds_text' ); ?>" id="<?php $this->field_name( 'footer_creds_text' ); ?>" value="<?php echo esc_attr( $this->get_field_value( 'footer_creds_text' ) ); ?>" size="125" /></p>
		</td>
	</tr>

	<tr>
		<th scope="row"><p><b><?php _e( 'Footer Output', 'genesis-simple-edits' ); ?></b></p></th>
		<td>
			<p><input type="checkbox" name="<?php $this->field_name( 'footer_output_on' ); ?>" id="<?php $this->field_id( 'footer_output_on' ); ?>" value="1" <?php checked( 1, $this->get_field_value( 'footer_output_on' ) ); ?> /> <label for="<?php $this->field_id( 'footer_output_on' ); ?>"><?php _e( 'Modify Entire Footer Text (including markup)?', 'genesis-simple-edits' ); ?></label></p>

			<p><span class="description"><?php _e( 'NOTE: Checking this option will use the content of the box below, and override the options above.', 'genesis-simple-edits' ); ?></span></p>

			<p><textarea name="<?php $this->field_name( 'footer_output' ); ?>" cols="80" rows="5"><?php echo esc_textarea( $this->get_field_value( 'footer_output' ) ); ?></textarea></p>

			<p><small><a class="footer-shortcodes-toggle" href="#"><?php _e( 'Show available footer shortcodes', 'genesis-simple-edits' ); ?></a></small></p>
		</td>
	</tr>

	<tr class="footer-shortcodes" style="display: none;">
		<th scope="row"><p><span class="description"><?php _e( 'Shortcode Reference', 'genesis-simple-edits' ); ?></span></p></th>
		<td>
			<p><span class="description"><?php printf( __( 'NOTE: For a more comprehensive shortcode usage guide, see the <a href="%s" target="_blank">footer shortcode reference</a>.', 'genesis-simple-edits' ), 'http://my.studiopress.com/documentation/customization/shortcodes-reference/footer-shortcode-reference/' ); ?></span></p>
			<p>
				<ul>
					<?php if ( ! genesis_html5() ) : ?>
					<li>[footer_backtotop] - <span class="description"><?php _e( 'The "Back to Top" Link', 'genesis-simple-edits'); ?></span></li>
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
