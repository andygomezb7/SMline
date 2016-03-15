{if $u_posts}1: {else}2: {/if} 
	{foreach from=$u_posts item=p}
	<li class="activity-list">
		<i class="etip icon" title="{$p.c_name}" style="background: url({$web.icons}/cats/{$p.c_img}) no-repeat;"></i>
		<a href="{$web.url}/posts/{$p.c_seo}/{$p.p_id}/{$p.p_title|seo}.html" title="{$p.p_title}">{$p.p_title}</a>
		<p>{$p.p_date|hace} &#8226; {$p.p_puntos} puntos</p>
	</li>
	{/foreach}