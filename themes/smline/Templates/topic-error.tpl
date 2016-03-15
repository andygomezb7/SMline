{include file='includes/header.tpl'}

<div id="alertmsg2">
	<h1>Error! {$topic.0}</h1>
	<p>{$topic.1}</p>
	<h1 class="simiposts">Temas similares</h1>
	<div class="simiposts-list">
		{if $topic.2}
		{foreach from=$topic.2 item=t}
		<div class="list-simi">
			<i class="etip icon" title="{$t.c_name}" style="background: url({$web.icons}/comus-cats/{$t.c_img}) no-repeat;"></i>
			<a href="{$web.url}/comunidades/{$t.comu_seo}/{$t.t_id}/{$t.t_title|seo}.html" title="{$t.t_title}">{$t.t_title}</a>
		</div>
		{/foreach}
		{elseif !$topic.2}<div id="error">No hay temas similares pero aún puedes usar el <a href="{$web.url}/buscador">buscador</a></div>{/if}
	</div>
</div>

{include file='includes/footer.tpl'}