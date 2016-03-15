{if $action == ''}
<div class="box">
	<div class="box_title">Bloqueos</div>
	<div class="box_body clearfix admin-settings">
		{if $status == 'ok_add'}<span class="item-info ok margin-top-5"><img src="{$web.icons}/ok.png">El bloqueo ha sido agregado!</span>
		<hr />
		{else}<span class="item-info margin-top-5"><img src="{$web.icons}/info.png">Esta herramiente impide el registro de usuarios con filtros en la lista de bloqueos.</span>
		<hr />
		{/if}
		
		<table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="780" align="center">
            <thead>
				<tr>
					<th>Bloqueo</th>
					<th>Tipo</th>
					<th>Por</th>
					<th>Fecha</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
				{foreach from=$get_locks item=l}
				<tr id="l-id-{$l.l_id}">
					<td>{$l.l_lock}</td>
					<td>{if $l.l_type == 1}IP{elseif $l.l_type == 2}Servidor email{else}Nombre de usuario{/if}</td>
					<td><a href="{$web.url}/{$l.u_nick}">{$l.u_nick}</a></td>
					<td><span class="stip" title="{$l.l_date|date_format:"%d/%m/%Y %I:%M %p"}">{$l.l_date|hace}</span></td>
					<td class="admin_actions">
						<a class="stip" title="Eliminar bloqueo" onclick="admin.locks.del({$l.l_id});"><img src="{$web.icons}/delete_.png"></a>
					</td>
				</tr>
				{/foreach}
				{if !$get_locks}<tr><td colspan="5"><div id="error">No hay bloqueos hasta el momento</div></td></tr>{/if}
			</tbody>
		</table>
		
		<hr />
		<a href="{$web.url}/admin?do=blocked&action=add" class="button_1 b_ok floatR">Agregar bloqueo</a>
		
	</div>
</div>
{elseif $action == 'add'}
<div class="box">
	<div class="box_title">Agregar bloqueo</div>
	<div class="box_body clearfix admin-settings">
		
		<span class="item-info margin-top-5"><img src="{$web.icons}/info.png">Esta herramiente impide el registro de usuarios con filtros en la lista de bloqueos.</span>
		<hr />
		
		<ul>
			
			<li class="list_item clearfix">
				<label for="l_type">Tipo de bloqueo:</label>	
				<select id="l_type" style="width:150px;" name="l_type" class="inp_text">
					<option value="1">IP</option>
					<option value="2">Servidor email</option>
					<option value="3">Nombre de usuario</option>
				</select>
			</li>
		
			<li class="list_item clearfix">
				<label for="l_lock">Bloqueo:</label>
				<input type="text" id="l_lock" class="inp_text" name="l_lock" autocomplete="off" style="display:inline-block;">
			</li>

		</ul>
		
		<hr>
		<a href="{$web.url}/admin?do=blocked" class="button_1 floatL">Volver</a>
		<input type="button" class="button_1 b_ok floatR" value="Continuar" onclick="admin.locks.add();">
		
	</div>
	
</div>
{/if}