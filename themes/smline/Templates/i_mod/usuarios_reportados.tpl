		<h2>Usuarios reportados</h2>

		<p>No suspendas a un usuario sin una causa razonable, si no tu podr&iacute;as hacerle compa&ntilde;ia.</p>
		
		<br />
		
		<table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="100%">
			<thead>
				<tr>
					<th>Usuario</th>
					<th>Reportado por</th>
					<th>Raz&oacute;n</th>
					<th>Fecha</th>
					<th>Estado</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				{foreach from=$usuarios_reportados.list item=u}
				<tr id="report-{$u.r_id}">
					<td>
						<a href="{$web.url}/{$u.u_nick}">{$u.u_nick}</a>
					</td>
					<td>
						<a href="{$web.url}/{$user->get_nick($u.r_user)}">{$user->get_nick($u.r_user)}</a>
					</td>
					<td>
						{$u.r_reason}
					</td>
					<td>{$u.r_date|hace}</td>
					<td id="not-status">
						{if $u.u_status == 3}<span class="color-red">Suspendido</span>
						{elseif $u.u_status == 1}<span class="color-green">Activo</span>
						{elseif $u.u_status == 2}<span class="color-indigo">Inactivo</span>
						{/if}
					</td>
					<td class="admin_actions">
						{if $u.u_status == 3}
						<a class="stip" title="Reactivar usuario" onclick="mod.unbanned({$u.u_id}, '{$u.u_nick}');"><img src="{$web.icons}/power_on.png"></a>
						{else}
						<a class="stip" title="Suspender usuario" onclick="mod.banned({$u.u_id});"><img src="{$web.icons}/power_off.png"></a>
						{/if}
						<a class="stip" title="Borrar reporte" onclick="mod.reports.del({$u.r_id});"><img src="{$web.icons}/delete_.png"></a>
					</td>
				</tr>
				{/foreach}
				{if !$usuarios_reportados.list}<tr><td colspan="6"><div id="error">No hay usuarios reportados</div></td></tr>{/if}
				<tr>
					<td colspan="6">
						<form action="/mod" class="mod_buscar" name="search_u" method="get">
							<input type="text" class="input_text" name="qu" placeholder="Buscar usuario..." value="{$qu}" autocomplete="off">
							<input type="hidden" name="do" value="usuarios_reportados" />
							<a class="button_next" onclick="document.forms.search_u.submit()">Buscar</a>
						</form>
					</td>
				</tr>
			</tbody>
		</table>
		{if $usuarios_reportados.list}{$usuarios_reportados.pages}{/if}
			