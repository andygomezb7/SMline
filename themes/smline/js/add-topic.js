$(document).ready(function(){
	$('#i_title').blur(function(){
		new_topic.check('i_title');
	});
	$('#markItUp').blur(function(){
		new_topic.check('markItUp');
	});
});

var new_topic = {
	check: function(obj_id){
		obj = $('#'+obj_id);
		if(obj.val()){
			switch(obj_id){
				case 'i_title':
					if(countUpperCase(obj.val()) > 50 && obj.val().length >= 5) new_topic.show_error('#'+obj_id, 'El t&iacute;tulo contiene demasiadas letras may&uacute;sculas');
					else if(obj.val().length < 5) new_topic.show_error('#'+obj_id, 'El t&iacute;tulo es demasiado corto (m&iacute;nimo 5 caracteres)');
					else if(obj.val().length > 65) new_topic.show_error('#'+obj_id, 'El t&iacute;tulo es demasiado largo (m&aacute;ximo 65 caracteres)');
					else new_topic.hide_error('#'+obj_id);
				break;
				case 'markItUp':
					if(obj.val().length < 2) new_topic.show_error('#'+obj_id, 'El contenido del tema es muy corto');
					else if(obj.val().length > 100000) new_topic.show_error('#'+obj_id, 'El contenido del tema es muy largo (m&aacute;ximo 100.000 caracteres)');
					else new_topic.hide_error('#'+obj_id);
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
    			new_topic.show_error(this, 'Este campo es obligatorio');
    			continued = false;
    		}else new_topic.hide_error(this);
		});
		new_topic.check('i_title');
		new_topic.check('markItUp');
		new_topic.check('i_tags');
		new_topic.check('i_cat');
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
					mydialog.buttons(true, (save?'Guardar cambios':'Agregar tema'), 'Cerra previsualizaci&oacute;n', 'new_topic.add'+save+'()', 'close', true);
					mydialog.center();
					$.scrollTo(0, 500)
				},
				error: function(){
					mydialog.error_500('new_topic.prev('+save+')');
				}
			});
		}
	},
	add: function(){
		mydialog.close_button = true;
		mydialog.mask_close = true;
		mydialog.loading('Agregando tema...');
		var title = encodeURIComponent($('#i_title').val());
		var body = encodeURIComponent($('#markItUp').val());
		if($('input[name=r_nocomments]').is(":checked")) var nocomments = 'si';
		else var nocomments = '';
		if($('input[name=r_follow]').is(":checked")) var follow = 'si';
		else var follow = '';
		if($('input[name=r_sticky]').is(":checked")) var sticky = 'si';
		else var sticky = '';
		var comu_id = parseInt($('input[name=comu_id]').val());
		$.ajax({
			type: 'POST',
			url: '/ajax/comus/add-topic',
			data: 'title=' + title + '&body=' + body + '&nocomments=' + nocomments + '&follow=' + follow +  '&sticky=' + sticky + '&comu_id=' + comu_id,
			dataType: 'json',
			success: function(h){
				mydialog.end_loading();
				switch(h['status']){
					case 0:
						mydialog.alert('Error', h['data']);
					break;
					case 1:
						confirm = false;
						mydialog.alert('Temas agregado', h['data']);
						mydialog.mask_close = false;
						mydialog.buttons(false);
						mydialog.center();
						//if(h['link']) new_topic.redirect($('#count_down_post_href'),h['link']);
					break;
				}
			},
			error: function(){
				mydialog.error_500("new_topic.add()");
			}
		});
	},
	add_save: function(){
		mydialog.close_button = true;
		mydialog.mask_close = true;
		mydialog.loading('Aplicando cambios...');
		var title = encodeURIComponent($('#i_title').val());
		var body = encodeURIComponent($('#markItUp').val());
		var reason = encodeURIComponent($('#i_reason').val());
		var tid = parseInt($('#tema-id').val());
		if($('input[name=r_nocomments]').is(":checked")) var nocomments = 'si';
		else var nocomments = '';
		if($('input[name=r_follow]').is(":checked")) var follow = 'si';
		else var follow = '';
		if($('input[name=r_sticky]').is(":checked")) var sticky = 'si';
		else var sticky = '';
		var comu_id = parseInt($('input[name=comu_id]').val());
		$.ajax({
			type: 'POST',
			url: '/ajax/comus/save-topic',
			data: 'title=' + title + '&body=' + body + '&nocomments=' + nocomments + '&follow=' + follow +  '&sticky=' + sticky + '&comu_id=' + comu_id + '&tid=' + tid + '&reason=' + reason,
			dataType: 'json',
			success: function(h){
				mydialog.end_loading();
				switch(h['status']){
					case 0:
						mydialog.alert('Error', h['data']);
					break;
					case 1:
						confirm = false;
						mydialog.alert('Temas editado', h['data']);
						mydialog.mask_close = false;
						mydialog.buttons(false);
						mydialog.center();
						//if(h['link']) new_topic.redirect($('#count_down_post_href'),h['link']);
					break;
				}
			},
			error: function(){
				mydialog.error_500("new_topic.add_save()");
			}
		});
	},
	redirect: function(obj, link){
		var number_act = obj.text();
		if(number_act == 0){
			location.href = link;
		}else{
			obj.text(number_act-1);
			setTimeout(function(){ new_topic.redirect(obj, link); }, 1000);
		}
	}
}