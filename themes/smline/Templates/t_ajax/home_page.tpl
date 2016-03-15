		{if !$last_posts.list}<div id="error">No hay más posts por mostrar</div>{/if}
		{foreach from=$last_posts.list item=p}
			{include file='i_home/foreach_last_posts.tpl'}
		{/foreach}
		{$last_posts.pages}