$(function(){
	$('input[name=in_filters]').each(function(){
		$(this).click(function(){
			monitor.reload();
		});
	});
});

var monitor = {
	start: 1,
	limit: 20,
	filter: '',
	view_more: function(obj){
		obj.css('opacity', '.3').html('Cargando...');
		monitor.filter = '';
		
		$('input[name=in_filters]').each(function(){
			if(!$(this).is(':checked')){
				var filterid = $(this).attr('filterid');
				monitor.filter += filterid+',';
			}
		});
			$.ajax({
				type: 'POST',
				url: '/ajax/user/monitor?tpl=1',
				data: 'start=' + monitor.start + '&nofilter=' + monitor.filter,
				success: function(h){
					switch(h.charAt(0)){
						case '0':
							mydialog.alert('Opps!', h.substring(3));
							obj.css('opacity', '1').html('Mostrar m&aacute;s');
						break;
						case '1':
							obj.remove();
							$('.list-header').append(h.substring(3));
							monitor.start++;
						break;
					}
				}
			});
	},
	reload: function(){
		monitor.filter = '';
		
		$('input[name=in_filters]').each(function(){
			if(!$(this).is(':checked')){
				var filterid = $(this).attr('filterid');
				monitor.filter += filterid+',';
			}
		});
			$.ajax({
				type: 'POST',
				url: '/ajax/user/monitor?tpl=1',
				data: 'start=0&nofilter=' + monitor.filter,
				success: function(h){
					switch(h.charAt(0)){
						case '0':
							mydialog.alert('Opps!', h.substring(3));
						break;
						case '1':
							$('.list-header').html(h.substring(3));
							monitor.start = 0;
						break;
					}
				}
			});
	}
}