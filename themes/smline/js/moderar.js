var mod = {
	del: function(type, objid, ok){
		if(!ok){
			switch(type){
				case 'posts':
					var title_complement = 'post';
				break;
				case 'images':
					var title_complement = 'imagen';
				break;
				case 'topics':
					var title_complement = 'tema';
				break;
			}
			$.ajax({
				type: 'POST',
				url: '/ajax/'+type+'/mod_delete?tpl=1',
				data: 'objid=' + parseInt(objid),
				success: function(h){
					switch(h.charAt(0)){
						case '0':
							mydialog.alert('Error', h.substring(3));
						break;
						case '1':
							mydialog.show();
							mydialog.title('Borrar '+title_complement);
							mydialog.body(h.substring(3));
							mydialog.buttons(true, 'Borrar', 'Cancelar', "mod.del('"+type+"', "+objid+", 1)", 'close', true);
							mydialog.center();
						break;
					}
				}
			});
		}else{
			var reason = $('input[name=razon_desc]').val() ? $('input[name=razon_desc]').val() : $('select[name=reason]').val();
			var save_borrador = $('select[name=save_borrador]').val();
			$.ajax({
				type: 'POST',
				url: '/ajax/'+type+'/mod_delete',
				data: 'objid=' + parseInt(objid) + '&reason=' + reason + '&save_borrador=' + save_borrador,
				success: function(h){
					switch(h.charAt(0)){
						case '0':
							mydialog.alert('Error', h.substring(3));
						break;
						case '1':
							mydialog.alert('Listo!', h.substring(3));
						break;
					}
				}
			});
		}
	},
	reac: function(type, objid, ok){
		switch(type){
			case 'posts':
				var title_complement = 'post';
				var body_complement = 'este post';
			break;
			case 'images':
				var title_complement = 'imagen';
				var body_complement = 'esta imagen';
			break;
			case 'topics':
				var title_complement = 'tema';
				var body_complement = 'este tema';
			break;
		}
		if(!ok){
				mydialog.show();
				mydialog.title('Reactivar '+title_complement);
				mydialog.body('&iquest;Quieres hacer visible de nuevo '+body_complement+'?');
				mydialog.buttons(true, 'SI', 'NO', "mod.reac('"+type+"', "+objid+", 1)", 'close', true);
				mydialog.center();
				return;
		}
		mydialog.loading('Reactivando...');
		$.ajax({
			type: 'POST',
			url: '/ajax/'+type+'/mod_reac',
			data: 'objid=' + parseInt(objid),
			success: function(h){
				mydialog.end_loading();
				switch(h.charAt(0)){
					case '0':
						mydialog.alert('Error', h.substring(3));
					break;
					case '1':
						mydialog.alert('Listo!', h.substring(3));
					break;
				}
				
			}
		});
	},
	revise: function(type, objid, ok){
		switch(type){
			case 'posts':
				var title_complement = 'post';
				var body_complement = 'este post';
			break;
		}
		if(!ok){
				mydialog.show();
				mydialog.title('Ocultar '+title_complement);
				mydialog.body('<label>Raz&oacute;n para mandar a revisi&oacute;n '+body_complement+':</label><br /><br /><input type="text" class="inp_text" name="razon_desc" maxlength="150" placeholder="Especifica la razón" style="width: 290px;">');
				mydialog.buttons(true, 'Continuar', 'Cancelar', "mod.revise('"+type+"', "+objid+", 1)", 'close', true);
				mydialog.center();
				$('input[name=razon_desc]').focus();
				return;
		}
		mydialog.loading('Procesando...');
		var reason = $('input[name=razon_desc]').val();
		$.ajax({
			type: 'POST',
			url: '/ajax/'+type+'/mod_revise',
			data: 'objid=' + parseInt(objid) + '&reason=' + reason,
			success: function(h){
				mydialog.end_loading();
				switch(h.charAt(0)){
					case '0':
						mydialog.alert('Error', h.substring(3));
					break;
					case '1':
						mydialog.alert('Listo!', h.substring(3));
					break;
				}
				
			}
		});
	},
	approve: function(type, objid, ok){
		switch(type){
			case 'posts':
				var title_complement = 'post';
				var body_complement = 'este post';
			break;
		}
		if(!ok){
				mydialog.show();
				mydialog.title('Aprobar '+title_complement);
				mydialog.body('Al aprobar el post, se har&aacute; visible para todos los usuarios y visitantes del sitio');
				mydialog.buttons(true, 'Continuar', 'Cancelar', "mod.approve('"+type+"', "+objid+", 1)", 'close', true);
				mydialog.center();
				return;
		}
		mydialog.loading('Aprobando...');
		$.ajax({
			type: 'POST',
			url: '/ajax/'+type+'/mod_approve',
			data: 'objid=' + parseInt(objid),
			success: function(h){
				mydialog.end_loading();
				switch(h.charAt(0)){
					case '0':
						mydialog.alert('Error', h.substring(3));
					break;
					case '1':
						mydialog.alert('Listo!', h.substring(3));
					break;
				}
				
			}
		});
	},
	add_sticky: function(type, objid, ok){
		switch(type){
			case 'posts':
				var title_complement = 'post';
				var body_complement = 'este post';
			break;
			case 'topics':
				var title_complement = 'tema';
				var body_complement = 'este tema';
			break;
		}
		if(!ok){
				mydialog.show();
				mydialog.title('Fijar '+title_complement);
				mydialog.body('&iquest;Quieres fijar '+body_complement+' en la home?');
				mydialog.buttons(true, 'Continuar', 'Cancelar', "mod.add_sticky('"+type+"', "+objid+", 1)", 'close', true);
				mydialog.center();
				return;
		}
		mydialog.loading('Fijando...');
		$.ajax({
			type: 'POST',
			url: '/ajax/'+type+'/mod_add_sticky',
			data: 'objid=' + parseInt(objid),
			success: function(h){
				mydialog.end_loading();
				switch(h.charAt(0)){
					case '0':
						mydialog.alert('Error', h.substring(3));
					break;
					case '1':
						mydialog.alert('Listo!', h.substring(3));
					break;
				}
				
			}
		});
	},
	remove_sticky: function(type, objid, ok){
		switch(type){
			case 'posts':
				var title_complement = 'post';
				var body_complement = 'este post';
			break;
			case 'topics':
				var title_complement = 'tema';
				var body_complement = 'este tema';
			break;
		}
		if(!ok){
				mydialog.show();
				mydialog.title('Fijar '+title_complement);
				mydialog.body('&iquest;Quieres desfijar '+body_complement+'?');
				mydialog.buttons(true, 'Continuar', 'Cancelar', "mod.remove_sticky('"+type+"', "+objid+", 1)", 'close', true);
				mydialog.center();
				return;
		}
		mydialog.loading('Desfijando...');
		$.ajax({
			type: 'POST',
			url: '/ajax/'+type+'/mod_remove_sticky',
			data: 'objid=' + parseInt(objid),
			success: function(h){
				mydialog.end_loading();
				switch(h.charAt(0)){
					case '0':
						mydialog.alert('Error', h.substring(3));
					break;
					case '1':
						mydialog.alert('Listo!', h.substring(3));
					break;
				}
				
			}
		});
	},
	banned: function(uid, okay){
		if(!okay){
			var ajax_url = '/ajax/user/ban?tpl=1';
			var ajax_data = 'uid=' + parseInt(uid);
		}else{
			var ajax_url = '/ajax/user/ban';
			var duration = $('select[name=duration]').val();
			var total_val = duration == 1 ? $('.duration_type_1 input[name=total_val]').val() : $('.duration_type_2 input[name=total_val]').val();
			var razon_desc = $('textarea[name=razon_desc]').val();
			var ajax_data = 'uid=' + parseInt(uid) + '&duration=' + duration + '&total_val=' + total_val + '&razon_desc=' + razon_desc;
			if(!razon_desc){
				$('textarea[name=razon_desc]').focus();
				return;
			}
		}
		$.ajax({
			type: 'POST',
			url: ajax_url,
			data: ajax_data,
			success: function(h){
				switch(h.charAt(0)){
					case '0':
						mydialog.alert('Error', h.substring(3));
					break;
					case '1':
						mydialog.show();
						if(!okay){
							mydialog.title('Suspender usuario');
							mydialog.body(h.substring(3));
							mydialog.buttons(true, 'Suspender', 'Cancelar', 'mod.banned('+uid+', 1)', 'close', true);
						}else{
							mydialog.title('Listo!');
							mydialog.body(h.substring(3));
							mydialog.buttons(true, false, 'Ok', false, 'close', false);
						}
						mydialog.center();
					break;
				}
			}
		});
	},
	unbanned: function(uid, nick, okay){
		if(!okay){
			mydialog.show();
			mydialog.title('Reactivar usuario');
			mydialog.body(nick+' podr&aacute; estar activo en la web de nuevo');
			mydialog.buttons(true, 'Continuar', 'Cancelar', 'mod.unbanned('+uid+', \''+nick+'\', 1)', 'close', true);
			mydialog.center();
			return;
		}
		$.ajax({
			type: 'POST',
			url: '/ajax/user/unban',
			data: 'uid=' + parseInt(uid),
			success: function(h){
				mydialog.end_loading();
				switch(h.charAt(0)){
					case '0':
						mydialog.alert('Error', h.substring(3));
					break;
					case '1':
						mydialog.show();
						mydialog.title('Listo!');
						mydialog.body(h.substring(3));
						mydialog.buttons(true, false, 'Ok', false, 'close', false);
						mydialog.center();
					break;
				}
			}
		});
	},
	reports: {
		del: function(r_id){
			$.ajax({
				type: 'POST',
				url: '/ajax/mod/del_report',
				data: 'r_id=' + parseInt(r_id),
				success: function(h){
					switch(h.charAt(0)){
						case '0':
							mydialog.alert('Error', h.substring(3));
						break;
						case '1':
							$('#report-'+r_id).css('opacity', '0.3');
						break;
					}
				}
			});
		}
	},
	comus: {
		ban: function(comu_id){
			$.ajax({
				type: 'POST',
				url: '/ajax/comus/ban',
				data: 'comu_id=' + comu_id,
				success: function(h){
					switch(h.charAt(0)){
						case '0':
							mydialog.alert('Error', h.substring(3));
							break;
						case '1':
							mydialog.alert('Listo!', h.substring(3));
						break;
					}
				}
			});
		},
		unban: function(comu_id){
			$.ajax({
				type: 'POST',
				url: '/ajax/comus/unban',
				data: 'comu_id=' + comu_id,
				success: function(h){
					switch(h.charAt(0)){
						case '0':
							mydialog.alert('Error', h.substring(3));
						break;
						case '1':
							mydialog.alert('Listo!', h.substring(3));
						break;
					}
				}
			});
		}
	},
	mps: {
		read: function(mp_id){
			$.ajax({
				type: 'POST',
				url: '/ajax/mod/read_mp?tpl=1',
				data: 'mp_id=' + parseInt(mp_id),
				success: function(h){
					mydialog.end_loading();
					switch(h.charAt(0)){
						case '0':
							mydialog.alert('Error', h.substring(3));
						break;
						case '1':
							mydialog.alert('Conversaci&oacute;n', h.substring(3));
							if($('.readMessage').height() >= 630){
								$('.readMessage').slimScroll({
									height: '630px',
									width: '725px'
								});
							}
						break;
					}
				}
			});
		}
	}
}