<div class="related-left">	<div class="box margin-top-5 posts-related">		<div class="box_title">Posts relacionados</div>		<div class="box_body clearfix">			{if !$post.related}<div id="error">No hay posts relacionados</div>{/if}			{foreach from=$post.related item=p}			<div class="list-element"><i class="etip icon" title="{$p.c_name}" style="background: url({$web.icons}/cats/{$p.c_img}) no-repeat;"></i><a href="{$web.url}/posts/{$p.c_seo}/{$p.p_id}/{$p.p_title|seo}.html" title="{$p.p_title}">{$p.p_title}</a></div>			{/foreach}		</div>	</div></div>