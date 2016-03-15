{include file='includes/header.tpl'}

<div id="main-col" style="margin-right:5px;">
	<div class="box">
		<div class="box_title">Recuperar mi cuenta</div>
		<div class="box_body install_main">
		
			<form action="{$web.url}/recover" method="post" name="send_email">
					<p>
					
					<span class="form_label">Email o nick</span>
					<input type="text" class="input_text" name="email" placeholder="Direcci&oacute;n de correo o nombre de usuario" tabindex="0">
					
					<div class="form_separador"></div>
					
					<script type="text/javascript">
					{literal}
					$.getScript("http://www.google.com/recaptcha/api/js/recaptcha_ajax.js", function(){
						Recaptcha.create('6LdHQvASAAAAAMvSKMC43DPFdr1fBTf3oKtPrUwq', 'recaptcha_ajax', {
							theme:'custom', lang:'es', tabindex:'13', custom_theme_widget: 'recaptcha_ajax',
							callback: function(){
								
							}
						});
					});
					{/literal}
					</script>
					
					<span class="form_label">Código de seguridad(<small><a onclick="Recaptcha.reload();">Cambiar</a></small>)</span>
					<div id="recaptcha_image"></div>
					<input type="text" class="input_text" name="recaptcha_response_field" id="recaptcha_response_field" placeholder="Ingresa el código de la imagen" tabindex="1">

					</p>
					<div class="foot_buttons">
						<center>
							<a class="button_next" onclick="document.forms.send_email.submit()">Continuar</a>
						</center>
					</div>
			</form>
				
		</div>
	</div>
</div>

<div id="sidebar">
	<div class="box">
		<div class="box_title">¿Cómo recuperar mi cuenta?</div>
		<div class="box_body">
		
			<div class="emptyData">Si no puedes acceder a tu cuenta, <strong>{$web.title}</strong> te permite recuperar tu cuenta y tus datos fácilmente. Solo tienes que ingresar tu dirección de correo o nombre de usuario para que nosotros te enviemos una nueva contraseña.</div>
			
		</div>
	</div>
</div>

{include file='includes/footer.tpl'}