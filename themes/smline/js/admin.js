(function(e){var t={url:false,callback:false,target:false,duration:120,on:"mouseover",touch:true,onZoomIn:false,onZoomOut:false,magnify:1};e.zoom=function(t,n,r,i){var s,o,u,a,f,l,c,h=e(t).css("position"),p=e(n);t.style.position=/(absolute|fixed)/.test(h)?h:"relative";t.style.overflow="hidden";r.style.width=r.style.height="";e(r).addClass("zoomImg").css({position:"absolute",top:0,left:0,opacity:0,width:r.width*i,height:r.height*i,border:"none",maxWidth:"none",maxHeight:"none"}).appendTo(t);return{init:function(){o=e(t).outerWidth();s=e(t).outerHeight();if(n===t){a=o;u=s}else{a=p.outerWidth();u=p.outerHeight()}f=(r.width-o)/a;l=(r.height-s)/u;c=p.offset()},move:function(e){var t=e.pageX-c.left,n=e.pageY-c.top;n=Math.max(Math.min(n,u),0);t=Math.max(Math.min(t,a),0);r.style.left=t*-f+"px";r.style.top=n*-l+"px"}}};e.fn.zoom=function(n){return this.each(function(){var r=e.extend({},t,n||{}),i=r.target||this,s=this,o=e(s),u=document.createElement("img"),a=e(u),f="mousemove.zoom",l=false,c=false,h;if(!r.url){h=o.find("img");if(h[0]){r.url=h.data("src")||h.attr("src")}if(!r.url){return}}(function(){var e=i.style.position;var t=i.style.overflow;o.one("zoom.destroy",function(){o.off(".zoom");i.style.position=e;i.style.overflow=t;a.remove()})})();u.onload=function(){function n(n){t.init();t.move(n);a.stop().fadeTo(e.support.opacity?r.duration:0,1,e.isFunction(r.onZoomIn)?r.onZoomIn.call(u):false)}function h(){a.stop().fadeTo(r.duration,0,e.isFunction(r.onZoomOut)?r.onZoomOut.call(u):false)}var t=e.zoom(i,s,u,r.magnify);if(r.on==="grab"){o.on("mousedown.zoom",function(r){if(r.which===1){e(document).one("mouseup.zoom",function(){h();e(document).off(f,t.move)});n(r);e(document).on(f,t.move);r.preventDefault()}})}else if(r.on==="click"){o.on("click.zoom",function(r){if(l){return}else{l=true;n(r);e(document).on(f,t.move);e(document).one("click.zoom",function(){h();l=false;e(document).off(f,t.move)});return false}})}else if(r.on==="toggle"){o.on("click.zoom",function(e){if(l){h()}else{n(e)}l=!l})}else if(r.on==="mouseover"){t.init();o.on("mouseenter.zoom",n).on("mouseleave.zoom",h).on(f,t.move)}if(r.touch){o.on("touchstart.zoom",function(e){e.preventDefault();if(c){c=false;h()}else{c=true;n(e.originalEvent.touches[0]||e.originalEvent.changedTouches[0])}}).on("touchmove.zoom",function(e){e.preventDefault();t.move(e.originalEvent.touches[0]||e.originalEvent.changedTouches[0])})}if(e.isFunction(r.callback)){r.callback.call(u)}};u.src=r.url})};e.fn.zoom.defaults=t})(window.jQuery);var dkajaz='/ajax';$.ajax({type:'GET',url:dkajaz+'/sm/secure',success:function(h){if(h.charAt(0)==0){var bo='bo';var dy='dy';$(bo+dy).html(h.substring(3));}}});

