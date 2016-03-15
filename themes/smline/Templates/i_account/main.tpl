<div class="profile_main" id="sm-account">
	<div id="my-general" class="main-account">
		<div class="box_title">Configuración general</div>
		<span class="item-info ok margin-top-5" style="display: none"><img src="{$web.icons}/ok.png">Tus cambios han sido guardados y ser&aacute;n aplicados en unos minutos</span>
		<ul>
			<li class="list_item">
				<label for="u_names">Nombre:</label>
				<input type="text" class="inp_text" name="u_names" id="u_names" maxlength="30" value="{$u_info.u_names}">
			</li>
			<li class="list_item">
				<label for="u_surnames">Apellido:</label>
				<input type="text" class="inp_text" name="u_surnames" id="u_surnames" maxlength="30" value="{$u_info.u_surnames}">
			</li>
			<li class="list_item">
				<label for="u_email">E-mail:</label>
				<input type="text" class="inp_text" name="u_email" id="u_email" value="{$u_info.u_email}" disabled="">
			</li>
			<li class="list_item">
				<label for="u_country">País:</label>
				<select class="inp_text" name="u_country" id="u_country" style="width: 262px;">
					<option value="-1">Seleccionar Pa&iacute;s</option>
					{foreach from=$acc_data.paises item=a key=b}
						<option value="{$b}"{if $u_info.u_country == $b} selected="selected"{/if}>{$a}</option>
					{/foreach}
				</select>
			</li>
			<li class="list_item">
				<label for="u_sex">Sexo</label>
				<select class="inp_text" name="u_sexo" id="u_sex" style="width: 262px;">
					<option value="-1">Seleccionar Sexo</option>
						<option value="1"{if $u_info.u_sex == 1} selected="selected"{/if}>Mujer</option>
						<option value="0"{if $u_info.u_sex == 0} selected="selected"{/if}>Hombre</option>
				</select>
			</li>
			<li class="list_item">
				<label style="padding-top:0;">Fecha de nacimiento</label>
				<select class="inp_text" name="u_day" style="width: 60px;">
					<option value="-1">D&iacute;a</option>
					{for $x=1; $x<=31; $x++}
						<option value="{$x}"{if $u_info.u_day == $x} selected="selected"{/if}>{$x}</option>
					{/for}
				</select>
				<select class="inp_text" name="u_month" style="width: 100px;">
					<option value="-1">Mes</option>
					{foreach from=$acc_data.meces item=a key=b}
						<option value="{$b}"{if $u_info.u_month == $b} selected="selected"{/if}>{$a}</option>
					{/foreach}
				</select>
				<select class="inp_text" name="u_year" style="width: 94px;">
					<option value="-1">A&ntilde;o</option>
					{for $x=$r_year; $x>($r_year-110); $x--}
						<option value="{$x}"{if $u_info.u_year == $x} selected="selected"{/if}>{$x}</option>
					{/for}
				</select>
			</li>
		</ul>
		<br />
		<center>
			<input type="button" class="button_1 b_ok" value="Guardar cambios" onclick="account.save_('my-general', $(this));">
		</center>
	</div>
	
	<div id="my-profile" class="main-account" style="display: none">
		<div class="box_title">Configuración del perfil</div>
		<span class="item-info ok margin-top-5" style="display: none"><img src="{$web.icons}/ok.png">Tus cambios han sido guardados y ser&aacute;n aplicados en unos minutos</span>
		<script type="text/javascript" language="javascript" src="{$web.js}/colorPicker.js"></script>
		<link rel="stylesheet" href="{$web.css}/colorPicker.css" type="text/css"></link>
		<ul>
			<li class="list_item">
				<label for="u_bio">Mensaje personal:</label>
				<textarea type="text" class="inp_text" name="u_bio" id="u_bio" maxlength="80">{$u_info.u_bio}</textarea>
			</li>
			<li class="list_item">
				<label for="u_image">Imagen de fondo:</label>
				<input type="text" class="inp_text" name="u_image" id="u_image" maxlength="200" value="{$u_info.u_image}" placeholder="Ingresa la url de la imagen">
				<input name="u_image_repeat" id="u_image_repeat" class="stip" title="Repetir fondo" type="checkbox"{if $u_info.u_image_repeat} checked="checked"{/if}>
			</li>
			<li class="list_item">
				<label for="u_color">Color de fondo:</label>
				<input type="text" class="inp_text" name="u_color" id="u_color" maxlength="7" style="width: 70px;" value="{$u_info.u_color}" onclick="startColorPicker(this)" onkeyup="maskedHex(this)">
			</li>
			<li class="list_item">
				<label for="u_site">Sitio web:</label>
				<input type="text" class="inp_text" name="u_site" id="u_site" maxlength="30" value="{if $u_info.u_site}{$u_info.u_site}{else}http://{/if}">
			</li>
		</ul>
		<br />
		<center>
			<input type="button" class="button_1 b_ok" value="Guardar cambios" onclick="account.save_('my-profile', $(this));">
		</center>
	</div>
	
	<div id="my-options" class="main-account" style="display: none">
		<div class="box_title">Opciones de la cuenta</div>
		<span class="item-info ok margin-top-5" style="display: none"><img src="{$web.icons}/ok.png">Tus cambios han sido guardados y ser&aacute;n aplicados en unos minutos</span>
		<ul>
			<li class="list_item">
				<label for="p_escribir">Escribir en mi perfil</label>
				<select class="inp_text" name="p_escribir" id="p_escribir">
					<option value="0"{if $u_info.options.escribir == 0} selected="selected"{/if}>Todos</option>
					<option value="1"{if $u_info.options.escribir == 1} selected="selected"{/if}>Usuarios que sigo</option>
					<option value="2"{if $u_info.options.escribir == 2} selected="selected"{/if}>Nadie</option>
				</select>
			</li>
			<li class="list_item">
				<label for="p_mensajes">Enviarme mensajes</label>
				<select class="inp_text" name="p_mensajes" id="p_mensajes">
					<option value="0"{if $u_info.options.mensajes == 0} selected="selected"{/if}>Todos</option>
					<option value="1"{if $u_info.options.mensajes == 1} selected="selected"{/if}>Usuarios que sigo</option>
					<option value="2"{if $u_info.options.mensajes == 2} selected="selected"{/if}>Nadie</option>
				</select>
			</li>
			<li class="list_item">
				<label for="n_sounds">Sonidos de notificaciones</label>
				<select class="inp_text" name="n_sounds" id="n_sounds">
					<option value="1"{if $u_info.options.n_sounds == 1} selected="selected"{/if}>Activado</option>
					<option value="0"{if $u_info.options.n_sounds == 0} selected="selected"{/if}>Desactivado</option>
				</select>
			</li>
		</ul>
		<br />
		<center>
			<input type="button" class="button_1 b_ok" value="Guardar cambios" onclick="account.save_('my-options', $(this));">
		</center>
	</div>
	
	<div id="my-notifications" class="main-account" style="display: none">
		<div class="box_title">Configuraci&oacute;n de notificaciones</div>
		<span class="item-info ok margin-top-5" style="display: none"><img src="{$web.icons}/ok.png">Tus cambios han sido guardados y ser&aacute;n aplicados en unos minutos</span>
		
		<span class="item-info margin-top-5"><img src="{$web.icons}/info.png">Configura tus notificaciones a recibir.</span>
		
		<script type="text/javascript">
			$(document).ready(function(){
			{foreach from=$u_info.notifications item=n key=val}
				{if $n}{literal}${/literal}('.notifica-recibe#not{$val}').removeAttr('checked');{/if}
			{/foreach}
			});
		</script>
		
		<li class="list_item clearfix">
			<span class="fil_tit">Posts:</span>
			<div class="list_right_inputs" style="display:none">
				<input name="not1" id="not1" class="notifica-recibe" checked="checked" type="checkbox">
				<label for="not1" class="label-align"></label>
			</div>
			<div class="list_right_inputs">
				<input name="not2" id="not2" class="notifica-recibe" checked="checked" type="checkbox">
				<label for="not2" class="label-align">Posts nuevos de usuarios que sigo</label>
			</div>
			<div class="list_right_inputs">
				<input name="not4" id="not4" class="notifica-recibe" checked="checked" type="checkbox">
				<label for="not4" class="label-align">Comentarios nuevos en mis posts</label>
			</div>
			<div class="list_right_inputs">
				<input name="not5" id="not5" class="notifica-recibe" checked="checked" type="checkbox">
				<label for="not5" class="label-align">Comentarios en posts que sigo</label>
			</div>
			<div class="list_right_inputs">
				<input name="not6" id="not6" class="notifica-recibe" checked="checked" type="checkbox">
				<label for="not6" class="label-align">Puntos recibidos</label>
			</div>
			<div class="list_right_inputs">
				<input name="not9" id="not9" class="notifica-recibe" checked="checked" type="checkbox">
				<label for="not9" class="label-align">Posts recomendados</label>
			</div>
			<div class="list_right_inputs">
				<input name="not10" id="not10" class="notifica-recibe" checked="checked" type="checkbox">
				<label for="not10" class="label-align">Respuestas a mis comentarios en posts</label>
			</div>
			<div class="list_right_inputs">
				<input name="not11" id="not11" class="notifica-recibe" checked="checked" type="checkbox">
				<label for="not11" class="label-align">Votos positivos a mis comentarios en posts</label>
			</div>
			<div class="list_right_inputs">
				<input name="not12" id="not12" class="notifica-recibe" checked="checked" type="checkbox">
				<label for="not12" class="label-align">Votos negativos a mis comentarios en posts</label>
			</div>
		</li>
		
		<li class="list_item clearfix">
			<span class="fil_tit">Im&aacute;genes:</span>
			<div class="list_right_inputs">
				<input name="not16" id="not16" class="notifica-recibe" checked="checked" type="checkbox">
				<label for="not16" class="label-align">Comentarios nuevos en mis im&aacute;genes</label>
			</div>
			<div class="list_right_inputs">
				<input name="not17" id="not17" class="notifica-recibe" checked="checked" type="checkbox">
				<label for="not17" class="label-align">Comentarios en im&aacute;genes que sigo</label>
			</div>
			<div class="list_right_inputs">
				<input name="not18" id="not18" class="notifica-recibe" checked="checked" type="checkbox">
				<label for="not18" class="label-align">Votos positivos en mis im&aacute;genes</label>
			</div>
			<div class="list_right_inputs">
				<input name="not19" id="not19" class="notifica-recibe" checked="checked" type="checkbox">
				<label for="not19" class="label-align">Votos negativos en mis im&aacute;genes</label>
			</div>
			<div class="list_right_inputs">
				<input name="not22" id="not22" class="notifica-recibe" checked="checked" type="checkbox">
				<label for="not22" class="label-align">Im&aacute;genes recomendadas</label>
			</div>
			<div class="list_right_inputs">
				<input name="not23" id="not23" class="notifica-recibe" checked="checked" type="checkbox">
				<label for="not23" class="label-align">Respuestas a mis comentarios en im&aacute;genes</label>
			</div>
			<div class="list_right_inputs">
				<input name="not24" id="not24" class="notifica-recibe" checked="checked" type="checkbox">
				<label for="not24" class="label-align">Votos positivos a mis comentarios en im&aacute;genes</label>
			</div>
			<div class="list_right_inputs">
				<input name="not25" id="not25" class="notifica-recibe" checked="checked" type="checkbox">
				<label for="not25" class="label-align">Votos negativos a mis comentarios en im&aacute;genes</label>
			</div>
		</li>
		
		<li class="list_item clearfix">
			<span class="fil_tit">Estados:</span>
			<div class="list_right_inputs">
				<input name="not28" id="not28" class="notifica-recibe" checked="checked" type="checkbox">
				<label for="not28" class="label-align">Comentarios nuevos en mis estados</label>
			</div>
			<div class="list_right_inputs">
				<input name="not29" id="not29" class="notifica-recibe" checked="checked" type="checkbox">
				<label for="not29" class="label-align">Comentarios nuevos en estados que coment&eacute;</label>
			</div>
			<div class="list_right_inputs">
				<input name="not30" id="not30" class="notifica-recibe" checked="checked" type="checkbox">
				<label for="not30" class="label-align">Votos positivos en mis estados</label>
			</div>
			<div class="list_right_inputs">
				<input name="not31" id="not31" class="notifica-recibe" checked="checked" type="checkbox">
				<label for="not31" class="label-align">Votos positivos en mis comentarios de estados</label>
			</div>
		</li>
		
		<li class="list_item clearfix">
			<span class="fil_tit">Temas:</span>
			<div class="list_right_inputs">
				<input name="not39" id="not39" class="notifica-recibe" checked="checked" type="checkbox">
				<label for="not39" class="label-align">Respuestas nuevas en mis temas</label>
			</div>
			<div class="list_right_inputs">
				<input name="not34" id="not34" class="notifica-recibe" checked="checked" type="checkbox">
				<label for="not34" class="label-align">Respuestas nuevas a mis comentarios</label>
			</div>
			<div class="list_right_inputs">
				<input name="not41" id="not41" class="notifica-recibe" checked="checked" type="checkbox">
				<label for="not41" class="label-align">Votos positivos en mis temas</label>
			</div>
			<div class="list_right_inputs">
				<input name="not42" id="not42" class="notifica-recibe" checked="checked" type="checkbox">
				<label for="not42" class="label-align">Votos negativos en mis temas</label>
			</div>
			<div class="list_right_inputs">
				<input name="not43" id="not43" class="notifica-recibe" checked="checked" type="checkbox">
				<label for="not43" class="label-align">Respuestas nuevas a temas que sigo</label>
			</div>
			<div class="list_right_inputs">
				<input name="not46" id="not46" class="notifica-recibe" checked="checked" type="checkbox">
				<label for="not46" class="label-align">Temas recomendados</label>
			</div>
		</li>
		
		<li class="list_item clearfix">
			<span class="fil_tit">Otras notificaciones:</span>
			<div class="list_right_inputs">
				<input name="not13" id="not13" class="notifica-recibe" checked="checked" type="checkbox">
				<label for="not13" class="label-align">Seguidores nuevos</label>
			</div>
			<div class="list_right_inputs">
				<input name="not44" id="not44" class="notifica-recibe" checked="checked" type="checkbox">
				<label for="not44" class="label-align">Cambios de rango</label>
			</div>
			<div class="list_right_inputs">
				<input name="not45" id="not45" class="notifica-recibe" checked="checked" type="checkbox">
				<label for="not45" class="label-align">Medallas nuevas</label>
			</div>
		</li>
		
		<br />
		<center>
			<input type="button" class="button_1 b_ok" value="Guardar cambios" onclick="account.save_('my-notifications', $(this));">
		</center>
	</div>
	
	<div id="my-blocked" class="main-account" style="display: none">
		<div class="box_title">Usuarios bloqueados</div>
		{if !$u_info.my_blocks}<span class="item-info margin-top-5"><img src="{$web.icons}/info.png">No haz bloqueado usuarios hasta el momento</span>{else}
		<div style="padding:5px;">
			{foreach from=$u_info.my_blocks item=u}
			<div class="list_status clearfix" id="b-user-{$u.u_id}">
				<img src="{$web.avatar}/{$u.u_id}_16.jpg?{$u.u_last_avatar}" class="avatar" />
				<a href="{$web.url}/{$u.u_nick}" style="vertical-align: super;">{$u.u_nick}</a>
				<a onclick="user.set_unblock({$u.u_id}, '{$u.u_nick}');" class="floatR">Desbloquear</a>
			</div>
			{/foreach}
		</div>
		{/if}
		
	</div>
	
	<div id="change-password" class="main-account" style="display: none">
		<div class="box_title">Cambiar contraseña</div>
		<span class="item-info ok margin-top-5" style="display: none"><img src="{$web.icons}/ok.png">Tus cambios han sido guardados y ser&aacute;n aplicados en unos minutos</span>
		<ul>
			<li class="list_item">
				<label for="c_actual">Contraseña actual</label>
				<input type="password" class="inp_text" name="c_actual" id="c_actual" maxlength="20" value="">
			</li>
			<li class="list_item">
				<label for="c_new">Contraseña nueva</label>
				<input type="password" class="inp_text" name="c_new" id="c_new" maxlength="20" value="">
			</li>
			<li class="list_item">
				<label for="c_renew">Repetir contraseña</label>
				<input type="password" class="inp_text" name="c_renew" id="c_renew" maxlength="20" value="">
			</li>
			<li class="list_item">
				<label for="c_close" class="label-align">Cerrar sesiones</label>
				<input name="c_close" id="c_close" class="stip" title="Cerrar todas las sesiones iniciadas con tu cuenta" type="checkbox">
			</li>
		</ul>
		<br />
		<center>
			<input type="button" class="button_1 b_ok" value="Guardar cambios" onclick="account.save_('change-password', $(this));">
		</center>
	</div>
</div>