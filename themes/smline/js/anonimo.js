$(document).ready(function(){
	$('.require-login').click(function(){
		$(this).removeAttr('onclick').removeAttr('href');
		mydialog.show();
		mydialog.close_button = true;
		mydialog.title('Opps!');
		mydialog.body('<p class="is-anon-title">&Uacute;nete a '+global_data.site_title+'</p><p class="is-anon-body">Necesitas tener una cuenta en '+global_data.site_title+' para poder realizar esta acci&oacute;n y tener acceso a muchas otras m&aacute;s aplicaciones.</p><div class="is-anon-buttons"><a class="floatL button_1 b_ok" href="/registro">Crear cuenta</a><a class="floatR button_1 a-login" onclick="mydialog.close();anonimo.show_login();">Ingresar a mi cuenta</a></div>');
		mydialog.buttons(false);
		mydialog.center();
		return;
	});
	$('body').click(function(e){ 
		if($('#dialog-login').css('display') != 'none' && $(e.target).closest('#dialog-login').length == 0 && $(e.target).closest('a.a-login').parent().length == 0 && $(e.target).closest('#gotologin').length == 0) anonimo.show_login();
	});
	
	$('body').keypress(function(e){
		if(e.which == 13 && $('#dialog-login').css('display') == 'block'){
			if($('#login input[name=rl_nick]').val() == '') $('#login input[name=rl_nick]').focus();
			else if($('#login input[name=rl_pass]').val() == '') $('#login input[name=rl_pass]').focus();
			else $('#login .loguearme').click();
		}
	});
});

var anonimo = {
	cache: {},
	show_login: function(){
		if($('#dialog-login').css('display') != 'block'){
			$('#dialog-login').fadeIn(300);
			$('#dialog-login').parent().addClass('active');
			$('#login #il_nick').focus();
		}else{
			anonimo.login_close();
		}
	},
	login_close: function(){
		$('#dialog-login').fadeOut(300);
		$('#dialog-login').parent().removeClass('active');
	},
	show_error: function(txt){
		$('#login #error').show().html(txt);
	},
	hide_error: function(){
		$('#login #error').hide().html('');
	},
	login: function(){
		var nick = $('#login ul li .inp_text#il_nick');
		var pass = $('#login ul li .inp_text#il_pass');
		if(nick.val() == ''){
			this.show_error('Ingresa el nombre de usuario');
			nick.focus();
			return;
		}else if(pass.val() == ''){
			this.show_error('Ingresa la contrase&ntilde;a');
			pass.focus();
			return;
		}
		this.hide_error();
		$.ajax({
				type: 'POST',
				url: '/ajax/anonimo/login',
				data: 'nick=' + nick.val() + '&pass=' + pass.val(),
				success: function(h){
					mydialog.end_loading();
					switch(h.charAt(0)){
						case '0':
							anonimo.show_error(h.substring(3));
						break;
						case '1':
							anonimo.show_error(h.substring(3));
							setTimeout(function(){window.location.reload()}, 500);
						break;
					}
				},
				error: function(){
					anonimo.show_error('Error al procesar lo solicitado, int&eeacute;ntelo de nuevo');
				}
			});
	}
}