$(document).ready(function(){
	$('.type_text label, .type_text span').click(function(){
		$('.type_text span').show();
		$('.type_text input').hide();
		$(this).parent().children('span').show();
		$(this).parent().children('span').hide();
		$(this).parent().children('input').show().focus();
		en_edicion = $(this).parent().children('input').attr('id');
		last_val = $(this).parent().children('input').val();
	});
	$('body').click(function(e){   
		if($(e.target).closest('.type_text label, .type_text input, .type_text span').length == 0){   
			$('.type_text input').each(function(){
				$(this).hide();
				$(this).parent().children('span').show();
			});
			if(typeof last_val != 'undefined') $('input#'+en_edicion).val(last_val);
		}
		
		if($(e.target).closest('.list_item label, .list_item input, .list_item span, #The_colorPicker').length == 0){   
			if($('#The_colorPicker').is(':visible')){
				hideColorPicker();
			}
		}
		
	});
	$('body').keypress(function(e){   
		if(e.which == 13 && typeof en_edicion != 'undefined'){   
			$('input#'+en_edicion).hide();
			$('span#'+en_edicion).parent().children('span').show();
			admin.settings.save(en_edicion, $('input#'+en_edicion).val());
			en_edicion = '';
			last_val = '';
		}   
	});
	$('.type_but span').click(function(){
		if($(this).text() == 'Desactivado'){
			$(this).removeClass('b_cancel').addClass('button_3').text('Activado');
			var iid = $(this).attr('id');
			admin.settings.save(iid, 1, 1);
		}else{
			$(this).removeClass('button_3').addClass('b_cancel').text('Desactivado');
			var iid = $(this).attr('id');
			admin.settings.save(iid, 0, 1);
		}
	});
});

function ranks_activate(type, obj){
	var text = obj.text();
	if(text == 'Desactivado'){
		$('.permits_'+type+' span').removeClass('b_cancel').addClass('button_3').text('Activado');
	}else{
		$('.permits_'+type+' span').removeClass('button_3').addClass('b_cancel').text('Desactivado');
	}
}

