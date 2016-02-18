
<?php $custom_type = get_post_type_object( $post['custom_type'] ); ?>

<div class="wpallimport-collapsed wpallimport-section">
	<script type="text/javascript">
		__META_KEYS = <?php echo json_encode($existing_meta_keys); ?>;
	</script>	
	<div class="wpallimport-content-section">
		<div class="wpallimport-collapsed-header">											
		<?php if ( "new" == $post['wizard_type']): ?>	
			<?php 
				if ( ! $isWizard )
				{
					?>
					<h3><?php _e('Record Matching', 'wp_all_import_plugin'); ?></h3>	
					<?php 
				}
				else
				{ 					
					if ( ! empty(PMXI_Plugin::$session->deligate) and PMXI_Plugin::$session->deligate == 'wpallexport' )
					{
						?>
						<h3 style="padding-left:0;"><?php _e('Choose how exported data will be re-imported.','wp_all_import_plugin');?></h3>	
						<?php 
					}
					else
					{
						?>
						<h3 style="padding-left:0;"><?php printf(__('WP All Import will create new %s for each unique record in your file.','wp_all_import_plugin'), $custom_type->labels->name);?></h3>	
						<?php 
					}
				} 
			?>	
			</div>
			<div class="wpallimport-collapsed-content" style="padding: 0;">
				<div class="wpallimport-collapsed-content-inner">
					<hr>
					<table class="form-table" style="max-width:none;">
						<tr>
							<td>
								<input type="hidden" name="duplicate_matching" value="auto"/>										
								<?php if ( ! $isWizard ):?>
								<h4><?php printf(__('WP All Import will associate records in your file with %s it has already created from previous runs of this import basis on the Unique Identifier.','pmxi_plugin'), $custom_type->labels->singular_name);?></h4>
								<?php endif; ?>
								<div class="wpallimport-unique-key-wrapper">
									<label style="font-weight: bold;"><?php _e("Unique Identifier", "pmxi_plugin"); ?></label>										

									<input type="text" class="smaller-text" name="unique_key" style="width:300px;" value="<?php if ( ! $isWizard ) echo esc_attr($post['unique_key']); elseif ($post['tmp_unique_key']) echo esc_attr($post['unique_key']); ?>" <?php echo  ( ! $isWizard ) ? 'disabled="disabled"' : '' ?>/>

									<?php if ( $isWizard ): ?>
									<input type="hidden" name="tmp_unique_key" value="<?php echo ($post['unique_key']) ? esc_attr($post['unique_key']) : esc_attr($post['tmp_unique_key']); ?>"/>
									<a href="javascript:void(0);" class="wpallimport-auto-detect-unique-key"><?php _e('Auto-detect', 'pmxi_plugin'); ?></a>
									<?php else: ?>
									<a href="javascript:void(0);" class="wpallimport-change-unique-key"><?php _e('Edit', 'pmxi_plugin'); ?></a>
									<div id="dialog-confirm" title="<?php _e('Warning: Are you sure you want to edit the Unique Identifier?','pmxi_plugin');?>" style="display:none;">
										<p><?php printf(__('It is recommended you delete all %s associated with this import before editing the unique identifier.', 'pmxi_plugin'), strtolower($custom_type->labels->name)); ?></p>
										<p><?php printf(__('Editing the unique identifier will dissociate all existing %s linked to this import. Future runs of the import will result in duplicates, as WP All Import will no longer be able to update these %s.', 'pmxi_plugin'), strtolower($custom_type->labels->name), strtolower($custom_type->labels->name)); ?></p>
										<p><?php _e('You really should just re-create your import, and pick the right unique identifier to start with.', 'pmxi_plugin'); ?></p>
									</div>
									<?php endif; ?>

									<p>&nbsp;</p>
									<?php if ( $isWizard ):?>
										<p class="drag_an_element_ico"><?php _e('Drag an element, or combo of elements, to the box above. The Unique Identifier should be unique for each record in your file, and should stay the same even if your file is updated. Things like product IDs, titles, and SKUs are good Unique Identifiers because they probably won\'t change. Don\'t use a description or price, since that might be changed.', 'pmxi_plugin'); ?></p>
										<p class="info_ico"><?php printf(__('If you run this import again with an updated file, the Unique Identifier allows WP All Import to correctly link the records in your updated file with the %s it will create right now. If multiple records in this file have the same Unique Identifier, only the first will be created. The others will be detected as duplicates.', 'pmxi_plugin'), $custom_type->labels->name); ?></p>
									<?php endif; ?>
								</div>					
								<?php 
								if ( ! $isWizard  or ! empty(PMXI_Plugin::$session->deligate) and PMXI_Plugin::$session->deligate == 'wpallexport'):?>
									
									<?php include( '_reimport_options.php' ); ?>

								<?php endif; ?>					
							</td>
						</tr>
					</table>
				</div>
			</div>				
		<?php else: ?>
			<?php if ( ! $isWizard ):?>
				<h3><?php _e('Record Matching', 'pmxi_plugin'); ?></h3>						
			<?php else: ?>
				<h3 style="padding-left:0;"><?php printf(__('WP All Import will merge data into existing %s.','pmxi_plugin'), $custom_type->labels->singular_name);?></h3>	
			<?php endif; ?>
			</div>
			<div class="wpallimport-collapsed-content" style="padding: 0;">
				<div class="wpallimport-collapsed-content-inner">
					<hr>
					<table class="form-table" style="max-width:none;">
						<tr>
							<td>						
								<div class="input" style="margin-bottom:15px; position:relative;">					
									<input type="hidden" name="duplicate_matching" value="manual"/>
									<h4><?php printf(__('Records in your file will be matched with %s on your site based on...', 'pmxi_plugin' ), $custom_type->labels->singular_name);?></h4>
									<div style="padding-left:17px;">
										<div class="input">																	
											<input type="radio" id="duplicate_indicator_title" class="switcher" name="duplicate_indicator" value="title" <?php echo 'title' == $post['duplicate_indicator'] ? 'checked="checked"': '' ?>/>
											<label for="duplicate_indicator_title"><?php _e('match by Login', 'pmxi_plugin' )?></label><br>
											<input type="radio" id="duplicate_indicator_content" class="switcher" name="duplicate_indicator" value="content" <?php echo 'content' == $post['duplicate_indicator'] ? 'checked="checked"': '' ?>/>
											<label for="duplicate_indicator_content"><?php _e('match by Email', 'pmxi_plugin' )?></label><br>
											<div class="input">
												<input type="radio" id="duplicate_indicator_custom_field" class="switcher" name="duplicate_indicator" value="custom field" <?php echo 'custom field' == $post['duplicate_indicator'] ? 'checked="checked"': '' ?>/>
												<label for="duplicate_indicator_custom_field"><?php _e('match by Custom Field', 'pmxi_plugin' )?></label><br>
												<span class="switcher-target-duplicate_indicator_custom_field" style="vertical-align:middle; padding-left:17px;">
													<?php _e('Name', 'pmxi_plugin') ?>
													<input type="text" name="custom_duplicate_name" value="<?php echo esc_attr($post['custom_duplicate_name']) ?>" />
													<?php _e('Value', 'pmxi_plugin') ?>
													<input type="text" name="custom_duplicate_value" value="<?php echo esc_attr($post['custom_duplicate_value']) ?>" />
												</span>
											</div>
											<div class="input">
												<input type="radio" id="duplicate_indicator_pid" class="switcher" name="duplicate_indicator" value="pid" <?php echo 'pid' == $post['duplicate_indicator'] ? 'checked="checked"': '' ?>/>
												<label for="duplicate_indicator_pid"><?php _e('User ID', 'wp_all_import_plugin' )?></label><br>
												<span class="switcher-target-duplicate_indicator_pid" style="vertical-align:middle; padding-left:17px;">												
													<input type="text" name="pid_xpath" value="<?php echo esc_attr($post['pid_xpath']) ?>" />
												</span>
											</div>
										</div>
									</div>
								</div>
								<hr>
								<?php include( '_reimport_options.php' ); ?>
							</td>
						</tr>
					</table>					
				</div>
			</div>
		<?php endif; ?>	
	</div>	
</div>	
<div class="wpallimport-collapsed wpallimport-section">
	<div class="wpallimport-content-section">
		<div class="wpallimport-collapsed-header">	
			<h3><?php _e('Email Notifications For Imported Users', 'wp_all_import_plugin'); ?></h3>											
		</div>
		<div class="wpallimport-collapsed-content" style="padding: 0;">
			<div class="wpallimport-collapsed-content-inner">
				<div class="input">
					<input type="hidden" name="do_not_send_password_notification" value="0" />
					<input type="checkbox" id="do_not_send_password_notification" name="do_not_send_password_notification" value="1" <?php echo empty($post['do_not_send_password_notification']) ? '': 'checked="checked"' ?> class="switcher"/>
					<label for="do_not_send_password_notification"><?php _e('Block email notifications during import', 'wp_all_import_plugin') ?></label>
					<a href="#help" class="wpallimport-help" title="<?php _e('If enabled, WP All Import will prevent WordPress from sending notification emails to imported users while the import is processing.', 'wp_all_import_plugin') ?>" style="position:relative; top: 0;">?</a>							
				</div>	
			</div>
		</div>			
	</div>
</div>