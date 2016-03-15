		<h2>Temas reportados</h2>
		
		<table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="100%">
			<thead>
				<tr>
					<th>T&iacute;tulo</th>
					<th>Creado por</th>
					<th>Reportado por</th>
					<th>Raz&oacute;n</th>
					<th>Estado</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				{foreach from=$temas_reportados.list item=t}
				<tr id="report-{$t.r_id}">
					<td>
						<a href="{$web.url}/comunidades/{$t.comu_seo}/{$t.t_id}/{$t.t_title|seo}.html" target="_blank">{$t.t_title}</a>
					</td>
					<td>
						<a href="{$web.url}/{$user->get_nick($t.t_user)}">{$user->get_nick($t.t_user)}</a> - {$t.t_date|hace}
					</td>
					</td>
					<td>
						<a href="{$web.url}/{$t.u_nick}">{$t.u_nick}</a> - {$t.r_date|hace}
					</td>
					<td>
						{$t.r_reason}
					</td>
					<td id="not-status">
						{if $t.t_status == 0}<span class="color-red">Eliminado</span>
						{else}<span class="color-green">Activo</span>
						{/if}
					</td>
					<td class="admin_actions">
						{if $t.t_status == 0}
						<a class="stip" title="Reactivar tema" onclick="mod.reac('topics', {$t.t_id});"><img src="{$web.icons}/ok.png"></a>
						{else}
						<a class="stip" title="Eliminar tema" onclick="mod.del('topics', {$t.t_id});"><img src="{$web.icons}/delete_.png"></a>
						{/if}
						<a class="stip" title="Editar tema" href="{$web.url}/comunidades/{$t.comu_seo}/editar-tema?tid={$t.t_id}"><img src="{$web.icons}/editar.png"></a>
						<a class="stip" title="Borrar reporte" onclick="mod.reports.del({$t.r_id});"><img src="{$web.icons}/flag.png"></a>
					</td>
				</tr>
				{/foreach}
				{if !$temas_reportados.list}<tr><td colspan="6"><div id="error">No hay temas reportados.</div></td></tr>{/if}
				<tr>
					<td colspan="6">
						<form action="/mod" class="mod_buscar" name="search_u" method="get">
							<input type="text" class="input_text" name="qu" placeholder="Buscar temas..." value="{$qu}" autocomplete="off">
							<input type="hidden" name="do" value="temas_reportados" />
							<a class="button_next" onclick="document.forms.search_u.submit()">Buscar</a>
						</form>
					</td>
				</tr>
			</tbody>
		</table>
		{if $temas_reportados.list}{$temas_reportados.pages}{/if}
			