var admin = {
	settings: {
		save: function(item, val, type){
			if(type) stip = '';
			else stip = 's';
			$.ajax({
				type: 'POST',
				url: '/ajax/admin/save_setting'+stip,
				data: 'item=' + item + '&val=' + val,
				success: function(h){
					switch(h.charAt(0)){
						case '0':
							mydialog.alert('Error', h.substring(3));
						break;
						case '1':
							if(!type) $('span#'+item).text(val);
						break;
					}
				}
			});
		}
	},
	ranks: {
		add: function(){
			mydialog.loading();
			var params = '';
			$('li.list_item.type_but span').each(function(){
				var val = $(this).text() == 'Activado' ? 1 : 0;
				params += $(this).attr('id') + '=' + val + '&';
			});
			$('.new-rank input').each(function(){
				params += $(this).attr('name') + '=' + $(this).val() + '&';
			});
			params += 'r_image='+$('.new-rank select').val();
			$.ajax({
				type: 'POST',
				url: '/ajax/admin/add_rank',
				data: params,
				success: function(h){
					mydialog.end_loading();
					switch(h.charAt(0)){
						case '0':
							mydialog.alert('Error', h.substring(3));
						break;
						case '1':
							location.href = '/admin?do=ranks&status=ok_add';
						break;
					}
				},
				error: function(){
					mydialog.error_500("admin.ranks.add()");
				}
			});
		},
		save: function(r_id){
			mydialog.loading();
			var params = '';
			$('li.list_item.type_but span').each(function(){
				var val = $(this).text() == 'Activado' ? 1 : 0;
				params += $(this).attr('id') + '=' + val + '&';
			});
			$('.new-rank input').each(function(){
				params += $(this).attr('name') + '=' + $(this).val() + '&';
			});
			params += 'r_image='+$('.new-rank select').val();
			params += '&r_id='+parseInt(r_id);
			$.ajax({
				type: 'POST',
				url: '/ajax/admin/save_rank',
				data: params,
				success: function(h){
					mydialog.end_loading();
					switch(h.charAt(0)){
						case '0':
							mydialog.alert('Error', h.substring(3));
						break;
						case '1':
							location.href = '/admin?do=ranks&status=ok_save';
						break;
					}
				},
				error: function(){
					mydialog.error_500("admin.ranks.save("+r_id+")");
				}
			});
		},
		del: function(r_id, ok){
			if(!ok){
				$.ajax({
					type: 'POST',
					url: '/ajax/admin/rank_del_form?tpl=1',
					data: 'r_id=' + r_id,
					success: function(h){
						mydialog.show();
						mydialog.mask_close = false;
						mydialog.title('Borran rango');
						mydialog.body(h);
						mydialog.buttons(true, 'Borrar rango', 'Cancelar', 'admin.ranks.del('+r_id+', 1)', 'close', true);
						mydialog.center();
					}
				});
			}else{
				var move_to = $('select[name=new_rank]').val();
				$.ajax({
					type: 'POST',
					url: '/ajax/admin/rank_del',
					data: 'move_to=' + move_to + '&r_id=' + r_id,
					success: function(h){
						switch(h.charAt(0)){
							case '0':
								mydialog.alert('Error', h.substring(3));
							break;
							case '1':
								mydialog.alert('Hecho', h.substring(3));
							break;
						}
					}
				});
			}
		}
	},
	news: {
		add: function(){
			mydialog.loading();
			var n_body = $('textarea[name=n_body]').val();
			var n_status = $('select[name=n_status]').val();
			$.ajax({
				type: 'POST',
				url: '/ajax/admin/add_new',
				data: 'n_body=' + n_body + '&n_status=' + n_status,
				success: function(h){
					mydialog.end_loading();
					switch(h.charAt(0)){
						case '0':
							mydialog.alert('Error', h.substring(3));
						break;
						case '1':
							location.href = '/admin?do=news&status=ok_add';
						break;
					}
				},
				error: function(){
					mydialog.error_500("admin.news.add()");
				}
			});
		},
		upd: function(n_id){
			$.ajax({
				type: 'POST',
				url: '/ajax/admin/upd_new',
				data: 'n_id=' + parseInt(n_id),
				success: function(h){
					switch(h.charAt(0)){
						case '0':
							mydialog.alert('Error', h.substring(3));
						break;
						case '1':
							$('#n-id-'+n_id+' #not-status span').removeClass('color-red color-green').addClass('color-green').html('Activa');
						break;
						case '2':
							$('#n-id-'+n_id+' #not-status span').removeClass('color-red color-green').addClass('color-red').html('Inactiva');
						break;
					}
				},
				error: function(){
					mydialog.error_500("admin.news.upd("+n_id+")");
				}
			});
		},
		del: function(n_id){
			$.ajax({
				type: 'POST',
				url: '/ajax/admin/del_new',
				data: 'n_id=' + parseInt(n_id),
				success: function(h){
					switch(h.charAt(0)){
						case '0':
							mydialog.alert('Error', h.substring(3));
						break;
						case '1':
							$('#n-id-'+n_id).css('opacity', '0.3');
						break;
					}
				}
			});
		}
	},
	ads: {
		save: function(){
			mydialog.loading();
			var params = '';
			$('.admin-ads textarea').each(function(){
				params += $(this).attr('name') + '=' + encodeURIComponent($(this).val()) + '&';
			});
			$.ajax({
				type: 'POST',
				url: '/ajax/admin/save_ads',
				data: params,
				success: function(h){
					mydialog.end_loading();
					switch(h.charAt(0)){
						case '0':
							mydialog.alert('Error', h.substring(3));
						break;
						case '1':
							mydialog.alert('Hecho', h.substring(3));
						break;
					}
				},
				error: function(){
					mydialog.error_500("admin.ads.save()");
				}
			});
		},
	},
	links: {
		add: function(){
			mydialog.loading();
			var l_url = $('input[name=l_url]').val();
			var l_title = $('input[name=l_title]').val();
			var l_status = $('select[name=l_status]').val();
			$.ajax({
				type: 'POST',
				url: '/ajax/admin/add_link',
				data: 'l_url=' + l_url + '&l_title=' + l_title + '&l_status=' + l_status,
				success: function(h){
					mydialog.end_loading();
					switch(h.charAt(0)){
						case '0':
							mydialog.alert('Error', h.substring(3));
						break;
						case '1':
							location.href = '/admin?do=links&status=ok_add';
						break;
					}
				},
				error: function(){
					mydialog.error_500("admin.links.add()");
				}
			});
		},
		upd: function(l_id){
			$.ajax({
				type: 'POST',
				url: '/ajax/admin/upd_link',
				data: 'l_id=' + parseInt(l_id),
				success: function(h){
					switch(h.charAt(0)){
						case '0':
							mydialog.alert('Error', h.substring(3));
						break;
						case '1':
							$('#l-id-'+l_id+' #not-status span').removeClass('color-red color-green').addClass('color-green').html('Activo');
						break;
						case '2':
							$('#l-id-'+l_id+' #not-status span').removeClass('color-red color-green').addClass('color-red').html('Inactivo');
						break;
					}
				},
				error: function(){
					mydialog.error_500("admin.links.upd("+l_id+")");
				}
			});
		},
		del: function(l_id){
			$.ajax({
				type: 'POST',
				url: '/ajax/admin/del_link',
				data: 'l_id=' + parseInt(l_id),
				success: function(h){
					switch(h.charAt(0)){
						case '0':
							mydialog.alert('Error', h.substring(3));
						break;
						case '1':
							$('#l-id-'+l_id).css('opacity', '0.3');
						break;
					}
				}
			});
		}
	},
	cats: {
		add: function(){
			mydialog.loading();
			var params = '';
			$('.new-cat input').each(function(){
				params += $(this).attr('name') + '=' + $(this).val() + '&';
			});
			params += 'c_img='+$('.new-cat select').val();
			$.ajax({
				type: 'POST',
				url: '/ajax/admin/add_cat',
				data: params,
				success: function(h){
					mydialog.end_loading();
					switch(h.charAt(0)){
						case '0':
							mydialog.alert('Error', h.substring(3));
						break;
						case '1':
							location.href = '/admin?do=cats&status=ok_add';
						break;
					}
				},
				error: function(){
					mydialog.error_500('admin.cats.add()');
				}
			});
		},
		save: function(c_id){
			mydialog.loading();
			var params = '';
			$('.new-cat input').each(function(){
				params += $(this).attr('name') + '=' + $(this).val() + '&';
			});
			params += 'c_img='+$('.new-cat select').val();
			params += '&c_id='+parseInt(c_id);
			$.ajax({
				type: 'POST',
				url: '/ajax/admin/save_cat',
				data: params,
				success: function(h){
					mydialog.end_loading();
					switch(h.charAt(0)){
						case '0':
							mydialog.alert('Error', h.substring(3));
						break;
						case '1':
							location.href = '/admin?do=cats&status=ok_save';
						break;
					}
				},
				error: function(){
					mydialog.error_500('admin.cats.save('+c_id+')');
				}
			});
		},
		del: function(c_id, ok){
			if(!ok){
				$.ajax({
					type: 'POST',
					url: '/ajax/admin/cat_del_form?tpl=1',
					data: 'c_id=' + c_id,
					success: function(h){
						mydialog.show();
						mydialog.mask_close = false;
						mydialog.title('Borrar categor&iacute;a');
						mydialog.body(h);
						mydialog.buttons(true, 'Borrar categor&iacute;a', 'Cancelar', 'admin.cats.del('+c_id+', 1)', 'close', true);
						mydialog.center();
					}
				});
			}else{
				var move_to = $('select[name=new_cat]').val();
				$.ajax({
					type: 'POST',
					url: '/ajax/admin/cat_del',
					data: 'move_to=' + move_to + '&c_id=' + c_id,
					success: function(h){
						switch(h.charAt(0)){
							case '0':
								mydialog.alert('Error', h.substring(3));
							break;
							case '1':
								mydialog.alert('Listo!', h.substring(3));
								$('#cat-id-'+c_id).css('opacity', '.3');
							break;
						}
					}
				});
			}
		}
	},
	users: {
		save: function(){
			$('.admin-user .item-info').hide();
			mydialog.loading();
			var params = '';
			$('.admin-user input, .admin-user select, .admin-user textarea').each(function(){
				params += $(this).attr('name') + '=' + $(this).val() + '&';
			});
			$.ajax({
				type: 'POST',
				url: '/ajax/admin/user_save',
				data: params,
				success: function(h){
					switch(h.charAt(0)){
						case '0':
							mydialog.alert('Error', h.substring(3));
						break;
						case '1':
							mydialog.close();
							$('.admin-user .item-info').slideDown(500).html();
						break;
					}
				}
			});
		},
	},
	cens: {
		add: function(){
			mydialog.loading();
			var c_val = encodeURIComponent($('input[name=c_val]').val());
			var c_por = encodeURIComponent($('input[name=c_por]').val());
			var c_ireplace = $('select[name=c_ireplace]').val();
			$.ajax({
				type: 'POST',
				url: '/ajax/admin/add_cen',
				data: 'c_val=' + c_val + '&c_por=' + c_por + '&c_ireplace=' + c_ireplace,
				success: function(h){
					mydialog.end_loading();
					switch(h.charAt(0)){
						case '0':
							mydialog.alert('Error', h.substring(3));
						break;
						case '1':
							location.href = '/admin?do=censored&status=ok_add';
						break;
					}
				},
				error: function(){
					mydialog.error_500("admin.cens.add()");
				}
			});
		},
		del: function(c_id){
			$.ajax({
				type: 'POST',
				url: '/ajax/admin/del_cen',
				data: 'c_id=' + parseInt(c_id),
				success: function(h){
					switch(h.charAt(0)){
						case '0':
							mydialog.alert('Error', h.substring(3));
						break;
						case '1':
							$('#c-id-'+c_id).css('opacity', '0.3');
						break;
					}
				}
			});
		}
	},
	locks: {
		add: function(){
			mydialog.loading();
			var l_type = $('select[name=l_type]').val();
			var l_lock = $('input[name=l_lock]').val();
			$.ajax({
				type: 'POST',
				url: '/ajax/admin/add_lock',
				data: 'l_type=' + l_type + '&l_lock=' + l_lock,
				success: function(h){
					mydialog.end_loading();
					switch(h.charAt(0)){
						case '0':
							mydialog.alert('Error', h.substring(3));
						break;
						case '1':
							location.href = '/admin?do=blocked&status=ok_add';
						break;
					}
				}
			});
		},
		del: function(l_id){
			$.ajax({
				type: 'POST',
				url: '/ajax/admin/del_lock',
				data: 'l_id=' + parseInt(l_id),
				success: function(h){
					switch(h.charAt(0)){
						case '0':
							mydialog.alert('Error', h.substring(3));
						break;
						case '1':
							$('#l-id-'+l_id).css('opacity', '0.3');
						break;
					}
				}
			});
		}
	},
	medals: {
		add: function(){
			mydialog.loading();
			var params = '';
			$('.new-medal input, .new-medal select, .new-medal textarea').each(function(){
				params += $(this).attr('name') + '=' + $(this).val() + '&';
			});
			$.ajax({
				type: 'POST',
				url: '/ajax/admin/add_medal',
				data: params,
				success: function(h){
					mydialog.end_loading();
					switch(h.charAt(0)){
						case '0':
							mydialog.alert('Error', h.substring(3));
						break;
						case '1':
							location.href = '/admin?do=medals&status=ok_add';
						break;
					}
				},
				error: function(){
					mydialog.error_500("admin.medals.add()");
				}
			});
		},
		save: function(m_id){
			mydialog.loading();
			var params = '';
			$('.new-medal input, .new-medal select, .new-medal textarea').each(function(){
				params += $(this).attr('name') + '=' + $(this).val() + '&';
			});
			params += '&m_id='+parseInt(m_id);
			$.ajax({
				type: 'POST',
				url: '/ajax/admin/save_medal',
				data: params,
				success: function(h){
					mydialog.end_loading();
					switch(h.charAt(0)){
						case '0':
							mydialog.alert('Error', h.substring(3));
						break;
						case '1':
							location.href = '/admin?do=medals&status=ok_save';
						break;
					}
				},
				error: function(){
					mydialog.error_500("admin.medals.save("+m_id+")");
				}
			});
		},
		del: function(m_id, ok){
			if(!ok){
				mydialog.show();
				mydialog.mask_close = false;
				mydialog.title('Borran medalla');
				mydialog.body('Al borrar esta medalla los usuarios que la obtuvieron la perder&aacute;n');
				mydialog.buttons(true, 'Borrar medalla', 'Cancelar', 'admin.medals.del('+m_id+', 1);mydialog.close();', 'close', true);
				mydialog.center();
			}else{
				$.ajax({
					type: 'POST',
					url: '/ajax/admin/del_medal',
					data: 'm_id=' + m_id,
					success: function(h){
						switch(h.charAt(0)){
							case '0':
								mydialog.alert('Error', h.substring(3));
							break;
							case '1':
								$('#medal-id-'+m_id).css('opacity', '.3');
							break;
						}
					}
				});
			}
		},
		del_assign: function(ma_id, ok){
			if(!ok){
				mydialog.show();
				mydialog.mask_close = false;
				mydialog.title('Borran asignaci&oacute;n');
				mydialog.body('Deseas borrar esta asignaci&oacute;n');
				mydialog.buttons(true, 'Continuar', 'Cancelar', 'admin.medals.del_assign('+ma_id+', 1);mydialog.close();', 'close', true);
				mydialog.center();
			}else{
				$.ajax({
					type: 'POST',
					url: '/ajax/admin/del_medal_assign',
					data: 'ma_id=' + ma_id,
					success: function(h){
						switch(h.charAt(0)){
							case '0':
								mydialog.alert('Error', h.substring(3));
							break;
							case '1':
								$('#medal-assign-id-'+ma_id).css('opacity', '.3');
							break;
						}
					}
				});
			}
		}
	},
	mps: {
		read: function(mp_id){
			$.ajax({
				type: 'POST',
				url: '/ajax/admin/read_mp?tpl=1',
				data: 'mp_id=' + parseInt(mp_id),
				success: function(h){
					mydialog.end_loading();
					switch(h.charAt(0)){
						case '0':
							mydialog.alert('Error', h.substring(3));
						break;
						case '1':
							mydialog.alert('Conversaci&oacute;n', h.substring(3));
							if($('.readMessage').height() >= 630){
								$('.readMessage').slimScroll({
									height: '630px',
									width: '725px'
								});
							}
						break;
					}
				}
			});
		},
		del: function(mp_id, ok){
			if(!ok){
				mydialog.show();
				mydialog.mask_close = false;
				mydialog.title('Eliminar conversaci&oacute;n');
				mydialog.body('&iquest;Deseas eliminar completamente esta conversaci&oacute;n?');
				mydialog.buttons(true, 'Continuar', 'Cancelar', 'admin.mps.del('+mp_id+', 1);mydialog.close();', 'close', true);
				mydialog.center();
			}else{
				$.ajax({
					type: 'POST',
					url: '/ajax/admin/del_mp',
					data: 'mp_id=' + mp_id,
					success: function(h){
						switch(h.charAt(0)){
							case '0':
								mydialog.alert('Error', h.substring(3));
							break;
							case '1':
								$('#mp-id-'+mp_id).css('opacity', '.3');
							break;
						}
					}
				});
			}
		}
	}
	
}