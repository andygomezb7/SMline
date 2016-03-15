$(document).ready(function(){
    $('a.to_follow').click(function() {
		$(this).children('img').attr('src', global_data.img+'/icons/loading.gif');
		to_follow($(this));
	});
	$('a.ok_follow').hover(function() {
		$(this).hide();
		$(this).parent().children('.un_follow').show();
	});
	$('a.un_follow').mouseleave(function() {
		if($(this).parent().children('.to_follow').css('display') == 'none'){
			$(this).parent().children('.ok_follow').show();;
			$(this).hide();
		}
	});
	$('a.un_follow').click(function() {
		un_follow($(this));
	});
	$('body').click(function(e){ 
		if($('#dialog-notifications').css('display') != 'none' && $(e.target).closest('#dialog-notifications').length == 0) notifica.last($('a.notis').parent());
		if($('#dialog-mps').css('display') != 'none' && $(e.target).closest('#dialog-mps').length == 0) mensaje.last($('a.mps').parent());
		if($('#dialog-umenu').css('display') != 'none' && $(e.target).closest('#dialog-umenu').length == 0 && $(e.target).closest('a.a-umenu').parent().length == 0) user.show_menu();
 
    });
});

function to_follow(obj){
	var f_type = obj.parent().attr('data-type');
	var f_type_id = obj.parent().attr('type-id');
	$.ajax({
		type: 'POST',
		url: '/ajax/'+f_type+'/follow',
		data: 'type_id=' + f_type_id,
		success: function(h){
			switch(h.charAt(0)){
				case '0':
					mydialog.alert('Opps!', h.substring(3));
				break;
				case '1':
					obj.hide();
					obj.parent().children('.ok_follow').show();
				break;
			}
		},
		complete: function(){
			obj.children('img').attr('src', global_data.img+'/icons/follow.png');
		}
	});
}

function un_follow(obj){
	var f_type = obj.parent().attr('data-type');
	var f_type_id = obj.parent().attr('type-id');
	$.ajax({
		type: 'POST',
		url: '/ajax/'+f_type+'/unfollow',
		data: 'type_id=' + f_type_id,
		success: function(h){
			switch(h.charAt(0)){
				case '0':
					mydialog.alert('Opps!', h.substring(3));
				break;
				case '1':
					obj.hide();
					obj.parent().children('.to_follow').show();
					obj.parent().children('.ok_follow').hide();
				break;
			}
		}
	});
}

