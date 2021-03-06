var topic = {
	cache: {},
	comments: {
		get_edit: function(cid){
			$.ajax({
				type: 'POST',
				url: '/ajax/topics/get_edit_comment',
				data: 'cid=' + parseInt(cid),
				success: function(h){
					switch(h.charAt(0)){
						case '0':
							mydialog.alert('Error', h.substring(3));
						break;
						case '1':
							var quote = "'";
							mydialog.show();
							mydialog.title('Editar comentario');
							mydialog.body('<div class="edit_comment"><textarea id="r_comment" onclick="$(this).markItUp(mySettings).removeAttr('+quote+'onclick'+quote+')" class="inp_text required" name="r_body" tabindex="2" placeholder="Escribe un comentario" autocomplete="off">'+h.substring(3)+'</textarea></div>');
							mydialog.buttons(true, 'Guardar cambios', 'Cancelar', 'topic.comments.save_comment('+cid+', $(this))', 'close', true);
							mydialog.center();
						break;
					}
				}
			});
		},
		save_comment: function(cid, obj){
			var comment = encodeURIComponent($('#mydialog #r_comment').val());
			if(comment == ''){
				$('#mydialog #r_comment').focus();
				return;
			}
			obj.css('opacity', '0.3').val('Guardando...');
			$.ajax({
				type: 'POST',
				url: '/ajax/topics/save_comment',
				data: 'comment=' + comment + '&cid=' + parseInt(cid),
				success: function(h){
					switch(h.charAt(0)){
						case '0':
							mydialog.alert('Error', h.substring(3));
						break;
						case '1':
							mydialog.close();
							$('#body-comment-'+cid).html(h.substring(3));
						break;
					}
					obj.css('opacity', '1').val('Guardar cambios');
				}
			});
		},
		replie: function(cid, nofocus){
			if(typeof topic.cache['replie-ok-mu-'+cid] == 'undefined'){
				$('#new-replie-'+cid).fadeIn(500);
				$('#new-replie-'+cid+' .my-new-replie').html('<div class="floatL"><a href="'+global_data.url+'/'+global_data.user_nick+'"><img src="'+global_data.url+'/avatar/'+global_data.user_key+'_32.jpg?'+global_data.avatar_update+'" class="avatar-2"></a></div><div class="floatR" style="width: 565px;"><textarea id="r_comment" class="inp_text required text-replie-comment-'+cid+'" name="r_body" placeholder="Escribe un comentario" autocomplete="off"></textarea></div><div class="floatR margin-top-5"><input type="button" class="button_1 b_ok" value="Enviar respuesta" onclick="topic.comments.send_replie('+cid+', $(this));"></div>');
				$('#new-replie-'+cid+' #r_comment').markItUp(mySettings);
			}
			if(nofocus != 1) $('#new-replie-'+cid+' #r_comment').focus();
			topic.cache['replie-ok-mu-'+cid] = true;
		},
		send_replie: function(cid, obj){
			var comment = encodeURIComponent($('#new-replie-'+cid+' #r_comment').val());
			if(comment == ''){
				$('#new-replie-'+cid+' #r_comment').focus();
				return;
			}
			obj.css('opacity', '0.3').val('Comentando...');
			$.ajax({
				type: 'POST',
				url: '/ajax/topics/send_replie?tpl=1',
				data: 'comment=' + comment + '&cid=' + cid,
				success: function(h){
					switch(h.charAt(0)){
						case '0':
							mydialog.alert('Error', h.substring(3));
						break;
						case '1':
							$('#new-replie-'+cid+' .list-replies').append(h.substring(3));
							$('#new-replie-'+cid+' #r_comment').val('');
							var total_comments = parseInt($('b#post-total-comment').text())+1;
							$('b#post-total-comment, span#post-total-comment').text(total_comments);
						break;
					}
					obj.css('opacity', '1').val('Enviar respuesta');
				},
				error: function(){
					mydialog.error_500('topic.comments.send_repli('+cid+', '+obj+')');
				}
			});
		},
		show_replies: function(cid, obj){
			if(typeof topic.cache['show-replies-'+cid] != 'undefined') return;
			obj.css('opacity', '0.3').html('Cargando respuestas...');
			$.ajax({
				type: 'POST',
				url: '/ajax/topics/show_replies?tpl=1',
				data: 'cid=' + cid,
				success: function(h){
					switch(h.charAt(0)){
						case '0':
							mydialog.alert('Error', h.substring(3));
							obj.css('opacity', '1').html('Cargar respuestas');
						break;
						case '1':
							topic.cache['show-replies-'+cid] = true;
							$('#new-replie-'+cid+' .list-replies').html(h.substring(3));
							if(global_data.user_key) topic.comments.replie(cid, 1);
						break;
					}
				},
				error: function(){
					mydialog.error_500('topic.comments.show_replies('+cid+', '+obj+')');
				}
			});
		},
		vote: function(vote, cid, obj){
			obj.css('opacity', '0.3');
			$.ajax({
				type: 'POST',
				url: '/ajax/topics/vote_comment',
				data: 'cid=' + parseInt(cid) + '&vote=' + parseInt(vote),
				success: function(h){
					switch(h.charAt(0)){
						case '0':
							mydialog.alert('Error', h.substring(3));
							obj.css('opacity', '1');
						break;
						case '1':
							var total = parseInt($('.cm-v-id-'+cid+' .total-vptes').text());
							if(total == 0 && vote == 0) $('.cm-v-id-'+cid).addClass('negatives').removeClass('positives');
							else if(total == 0 && vote == 1) $('.cm-v-id-'+cid).addClass('positives').removeClass('negatives');
							$('.cm-v-id-'+cid+' .total-vptes').text(h.substring(3));
							if(h.substring == '0'){
								$('.cm-v-id-'+cid).removeClass('positives negatives');
								$('.cm-v-id-'+cid+' .total-vptes').text('0');
							}
							$('.cm-v-id-'+cid).removeClass('hide');
							obj.addClass('b_ok');
						break;
					}
				}
			});
		},
		del: function(cid, okay){
			if(!okay){
				mydialog.show();
				mydialog.title('Eliminar comentario');
				mydialog.body('&iquest;Deseas eliminar este comentario?');
				mydialog.buttons(true, 'Eliminar', 'Cancelar', 'topic.comments.del('+cid+', 1);mydialog.close();', 'close', true);
				mydialog.center();
				return;
			}
			$('#comment-'+cid).css('opacity', '.3');
			$.ajax({
				type: 'POST',
				url: '/ajax/topics/del_comment',
				data: 'cid=' + cid,
				success: function(h){
					switch(h.charAt(0)){
						case '0':
							mydialog.alert('Error', h.substring(3));
							$('#comment-'+cid).css('opacity', '1');
						break;
						case '1':
							$('#comment-'+cid).remove();
							var total_comments = parseInt($('b#post-total-comment').text())-1;
							$('b#post-total-comment, span#post-total-comment').text(total_comments);
						break;
					}
				},
				error: function(){
					mydialog.error_500('topic.comments.del('+cid+')');
				}
			});
		}
	},
	comment: function(obj){
		var comment = encodeURIComponent($('#r_comment.newe-c').val());
		if(comment == ''){
			$('#r_comment').focus();
			return;
		}
		obj.css('opacity', '0.3').val('Comentando...');
		$.ajax({
			type: 'POST',
			url: '/ajax/topics/comment?tpl=1',
			data: 'comment=' + comment + '&topic_id=' + global_data.topic_id,
			success: function(h){
				switch(h.charAt(0)){
					case '0':
						mydialog.alert('Error', h.substring(3));
					break;
					case '1':
						$('#last_comments').append(h.substring(3));
						$('.floatR #r_comment').val('');
						var total_comments = parseInt($('b#post-total-comment').text())+1;
						$('b#post-total-comment, span#post-total-comment').text(total_comments);
					break;
				}
				obj.css('opacity', '1').val('Enviar respuesta');
			},
			error: function(){
				mydialog.error_500("topic.comment("+obj+")");
			}
		});
	},
	vote: function(vote, obj){
		var vote = vote == 0 ? 0 : 1;
		$.ajax({
			type: 'POST',
			url: '/ajax/topics/vote',
			data: 'topic_id=' + global_data.topic_id + '&vote=' + vote,
			success: function(h){
				switch(h.charAt(0)){
					case '0':
						mydialog.alert('Error', h.substring(3));
					break;
					case '1':
						var total_votes = parseInt(obj.children('.ilike_text').text());
						obj.children('.ilike_text').text(total_votes+1);
					break;
				}
			}
		});
	},
	fav: function(action){
		$('.post_add_fav').children('img').attr('src', ''+global_data.img+'/icons/loading.gif');
		$.ajax({
			type: 'POST',
			url: '/ajax/topics/favorite',
			data: 'topic_id=' + global_data.topic_id + '&action=' + parseInt(action),
			success: function(h){
				switch(h.charAt(0)){
					case '0':
						mydialog.alert('Opps!', h.substring(3));
					break;
					case '1':
						if(action == 0){
							$('.post_add_fav').hide();
							$('.post_remove_fav').show();
							var total_favs = parseInt($('b#post-total-favs').text())+1;
							$('b#post-total-favs').text(total_favs);
						}else{
							$('.post_add_fav').show();;
							$('.post_remove_fav').hide();
							var total_favs = parseInt($('b#post-total-favs').text())-1;
							$('b#post-total-favs').text(total_favs);
						}
					break;
				}
				$('.post_add_fav').children('img').attr('src', global_data.img+'/icons/heart_10.png');
			}
		});
	},
	share: function(okay){
		if(!okay){
			mydialog.show();
			mydialog.title('Recomendar tema');
			mydialog.body('&iquest;Deseas recomendar este tema a tus seguidores?');
			mydialog.buttons(true, 'Recomendar', 'Cancelar', 'topic.share(1)', 'close', true);
			mydialog.center();
			return;
		}
		$.ajax({
			type: 'POST',
			url: '/ajax/topics/share',
			data: 'topic_id=' + global_data.topic_id,
			success: function(h){
				switch(h.charAt(0)){
					case '0':
						mydialog.alert('Error', h.substring(3));
					break;
					case '1':
						mydialog.alert('Listo!', h.substring(3));
						var total_share = parseInt($('.total-share').text())+1;
						$('.total-share').text(total_share);
					break;
				}
			}
		});
	},
	del: function(tid, okey){
		if(!okey){
				mydialog.show();
				mydialog.title('Borrar Tema');
				mydialog.body('&iquest;Seguro que deseas borrar este tema?');
				mydialog.buttons(true, 'SI', 'NO', 'topic.del('+tid+', 1)', 'close', true);
				mydialog.center();
				return;
		}else if(okey == 1){
				mydialog.show();
				mydialog.title('Borrar Tema');
				mydialog.body('Te pregunto de nuevo... &iquest;Seguro que deseas borrar este tema?');
				mydialog.buttons(true, 'SI', 'NO', 'topic.del('+tid+', 2)', 'close', true);
				mydialog.center();
				return;
		}
		mydialog.loading('Borrando...');
		$.ajax({
			type: 'POST',
			url: '/ajax/topics/delete_topic',
			data: 'tid=' + parseInt(tid),
			success: function(h){
				mydialog.end_loading();
				switch(h.charAt(0)){
					case '0':
						mydialog.alert('Error', h.substring(3));
					break;
					case '1':
						mydialog.alert('Hecho!', h.substring(3));
						mydialog.buttons(true, 'Ir al inicio', false, "location.href = '/comunidades'", false, true);
						break;
				}
				
			},
			error: function(){
				mydialog.error_500('topic.del('+tid+', 2)');
			}
		});
	}
}