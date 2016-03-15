		<h2>Posts eliminados</h2>
		
		<table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="100%">
			<thead>
				<tr>
					<th>Cat.</th>
					<th>T&iacute;tulo</th>
					<th>Autor</th>
					<th>Publicado</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				{foreach from=$posts_eliminados.list item=p}
				<tr id="post-{$p.p_id}">
					<td>
						<img src="{$web.icons}/cats/{$p.c_img}" class="stip" title="{$p.c_name}"/>
					</td>
					<td>
						<a href="{$web.url}/posts/{$p.c_seo}/{$p.p_id}/{$p.p_title|seo}.html" target="_blank">{$p.p_title}</a>
					</td>
					<td>
						<a href="{$web.url}/{$p.u_nick}">{$p.u_nick}</a>
					</td>
					<td>{$p.p_date|hace}</td>
					<td class="admin_actions">
						<a class="stip" title="Reactivar post" onclick="mod.reac('posts', {$p.p_id});"><img src="{$web.icons}/ok.png"></a>
						<a class="stip" title="Pasarlo a revisi&oacute;n" onclick="mod.revise('posts', {$p.p_id});"><img src="{$web.icons}/reply.png"></a>
						<a class="stip" title="Editar post" href="{$web.url}/agregar-post?pid={$p.p_id}"><img src="{$web.icons}/editar.png"></a>
					</td>
				</tr>
				{/foreach}
				{if !$posts_eliminados.list}<tr><td colspan="6"><div id="error">No hay posts eliminados.</div></td></tr>{/if}
				<tr>
					<td colspan="6">
						<form action="/mod" class="mod_buscar" name="search_u" method="get">
							<input type="text" class="input_text" name="qu" placeholder="Buscar posts..." value="{$qu}" autocomplete="off">
							<input type="hidden" name="do" value="posts_eliminados" />
							<a class="button_next" onclick="document.forms.search_u.submit()">Buscar</a>
						</form>
					</td>
				</tr>
			</tbody>
		</table>
		{if $posts_eliminados.list}{$posts_eliminados.pages}{/if}
			