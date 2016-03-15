{if $action == ''}

<div class="box crear-rango-paso-1">
	<div class="box_title">Categorías</div>
	<div class="box_body clearfix" style="padding-top:0;">
		{if $status == 'ok_add'}<span class="item-info ok margin-top-5"><img src="{$web.icons}/ok.png">La categoría fue agregada con exito!</span>{/if}
		{if $status == 'ok_save'}<span class="item-info ok margin-top-5"><img src="{$web.icons}/ok.png">La categoría fue editada con exito!</span>{/if}
		
		<table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="780" align="center">
            <thead>
				<tr>
					<th></th>
					<th>Nombre</th>
					<th>Posts</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
				{foreach from=$cats item=c}
				<tr id="cat-id-{$c.c_id}">
					<td><img src="{$web.icons}/cats/{$c.c_img}"></td>
					<td>{$c.c_name}</td>
					<td>{$c.posts}</td>
					<td class="admin_actions">
						<a class="stip" title="Editar categoría" href="?do=cats&action=edit&c_id={$c.c_id}"><img src="{$web.icons}/editar.png"></a>
						<a class="stip" title="Borrar categoría" onclick="admin.cats.del({$c.c_id});"><img src="{$web.icons}/delete_.png"></a>
					</td>
				</tr>
				{/foreach}
			</tbody>
		</table>

		
	
		<hr>
		<a href="{$web.url}/admin?do=cats&action=add" class="button_1 b_ok floatR">Agregar nueva categoría</a>
		
	</div>
	
</div>

{elseif $action == 'add' || $action == 'edit'}

<div class="new-cat">

	<div class="box crear-cat">
		<div class="box_title">Nueva categoría</div>
		<div class="box_body clearfix admin-settings rank-config">
			
			<ul>
				<li class="list_item clearfix">
					<label id="c_name">Nombre:</label>
					<input type="text" id="c_name" class="inp_text" maxlength="32" name="c_name" value="{$cinfo.c_name}" style="width:200px;display:inline-block;" autocomplete="off">
				</li>
				
				<li class="list_item clearfix">
					<label id="c_img">Imagen de la categoría:</label>	
					<select id="c_img" style="width:200px;" name="c_img" class="inp_text" onchange="$('.ra_icon').attr('src', '{$web.icons}/cats/'+$(this).val())">
						{foreach from=$c_icons item=icon}
						<option value="{$icon}" {if $cinfo.c_img == $icon}selected="selected"{/if}>{$icon}</option>
						{/foreach}
					</select>
					<img src="{$web.icons}/cats/{if $cinfo.c_img}{$cinfo.c_img}{else}Animaciones.png{/if}" class="ra_icon"/>
				</li>

			</ul>
			
			<hr>
			<a href="{$web.url}/admin?do=cats" class="button_1	floatL">&#171; Volver</a>
			{if $action == 'add'}<input type="button" class="button_1 b_ok floatR" value="Siguiente" onclick="admin.cats.add();">
			{elseif $action == 'edit'}<input type="button" class="button_1 b_ok floatR" value="Guardar cambios" onclick="admin.cats.save({$cinfo.c_id});">{/if}
			
		</div>
		
	</div>

</div>
{/if}