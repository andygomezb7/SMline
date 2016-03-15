<div class="box">
	<div class="box_title">Control de posts</div>
	<div class="box_body clearfix admin-settings">
		<table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="780" align="center">
			<thead>
				<tr>
					<th>ID</th>
					<th>Título</th>
					<th>Autor</th>
					<th>Fecha</th>
					<th>Estado</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
			{foreach from=$a_posts.list item=p}
				<tr>
					<td>{$p.p_id}</td>
					<td><a href="{$web.url}/posts/{$p.c_seo}/{$p.p_id}/{$p.p_title|seo}.html">{$p.p_title}</a></td>
					<td><a href="{$web.url}/{$p.u_nick}">{$p.u_nick}</a></td>
					<td><span class="stip" title="{$p.p_date|date_format:"%d/%m/%Y %I:%M %p"}">{$p.p_date|hace}</span></td>
					<td id="not-status">
						{if $p.p_status == 0}<span class="color-red">Eliminado</span>
						{elseif $p.p_status == 1}<span class="color-green">Visible</span>
						{elseif $p.p_status == 2}<span class="color-indigo">En revisión</span>
						{/if}
					</td>
					<td class="admin_actions">
						<a class="stip" title="editar post" href="{$web.url}/agregar-post?pid={$p.p_id}"><img src="{$web.icons}/editar.png"></a>
						<a class="stip" title="borrar post" onclick="mod.del('posts', {$p.p_id});"><img src="{$web.icons}/delete_.png"></a>
					</td>
				</tr>
			{/foreach}
			{if !$a_posts.list}<tr><td colspan="6"><div id="error">No hay posts en {$web.title}</div></td></tr>{/if}
			</tbody>
		</table>

		{if $a_posts.list}{$a_posts.pages}{/if}
	</div>
</div>