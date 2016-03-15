{if $u_images}1: {else}2: {/if} 
	{foreach from=$u_images item=i}
	<li class="activity-list clearfix">
		<a href="{$web.url}/imagenes/{$i.i_id}/{$i.i_title|seo}.html" class="left-img">
			<img src="{$web.url}/thumbs/images/t_{$i.i_id}.jpg" />
		</a>
		<div class="right-desc">
			<a href="{$web.url}/imagenes/{$i.i_id}/{$i.i_title|seo}.html" title="{$i.i_title}">{$i.i_title}</a>
			<p>{$i.i_description}</p>
		</div>
	</li>
	{/foreach}