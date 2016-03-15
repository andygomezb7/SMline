		<h2>Posts reportados</h2>
		
		<table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="100%">
			<thead>
				<tr>
					<th>T&iacute;tulo</th>
					<th>Autor</th>
					<th>Reportado por</th>
					<th>Raz&oacute;n</th>
					<th>Creado</th>
					<th>Reportado</th>
					<th>Estado</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				{foreach from=$posts_reportados.list item=p}
				<tr id="report-{$p.r_id}">
					<td>
						<a href="{$web.url}/posts/{$p.c_seo}/{$p.p_id}/{$p.p_title|seo}.html" target="_blank">{$p.p_title}</a>
					</td>
					<td>
						<a href="{$web.url}/{$user->get_nick($p.p_user)}">{$user->get_nick($p.p_user)}</a>
					</td>
					<td>
						<a href="{$web.url}/{$p.u_nick}">{$p.u_nick}</a>
					</td>
					<td>{$p.r_reason}</td>
					<td>{$p.p_date|hace}</td>
					<td>{$p.r_date|hace}</td>
					<td id="not-status">
						{if $p.p_status == 0}<span class="color-red">Eliminado</span>
						{elseif $p.p_status == 1}<span class="color-green">Visible</span>
						{elseif $p.p_status == 2}<span class="color-indigo">En revisión</span>
						{/if}
					</td>
					<td class="admin_actions">
						<a class="stip" title="Suspender al autor" onclick="mod.banned({$p.p_user});"><img src="{$web.icons}/power_off.png"></a>
						{if $p.p_status == 0}<a class="stip" title="Reactivar post" onclick="mod.reac('posts', {$p.p_id});"><img src="{$web.icons}/ok.png"></a>
						{else}
						<a class="stip" title="Borrar post" onclick="mod.del('posts', {$p.p_id});"><img src="{$web.icons}/delete_.png"></a>
						{/if}
						{if $p.p_status == 2}
						<a class="stip" title="Aprobar post" onclick="mod.approve('posts', {$p.p_id});"><img src="{$web.icons}/power_on.png"></a>
						{else}
						<a class="stip" title="Pasarlo a revisi&oacute;n" onclick="mod.revise('posts', {$p.p_id});"><img src="{$web.icons}/reply.png"></a>{/if}
						<a class="stip" title="Editar post" href="{$web.url}/agregar-post?pid={$p.p_id}"><img src="{$web.icons}/editar.png"></a>
						<a class="stip" title="Borrar reporte" onclick="mod.reports.del({$p.r_id});"><img src="{$web.icons}/flag.png"></a>
					</td>
				</tr>
				{/foreach}
				{if !$posts_reportados.list}<tr><td colspan="8"><div id="error">No hay posts reportados hasta el momento.</div></td></tr>{/if}
				<tr>
					<td colspan="8">
						<form action="/mod" class="mod_buscar" name="search_u" method="get">
							<input type="text" class="input_text" name="qu" placeholder="Buscar posts..." value="{$qu}" autocomplete="off">
							<input type="hidden" name="do" value="posts_reportados" />
							<a class="button_next" onclick="document.forms.search_u.submit()">Buscar</a>
						</form>
					</td>
				</tr>
			</tbody>
		</table>
		{if $posts_reportados.list}{$posts_reportados.pages}{/if}
			