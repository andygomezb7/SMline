{include file='includes/header.tpl'}

<div id="main-col" style="margin-right:5px;">
	<div class="filterBy filterFull clearfix ui-corner-all">
		<div class="floatL xResults">
			Mostrando <strong>{$get_users.start} - {if $get_users.end < $get_users.total}{$get_users.end}{else}{$get_users.total}{/if}</strong> resultados de <strong>{$get_users.total}</strong>	</div>
		<ul class="floatR">
			<li class="orderTxt">Ordenar por</li>
			<li{if $order == 'nombre'} class="here"{/if}><a href="{$web.url}/miembros?order=nombre">Nombre de usuario</a></li>
			<li{if $order == 'actividad' || $order == ''} class="here"{/if}><a href="{$web.url}/miembros?order=actividad">&Uacute;ltima actividad</a></li>
			<li{if $order == 'registro'} class="here"{/if}><a href="{$web.url}/miembros?order=registro">Registro</a></li>
		</ul>
		<div class="clearBoth"></div>
	</div>

	<div id="showResult" class="resultFull mis-comunidades">
		<ul class="clearfix">

		{foreach from=$get_users.list item=u}
			<li class="resultBox clearfix">
				<div class="floatL avatarBox">
					<a href="{$web.url}/{$u.u_nick}" class="img-ava{if $user->is_online($u.u_id)} online{/if}">
						<img class="avatar-2" src="{$web.url}/avatar/{$u.u_id}_120.jpg?{$u.u_last_avatar}" alt="Avatar de {$u.u_nick}" title="{$u.u_nick} - {if $user->is_online($u.u_id)}Online{else}Offline{/if}">
					</a>
				</div>
				<div class="floatL infoBox">
					<h4>
						<img src="{$web.icons}/ranks/{$u.r_image}" alt="Imagen del rango" title="{$u.r_name}" class="stip" />
						<a href="{$web.url}/{$u.u_nick}">{$u.u_nick}</a>
					</h4>
					<ul>
						<li>Registro: <strong>{$u.u_date|date_format:"%d/%m/%Y"}</strong></li>
						<li>&Uacute;ltima actividad: <strong>{$u.u_last_active|hace}</strong></li>
						<li>Posts: <strong>{$u.u_posts}</strong> - Puntos: <strong>{$u.u_points}</strong></li>
						<li>Pa&iacute;s: <strong>{$array_paises[$u.u_country]}</strong></li>
					</ul>
				</div>
			</li>
		{/foreach}
		</ul>
	</div>
{$get_users.pages}
</div>

<div id="sidebar">
	<div class="box">
		<div class="box_title">Usuarios recomendados</div>
		<div class="box_body last_members list_element">
		
		{if !$get_users.recomendados}<div class="emptyData">No hay usuarios recomendados</div>{/if}
		
		{foreach from=$get_users.recomendados item=u}
			<div class="list-element">
				<a href="{$web.url}/{$u.u_nick}">
					<img src="{$web.url}/avatar/{$u.u_id}_32.jpg?{$u.u_last_avatar}" alt="Avatar de {$u.u_nick}" title="Avatar de {$u.u_nick}" />
				</a>
				<a class="u_nick" href="{$web.url}/{$u.u_nick}">{$u.u_nick}</a>
				
			</div>
		{/foreach}
			
		</div>
	</div>
</div>

{include file='includes/footer.tpl'}