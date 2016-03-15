function show_adj(){
		$('.s_adj_img').click(function(){
			var open_type = $(this).attr('open-type');
			switch(open_type){
				case '2':
					var new_html = '<div id="dialog-img"><a class="img-close" title="Cerrar imagen" onclick="hide_dia();"><img src="'+global_data.img+'/icons/popup_close_button.gif" /></a><img src="'+$(this).attr('data-open')+'" class="img-full"></div>';
				break;
				case '3':
					var new_html = '<div id="dialog-img"><a class="img-close" title="Cerrar imagen" onclick="hide_dia();"><img src="'+global_data.img+'/icons/popup_close_button.gif" /></a><iframe width="640" height="360" src="//www.youtube.com/embed/'+$(this).attr('data-open')+'?rel=0&autoplay=1" frameborder="0" allowfullscreen></iframe></div>';
				break;
			}
			$('#mydialog').html(new_html);
			$('#mask').css({'width':$(document).width(),'height':$(document).height(), 'background':'#000000'}).show();
			$('#mydialog #dialog-img').css({
				'left':$(window).width()/2-$('#mydialog #dialog-img').width()/2,
				'top':$(window).height()/2-$('#mydialog #dialog-img').height()/2,
			});
			if(open_type == 3) $('#mydialog #dialog-img').css('padding', '15px');
		});
		$('#mask').click(function(){
			hide_dia();
		});
	}

$(document).ready(function(){
	states.cache.adj_type = 'sta';
	states.cache.adj_url = '';
	$('.remove-attach').click(function(){
		$('.my-shout-attach').hide();
		$('.buttons_adjs a.active').removeClass('active');
		$('.buttons_adjs a:first').addClass('active');
		$('.s_import').remove();
		$('.attach-i_vid input, .attach-i_img input').val('');
	});

	show_adj();
	active_status = 0;
	$('textarea[name=new_comment]').each(function(){
		$(this).focus(function(){
			active_status = $(this).attr('status-id');
		});
	});
	if (typeof location.href.split('#')[1] != 'undefined') {
		$('ul.tabs_links a.a-'+location.href.split('#')[1]).click();
	}
});

function hide_dia(){
	$('#mydialog').html('');
	$('#mask').hide();
}

