var comus = {
	join: function(comu_id){
		$('a.leave').show();
		$('a.join').hide();
		$.ajax({
			type: 'POST',
			url: '/ajax/comus/join',
			data: 'comu_id=' + comu_id,
			success: function(h){
				switch(h.charAt(0)){
					case '0':
						mydialog.alert('Error', h.substring(3));
						$('a.leave').hide();
						$('a.join').show();
						break;
					case '1':
						window.location.reload();
					break;
				}
			}
		});
	},
	leave: function(comu_id){
		$('a.leave').hide();
		$('a.join').show();
		$.ajax({
			type: 'POST',
			url: '/ajax/comus/leave',
			data: 'comu_id=' + comu_id,
			success: function(h){
				switch(h.charAt(0)){
					case '0':
						mydialog.alert('Error', h.substring(3));
						$('a.leave').show();
						$('a.join').hide();
						break;
					case '1':
						window.location.reload();
					break;
				}
			}
		});
	},
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
						window.location.reload();
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
						window.location.reload();
					break;
				}
			}
		});
	}
}