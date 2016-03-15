{if $u_info.u_image || $u_info.u_color}
<style type="text/css">
body {literal}{{/literal}
	{if $u_info.u_image}background-image: url({$u_info.u_image});
	background-repeat: {if !$u_info.u_image_repeat}no-{/if}repeat;{/if}
	background-color: #{$u_info.u_color};

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
<div class="profile_main">
	<div id="profile_content_main">
		<div id="user_info_cell" class="clearfix">
			<div class="user_icons">
				<img src="{$web.icons}/{if $u_info.u_sex == 1}fe{/if}male.png" class="stip" title="{if $u_info.u_sex == 1}Mujer{else}Hombre{/if}" />
				<img src="{$web.icons}/flag/{$u_info.u_country|strtolower}.png" class="stip" title="{$u_info.u_country_name}" />
				<img src="{$web.icons}/ranks/{$u_info.r_image}" class="stip" title="{$u_info.r_name}" />
			</div>
			<h1 class="type_pagetitle">
				<h1 class="fn nickname">{$u_info.u_nick}{if $u_info.u_names || $u_info.u_surnames} <small>({$u_info.u_names} {$u_info.u_surnames})</small>{/if}</h1>
			</h1>
			<div class="u_r_s">
				<span style="color:#{$u_info.r_color}" class="etip r_name" title="Rango">{$u_info.r_name}</span>
				{if $u_info.u_site}
				 - <a href="{$u_info.u_site}" target="_blank" rel="nofollow">{$u_info.u_site}</a>
				{/if}
			</div>
			{if $u_info.u_bio}
			<span class="user_bio">{$u_info.u_bio}</span>
			{else}
			<img src="{$web.icons}/location.gif" class="u_p_r" /> Vive en {$u_info.u_country_name}
			<img src="{$web.icons}/time.png" class="u_p_r marg" /> Miembro desde el {$u_info.u_register.0} de {$u_info.u_register.1} de {$u_info.u_register.2}<br>
			{/if}
			<div class="u_s_a">
			{if $user->is_online($u_info.u_id)}<span class="badge badge_green reset_cursor">Conectado</span>
			{else}<span class="badge badge_lightgrey reset_cursor">Desconectado</span>{/if}
			<span class="desc lighter" style="color: #a4a4a4;">Última actividad {$u_info.last_active}</span>
			</div>
			
			{if ($user->permits.gomod || $user->permits.goadmin) && $u_info.u_status == 3}
				<div id="error" style="margin-top:10px;">Este usuario se encuentra actualmente suspendido</div>
			{/if}
	
			<div class="profile_actions">
				
				{if $user->permits.su && $u_info.u_id != $user->uid && $u_info.u_status != 3}
				<a onclick="mod.banned({$u_info.u_id})" class="button_1 margin-top-5"><img src="{$web.icons}/minus.png"/>Suspender</a>
				{elseif $user->permits.ru && $u_info.u_id != $user->uid && $u_info.u_status == 3}
				<a onclick="mod.unbanned({$u_info.u_id}, '{$u_info.u_nick}')" class="button_1 margin-top-5"><img src="{$web.icons}/sok.png"/>Reactivar</a>
				{/if}
				{if $user->permits.aeu && $u_info.u_id != $user->uid}
				<a href="{$web.url}/admin?do=users&action=edit&uid={$u_info.u_id}" class="button_1 margin-top-5"><img src="{$web.icons}/edit_.png"/>Editar usuario</a>
				{/if}
				{if $u_info.u_id == $user->uid}
				<a href="{$web.url}/cuenta#perfil" class="button_1 margin-top-5"><img src="{$web.icons}/edit_.png"/>Editar perfil</a>
				{elseif $user->uid}
				<a href="{$web.url}/mensajes/a/{$u_info.u_nick}" class="button_1 margin-top-5"><img src="{$web.icons}/message.png"/>Enviar mensaje</a>
				<div id="follows-buttons" data-type="user" type-id="{$u_info.u_id}">
					<a class="button_1 to_follow" style="{if $user->is_following('user', $u_info.u_id)}display:none;{/if}"><img src="{$web.icons}/follow.png"/>Seguir</a>
					<a class="button_3 ok_follow" style="{if !$user->is_following('user', $u_info.u_id)}display:none;{/if}">Siguiendo</a>
					<a class="b_cancel un_follow" style="display:none;">Dejar de seguir</a>
				</div>
				{/if}
				
				{if $user->uid && $u_info.u_id != $user->uid}
				<a class="button_1 type_5 stip floatR" onclick="user.new_report('usuario', '{$u_info.u_nick}', false, {$u_info.u_id});" title="Reportar usuario"><img src="{$web.icons}/flag.png"></a>
				{/if}
			</div>
			
		</div>
		
		<div class="profile_tab_active">
		{include file='i_profile/states.tpl'}
		</div>
	</div>
</div>