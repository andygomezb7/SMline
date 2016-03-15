$(document).ready(function(){
	$('#i_title').blur(function(){
		new_post.check('i_title');
	});
	$('#markItUp').blur(function(){
		new_post.check('markItUp');
	});
	$('#i_tags').blur(function(){
		new_post.check('i_tags');
	});
	$('.step ul li').click(function(){
		$('.step ul li').removeClass('active');
		$(this).addClass('active');
	});
	$('.thumb-select').click(function(){
		if($('.thumb-options').css('opacity') == '1'){
			$('.thumb-options').css({'opacity':'0','height':'0'});
			$(this).removeClass('active');
		}else{
			$('.thumb-options').css({'opacity':'1','height':'auto'});
			$(this).addClass('active');
		}
	});
	$('.thumb-options > *').click(function(){
		var clase = $(this).attr('class');
		switch(clase){
			case 'from-url':
				mydialog.close_button = false;
				mydialog.mask_close = false;
				mydialog.show();
				mydialog.title('Portada');
				mydialog.body('<div id="error" class="image-url-error" style="display:none">Powered by <a href="http://www.smartec.net">Smartec</a></div><b>Url de la imagen</b><br /><input type="text" id="i_portada" class="inp_text" name="r_portada" value="" autocomplete="off" style="width:400px">');
				mydialog.buttons(true, 'Importar imagen', 'Cancelar', 'new_post.importar_portada(0);', 'close', true);
				mydialog.center();
				$('input[name=r_portada]').focus();
			break;
			case 'from-post':
				mydialog.close_button = false;
				mydialog.mask_close = false;
				mydialog.loading('Importando im&aacute;genes...');
					$.ajax({
						type: 'post',
						url: '/ajax/posts/get_ports?tpl=1',
						data: 'body=' + encodeURIComponent($('#markItUp').val()),
						success: function(h){
							switch(h.charAt(0)){
								case '0':
									mydialog.alert('Error', h.substring(3));
								break;
								case '1':
									mydialog.end_loading();
									mydialog.close_button = false;
									mydialog.mask_close = false;
									mydialog.show();
									mydialog.title('Seleccionar portada');
									mydialog.body(h.substring(3));
									mydialog.buttons(true, false, 'Cancelar', 'close', 'close', true);
									mydialog.center();
								break;
							}
						},
						complete: function(){
							$('img.gets-ports').each(function(){
								$(this).load(function(){
									if($(this).height() <= 155){
										$(this).css('margin-top', 160/2-$(this).height()/2);
									}
								});
							});
						}
					});
			break;
		}
	});
	confirm = true;
	$('input, textarea').change(function(){
		confirm = false;
	});
});

window.onbeforeunload = confirmleave;
function confirmleave() {
	if (confirm == false && ($('input[name=r_title]').val() || $('textarea[name=r_body]').val())) return "Este post no fue publicado y se perdera.";
}

