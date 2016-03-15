	<div class="box">
		<div class="box_title">Comunidades recomendadas</div>
		<div class="box_body last_members list_element">
		
		{foreach from=$mis_comus.recomendadas item=co}
			<div class="list-element">
				<a href="{$web.url}/comunidades/{$co.comu_seo}/">
					<img src="{$web.url}/thumbs/comus/t_{$co.comu_id}.jpg?{$co.comu_last_image}" alt="Ir a la comunidad" title="Ir a la comunidad" width="32px" height="32px" />
				</a>
				<a class="u_nick" href="{$web.url}/comunidades/{$co.comu_seo}/">{$co.comu_name}</a>
				
			</div>
		{/foreach}
		
		{if !$mis_comus.recomendadas}<div class="emptyData">No hay comunidades recomendadas</div>{/if}
		</div>
	</div>