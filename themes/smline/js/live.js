//=> Posts en Vivo By David077
//=> Twitter: https://twitter.com/DjKrihs
//=> Facebook: https://www.facebook.com/

$(document).ready(function(){
	live.start();
	//setInterval(live.update(), live.update_time);
});

var live = {
	update_time: global_data.live_timeout, // Definido por el admin
	get: {},
	start: function(){
		//setTimeout(function(){ live.update(); }, live.update_time);
		live.update();
	},
	update: function(){
		$.ajax({
			type: 'POST',
			url: '/ajax/user/check-notis',
			dataType: 'json',
			success: function(h){
				if(global_data.user_key > 0){
					// BEEP
					if(h['sound'] && global_data.sounds == 1) $('#sounds').html('<embed width="0px" height="0px" wmode="transparent" allowscriptaccess="always" quality="high" bgcolor="#000000" src="/PHP/libs/sounds/alert.swf" type="application/x-shockwave-flash">');
					live.get['nots_total'] = h['nots'] + h['mps'];
					if(live.get['nots_total'] > 0){
						if(h['live_list']) $('.notification-board').prepend($(h['live_list']).fadeIn('slow'));
						//$(document).attr('title', '(' + live.get['nots_total'] + ') ' + global_data.title);
					}else{
						//$(document).attr('title', global_data.title);
					}
					if(h['nots'] == 0) $('span#total_notis').hide();
					else notifica.popup(h['nots']);
					if(h['mps'] == 0) $('span#total_mps').hide();
					else $('span#total_mps').text(h['mps']).fadeIn(300);
					var news_nots = $('.notification-board').html();
					if(news_nots != ''){
						$('.notification-board div.notification').each(function(){
							var not_date = $(this).attr('timepub');
							if(h['max_time'] > not_date) $(this).remove();
					   });
					}
				}
			},
			complete: function(){
				setTimeout(function(){ live.update(); }, live.update_time);
			}
			
		});
	}
}