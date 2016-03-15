<div class="box box_autor">
	<div class="box_title"><a href="{$web.url}/{$image.u_nick}">{$image.u_nick}</a></div>
	<div class="box_body clearfix">
		<div class="user-icons-head clearfix">
			<span class="u_rank etip" style="color:#{$image.r_color};" title="Rango">{$image.r_name}</span>
			<div class="autor_status">
				 <i class="icon {if $user->is_online($image.u_id)}on{else}off{/if}line stip" title="{if $user->is_online($image.u_id)}Conectado{else}Desconectado{/if}"></i>
				 <i class="icon stip" style="background: url({$web.icons}/flag/{$image.u_country_icon}.png) center no-repeat;" title="{$image.u_country}"></i>
				 <i class="icon {if $image.u_sex == 1}fe{/if}male stip" title="{if $image.u_sex == 1}Mujer{else}Hombre{/if}"></i>
				 <i class="icon stip" style="background: url({$web.icons}/ranks/{$image.r_image}) center no-repeat;" title="{$image.r_name}"></i>
			</div>
		</div>
		
		<ul class="list_stats">
			<li class="somb_in">
				<span class="list_count">{$image.u_images}</span>
				<span class="list_name">Imágenes</span>
			</li>
			<li class="somb_in">
				<span class="list_count" id="autor-total-puntos">{$image.u_points}</span>
				<span class="list_name">Puntos</span>
			</li>
			<li class="somb_in">
				<span class="list_count">{$image.u_comments}</span>
				<span class="list_name">Comentarios</span>
			</li>
			<li class="somb_in">
				<span class="list_count">{$image.u_follows}</span>
				<span class="list_name">Seguidores</span>
			</li>
		</ul>
		<div style="position: relative;width: 125px;">
			{if $user->is_online($image.u_id)}<span class="u-status-online stip" title="Conectado"></span>{/if}
			<a href="{$web.url}/{$image.u_nick}"><img src="{$web.avatar}/{$image.u_id}_120.jpg?{$image.u_last_avatar}" class="avatar" /></a>
		</div>
		<div id="follows-buttons" data-type="user" type-id="{$image.u_id}">
			<a class="button_1 type_1 to_follow require-login" style="{if $user->is_following('user', $image.u_id)}display:none;{/if}"><img src="{$web.icons}/follow.png"/>Seguir</a>
			<a class="button_3 type_1 ok_follow" style="{if !$user->is_following('user', $image.u_id)}display:none;{/if}">Siguiendo</a>
			<a class="b_cancel type_1 un_follow" style="display:none;">Dejar de seguir</a>
		</div>
		<a href="{$web.url}/mensajes/a/{$image.u_nick}" class="button_1 type_1 margin-top-5 require-login">
			<img src="{$web.icons}/message.png"/>Mensaje</a>
		<hr />
		<div class="autor-data">
			<li><img src="{$web.icons}/location.gif"/> Vive en <b>{$image.u_country}</b></li>
			<li><img src="{$web.icons}/time.png"/> Se registró el <b>{$image.u_register.0} de {$image.u_register.1} del {$image.u_register.2}</b></li>
			{if $user->permits['gomod'] || $user->permits['goadmin']}<li><img src="{$web.icons}/zoom.png"/> IP <a href="http://geoiptool.com/es/?IP={$image.i_ip}">{$image.i_ip}</a></li>{/if}
		</div>
	</div>
</div>