var user = {
	cache: {},
	cerrar: function(obj){
		obj.css('background', 'url('+global_data.img+'/spinner.gif) no-repeat center');
		$.ajax({
			type: 'POST',
			url: '/ajax/user/cerrar',
			data: false,
			success: function(h){
				switch(h.charAt(0)){
					case '0':
						mydialog.alert('Opps!', h.substring(3));
					break;
					case '1':
						window.location.reload();
					break;
				}
			}
		});
	},
	new_report: function(type, title, author, tid){
		var report_body = '<center>';
		report_body += '<div class="form" id="error">T&iacute;tulo:<br /><b>'+title+'</b>';
		if(author) report_body += '<br /><br />Autor:<br /><b>'+author+'</b>';
		report_body += '<br /><br />Raz&oacute;n:<br><textarea class="inp_text" name="razon_desc" maxlength="200" placeholder="Ingresa la raz&oacute;n" style="width: 290px;"></textarea></div>';
		report_body += '</center>';
		mydialog.show();
		mydialog.title('Reportar '+type);
		mydialog.body(report_body);
		mydialog.buttons(true, 'Enviar reporte', 'Cancelar', 'user.send_report('+tid+', \''+type+'\')', 'close', true);
		mydialog.center();
	},
	send_report: function(tid, type){
		var reason = $('textarea[name=razon_desc]').val();
		$.ajax({
			type: 'POST',
			url: '/ajax/user/send_report',
			data: 'tid=' + parseInt(tid) + '&type=' + type + '&reason=' + reason,
			success: function(h){
				switch(h.charAt(0)){
					case '0':
						mydialog.alert('Opps!', h.substring(3));
					break;
					case '1':
						mydialog.alert('Listo!', h.substring(3));
					break;
				}
			}
		});
	},
	set_block: function(uid, unick, send){
		if(!send){
			mydialog.show();
			mydialog.title('Bloquear usuario');
			mydialog.body('<strong>'+unick+'</strong> no podr&aacute;:<br />&#8226; Enviarte mensajes<br />&#8226; Publicar estados en tu muro<br />&#8226; Comentar tus posts, temas, im&aacute;genes y estados.');
			mydialog.buttons(true, 'Bloquear', 'Cancelar', 'user.set_block('+uid+', \''+unick+'\', 1)', 'close', true);
			mydialog.center();
			return false;
		}
		$.ajax({
			type: 'POST',
			url: '/ajax/user/set_block',
			data: 'uid=' + parseInt(uid),
			success: function(h){
				switch(h.charAt(0)){
					case '0':
						mydialog.alert('Opps!', h.substring(3));
					break;
					case '1':
						$('#b-block-'+uid).html('Desbloquear').attr('onclick', 'user.set_unblock('+uid+', \''+unick+'\')');
						mydialog.alert('Listo!', h.substring(3));
					break;
				}
			}
		});
	},
	set_unblock: function(uid, unick, send){
		if(!send){
			mydialog.show();
			mydialog.title('Desbloquear usuario');
			mydialog.body('&iquest;Deseas desbloquear a <strong>'+unick+'</strong>?');
			mydialog.buttons(true, 'Desbloquear', 'Cancelar', 'user.set_unblock('+uid+', \''+unick+'\', 1)', 'close', true);
			mydialog.center();
			return false;
		}
		$.ajax({
			type: 'POST',
			url: '/ajax/user/set_unblock',
			data: 'uid=' + parseInt(uid),
			success: function(h){
				switch(h.charAt(0)){
					case '0':
						mydialog.alert('Opps!', h.substring(3));
					break;
					case '1':
						$('#b-user-'+uid).remove();
						$('#b-block-'+uid).html('Bloquear').attr('onclick', 'user.set_block('+uid+', \''+unick+'\')');
						mydialog.alert('Listo!', h.substring(3));
					break;
				}
			}
		});
	},
	show_menu: function(){
		if($('#dialog-umenu').css('display') != 'block'){
			mensaje.close();
			notifica.close();
			$('#dialog-umenu').fadeIn(300);
			$('#dialog-umenu').parent().addClass('active');
		}else{
			user.menu_close();
		}
	},
	menu_close: function(){
		$('#dialog-umenu').fadeOut(300);
		$('#dialog-umenu').parent().removeClass('active');
	}
}

var notifica = {
	cache: {},
	start: 1,
	last: function(obj){
		if($('#dialog-notifications').css('display') != 'block'){
			mensaje.close();
			user.menu_close();
			obj.css('background', 'url('+global_data.img+'/spinner.gif) no-repeat center');
			$.ajax({
				type: 'POST',
				url: '/ajax/user/notifica?tpl=1',
				data: false,
				success: function(h){
					obj.css('background', '');
					switch(h.charAt(0)){
						case '0':
							mydialog.alert('Opps!', h.substring(3));
						break;
						case '1':
							$('#dialog-notifications').show();
							$('#dialog-notifications').parent().addClass('active');
							$('#dialog-notifications #notifications-list').html(h.substring(3));
							
							var restar = $('#notifications-list li.activity-list.notview').length;
							
							var total_notis = global_data.nots;
							if(typeof new_total_notis == 'undefined') new_total_notis = parseInt(total_notis-restar);
							else new_total_notis = 0;
							//if(total_notis > 15 || global_data.mps > 0) $(document).attr('title', '('+parseInt(new_total_notis+global_data.mps)+') '+global_data.title);
							//else if(restar) $(document).attr('title', global_data.title);
							notifica.popup(new_total_notis);
							notifica.start = 1;
							if($('#notifications-list').height() >= 268){
								$('#dialog-notifications #notifications-list').slimScroll({
									height: '268px'
								});
							}
						break;
					}
				}
			});
		}else{
			notifica.close();
		}
	},
	view_more: function(obj){
		obj.css('opacity', '.3').html('Cargando...');
			$.ajax({
				type: 'POST',
				url: '/ajax/user/notifica?tpl=1',
				data: 'start=' + notifica.start,
				success: function(h){
					switch(h.charAt(0)){
						case '0':
							mydialog.alert('Opps!', h.substring(3));
							obj.css('opacity', '1').html('Cargar m&aacute;s');
						break;
						case '1':
							obj.remove();
							//$('.modal-dialog').show();
							$('#dialog-notifications').parent().addClass('active');
							$('#notifications-list').append(h.substring(3));
							
							var restar = $('li.activity-list.notview').length;
							
							var total_notis = global_data.nots;
							new_total_notis = parseInt(total_notis-restar);
							//if((total_notis > 15 && restar) || global_data.mps > 0) $(document).attr('title', '('+parseInt(new_total_notis+global_data.mps)+') '+global_data.title);
							//else if(restar) $(document).attr('title', global_data.title);

							notifica.popup(new_total_notis);
							notifica.start++;
						break;
					}
				}
			});
	},
	popup: function(r){
		var total_notis = $('#total_notis').text();
		if(r < 1) $('#total_notis').fadeOut(200);
		else if(r > total_notis) $('#total_notis').hide().fadeIn(200).text(r);
		$('#total_notis').text(r);
	},
	close: function(){
		$('#dialog-notifications').hide();
		$('#dialog-notifications').parent().removeClass('active');
	}
}

