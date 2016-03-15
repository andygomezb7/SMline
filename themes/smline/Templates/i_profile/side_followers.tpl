<div class="box box_autor margin-top-5">
	<div class="box_title">Seguidores<span class="title_right_info">{$u_info.u_follows}</span></div>
	<div class="box_body {if $u_info.u_followers}for_followers{/if}">
		<div class="profile_side_lists clearfix">
			{if !$u_followers}<div id="error">{$u_info.u_nick} no tiene seguidores</div>{/if}
			{foreach from=$u_followers item=u}
				<li class="list_follows">
					<a href="{$web.url}/{$u.u_nick}" class="hovercard" uid="{$u.u_id}" title="{$u.u_nick}"><img src="{$web.avatar}/{$u.u_id}_50.jpg?{$u.u_last_avatar}" /></a>
				</li>
			{/foreach}
		</div>
		{if $u_info.u_follows > 18}
			<div class="box_more">
				<a onclick="profile.load_tab('follows');" href="#seguidores">Ver más</a>
			</div>
		{/if}
	</div>
</div>

<div class="box box_autor margin-top-5">
	<div class="box_title">Siguiendo<span class="title_right_info">{$u_info.u_following}</span></div>
	<div class="box_body {if $u_info.u_following}for_followers{/if}">
		<div class="profile_side_lists clearfix">
			{if !$u_following}<div id="error">{$u_info.u_nick} no sigue usuarios</div>{/if}
			{foreach from=$u_following item=u}
				<li class="list_follows">
					<a href="{$web.url}/{$u.u_nick}" class="hovercard" uid="{$u.u_id}" title="{$u.u_nick}"><img src="{$web.avatar}/{$u.u_id}_50.jpg?{$u.u_last_avatar}" /></a>
				</li>
			{/foreach}
		</div>
		{if $u_info.u_following > 18}
			<div class="box_more">
				<a onclick="profile.load_tab('following');" href="#siguiendo">Ver más</a>
			</div>
		{/if}
	</div>
</div>	