var new_post = {
	generate_tags: function(obj_2){
		if(obj_2 != ''){
			var reg = /^[\sa-zá-úñ]{3,30}$/i;
			var array_tags = obj_2.split(' ');
			array_tags.shuffle();
			var tags = '';
			for(var i = 0;i < array_tags.length;i++){
				if(reg.test(array_tags[i]) === true) tags += array_tags[i]+(array_tags.length == (i+1)?'':',');
			}
			$('#i_tags').val(tags);
		}
	},
	check: function(obj_id){
		obj = $('#'+obj_id);
		if(obj.val()){
			switch(obj_id){
				case 'i_title':
					if(countUpperCase(obj.val()) > 50 && obj.val().length >= 5) new_post.show_error('#'+obj_id, 'El t&iacute;tulo contiene demasiadas letras may&uacute;sculas');
					else if(obj.val().length < 5) new_post.show_error('#'+obj_id, 'El t&iacute;tulo es demasiado corto (m&iacute;nimo 5 caracteres)');
					else if(obj.val().length > 65) new_post.show_error('#'+obj_id, 'El t&iacute;tulo es demasiado largo (m&aacute;ximo 65 caracteres)');
					else new_post.hide_error('#'+obj_id);
				break;
				case 'markItUp':
					if(obj.val().length < 2) new_post.show_error('#'+obj_id, 'El contenido del post es muy corto');
					else if(obj.val().length > 100000) new_post.show_error('#'+obj_id, 'El contenido del post es muy largo (m&aacute;ximo 100.000 caracteres)');
					else new_post.hide_error('#'+obj_id);
				break;
				case 'i_tags':
					var tags = obj.val().split(',');
					if (tags.length < 4) {
						new_post.show_error('#'+obj_id, 'Tienes que ingresar por lo menos 4 tags separados por coma');
					}else{
						 for(var i = 0; i < tags.length; i++){
							 if(tags[i] == '') {
								 new_post.show_error('#'+obj_id, 'Tienes que ingresar por lo menos 4 tags separados por coma');
								 return;
							 }else new_post.hide_error('#'+obj_id);
						 }
					}
				break;
				case 'i_tags':
					var tags = obj.val().split(',');
					if (tags.length < 4) {
						new_post.show_error('#'+obj_id, 'Tienes que ingresar por lo menos 4 tags separados por coma');
					}else{
						 for(var i = 0; i < tags.length; i++){
							 if(tags[i] == '') {
								 new_post.show_error('#'+obj_id, 'Tienes que ingresar por lo menos 4 tags separados por coma');
								 return;
							 }else new_post.hide_error('#'+obj_id);
						 }
					}
				break;
				case 'i_cat':
					new_post.hide_error('#'+obj_id);
				break;
			}
		}
	},
	show_error: function(obj, text){
		$(obj).addClass('error');
		if($(obj).attr('id') == 'markItUp') obj = $(obj).parent().parent().parent();
		$(obj).parent().children('#add_error').css('display','inline-block').children('.text').html(text);
	},
	hide_error: function(obj){
		$(obj).removeClass('error');
		if($(obj).attr('id') == 'markItUp') obj = $(obj).parent().parent().parent();
		$(obj).parent().children('#add_error').css('display','none').children('.text').html('');
	},
	prev: function(save){
		var save = save == 1 ? '_save' : '';
		continued = true;
		$('.required').each(function(){
    		if(!$.trim($(this).val())){
    			new_post.show_error(this, 'Este campo es obligatorio');
    			continued = false;
    		}else new_post.hide_error(this);
		});
		new_post.check('i_title');
		new_post.check('markItUp');
		new_post.check('i_tags');
		new_post.check('i_cat');
		$('#add_error .text').each(function(){
    		if($.trim($(this).text())){
    			continued = false;
    		}
		});
		if(continued == true){
			mydialog.loading('Cargando vista previa...');
			$.ajax({
				type: 'post',
				url: '/ajax/posts/prev?tpl=1',
				data: 'body=' + encodeURIComponent($('#markItUp').val()),
				success: function(r){
					mydialog.body(r);
					mydialog.title($('#i_title').val());
					mydialog.buttons(true, (save?'Guardar cambios':'Agregar post'), 'Cerra previsualizaci&oacute;n', 'new_post.add'+save+'()', 'close', true);
					mydialog.center();
					$.scrollTo(0, 500)
				},
				error: function(){
					mydialog.error_500('new_post.prev('+save+')');
				}
			});
		}
	},
	add: function(){
		mydialog.close_button = true;
		mydialog.mask_close = true;
		mydialog.loading('Agregando post...');
		var title = encodeURIComponent($('#i_title').val());
		var body = encodeURIComponent($('#markItUp').val());
		var tags = encodeURIComponent($('#i_tags').val());
		var cat = $('#i_cat').val();
		if($('input[name=r_nocomments]').is(":checked")) var nocomments = 'si';
		else var nocomments = '';
		if($('input[name=r_follow]').is(":checked")) var follow = 'si';
		else var follow = '';
		if($('input[name=r_patro]').is(":checked")) var patro = 'si';
		else var patro = '';
		if($('input[name=r_sticky]').is(":checked")) var sticky = 'si';
		else var sticky = '';
		
		var recaptcha_response_field = encodeURIComponent($('#recaptcha_response_field').val());
		var recaptcha_challenge_field = encodeURIComponent($('#recaptcha_challenge_field').val());
		
		var params = '';
		if($('.img-positions').length){
			$('.img-positions input').each(function(){
				var val = $(this).val();
				params += '&' + $(this).attr('name') + '=' + val;
			});
		}
		$.ajax({
			type: 'POST',
			url: '/ajax/posts/add',
			data: 'title=' + title + '&body=' + body + '&tags=' + tags + '&cat=' + cat + '&nocomments=' + nocomments + '&follow=' + follow +  '&patro=' + patro + '&sticky=' + sticky + '&recaptcha_response_field=' + recaptcha_response_field + '&recaptcha_challenge_field=' + recaptcha_challenge_field + params,
			dataType: 'json',
			success: function(h){
				mydialog.end_loading();
				switch(h['status']){
					case 0:
						mydialog.alert('Error', h['data']);
					break;
					case 1:
						confirm = true;
						mydialog.alert('Post agregado', h['data']);
						mydialog.mask_close = false;
						mydialog.buttons(false);
						mydialog.center();
						//if(h['link']) new_post.redirect($('#count_down_post_href'),h['link']);
					break;
					case 2:
						mydialog.end_loading();
						mydialog.close_button = false;
						mydialog.mask_close = false;
						mydialog.show();
						mydialog.title('C&oacute;digo de seguridad');
						mydialog.body(h['data']);
						mydialog.buttons(true, 'Continuar', 'Cancelar', 'new_post.add();', 'close', true);
						mydialog.center();
						$.getScript("http://www.google.com/recaptcha/api/js/recaptcha_ajax.js", function(){
						Recaptcha.create('6LdHQvASAAAAAMvSKMC43DPFdr1fBTf3oKtPrUwq', 'recaptcha_ajax', {
								theme:'custom', lang:'es', custom_theme_widget: 'recaptcha_ajax',
								callback: function(){
									
								}
							});
						});
					break;
				}
			},
			error: function(){
				mydialog.error_500("new_post.add()");
			}
		});
	},
	add_save: function(){
		mydialog.close_button = true;
		mydialog.mask_close = true;
		mydialog.loading('Guardando cambios...');
		var pid = parseInt($('input[name=pid]').val());
		var title = encodeURIComponent($('#i_title').val());
		var body = encodeURIComponent($('#markItUp').val());
		var tags = encodeURIComponent($('#i_tags').val());
		var reason = encodeURIComponent($('#i_reason').val());
		var cat = $('#i_cat').val();
		if($('input[name=r_nocomments]').is(":checked")) var nocomments = 'si';
		else var nocomments = '';
		if($('input[name=r_follow]').is(":checked")) var follow = 'si';
		else var follow = '';
		if($('input[name=r_patro]').is(":checked")) var patro = 'si';
		else var patro = '';
		if($('input[name=r_sticky]').is(":checked")) var sticky = 'si';
		else var sticky = '';
		
		var recaptcha_response_field = encodeURIComponent($('#recaptcha_response_field').val());
		var recaptcha_challenge_field = encodeURIComponent($('#recaptcha_challenge_field').val());
		
		var params = '';
		if($('.img-positions').length){
			$('.img-positions input').each(function(){
				var val = $(this).val();
				params += '&' + $(this).attr('name') + '=' + val;
			});
		}
		$.ajax({
			type: 'POST',
			url: '/ajax/posts/save',
			data: 'pid=' + pid + '&title=' + title + '&body=' + body + '&tags=' + tags + '&reason=' + reason + '&cat=' + cat + '&nocomments=' + nocomments + '&follow=' + follow +  '&patro=' + patro + '&sticky=' + sticky + '&recaptcha_response_field=' + recaptcha_response_field + '&recaptcha_challenge_field=' + recaptcha_challenge_field + params,
			dataType: 'json',
			success: function(h){
				mydialog.end_loading();
				switch(h['status']){
					case 0:
						mydialog.alert('Error', h['data']);
					break;
					case 1:
						confirm = true;
						mydialog.alert('Post editado', h['data']);
						mydialog.mask_close = false;
						mydialog.buttons(false);
						mydialog.center();
						//if(h['link']) new_post.redirect($('#count_down_post_href'),h['link']);
					break;
					case 2:
						mydialog.end_loading();
						mydialog.close_button = false;
						mydialog.mask_close = false;
						mydialog.show();
						mydialog.title('C&oacute;digo de seguridad');
						mydialog.body(h['data']);
						mydialog.buttons(true, 'Continuar', 'Cancelar', 'new_post.add_save();', 'close', true);
						mydialog.center();
						$.getScript("http://www.google.com/recaptcha/api/js/recaptcha_ajax.js", function(){
						Recaptcha.create('6LdHQvASAAAAAMvSKMC43DPFdr1fBTf3oKtPrUwq', 'recaptcha_ajax', {
								theme:'custom', lang:'es', custom_theme_widget: 'recaptcha_ajax',
								callback: function(){
									
								}
							});
						});
					break;
				}
			},
			error: function(){
				mydialog.error_500("new_post.add_save()");
			}
		});
	},
	save_borrador: function(){
		$('.borrador_status').hide();
		var bid = parseInt($('input[name=bid]').val());
		var title = encodeURIComponent($('#i_title').val());
		var body = encodeURIComponent($('#markItUp').val());
		var tags = encodeURIComponent($('#i_tags').val());
		var reason = encodeURIComponent($('#i_reason').val());
		var cat = $('#i_cat').val();
		if($('input[name=r_nocomments]').is(":checked")) var nocomments = 'si';
		else var nocomments = '';
		if($('input[name=r_follow]').is(":checked")) var follow = 'si';
		else var follow = '';
		if($('input[name=r_patro]').is(":checked")) var patro = 'si';
		else var patro = '';
		if($('input[name=r_sticky]').is(":checked")) var sticky = 'si';
		else var sticky = '';
		
		$.ajax({
			type: 'POST',
			url: '/ajax/posts/save_borrador',
			data: 'bid=' + bid + '&title=' + title + '&body=' + body + '&tags=' + tags + '&cat=' + cat + '&nocomments=' + nocomments + '&follow=' + follow +  '&patro=' + patro + '&sticky=' + sticky,
			success: function(h){
				$('.borrador_status').show().html(h);
				confirm = true;
			},
			error: function(){
				mydialog.error_500("new_post.save_borrador()");
			}
		});
	},
	importar_portada: function(urli){
		var url = urli?urli:$('input[name=r_portada]').val();
		var regex=/^(ht|f)tps?:\/\/\w+([\.\-\w]+)?\.([a-z]{2,4}|travel)(:\d{2,5})?(\/.*)?$/i;
		if(url == '') return false;
		else if(!regex.test(url)){
			$('.image-url-error').show().html('La url ingresada no es v&aacute;lida');
			return false;
		}else if(!url.match(/\.(jpeg|jpg|gif|png)/i)){
			$('.image-url-error').show().html('El formato debe ser .jpeg, .jpg, .gif o .png');
			return false;
		}else{
			mydialog.loading('Importando imagen...');
			$('.image-url-error').hide();
			$.ajax({
				type: 'post',
				url: '/ajax/posts/img_port',
				data: 'url=' + url,
				success: function(h){
					mydialog.end_loading();
					switch(h.charAt(0)){
						case '0':
							$('.image-url-error').show().html(h.substring(3));
						break;
						case '1':
							new_post.portada_cortar(url);
							$('input[name=img_url]').val(url);
							$('.thumbnail-preview').attr('src', url).css({'width':'auto','height':'auto'});
						break;
					}
				}
			});
		}
	},
	portada_cortar: function(url){
		mydialog.show();
		mydialog.title('Cortar imagen');
		mydialog.body('<img src="'+url+'" id="thumbnail" class="thumbnail-cortar" />');
		mydialog.buttons(true, 'Cortar imagen', 'Cancelar', 'mydialog.close();cortar_portada();', 'mydialog.close();cancelar_portada();', true);
		$('#thumbnail').load(function (){
			mydialog.center();
			$.getScript('http://code.jquery.com/ui/1.10.3/jquery-ui.js', function(){
				$('#dialog').draggable();
				$('#dialog #title').css('cursor','move');
			});
			cortar_thumb();
		}); 
	},
	redirect: function(obj, link){
		var number_act = obj.text();
		if(number_act == 0){
			location.href = link;
		}else{
			obj.text(number_act-1);
			setTimeout(function(){ new_post.redirect(obj, link); }, 1000);
		}
	}
}

