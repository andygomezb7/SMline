<div class="box box_autor">
	<div class="box_title"><a href="{$web.url}/{$post.u_nick}">{$post.u_nick}</a></div>
	<div class="box_body clearfix">
		<div class="user-icons-head clearfix">
			<span class="u_rank etip" style="color:#{$post.r_color};"z title="Rango">{$post.r_name}</span>
			<div class="autor_status">
				 <i class="icon {if $user->is_online($post.u_id)}on{else}off{/if}line stip" title="{if $user->is_online($post.u_id)}Conectado{else}Desconectado{/if}"></i>
				 <i class="icon stip" style="background: url({$web.icons}/flag/{$post.u_country_icon}.png) center no-repeat;" title="{$post.u_country}"></i>
				 <i class="icon {if $post.u_sex == 1}fe{/if}male stip" title="{if $post.u_sex == 1}Mujer{else}Hombre{/if}"></i>
				 <i class="icon stip" style="background: url({$web.icons}/ranks/{$post.r_image}) center no-repeat;" title="{$post.r_name}"></i>
			</div>
		</div>
		
		<ul class="list_stats">
			<li class="somb_in">
				<span class="list_count">{$post.u_posts}</span>
				<span class="list_name">Posts</span>
			</li>
			<li class="somb_in">
				<span class="list_count" id="autor-total-puntos">{$post.u_points}</span>
				<span class="list_name">Puntos</span>
			</li>
			<li class="somb_in">
				<span class="list_count">{$post.u_comments}</span>
				<span class="list_name">Comentarios</span>
			</li>
			<li class="somb_in">
				<span class="list_count">{$post.u_follows}</span>
				<span class="list_name">Seguidores</span>
			</li>
		</ul>
		<div style="position: relative;width: 125px;">
			{if $user->is_online($post.u_id)}<span class="u-status-online stip" title="Conectado"></span>{/if}
			<a href="{$web.url}/{$post.u_nick}"><img src="{$web.avatar}/{$post.u_id}_120.jpg?{$post.u_last_avatar}" class="avatar" /></a>
		</div>
		<div id="follows-buttons" data-type="user" type-id="{$post.u_id}">
			<a class="button_1 type_1 to_follow require-login" style="{if $user->is_following('user', $post.u_id)}display:none;{/if}"><img src="{$web.icons}/follow.png"/>Seguir</a>
			<a class="button_3 type_1 ok_follow" style="{if !$user->is_following('user', $post.u_id)}display:none;{/if}">Siguiendo</a>
			<a class="b_cancel type_1 un_follow" style="display:none;">Dejar de seguir</a>
		</div>
		<a href="{$web.url}/mensajes/a/{$post.u_nick}" class="button_1 type_1 margin-top-5 require-login">
			<img src="{$web.icons}/message.png"/>Mensaje</a>
		<hr />
		<div class="autor-data">
			<li><img src="{$web.icons}/location.gif"/> Vive en <b>{$post.u_country}</b></li>
			<li><img src="{$web.icons}/time.png"/> Se registró el <b>{$post.u_register.0} de {$post.u_register.1} del {$post.u_register.2}</b></li>
			{if $user->permits['gomod'] || $user->permits['goadmin']}<li><img src="{$web.icons}/zoom.png"/> IP <a href="http://geoiptool.com/es/?IP={$post.p_ip}">{$post.p_ip}</a></li>{/if}
		</div>
	</div>
</div>

<div class="sidebar_tags">
{foreach from=$post.tags item=t}
{if $t}<a class="button_1" href="{$web.url}/buscar?q={$t}&as=tags"><i class="icon p-tag"></i>{$t}</a>{/if}
{/foreach}
</div>
