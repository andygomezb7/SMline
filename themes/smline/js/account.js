$(document).ready(function(){
	if(typeof location.href.split('#')[1] != 'undefined') {
		$('ul.tabs_links a.a-'+location.href.split('#')[1]).click();
	}
});

var account = {
	load_tab: function(tab){
		var main_obj = $('li.tab_'+tab);
		$('li.tab_link_core.active').removeClass('active');
		main_obj.addClass('active');
		$('.main-account').hide();
		$('#'+tab).slideDown('fast');
	},
	save_: function(type, obj){
		$('#'+type+' .item-info.ok').hide();
		obj.css('opacity', '.3').val('Guardando...');
		var params = '';
		$('#'+type+' input, #'+type+' select, #'+type+' textarea').each(function(){
			params += $(this).attr('name') + '=' + $(this).val() + '&';
		});
		if($('input[name=u_image_repeat]').is(':checked')) params += 'u_image_repeat=1'
		if($('input[name=c_close]').is(':checked')) params += 'c_close=1'
		if(type == 'my-notifications'){
			$('#'+type+' input[type=checkbox]').each(function(){
				check_val = $(this).is(':checked') ? 0 : 1;
				params += $(this).attr('name') + '=' + check_val + '&';
			});
		}
		$.ajax({
			type: 'POST',
			url: '/ajax/account/save',
			data: params + '&type=' + type,
			success: function(h){
				switch(h.charAt(0)){
					case '0':
						mydialog.alert('Error', h.substring(3));
					break;
					case '1':
						$('#'+type+' .item-info.ok').fadeIn(500);
					break;
				}
				obj.css('opacity', '1').val('Guardar cambios');
			}
		});
	},
	change_avatar: function(){
		mydialog.close_button = false;
		mydialog.mask_close = false;
		mydialog.show();
		mydialog.title('Cambiar avatar');
		mydialog.body('<div id="error" class="image-url-error" style="display:none"></div><span class="item-info"><img src="'+global_data.img+'/icons/info.png">Puedes importar un avatar desde una URL.<br />Asegurate que el formato termine en .gif, .png o .jpg</span><center><br /><b>Url de la imagen</b><br /><br /><input type="text" class="inp_text" name="new_avatar" value="" autocomplete="off" style="width:400px" placeholder="Pega aqu&iacute; la URL de la imagen"></center>');
		mydialog.buttons(true, 'Importar avatar', 'Cancelar', 'account.import_avatar();', 'close', true);
		mydialog.center();
		$('input[name=r_portada]').focus();
	},
	import_avatar: function(){
		var url = $('input[name=new_avatar]').val();
		var regex=/^(ht|f)tps?:\/\/\w+([\.\-\w]+)?\.([a-z]{2,4}|travel)(:\d{2,5})?(\/.*)?$/i;
		if(url == ''){
			$('input[name=new_avatar]').focus();
			return;
		}else if(!regex.test(url)){
			$('.image-url-error').show().html('La url ingresada no es v&aacute;lida');
			return;
		}else if(!url.match(/\.(jpeg|jpg|gif|png)/i)){
			$('.image-url-error').show().html('El formato debe ser .jpeg, .jpg, .gif o .png');
			return;
		}
		mydialog.loading('Importando avatar...');
			$.ajax({
				type: 'post',
				url: '/ajax/account/import_avatar',
				data: 'url=' + url,
				success: function(h){
					mydialog.end_loading();
					switch(h.charAt(0)){
						case '0':
							mydialog.alert('Error', h.substring(3));
						break;
						case '1':
							account.cut_avatar(url);
							$('input[name=img_url]').val(url);
							$('.thumbnail-preview').attr('src', url).css({'width':'auto','height':'auto'});
						break;
					}
				}
			});
	},
	cut_avatar: function(url){
		mydialog.show();
		mydialog.title('Cortar avatar');
		mydialog.body('<img src="'+url+'" id="thumbnail" class="thumbnail-cortar" />');
		mydialog.buttons(true, 'Cortar avatar', 'Cancelar', 'account.continue_cut();', 'mydialog.close();account.cancel_cut();', true);
		$('#thumbnail').load(function (){
			mydialog.center();
			$.getScript('http://code.jquery.com/ui/1.10.3/jquery-ui.js', function(){
				$('#dialog').draggable();
				$('#dialog #title').css('cursor','move');
			});
			cortar_thumb();
		}); 
	},
	continue_cut: function(){
		mydialog.loading('Cortando avatar...');
		$('.imgareaselect-outer, .imgareaselect-selection, .imgareaselect-border1, .imgareaselect-border2').remove();
		$('.imgareaselect-border3').parent().remove();
		var params = '';
		if($('.img-positions').length){
			$('.img-positions input').each(function(){
				var val = $(this).val();
				params += '&' + $(this).attr('name') + '=' + val;
			});
		}
			$.ajax({
				type: 'post',
				url: '/ajax/account/save_avatar',
				data: params,
				success: function(h){
					mydialog.end_loading();
					switch(h.charAt(0)){
						case '0':
							mydialog.alert('Error', h.substring(3));
						break;
						case '1':
							$('#profile_photo').attr('src', h.substring(3));
							mydialog.close();
						break;
					}
				}
			});
	},
	cancel_cut: function(){
		$('.thumbnail-preview').attr('src', '').removeAttr('style');
		$('input[name=img_url]').val('');
		$('.imgareaselect-outer, .imgareaselect-selection, .imgareaselect-border1, .imgareaselect-border2').remove();
		$('.imgareaselect-border3').parent().remove();
	}
}

function printimg(img, selection){
	//if(!$('.thumbnail-preview').attr('src') || $('.thumbnail-preview').attr('src') != $('#thumbnail').attr('src')) $('.thumbnail-preview').attr('src', $('#thumbnail').attr('src'));
	//var thumb_width = $('#thumbnail').width() > 700 ? 700 : $('#thumbnail').width();
	//var thumb_height = $('#thumbnail').height() > 700 ? 700 : $('#thumbnail').height();
	var scaleX = $('#thumbnail').width() / selection.width;
	var scaleY = $('#thumbnail').height() / selection.height;
	var rx = 154 / selection.width;
	var ry = 115 / selection.height;
	/*$('.thumbnail-preview').css({ 
		width: Math.round(scaleX * 154) + 'px', 
		height: Math.round(scaleY * 115) + 'px',
		marginLeft: '-' + Math.round(rx * selection.x1) + 'px', 
		marginTop: '-' + Math.round(ry * selection.y1) + 'px' 
	});*/
	$('input[name=thumb_x1]').val(selection.x1);
	$('input[name=thumb_y1]').val(selection.y1);
	$('input[name=thumb_x2]').val(selection.x2);
	$('input[name=thumb_y2]').val(selection.y2);
	$('input[name=thumb_w]').val(selection.width);
	$('input[name=thumb_h]').val(selection.height);
}

function cortar_thumb() { 
	$('#thumbnail').imgAreaSelect({show: true, x1: 0, y1: 0, x2 : 120, y2: 120, onSelectChange: printimg, minHeight: 120, minWidth: 120, outerOpacity: '0.3', handles: true});
	$('.imgareaselect-outer, .imgareaselect-selection, .imgareaselect-border1, .imgareaselect-border2').css('z-index', '130');
}