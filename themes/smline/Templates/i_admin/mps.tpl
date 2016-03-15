{if $action == ''}
<div class="box">
	<div class="box_title">Mensajes y conversaciones</div>
	<div class="box_body clearfix admin-settings">
		<span class="item-info"><img src="{$web.icons}/info.png" />Respeta la privacidad de los usuarios y trata de usar esta función solo en casos especiales!</span>
		<hr />
		
		<table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="100%" align="center">
            <thead>
				<tr>
					<th>Asunto</th>
					<th>Contenido</th>
					<th>De</th>
					<th>Para</th>
					<th>Leído</th>
					<th>Fecha</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
				{foreach from=$get_mps.list item=m}
				<tr id="mp-id-{$m.mp_id}">
					<td><a class="stip" title="Leer conversación" onclick="admin.mps.read({$m.mp_id});">{$m.mp_subject}</a></td>
					<td><a class="stip" title="Leer conversación" onclick="admin.mps.read({$m.mp_id});">{$m.rp_body}</a></td>
					<td><a href="{$web.url}/{$user->get_nick($m.mp_user)}">{$user->get_nick($m.mp_user)}</a></td>
					<td><a href="{$web.url}/{$user->get_nick($m.mp_to)}">{$user->get_nick($m.mp_to)}</a></td>
					<td id="not-status">{if $m.rp_view == 2}<span class="color-green">Si</span>{else}<span class="color-red">No</span>{/if}</td>
					<td><span class="stip" title="{$m.mp_date|date_format:"%d/%m/%Y %I:%M %p"}">{$m.mp_date|hace}</span></td>
					<td class="admin_actions">
						<a class="stip" title="Leer conversación" onclick="admin.mps.read({$m.mp_id});"><img src="{$web.icons}/notepad.png"></a>
						<a class="stip" title="Eliminar conversaci&oacute;n" onclick="admin.mps.del({$m.mp_id});"><img src="{$web.icons}/delete_.png"></a>
					</td>
				</tr>
				{/foreach}
				{if !$get_mps.list}<tr><td colspan="7"><div id="error">No hay conversaciones en {$web.title}</div></td></tr>{/if}
			</tbody>
		</table>
		{$get_mps.pages}
		
	</div>
</div>
{/if}