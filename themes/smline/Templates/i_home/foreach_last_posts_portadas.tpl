<div class="list-element-port clearfix">
	<div class="post-head">
		<a class="post-title stip" href="{$web.url}/posts/{$p.c_seo}/{$p.p_id}/{$p.p_title|seo}.html" title="{$p.p_title}" {if $p.p_status != 1}style="{if $p.p_status == 0}color:red{elseif $p.p_status == 2}color:indigo{/if}"{/if}>{$p.p_title|substr:0:40}</a>
		{if $p.p_status != 1}
		<a class="stip floatR" title="Este post se encuentra {if $p.p_status == 0}eliminado{elseif $p.p_status == 2}en revisión{/if}">
			<i class="icon info nm"></i>
		</a>
		{else}
		<i class="stip icon"" title="{$p.c_name}" style="float: right;margin: 0;background: url({$web.icons}/cats/{$p.c_img}) no-repeat;"></i>
		{/if}
	</div>
	<a href="{$web.url}/posts/{$p.c_seo}/{$p.p_id}/{$p.p_title|seo}.html" class="floatL"><img src="{$web.url}/thumbs/posts/t_{$p.p_id}.jpg?{$p.p_update}" class="img-src"></a>
	<div class="post-right">
		<li class="list-post-stat">
			<i class="icon coins"></i><b>{$p.p_puntos}</b> puntos
		</li>
		<li class="list-post-stat">
			<i class="icon hits"></i><b>{$p.p_hits}</b> visitas
		</li>
		<li class="list-post-stat">
			<i class="icon comments"></i><b>{$p.p_comments}</b> comentarios
		</li>
		{if $p.p_sticky}
		<li class="list-post-stat">
			<i class="icon sticky floatR" title="Sticky"></i>{if $p.p_sticky == 2}Patrocinado{else}Sticky{/if}
		</li>
		{/if}
		<div style="margin-top: -5px;">
			<span class="post-date">{$p.p_date|hace}</span>
			<span class="post-date">Por @<a href="{$web.url}/{$p.u_nick}">{$p.u_nick}</a></span>
		</div>
	</div>
</div>