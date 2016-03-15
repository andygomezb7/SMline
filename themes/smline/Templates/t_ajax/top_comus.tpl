{if !$top_comus}<div class="emptyData">No hay comunidades en este rango de tiempo</div>{/if}
{foreach from=$top_comus item=c key=i}
<div class="list-element">
	<span class="number-list">{$i+1}</span>
	<a href="{$web.url}/comunidades/{$c.comu_seo}/" title="{$c.comu_name}">{$c.comu_name|substr:0:28}</a>
	<span class="value">{$c.total}</span>
</div>
{/foreach}
<div class="box_more">
	<a href="{$web.url}/tops/comunidades">Ver m&aacute;s</a>
</div>