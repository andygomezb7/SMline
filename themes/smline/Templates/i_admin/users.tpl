{if $action == ''}
<div class="box">
	<div class="box_title">Usuarios</div>
	<div class="box_body clearfix admin-settings">
		{if $status == 'ok_add'}<span class="item-info ok margin-top-5"><img src="{$web.icons}/ok.png">Tus cambios han sido guardados</span>
		<hr />{/if}
		
		<form class="admin_search" action="/admin" name="search" method="get">
			<input type="text" class="inp_text" name="qu" placeholder="Buscar usuario..." value="{$qu}">
			<input type="hidden" name="do" value="users" />
			<input type="submit" class="button_1" value="Buscar">
		</form>
		
		<hr />
		
		<table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="780" align="center">
            <thead>
				<tr>
					<th>Usuario</th>
					<th>Email</th>
					<th>Última actividad</th>
					<th>Registro</th>
					<th>IP</th>
					<th>Estado</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				{foreach from=$adm_users.list item=u}
				<tr id="u-id-{$u.u_id}">
					<td><a href="{$web.url}/{$u.u_nick}" target="_blank" style="color:#{$u.r_color}" class="stip" title="{$u.r_name}">{$u.u_nick}</a></td>
					<td>{$u.u_email}</td>
					<td><span class="stip" title="{$u.u_last_active|date_format:"%d/%m/%Y %I:%M %p"}">{$u.u_last_active|hace}</span></td>
					<td><span class="stip" title="{$u.u_date|date_format:"%d/%m/%Y %I:%M %p"}">{$u.u_date|hace}</span></td>
					<td><a href="http://www.geoiptool.com/es/?IP={$u.u_last_ip}" target="_blank">{$u.u_last_ip}</a></td>
					<td id="not-status">
						{if $u.u_status == 1}<span class="color-green">Activo</span>
						{elseif $u.u_status == 2}<span class="color-indigo">Inactivo</span>
						{elseif $u.u_status == 3}<span class="color-red">Baneado</span>{/if}
					</td>
					<td class="admin_actions">
						<a class="stip" title="editar usuario" href="{$web.url}/admin?do=users&action=edit&uid={$u.u_id}"><img src="{$web.icons}/editar.png"></a>
					</td>
				</tr>
				{/foreach}
			</tbody>
		</table>
		{$adm_users.pages}

		
	</div>
