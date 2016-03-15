<div class="box margin-top-5">
	<div class="box_title">Respuestas recientes</div>
	<div class="box_body list_element">
		{if $last_comments}
		{foreach from=$last_comments item=t}
		<div class="list-element">
			<a href="{$web.url}/{$t.u_nick}" class="subinfo">{$t.u_nick}</a>
			<a href="{$web.url}/comunidades/{$t.comu_seo}/{$t.t_id}/{$t.t_title|seo}.html">{$t.t_title}</a>
		</div>
		{/foreach}
		{else}
		<div id="error">No hay respuestas por mostrar</div>
		{/if}
	</div>
</div>