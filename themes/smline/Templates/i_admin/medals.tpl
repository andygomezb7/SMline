{if $action == ''}

<div class="box crear-rango-paso-1">
	<div class="box_title">Medallas</div>
	<div class="box_body clearfix" style="padding-top:0;">
		{if $status == 'ok_add'}<span class="item-info ok margin-top-5"><img src="{$web.icons}/ok.png">La medalla fue agregada correctamente!</span>{/if}
		{if $status == 'ok_save'}<span class="item-info ok margin-top-5"><img src="{$web.icons}/ok.png">La medalla fue editada correctamente!</span>{else}
		<span class="item-info margin-top-5"><img src="{$web.icons}/info.png" />Las medallas se asignar&aacute;n autom&aacute;ticamente cada 24 horas.</span>
		<hr />
		{/if}
		<table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="780" align="center">
            <thead>
				<tr>
					<th>Imagen</th>
					<th>Título</th>
					<th>Usuarios</th>
					<th>Creada</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
				{foreach from=$get_medals item=m}
				<tr id="medal-id-{$m.m_id}">
					<td><img src="{$web.icons}/medals/{$m.m_image}" style="width: 20px;"></td>
					<td><a href="?do=medals&action=see&m_id={$m.m_id}" class="stip" title="{$m.m_desc}">{$m.m_title}</a></td>
					<td>{$m.m_users}</td>
					<td><span class="stip" title="{$m.m_date|date_format:"%d/%m/%Y %I:%M %p"}">{$m.m_date|hace}</span></td>
					<td class="admin_actions">
						<a class="stip" title="Editar medalla" href="?do=medals&action=edit&m_id={$m.m_id}"><img src="{$web.icons}/editar.png"></a>
						<a class="stip" title="Ver usuarios" href="?do=medals&action=see&m_id={$m.m_id}"><img src="{$web.icons}/users.png"></a>
						<a class="stip" title="Borrar medalla" onclick="admin.medals.del({$m.m_id});"><img src="{$web.icons}/delete_.png"></a>
					</td>
				</tr>
				{/foreach}
				{if !$get_medals}<tr><td colspan="5"><div id="error">No hay medallas en {$web.title}</div></td></tr>{/if}
			</tbody>
		</table>
	
		<hr>
		<a href="{$web.url}/admin?do=medals&action=add" class="button_1 b_ok floatR">Agregar medalla</a>
		
	</div>
	
</div>

{elseif $action == 'see'}

<div class="box crear-rango-paso-1">
	<div class="box_title">Todos los rangos</div>
	<div class="box_body clearfix" style="padding-top:0;">
		<span class="head_text"><span>Usuarios con la medalla: {$see_medal.m.0.m_title}</span></span>
		
		<table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="780" align="center">
            <thead>
				<tr>
					<th>Usuario</th>
					<th>Email</th>
					<th>La obtuvo</th>
					<th>Última vez activo</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
				{foreach from=$see_medal.users item=u}
				<tr id="medal-assign-id-{$u.ma_id}">
					<td><a href="{$web.url}/{$u.u_nick}">{$u.u_nick}</a></td>
					<td>{$u.u_email}</td>
					<td><span class="stip" title="{$u.ma_date|date_format:"%d/%m/%Y %I:%M %p"}">{$u.ma_date|hace}</span></td>
					<td><span class="stip" title="{$u.u_last_active|date_format:"%d/%m/%Y %I:%M %p"}">{$u.u_last_active|hace}</span></td>
					<td class="admin_actions">
						<a class="stip" title="Borrar asignaci&oacute;n" onclick="admin.medals.del_assign({$u.ma_id});"><img src="{$web.icons}/delete_.png"></a>
					</td>
				</tr>
				{/foreach}
				{if !$see_medal.users}
				<tr><td colspan="5"><div id="error">Nadie a obtenido esta medalla</div></td></tr>
				{/if}
			</tbody>
		</table>
		
		<hr>
		<a href="{$web.url}/admin?do=medals" class="button_1 floatL">Volver</a>
	</div>
</div>

{elseif $action == 'add' || $action == 'edit'}



<div class="new-medal">

<div class="box">
	<div class="box_title">{if $action == 'add'}Agregar{else}Editar{/if} medalla</div>
	<div class="box_body clearfix admin-settings rank-config">
		
		<ul>
			<li class="list_item clearfix">
				<label for="m_title">Título de la medalla:</label>
				<input type="text" id="m_title" class="inp_text" maxlength="70" name="m_title" value="{$minfo.m_title}" style="width:210px;display:inline-block;" autocomplete="off">
			</li>
			
			<li class="list_item clearfix">
				<label for="m_desc">Descripci&oacute;n de la medalla:</label>
				<textarea id="m_desc" class="inp_text" maxlength="70" name="m_desc" value="" style="width:350px;max-width:350px;min-height: 40px;display:inline-block;" autocomplete="off">{$minfo.m_desc}</textarea>
			</li>
			
			<li class="list_item clearfix">
				<label for="m_type">Condición especial:
				</label>
				
				<input type="text" id="m_cant" class="inp_text" maxlength="12" name="m_cant" value="{if $minfo.m_cant}{$minfo.m_cant}{/if}" style="width:60px;display:inline-block;{if $minfo.m_type == 10}display:none;{/if}" autocomplete="off">
				
				<select id="m_type" style="width:190px;" name="m_type" class="inp_text" onchange="{literal}if($(this).val() == 10){ $('#m_cant').hide();$('#m_rank').slideDown();}else{$('#m_rank').hide();$('#m_cant').slideDown();}{/literal}">
					{foreach from=$m_types item=mt key=i}
					<option value="{$i}"{if $minfo.m_type == $i} selected="selected"{/if}>{$mt}</option>
					{/foreach}
				</select>

				<select id="m_rank" style="width:150px;{if $minfo.m_type != 10}display:none;{/if}" name="m_rank" class="inp_text">
					{foreach from=$ranks_e item=r}
					<option value="{$r.r_id}" style="color:#{$r.r_color}"{if $minfo.m_rank == $r.r_id} selected="selected"{/if}>{$r.r_name}</option>
					{/foreach}
					{foreach from=$ranks_n item=r}
					<option value="{$r.r_id}" style="color:#{$r.r_color}"{if $minfo.m_rank == $r.r_id} selected="selected"{/if}>{$r.r_name}</option>
					{/foreach}
				</select>
			</li>
			
			<li class="list_item clearfix">
				<label for="m_icon">Imagen:</label>	
				<select id="m_icon" style="width:200px;" name="m_icon" class="inp_text" onchange="$('.m_icon').attr('src', '{$web.icons}/medals/'+$(this).val())">
					{foreach from=$m_icons item=icon}
					<option value="{$icon}"{if $minfo.m_image == $icon} selected="selected"{/if}>{$icon}</option>
					{/foreach}
				</select>
				<img src="{$web.icons}/medals/{if $minfo.m_image}{$minfo.m_image}{else}06C9C566C.gif{/if}" class="m_icon" style="vertical-align: top;"/>
			</li>

		</ul>
		
		<hr>
		<a href="{$web.url}/admin?do=medals" class="button_1 floatL">Cancelar</a>
		<input type="button" class="button_1 b_ok floatR" value="{if $action == 'add'}Crear medalla{else}Guardar cambios{/if}" onclick="admin.medals.{if $action == 'add'}add{else}save{/if}({$minfo.m_id});">
		
	</div>
	
</div>

</div>
{/if}