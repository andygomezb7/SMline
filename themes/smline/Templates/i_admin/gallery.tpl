<div class="box">
	<div class="box_title">Galer&iacute;a de im&aacute;genes</div>
	<div class="box_body clearfix admin-settings">
		<table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="100%" align="center">
			<thead>
				<tr>
					<th>ID</th>
					<th>Imagen</th>
					<th>Autor</th>
					<th>Fecha</th>
					<th>Estado</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
			{foreach from=$get_images.list item=i}
				<tr>
					<td>{$i.i_id}</td>
					<td><a href="{$web.url}/imagenes/{$i.i_id}/{$i.i_title|seo}.html"><img src="{$web.url}/thumbs/images/t_{$i.i_id}.jpg" class="img-src stip" title="{$i.i_title}" style="width: 50px;" /></a></td>
					<td><a href="{$web.url}/{$i.u_nick}">{$i.u_nick}</a></td>
					<td><span class="stip" title="{$i.i_date|date_format:"%d/%m/%Y %I:%M %p"}">{$i.i_date|hace}</span></td>
					<td id="not-status">
						{if $i.i_status == 0}<span class="color-red">Eliminada</span>
						{elseif $i.i_status == 1}<span class="color-green">Visible</span>
						{else}<span class="color-indigo">Oculta</span>
						{/if}
					</td>
					<td class="admin_actions">
						<a class="stip" title="Editar imagen" href="{$web.url}/imagenes/agregar?imgid={$i.i_id}"><img src="{$web.icons}/editar.png"></a>
						<a class="stip" title="Borrar imagen" onclick="mod.del('images', {$i.i_id});"><img src="{$web.icons}/delete_.png"></a>
					</td>
				</tr>
			{/foreach}
			{if !$get_images.list}<tr><td colspan="6"><div id="error">No hay im&aacute;genes en {$web.title}</div></td></tr>{/if}
			</tbody>
		</table>

		{$get_images.pages}
	</div>
</div>