$(document).ready(function(){
	$('#mask').click(function(){
		$('.img-full').hide();
		$('#mydialog .img-thumb').show(0, function(){
			$('#mydialog #dialog-img').css({
				'left':$(window).width()/2-$('#mydialog #dialog-img').width()/2,
				'top':$(window).height()/2-$('#mydialog #dialog-img').height()/2
			});
			
			$('#mydialog #dialog-img').animate({'left': (objs[1].left+134)+'px', 'top': (objs[1].top-$('body').scrollTop()+134)+'px'}, 300, function(){
				$(this).remove();
				$('#mask').hide();
			});
		});
	});
});
page_cache = new Array();

function to_page(page){
	if(typeof page_cache[page] == 'undefined'){
		$('.last_images .img-list').css('opacity', '0.3');
		$('.last_images').append('<span class="overlay_load"><img src="'+global_data.img+'/loading.gif"></span>');
		$.ajax({
			type: 'POST',
			url: '/ajax/images/home_page?tpl=1',
			data: 'page=' + parseInt(page),
			success: function(h){
				$('.last_images').html(h);
				page_cache[page] = h;
			}
		});
	}else $('.last_images').html(page_cache[page]);
}

var img = {
	prev: function(imgid, obj){
		var position = obj.parent().parent().children('a').children('img').position();
		var new_html = '<div id="dialog-img"><a class="img-close" title="Cerrar imagen" onclick="img.prev_close();"><img src="'+global_data.img+'/icons/popup_close_button.gif" /></a><img class="img-thumb" src="'+obj.parent().parent().children('a').children('img').attr('src')+'" /><img class="img-loading" src="/themes/'+global_data.theme+'/css/images/loading.gif" /></div>';
		$('#mydialog').html(new_html);
		$('#mydialog #dialog-img').css({'left': (position.left+134)+'px', 'top': (position.top-$('body').scrollTop()+134)+'px'});
		$('#mask').css({'width':$(document).width(),'height':$(document).height(), 'background':'#000000'}).show();
		$('#mydialog #dialog-img').animate({
			'left':$(window).width()/2-$('#mydialog #dialog-img').width()/2,
			'top':$(window).height()/2-$('#mydialog #dialog-img').height()/2
		}, 500, function(){
			$.ajax({
				type: 'POST',
				url: '/ajax/images/prev_img?tpl=1',
				data: 'imgid=' + parseInt(imgid),
				success: function(h){
					$('#mydialog #dialog-img').append(h);
					var imagen = $('.img-full');
					imagen.load(function(){
						$(this).fadeIn(500);
						$('#mydialog .img-loading').remove();
						$('#mydialog .img-thumb').hide();
						$('#mydialog #dialog-img').css({
							'left':$(window).width()/2-$('#mydialog #dialog-img').width()/2,
							'top':$(window).height()/2-$('#mydialog #dialog-img').height()/2
						});
					});
					objs = [new_html, position];
				}
			});
		});
		
	},
	prev_close: function(){
		$('.img-full').hide();
		$('#mydialog .img-thumb').show(0, function(){
			$('#mydialog #dialog-img').css({
				'left':$(window).width()/2-$('#mydialog #dialog-img').width()/2,
				'top':$(window).height()/2-$('#mydialog #dialog-img').height()/2
			});
			
			$('#mydialog #dialog-img').animate({'left': (objs[1].left+134)+'px', 'top': (objs[1].top-$('body').scrollTop()+134)+'px'}, 300, function(){
				$(this).remove();
				$('#mask').hide();
			});
		});
	}
}