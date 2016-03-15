<div class="box">
	<div class="box_title">Posts recientes</div>
	<div class="box_body last_posts" style="position: relative;">
		{foreach from=$last_stickys.list item=p}
			{include file='i_home/foreach_last_posts.tpl'}
		{/foreach}
		{if !$last_posts.list && !$last_stickys.list}<div class="emptyData">No hay posts en {$web.title}</div>{/if}
		{foreach from=$last_posts.list item=p}
			{include file='i_home/foreach_last_posts.tpl'}
		{/foreach}
		{$last_posts.pages}
	</div>
</div>