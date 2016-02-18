<?php

class PMXE_Export_Record extends PMXE_Model_Record {
		
	/**
	 * Initialize model instance
	 * @param array[optional] $data Array of record data to initialize object with
	 */
	public function __construct($data = array()) {
		parent::__construct($data);		
		$this->setTable(PMXE_Plugin::getInstance()->getTablePrefix() . 'exports');
	}				
	
	/**
	 * Import all files matched by path
	 * @param callback[optional] $logger Method where progress messages are submmitted
	 * @return PMXI_Import_Record
	 * @chainable
	 */
	public function execute($logger = NULL, $cron = false) {
		
		$this->set('registered_on', date('Y-m-d H:i:s'))->save(); // update registered_on to indicated that job has been exectured even if no files are going to be imported by the rest of the method
		
		$wp_uploads = wp_upload_dir();	

		$this->set(array('processing' => 1))->update(); // lock cron requests			

		wp_reset_postdata();

		XmlExportEngine::$exportOptions  = $this->options;
		XmlExportEngine::$is_user_export = $this->options['is_user_export'];
		XmlExportEngine::$is_comment_export = $this->options['is_comment_export'];
		XmlExportEngine::$exportID 		 = $this->id;		

		$filter_args = array(
			'filter_rules_hierarhy' => $this->options['filter_rules_hierarhy'],
			'product_matching_mode' => $this->options['product_matching_mode']
		);

		$filters = new XmlExportFiltering($filter_args);

		if ('advanced' == $this->options['export_type']) 
		{
			if (XmlExportEngine::$is_user_export)
			{
				$exportQuery = eval('return new WP_User_Query(array(' . $this->options['wp_query'] . ', \'offset\' => ' . $this->exported . ', \'number\' => ' . $this->options['records_per_iteration'] . '));');			
			}
			elseif (XmlExportEngine::$is_comment_export)
			{
				$exportQuery = eval('return new WP_Comment_Query(array(' . $this->options['wp_query'] . ', \'offset\' => ' . $this->exported . ', \'number\' => ' . $this->options['records_per_iteration'] . '));');			
			}
			else
			{
				$exportQuery = eval('return new WP_Query(array(' . $this->options['wp_query'] . ', \'offset\' => ' . $this->exported . ', \'posts_per_page\' => ' . $this->options['records_per_iteration'] . '));');			
			}			
		}
		else
		{
			XmlExportEngine::$post_types = $this->options['cpt'];

			// [ Update where clause]
			$filters->parseQuery();

			XmlExportEngine::$exportOptions['whereclause'] = $filters->get('queryWhere');
			XmlExportEngine::$exportOptions['joinclause']  = $filters->get('queryJoin');

			$this->set(array( 'options' => XmlExportEngine::$exportOptions ))->update();
			// [\ Update where clause]

			if ( in_array('users', $this->options['cpt']))
			{
				add_action('pre_user_query', 'wp_all_export_pre_user_query', 10, 1);
				$exportQuery = new WP_User_Query( array( 'orderby' => 'ID', 'order' => 'ASC', 'number' => $this->options['records_per_iteration'], 'offset' => $this->exported));
				remove_action('pre_user_query', 'wp_all_export_pre_user_query');
			}
			elseif ( in_array('comments', $this->options['cpt']))
			{
				add_action('comments_clauses', 'wp_all_export_comments_clauses', 10, 1);
				$exportQuery = new WP_Comment_Query( array( 'orderby' => 'comment_ID', 'order' => 'ASC', 'number' => $this->options['records_per_iteration'], 'offset' => $this->exported));
				remove_action('comments_clauses', 'wp_all_export_comments_clauses');
			}
			else
			{
				add_filter('posts_where', 'wp_all_export_posts_where', 10, 1);
				add_filter('posts_join', 'wp_all_export_posts_join', 10, 1);
				
				$exportQuery = new WP_Query( array( 'post_type' => $this->options['cpt'], 'post_status' => 'any', 'orderby' => 'ID', 'order' => 'ASC', 'ignore_sticky_posts' => 1, 'offset' => $this->exported, 'posts_per_page' => $this->options['records_per_iteration'] ));

				remove_filter('posts_join', 'wp_all_export_posts_join');			
				remove_filter('posts_where', 'wp_all_export_posts_where');				
			}
		}		

		XmlExportEngine::$exportQuery = $exportQuery;

		$file_path = false;

		$is_secure_import = PMXE_Plugin::getInstance()->getOption('secure');

		if ( $this->exported == 0 )
		{
			
			if ( wp_all_export_is_compatible() )
			{
				$import = new PMXI_Import_Record();

				$import->getById($this->options['import_id']);	

				if ($import->isEmpty()){

					$import->set(array(		
						'parent_import_id' => 99999,
						'xpath' => '/',			
						'type' => 'upload',																
						'options' => array('empty'),
						'root_element' => 'root',
						'path' => 'path',
						//'name' => '',
						'imported' => 0,
						'created' => 0,
						'updated' => 0,
						'skipped' => 0,
						'deleted' => 0,
						'iteration' => 1					
					))->save();												

					$exportOptions = $this->options;

					$exportOptions['import_id']	= $import->id;	

					$this->set(array(
						'options' => $exportOptions
					))->save();
				}
				else{

					if ( $import->parent_import_id != 99999 ){

						$newImport = new PMXI_Import_Record();

						$newImport->set(array(		
							'parent_import_id' => 99999,
							'xpath' => '/',			
							'type' => 'upload',																
							'options' => array('empty'),
							'root_element' => 'root',
							'path' => 'path',
							//'name' => '',
							'imported' => 0,
							'created' => 0,
							'updated' => 0,
							'skipped' => 0,
							'deleted' => 0,
							'iteration' => 1					
						))->save();													

						$exportOptions = $this->options;

						$exportOptions['import_id']	= $newImport->id;	

						$this->set(array(
							'options' => $exportOptions
						))->save();								

					}

				}
			}			

			$attachment_list = $this->options['attachment_list'];
			if ( ! empty($attachment_list))
			{
				foreach ($attachment_list as $attachment) {
					if (!is_numeric($attachment))
					{						
						@unlink($attachment);
					}
				}
			}
			$exportOptions = $this->options;
			$exportOptions['attachment_list'] = array();
			$this->set(array(				
				'options' => $exportOptions
			))->save();	
			 

			// if 'Create a new file each time export is run' disabled remove all previously generated source files
			// if ( $is_secure_import and ( ! $this->options['creata_a_new_export_file'] or ! $this->iteration ) ){
			// 	wp_all_export_remove_source(wp_all_export_get_absolute_path($this->options['filepath']));
			// }
			
			// generate export file name
			$file_path = wp_all_export_generate_export_file( $this->id ); 						

			if (  ! $is_secure_import ){
			
				$wp_filetype = wp_check_filetype(basename($file_path), null );
				$attachment_data = array(
				    'guid' => $wp_uploads['baseurl'] . '/' . _wp_relative_upload_path( $file_path ), 
				    'post_mime_type' => $wp_filetype['type'],
				    'post_title' => preg_replace('/\.[^.]+$/', '', basename($file_path)),
				    'post_content' => '',
				    'post_status' => 'inherit'
				);		

				if ( empty($export->attch_id) )
				{
					$attach_id = wp_insert_attachment( $attachment_data, $file_path );			
				}					
				elseif($this->options['creata_a_new_export_file'])
				{
					$attach_id = wp_insert_attachment( $attachment_data, $file_path );			
				}
				else
				{
					$attach_id = $this->attch_id;						
					$attachment = get_post($attach_id);
					if ($attachment)
					{
						update_attached_file( $attach_id, $file_path );
						wp_update_attachment_metadata( $attach_id, $attachment_data );	
					}
					else
					{
						$attach_id = wp_insert_attachment( $attachment_data, $file_path );				
					}						
				}

				//$attach_id = wp_insert_attachment( $attachment_data, $file_path );			

				$exportOptions = $this->options;
				if ( ! in_array($attach_id, $exportOptions['attachment_list'])){
					$exportOptions['attachment_list'][] = $attach_id;	
				} 
				
				$this->set(array(
					'attch_id' => $attach_id,
					'options' => $exportOptions
				))->save();				

			}	
			else {								

				$exportOptions = $this->options;

				$exportOptions['filepath'] = $file_path;

				$this->set(array(
					'options' => $exportOptions
				))->save();

			}		

			do_action('pmxe_before_export', $this->id);
			
		}
		else
		{
			if (  ! $is_secure_import ){

				$file_path = str_replace($wp_uploads['baseurl'], $wp_uploads['basedir'], wp_get_attachment_url( $this->attch_id )); 

			}
			else{

				$file_path = wp_all_export_get_absolute_path($this->options['filepath']);

			}
		}

		if (XmlExportEngine::$is_comment_export)
		{
			$postCount  = count($exportQuery->get_comments());
			add_action('comments_clauses', 'wp_all_export_comments_clauses', 10, 1);
			$result = new WP_Comment_Query( array( 'orderby' => 'comment_ID', 'order' => 'ASC', 'number' => 10, 'count' => true));
			$foundPosts = $result->get_comments();
			remove_action('comments_clauses', 'wp_all_export_comments_clauses');	
		}
		else
		{
			$foundPosts = ( ! XmlExportEngine::$is_user_export ) ? $exportQuery->found_posts : $exportQuery->get_total();
			$postCount  = ( ! XmlExportEngine::$is_user_export ) ? $exportQuery->post_count : count($exportQuery->get_results());
		}

		// if posts still exists then export them
		if ( $postCount )
		{

			$functions = $wp_uploads['basedir'] . DIRECTORY_SEPARATOR . WP_ALL_EXPORT_UPLOADS_BASE_DIRECTORY . DIRECTORY_SEPARATOR . 'functions.php';
			if ( @file_exists($functions) )
				require_once $functions;			

			switch ( $this->options['export_to'] ) {

				case 'xml':		

					if ( XmlExportEngine::$is_user_export )
					{
						$exported_to_file = pmxe_export_users_xml($exportQuery, $this->options, false, $cron, $file_path, $this->exported);						
					}
					elseif ( XmlExportEngine::$is_comment_export )
					{
						$exported_to_file = pmxe_export_comments_xml($exportQuery, $this->options, false, $cron, $file_path, $this->exported);						
					}
					else
					{
						$exported_to_file = pmxe_export_xml($exportQuery, $this->options, false, $cron, $file_path, $this->exported);
					}

					break;

				case 'csv':
					
					if ( XmlExportEngine::$is_user_export )
					{	
						$exported_to_file = pmxe_export_users_csv($exportQuery, $this->options, false, $cron, $file_path, $this->exported);						
					}
					elseif ( XmlExportEngine::$is_comment_export )
					{	
						$exported_to_file = pmxe_export_comments_csv($exportQuery, $this->options, false, $cron, $file_path, $this->exported);						
					}
					else
					{
						$exported_to_file = pmxe_export_csv($exportQuery, $this->options, false, $cron, $file_path, $this->exported);
					}

					break;								

				default:
					# code...
					break;
			}	

			wp_reset_postdata();	

			$this->set(array(
				'exported' => $this->exported + $postCount,
				'last_activity' => date('Y-m-d H:i:s'),
				'processing' => 0
			))->save();	

		}	

		if ( empty($foundPosts) )
		{
			$this->set(array(
				'processing' => 0,
				'triggered' => 0,
				'canceled' => 0,				
				'registered_on' => date('Y-m-d H:i:s'),							
			))->update();	

			do_action('pmxe_after_export', $this->id);
		}
		elseif ( ! $postCount or $foundPosts == $this->exported ){

			wp_reset_postdata();

			if ( file_exists($file_path)){
								
				if ( $this->options['export_to'] == 'xml' ) file_put_contents($file_path, '</'.$this->options['main_xml_tag'].'>', FILE_APPEND);	

				if ($this->options['is_generate_templates']){

					$custom_type = (empty($this->options['cpt'])) ? 'post' : $this->options['cpt'][0];

					$templateOptions = array(
						'type' => ( ! empty($this->options['cpt']) and $this->options['cpt'][0] == 'page') ? 'page' : 'post',
						'wizard_type' => 'new',
						'deligate' => 'wpallexport',
						'custom_type' => (XmlExportEngine::$is_user_export) ? 'import_users' : $custom_type,
						'status' => 'xpath',
						'is_multiple_page_parent' => 'no',
						'unique_key' => '',
						'acf' => array(),
						'fields' => array(),
						'is_multiple_field_value' => array(),				
						'multiple_value' => array(),
						'fields_delimiter' => array(),				

						'update_all_data' => 'no',
						'is_update_status' => 0,
						'is_update_title'  => 0,
						'is_update_author' => 0,
						'is_update_slug' => 0,
						'is_update_content' => 0,
						'is_update_excerpt' => 0,
						'is_update_dates' => 0,
						'is_update_menu_order' => 0,
						'is_update_parent' => 0,
						'is_update_attachments' => 0,
						'is_update_acf' => 0,
						'update_acf_logic' => 'only',
						'acf_list' => '',					
						'is_update_product_type' => 1,
						'is_update_attributes' => 0,
						'update_attributes_logic' => 'only',
						'attributes_list' => '',
						'is_update_images' => 0,
						'is_update_custom_fields' => 0,
						'update_custom_fields_logic' => 'only',
						'custom_fields_list' => '',												
						'is_update_categories' => 0,
						'update_categories_logic' => 'only',
						'taxonomies_list' => '',
						'export_id' => $this->id
													
					);		

					if ( in_array('product', $this->options['cpt']) )
					{
						$templateOptions['_virtual'] = 1;
						$templateOptions['_downloadable'] = 1;
						$templateOptions['put_variation_image_to_gallery'] = 1;
						$templateOptions['disable_auto_sku_generation'] = 1;
					}		

					if ( XmlExportEngine::$is_user_export )
					{					
						$templateOptions['is_update_first_name'] = 0;
						$templateOptions['is_update_last_name'] = 0;
						$templateOptions['is_update_role'] = 0;
						$templateOptions['is_update_nickname'] = 0;
						$templateOptions['is_update_description'] = 0;
						$templateOptions['is_update_login'] = 0;
						$templateOptions['is_update_password'] = 0;
						$templateOptions['is_update_nicename'] = 0;
						$templateOptions['is_update_email'] = 0;
						$templateOptions['is_update_registered'] = 0;
						$templateOptions['is_update_display_name'] = 0;
						$templateOptions['is_update_url'] = 0;
					}	

					if ( 'xml' == $this->options['export_to'] ) 
					{						
						wp_all_export_prepare_template_xml($this->options, $templateOptions);															
					}
					else
					{						
						wp_all_export_prepare_template_csv($this->options, $templateOptions);																		
					}

					$tpl_options = $templateOptions;

					if ( 'csv' == $this->options['export_to'] ) 
					{						
						$tpl_options['delimiter'] = $this->options['delimiter'];
					}
					
					$tpl_options['update_all_data'] = 'yes';
					$tpl_options['is_update_status'] = 1;
					$tpl_options['is_update_title']  = 1;
					$tpl_options['is_update_author'] = 1;
					$tpl_options['is_update_slug'] = 1;
					$tpl_options['is_update_content'] = 1;
					$tpl_options['is_update_excerpt'] = 1;
					$tpl_options['is_update_dates'] = 1;
					$tpl_options['is_update_menu_order'] = 1;
					$tpl_options['is_update_parent'] = 1;
					$tpl_options['is_update_attachments'] = 1;
					$tpl_options['is_update_acf'] = 1;
					$tpl_options['update_acf_logic'] = 'full_update';
					$tpl_options['acf_list'] = '';
					$tpl_options['is_update_product_type'] = 1;
					$tpl_options['is_update_attributes'] = 1;
					$tpl_options['update_attributes_logic'] = 'full_update';
					$tpl_options['attributes_list'] = '';
					$tpl_options['is_update_images'] = 1;
					$tpl_options['is_update_custom_fields'] = 1;
					$tpl_options['update_custom_fields_logic'] = 'full_update';
					$tpl_options['custom_fields_list'] = '';
					$tpl_options['is_update_categories'] = 1;
					$tpl_options['update_categories_logic'] = 'full_update';
					$tpl_options['taxonomies_list'] = '';					

					$tpl_data = array(						
						'name' => $this->options['template_name'],
						'is_keep_linebreaks' => 0,
						'is_leave_html' => 0,
						'fix_characters' => 0,
						'options' => $tpl_options,							
					);

					$exportOptions = $this->options;

					$exportOptions['tpl_data']	= $tpl_data;					
					
					$this->set(array(
						'options' => $exportOptions
					))->save();						
									
				}

				if ( wp_all_export_is_compatible() and $this->options['is_generate_import'] ){	

					$options = $templateOptions + PMXI_Plugin::get_default_import_options();							

					$import = new PMXI_Import_Record();

					$import->getById($this->options['import_id']);							

					if ( ! $import->isEmpty() and $import->parent_import_id == 99999 ){

						$xmlPath = $file_path;

						$root_element = '';

						if ( 'csv' == $this->options['export_to'] ) 
						{
							$options['delimiter'] = $this->options['delimiter'];

							include_once( PMXI_Plugin::ROOT_DIR . '/libraries/XmlImportCsvParse.php' );	

							$path_parts = pathinfo($xmlPath);

							$path_parts_arr = explode(DIRECTORY_SEPARATOR, $path_parts['dirname']);

							$target = $is_secure_import ? $wp_uploads['basedir'] . DIRECTORY_SEPARATOR . PMXE_Plugin::UPLOADS_DIRECTORY . DIRECTORY_SEPARATOR . array_pop($path_parts_arr) : $wp_uploads['path'];						

							$csv = new PMXI_CsvParser( array( 'filename' => $xmlPath, 'targetDir' => $target ) );		

							$exportOptions = $this->options;

							if ( ! in_array($xmlPath, $exportOptions['attachment_list']) )
							{
								$exportOptions['attachment_list'][] = $csv->xml_path;
								$this->set(array(
									'options' => $exportOptions
								))->save();									
							}						
							
							$xmlPath = $csv->xml_path;

							$root_element = 'node';

						}
						else
						{
							$root_element = 'post';
						}

						$import->set(array(
							//'parent_import_id' => 99999,
							'xpath' => '/' . $root_element,
							'type' => 'upload',											
							'options' => $options,
							'root_element' => $root_element,
							'path' => $xmlPath,
							'name' => basename($xmlPath),
							'imported' => 0,
							'created' => 0,
							'updated' => 0,
							'skipped' => 0,
							'deleted' => 0,
							'count' => $foundPosts					
						))->save();				

						$history_file = new PMXI_File_Record();
						$history_file->set(array(
							'name' => $import->name,
							'import_id' => $import->id,
							'path' => $xmlPath,
							'registered_on' => date('Y-m-d H:i:s')
						))->save();		

						$exportOptions = $this->options;

						$exportOptions['import_id']	= $import->id;					
						
						$this->set(array(
							'options' => $exportOptions
						))->save();		
					}										
				}					    

	            if ($this->options['is_scheduled'] and "" != $this->options['scheduled_email']){
	                
	                add_filter( 'wp_mail_content_type', array($this, 'set_html_content_type') );                

	                $headers = 'From: '. get_bloginfo( 'name' ) .' <'. get_bloginfo( 'admin_email' ) .'>' . "\r\n";
	                
	                $message = '<p>Export '. $this->options['friendly_name'] .' has been completed. You can find exported file in attachments.</p>';                

	                wp_mail($this->options['scheduled_email'], __("WP All Export", "pmxe_plugin"), $message, $headers, array($file_path));

	                remove_filter( 'wp_mail_content_type', array($this, 'set_html_content_type') );
	            }

			}	

			$this->set(array(
				'processing' => 0,
				'triggered' => 0,
				'canceled' => 0,				
				'registered_on' => date('Y-m-d H:i:s'),							
			))->update();	

			do_action('pmxe_after_export', $this->id);
		}							
		
		return $this;
	}

