{include file='includes/header.tpl'}

<div id="register_content" class="clearfix">
	
	<div id="register_left">
		<h2>&Uacute;nete a {$web.title}</h2>
		<p>Por favor, toma un momento para ser parte de nuestra familia</p>
		<hr />
		<div id="register_form">
			<ul>
				<li class="list_item">
					<label for="i_nick">Nick:</label>
					<input type="text" tabindex="1" id="i_nick" class="inp_text" name="r_nick" maxlength="16" value="" autocomplete="off">
					<div id="register_helper">
						<span class="pico"></span>
						<span class="text"></span>
					</div>
				</li>
				<li class="list_item">
					<label for="i_email">Email:</label>
					<input type="text" tabindex="2" id="i_email" class="inp_text" name="r_email" maxlength="40" value="" autocomplete="off">
					<div id="register_helper">
						<span class="pico"></span>
						<span class="text"></span>
					</div>
				</li>
				<li class="list_item">
					<label for="i_pass">Contrase&ntilde;a:</label>
					<input type="password" tabindex="3" id="i_pass" class="inp_text" name="r_pass" maxlength="20" value="" autocomplete="off">
					<div id="register_helper">
						<span class="pico"></span>
						<span class="text"></span>
					</div>
				</li>
				{*<li class="list_item">
					<label for="i_repass">Otra vez:</label>
					<input type="password" tabindex="4" id="i_repass" class="inp_text" name="r_repass" maxlength="20" value="" autocomplete="off">
					<div id="register_helper">
						<span class="pico"></span>
						<span class="text"></span>
					</div>
				</li>*}
				<li class="list_item">
					<label for="i_pais">Pais</label>
					<select tabindex="5" id="i_pais" class="inp_text" name="r_pais" style="width: 262px;">
						<option value="-1">Seleccionar Pa&iacute;s</option>
						{foreach from=$register_data.paises item=a key=b}
							<option value="{$b}">{$a}</option>
						{/foreach}
					</select>
					<div id="register_helper">
						<span class="pico"></span>
						<span class="text"></span>
					</div>
				</li>
				<li class="list_item">
					<label for="i_sexo">Sexo</label>
					<select tabindex="6" id="i_sexo" class="inp_text" name="r_sexo" style="width: 262px;">
						<option value="-1">Seleccionar Sexo</option>
							<option value="1">Mujer</option>
							<option value="0">Hombre</option>
					</select>
					<div id="register_helper">
						<span class="pico"></span>
						<span class="text"></span>
					</div>
				</li>
				<li class="list_item">
					<label for="i_dia" style="padding-top:0;">Fecha de nacimiento</label>
					<select tabindex="7" id="i_dia" class="inp_text" name="r_dia" style="width: 60px;">
						<option value="-1">D&iacute;a</option>
						{for $x=1; $x<=31; $x++}
							<option value="{$x}">{$x}</option>
						{/for}
					</select>
					<select tabindex="8" id="i_mes" class="inp_text" name="r_mes" style="width: 110px;">
						<option value="-1">Mes</option>
						{foreach from=$register_data.meces item=a key=b}
							<option value="{$b}">{$a}</option>
						{/foreach}
					</select>
					<select tabindex="9" id="i_ano" class="inp_text" name="r_ano" style="width: 84px;">
						<option value="-1">A&ntilde;o</option>
						{for $x=$r_year; $x>($r_year-110); $x--}
							<option value="{$x}">{$x}</option>
						{/for}
					</select>
					<div id="register_helper">
						<span class="pico"></span>
						<span class="text"></span>
					</div>
				</li>
				<li class="list_item">
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
					<label for="recaptcha_response_field" style="padding-top: 25px;">C&oacute;digo de seguridad<br />(<small><a onclick="Recaptcha.reload();">Cambiar</a></small>)</label>
					<div id="recaptcha_image" class="floatL"></div>
					<input type="text" tabindex="10" id="recaptcha_response_field" class="inp_text" name="recaptcha_response_field" maxlength="40" value="">
					<div id="register_helper" style="left: 410px;">
						<span class="pico"></span>
						<span class="text"></span>
					</div>
				</li>
				
		
			</ul>
			<hr />
			<p style="font-size:11px; font-family:Georgia; color: #999;text-align:center">Al registrarme acepto los <a style="font-family: Georgia" href="/terminos-y-condiciones" target="_blank">términos y condiciones</a> del sitio</p>
			<center><input class="registrarme" style="color:#fff !important;" type="submit" name="regSubmit" value="Registrarme" role="button" aria-disabled="false"></center>
		</div>
		
	</div>
	
	<div id="register_right">
		<span class="register_info" style="color: #7A7A7A;">&#10004; Somos m&aacute;s de <b id="miembros_registrados">{$stats.members|number_format}</b> miembros registrados.<br>
		&#10004; Son más de <b id="articulos_calificados">{$stats.posts|number_format}</b> artículos calificados.<br>
		&#10004; Somos una red amigable con Google.
		</span>
		<hr>
		<img src="{$web.img}/register-back.png" class="floatL" style="margin-right: 10px;" />
		<span class="register_info" style="color: #7A7A7A;">Regístrate en <b>{$web.title}</b> y empieza a interactuar con la comunidad, compartir, buscar, votar y recomendar contenidos de tu interés.</span>
		<div id="register_options">
			<ul>
				<li><a href="{$web.url}/recover" title="&iquest;No puedes ingresar a tu cuenta?">No puedo ingresar a mi cuenta</a></li>
				<li><a onclick="anonimo.show_login();" title="&iquest;Ya eres miembro?" id="gotologin">Ya soy miembro</a></li>
			</ul>
		</div>
	</div>

</div>

{include file='includes/footer.tpl'}