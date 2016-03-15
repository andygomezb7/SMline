$(document).ready(function(){
	if ($('.all_news').length && $('.home_news div#error').length > 1){
		start_news($('.home_news div#error').length, 1);
	}
});

page_cache = new Array();
tops_cache = new Array();

function start_news(total, active){
	setTimeout(function(){
		if(active == total){
			$('.home_news #error:nth-child('+active+')').hide();
			$('.home_news #error:nth-child(1)').fadeIn(400);
			var new_active = 1;
		}else{
			var new_active = active + 1;
			$('.home_news #error:nth-child('+active+')').hide();
			$('.home_news #error:nth-child('+new_active+')').fadeIn(400);
		}
		start_news(total, new_active);
	}, 10000);
}

function to_page(page, cat){
	if(typeof page_cache[page] == 'undefined'){
		$('.last_posts .list-element').css('opacity', '0.3');
		$('.last_posts').append('<span class="overlay_load"><img src="'+global_data.img+'/loading.gif"></span>');
		var cat = cat ? cat : '';
		$.ajax({
			type: 'POST',
			url: '/ajax/posts/home_page?tpl=1',
			data: 'page=' + parseInt(page) + '&cat=' + cat,
			success: function(h){
				$('.last_posts').html(h);
				page_cache[page] = h;
			}
		});
	}else $('.last_posts').html(page_cache[page]);
}

function tops_filter(type, filter, name){
	if(typeof tops_cache[type+filter+name] == 'undefined'){
		$('.top_'+type+' .list-element').css('opacity', '0.3');
		$.ajax({
			type: 'POST',
			url: '/ajax/posts/top_'+type+'?tpl=1',
			data: 'filter=' + parseInt(filter),
			success: function(h){
				$('.top_'+type).html(h);
				$('.filter_'+type+' a').removeClass('active');
				$('.filter_'+type+' a.f_p_'+name).addClass('active');
				tops_cache[type+filter+name] = h;
			}
		});
	}else{
		$('.top_'+type).html(tops_cache[type+filter+name]);
		$('.filter_'+type+' a').removeClass('active');
		$('.filter_'+type+' a.f_p_'+name).addClass('active');
	}
}
