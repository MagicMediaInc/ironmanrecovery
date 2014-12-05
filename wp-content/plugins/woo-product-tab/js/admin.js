jQuery(document).ready(function($) {
	jQuery('.pw_iconpicker i').click(function(){
		var val=(jQuery(this).attr('class').split(' ')[0]!='fa-none' ? jQuery(this).attr('class').split(' ')[0]:"");
		jQuery('#font_icon').val(val);
		jQuery(this).siblings( '.active' ).removeClass( 'active' );
		jQuery(this).addClass('active');
	});
	
	
	//ADD TAB PAGE	
	jQuery('#product_tab_type').change(function(){
		jQuery('#product_tab_type > option').each(function() {
			var type=jQuery(this).val();
			jQuery('#'+type+'_setting_area').hide();
		});
		jQuery('#product_tab_use_all').attr('checked', false);
		var type=jQuery(this).val();
	});
	
	jQuery('#product_tab_type > option').each(function() {
		var type=jQuery(this).val();
		jQuery('#'+type+'_setting_area').hide();
	});
	
	jQuery('#product_tab_use_all').click(function(){
		var type=jQuery('#product_tab_type').val();
		if(jQuery(this).is(":checked"))
		{
			jQuery('#'+type+'_setting_area').show();
		}else {
			jQuery('#'+type+'_setting_area').hide();
		}
	});
	
	if(jQuery('#product_tab_use_all').is(":checked"))
	{
		var type=jQuery('#product_tab_type').val();
		jQuery('#'+type+'_setting_area').show();
	}
	//END TAB PAGE SCRIPS
	
	// Ajax Chosen Related Post Selectors
	if(jQuery("html").find(".related-posts").length)
	{
		jQuery(".related-posts").chosen();
	}
	
	if(jQuery("html").find(".related-post").length)
	{
		jQuery(".related-post").chosen();
		jQuery(".chosen-container-multi").css("width","350px");
		jQuery(".search-field").css("width","auto");
	}
	
	//VIDEO GALLERY TAB
	jQuery('.custom_upload_video_button').click(function() {
		formfield = jQuery(this).siblings('.custom_upload_video');
		preview = jQuery(this).siblings('.custom_preview_video');
		tb_show('', 'media-upload.php?type=image&TB_iframe=true');
		window.send_to_editor = function(html) {
			imgurl = jQuery('a',html).attr('href');
			
			var fileurl = jQuery(html);
			//check if fileurl is a video ??
			var fName = jQuery(fileurl).attr('href');
			
			classes = jQuery('img', html).attr('class');
			id = classes.replace(/(.*?)wp-image-/, '');
			formfield.val(id);
			preview.attr('src', imgurl);
			tb_remove();
		}
		return false;
	});
		
	jQuery('.custom_upload_video_thumb_button').click(function() {
		formfield = jQuery(this).siblings('.custom_upload_video_thumb');
		preview = jQuery(this).parent().parent().parent().find('.custom_preview_video_thumb');
		tb_show('', 'media-upload.php?type=image&TB_iframe=true');
		window.send_to_editor = function(html) {
			imgurl = jQuery('img',html).attr('src');
			classes = jQuery('img', html).attr('class');
			id = classes.replace(/(.*?)wp-image-/, '');
			formfield.val(id);
			preview.attr('src', imgurl);
			tb_remove();
		}
		return false;
	});
	
	jQuery(".custom_clear_video_thumbnail_button").click(function() {
		jQuery(this).parent().find(".custom_upload_video_thumb").val("");
		jQuery(this).parent().parent().parent().find(".custom_preview_video_thumb").attr("src", "");
		return false;
	});
	
	jQuery('.repeatable-add-video').click(function() {
		field = jQuery(this).closest('div').find('ul.custom_repeatable li:last').clone(true);
		fieldLocation = jQuery(this).closest('div').find('ul.custom_repeatable li:last');
		jQuery('img', field).attr('src','');
		jQuery(field).find("input:checkbox").prop("checked",false);
		

		jQuery('input:not(:button)', field).val('').attr('name', function(index, name) {
			return name.replace(/[0-9]+(?!.*[0-9])/, function(fullMatch, n) {
				return parseInt(fullMatch, 10) + 1;
			});
		})

		jQuery(field).find("input:checkbox").val("on");

		jQuery('input#custom_video', field).val('').attr('name', function(index, name) {
			return name.replace(/[0-9]+(?!.*[0-9])/, function(fullMatch, n) {
				return parseInt(fullMatch, 10) + 1;
			});
		})
		
		jQuery('input#custom_video_thumb', field).val('').attr('name', function(index, name) {	
			return name.replace(/[0-9]+(?!.*[0-9])/, function(fullMatch, n) {
				return parseInt(fullMatch, 10) + 1;
			});
		})
		
		field.insertAfter(fieldLocation, jQuery(this).closest('div'));
		return false;
	});
	
	//////////UPLOAD AND REPEATABLE IMAGE/////////////
	jQuery('.custom_upload_image_button').click(function() {
		formfield = jQuery(this).siblings('.custom_upload_image');
		preview = jQuery(this).parent().parent().parent().find(".custom_preview_image");
		//confirm(jQuery(this).parent().parent().parent().find(".custom_preview_image").attr('src'));
		tb_show('', 'media-upload.php?type=image&TB_iframe=true');
		window.send_to_editor = function(html) {
			imgurl = jQuery('img',html).attr('src');
			classes = jQuery('img', html).attr('class');
			id = classes.replace(/(.*?)wp-image-/, '');
			formfield.val(id);
			preview.attr('src', imgurl);
			tb_remove();
		}
		return false;
	});
	
	jQuery('.repeatable-add-image').click(function() {
		field = jQuery(this).closest('div').find('.custom_repeatable li:last').clone(true);
		fieldLocation = jQuery(this).closest('div').find('.custom_repeatable li:last');
		jQuery('img', field).attr('src','');
		jQuery('input:not(:button)', field).val('').attr('name', function(index, name) {
			return name.replace(/[0-9]+(?!.*[0-9])/, function(fullMatch, n) {
				return parseInt(fullMatch, 10) + 1;
			});
		})
		field.insertAfter(fieldLocation, jQuery(this).closest('div'));
		return false;
	});
	
	
	jQuery('.custom_clear_image_button').click(function() {
		var defaultImage ='';
		jQuery(this).parent().find('.custom_upload_image').val('');
		jQuery(this).parent().parent().parent().find(".custom_preview_image").attr('src', defaultImage);
		return false;
	});
	
	
	//////////UPLOAD AND REPEATABLE DOWNLOAD FILE/////////////
	jQuery(".custom_upload_download_button").click(function() {
		formfield = jQuery(this).siblings(".custom_upload_download");
		preview = jQuery(this).parent().find(".custom_download_name");
		tb_show("", "media-upload.php?type=image&TB_iframe=true");
		window.send_to_editor = function(html) {
			imgurl = jQuery("img",html).attr("src");
			classes = jQuery("img", html).attr("class");
			id = classes.replace(/(.*?)wp-image-/, "");
			formfield.val(id);
			preview.html("<i class=\'fa fa-check\'></i>"+translate.file_uploaded);
			tb_remove();
		}
		return false;
	});
	
	jQuery(".repeatable-add-download").click(function() {
		field = jQuery(this).closest("div").find(".custom_repeatable li:last").clone(true);
		fieldLocation = jQuery(this).closest("div").find(".custom_repeatable li:last");
		jQuery("img", field).attr("src","");
		jQuery("input:not(:button)", field).val("").attr("name", function(index, name) {
			return name.replace(/[0-9]+(?!.*[0-9])/, function(fullMatch, n) {
				return parseInt(fullMatch, 10) + 1;
			});
		})
		
		jQuery("textarea.product_download_tab_description", field).val("").attr("name", function(index, name) {	
			return name.replace(/[0-9]+(?!.*[0-9])/, function(fullMatch, n) {
				return parseInt(fullMatch, 10) + 1;
			});
		})
		
		
		textarea_name=jQuery(field).find("textarea").attr("name");
		var text_n=Math.floor((Math.random() * 10) + 1);
		
		jQuery.post(
			ajaxurl,
			{
				action : "insert_tinymce",
				id : "answer_"+text_n,
				name : textarea_name,
				class : "product_faq_tab_answer"
			},
			function(response){
				jQuery(field).find("#target-div").replaceWith(response);
				jQuery(field).find(".custom_download_name").html("<i class=\'fa fa-times\'></i>"+translate.no_file_uploaded);
				field.insertAfter(fieldLocation, jQuery(this).closest("div"));
			}
		);
		
		
		return false;
	});
	
	
	////////////FAQ ///////////////
	jQuery(".repeatable-add-faq").click(function() {
		field = jQuery(this).closest("div").find(".custom_repeatable li:last").clone(true);
		fieldLocation = jQuery(this).closest("div").find(".custom_repeatable li:last");
		jQuery("img", field).attr("src","");
		
		
		jQuery("input:not(:button)", field).val("").attr("name", function(index, name) {
			return name.replace(/[0-9]+(?!.*[0-9])/, function(fullMatch, n) {
				return parseInt(fullMatch, 10) + 1;
			});
		})
		
		jQuery("textarea.product_faq_tab_answer", field).val("").attr("name", function(index, name) {	
			return name.replace(/[0-9]+(?!.*[0-9])/,  function(fullMatch, n) {
				return parseInt(fullMatch, 10) + 1;
			});
		})
		
		textarea_name=jQuery(field).find("textarea").attr("name");
		var text_n=Math.floor((Math.random() * 10) + 1);
		
		jQuery.post(
			ajaxurl,
			{
				action : "insert_tinymce",
				id : "answer_"+text_n,
				name : textarea_name,
				class : "product_faq_tab_answer"
			},
			function(response){
				 jQuery(field).find("#target-div").replaceWith(response);
				 field.insertAfter(fieldLocation, jQuery(this).closest("div"));
			}
		);
		
		return false;
	});
	
	
	jQuery(".custom_clear_download_button").click(function() {
		jQuery(this).parent().find(".custom_upload_download").val("");
		jQuery(this).parent().find(".custom_download_name").html("<i class=\'fa fa-times\'></i>"+translate.no_file_uploaded);
		return false;
	});
	
	jQuery('.repeatable-remove-video').click(function(){
		if(jQuery(this).parent().parent().parent().children().length>1)
			jQuery(this).parent().parent().remove();
		else
			confirm('At least one element is required');	
		return false;
	});
	
	
	jQuery('.repeatable-remove-image').click(function(){
		if(jQuery(this).parent().parent().parent().children().length>1)
			jQuery(this).parent().parent().remove();
		else
			confirm('At least one element is required');	
		return false;
	});
	
	jQuery('.repeatable-remove-faq').click(function(){
		if(jQuery(this).parent().parent().parent().parent().children().length>1)
			jQuery(this).parent().parent().parent().remove();
		else
			confirm('At least one element is required');	
		return false;
	});
	
	jQuery('.repeatable-remove-download').click(function(){
		if(jQuery(this).parent().parent().parent().children().length>1)
			jQuery(this).parent().parent().remove();
		else
			confirm('At least one element is required');	
		return false;
	});
	
	
	jQuery('.custom_repeatable').sortable({
		opacity: 0.6,
		revert: true,
		cursor: 'move',
		handle: '.sort'
	});
	
});