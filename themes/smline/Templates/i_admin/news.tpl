{if $action == ''}
<div class="box">
	<div class="box_title">Noticias y novedades</div>
	<div class="box_body clearfix admin-settings">
		{if $status == 'ok_add'}<span class="item-info ok margin-top-5"><img src="{$web.icons}/ok.png">La noticia ha sido agregada!</span>
		{else}<span class="item-info"><img src="{$web.icons}/info.png" />Desde aquí podrás dar comunicados que serán visibles en la página principal de {$web.title}</span>{/if}
		<hr />
		
		<table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="780" align="center">
            <thead>
				<tr>
					<th>Noticia</th>
					<th>Autor</th>
					<th>Fecha</th>
					<th>Estado</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
				{foreach from=$news item=n}
				<tr id="n-id-{$n.n_id}">
					<td>{$n.n_body}</td>
					<td><a href="{$web.url}/{$n.u_nick}">{$n.u_nick}</a></td>
					<td><span class="stip" title="{$n.n_date|date_format:"%d/%m/%Y %I:%M %p"}">{$n.n_date|hace}</span></td>
					<td id="not-status">{if $n.n_status == 1}<span class="color-green">Activa</span>{else}<span class="color-red">Inactiva</span>{/if}</td>
					<td class="admin_actions">
						<a class="stip" title="activar/desactivar noticia"  onclick="admin.news.upd({$n.n_id});"><img src="{$web.icons}/reboot.png"></a>
						<a class="stip" title="borrar noticia" onclick="admin.news.del({$n.n_id});"><img src="{$web.icons}/delete_.png"></a>
					</td>
				</tr>
				{/foreach}
				{if !$news}<tr><td colspan="5"><div id="error">No hay noticias en {$web.title}</div></td></tr>{/if}
			</tbody>
		</table>
		
		<hr />
		<a href="{$web.url}/admin?do=news&action=add" class="button_1 b_ok floatR">Agregar nueva noticia</a>
		
	</div>
</div>
{elseif $action == 'add'}
<div class="box">
	<div class="box_title">Agregar noticia</div>
	<div class="box_body clearfix admin-settings">
		
		<ul>
			<li class="list_item clearfix">
				<label for="n_body">Cuerpo de la noticia:
					<small>Acepta BBcode y emoticonos</small>
				</label>
				<textarea id="n_body" class="inp_text" name="n_body" style="width:350px;min-height:70px;display:inline-block;" autocomplete="off"></textarea>
			</li>
			
			
			<li class="list_item clearfix">
				<label for="n_status">Estado de la noticia:</label>	
				<select id="n_status" style="width:100px;" name="n_status" class="inp_text">
					<option value="1">Activa</option>
					<option value="0">Oculta</option>
				</select>
			</li>

		</ul>
		
		<hr>
		<a href="{$web.url}/admin?do=news" class="button_1 floatL">Volver</a>
		<input type="button" class="button_1 b_ok floatR" value="Agregar noticia" onclick="admin.news.add();">
		
	</div>
	
</div>
{/if}