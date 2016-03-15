page_cache = new Array();
tops_cache = new Array();

function to_page(page, cat){
	if(typeof page_cache[page] == 'undefined'){
		$('.last_topics .list-element').css('opacity', '0.3');
		$('.last_topics').append('<span class="overlay_load"><img src="'+global_data.img+'/loading.gif"></span>');
		var cat = cat ? cat : '';
		$.ajax({
			type: 'POST',
			url: '/ajax/topics/home_page?tpl=1',
			data: 'page=' + parseInt(page) + '&cat=' + cat,
			success: function(h){
				$('.last_topics').html(h);
				page_cache[page] = h;
			}
		});
	}else $('.last_topics').html(page_cache[page]);
}

function tops_filter(type, filter, name){
	if(typeof tops_cache[type+filter+name] == 'undefined'){
		$('.top_'+type+' .list-element').css('opacity', '0.3');
		$.ajax({
			type: 'POST',
			url: '/ajax/topics/top_'+type+'?tpl=1',
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
