		{if !$last_topics.list}<div class="emptyData">No hay m&aacute;s temas para mostrar en {$web.title}</div>{/if}
		{foreach from=$last_topics.list item=t}
		<div class="list-element">
			<i class="etip icon" title="{$t.c_name}" style="background: url({$web.icons}/comus-cats/{$t.c_img}) no-repeat;"></i>
			<a href="{$web.url}/comunidades/{$t.comu_seo}/{$t.t_id}/{$t.t_title|seo}.html" title="{$t.t_title}" {if $t.t_status == 0 || $t.comu_status == 0}style="font-weight: normal;color:red"{/if}>{$t.t_title}</a>
			{if $t.t_status == 0}
			<a class="stip floatR" title="Este tema se encuentra eliminado">
				<i class="icon info nm"></i>
			</a>
			{elseif $t.comu_status == 0}
			<a class="stip floatR" title="La comunidad se encuentra suspendida">
				<i class="icon info nm"></i>
			</a>
			{/if}
			<p>En <a href="{$web.url}/comunidades/{$t.comu_seo}/">{$t.comu_name}</a> por <a href="{$web.url}/{$t.u_nick}">{$t.u_nick}</a></p>
		</div>
		{/foreach}
		{$last_topics.pages}