</div>
{elseif $action == 'edit'}
<div class="box">
	<div class="box_title">Editar a {$u_info.u_nick}</div>
	<div class="box_body clearfix admin-settings admin-user">
		
		<span class="item-info ok margin-top-5" style="display:none;margin-bottom: 10px;"><img src="{$web.icons}/ok.png">Los cambios serán aplicados en los próximos minutos</span>
		
		<div class="spoiler">
			<a class="spoiler-title" onclick="$('.spoiler-body').slideUp();spoiler($(this))">General</a>
			<div class="spoiler-body" style="">
				<ul>
					<li class="list_item clearfix">
						<label for="u_nick">Nombre de usuario:</label>
						<input type="text" id="u_nick" class="inp_text" name="u_nick" style="display:inline-block;" value="{$u_info.u_nick}">
					</li>
					
					<li class="list_item clearfix">
						<label for="u_email">Email:</label>
						<input type="text" id="u_email" class="inp_text" name="u_email" style="display:inline-block;" value="{$u_info.u_email}">
					</li>
					
					<li class="list_item clearfix">
						<label>Rango:</label>
						<span style="color:#{$u_info.r_color}">{$u_info.r_name}</span>
					</li>
					<li class="list_item clearfix">
						<label>Última actividad:</label>
						<span>{$u_info.u_last_active|hace}</span>
					</li>
					
					
					<li class="list_item clearfix">
						<label for="u_rank">Cambiar rango:</label>	
						<select id="u_rank" name="u_rank" class="inp_text">
							{foreach from=$ranks_e item=r}
							<option value="{$r.r_id}"{if $r.r_id == $u_info.r_id} selected=""{/if}>{$r.r_name}</option>
							{/foreach}
							{foreach from=$ranks_n item=r}
							<option value="{$r.r_id}"{if $r.r_id == $u_info.r_id} selected=""{/if}>{$r.r_name}</option>
							{/foreach}
						</select>
					</li>

				</ul>
			</div>
		</div>
		
		<hr />
		
		<div class="spoiler">
			<a class="spoiler-title" onclick="$('.spoiler-body').slideUp();spoiler($(this))">Opciones avanzadas</a>
			<div class="spoiler-body" style="display:none">
			
				<ul>
					<li class="list_item clearfix">
						<label for="u_names">Nombre(s):</label>
						<input type="text" id="u_names" class="inp_text" name="u_names" style="display:inline-block;" value="{$u_info.u_names}">
					</li>
					
					<li class="list_item clearfix">
						<label for="u_surnames">Apellido(s):</label>
						<input type="text" id="u_surnames" class="inp_text" name="u_surnames" style="display:inline-block;" value="{$u_info.u_surnames}">
					</li>
				
					<li class="list_item clearfix">
						<label for="u_bio">Sobre {$u_info.u_nick}:</label>
						<textarea id="u_bio" class="inp_text" name="u_bio" style="display:inline-block;">{$u_info.u_bio}</textarea>
					</li>
					
					<li class="list_item clearfix">
						<label for="u_site">Sitio web:</label>
						<input type="text" id="u_site" class="inp_text" name="u_site" style="display:inline-block;" value="{$u_info.u_site}">
					</li>
					
					<li class="list_item clearfix">
						<label for="u_image">Imagen de fondo:</label>
						<input type="text" id="u_image" class="inp_text" name="u_image" style="display:inline-block;" value="{$u_info.u_image}">
					</li>
					
					<li class="list_item clearfix">
						<label for="u_color">Color de fondo:</label>
						<input type="text" id="u_color" class="inp_text" name="u_color" style="display:inline-block;width: 70px;" value="{$u_info.u_color}">
					</li>

				</ul>
				
			</div>
		</div>
		
		<hr />
		
		<div class="spoiler">
			<a class="spoiler-title" onclick="$('.spoiler-body').slideUp();spoiler($(this))">Cambiar contraseña</a>
			<div class="spoiler-body" style="display:none">
			
				<ul>
					<li class="list_item clearfix">
						<label for="u_pass">Contraseña nueva:</label>
						<input type="password" id="u_pass" class="inp_text" name="u_pass" style="display:inline-block;" value="">
					</li>
					
					<li class="list_item clearfix">
						<label for="u_repass">Repita la contraseña:</label>
						<input type="password" id="u_repass" class="inp_text" name="u_repass" style="display:inline-block;" value="">
					</li>
				
					<li class="list_item">
						<label for="c_close" class="label-align">Cerrar sesión</label>
						<select id="c_close" name="c_close" class="inp_text">
							<option value="1">Si</option>
							<option value="0">No</option>
						</select>
					</li>
					
					<li class="list_item">
						<label for="c_send" class="label-align">Enviar contraseña nueva por email</label>
						<select id="c_send" name="c_send" class="inp_text">
							<option value="1">Si</option>
							<option value="0">No</option>
						</select>
					</li>

				</ul>
				
			</div>
		</div>
		
		<hr />
		
		<div class="spoiler">
			<a class="spoiler-title" onclick="$('.spoiler-body').slideUp();spoiler($(this))">Borrar contenidos</a>
			<div class="spoiler-body" style="display:none">
				
				<span class="item-info margin-top-5"><img src="{$web.icons}/info.png">Mantenga presionada la tecla <b>Ctrl</b> para seleccionar múltiples contenidos a borrar</span>
			
				<ul>
				
					<li class="list_item">
						<label for="c_send" class="label-align">Contenidos a borrar</label>
						<select id="c_send" name="c_send[]" class="inp_text" size="8" multiple="multiple">
							<option value="1">Todos sus posts ({$u_info.u_posts})</option>
							<option value="2">Todas sus imágenes ({$u_info.u_images})</option>
							<option value="3">Todos sus temas ({$u_info.u_topics})</option>
							<option value="4">Todos sus comentarios/respuestas ({$u_info.u_comments})</option>
							<option value="5">Todos sus estados ({$u_info.u_states})</option>
							<option value="6">Todos sus favoritos ({$u_info.u_favorites})</option>
							<option value="7">Toda su actividad ({$u_info.u_activity})</option>
							<option value="8">Todas sus notificaciones ({$u_info.u_notis})</option>
						</select>
					</li>

				</ul>
				
			</div>
		</div>
		
		<input type="hidden" name="u_id" value="{$u_info.u_id}">
		<hr>
		<a href="{$web.url}/admin?do=users" class="button_1	floatL">&#171; Volver</a>
		<input type="button" class="button_1 b_ok floatR" value="Guardar cambios" onclick="admin.users.save();">
		
	</div>
	
</div>
{/if}