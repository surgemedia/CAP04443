/**
 * plugin admin area javascript
 */
(function($){$(function () {

	if ( ! $('body.wpallexport-plugin').length) return; // do not execute any code if we are not on plugin page

	// fix layout position
	setTimeout(function () {
		$('table.wpallexport-layout').length && $('table.wpallexport-layout td.left h2:first-child').css('margin-top',  $('.wrap').offset().top - $('table.wpallexport-layout').offset().top);
	}, 10);	
	
	// help icons
	$('a.wpallexport-help').tipsy({
		gravity: function() {
			var ver = 'n';
			if ($(document).scrollTop() < $(this).offset().top - $('.tipsy').height() - 2) {
				ver = 's';
			}
			var hor = '';
			if ($(this).offset().left + $('.tipsy').width() < $(window).width() + $(document).scrollLeft()) {
				hor = 'w';
			} else if ($(this).offset().left - $('.tipsy').width() > $(document).scrollLeft()) {
				hor = 'e';
			}
	        return ver + hor;
	    },
		live: true,
		html: true,
		opacity: 1
	}).live('click', function () {
		return false;
	}).each(function () { // fix tipsy title for IE
		$(this).attr('original-title', $(this).attr('title'));
		$(this).removeAttr('title');
	});	

	if ($('#wp_all_export_code').length){
		var editor = CodeMirror.fromTextArea(document.getElementById("wp_all_export_code"), {
	        lineNumbers: true,
	        matchBrackets: true,
	        mode: "application/x-httpd-php",
	        indentUnit: 4,
	        indentWithTabs: true
	    });
	}
	
	// swither show/hide logic
	$('input.switcher').live('change', function (e) {	

		if ($(this).is(':radio:checked')) {
			$(this).parents('form').find('input.switcher:radio[name="' + $(this).attr('name') + '"]').not(this).change();
		}
		var $switcherID = $(this).attr('id');
		var $targets = $('.switcher-target-' + $switcherID);

		var is_show = $(this).is(':checked'); if ($(this).is('.switcher-reversed')) is_show = ! is_show;
		if (is_show) {
			$targets.fadeIn('fast', function(){
				if ($switcherID == 'coperate_php'){								
					editor.setCursor(1);
				}
			});
		} else {
			$targets.hide().find('.clear-on-switch').add($targets.filter('.clear-on-switch')).val('');
		}
	}).change();

	// swither show/hide logic
	$('input.switcher-horizontal').live('change', function (e) {	
		
		if ($(this).is(':checked')) {
			$(this).parents('form').find('input.switcher-horizontal[name="' + $(this).attr('name') + '"]').not(this).change();
		}
		var $targets = $('.switcher-target-' + $(this).attr('id'));

		var is_show = $(this).is(':checked'); if ($(this).is('.switcher-reversed')) is_show = ! is_show;
		
		if (is_show) {
			$targets.animate({width:'205px'}, 350);
		} else {
			$targets.animate({width:'0px'}, 1000).find('.clear-on-switch').add($targets.filter('.clear-on-switch')).val('');
		}
	}).change();
	
	// autoselect input content on click
	$('input.selectable').live('click', function () {
		$(this).select();
	});	

	$('.pmxe_choosen').each(function(){
		$(this).find(".choosen_input").select2({tags: $(this).find('.choosen_values').html().split(',')});
	});
	
	// choose file form: option selection dynamic
	// options form: highlight options of selected post type
	$('form.choose-post-type input[name="type"]').click(function() {		
		var $container = $(this).parents('.file-type-container');		
		$('.file-type-container').not($container).removeClass('selected').find('.file-type-options').hide();
		$container.addClass('selected').find('.file-type-options').show();
	}).filter(':checked').click();		

	$('.wpallexport-collapsed').each(function(){

		if ( ! $(this).hasClass('closed')) $(this).find('.wpallexport-collapsed-content:first').slideDown();

	});

	$('.wpallexport-collapsed').find('.wpallexport-collapsed-header').live('click', function(){
		var $parent = $(this).parents('.wpallexport-collapsed:first');
		if ($parent.hasClass('closed')){			
			$parent.removeClass('closed');
			$parent.find('.wpallexport-collapsed-content:first').slideDown();
		}
		else{
			$parent.addClass('closed');			
			$parent.find('.wpallexport-collapsed-content:first').slideUp();
		}
	});	

	var get_valid_ajaxurl = function(){
		var $URL = ajaxurl;
	    if (typeof export_id != "undefined")
	    {
	    	if ($URL.indexOf("?") == -1)
	    	{
	    		$URL += '?id=' + export_id;
	    	}
	    	else
	    	{
	    		$URL += '&id=' + export_id;
	    	}
	    }
	    return $URL;
	}
	
	// Export filtering	
	
	var init_filtering_fields = function(){

		var wp_all_export_rules_config = {
	      '#wp_all_export_xml_element' : {width:"98%"},
	      '#wp_all_export_rule' : {width:"98%"},    
	    }

	    for (var selector in wp_all_export_rules_config) {

	    	$(selector).chosen(wp_all_export_rules_config[selector]);
	    	
	    	if (selector == '#wp_all_export_xml_element'){

		    	$(selector).on('change', function(evt, params) {

		    		$('#wp_all_export_available_rules').html('<div class="wp_all_export_preloader" style="display:block;"></div>');

		    		var request = {
						action: 'export_available_rules',	
						data: {'selected' : params.selected},				
						security: wp_all_export_security				
				    }; 
				    $.ajax({
						type: 'POST',
						url: ajaxurl,
						data: request,
						success: function(response) {	
							$('#wp_all_export_available_rules').html(response.html);
							$('#wp_all_export_rule').chosen({width:"98%"});
							$('#wp_all_export_rule').on('change', function(evt, params) {
								if (params.selected == 'is_empty' || params.selected == 'is_not_empty')
									$('#wp_all_export_value').hide();
								else
									$('#wp_all_export_value').show();
							});
						},
						dataType: "json"
					});
		    	});
		    }						    
	    }					

	    $('.wp_all_export_filtering_rules').pmxe_nestedSortable({
	        handle: 'div',
	        items: 'li.dragging',
	        toleranceElement: '> div',
	        update: function () {	        
	        	$('.wp_all_export_filtering_rules').find('.condition').removeClass('last_condition').show();
	        	$('.wp_all_export_filtering_rules').find('.condition:last').addClass('last_condition'); 
	        	liveFiltering();    								
		    }
	    });

	}

	var is_first_load = true;

	var filtering = function(postType){

		var request = {
			action: 'export_filtering',	
			data: {'cpt' : postType, 'export_type' : 'specific', 'filter_rules_hierarhy' : '', 'product_matching_mode' : 'strict'},				
			security: wp_all_export_security				
	    };    

	    if (is_first_load == false || postType != '') $('.wp_all_export_preloader').show();	    

		$.ajax({
			type: 'POST',
			url: ajaxurl,
			data: request,
			success: function(response) {	

				$('.wp_all_export_preloader').hide();

				if (postType != '')
				{

					$('.wpallexport-choose-file').find('.wpallexport-upload-resource-step-two').html(response.html);										

					init_filtering_fields();
					liveFiltering(is_first_load);
				}
				else
				{
					$('.wpallexport-choose-file').find('.wpallexport-upload-resource-step-two').slideUp();
					$('.wpallexport-choose-file').find('.wpallexport-submit-buttons').hide();
				}

				is_first_load = false;

			},
			error: function( jqXHR, textStatus ) {	
				
				$('.wp_all_export_preloader').hide();

			},
			dataType: "json"
		});

	}	
		
    $('#wp_all_export_add_rule').live('click', function(){    	

    	var $el = $('#wp_all_export_xml_element');
    	var $rule = $('#wp_all_export_rule');
    	var $val = $('#wp_all_export_value');

    	if ($el.val() == "" || $rule.val() == "") return;    	

    	//if ($rule.val() != 'is_empty' && $rule.val() != "is_not_empty" && $val.val() == "") return;

    	var relunumber = $('.wp_all_export_filtering_rules').find('li').length + 1;

    	var html = '<li id="item_'+ relunumber +'" class="dragging"><div class="drag-element">';
    		html += '<input type="hidden" value="'+ $el.val() +'" class="wp_all_export_xml_element" name="wp_all_export_xml_element['+relunumber+']"/>';
    		html += '<input type="hidden" value="'+ $el.find('option:selected').html() +'" class="wp_all_export_xml_element_title" name="wp_all_export_xml_element_title['+relunumber+']"/>';
    		html += '<input type="hidden" value="'+ $rule.val() +'" class="wp_all_export_rule" name="wp_all_export_rule['+relunumber+']"/>';
    		html += '<input type="hidden" value="'+ $val.val() +'" class="wp_all_export_value" name="wp_all_export_value['+relunumber+']"/>';
    		html += '<span class="rule_element">' + $el.find('option:selected').html() + '</span> <span class="rule_as_is">' + $rule.find('option:selected').html() + '</span> <span class="rule_condition_value">"' + $val.val() +'"</span>';
    		html += '<span class="condition"> <label for="rule_and_'+relunumber+'">AND</label><input id="rule_and_'+relunumber+'" type="radio" value="and" name="rule['+relunumber+']" checked="checked" class="rule_condition"/><label for="rule_or_'+relunumber+'">OR</label><input id="rule_or_'+relunumber+'" type="radio" value="or" name="rule['+relunumber+']" class="rule_condition"/> </span>';
    		html += '</div><a href="javascript:void(0);" class="icon-item remove-ico"></a></li>';

    	$('#wpallexport-filters, #wp_all_export_apply_filters').show();
    	$('#wp_all_export_filtering_rules').find('p').hide();    	

    	$('.wp_all_export_filtering_rules').append(html);

    	$('.wp_all_export_filtering_rules').find('.condition:hidden').each(function(){
    		$(this).show();
    		$(this).find('.rule_condition:first').attr('checked', 'checked');
    	});
    	$('.wp_all_export_filtering_rules').find('.condition').removeClass('last_condition');
        $('.wp_all_export_filtering_rules').find('.condition:last').addClass('last_condition');

        $('.wp_all_export_product_matching_mode').show();

    	$el.prop('selectedIndex',0).trigger('chosen:updated');;	
    	$rule.prop('selectedIndex',0).trigger('chosen:updated');;	

    	$val.val('');	    	
    	$('#wp_all_export_value').show();	    	

    	liveFiltering();

    });

	$('input[name^=rule]').live('click', function(){
		liveFiltering();
	});

	$('select[name^=product_matching_mode]').live('change', function(){
		liveFiltering();
	});	

	var liveFiltering = function(first_load, after_filtering){

		// serialize filters
		$('.hierarhy-output').each(function(){
			var sortable = $('.wp_all_export_filtering_rules.ui-sortable');
			if (sortable.length){
				$(this).val(window.JSON.stringify(sortable.pmxe_nestedSortable('toArray', {startDepthCount: 0})));								
			}				
		});

		var postType = $('input[name=cpt]').length ? $('input[name=cpt]').val() : $('input[name=selected_post_type]').val();

		// prepare data for ajax request to get post count after filtering
		var request = {
			action: 'export_filtering_count',	
			data: {
				'cpt' : postType, 
				'filter_rules_hierarhy' : $('input[name=filter_rules_hierarhy]').val(), 
				'product_matching_mode' : $('select[name=product_matching_mode]').length ? $('select[name=product_matching_mode]').val() : '',
				'is_confirm_screen' : $('.wpallexport-step-4').length,
				'export_only_new_stuff' : $('#export_only_new_stuff').is(':checked') ? 1 : 0
			},				
			security: wp_all_export_security				
	    };    

	    $('.wp_all_export_preloader').show();	    
	    $('.wp_all_export_filter_preloader').show();	    	    

		$.ajax({
			type: 'POST',
			url: get_valid_ajaxurl(),
			data: request,
			success: function(response) {	

				$('.wp_all_export_filter_preloader').hide();				

				$('#filtering_result').html(response.html);

				$('.wpallexport-choose-file').find('.wpallexport-filtering-wrapper').slideDown(400, function(){
					if (typeof first_load != 'undefined')
					{
						$('.wpallexport-choose-file').find('.wpallexport-upload-resource-step-two').slideDown();
						$('.wpallexport-choose-file').find('.wpallexport-upload-resource-step-two').addClass('closed');
						$('.wpallexport-choose-file').find('.wpallexport-submit-buttons').show();
					}
				});

				$('.wp_all_export_preloader').hide();	  

				if (typeof after_filtering != 'undefined')
				{
					after_filtering(response);
				}				

		    	if ( $('.wpallexport-step-4').length && $('form.edit').length && typeof wp_all_export_L10n != 'undefined'){
	    		
	    			if (response.found_records)
	    			{
	    				$('.wp_all_export_confirm_and_run').show();
	    				$('.confirm_and_run_bottom').val(wp_all_export_L10n.confirm_and_run);
	    				$('#filtering_result').removeClass('nothing_to_export');
	    			}
	    			else
	    			{
	    				$('.wp_all_export_confirm_and_run').hide();
	    				$('.confirm_and_run_bottom').val(wp_all_export_L10n.save_configuration);
	    				$('#filtering_result').addClass('nothing_to_export');
	    			}
		    	}

		    	if ( $('.wpallexport-step-1').length)
		    	{
		    		if (response.found_records)
		    		{
		    			$('.founded_records').removeClass('nothing_to_export');
		    		}
		    		else
		    		{
		    			$('.founded_records').addClass('nothing_to_export');
		    		}
		    	}

			},
			error: function( jqXHR, textStatus ) {	
				
				$('.wp_all_export_filter_preloader').hide();
				$('.wp_all_export_preloader').hide();	    

			},
			dataType: "json"
		});

	};

	$('.wp_all_export_filtering_rules').find('.remove-ico').live('click', function(){
		$(this).parents('li:first').remove();
		if ( ! $('.wp_all_export_filtering_rules').find('li').length)
		{	
			$('#wp_all_export_apply_filters').hide();	
			//$('#filtering_result').html('');		
    		$('#wp_all_export_filtering_rules').find('p').show();	
    		$('.wp_all_export_product_matching_mode').hide();		    		
		}
		else
		{
			$('.wp_all_export_filtering_rules').find('li:last').find('.condition').addClass('last_condition');
		}		
		liveFiltering();
	});

	$('#wp_all_export_rule').change(function(){
		if ($(this).val() == 'is_empty' || $(this).val() == 'is_not_empty')
			$('#wp_all_export_value').hide();
		else
			$('#wp_all_export_value').show();
	});		

	// step 1 ( chose & filter export data )
	$('.wpallexport-step-1').each(function(){		
						
		var $wrap = $('.wrap');

		var formHeight = $wrap.height();

		$('.wpallexport-import-from').click(function(){			
			
			var showImportType = false;
			
			var postType = $('input[name=cpt]').val();

			switch ($(this).attr('rel')){				
				case 'specific_type':
					if (postType != ''){
						showImportType = true; 
						$('.wpallexport-choose-file').find('.wpallexport-upload-resource-step-two').slideDown();
						if (postType == 'product')
						{
							$('.auto-generate-template').show();	
						}
						else
						{
							$('.auto-generate-template').hide();
						}								

						$('.wpallexport-filtering-wrapper').show();				
					}
					else
					{
						$('.auto-generate-template').hide();
					}
					break;
				case 'advanced_type':	
					$('.auto-generate-template').hide();
					$('.wpallexport-choose-file').find('.wpallexport-upload-resource-step-two').slideUp();					
					$('.auto-generate-template').hide();
					showImportType = true; 
					$('.wpallexport-filtering-wrapper').hide();
					break;
			}			
			
			$('.wpallexport-import-from').removeClass('selected').addClass('bind');			
			$(this).addClass('selected').removeClass('bind');
			$('.wpallexport-choose-file').find('.wpallexport-upload-type-container').hide();			
			$('.wpallexport-choose-file').find('.wpallexport-upload-type-container[rel=' + $(this).attr('rel') + ']').show();			
			$('.wpallexport-choose-file').find('input[name=export_type]').val( $(this).attr('rel').replace('_type', '') );
			
			if ( ! showImportType){						
				$('.wpallexport-choose-file').find('.wpallexport-submit-buttons').hide();						
			}
			else{						
				$('.wpallexport-choose-file').find('.wpallexport-submit-buttons').show();						
			}

		});

		$('.wpallexport-import-from.selected').click();			

		$('#file_selector').ddslick({
			width: 600,	
			onSelected: function(selectedData){											

		    	if (selectedData.selectedData.value != ""){
		    		
		    		$('#file_selector').find('.dd-selected').css({'color':'#555'});

		    		var i = 0;
					var postType = selectedData.selectedData.value;
					$('#file_selector').find('.dd-option-value').each(function(){
						if (postType == $(this).val()) return false;
						i++;
					});

					$('.wpallexport-choose-file').find('input[name=cpt]').val(postType);	
					
					if (postType == 'product')
					{
						$('.auto-generate-template').show();
					}
					else
					{
						$('.auto-generate-template').hide();
					}

					filtering(postType);					
					
		    	}
		    	else
		    	{
		    		$('.auto-generate-template').hide();
		    		$('.wpallexport-choose-file').find('input[name=cpt]').val('');	
		    		$('#file_selector').find('.dd-selected').css({'color':'#cfceca'});
		    		$('.wpallexport-choose-file').find('.wpallexport-upload-resource-step-two').slideUp();		
		    		$('.wpallexport-choose-file').find('.wpallexport-filtering-wrapper').slideUp();    		
			
					switch ($('.wpallexport-import-from.selected').attr('rel')){				
						case 'specific_type':
							filtering($('input[name=cpt]').val());								
							break;
						case 'advanced_type':					
							//if ($('input[name=wp_query]').val() != ''){
							//	$('.wpallexport-choose-file').find('.wpallexport-submit-buttons').show();
							// }
							// else{
							// 	$('.wpallexport-choose-file').find('.wpallexport-submit-buttons').hide();	
							// }
							break;
					}						
		    	}
		    } 
		});										
	
		$('a.auto-generate-template').click(function(){
			$('input[name^=auto_generate]').val('1');
			
			$('.hierarhy-output').each(function(){
				var sortable = $('.wp_all_export_filtering_rules.ui-sortable');
				if (sortable.length){
					$(this).val(window.JSON.stringify(sortable.pmxe_nestedSortable('toArray', {startDepthCount: 0})));								
				}				
			});			

			$(this).parents('form:first').submit();
		});

		$('form.wpallexport-choose-file').find('input[type=submit]').click(function(e){
			e.preventDefault();			
			
			$('.hierarhy-output').each(function(){
				var sortable = $('.wp_all_export_filtering_rules.ui-sortable');
				if (sortable.length){
					$(this).val(window.JSON.stringify(sortable.pmxe_nestedSortable('toArray', {startDepthCount: 0})));								
				}				
			});			

			$(this).parents('form:first').submit();
		});

		$('#wp_query_selector').ddslick({
			width: 600,	
			onSelected: function(selectedData){											

		    	if (selectedData.selectedData.value != ""){
		    		
		    		$('#wp_query_selector').find('.dd-selected').css({'color':'#555'});		
		    		var queryType = selectedData.selectedData.value;    					
		    		if (queryType == 'wp_query'){
		    			$('textarea[name=wp_query]').attr("placeholder", "'post_type' => 'post', 'post_status' => array( 'pending', 'draft', 'future' )");
		    		}
		    		else{
		    			$('textarea[name=wp_query]').attr("placeholder", "'role' => 'Administrator'");
		    		}
					$('input[name=wp_query_selector]').val(queryType);
		    	}
		    	else{
		    		
		    		$('#wp_query_selector').find('.dd-selected').css({'color':'#cfceca'});
		    		$('.wpallexport-choose-file').find('.wpallexport-upload-resource-step-two').slideUp();		    		
			
		    	}
		    } 
		});	

	});	
	//[/End Step 1]	

	// step 2 ( export template )
	$('.wpallexport-export-template').each(function(){

		var offset = $('#available_data').offset();
    	
    	var offsetTop = $('.error:visible').length ? offset.top + 45 : offset.top;

        $('.wpallexport-step-3').css({'top': (offsetTop) + 'px'});	  

		$is_show_warning = true;
		$is_show_sku_warning = 2;
		$is_show_advanced_query_warning = $('.wp-all-export-advanced-query-warning').length;
		$('#columns').find('li').each(function(){
			if ($(this).find('input[name^=cc_type]').val() == 'id'){
				$is_show_warning = false;												
			}
			if ($(this).find('input[name^=cc_label]').val() == '_sku'){
				$is_show_sku_warning--;
			}
			if ($(this).find('input[name^=cc_label]').val() == 'product_type'){
				$is_show_sku_warning--;
			}
			if ($(this).find('input[name^=cc_label]').val() == 'post_type'){
				$is_show_advanced_query_warning = 0;
			}
		});

		if ($is_show_warning) $('.wp-all-export-warning').show(); else $('.wp-all-export-warning').hide();
		if ($is_show_sku_warning > 0) $('.wp-all-export-sku-warning').show(); else $('.wp-all-export-sku-warning').hide();
		if ($is_show_advanced_query_warning > 0) $('.wp-all-export-advanced-query-warning').show(); else $('.wp-all-export-advanced-query-warning').hide();

		var $sortable = $( "#columns" );

		$( "#available_data li" ).draggable({
			appendTo: "body",
			helper: "clone"
		});

		var outsideContainer = 0;

		// this one control if the draggable is outside the droppable area
		$('#columns_to_export').droppable({
		    accept      : '.ui-sortable-helper'		    
		});

		$( "#columns_to_export" ).on( "dropout", function( event, ui ) {
			outsideContainer = 1;
			ui.draggable.find('.custom_column').css('background', 'pink');			
		} );

		$( "#columns_to_export" ).on( "dropover", function( event, ui ) {
			outsideContainer = 0;
			ui.draggable.find('.custom_column').css('background', 'none');			
		} );

		// this one control if the draggable is dropped
		$('body, form.wpallexport-template').droppable({
		    accept      : '.ui-sortable-helper',
		    drop        : function(event, ui){
		        if(outsideContainer == 1){		        	
		            ui.draggable.remove();
		        }else{
		            ui.draggable.find('.custom_column').css('background', 'none');
		        }
		    }
		});		

		$( "#columns_to_export ol" ).droppable({
			activeClass: "pmxe-state-default",
			hoverClass: "pmxe-state-hover",
			accept: ":not(.ui-sortable-helper)",
			drop: function( event, ui ) {				
				$( this ).find( ".placeholder" ).hide();					
				
				if (ui.draggable.find('input[name^=rules]').length){						
					$('li.' + ui.draggable.find('input[name^=rules]').val()).each(function(){				
						var $value = $(this).find('input[name^=cc_value]').val();
						var $add_field = true;
						$('#columns').find('li').each(function(){
							if ($(this).find('input[name^=cc_value]').val() == $value){
								$add_field = false;
							}
						});
						if ($add_field)
						{
							$( "<li></li>" ).html( $(this).html() ).appendTo( $( "#columns_to_export ol" ) );
							$('#columns').find('li:last').find('div:first').attr('rel', $('#columns').find('li:not(.placeholder)').length);						
						}
					});
				}
				else{
					$( "<li></li>" ).html( ui.draggable.html() ).appendTo( this );
					$('#columns').find('li:last').find('div:first').attr('rel', $('#columns').find('li:not(.placeholder)').length);
				}				

				$is_show_warning = true;
				$is_show_sku_warning = 2;
				$is_show_advanced_query_warning = $('.wp-all-export-advanced-query-warning').length;
				$('#columns').find('li').each(function(){
					if ($(this).find('input[name^=cc_type]').val() == 'id'){
						$is_show_warning = false;												
					}
					if ($(this).find('input[name^=cc_label]').val() == '_sku'){
						$is_show_sku_warning--;
					}
					if ($(this).find('input[name^=cc_label]').val() == 'product_type'){
						$is_show_sku_warning--;
					}
					if ($(this).find('input[name^=cc_label]').val() == 'post_type'){
						$is_show_advanced_query_warning = 0;
					}
				});

				if ($is_show_warning) $('.wp-all-export-warning').show(); else $('.wp-all-export-warning').hide();
				if ($is_show_sku_warning > 0) $('.wp-all-export-sku-warning').show(); else $('.wp-all-export-sku-warning').hide();
				if ($is_show_advanced_query_warning > 0) $('.wp-all-export-advanced-query-warning').show(); else $('.wp-all-export-advanced-query-warning').hide();

			}
		}).sortable({
			items: "li:not(.placeholder)",
			sort: function() {
				// gets added unintentionally by droppable interacting with sortable
				// using connectWithSortable fixes this, but doesn't allow you to customize active/hoverClass options
				$( this ).removeClass( "ui-state-default" );
			}
		});		

		var $this = $(this);
		var $addAnother = $this.find('input.add_column');
		var $addAnotherForm = $('fieldset.wp-all-export-edit-column');
		var $template = $(this).find('.custom_column.template');		

		if (typeof wpPointerL10n != "undefined") wpPointerL10n.dismiss = 'Close';

		/**
		*	Add Another btn click
		*/
		$addAnother.click(function(){
			
			$addAnotherForm.find('form')[0].reset();
			
			$addAnotherForm.removeAttr('rel');
			$addAnotherForm.removeClass('dc').addClass('cc');			
			$addAnotherForm.find('.cc_field').hide();
			
			$addAnotherForm.find('.wpallexport-edit-row-title').hide();
			$addAnotherForm.find('.wpallexport-add-row-title').show();
			$addAnotherForm.find('div[class^=switcher-target]').hide();
			$addAnotherForm.find('#coperate_php').removeAttr('checked');
			$addAnotherForm.find('input.column_name').parents('div.input:first').show();
			
			$('.custom_column').removeClass('active');

			$addAnotherForm.find('select[name=column_value_type]').find('option').each(function(){
				if ($(this).val() == 'id') 
					$(this).attr({'selected':'selected'}).click();
				else
					$(this).removeAttr('selected');
			});  

			$('.wp-all-export-chosen-select').trigger('chosen:updated');			
			$('.wp_all_export_saving_status').html('');

			$('.wpallexport-overlay').show();		
			$addAnotherForm.show();					
			
		});
		/**
		*   Delete custom column action
		*/
		$addAnotherForm.find('.delete_action').click(function(){			
			
			$('.custom_column').removeClass('active');

			$('.custom_column[rel='+ $addAnotherForm.attr('rel') +']').parents('li:first').fadeOut().remove();			

			if ( ! $('#columns').find('li:visible').length ){
				$('#columns').find( ".placeholder" ).show();					
			}

			$is_show_warning = true;
			$is_show_sku_warning = 2;
			$is_show_advanced_query_warning = $('.wp-all-export-advanced-query-warning').length;
			$('#columns').find('li:not(.placeholder)').each(function(i, e){
				$(this).find('div.custom_column:first').attr('rel', i + 1);
				if ($(this).find('input[name^=cc_type]').val() == 'id'){
					$is_show_warning = false;												
				}
				if ($(this).find('input[name^=cc_label]').val() == '_sku'){
					$is_show_sku_warning--;
				}
				if ($(this).find('input[name^=cc_label]').val() == 'product_type'){
					$is_show_sku_warning--;
				}
				if ($(this).find('input[name^=cc_label]').val() == 'post_type'){
					$is_show_advanced_query_warning = 0;
				}
			});

			if ($is_show_warning) $('.wp-all-export-warning').show(); else $('.wp-all-export-warning').hide();
			if ($is_show_sku_warning > 0) $('.wp-all-export-sku-warning').show(); else $('.wp-all-export-sku-warning').hide();
			if ($is_show_advanced_query_warning > 0) $('.wp-all-export-advanced-query-warning').show(); else $('.wp-all-export-advanced-query-warning').hide();

			$addAnotherForm.fadeOut();
			$('.wpallexport-overlay').hide();
		});

		$('.remove-field').live('click', function(e){
			e.stopPropagation();
			$(this).parents('li:first').fadeOut().remove();	
			if ( ! $('#columns').find('li:visible').length ){
				$('#columns').find( ".placeholder" ).show();					
			}			

			$is_show_warning = true;
			$is_show_sku_warning = 2;
			$is_show_advanced_query_warning = $('.wp-all-export-advanced-query-warning').length;
			$('#columns').find('li:not(.placeholder)').each(function(i, e){
				$(this).find('div.custom_column:first').attr('rel', i + 1);
				if ($(this).find('input[name^=cc_type]').val() == 'id'){
					$is_show_warning = false;												
				}
				if ($(this).find('input[name^=cc_label]').val() == '_sku'){
					$is_show_sku_warning--;
				}
				if ($(this).find('input[name^=cc_label]').val() == 'product_type'){
					$is_show_sku_warning--;
				}
				if ($(this).find('input[name^=cc_label]').val() == 'post_type'){
					$is_show_advanced_query_warning = 0;
				}
			});

			if ($is_show_warning) $('.wp-all-export-warning').show(); else $('.wp-all-export-warning').hide();
			if ($is_show_sku_warning > 0) $('.wp-all-export-sku-warning').show(); else $('.wp-all-export-sku-warning').hide();
			if ($is_show_advanced_query_warning > 0) $('.wp-all-export-advanced-query-warning').show(); else $('.wp-all-export-advanced-query-warning').hide();
		});

		/**
		*	Add/Edit custom column action
		*/
		$addAnotherForm.find('.save_action').click(function(){						

			var $value_type = $addAnotherForm.find('select[name=column_value_type]');
			var $php_code = $addAnotherForm.find('.php_code:visible');			
			var $name = $addAnotherForm.find('input.column_name');
			var $export_data_type = $addAnotherForm.find('input[name=export_data_type]');

			var $save = true;
			
			// if ($export_data_type.val() == 'shop_order'){
			// 	$name.val($value_type.find('option:selected').html());
			// }
			
			if ($name.val() == '')
			{
				$save = false;
				$name.addClass('error');
			}

			if ($save)
			{
				var $clone = ($addAnotherForm.attr('rel')) ? $('#columns').find('.custom_column[rel='+ $addAnotherForm.attr('rel') +']') : $template.clone(true);
				if (!parseInt($addAnotherForm.attr('rel'))) $clone.attr('rel', $('#columns').find('.custom_column').length + 1);
				
				$clone.find('input[name^=cc_php]').val($addAnotherForm.find('#coperate_php').is(':checked') ? '1' : '0');						
				$clone.find('input[name^=cc_code]').val($php_code.val());
				$clone.find('input[name^=cc_sql]').val($addAnotherForm.find('textarea.column_value').val());
				$clone.find('input[name^=cc_name]').val($name.val());

				if ($export_data_type.val() == 'shop_order' && $value_type.find('option:selected').val() != 'sql'){
					$clone.find('input[name^=cc_type]').val('woo_order');					
				}
				else{
					$clone.find('input[name^=cc_type]').val($value_type.val());				
				}											
				
				$clone.find('label.wpallexport-xml-element').html("&lt;" + $name.val() + "&gt;");

				if (!parseInt($addAnotherForm.attr('rel'))){ 
					$( "#columns" ).find( ".placeholder" ).hide();							
					$sortable.append('<li></li>');
					$sortable.find('li:last').append($clone.removeClass('template').fadeIn());				
				}				

				var availableData = $('#available_data');

				switch ( $clone.find('input[name^=cc_type]').val() ){
					case 'media':
						$clone.find('input[name^=cc_options]').val($addAnotherForm.find('select.media_field_export_data').val());
						break;
					case 'date':
						var $dateType = $addAnotherForm.find('select.date_field_export_data').val();
						if ($dateType == 'unix')
							$clone.find('input[name^=cc_options]').val('unix');
						else
							$clone.find('input[name^=cc_options]').val($('.pmxe_date_format').val());
						break;
					case 'cf':
						var $value = $addAnotherForm.find('.cf_direct_value');
						$clone.find('input[name^=cc_value]').val($value.val());
						$clone.find('input[name^=cc_label]').val($value.val());
						break;
					case 'acf':
						var $value = $addAnotherForm.find('.acf_direct_value');
						$clone.find('input[name^=cc_value]').val($value.val());
						$clone.find('input[name^=cc_label]').val($value.val());
						availableData.find('.custom_column').each(function(){
							if ($(this).find('input[name^=cc_value]').val() == $value.val()){
								$clone.find('input[name^=cc_options]').val($(this).find('input[name^=cc_options]').val());								
							}
						});
						break;
					case 'woo':
						var $value = $addAnotherForm.find('.woo_direct_value');
						$clone.find('input[name^=cc_value]').val($value.val());
						$clone.find('input[name^=cc_label]').val($value.val());
						break;
					case 'attr':
						var $value = $addAnotherForm.find('.attr_direct_value');
						$clone.find('input[name^=cc_value]').val($value.val());
						$clone.find('input[name^=cc_label]').val($value.val());
						break;
					case 'cats':
						var $value = $addAnotherForm.find('.cats_direct_value');
						$clone.find('input[name^=cc_value]').val($value.val());
						$clone.find('input[name^=cc_label]').val($value.val());
						break;
					case 'woo_order':
						$clone.find('input[name^=cc_value]').val($value_type.val());
						$clone.find('input[name^=cc_label]').val($value_type.val());
						if ($value_type.find('option:selected').attr('rel') == 'cf')
						{
							$clone.find('input[name^=cc_type]').val('cf');	
						}
						else
						{
							$clone.find('input[name^=cc_options]').val($value_type.find('option:selected').attr('rel'));	
						}						
						break;
					default:
						$clone.find('input[name^=cc_value]').val($value_type.val());
						$clone.find('input[name^=cc_label]').val($value_type.val());
						break;
				}							
				
				$is_show_warning = true;
				$is_show_sku_warning = 2;
				$is_show_advanced_query_warning = $('.wp-all-export-advanced-query-warning').length;
				$('#columns').find('li').each(function(){
					if ($(this).find('input[name^=cc_type]').val() == 'id'){
						$is_show_warning = false;												
					}
					if ($(this).find('input[name^=cc_label]').val() == '_sku'){
						$is_show_sku_warning--;
					}
					if ($(this).find('input[name^=cc_label]').val() == 'product_type'){
						$is_show_sku_warning--;
					}
					if ($(this).find('input[name^=cc_label]').val() == 'post_type'){
						$is_show_advanced_query_warning = 0;
					}
				});

				if ($is_show_warning) $('.wp-all-export-warning').show(); else $('.wp-all-export-warning').hide();
				if ($is_show_sku_warning > 0) $('.wp-all-export-sku-warning').show(); else $('.wp-all-export-sku-warning').hide();
				if ($is_show_advanced_query_warning > 0) $('.wp-all-export-advanced-query-warning').show(); else $('.wp-all-export-advanced-query-warning').hide();

				$addAnotherForm.hide();

				$('.wpallexport-overlay').hide();

				$('.custom_column').removeClass('active');
				
			}
		});

		$addAnotherForm.find('input[type=text], textarea').focus(function(){$(this).removeClass('error');});
		
		/**
		*	Click on column for edit
		*/
		$('#columns').find('.custom_column').live('click', function(){
			
			$addAnotherForm.find('form')[0].reset();			
			
			$addAnotherForm.removeClass('dc').addClass('cc');
			$addAnotherForm.attr('rel', $(this).attr('rel'));

			$addAnotherForm.find('.wpallexport-add-row-title').hide();
			$addAnotherForm.find('.wpallexport-edit-row-title').show();			

			$addAnotherForm.find('input.column_name').parents('div.input:first').show();

			$addAnotherForm.find('.cc_field').hide();			
			$('.custom_column').removeClass('active');
			$(this).addClass('active');

			var $export_data_type = $addAnotherForm.find('input[name=export_data_type]');
			var $type = '';

			$('.wp_all_export_saving_status').html('');

			// set field type
			if ($export_data_type.val() == 'shop_order')
			{
				$type = $(this).find('input[name^=cc_value]');										 
			}
			else
			{
				$type = $(this).find('input[name^=cc_type]');										
			}			

			$addAnotherForm.find('select[name=column_value_type]').find('option').each(function(){
				if ($(this).val() == $type.val()) 
					$(this).attr({'selected':'selected'}).click();
				else
					$(this).removeAttr('selected');
			}); 

			$('.wp-all-export-chosen-select').trigger('chosen:updated');

			// set php snipped
			var $php_code = $(this).find('input[name^=cc_code]');
			var $is_php = parseInt($(this).find('input[name^=cc_php]').val());
			
			if ($is_php){ 
				$addAnotherForm.find('#coperate_php').attr({'checked':'checked'}); 
				$addAnotherForm.find('#coperate_php').parents('div.input:first').find('div[class^=switcher-target]').show();
			}
			else{ 
				$addAnotherForm.find('#coperate_php').removeAttr('checked');
				$addAnotherForm.find('#coperate_php').parents('div.input:first').find('div[class^=switcher-target]').hide();
			}

			$addAnotherForm.find('#coperate_php').parents('div.input:first').find('.php_code').val($php_code.val());					

			var $options = $(this).find('input[name^=cc_options]').val();

			switch ( $type.val() ){
				case 'sql':
					$addAnotherForm.find('textarea.column_value').val($(this).find('input[name^=cc_sql]').val());
					$addAnotherForm.find('.sql_field_type').show();
					break;
				case 'cf':
					$addAnotherForm.find('.cf_direct_value').val($(this).find('input[name^=cc_value]').val());					
					$addAnotherForm.find('.cf_field_type').show();
					break;
				case 'acf':
					$addAnotherForm.find('.acf_direct_value').val($(this).find('input[name^=cc_value]').val());					
					$addAnotherForm.find('.acf_field_type').show();
					break;
				case 'woo':
					$addAnotherForm.find('.woo_direct_value').val($(this).find('input[name^=cc_value]').val());					
					$addAnotherForm.find('.woo_field_type').show();
					break;
				case 'attr':
					$addAnotherForm.find('.attr_direct_value').val($(this).find('input[name^=cc_value]').val());					
					$addAnotherForm.find('.attr_field_type').show();
					break;
				case 'cats':
					$addAnotherForm.find('.cats_direct_value').val($(this).find('input[name^=cc_value]').val());					
					$addAnotherForm.find('.cats_field_type').show();
					break;
				case 'date':
					$addAnotherForm.find('select.date_field_export_data').find('option').each(function(){
						if ($(this).val() == $options || $options != 'unix' && $(this).val() == 'php') 
							$(this).attr({'selected':'selected'}).click();
						else
							$(this).removeAttr('selected');
					});			

					if ($options != 'php' && $options != 'unix'){
						$('.pmxe_date_format').val($options);
						$('.pmxe_date_format_wrapper').show();
					}
					else
						$('.pmxe_date_format').val('');
					$addAnotherForm.find('.date_field_type').show();
					break;
				case 'media':
					$addAnotherForm.find('select.media_field_export_data').find('option').each(function(){
						if ($(this).val() == $options)
							$(this).attr({'selected':'selected'}).click();
						else
							$(this).removeAttr('selected');
					});	
					$addAnotherForm.find('.media_field_type').show();									
					break;
			}
			
			$addAnotherForm.find('input.column_name').val($(this).find('input[name^=cc_name]').val());
			$addAnotherForm.show();
			$('.wpallexport-overlay').show();			

		});	

		$is_show_sku_warning = 2;
		$('#columns').find('li').each(function(){			
			if ($(this).find('input[name^=cc_label]').val() == '_sku'){
				$is_show_sku_warning--;
			}
			if ($(this).find('input[name^=cc_label]').val() == 'product_type'){
				$is_show_sku_warning--;
			}
		});
		
		if ($is_show_sku_warning > 0) $('.wp-all-export-sku-warning').show(); else $('.wp-all-export-sku-warning').hide();	

		/**
		*	Preview export file
		*/

		var doPreview = function( ths, tagno ){			

			$('.wpallexport-overlay').show();					

			ths.pointer({
	            content: '<div class="wpallexport-preview-preload wpallexport-pointer-preview"></div>',
	            position: {
	                edge: 'right',
	                align: 'center'                
	            },
	            pointerWidth: 715,
	            close: function() {
	                $.post( ajaxurl, {
	                    pointer: 'pksn1',
	                    action: 'dismiss-wp-pointer'
	                });
	                $('.wpallexport-overlay').hide();
	            }
	        }).pointer('open');

	        var $pointer = $('.wpallexport-pointer-preview').parents('.wp-pointer').first();	 

	        var $leftOffset = ($(window).width() - 715)/2;

	        $pointer.css({'position':'fixed', 'top' : '15%', 'left' : $leftOffset + 'px'});	        

			var request = {
				action: 'export_preview',	
				data: $('form.wpallexport-step-3').serialize(),
				tagno: tagno,
				security: wp_all_export_security				
		    };    		    

			$.ajax({
				type: 'POST',
				url: get_valid_ajaxurl(),
				data: request,
				success: function(response) {						

					ths.pointer({'content' : response.html});

					$pointer.css({'position':'fixed', 'top' : '15%', 'left' : $leftOffset + 'px'});
				
					var $preview = $('.wpallexport-preview');		

					$preview.parent('.wp-pointer-content').removeClass('wp-pointer-content').addClass('wpallexport-pointer-content');

					$preview.find('.navigation a').unbind('click').die('click').live('click', function () {

						tagno += '#prev' == $(this).attr('href') ? -1 : 1;						

						doPreview(ths, tagno);

					});

				},
				error: function( jqXHR, textStatus ) {	

					ths.pointer({'content' : jqXHR.responseText});													

				},
				dataType: "json"
			});

		};

		$(this).find('.preview_a_row').click( function(){ 			
			doPreview($(this), 1); 
		});		

		$('.wpae-available-fields-group').click(function(){
			var $mode = $(this).find('.wpae-expander').text();
			$(this).next('div').slideToggle();
			if ($mode == '+') $(this).find('.wpae-expander').text('-'); else $(this).find('.wpae-expander').text('+');
		});

		$('.pmxe_remove_column').live('click', function(){			
			$(this).parents('li:first').remove();
		});

		$('.close_action').click(function(){
			$(this).parents('fieldset:first').hide();
			$('.wpallexport-overlay').hide();
			$('#columns').find('div.active').removeClass('active');
		});

		$('.cf_direct_value').each(function(){			
			$(this).autocomplete({
				source: eval('__META_KEYS'),
				minLength: 0
			}).click(function () {
				$(this).autocomplete('search', '');
				$(this).attr('rel', '');
			});		
		});

		$('.woo_direct_value').each(function(){			
			$(this).autocomplete({
				source: eval('__WOO_KEYS'),
				minLength: 0
			}).click(function () {
				$(this).autocomplete('search', '');
				$(this).attr('rel', '');
			});		
		});

		$('.attr_direct_value').each(function(){			
			$(this).autocomplete({
				source: eval('__ATTR_KEYS'),
				minLength: 0
			}).click(function () {
				$(this).autocomplete('search', '');
				$(this).attr('rel', '');
			});		
		});

		$('.acf_direct_value').each(function(){			
			$(this).autocomplete({
				source: eval('__ACF_KEYS'),
				minLength: 0
			}).click(function () {
				$(this).autocomplete('search', '');
				$(this).attr('rel', '');
			});		
		});

		$('.cats_direct_value').each(function(){			
			$(this).autocomplete({
				source: eval('__TAXES_KEYS'),
				minLength: 0
			}).click(function () {
				$(this).autocomplete('search', '');
				$(this).attr('rel', '');
			});		
		});

		$('.date_field_export_data').change(function(){
			if ($(this).val() == "unix")
				$('.pmxe_date_format_wrapper').hide();
			else
				$('.pmxe_date_format_wrapper').show();
		});

		$('.xml-expander').live('click', function () {
			var method;
			if ('-' == $(this).text()) {
				$(this).text('+');
				method = 'addClass';
			} else {
				$(this).text('-');
				method = 'removeClass';
			}
			// for nested representation based on div
			$(this).parent().find('> .xml-content')[method]('collapsed');
			// for nested representation based on tr
			var $tr = $(this).parent().parent().filter('tr.xml-element').next()[method]('collapsed');
		});

		$('.wp-all-export-edit-column').css('left', ($( document ).width()/2) - 355 );    

	    var wp_all_export_config = {
	      '.wp-all-export-chosen-select' : {width:"50%"}    
	    }

	    for (var selector in wp_all_export_config) {
	    	$(selector).chosen(wp_all_export_config[selector]);
	    	$(selector).on('change', function(evt, params) {
				$('.cc_field').hide();
				switch ($(selector).val()){
					case 'media':
						$('.media_field_type').show();
						break;
					case 'date':
						$('.date_field_type').show();
						break;
					case 'sql':
						$('.sql_field_type').show();
						break;
					case 'cf':
						$('.cf_field_type').show();				
						break;
					case 'acf':
						$('.acf_field_type').show();				
						break;
					case 'woo':
						$('.woo_field_type').show();				
						break;
					case 'attr':
						$('.attr_field_type').show();				
						break;
					case 'cats':
						$('.cats_field_type').show();
						break;
				}
			});
	    }    	    	 

	    $('.wp-all-export-advanced-field-options').click(function(){
	    	if ($(this).find('span').html() == '+'){
	    		$(this).find('span').html('-');
	    		$('.wp-all-export-advanced-field-options-content').fadeIn('fast', function(){	    			
	    			if ($('#coperate_php').is(':checked')) editor.setCursor(1);
	    		});	    		
	    	}
	    	else{
	    		$(this).find('span').html('+');
	    		$('.wp-all-export-advanced-field-options-content').hide();
	    	}    	
	    });

	    // Auto generate available data
	    $('#wp_all_export_auto_generate_data').click(function(){
	    	
	    	$('ol#columns').find('li:not(.placeholder)').fadeOut().remove();

	    	$('#available_data').find('li.wp_all_export_auto_generate, li.pmxe_cats').each(function(i, e){
	    		var clone = $(this).clone();
	    		clone.attr('rel', i);
	    		$( "<li></li>" ).html( clone.html() ).appendTo( $( "#columns_to_export ol" ) );				
	    	});

	    });	    	     	    

	});	
	//[/End Step 2]	

	// template form: auto submit when `load template` list value is picked
	$('form.wpallexport-template').find('select[name="load_template"]').live('change', function () {
		$(this).parents('form').submit();
	});	

	$('.wp_all_export_save_functions').click(function(){
    	var request = {
			action: 'save_functions',	
			data: editor.getValue(),				
			security: wp_all_export_security				
	    };    
	    $('.wp_all_export_functions_preloader').show();
	    $('.wp_all_export_saving_status').html('');

		$.ajax({
			type: 'POST',
			url: get_valid_ajaxurl(),
			data: request,
			success: function(response) {						
				$('.wp_all_export_functions_preloader').hide();
				
				if (response.result)
				{
					$('.wp_all_export_saving_status').css({'color':'green'});
					setTimeout(function() {
						$('.wp_all_export_saving_status').html('').fadeOut();
					}, 3000);
				}
				else
				{
					$('.wp_all_export_saving_status').css({'color':'red'});
				}

				$('.wp_all_export_saving_status').html(response.msg).show();
									
			},
			error: function( jqXHR, textStatus ) {						
				$('.wp_all_export_functions_preloader').hide();
			},
			dataType: "json"
		});
    }); 

	// step 3 ( export options )
    if ( $('.wpallexport-step-4').length ){

    	if ($('input[name^=selected_post_type]').length){

    		var postType = $('input[name^=selected_post_type]').val();

    		init_filtering_fields();

    		if ($('form.edit').length){

    			liveFiltering();    				

    		} 

		    $('form.choose-export-options').find('input[type=submit]').click(function(e){
				e.preventDefault();			
				
				$('.hierarhy-output').each(function(){
					var sortable = $('.wp_all_export_filtering_rules.ui-sortable');
					if (sortable.length){
						$(this).val(window.JSON.stringify(sortable.pmxe_nestedSortable('toArray', {startDepthCount: 0})));								
					}
				});			

				$(this).parents('form:first').submit();
			});			
    	}

    	$('.wp_all_export_confirm_and_run').click(function(e){
			e.preventDefault();
			$('form.choose-export-options').submit();
		});

    }   

    if ($('.wpallexport-re-run-export').length)
	{
		$('#export_only_new_stuff').click(function(){
			$(this).attr('disabled','disabled');
			$('label[for=export_only_new_stuff]').addClass('loading');
			liveFiltering(null, function(){
				$('label[for=export_only_new_stuff]').removeClass('loading');
				$('#export_only_new_stuff').removeAttr('disabled');
			});
		});
	}    	
    //[/End Step 3]	 

    //[Step 4]
    $('.download_data').click(function(){
    	window.location.href = $(this).attr('rel');
    });
    //[/End Step 4]

    // additional functionality

    $('input[name=pmxe_generate_zapier_api_key]').click(function(e){
    	
    	e.preventDefault();

    	var request = {
			action: 'generate_zapier_api_key',
			security: wp_all_export_security				
	    };    
	    
		$.ajax({
			type: 'POST',
			url: get_valid_ajaxurl(),
			data: request,
			success: function(response) {						
				$('input[name=zapier_api_key]').val(response.api_key);
			},
			error: function( jqXHR, textStatus ) {						
				
			},
			dataType: "json"
		});
    });

    $('.wpallexport-overlay').click(function(){
		$('.wp-pointer').hide();		
		$('#columns').find('div.active').removeClass('active');
		$('fieldset.wp-all-export-edit-column').hide();
		$(this).hide();        
	});		

	var fix_tag_position = function(){
		if ( $('.wpallexport-step-3').length ){
	    	var offset = $('#available_data').offset();
	    	
	        if ($(document).scrollTop() > offset.top){
	            $('.wpallexport-step-3').css({'top':'10px'});        	            
	        }
	        else{	        	
	        	$('.wpallexport-step-3').css({'top': (offset.top - $(document).scrollTop()) + 'px'});
	        }
	    }
	}	

	$(document).scroll(function() {    	    				
    	fix_tag_position();
	}); 
	
});})(jQuery);
