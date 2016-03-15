{if $u_follows}1: {else}2: {/if} 
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