var states = {
	cache : {},
	adj: function(type, obj){
		$('.buttons_adjs a.active').removeClass('active');
		obj.addClass('active');
		switch(type){
			case 'vid':
				$('.attach-i_img').hide();
				$('.attach-i_img .s_import').remove();
				$('.attach-i_vid').show();
				$('.attach-i_vid input').focus();
			break;
			case 'img':
				$('.attach-i_vid').hide();
				$('.attach-i_vid .s_import').remove();
				$('.attach-i_img').show();
				$('.attach-i_img input').focus();
			break;
			case 'sta':
				$('.attach-i_vid, .attach-i_img').hide();
				$('textarea[name=r_status]').focus();
				$('.s_import').remove();
			break;
		}
		states.cache.adj_type = type;
	},
	send: function(obj, type){
		var status = $('textarea[name=r_status]').val();
		var to_user = parseInt($('input[name=to_user]').val());
		if(status == '' || status == 'Escribele algo'){
			$('textarea[name=r_status]').focus();
			return;
		}
		obj.css('opacity','0.3');
		$.ajax({
			type: 'POST',
			url: '/ajax/states/send',
			data: 'type=' + states.cache.adj_type + '&url=' + states.cache.adj_url + '&body=' + status + '&to_user=' + to_user,
			success: function(h){
				switch(h.charAt(0)){
					case '0':
						mydialog.alert('Opps!', h.substring(3));
					break;
					case '1':
						
						$('#last_states-data').prepend(h.substring(3));
						$('textarea[name=r_status], input[name=import]').val('');
						$('.my-shout-attach').hide();
						$('.s_import').remove();
						$('.buttons_adjs a.active').removeClass('active');
						$('.buttons_adjs a:first').addClass('active');
						states.cache.adj_type = 'sta';
						states.cache.adj_url = '';
						var user = parseInt($('input[name=to_user]').val());
						$.ajax({
							type: 'POST',
							url: '/ajax/profile/load_tab?tpl=1',
							data: 'tab=states&user=' + user,
							success: function(h){
								switch(h.charAt(0)){
									case '0':
										mydialog.alert('Opps!', h.substring(3));
									break;
									case '1':
										$('div.profile_tab_active').html(h.substring(3));
									break;
								}
							}
						});
						show_adj();
					break;
				}
			},
			complete: function(){
				obj.css('opacity','1');
			}
		});
	},
	import_: function(obj){
		$('.s_import').remove();
		var url = $('.my-shout-attach.attach-i_'+states.cache.adj_type +' input[name=import]').val();
		obj.css('opacity','0.3');
		$.ajax({
			type: 'POST',
			url: '/ajax/states/import',
			data: 'type=' + states.cache.adj_type + '&url=' + url,
			success: function(h){
				switch(h.charAt(0)){
					case '0':
						mydialog.alert('Opps!', h.substring(3));
					break;
					case '1':
						$('.my-shout-attach.attach-i_'+states.cache.adj_type).prepend(h.substring(3));
						states.cache.adj_url = url;
						show_adj();
					break;
				}
			},
			complete: function(){
				obj.css('opacity','1');
			}
		});
	},
	like: function(sid, type, obj){
		$.ajax({
			type: 'POST',
			url: '/ajax/states/like',
			data: 'type=' + type + '&sid=' + parseInt(sid),
			success: function(h){
				switch(h.charAt(0)){
					case '0':
						mydialog.alert('Opps!', h.substring(3));
					break;
					case '1':
						var total_likes = parseInt($('.likes-total-'+sid).text());
						if(type == 0){
							obj.text('Me gusta').attr('onclick', 'states.like('+sid+', 1, $(this)); return false;');
							$('.likes-total-'+sid).text(total_likes-1);
						}else{
							obj.text('Ya no me gusta').attr('onclick', 'states.like('+sid+', 0, $(this)); return false;');
							$('.likes-total-'+sid).text(total_likes+1);
						}
					break;
				}
			}
		});
	},
	show_new_comment: function(sid, obj){
		var obj = obj.parent().parent().children('.s_comments_actions');
		if(obj.css('display') == 'none'){
			obj.show();
			$('textarea.newc-'+sid).focus();
		}else obj.hide();
	},
	send_comment: function(sid, obj){
		var comment = encodeURIComponent($('textarea.newc-'+sid).val());
		if(comment == ''){
			$('textarea.newc-'+sid).focus();
			return;
		}
		obj.css('opacity', '0.3');
		$.ajax({
			type: 'POST',
			url: '/ajax/states/comment?tpl=1',
			data: 'comment=' + comment + '&sid=' + sid,
			success: function(h){
				switch(h.charAt(0)){
					case '0':
						mydialog.alert('Error', h.substring(3));
					break;
					case '1':
						$('#new-co-'+sid).html(h.substring(3)).removeAttr('id');
						$('.newc-'+sid).val('');
						var total_comments = parseInt($('.comments-total-'+sid).text())+1;
						$('.comments-total-'+sid).text(total_comments);
					break;
				}
				obj.css('opacity', '1');
			}
		});
	},
	show_comments: function(sid, obj){
		//if(typeof states.cache['show-comments-'+sid] == 'undefined'){
			obj.css('opacity','.3');
			$.ajax({
				type: 'POST',
				url: '/ajax/states/show_comments?tpl=1',
				data: 'sid=' + sid,
				success: function(h){
					switch(h.charAt(0)){
						case '0':
							mydialog.alert('Error', h.substring(3));
							obj.css('opacity','1');
						break;
						case '1':
							$('.is-new-c-'+sid).remove();
							$('.more-comments-sid-'+sid).html(h.substring(3));
							states.cache['show-comments-'+sid] = 1;
							obj.remove();
						break;
					}
				}
			});
		//}
	},
	comments: {
		like: function(cid, type, obj){
			$.ajax({
				type: 'POST',
				url: '/ajax/states/like_comment',
				data: 'type=' + type + '&cid=' + parseInt(cid),
				success: function(h){
					switch(h.charAt(0)){
						case '0':
							mydialog.alert('Opps!', h.substring(3));
						break;
						case '1':
							var total_likes = parseInt($('.likes-total-c-'+cid).text());
							if(type == 0){
								obj.text('Me gusta').attr('onclick', 'states.comments.like('+cid+', 1, $(this)); return false;');
								$('.likes-total-c-'+cid).text(total_likes-1);
							}else{
								obj.text('Ya no me gusta').attr('onclick', 'states.comments.like('+cid+', 0, $(this)); return false;');
								$('.likes-total-c-'+cid).text(total_likes+1);
							}
						break;
					}
				}
			});
		}
	},
	comment_del: function(cid, okay, sid){
			if(!okay){
				mydialog.show();
				mydialog.title('Eliminar comentario');
				mydialog.body('&iquest;Deseas eliminar este comentario?');
				mydialog.buttons(true, 'Eliminar', 'Cancelar', 'states.comment_del('+cid+', 1, '+sid+');mydialog.close();', 'close', true);
				mydialog.center();
				return;
			}
			$('#state-comment-'+cid).css('opacity', '.3');
			$.ajax({
				type: 'POST',
				url: '/ajax/states/comment_del',
				data: 'cid=' + cid,
				success: function(h){
					switch(h.charAt(0)){
						case '0':
							mydialog.alert('Error', h.substring(3));
							$('#state-comment-'+cid).css('opacity', '1');
						break;
						case '1':
							$('#state-comment-'+cid).remove();
							var total_comments = parseInt($('.comments-total-'+sid).text())-1;
							$('.comments-total-'+sid).text(total_comments);
						break;
					}
				}
			});
	},
	del_state: function(sid, okay){
			if(!okay){
				mydialog.show();
				mydialog.title('Eliminar estado');
				mydialog.body('&iquest;Deseas eliminar este estado?');
				mydialog.buttons(true, 'Eliminar', 'Cancelar', 'states.del_state('+sid+', 1);mydialog.close();', 'close', true);
				mydialog.center();
				return;
			}
			$('#status-id-'+sid).css('opacity', '.3');
			$.ajax({
				type: 'POST',
				url: '/ajax/states/del_state',
				data: 'sid=' + sid,
				success: function(h){
					switch(h.charAt(0)){
						case '0':
							mydialog.alert('Error', h.substring(3));
							$('#status-id-'+sid).css('opacity', '1');
						break;
						case '1':
							$('#status-id-'+sid).remove();
						break;
					}
				}
			});
	},
	get_edit: function(sid){
		$.ajax({
			type: 'POST',
			url: '/ajax/states/get_edit',
			data: 'sid=' + parseInt(sid),
			success: function(h){
				switch(h.charAt(0)){
					case '0':
						mydialog.alert('Error', h.substring(3));
					break;
					case '1':
						mydialog.show();
						mydialog.title('Editar estado');
						mydialog.body('<div class="edit_comment"><textarea id="r_comment" class="inp_text required" name="r_body" autocomplete="off">'+h.substring(3)+'</textarea></div>');
						mydialog.buttons(true, 'Guardar cambios', 'Cancelar', 'states.save_state('+sid+', $(this))', 'close', true);
						mydialog.center();
					break;
				}
			}
		});
	},
	save_state: function(sid, obj){
			var state = encodeURIComponent($('#mydialog #r_comment').val());
			if(state == ''){
				$('#mydialog #r_comment').focus();
				return;
			}
			obj.css('opacity', '0.3').val('Guardando...');
			$.ajax({
				type: 'POST',
				url: '/ajax/states/save_state',
				data: 'state=' + state + '&sid=' + parseInt(sid),
				success: function(h){
					switch(h.charAt(0)){
						case '0':
							mydialog.alert('Error', h.substring(3));
						break;
						case '1':
							mydialog.close();
							$('#body-state-'+sid).html(h.substring(3));
						break;
					}
					obj.css('opacity', '1').val('Guardar cambios');
				}
			});
		},
}

