		<h2>Im&aacute;genes eliminadas</h2>
		
		<table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="100%">
			<thead>
				<tr>
					<th>Imagen</th>
					<th>T&iacute;tulo</th>
					<th>Autor</th>
					<th>Publicada</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				{foreach from=$imagenes_eliminadas.list item=i}
				<tr id="img-{$i.i_id}">
					<td>
						<a href="{$web.url}/imagenes/{$i.i_id}/{$i.i_title|seo}.html"><img src="{$web.url}/thumbs/images/t_{$i.i_id}.jpg" class="img-src stip" title="{$i.i_title}" style="width: 50px;" /></a>
					</td>
					<td>
						<a href="{$web.url}/imagenes/{$i.i_id}/{$i.i_title|seo}.html">{$i.i_title}</a>
					</td>
					<td>
						<a href="{$web.url}/{$i.u_nick}">{$i.u_nick}</a>
					</td>
					<td>{$i.i_date|hace}</td>
					<td class="admin_actions">
						<a class="stip" title="Reactivar imagen" onclick="mod.reac('images', {$i.i_id});"><img src="{$web.icons}/ok.png"></a>
						<a class="stip" title="Editar imagen" href="{$web.url}/imagenes/agregar?imgid={$i.i_id}"><img src="{$web.icons}/editar.png"></a>
					</td>
				</tr>
				{/foreach}
				{if !$imagenes_eliminadas.list}<tr><td colspan="6"><div id="error">No hay im&aacute;genes eliminadas hasta el momento.</div></td></tr>{/if}
				<tr>
					<td colspan="6">
						<form action="/mod" class="mod_buscar" name="search_u" method="get">
							<input type="text" class="input_text" name="qu" placeholder="Buscar im&aacute;genes..." value="{$qu}" autocomplete="off">
							<input type="hidden" name="do" value="imagenes_eliminadas" />
							<a class="button_next" onclick="document.forms.search_u.submit()">Buscar</a>
						</form>
					</td>
				</tr>
			</tbody>
		</table>
		{if $imagenes_eliminadas.list}{$imagenes_eliminadas.pages}{/if}
			