<div class="box">
	<div class="box_title">Filtrar posts</div>
	<div class="box_body all_filters" style="position: relative;">
		<span class="fil_tit">Ordenar por...</span>
		<div class="fil_list list_order_search">
			<li class="list_fil{if $s_data['order'] == ''} active{/if}">
				<a href="{$web.url}/buscar?q={$s_data['q']}&cat={$s_data['cat']}&as={$s_data['as']}&author={$s_data['author']}&order=">Relevancia</a>
			</li>
			<li class="list_fil{if $s_data['order'] == 'puntos'} active{/if}">
				<a href="{$web.url}/buscar?q={$s_data['q']}&cat={$s_data['cat']}&as={$s_data['as']}&author={$s_data['author']}&order=puntos">Puntos</a>
			</li>
			<li class="list_fil{if $s_data['order'] == 'fecha'} active{/if}">
				<a href="{$web.url}/buscar?q={$s_data['q']}&cat={$s_data['cat']}&as={$s_data['as']}&author={$s_data['author']}&order=fecha">Fecha</a>
			</li>
		</div>
		
		<hr />
		
		<span class="fil_tit">Filtrar por...</span>
		<div class="fil_list list_as_search">
			<li class="list_fil{if $s_data['as'] == ''} active{/if}">
				<a href="{$web.url}/buscar?q={$s_data['q']}&cat={$s_data['cat']}&as=&author={$s_data['author']}&order={$s_data['order']}">Títulos</a>
			</li>
			<li class="list_fil{if $s_data['as'] == 'body'} active{/if}">
				<a href="{$web.url}/buscar?q={$s_data['q']}&cat={$s_data['cat']}&as=body&author={$s_data['author']}&order={$s_data['order']}">Contenidos</a>
			</li>
			<li class="list_fil{if $s_data['as'] == 'tags'} active{/if}">
				<a href="{$web.url}/buscar?q={$s_data['q']}&cat={$s_data['cat']}&as=tags&author={$s_data['author']}&order={$s_data['order']}">Tags</a>
			</li>
		</div>
		
		<hr />
		
		<span class="fil_tit">Por autor...</span>
		<div class="fil_list">
			<li class="list_fil active">
				<input type="text" class="inp_text" name="by_author" value="{$s_data['author']}" placeholder="Ingresa el usuario">
				<input type="button" class="button_1 b_ok" value="Ir &#187;" onclick="location.href='{$web.url}/buscar?q={$s_data['q']}&cat={$s_data['cat']}&as={$s_data['as']}&author='+$('input[name=by_author]').val()+'&order={$s_data['order']}'" style="width: auto;float: right;">
			</li>
		</div>
		
		<hr />
		
		<span class="fil_tit">Categorias</span>
		<div class="fil_list">
			<li class="list_fil active">
				<select class="inp_text" onchange="location.href='{$web.url}/buscar?q={$s_data['q']}&cat='+$(this).val()+'&as={$s_data['as']}&author={$s_data['author']}&order={$s_data['order']}'">
				<option selected="selected" value="">Seleccionar categoría</option>
				<option value="0">Todas las categorías</option>
				<optgroup label="-"></optgroup>
				{foreach from=$cats item=c}
				<option value="{$c.c_id}"{if $s_data['cat'] == $c.c_id} selected="selected"{/if}>{$c.c_name}</option>
				{/foreach}
			</select>
			</li>
		</div>
		
	</div>
</div>