function cancelar_portada(){
	$('.thumbnail-preview').attr('src', '').removeAttr('style');
	$('input[name=img_url]').val('');
	$('.imgareaselect-outer, .imgareaselect-selection, .imgareaselect-border1, .imgareaselect-border2').remove();
	$('.imgareaselect-border3').parent().remove();
}

function cortar_portada(){
	$('.imgareaselect-outer, .imgareaselect-selection, .imgareaselect-border1, .imgareaselect-border2').remove();
	$('.imgareaselect-border3').parent().remove();
}

function printimg(img, selection){
	if(!$('.thumbnail-preview').attr('src') || $('.thumbnail-preview').attr('src') != $('#thumbnail').attr('src')) $('.thumbnail-preview').attr('src', $('#thumbnail').attr('src'));
	var scaleX = $('#thumbnail').width() / selection.width;
	var scaleY = $('#thumbnail').height() / selection.height;
	var rx = 154 / selection.width;
	var ry = 115 / selection.height;
	$('.thumbnail-preview').css({ 
		width: Math.round(scaleX * 154) + 'px', 
		height: Math.round(scaleY * 115) + 'px',
		marginLeft: '-' + Math.round(rx * selection.x1) + 'px', 
		marginTop: '-' + Math.round(ry * selection.y1) + 'px' 
	});
	$('input[name=thumb_x1]').val(selection.x1);
	$('input[name=thumb_y1]').val(selection.y1);
	$('input[name=thumb_x2]').val(selection.x2);
	$('input[name=thumb_y2]').val(selection.y2);
	$('input[name=thumb_w]').val(selection.width);
	$('input[name=thumb_h]').val(selection.height);
}

function cortar_thumb() { 
	$('#thumbnail').imgAreaSelect({show: true, x1: 0, y1: 0, x2 : 154, y2: 115, onSelectChange: printimg, minHeight: 115, minWidth: 154, outerOpacity: '0.3', handles: true});
	$('.imgareaselect-outer, .imgareaselect-selection, .imgareaselect-border1, .imgareaselect-border2').css('z-index', '130');
}