var new_img = {
	check: function(obj_id){
		obj = $('#'+obj_id);
		if(obj.val()){
			switch(obj_id){
				case 'r_title':
					if(countUpperCase(obj.val()) > 50 && obj.val().length >= 5) new_img.show_error('#'+obj_id, 'El t&iacute;tulo contiene demasiadas letras may&uacute;sculas');
					else if(obj.val().length < 5) new_img.show_error('#'+obj_id, 'El t&iacute;tulo es demasiado corto (m&iacute;nimo 5 caracteres)');
					else if(obj.val().length > 65) new_img.show_error('#'+obj_id, 'El t&iacute;tulo es demasiado largo (m&aacute;ximo 65 caracteres)');
					else new_img.hide_error('#'+obj_id);
				break;
				case 'r_url':
					var regex=/^(ht|f)tps?:\/\/\w+([\.\-\w]+)?\.([a-z]{2,4}|travel)(:\d{2,5})?(\/.*)?$/i;
					if(!regex.test(obj.val())) new_img.show_error('#'+obj_id, 'La url ingresada no es v&aacute;lida');
					else if(!obj.val().match(/\.(jpeg|jpg|gif|png)$/i)) new_img.show_error('#'+obj_id, 'El formato debe ser .jpeg, .jpg, .gif o .png');
					else new_img.hide_error('#'+obj_id);
				break;	
			}
		}
	},
	show_error: function(obj, text){
		$(obj).addClass('error');
		$(obj).parent().children('#add_error').css('display','inline-block').children('.text').html(text);
	},
	hide_error: function(obj){
		$(obj).removeClass('error');
		$(obj).parent().children('#add_error').css('display','none').children('.text').html('');
	},
	add: function(){
		continued = true;
		$('.required').each(function(){
    		if(!$.trim($(this).val())){
    			new_img.show_error(this, 'Este campo es obligatorio');
    			continued = false;
    		}else new_img.hide_error(this);
		});
		new_img.check('r_title');
		new_img.check('r_url');
		$('#add_error .text').each(function(){
    		if($.trim($(this).text())){
    			continued = false;
    		}
		});
		if(continued == true){
			mydialog.loading('Agregando imagen...');
			var title = encodeURIComponent($('#r_title').val());
			var url = encodeURIComponent($('#r_url').val());
			var description = encodeURIComponent($('#r_description').val());
			if($('input[name=r_nocomments]').is(":checked")) var nocomments = 'si';
			else var nocomments = '';
			if($('input[name=r_follow]').is(":checked")) var follow = 'si';
			else var follow = '';
			$.ajax({
				type: 'POST',
				url: '/ajax/images/add',
				data: 'title=' + title + '&url=' + url + '&description=' + description + '&nocomments=' + nocomments + '&follow=' + follow,
				dataType: 'json',
				success: function(h){
					mydialog.end_loading();
					switch(h['status']){
						case 0:
							mydialog.alert('Error', h['data']);
						break;
						case 1:
							confirm = false;
							mydialog.alert('Imagen agregada', h['data']);
							mydialog.mask_close = false;
							mydialog.buttons(false);
							mydialog.center();
							if(h['link']) new_img.redirect($('#count_down_post_href'),h['link']);
						break;
					}
				},
				error: function(){
					mydialog.error_500("new_img.add()");
				}
			});
		}
	},
	save: function(){
		continued = true;
		$('.required').each(function(){
    		if(!$.trim($(this).val())){
    			new_img.show_error(this, 'Este campo es obligatorio');
    			continued = false;
    		}else new_img.hide_error(this);
		});
		new_img.check('r_title');
		new_img.check('r_url');
		$('#add_error .text').each(function(){
    		if($.trim($(this).text())){
    			continued = false;
    		}
		});
		if(continued == true){
			mydialog.loading('Guardando imagen...');
			var title = encodeURIComponent($('#r_title').val());
			var description = encodeURIComponent($('#r_description').val());
			if($('input[name=r_nocomments]').is(":checked")) var nocomments = 'si';
			else var nocomments = '';
			if($('input[name=r_follow]').is(":checked")) var follow = 'si';
			else var follow = '';
			var img_id = parseInt($('input[name=img_id]').val());
			$.ajax({
				type: 'POST',
				url: '/ajax/images/save',
				data: 'title=' + title + '&description=' + description + '&nocomments=' + nocomments + '&follow=' + follow + '&img_id=' + img_id,
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
							//if(h['link']) new_img.redirect($('#count_down_post_href'),h['link']);
						break;
					}
				},
				error: function(){
					mydialog.error_500('new_img.save()');
				}
			});
		}
	},
	redirect: function(obj, link){
		var number_act = obj.text();
		if(number_act == 0){
			location.href = link;
		}else{
			obj.text(number_act-1);
			setTimeout(function(){ new_imf.redirect(obj, link); }, 1000);
		}
	}
}