{if $comu.comu_image || $comu.comu_color}
<style type="text/css">
body {literal}{{/literal}
	{if $comu.comu_image}background-image: url({$comu.comu_image});
	background-repeat: {if !$comu.comu_image_repeat}no-{/if}repeat;{/if}
	background-color: #{$comu.comu_color};

{literal}}
.profile-content {
	background: transparent!important;
}
#content {
	background: rgba(255, 255, 255, 0.8)!important;
}
#header {
	box-shadow: 0 2px 20px #000000;
}
{/literal}
</style>
{/if}

<div class="comu-head">
	{if $comu.comu_status == 0}
	<div id="error">
		<u>{$comu.comu_name}</u> se encuentra suspendida. Puedes reactivarla haciendo click <a onclick="comus.unban({$comu.comu_id})">aqu&iacute;</a>
	</div>
	{/if}
	<div id="comunity-data-stats" class="big-group-info clearfix">
		<div class="floatL profile">
			<a href="{$web.url}/comunidades/{$comu.comu_seo}/">
				<img class="big-avatar" src="{$web.url}/thumbs/comus/t_{$comu.comu_id}.jpg?{$comu.comu_last_image}" alt="Ir a la comunidad" title="Ir a la comunidad">
			</a>
		</div>
		<div class="big-group-data">
			<div class="clearfix">
				<h1><a href="{$web.url}/comunidades/{$comu.comu_seo}/">{$comu.comu_name}</a></h1>
			</div>
			<div class="info-basic">
				<p>{$comu.comu_desc}</p>
				<a onclick="mydialog.alert('Información', $('.view-more-info').html());" title="Ver más">Ver más información</a>
			</div>
			<div class="view-more-info" style="display:none">
				<table cellpadding="0" cellspacing="0" border="0" class="comu-info-table">
					<tr>
						<td class="title-left">Categoría:</td>
						<td class="title-right"><a href="{$web.url}/comunidades/home/{$comu.c_seo}" title="{$comu.c_name}">{$comu.c_name}</a></td>
					</tr>
						<td class="title-left">Creada:</td>
						<td class="title-right"> por <a title="Ver el perfil de {$comu.u_nick}" href="{$web.url}/{$comu.u_nick}"><b>{$comu.u_nick}</b></a> {$comu.comu_date|hace}</td>
					</tr>
					<tr>
						<td class="title-left">Tipo de validación:</td>
						<td class="title-right">Los nuevos miembros son aceptados automaticamente con el rango <b>{$comu.comu_rank}</b>
						{if !$comu.comu_p_post && !$comu.comu_p_com}
							 sin permisos para publicar ni responder temas.
						{elseif !$comu.comu_p_post}
							 sin permisos para publicar temas.
						{elseif !$comu.comu_p_com}
							 sin permisos para responder temas.
						{/if}
					</tr>
					<tr>
						<td class="title-left">Descripción:</td>
						<td class="title-right">{$comu.comu_desc}</td>
					</tr>
					{if $me.m_rank}
					<tr>
						<td class="title-left">Mi rango:</td>
						<td class="title-right">{if $me.r_name}{$me.r_name}{else}{$comu.comu_rank}{/if}</td>
					</tr>
					{/if}
				</table>
			</div>
			<div class="floatL">
				{if $user->uid}
				
				{if $comu.comu_admin != $user->uid && !$user->permits['goadmin'] && !$user->permits['gomod']}
				<a class="button_1 plus-icon stip require-login" onclick="user.new_report('comunidad', '{$comu.comu_name}', false, {$comu.comu_id});" title="Reportar comunidad"><img src="{$web.icons}/flag.png" style="margin:0" /></a>
				{/if}
				
				{if $user->permits.scs || $user->permits.rcs}
				{if $comu.comu_status == 1 && $user->permits.scs}
				<a class="button_1 plus-icon stip" onclick="comus.ban({$comu.comu_id})" title="Suspender comunidad">
					<i class="icon nm power_off"></i>
				</a>
				{/if}
				{if $comu.comu_status == 0 && $user->permits.rcs}
				<a class="button_1 plus-icon stip" onclick="comus.unban({$comu.comu_id})" title="Reactivar comunidad">
					<i class="icon nm power_on"></i>
				</a>
				{/if}
				{/if}
				{if $me.m_rank == 1 || $me.m_rank == 2 || $me.m_user == $comu.comu_admin || $user->permits.ecs}
				<a class="button_1 plus-icon" href="{$web.url}/comunidades/{$comu.comu_seo}/editar/">
					<i class="icon edit"></i>Editar
				</a>
				{/if}
				<div class="join-community">
					<a class="button_1 plus-icon join" onclick="comus.join({$comu.comu_id})" {if $me.m_user}style="display:none"{/if}>Unirme</a>
					<a class="button_1 plus-icon leave" onclick="comus.leave({$comu.comu_id})" {if !$me.m_user}style="display:none"{/if}>Abandonar</a>
				</div>
				<div id="follows-buttons" data-type="comus" type-id="{$comu.comu_id}" style="display:inline-block;">
					<a class="button_1 plus-icon to_follow require-login" style="{if $user->is_following('comu', $comu.comu_id)}display:none;{/if}"><img src="{$web.icons}/follow.png"/>Seguir</a>
					<a class="button_3 plus-icon ok_follow" style="{if !$user->is_following('comu', $comu.comu_id)}display:none;{/if}">Siguiendo</a>
					<a class="b_cancel plus-icon un_follow" style="display:none;">Dejar de seguir</a>
				</div>
				
				{/if}
			</div>
			<ul class="clearfix action-data">
				<li class="members-count"><span>{$comu.comu_members}</span> Miembros</li>
				<li class="temas-count"><span>{$comu.comu_topics}</span> Temas</li>
				<li class="followers-count" style="border-right:0 none; padding-right:0!important;"><span class="data-followers-count">{$comu.comu_followers}</span> Seguidores</li>
			</ul>
		</div>
	</div>
</div>