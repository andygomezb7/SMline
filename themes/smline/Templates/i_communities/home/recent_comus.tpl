<div class="box margin-top-5">
	<div class="box_title">Comunidades recientes</div>
	<div class="box_body list_element">
		{if !$recent_comus}<div class="emptyData">No hay comunidades nuevas</div>{/if}
		{foreach from=$recent_comus item=c}
		<div class="list-element">
			<a href="{$web.url}/comunidades/{$c.comu_seo}/">{$c.comu_name}</a>
		</div>
		{/foreach}
		<div class="box_more">
			<a href="{$web.url}/comunidades/crear">Crea la tuya</a>
		</div>
	</div>
</div>
{$c_action}