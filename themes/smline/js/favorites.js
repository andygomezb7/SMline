var favorites = {
	del: function(fid){
		$.ajax({
			type: 'POST',
			url: '/ajax/posts/del_fav',
			data: 'fid=' + parseInt(fid),
			success: function(h){
				switch(h.charAt(0)){
					case '0':
						mydialog.alert('Opps!', h.substring(3));
					break;
					case '1':
						$('tr#favid-'+fid).css('opacity', '.3');
					break;
				}
			}
		});
	}
}

function del_borrador(bid, okay){
	if(!okay){
		mydialog.show();
		mydialog.title('Eliminar borrador');
		mydialog.body('&iquest;Deseas eliminar este borrador?');
		mydialog.buttons(true, 'Eliminar', 'Cancelar', 'del_borrador('+bid+', 1);mydialog.close();', 'close', true);
		mydialog.center();
		return;
	}
	$.ajax({
		type: 'POST',
		url: '/ajax/posts/del_borrador',
		data: 'bid=' + parseInt(bid),
		success: function(h){
			switch(h.charAt(0)){
				case '0':
					mydialog.alert('Opps!', h.substring(3));
				break;
				case '1':
					$('li#borrador-id-'+bid).fadeOut(400);
				break;
			}
		}
	});
}