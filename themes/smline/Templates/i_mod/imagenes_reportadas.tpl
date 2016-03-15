		<h2>Im&aacute;genes reportadas</h2>
		
		<table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="100%">
			<thead>
				<tr>
					<th>Imagen</th>
					<th>Autor</th>
					<th>Reportada por</th>
					<th>Raz&oacute;n</th>
					<th>Creada</th>
					<th>Reportada</th>
					<th>Estado</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				{foreach from=$imagenes_reportadas.list item=i}
				<tr id="report-{$i.r_id}">
					<td>
						<a href="{$web.url}/imagenes/{$i.i_id}/{$i.i_title|seo}.html"><img src="{$web.url}/thumbs/images/t_{$i.i_id}.jpg" class="img-src stip" title="{$i.i_title}" style="width: 50px;" /></a>
					</td>
					<td>
						<a href="{$web.url}/{$user->get_nick($i.i_user)}">{$user->get_nick($i.i_user)}</a>
					</td>
					<td>
						<a href="{$web.url}/{$i.u_nick}">{$i.u_nick}</a>
					</td>
					<td>{$i.r_reason}</td>
					<td>{$i.i_date|hace}</td>
					<td>{$i.r_date|hace}</td>
					<td id="not-status">
						{if $i.i_status == 0}<span class="color-red">Eliminada</span>
						{elseif $i.i_status == 1}<span class="color-green">Visible</span>
						{/if}
					</td>
					<td class="admin_actions">
						<a class="stip" title="Suspender al autor" onclick="mod.banned({$i.i_user});"><img src="{$web.icons}/power_off.png"></a>
						{if $i.i_status == 0}<a class="stip" title="Reactivar imagen" onclick="mod.reac('images', {$i.i_id});"><img src="{$web.icons}/ok.png"></a>
						{else}
						<a class="stip" title="Borrar imagen" onclick="mod.del('images', {$i.i_id});"><img src="{$web.icons}/delete_.png"></a>
						{/if}
						<a class="stip" title="Editar imagen" href="{$web.url}/imagenes/agregar?imgid={$i.i_id}"><img src="{$web.icons}/editar.png"></a>
						<a class="stip" title="Borrar reporte" onclick="mod.reports.del({$i.r_id});"><img src="{$web.icons}/flag.png"></a>
					</td>
				</tr>
				{/foreach}
				{if !$imagenes_reportadas.list}<tr><td colspan="8"><div id="error">No hay im&aacute;genes reportadas hasta el momento.</div></td></tr>{/if}
				<tr>
					<td colspan="8">
						<form action="/mod" class="mod_buscar" name="search_u" method="get">
							<input type="text" class="input_text" name="qu" placeholder="Buscar im&aacute;genes..." value="{$qu}" autocomplete="off">
							<input type="hidden" name="do" value="imagenes_reportadas" />
							<a class="button_next" onclick="document.forms.search_u.submit()">Buscar</a>
						</form>
					</td>
				</tr>
			</tbody>
		</table>
		{if $imagenes_reportadas.list}{$imagenes_reportadas.pages}{/if}
			