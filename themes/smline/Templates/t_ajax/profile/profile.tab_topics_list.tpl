{if $u_topics}1: {else}2: {/if} 
	{foreach from=$u_topics item=t}
	<li class="activity-list">
		<i class="etip icon" title="{$t.c_name}" style="background: url({$web.icons}/comus-cats/{$t.c_img}) no-repeat;"></i>
		<a href="{$web.url}/comunidades/{$t.comu_seo}/{$t.t_id}/{$t.t_title|seo}.html" title="{$t.t_title}">{$t.t_title}</a>
		<p>{$t.t_date|hace} en <a href="{$web.url}/comunidades/{$t.comu_seo}/">{$t.comu_name}</a></p>
	</li>
	{/foreach}