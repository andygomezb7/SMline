{if !$last_posts.list}<div class="emptyData">No hay m&aacute;s posts para mostrar en {$web.title}</div>{/if}
		{foreach from=$last_posts.list item=p}
			{include file='i_home/foreach_last_posts_portadas.tpl'}
		{/foreach}
<div style="margin-left:5px;clear: both;">{$last_posts.pages}</div>