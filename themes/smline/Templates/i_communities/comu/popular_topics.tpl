<div class="box margin-top-5">
	<div class="box_title">Temas populares</div>
	<div class="box_body" style="position: relative;">

		{if !$popular_topics.list}<div id="error">No hay temas para mostrar.</div>{/if}
		{foreach from=$popular_topics.list item=t}
		<div class="list-element">
			<a href="{$web.url}/comunidades/{$t.comu_seo}/{$t.t_id}/{$t.t_title|seo}.html" title="{$t.t_title}">{$t.t_title}</a>
			<span class="value">{$t.t_positives}</span>
		</div>
		{/foreach}
	</div>
</div>