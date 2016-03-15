<div class="comu-head">
	{if $topic.comu_status == 0}
	<div id="error">
		<u>{$topic.comu_name}</u> se encuentra suspendida. Puedes reactivarla haciendo click <a onclick="comus.unban({$topic.comu_id})">aqu&iacute;</a>
	</div>
	{/if}
	<div id="comunity-data-stats" class="big-group-info clearfix">
		<div class="floatL profile">
			<a href="/comunidades/{$topic.comu_seo}/">
				<img class="big-avatar" src="{$web.url}/thumbs/comus/t_{$topic.comu_id}.jpg?{$topic.comu_last_image}" alt="Ir a la comunidad" title="Ir a la comunidad">
			</a>
		</div>
		<div class="big-group-data">
			<div class="clearfix">
				<h1><a href="/comunidades/{$topic.comu_seo}/">{$topic.comu_name}</a></h1>
			</div>
			<div class="info-basic">
				<p>{$topic.comu_desc}</p>
				<a onclick="mydialog.alert('Informaci&oacute;n', $('.view-more-info').html());" title="Ver m&aacute;s">Ver m&aacute;s informaci&oacute;n</a>
			</div>
			<div class="view-more-info" style="display:none">
				<table cellpadding="0" cellspacing="0" border="0" class="comu-info-table">
					<tr>
						<td class="title-left">Categor&iacute;a:</td>
						<td class="title-right"><a href="{$web.url}/comunidades/home/{$topic.c_seo}" title="{$topic.c_name}">{$topic.c_name}</a></td>
					</tr>
						<td class="title-left">Creada:</td>
						<td class="title-right"> por <a title="Ver el perfil de {$user->get_nick($topic.comu_admin)}" href="{$web.url}/{$user->get_nick($topic.comu_admin)}"><b>{$user->get_nick($topic.comu_admin)}</b></a> {$topic.comu_date|hace}</td>
					</tr>
					<tr>
						<td class="title-left">Tipo de validaci&oacute;n:</td>
						<td class="title-right">Los nuevos miembros son aceptados automaticamente con el rango <b>{$topic.comu_rank}</b>
						{if !$topic.comu_p_post && !$topic.comu_p_com}
							 sin permisos para publicar ni responder temas.
						{elseif !$topic.comu_p_post}
							 sin permisos para publicar temas.
						{elseif !$topic.comu_p_com}
							 sin permisos para responder temas.
						{/if}
					</tr>
					{if $me.m_rank}
					<tr>
						<td class="title-left">Mi rango:</td>
						<td class="title-right">{if $me.r_name}{$me.r_name}{else}{$topic.comu_rank}{/if}</td>
					</tr>
					{/if}
				</table>
			</div>
			<div class="floatL">
				{if $user->uid}
				{if $user->permits.scs || $user->permits.rcs}
				{if $topic.comu_status == 1 && $user->permits.scs}
				<a class="button_1 plus-icon stip" onclick="comus.ban({$topic.comu_id})" title="Suspender comunidad">
					<i class="icon nm power_off"></i>
				</a>
				{/if}
				{if $topic.comu_status == 0 && $user->permits.rcs}
				<a class="button_1 plus-icon stip" onclick="comus.unban({$topic.comu_id})" title="Reactivar comunidad">
					<i class="icon nm power_on"></i>
				</a>
				{/if}
				{/if}
				{if $me.m_rank == 1 || $me.m_rank == 2 || $me.m_user == $topic.comu_admin || $user->permits.ecs}
				<a class="button_1 plus-icon" href="{$web.url}/comunidades/{$topic.comu_seo}/editar/">
					<i class="icon edit"></i>Editar
				</a>
				{/if}
				<div class="join-community">
					<a class="button_1 plus-icon join" onclick="comus.join({$topic.comu_id})" {if $me.m_user}style="display:none"{/if}>Unirme</a>
					<a class="button_1 plus-icon leave" onclick="comus.leave({$topic.comu_id})" {if !$me.m_user}style="display:none"{/if}>Abandonar</a>
				</div>
				<div id="follows-buttons" data-type="comus" type-id="{$topic.comu_id}" style="display:inline-block;">
					<a class="button_1 plus-icon to_follow require-login" style="{if $user->is_following('comu', $topic.comu_id)}display:none;{/if}"><img src="{$web.icons}/follow.png"/>Seguir</a>
					<a class="button_3 plus-icon ok_follow" style="{if !$user->is_following('comu', $topic.comu_id)}display:none;{/if}">Siguiendo</a>
					<a class="b_cancel plus-icon un_follow" style="display:none;">Dejar de seguir</a>
				</div>
				
				{/if}
			</div>
			<ul class="clearfix action-data">
				<li class="members-count"><span>{$topic.comu_members}</span> Miembros</li>
				<li class="temas-count"><span>{$topic.comu_topics}</span> Temas</li>
				<li class="followers-count" style="border-right:0 none; padding-right:0!important;"><span class="data-followers-count">{$topic.comu_followers}</span> Seguidores</li>
			</ul>
		</div>
	</div>
</div>