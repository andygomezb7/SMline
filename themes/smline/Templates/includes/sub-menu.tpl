<div id="wrapper">
	<div id="menu_2">
		<div class="floatL">
		{if $sm_page == 'images' || $sm_page == 'image'}
			<li{if !$do} class="active"{/if}><a href="{$web.url}/imagenes">Inicio</a></li>
			{if $user->uid}
			<li{if $do == 'agregar'} class="active"{/if}><a href="{$web.url}/imagenes/agregar"><img src="{$web.img}/add.png" /> Agregar imagen</a></li>
			{/if}
			<li><a href="{$web.url}/imagenes/historial">Historial</a></li>
		{elseif $sm_page == 'communities'}
			<li{if !$c_action} class="active"{/if}><a href="{$web.url}/comunidades">Inicio</a></li>
			<li{if $c_action == 'mis-comunidades'} class="active"{/if}><a href="{$web.url}/comunidades/mis-comunidades">Mis comunidades</a></li>
			<li{if $c_action == 'historial'} class="active"{/if}><a href="{$web.url}/comunidades/historial">Historial</a></li>
		{elseif $sm_page == 'favorites'}
			<li{if $f_action == '' || $f_action == 'posts'} class="active"{/if}><a href="{$web.url}/favoritos">Posts</a></li>
			<li{if $f_action == 'imagenes'} class="active"{/if}><a href="{$web.url}/favoritos/imagenes">Imágenes</a></li>
			<li{if $f_action == 'temas'} class="active"{/if}><a href="{$web.url}/favoritos/temas">Temas</a></li>
		{elseif $sm_page == 'tops'}
			<li{if !$t_action} class="active"{/if}><a href="{$web.url}/tops">Posts</a></li>
			<li{if $t_action == 'usuarios'} class="active"{/if}><a href="{$web.url}/tops/usuarios">Usuarios</a></li>
			<li{if $t_action == 'comunidades'} class="active"{/if}><a href="{$web.url}/tops/comunidades">Comunidades</a></li>
			{*<li{if $t_action == 'temas'} class="active"{/if}><a href="{$web.url}/tops/temas">Temas</a></li>*}
		{elseif $sm_page == 'search'}
			<li{if !$s_data['type']} class="active"{/if}><a href="{$web.url}/buscar?q={$s_data['q']}&cat={$s_data['cat']}&as={$s_data['as']}&author={$s_data['author']}&order={$s_data['order']}">Buscar en posts</a></li>
			<li{if $s_data['type'] == 'temas'} class="active"{/if}><a href="{$web.url}/buscar?q={$s_data['q']}&cat={$s_data['cat']}&as={$s_data['as']}&author={$s_data['author']}&order={$s_data['order']}&type=temas">Buscar en temas</a></li>
		{else}
			<li{if $page.css == 'home'} class="active"{/if}><a href="{$web.url}/">Inicio</a></li>
			<li{if $sm_page == 'profile' || $sm_page == 'members'} class="active"{/if}><a href="{$web.url}/miembros">Miembros</a></li>
			{if $user->uid}<li{if $act == 'agregar-post'} class="active"{/if}><a href="{$web.url}/agregar-post"><img src="{$web.img}/add.png" /> Agregar post</a></li>{/if}
			<li{if $sm_page == 'mod-history'} class="active"{/if}><a href="{$web.url}/historial">Historial</a></li>
		{/if}
		</div>
		{if $sm_page == 'communities' && $page.css == 'home'}
		<div class="floatR">
			<select class="inp_text" onchange="location.href=$(this).val();">
				<option selected="selected" value="">Seleccionar categoría</option>
				<option value="/comunidades">Todas las categorías</option>
				<optgroup label="-"></optgroup>
				{foreach from=$comus_cats item=c}
				<option value="/comunidades/home/{$c.c_seo}" {if $c.c_id == $cinfo.c_id}selected="selected"{/if}>{$c.c_name}</option>
				{/foreach}
			</select>
		</div>
		{elseif $sm_page == 'home' || $sm_page == 'home_portadas'}
		<div class="floatR">
			<select class="inp_text" onchange="location.href=$(this).val();">
				<option selected="selected" value="">Seleccionar categoría</option>
				<option value="/">Todas las categorías</option>
				<optgroup label="-"></optgroup>
				{foreach from=$cats item=c}
				<option value="/posts/{$c.c_seo}" {if $c.c_id == $cinfo.c_id}selected="selected"{/if}>{$c.c_name}</option>
				{/foreach}
			</select>
		</div>
		{elseif $sm_page == 'profile'}
		<div class="floatR">
			{if $user->uid && $user->uid != $u_info.u_id}
				{if $u_info.is_block}
					<li><a onclick="user.set_unblock({$u_info.u_id}, '{$u_info.u_nick}');" id="b-block-{$u_info.u_id}">Desbloquear</a></li>
				{else}
					<li><a onclick="user.set_block({$u_info.u_id}, '{$u_info.u_nick}');" id="b-block-{$u_info.u_id}">Bloquear</a></li>
				{/if}
			{/if}
		</div>
		{/if}
	</div>
</div>
