{if $u_info.u_medals}
<div class="box box_autor margin-top-5">
	<div class="box_title">Medallas<span class="title_right_info">{$u_info.u_medals}</span></div>
	<div class="box_body">
		<div class="profile_side_lists clearfix">
			{foreach from=$list_medals item=m}
				<img src="{$web.icons}/medals/{$m.m_image}" class="stip" title="{$m.m_title}" />
			{/foreach}
		</div>
		<div class="box_more">
			<a href="#medallas" onclick="profile.load_tab('medals');">Ver más</a>
		</div>
	</div>
</div>
{/if}