    public function set_html_content_type(){
        return 'text/html';
    }

    /**
	 * Clear associations with posts	 
	 * @return PMXE_Import_Record
	 * @chainable
	 */
	public function deletePosts() {
		$post = new PMXE_Post_List();					
		$this->wpdb->query($this->wpdb->prepare('DELETE FROM ' . $post->getTable() . ' WHERE export_id = %s', $this->id));
		return $this;
	}

	/**
	 * @see parent::delete()	 
	 */
	public function delete() {	
		$this->deletePosts();
		if ( ! empty($this->options['import_id']) and wp_all_export_is_compatible()){
			$import = new PMXI_Import_Record();
			$import->getById($this->options['import_id']);
			if ( ! $import->isEmpty() and $import->parent_import_id == 99999 ){
				$import->delete();
			}
		}	
		$export_file_path = wp_all_export_get_absolute_path($this->options['filepath']);
		if ( @file_exists($export_file_path) ){ 
			wp_all_export_remove_source($export_file_path);
		}
		if ( ! empty($this->attch_id) ){
			wp_delete_attachment($this->attch_id, true);
		}
		
		$wp_uploads = wp_upload_dir();	

		$file_for_remote_access = $wp_uploads['basedir'] . DIRECTORY_SEPARATOR . PMXE_Plugin::UPLOADS_DIRECTORY . DIRECTORY_SEPARATOR . md5(PMXE_Plugin::getInstance()->getOption('cron_job_key') . $this->id) . '.' . $this->options['export_to'];
		
		if ( @file_exists($file_for_remote_access)) @unlink($file_for_remote_access);

		return parent::delete();
	}
	
}