var mensaje = {
	cache: {},
	start: 1,
	last: function(obj){
		if($('#dialog-mps').css('display') != 'block'){
			notifica.close();
			user.menu_close();
			obj.css('background', 'url('+global_data.img+'/spinner.gif) no-repeat center');
			$.ajax({
				type: 'POST',
				url: '/ajax/user/mps?tpl=1',
				data: false,
				success: function(h){
					obj.css('background', '');
					switch(h.charAt(0)){
						case '0':
							mydialog.alert('Opps!', h.substring(3));
						break;
						case '1':
							$('#dialog-mps').show();
							$('#dialog-mps').parent().addClass('active');
							$('#dialog-mps #mps-list').html(h.substring(3));
							
							var restar = $('#dialog-mps .list-element-two.unread').length;
							
							var total_mps = global_data.mps;
							new_total_mps = parseInt(total_mps-restar);
							//if(total_mps > 8 || global_data.nots > 0) $(document).attr('title', '('+parseInt(new_total_mps+global_data.nots)+') '+global_data.title);
							//else if(restar) $(document).attr('title', global_data.title);
							if(restar == 0) mensaje.popup(0);
							else mensaje.popup(new_total_mps);
							mensaje.start = 1;
							if($('#mps-list').height() >= 268){
								$('#dialog-mps #mps-list').slimScroll({
									height: '268px'
								});
							}
						break;
					}
				}
			});
		}else{
			mensaje.close();
		}
	},
	view_more: function(obj){
		obj.css('opacity', '.3').html('Cargando...');
			$.ajax({
				type: 'POST',
				url: '/ajax/user/mps?tpl=1',
				data: 'start=' + mensaje.start,
				success: function(h){
					switch(h.charAt(0)){
						case '0':
							mydialog.alert('Opps!', h.substring(3));
							obj.css('opacity', '1').html('Cargar m&aacute;s');
						break;
						case '1':
							obj.remove();
							//$('#dialog-mps').show();
							$('#dialog-mps').parent().addClass('active');
							$('#dialog-mps #mps-list').append(h.substring(3));
							
							var restar = $('#dialog-mps .list-element-two.unread').length;
							
							var total_mps = global_data.mps;
							if(typeof new_total_mps == 'undefined') new_total_mps = parseInt(total_mps-restar);
							else new_total_mps = 0;
							//if(total_mps > 8 || global_data.nots > 0) $(document).attr('title', '('+parseInt(new_total_mps+global_data.nots)+') '+global_data.title);
							//else if(restar) $(document).attr('title', global_data.title);

							mensaje.popup(new_total_mps);
							mensaje.start++;
						break;
					}
				}
			});
	},
	popup: function(r){
		var total_notis = $('#total_mps').text();
		if(r < 1) $('#total_mps').fadeOut(200);
		else if(r > total_notis) $('#total_mps').hide().fadeIn(200).text(r);
		$('#total_mps').text(r);
	},
	close: function(){
		$('#dialog-mps').hide();
		$('#dialog-mps').parent().removeClass('active');
	}
}
