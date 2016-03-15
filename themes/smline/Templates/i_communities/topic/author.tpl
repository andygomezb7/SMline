<div class="box box_autor">
	<div class="box_title"><a href="{$web.url}/{$topic.u_nick}">{$topic.u_nick}</a></div>
	<div class="box_body clearfix">
		<div class="user-icons-head clearfix">
			<span class="u_rank etip" title="Rango en la comunidad">{if $topic.r_name}{$topic.r_name}{else}{$topic.comu_rank}{/if}</span>
			<div class="autor_status">
				 <i class="icon {if $user->is_online($topic.u_id)}on{else}off{/if}line stip" title="{if $user->is_online($topic.u_id)}Conectado{else}Desconectado{/if}"></i>
				 <i class="icon stip" style="background: url({$web.icons}/flag/{$topic.u_country_icon}.png) center no-repeat;" title="{$topic.u_country}"></i>
				 <i class="icon {if $topic.u_sex == 1}fe{/if}male stip" title="{if $topic.u_sex == 1}Mujer{else}Hombre{/if}"></i>
				 <i class="icon stip" style="background: url({$web.icons}/ranks/{$topic.r_image}) center no-repeat;" title="{$topic.r_name}"></i>
			</div>
		</div>
		
		<ul class="list_stats">
			<li class="somb_in">
				<span class="list_count">{$topic.u_topics}</span>
				<span class="list_name">Temas</span>
			</li>
			<li class="somb_in">
				<span class="list_count" id="autor-total-puntos">{$topic.u_points}</span>
				<span class="list_name">Puntos</span>
			</li>
			<li class="somb_in">
				<span class="list_count">{$topic.u_replies}</span>
				<span class="list_name">Respuestas</span>
			</li>
			<li class="somb_in">
				<span class="list_count">{$topic.u_follows}</span>
				<span class="list_name">Seguidores</span>
			</li>
		</ul>
		<div style="position: relative;width: 125px;">
			{if $user->is_online($topic.u_id)}<span class="u-status-online stip" title="Conectado"></span>{/if}
			<a href="{$web.url}/{$topic.u_nick}"><img src="{$web.avatar}/{$topic.u_id}_120.jpg?{$topic.u_last_avatar}" class="avatar" /></a>
		</div>
		<div id="follows-buttons" data-type="user" type-id="{$topic.u_id}">
			<a class="button_1 type_1 to_follow require-login" style="{if $user->is_following('user', $topic.u_id)}display:none;{/if}"><img src="{$web.icons}/follow.png"/>Seguir</a>
			<a class="button_3 type_1 ok_follow" style="{if !$user->is_following('user', $topic.u_id)}display:none;{/if}">Siguiendo</a>
			<a class="b_cancel type_1 un_follow" style="display:none;">Dejar de seguir</a>
		</div>
		<a href="{$web.url}/mensajes/a/{$topic.u_nick}" class="button_1 type_1 margin-top-5 require-login">
			<img src="{$web.icons}/message.png"/>Mensaje</a>
		<hr />
		<div class="autor-data">
			<li><img src="{$web.icons}/location.gif"/> Vive en <b>{$topic.u_country}</b></li>
			<li><img src="{$web.icons}/time.png"/> Se registró el <b>{$topic.u_register.0} de {$topic.u_register.1} del {$topic.u_register.2}</b></li>
			{if $user->permits['gomod'] || $user->permits['goadmin']}<li><img src="{$web.icons}/zoom.png"/> IP <a href="http://geoiptool.com/es/?IP={$topic.t_ip}">{$topic.t_ip}</a></li>{/if}
		</div>
	</div>
</div>
