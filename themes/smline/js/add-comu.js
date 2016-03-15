$(document).ready(function(){
	$('a.import-image').click(function(){
		mydialog.close_button = false;
		mydialog.mask_close = false;
		mydialog.show();
		mydialog.title('Imagen');
		mydialog.body('<div id="error" class="image-url-error" style="display:none"></div><span class="item-info"><img src="'+global_data.img+'/icons/info.png">Puedes importar una imagen desde una URL.<br />Asegurate que el formato termine en .gif, .png o .jpg</span><center><br /><b>Url de la imagen</b><br /><br /><input type="text" class="inp_text" name="comu_image" value="" autocomplete="off" style="width:400px" placeholder="Pega aqu&iacute; la URL de la imagen"></center>');
		mydialog.buttons(true, 'Importar imagen', 'Cancelar', 'new_comu.import_image();', 'close', true);
		mydialog.center();
		$('input[name=r_portada]').focus();
	});
	 $('input[name=comu_seo]').click(function(){
		new_comu.generate_seo();
	 });
});

var new_comu = {
	generate_seo: function(){
		var comu_name = $('input[name=comu_name]').val();
		$.ajax({
			type: 'POST',
			url: '/ajax/comus/get_seo',
			data: 'comu_name=' + comu_name,
			success: function(h){
				$('input[name=comu_seo]').val(h);
			}
		});
	},
	create: function(){
		mydialog.close_button = true;
		mydialog.mask_close = true;
		mydialog.loading('Creando comunidad...');
		var p_postear = $('input[name=p_postear]').is(':checked') ? 1 : 0;
		var p_comentar = $('input[name=p_comentar]').is(':checked') ? 1 : 0;
		var params = '';
		if($('.img-positions').length){
			$('.img-positions input, .post-create input.inp_text, .post-create select.inp_text, .post-create textarea.inp_text').each(function(){
				var val = encodeURIComponent($(this).val());
				params += '&' + $(this).attr('name') + '=' + val;
			});
		}
		$.ajax({
			type: 'POST',
			url: '/ajax/comus/create',
			data: 'p_postear=' + p_postear + '&p_comentar=' + p_comentar + params,
			dataType: 'json',
			success: function(h){
				mydialog.end_loading();
				switch(h['status']){
					case 0:
						mydialog.alert('Error', h['data']);
					break;
					case 1:
						confirm = false;
						mydialog.alert('Comunidad creada', h['data']);
						mydialog.mask_close = false;
						mydialog.buttons(false);
						mydialog.center();
					break;
				}
			},
			error: function(){
				mydialog.error_500('new_comu.create()');
			}
		});
	},
	add_save: function(){
		mydialog.close_button = true;
		mydialog.mask_close = true;
		mydialog.loading('Aplicando cambios...');
		var p_postear = $('input[name=p_postear]').is(':checked') ? 1 : 0;
		var p_comentar = $('input[name=p_comentar]').is(':checked') ? 1 : 0;
		var comu_image_repeat = $('input[name=comu_image_repeat]').is(':checked') ? 1 : 0;
		var params = '';
		if($('.img-positions').length){
			$('.img-positions input, .post-create input.inp_text, .post-create select.inp_text, .post-create textarea.inp_text').each(function(){
				var val = encodeURIComponent($(this).val());
				params += '&' + $(this).attr('name') + '=' + val;
			});
		}
		$.ajax({
			type: 'POST',
			url: '/ajax/comus/save',
			data: 'p_postear=' + p_postear + '&p_comentar=' + p_comentar + '&comu_image_repeat=' + comu_image_repeat + params,
			dataType: 'json',
			success: function(h){
				mydialog.end_loading();
				switch(h['status']){
					case 0:
						mydialog.alert('Error', h['data']);
					break;
					case 1:
						confirm = false;
						mydialog.alert('Listo!', h['data']);
						mydialog.mask_close = false;
						mydialog.buttons(false);
						mydialog.center();
					break;
				}
			},
			error: function(){
				mydialog.error_500('new_comu.add_save()');
			}
		});
	},
	import_image: function(urli){
		var url = urli?urli:$('input[name=comu_image]').val();
		var regex=/^(ht|f)tps?:\/\/\w+([\.\-\w]+)?\.([a-z]{2,4}|travel)(:\d{2,5})?(\/.*)?$/i;
		if(url == ''){
			$('input[name=comu_image]').focus();
			return;
		}else if(!regex.test(url)){
			$('.image-url-error').show().html('La url ingresada no es v&aacute;lida');
			return;
		}else if(!url.match(/\.(jpeg|jpg|gif|png)/i)){
			$('.image-url-error').show().html('El formato debe ser .jpeg, .jpg, .gif o .png');
			return;
		}
			mydialog.loading('Importando imagen...');
			$('.image-url-error').hide();
			$.ajax({
				type: 'post',
				url: '/ajax/comus/img_port',
				data: 'url=' + url,
				success: function(h){
					mydialog.end_loading();
					switch(h.charAt(0)){
						case '0':
							$('.image-url-error').show().html(h.substring(3));
						break;
						case '1':
							new_comu.image_cut(url);
							$('input[name=img_url]').val(url);
							$('.thumbnail-preview').attr('src', url).css({'width':'auto','height':'auto'});
						break;
					}
				}
			});
		
	},
	image_cut: function(url){
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
	var rx = 120 / selection.width;
	var ry = 120 / selection.height;
	$('.thumbnail-preview').css({ 
		width: Math.round(scaleX * 120) + 'px', 
		height: Math.round(scaleY * 120) + 'px',
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
	$('#thumbnail').imgAreaSelect({show: true, x1: 0, y1: 0, x2 : 120, y2: 120, onSelectChange: printimg, minHeight: 120, minWidth: 120, outerOpacity: '0.3', handles: true});
	$('.imgareaselect-outer, .imgareaselect-selection, .imgareaselect-border1, .imgareaselect-border2').css('z-index', '130');
}