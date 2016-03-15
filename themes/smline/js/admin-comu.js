function set_admin_action(action){
	admin_comu.cache.admin_action = action;
}

var admin_comu = {
	cache: {},
	load_members: function(cid, type, page, search){
		if(search == 1){
			if($('#button_bans').hasClass('here')) var type = 'bans';
			else var type = 'members';
		}else{
		$('#button_members').removeClass('here');
		$('#button_bans').removeClass('here');
		$('#button_'+type).addClass('here');
		}
		var user = $('input[name="search"]').val();
		$.ajax({
			type: 'POST',
			url: '/ajax/comus/load_members?tpl=1',
			data: 'type=' + type + '&cid=' + cid + '&page=' + page + '&search=' + search + '&user=' + user,
			success: function(h){
				switch(h.charAt(0)){
					case '0': //Error
						$('#showResult').html('<div class="warningData">'+h.substring(3)+'</div>');
						break;
					case '1':
						$('#showResult').html(h.substring(3));
					break;
				}
				$('.loading_members').remove();
			}
		});
	},
	admin_member: function(cid, user){
		$.ajax({
			type: 'POST',
			url: '/ajax/comus/admin_member?tpl=1',
			data: 'user=' + user + '&cid=' + cid,
			success: function(data){
				mydialog.alert('Moderar usuario', data);
				mydialog.buttons(true, 'Continuar', 'Cancelar', 'admin_comu.save_member('+cid+', '+user+')', 'close', true);
				admin_comu.cache.admin_action = 0;
			},
			error: function(){
				mydialog.error_500('admin_comu.admin_member('+cid+', '+user+')');
			}
		});
	},
	save_member: function(cid, uid){
		if(admin_comu.cache.admin_action == 0){
			mydialog.close(); return;
		}
		$('.admin_member_error').hide();
		var params = $('#modalBody select[name], #modalBody textarea[name]');
		$.ajax({
			type: 'POST',
			url: '/ajax/comus/save_member',
			data: 'uid=' + uid + '&cid=' + cid + '&admin_action=' + admin_comu.cache.admin_action + '&' + $.param(params),
			success: function(h){
				switch(h.charAt(0)){
					case '0':
						$('.admin_member_error').show().html(h.substring(3));
					break;
					case '1':
						mydialog.alert('Listo!', h.substring(3));
						admin_comu.load_members(cid, 'members', 1, 0);
					break;
				}
			},
			error: function(){
				mydialog.error_500('admin_comu.save_member('+cid+', '+user+')');
			}
		});
	}
}