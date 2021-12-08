jQuery(document).ready(function($){
	"use strict";

$('.import-content-topic .btn-close').on('click',function(){
$(this).closest('.full-content-topic').remove();
});
	/* Select Options */
	$('.ftc-importer-wrapper .option label').bind('click', function(){
		var checkbox = $(this).find('input[type="checkbox"]');
		if( checkbox.is(':checked') ){
			$(this).addClass('selected');
		}
		else{
			$(this).removeClass('selected');
		}
		
		ftc_import_button_state();
	});
	jQuery(document).ready(function(){
		jQuery('.ftc-importer-wrapper .content.option').click(function(e){
			e.preventDefault();
			$('.selected').removeClass('selected');
			$(this).addClass('selected');
			if($(this).hasClass('selected')){
				$(this).find('.button-import button').removeAttr("disabled");
			}
			else{
				$(this).find('.button-import button').attr("disabled",'');
			}

		});
	});
	/*Click change tab*/
	var tabs = $('.full-list-content');
	tabs.each( function(){

        var $_Tabs = $(this); // Single tabs holder
        
        var tabsWrapper = $_Tabs.find('.pagination'),
        tabTitles   = tabsWrapper.find('.page'),
        tabsContent = $_Tabs.find('.content-tab'),
        content     = tabsContent.find('.homepage');
        
        //tabTitles.click( function(event) {
        	$('.page-1, .content-1').addClass('active');
        	$( document ).on( 'click', '.page', function(event) {
        		$(this).addClass('active');
        		$(this).siblings().removeClass('active');

          // Hide inactive tab titles and show active one and content
          var tab = $(this).data('tab');
          content.not('.homepage.content-'+ tab).removeClass('active');
          tabsContent.find('.homepage.content-' + tab).addClass('active');
      });

        });
	
	function ftc_import_button_state(){
		var disabled = true;
		$('.ftc-importer-wrapper .option input[type="checkbox"]').each(function(){
			if( $(this).is(':checked') ){
				disabled = false;
				return;
			}
		});
		$('#ftc-import-button').attr('disabled', disabled);
	}
	
	/* Import */
	var ftc_import_percent = 0, ftc_import_percent_increase = 0, ftc_import_index_file = 0;
	var ftc_arr_import_data = new Array();

	/* Full Import */
	$('#ftc-import-button-full').bind('click', function(){	
		$('.ftc-importer-wrapper .option label').unbind('click');
		$('.option_page .set_page_home').attr('disabled', 'disabled');
		
		$(this).attr('disabled', true);
		$(this).siblings('.importing-button').removeClass('hidden');
		$('.ftc-importer-wrapper label').addClass('hidden');
		$('#ftc-import-button').css('display','none');
		
		$('.ftc-importer-wrapper .import-result').removeClass('hidden');

		ftc_arr_import_data.push( {'action' : 'ftc_import_theme_options', 'message' : 'Theme Options Imported Successfully'} );

		ftc_arr_import_data.push( {'action' : 'ftc_mmm_options_backup', 'message' : 'Mega Main Menu Imported Successfully'} );		

		ftc_arr_import_data.push( {'action' : 'ftc_import_widget', 'message' : 'Widgets Imported Successfully'} );
		
		ftc_arr_import_data.push( {'action' : 'ftc_import_revslider', 'message' : 'Revolution Sliders Imported Successfully'} );
		
		var num_content_file = 14;
		for( var i = 1; i <= num_content_file; i++ ){
			var message = '';
			if( i == num_content_file ){
				message = 'Demo Content Imported Successfully';
			}
			if( i < 10 ){
				i = i;
			}
			var data = {'action' : 'ftc_import_content', 'file_name' : 'content' + i, 'message' : message};
			ftc_arr_import_data.push( data );
		}	
		ftc_arr_import_data.push( {'action' : 'ftc_import_menu'} );
		ftc_arr_import_data.push( {'action' : 'ftc_import_config'} );
		
		var total_ajaxs = ftc_arr_import_data.length;
		
		if( total_ajaxs == 0 ){
			return;
		}
		
		ftc_import_percent_increase = 100 / total_ajaxs;
		
		ftc_import_ajax();
		
	});
	/* Custom Import */
	$('#ftc-import-button').bind('click', function(){
		$('.ftc-importer-wrapper .option label').unbind('click');
		$('.option_page .set_page_home').attr('disabled', 'disabled');
		$(this).attr('disabled', true);
		$(this).siblings('.importing-button').removeClass('hidden');
		$('#ftc-import-button-full').addClass('hidden');
		
		$('.ftc-importer-wrapper .import-result').removeClass('hidden');
		
		var import_theme_options = $('#ftc_import_theme_options').is(':checked');
		var mmm_options_backup= $('#ftc_mmm_options_backup').is(':checked');
		var import_widget = $('#ftc_import_widget').is(':checked');
		var import_revslider = $('#ftc_import_revslider').is(':checked');
		var import_menu = $('#ftc_import_menu').is(':checked');
		var import_demo_content = $('#ftc_import_demo_content').is(':checked');
		
		if( import_theme_options ){
			ftc_arr_import_data.push( {'action' : 'ftc_import_theme_options', 'message' : 'Theme Options Imported Successfully'} );
		}

		if( mmm_options_backup ){
			ftc_arr_import_data.push( {'action' : 'ftc_mmm_options_backup', 'message' : 'Mega Main Menu Imported Successfully'} );
		}
		
		if( import_widget ){
			ftc_arr_import_data.push( {'action' : 'ftc_import_widget', 'message' : 'Widgets Imported Successfully'} );
		}
		
		if( import_revslider ){
			ftc_arr_import_data.push( {'action' : 'ftc_import_revslider', 'message' : 'Revolution Sliders Imported Successfully'} );
		}
		if( import_menu ){
			ftc_arr_import_data.push( {'action' : 'ftc_import_menu', 'message' : 'Menu Imported Successfully'} );
		}

		if( import_demo_content ){			
			var num_content_file = 14;
			for( var i = 1; i <= num_content_file; i++ ){
				var message = '';
				if( i == num_content_file ){
					message = 'Demo Content Imported Successfully';
				}
				if( i < 10 ){
					i =  i;
				}
				var data = {'action' : 'ftc_import_content', 'file_name' : 'content' + i, 'message' : message};
				ftc_arr_import_data.push( data );
			}		
		}

		
		if( import_demo_content ){
			ftc_arr_import_data.push( {'action' : 'ftc_import_config'} );
		}
		if( import_demo_content ){
			ftc_arr_import_data.push( {'action' : 'ftc_import_menu'} );
		}
		
		var total_ajaxs = ftc_arr_import_data.length;
		
		if( total_ajaxs == 0 ){
			return;
		}
		
		ftc_import_percent_increase = 100 / total_ajaxs;
		
		ftc_import_ajax();
		
	});

		/*import homepage*/
		
		$('button.import-homepage').on('click', function(){
			$('.ftc-importer-wrapper .content.option').unbind('click');
			$('.ftc-importer-wrapper .content.option .import-homepage').unbind('click');

			$(this).attr('disabled', true);
			$(this).attr('style','margin-right:10px');
			$(this).find('.importing-button').removeClass('hidden');
			$(this).closest('.content').find('.import-result').removeClass('hidden');

			$(this).find('.import-result').removeClass('hidden');
			var file_name = $(this).data('file_name');
			var folder = $(this).data('folder');
			var message = 'Demo has imported';
			var data = {'action' : 'ftc_import_homepage', 'folder' : folder , 'file_name' : file_name , 'message' : message};
			ftc_arr_import_data.push( data );
			ftc_arr_import_data.push( {'action' : 'ftc_import_revslider_homepage', 'folder' : folder , 'file_name' : file_name } );
			ftc_arr_import_data.push( {'action' : 'ftc_change_url'} );
			var total_ajaxs = ftc_arr_import_data.length;

			if( total_ajaxs == 0 ){
				return;
			}

			ftc_import_percent_increase = 100 / total_ajaxs;

			ftc_import_ajax();
		});
	
/*import content for topic*/
		$('.ftc-import-button-topic').on('click', function(){
			$('.ftc-importer-wrapper .content.option').unbind('click');
			$('.ftc-importer-wrapper .content.option .import-homepage').unbind('click');

			$(this).attr('disabled', true);
			$(this).find('.importing-button').removeClass('hidden');
			$(this).closest('.full-content-topic').find('.import-result').removeClass('hidden');

			$(this).find('.import-result').removeClass('hidden');
			var folder = $(this).data('folder');
			var message = 'The topic demo data has been imported';
			var num_content_file = 6;
			for( var i = 1; i <= num_content_file; i++ ){
				var message = '';
				if( i == num_content_file ){
					message = 'Demo Content Imported Successfully';
				}
				if( i < 10 ){
					i =  i;
				}
				var data = {'action' : 'ftc_import_content_for_topic', 'folder' : folder , 'file_name' : 'content-' + i, 'message' : message};
				ftc_arr_import_data.push( data );
			}	
			ftc_arr_import_data.push( {'action' : 'ftc_change_url'} );
			var total_ajaxs = ftc_arr_import_data.length;

			if( total_ajaxs == 0 ){
				return;
			}
			

			ftc_import_percent_increase = 100 / total_ajaxs;

			ftc_import_ajax();
		});
	
	function ftc_import_ajax(){
		if( ftc_import_index_file == ftc_arr_import_data.length ){
			ftc_add_result_message( 'Done! Click <a href="../" target="blank">Here</a> to go to Homepage!!' );
			$('.ftc-importer-wrapper .fa.importing-button').hide();
			return;
		}
		$.ajax({
			type: 'POST'
			,url: ajaxurl
			,async: true
			,data: ftc_arr_import_data[ftc_import_index_file]
			,complete: function(jqXHR, textStatus){
				ftc_import_percent += ftc_import_percent_increase;
				ftc_progress_bar_handle();
				if( ftc_arr_import_data[ftc_import_index_file].message ){
					ftc_add_result_message( ftc_arr_import_data[ftc_import_index_file].message );
				}
				ftc_import_index_file++;
				setTimeout(function(){
					ftc_import_ajax();
				}, 200);
			}
		});
	}
	
	function ftc_progress_bar_handle(){
		if( ftc_import_percent > 100 ){
			ftc_import_percent = 100;
		}
		var progress_bar = $('.ftc-importer-wrapper .import-result .progress-bar');
		progress_bar.css({'width': Math.ceil( ftc_import_percent ) + '%'});
		progress_bar.html( Math.ceil( ftc_import_percent ) + '% Complete');
	}
	
	function ftc_add_result_message( message ){
		var message_wrapper = $('.ftc-importer-wrapper .messages');
		message_wrapper.append('<p>' + message + '</p>');
	}
	
});
