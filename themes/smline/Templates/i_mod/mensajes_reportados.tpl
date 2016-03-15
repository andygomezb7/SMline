		<h2>Mensajes reportados</h2>
		
		<p>Ten en cuenta que solo el destinatario de un mensaje, puede reportarlo.</p>
		
		<br />
		
		<table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="100%">
			<thead>
				<tr>
					<th>Asunto</th>
					<th>Contenido</th>
					<th>De</th>
					<th>Para</th>
					<th>Enviado</th>
					<th>Reportado</th>
					<th>Raz&oacute;n</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				{foreach from=$mensajes_reportados.list item=m}
				<tr id="report-{$m.r_id}">
					<td><a class="stip" title="Leer conversación" onclick="mod.mps.read({$m.mp_id});">{$m.mp_subject}</a></td>
					<td><a class="stip" title="Leer conversación" onclick="mod.mps.read({$m.mp_id});">{$m.rp_body}</a></td>
					<td><a href="{$web.url}/{$user->get_nick($m.mp_user)}">{$user->get_nick($m.mp_user)}</a></td>
					<td><a href="{$web.url}/{$user->get_nick($m.mp_to)}">{$user->get_nick($m.mp_to)}</a></td>
					<td><span class="stip" title="{$m.mp_date|date_format:"%d/%m/%Y %I:%M %p"}">{$m.mp_date|hace}</span></td>
					<td><span class="stip" title="{$m.r_date|date_format:"%d/%m/%Y %I:%M %p"}">{$m.r_date|hace}</span></td>
					<td>{$m.r_reason}</td>
					<td class="admin_actions">
						<a class="stip" title="Leer conversación" onclick="mod.mps.read({$m.mp_id});"><img src="{$web.icons}/notepad.png"></a>
						
						{if $m.u_status == 3}
						<a class="stip" title="Reactivar remitente" onclick="mod.unbanned({$user->get_nick($m.mp_user)}, '{$m.mp_user}');"><img src="{$web.icons}/power_on.png"></a>
						{else}
						<a class="stip" title="Suspender remitente" onclick="mod.banned({$m.mp_user});"><img src="{$web.icons}/power_off.png"></a>
						{/if}
						
						<a class="stip" title="Borrar reporte" onclick="mod.reports.del({$m.r_id});"><img src="{$web.icons}/flag.png"></a>
					</td>
				</tr>
				{/foreach}
				{if !$mensajes_reportados.list}<tr><td colspan="8"><div id="error">No hay mensajes reportados.</div></td></tr>{/if}
			</tbody>
		</table>
		{if $mensajes_reportados.list}{$mensajes_reportados.pages}{/if}