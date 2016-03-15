{if $popular_comu.comu_id}
<div class="box margin-top-5">
	<div class="box_title">Comunidad destacada</div>
	<div class="box_body list_element">
		<center>
		<a href="{$web.url}/comunidades/{$popular_comu.comu_seo}/">
			<img class="big-avatar" src="{$web.url}/thumbs/comus/t_{$popular_comu.comu_id}.jpg?{$popular_comu.comu_last_image}" alt="Ir a la comunidad" title="Ir a la comunidad {$popular_comu.comu_name}">
		</a>

		<a href="{$web.url}/comunidades/{$popular_comu.comu_seo}/" class="popular-comu-a">{$popular_comu.comu_name}</a>

		</center>
	</div>
</div>
{/if}