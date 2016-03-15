var mod = {
	del: function(type, objid, ok){
		if(!ok){
			switch(type){
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
			$.ajax({
				type: 'POST',
				url: '/ajax/'+type+'/mod_delete',
				data: 'objid=' + parseInt(objid) + '&reason=' + reason,
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
	add_sticky: function(type, objid, ok){
		switch(type){
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
	}
}