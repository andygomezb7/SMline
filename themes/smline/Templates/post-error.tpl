{include file='includes/header.tpl'}

<div id="alertmsg2">
	<h1>Error! {$post.0}</h1>
	<p>{$post.1}</p>
	<h1 class="simiposts">Posts similares</h1>
	<div class="simiposts-list">
		{if $post.2}
		{foreach from=$post.2 item=p}
		<div class="list-simi">
			<i class="etip icon" title="{$p.c_name}" style="background: url({$web.icons}/cats/{$p.c_img}) no-repeat;"></i>
			<a href="{$web.url}/posts/{$p.c_seo}/{$p.p_id}/{$p.p_title|seo}.html" title="{$p.p_title}">{$p.p_title}</a>
		</div>
		{/foreach}
		{elseif !$post.2}<div id="error">No hay posts similares pero aún puedes usar el <a href="{$web.url}/buscador">buscador</a></div>{/if}
	</div>
</div>

{include file='includes/footer.tpl'}