{if $action == ''}
<div class="box">
	<div class="box_title">Links de interés</div>
	<div class="box_body clearfix admin-settings">
		{if $status == 'ok_add'}<span class="item-info ok margin-top-5"><img src="{$web.icons}/ok.png">El link ha sido agregado correctamente!</span>
		<hr />{/if}
		
		<table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="780" align="center">
            <thead>
				<tr>
					<th>Link</th>
					<th>Por</th>
					<th>Fecha</th>
					<th>Estado</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
				{foreach from=$links_i item=l}
				<tr id="l-id-{$l.l_id}">
					<td><a href="{$l.l_url}" target="_blank">{$l.l_title}</a></td>
					<td><a href="{$web.url}/{$l.u_nick}">{$l.u_nick}</a></td>
					<td><span class="stip" title="{$l.l_date|date_format:"%d/%m/%Y %I:%M %p"}">{$l.l_date|hace}</span></td>
					<td id="not-status">{if $l.l_status == 1}<span class="color-green">Activo</span>{else}<span class="color-red">Inactivo</span>{/if}</td>
					<td class="admin_actions">
						<a class="stip" title="Activar/Desactivar link"  onclick="admin.links.upd({$l.l_id});"><img src="{$web.icons}/reboot.png"></a>
						<a class="stip" title="Borrar link de interés" onclick="admin.links.del({$l.l_id});"><img src="{$web.icons}/delete_.png"></a>
					</td>
				</tr>
				{/foreach}
				{if !$links_i}<tr><td colspan="5"><div id="error">No hay links de interés en {$web.title}</div></td></tr>{/if}
			</tbody>
		</table>
		
		<hr />
		<a href="{$web.url}/admin?do=links&action=add" class="button_1 b_ok floatR">Agregar link</a>
		
	</div>
</div>
{elseif $action == 'add'}
<div class="box">
	<div class="box_title">Agregar link de interés</div>
	<div class="box_body clearfix admin-settings">
		
		<ul>
			<li class="list_item clearfix">
				<label for="l_title">Título del sitio:</label>
				<input type="text" id="l_title" class="inp_text" name="l_title" autocomplete="off" style="display:inline-block;">
			</li>
			
			<li class="list_item clearfix">
				<label for="l_url">URL del sitio:</label>
				<input type="text" id="l_url" class="inp_text" name="l_url" autocomplete="off" style="display:inline-block;">
			</li>
			
			
			<li class="list_item clearfix">
				<label for="l_status">Estado de la web:</label>	
				<select id="l_status" style="width:100px;" name="l_status" class="inp_text">
					<option value="1">Activo</option>
					<option value="0">Oculto</option>
				</select>
			</li>

		</ul>
		
		<hr>
		<a href="{$web.url}/admin?do=links" class="button_1 floatL">Volver</a>
		<input type="button" class="button_1 b_ok floatR" value="Continuar" onclick="admin.links.add();">
		
	</div>
	
</div>
{/if}