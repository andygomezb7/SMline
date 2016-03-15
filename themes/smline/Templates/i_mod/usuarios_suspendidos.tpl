		<h2>Usuarios suspendidos</h2>

		<table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="100%">
			<thead>
				<tr>
					<th>Usuario</th>
					<th>Causa</th>
					<th>Suspendido</th>
					<th>Termina</th>
					<th>Moderador</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				{foreach from=$usuarios_suspendidos.list item=u}
				<tr>
					<td>
						<a href="{$web.url}/{$u.u_nick}">{$u.u_nick}</a>
					</td>
					<td>
						{$u.ub_reason}
					</td>
					<td>{$u.ub_date|hace}</td>
					<td>{if !$u.ub_end}Nunca{else}{$u.ub_end|date_format:"%d/%m/%Y %I:%M %p"}{/if}</td>
					<td>
						<a href="{$web.url}/{$user->get_nick($u.ub_mod)}">{$user->get_nick($u.ub_mod)}</a>
					</td>
					<td class="admin_actions">
						<a class="stip" title="Reactivar usuario"  onclick="mod.unbanned({$u.u_id}, '{$u.u_nick}');"><img src="{$web.icons}/power_on.png"></a>
					</td>
				</tr>
				{/foreach}
				{if !$usuarios_suspendidos.list}<tr><td colspan="6"><div id="error">No hay usuarios suspendidos</div></td></tr>{/if}
				<tr>
					<td colspan="6">
						<form action="/mod" class="mod_buscar" name="search_u" method="get">
							<input type="text" class="input_text" name="qu" placeholder="Buscar usuario..." value="{$qu}" autocomplete="off">
							<input type="hidden" name="do" value="usuarios_suspendidos" />
							<a class="button_next" onclick="document.forms.search_u.submit()">Buscar</a>
						</form>
					</td>
				</tr>
			</tbody>
		</table>
		{if $usuarios_suspendidos.list}{$usuarios_suspendidos.pages}{/if}
			