{if !$members.list}0: No hay miembros con los filtros seleccionados
{else}
1: 

<div class="members_list">
{foreach from=$members.list item=u}
	<div class="resultBox clearfix" id="userid_{$u.u_id}">
		<div class="floatL avatarBox">
			<a href="{$web.url}/{$u.u_nick}" class="hovercard" uid="{$u.u_id}" title="{$u.u_nick}">
				<img width="75px" height="75px" src="{$web.avatar}/{$u.u_id}_120.jpg?{$u.u_last_avatar}">
			</a>
		</div>
		<div class="floatL infoBox">
			<h4>
				<a href="{$web.url}/{$u.u_nick}" title="Perfil de Agustyto">{$u.u_nick}</a>
			</h4>
			<ul>
				<li>Rango: <strong>{if $u.r_name}{$u.r_name}{else}{$u.comu_rank}{/if}</strong></li>
				<li><a href="{$web.url}/mensajes/a/{$u.u_nick}" title="Enviar mensaje">Enviar mensaje</a></li>
				{if $user->uid != $u.u_id}<li><a onclick="admin_comu.admin_member({$u.comu_id}, {$u.u_id})" title="Administrar miembro">Administrar</a></li>{/if}
			</ul>
		</div>
	</div>
{/foreach}
</div>

{$members.pages}

{/if}