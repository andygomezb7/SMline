$(document).ready(function(){
	$('#mp_body').markItUp(mySettings);
	$('span.ui-checkbox').click(function(){
		if($(this).hasClass('checked')) $(this).removeClass('checked');
		else $(this).addClass('checked');
	});
});

var mps = {
	send: function(obj){
		obj.css('opacity', '.3').val('Enviando...');
		$('.newmp_error').hide();
		var params = $('.write_mp input[name], .write_mp textarea[name]');
		$.ajax({
			type: 'POST',
			url: '/ajax/mps/send',
			data: $.param(params),
			success: function(h){
				switch(h.charAt(0)){
					case '0':
						obj.css('opacity', '1').val('Enviar mensaje');
						$('.newmp_error').show().html(h.substring(3));
						Recaptcha.reload();
					break;
					case '1':
						location.href = '/mensajes?ok_act=send';
					break;
				}
			}
		});
	},
	send_replie: function(obj){
		obj.css('opacity', '.3').val('Enviando...');
		var mp_body = $('textarea[name=mp_body]').val();
		var mp_id = $('input[name=mp_id]').val();
		$.ajax({
			type: 'POST',
			url: '/ajax/mps/send_replie?tpl=1',
			data: 'mp_id=' + mp_id + '&mp_body=' + mp_body,
			success: function(h){
				obj.css('opacity', '1').val('Enviar mensaje');
				switch(h.charAt(0)){
					case '0':
						mydialog.alert('Error', h.substring(3));
					break;
					case '1':
						$('.rps-list').append(h.substring(3));
						$('textarea[name=mp_body]').val('');
					break;
				}
			}
		});
	},
	del: function(mp_id, okay, del_type){
		if(!del_type) var del_type = 0;
		if(!okay){
			if(del_type != 0){
				mydialog.show();
				mydialog.title('Eliminar conversaci&oacute;n');
				mydialog.body('&iquest;Deseas eliminar por completo esta conversaci&oacute;n?');
				mydialog.buttons(true, 'Eliminar', 'Cancelar', 'mps.del('+mp_id+', true, 1);mydialog.close();', 'close', true);
				mydialog.center();
				return;
			}else{
				mydialog.show();
				mydialog.title('Eliminar conversaci&oacute;n');
				mydialog.body('&iquest;Deseas eliminar esta conversaci&oacute;n?');
				mydialog.buttons(true, 'Eliminar', 'Cancelar', 'mps.del('+mp_id+', true);mydialog.close();', 'close', true);
				mydialog.center();
				return;
			}
		}
		// ELSE
		$.ajax({
			type: 'POST',
			url: '/ajax/mps/del',
			data: 'mp_id=' + mp_id + '&del_type=' + del_type,
			success: function(h){
				switch(h.charAt(0)){
					case '0':
						mydialog.alert('Error', h.substring(3));
					break;
					case '1':
						if(del_type != 0) location.href = '/mensajes?ok_act=del';
						else location.href = '/mensajes/eliminados?ok_act=del';
					break;
				}
			}
		});
	},
	res: function(mp_id){
		$.ajax({
			type: 'POST',
			url: '/ajax/mps/restaurar',
			data: 'mp_id=' + mp_id,
			success: function(h){
				switch(h.charAt(0)){
					case '0':
						mydialog.alert('Error', h.substring(3));
					break;
					case '1':
						mydialog.alert('Listo!', h.substring(3));
						mydialog.buttons(true, 'Ver cambios', 'Cerrar', 'location.reload();', 'close', true);
					break;
				}
			}
		});
	},
	select: function(type){
		switch(type){
			case '1':
				$('span.ui-checkbox').each(function(){
					$(this).addClass('checked');
				});
			break;
			case '2':
				$('span.ui-checkbox').each(function(){
					$(this).removeClass('checked');
				});
			break;
			case '3':
				$('span.ui-checkbox').each(function(){
					var mp_read = $(this).attr('mp-read');
					if(mp_read == 0) $(this).removeClass('checked');
					else $(this).addClass('checked');
				});
			break;
			case '4':
				$('span.ui-checkbox').each(function(){
					var mp_read = $(this).attr('mp-read');
					if(mp_read == 0) $(this).addClass('checked');
					else $(this).removeClass('checked');
				});
			break;
		}
	},
	checked_actions: function(type){
		var mps_vals = '';
		$('span.ui-checkbox.checked').each(function(){
			var mp_id = $(this).attr('mp-id');
			
			switch(type){
				// MARCAR COMO LEIDO
				case '1':
					$.ajax({
						type: 'POST',
						url: '/ajax/mps/is_read',
						data: 'mp_id=' + mp_id,
						success: function(h){
							switch(h.charAt(0)){
								case '0':
									mydialog.alert('Error', h.substring(3));
									return;
								break;
								case '1':
									if(!$('#mp-id-'+mp_id).hasClass('open')) $('#mp-id-'+mp_id).addClass('open');
								break;
							}
						}
					});
				break;
				// MARCAR COMO NO LEIDO
				case '2':
					$.ajax({
						type: 'POST',
						url: '/ajax/mps/is_noread',
						data: 'mp_id=' + mp_id,
						success: function(h){
							switch(h.charAt(0)){
								case '0':
									mydialog.alert('Error', h.substring(3));
									return;
								break;
								case '1':
									if($('#mp-id-'+mp_id).hasClass('open')) $('#mp-id-'+mp_id).removeClass('open');
								break;
							}
						}
					});
				break;
				// ELIMIAR
				case '3':
					$.ajax({
						type: 'POST',
						url: '/ajax/mps/del',
						data: 'mp_id=' + mp_id + '&del_type=0',
						success: function(h){
							switch(h.charAt(0)){
								case '0':
									mydialog.alert('Error', h.substring(3));
								break;
								case '1':
									$('#mp-id-'+mp_id).css('opacity', '0.3');
								break;
							}
						}
					});
				break;
			}
		});
	}
}