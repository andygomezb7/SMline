		<h2>Temas eliminados</h2>
		
		<table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="100%">
			<thead>
				<tr>
					<th>ID</th>
					<th>T&iacute;tulo</th>
					<th>Autor</th>
					<th>Publicado</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				{foreach from=$temas_eliminados.list item=t}
				<tr id="tema-{$t.t_id}">
					<td>
						{$t.t_id}
					</td>
					<td>
						<a href="{$web.url}/comunidades/{$t.comu_seo}/{$t.t_id}/{$t.t_title|seo}.html" target="_blank">{$t.t_title}</a>
					</td>
					<td>
						<a href="{$web.url}/{$t.u_nick}">{$t.u_nick}</a>
					</td>
					<td>{$t.t_date|hace}</td>
					<td class="admin_actions">
						<a class="stip" title="Reactivar tema" onclick="mod.reac('topics', {$t.t_id});"><img src="{$web.icons}/ok.png"></a>
						<a class="stip" title="Editar tema" href="{$web.url}/comunidades/{$t.comu_seo}/editar-tema?tid={$t.t_id}"><img src="{$web.icons}/editar.png"></a>
					</td>
				</tr>
				{/foreach}
				{if !$temas_eliminados.list}<tr><td colspan="5"><div id="error">No hay temas eliminados.</div></td></tr>{/if}
				<tr>
					<td colspan="5">
						<form action="/mod" class="mod_buscar" name="search_u" method="get">
							<input type="text" class="input_text" name="qu" placeholder="Buscar temas..." value="{$qu}" autocomplete="off">
							<input type="hidden" name="do" value="temas_eliminados" />
							<a class="button_next" onclick="document.forms.search_u.submit()">Buscar</a>
						</form>
					</td>
				</tr>
			</tbody>
		</table>
		{if $temas_eliminados.list}{$temas_eliminados.pages}{/if}
			