1: 
<div class="box_title">
	Seguidores
</div>
<div class="profile_status clearfix activity_listest">
	{foreach from=$u_follows item=u}
	<li class="activity-list clearfix">
		<a href="{$web.url}/{$u.u_nick}" class="floatL" alt="Avatar" title="{$u.u_nick}">
			<img src="{$web.avatar}/{$u.u_id}_50.jpg?{$u.u_last_avatar}" />
		</a>
		<div class="follows_right_content">
			<a href="{$web.url}/{$u.u_nick}" class="hovercard floatL" uid="{$u.u_id}" title="{$u.u_nick}">{$u.u_nick}</a><br />
			<img src="{$web.icons}/flag/{$u.u_country|strtolower}.png" class="stip" title="{$data_paises[$u.u_country]}" />
			<span class="date">{$u.u_bio}</span>
		</div>
	</li>
	{/foreach}
</div>

{if !$u_follows}<div class="emptyData">Este usuario no tiene seguidores</div>{/if}

{if $u_follows|count >= 18}
<a class="load_more" onclick="profile.follows_load_more();">Cargar más seguidores</a>
<div id="error" class="no_hay_mas_activity" style="display:none">No hay más seguidores</div>
{/if}
<input type="hidden" name="follows_start" value="1" />