var profile = {
	load_tab: function(tab){
		var main_obj = $('li.tab_'+tab);
		//if(main_obj.hasClass('active')) return;
		$('div.profile_tab_active').css('opacity', '.3');
		var user = parseInt($('input[name=to_user]').val());
		$.ajax({
			type: 'POST',
			url: '/ajax/profile/load_tab?tpl=1',
			data: 'tab=' + tab + '&user=' + user,
			success: function(h){
				switch(h.charAt(0)){
					case '0':
						mydialog.alert('Opps!', h.substring(3));
					break;
					case '1':
						$('li.tab_link_core.active').removeClass('active');
						main_obj.addClass('active');
						$('div.profile_tab_active').html(h.substring(3));
						$('div.profile_tab_active').css('opacity', '1');
						show_adj();
					break;
					default:
						mydialog.alert('Opps!', h);
					break;
				}
			}
		});	
	},
	activity_load_more: function(){
		$('.load_more').html('Cargando...').css('opacity', '.5');
		var user = parseInt($('input[name=to_user]').val());
		var activity_start = parseInt($('input[name=activity_start]').val());
		$.ajax({
			type: 'POST',
			url: '/ajax/profile/activity_load_more?tpl=1',
			data: 'user=' + user + '&start=' + activity_start,
			success: function(h){
				$('.load_more').html('Mostrar m&aacute;s actividad').css('opacity', '1');
				switch(h.charAt(0)){
					case '0':
						mydialog.alert('Opps!', h.substring(3));
					break;
					case '1':
						$('.activity_listest').append(h.substring(3));
						$('input[name=activity_start]').val(activity_start+1);
					break;
					case '2':
						$('.no_hay_mas_activity').show();
						$('.load_more').hide();
					break;
				}
			}
		});	
	},
	posts_load_more: function(retorno){
		var order = $('select[name=posts_order]').val();
		if(retorno){
			var posts_start = 0;
		} else {
			var posts_start = parseInt($('input[name=posts_start]').val());
		}
		$('.load_more').html('Cargando...').css('opacity', '.5');
		var user = parseInt($('input[name=to_user]').val());
		$.ajax({
			type: 'POST',
			url: '/ajax/profile/posts_load_more?tpl=1',
			data: 'user=' + user + '&start=' + posts_start + '&order=' + order,
			success: function(h){
				$('.load_more').html('Mostrar m&aacute;s posts').css('opacity', '1');
				switch(h.charAt(0)){
					case '0':
						mydialog.alert('Opps!', h.substring(3));
					break;
					case '1':
						if(retorno) $('.activity_listest').html(h.substring(3));
						else {
							$('.activity_listest').append(h.substring(3));
							$('input[name=posts_start]').val(posts_start+1);
						}
					break;
					case '2':
						$('.no_hay_mas_activity').show();
						$('.load_more').hide();
					break;
				}
			}
		});	
	},
	images_load_more: function(retorno){
		var order = $('select[name=posts_order]').val();
		if(retorno){
			var posts_start = 0;
		} else {
			var posts_start = parseInt($('input[name=posts_start]').val());
		}
		$('.load_more').html('Cargando...').css('opacity', '.5');
		var user = parseInt($('input[name=to_user]').val());
		$.ajax({
			type: 'POST',
			url: '/ajax/profile/images_load_more?tpl=1',
			data: 'user=' + user + '&start=' + posts_start + '&order=' + order,
			success: function(h){
				$('.load_more').html('Mostrar m&aacute;s im&aacute;genes').css('opacity', '1');
				switch(h.charAt(0)){
					case '0':
						mydialog.alert('Opps!', h.substring(3));
					break;
					case '1':
						if(retorno) $('.activity_listest').html(h.substring(3));
						else {
							$('.activity_listest').append(h.substring(3));
							$('input[name=posts_start]').val(posts_start+1);
						}
					break;
					case '2':
						$('.no_hay_mas_activity').show();
						$('.load_more').hide();
					break;
				}
			}
		});	
	},
	topics_load_more: function(retorno){
		var order = $('select[name=posts_order]').val();
		if(retorno){
			var posts_start = 0;
		} else {
			var posts_start = parseInt($('input[name=posts_start]').val());
		}
		$('.load_more').html('Cargando...').css('opacity', '.5');
		var user = parseInt($('input[name=to_user]').val());
		$.ajax({
			type: 'POST',
			url: '/ajax/profile/topics_load_more?tpl=1',
			data: 'user=' + user + '&start=' + posts_start + '&order=' + order,
			success: function(h){
				$('.load_more').html('Mostrar m&aacute;s temas').css('opacity', '1');
				switch(h.charAt(0)){
					case '0':
						mydialog.alert('Opps!', h.substring(3));
					break;
					case '1':
						if(retorno) $('.activity_listest').html(h.substring(3));
						else {
							$('.activity_listest').append(h.substring(3));
							$('input[name=posts_start]').val(posts_start+1);
						}
					break;
					case '2':
						$('.no_hay_mas_activity').show();
						$('.load_more').hide();
					break;
				}
			}
		});	
	},
	states_load_more: function(){
		var states_start = parseInt($('input[name=states_start]').val());
		$('.load_more').html('Cargando...').css('opacity', '.5');
		var user = parseInt($('input[name=to_user]').val());
		$.ajax({
			type: 'POST',
			url: '/ajax/profile/states_load_more?tpl=1',
			data: 'user=' + user + '&start=' + states_start,
			success: function(h){
				$('.load_more').html('Mostrar m&aacute;s estados').css('opacity', '1');
				switch(h.charAt(0)){
					case '0':
						mydialog.alert('Opps!', h.substring(3));
					break;
					case '1':
						$('#last_states-data').append(h.substring(3));
						$('input[name=states_start]').val(states_start+1);
						show_adj();
					break;
					case '2':
						$('.no_hay_mas_activity').show();
						$('.load_more').hide();
						show_adj();
					break;
				}
			}
		});	
	},
	follows_load_more: function(){
		$('.load_more').html('Cargando...').css('opacity', '.5');
		var user = parseInt($('input[name=to_user]').val());
		var follows_start = parseInt($('input[name=follows_start]').val());
		$.ajax({
			type: 'POST',
			url: '/ajax/profile/follows_load_more?tpl=1',
			data: 'user=' + user + '&start=' + follows_start,
			success: function(h){
				$('.load_more').html('Cargar m&aacute;s seguidores').css('opacity', '1');
				switch(h.charAt(0)){
					case '0':
						mydialog.alert('Opps!', h.substring(3));
					break;
					case '1':
						$('.activity_listest').append(h.substring(3));
						$('input[name=follows_start]').val(follows_start+1);
					break;
					case '2':
						$('.no_hay_mas_activity').show();
						$('.load_more').hide();
					break;
				}
			}
		});	
	},
	following_load_more: function(){
		$('.load_more').html('Cargando...').css('opacity', '.5');
		var user = parseInt($('input[name=to_user]').val());
		var follows_start = parseInt($('input[name=follows_start]').val());
		$.ajax({
			type: 'POST',
			url: '/ajax/profile/following_load_more?tpl=1',
			data: 'user=' + user + '&start=' + follows_start,
			success: function(h){
				$('.load_more').html('Mostrar m&aacute;s').css('opacity', '1');
				switch(h.charAt(0)){
					case '0':
						mydialog.alert('Opps!', h.substring(3));
					break;
					case '1':
						$('.activity_listest').append(h.substring(3));
						$('input[name=follows_start]').val(follows_start+1);
					break;
					case '2':
						$('.no_hay_mas_activity').show();
						$('.load_more').hide();
					break;
				}
			}
		});	
	},
	comus_load_more: function(retorno){
		if(retorno){
			var comus_start = 0;
		} else {
			var comus_start = parseInt($('input[name=comus_start]').val());
		}
		$('.load_more').html('Cargando...').css('opacity', '.5');
		var user = parseInt($('input[name=to_user]').val());
		$.ajax({
			type: 'POST',
			url: '/ajax/profile/comus_load_more?tpl=1',
			data: 'user=' + user + '&start=' + comus_start,
			success: function(h){
				$('.load_more').html('Mostrar m&aacute;s comunidades').css('opacity', '1');
				switch(h.charAt(0)){
					case '0':
						mydialog.alert('Opps!', h.substring(3));
					break;
					case '1':
						if(retorno) $('.activity_listest').html(h.substring(3));
						else {
							$('.activity_listest').append(h.substring(3));
							$('input[name=comus_start]').val(comus_start+1);
						}
					break;
					case '2':
						$('.no_hay_mas_activity').show();
						$('.load_more').hide();
					break;
				}
			}
		});	
	}
}