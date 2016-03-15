{include file='includes/header.tpl'}

{if $f_action == '' || $f_action == 'posts'}

		<table cellpadding="0" cellspacing="0" border="0" class="fav_table" width="100%" align="center">
            <thead>
				<tr>
					<th></th>
					<th>Título</th>
					<th>Creado</th>
					<th>Guardado</th>
					<th>Puntos</th>
					<th>Comentarios</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				{foreach from=$favorites.list item=f}
				<tr id="favid-{$f.f_id}">
					<td><img src="{$web.img}/icons/cats/{$f.c_img}" class="stip" title="{$f.c_name}"/></td>
					<td><a href="{$web.url}/posts/{$f.c_seo}/{$f.p_id}/{$f.p_title|seo}.html"{if $f.p_status != 1} style="color:red;"{/if}>{$f.p_title|substr:0:60}{if $f.p_title|strlen > 60}...{/if}</a></td>
					<td><span class="stip" title="{$f.p_date|date_format:"%d/%m/%Y %I:%M %p"}">{$f.p_date|hace}</span></td>
					<td><span class="stip" title="{$f.f_date|date_format:"%d/%m/%Y %I:%M %p"}">{$f.f_date|hace}</span></td>
					<td>{$f.p_puntos}</td>
					<td>{$f.p_comments}</td>
					<td class="admin_actions">
						<a class="stip" title="Borrar favorito" onclick="favorites.del({$f.f_id});"><img src="{$web.icons}/delete_.png"></a>
					</td>
				</tr>
				{/foreach}
				{if !$favorites.list}<tr><td colspan="7"><div id="error">No haz agregado favoritos hasta el momento</div></td></tr>{/if}
			</tbody>
		</table>
		{$favorites.pages}

{else if $f_action == 'imagenes'}

		<table cellpadding="0" cellspacing="0" border="0" class="fav_table" width="100%" align="center">
            <thead>
				<tr>
					<th></th>
					<th>Título</th>
					<th>Creada</th>
					<th>Guardado</th>
					<th>Votos</th>
					<th>Comentarios</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				{foreach from=$favorites.list item=f}
				<tr id="favid-{$f.f_id}">
					<td><img src="{$web.url}/thumbnails/img-{$f.i_id}.jpg" class="img-src" style="width: 40px;" /></td>
					<td><a href="{$web.url}/imagenes/{$f.i_id}/{$f.i_title|seo}.html"{if $f.i_status != 1} style="color:red;"{/if}>{$f.i_title|substr:0:60}{if $f.i_title|strlen > 60}...{/if}</a></td>
					<td><span class="stip" title="{$f.i_date|date_format:"%d/%m/%Y %I:%M %p"}">{$f.i_date|hace}</span></td>
					<td><span class="stip" title="{$f.f_date|date_format:"%d/%m/%Y %I:%M %p"}">{$f.f_date|hace}</span></td>
					<td>{if $f.i_positives - $f.i_negatives > 0}+{/if}{$f.i_positives - $f.i_negatives}</td>
					<td>{$f.i_comments}</td>
					<td class="admin_actions">
						<a class="stip" title="Borrar favorito" onclick="favorites.del({$f.f_id});"><img src="{$web.icons}/delete_.png"></a>
					</td>
				</tr>
				{/foreach}
				{if !$favorites.list}<tr><td colspan="7"><div id="error">No haz agregado imágenes favoritas hasta el momento</div></td></tr>{/if}
			</tbody>
		</table>
		{$favorites.pages}
		
{else if $f_action == 'temas'}

		<table cellpadding="0" cellspacing="0" border="0" class="fav_table" width="100%" align="center">
            <thead>
				<tr>
					<th></th>
					<th>Título</th>
					<th>Creado</th>
					<th>Guardado</th>
					<th>Votos</th>
					<th>Respuestas</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				{foreach from=$favorites.list item=f}
				<tr id="favid-{$f.f_id}">
					<td><img src="{$web.img}/icons/comus-cats/{$f.c_img}" class="stip" title="{$f.c_name}"/></td>
					<td><a href="{$web.url}/comunidades/{$f.comu_seo}/{$f.t_id}/{$f.t_title|seo}.html"{if $f.t_status != 1} style="color:red;"{/if}>{$f.t_title|substr:0:60}{if $f.t_title|strlen > 60}...{/if}</a></td>
					<td><span class="stip" title="{$f.t_date|date_format:"%d/%m/%Y %I:%M %p"}">{$f.t_date|hace}</span></td>
					<td><span class="stip" title="{$f.f_date|date_format:"%d/%m/%Y %I:%M %p"}">{$f.f_date|hace}</span></td>
					<td>{if $f.t_positives - $f.t_negatives > 0}+{/if}{$f.t_positives - $f.t_negatives}</td>
					<td>{$f.t_comments}</td>
					<td class="admin_actions">
						<a class="stip" title="Borrar favorito" onclick="favorites.del({$f.f_id});"><img src="{$web.icons}/delete_.png"></a>
					</td>
				</tr>
				{/foreach}
				{if !$favorites.list}<tr><td colspan="7"><div id="error">No haz agregado temas favoritos hasta el momento</div></td></tr>{/if}
			</tbody>
		</table>
		{$favorites.pages}

{/if}



{include file='includes/footer.tpl'}