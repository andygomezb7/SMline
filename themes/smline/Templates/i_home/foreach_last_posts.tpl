<div class="list-element{if $p.p_sticky == 2} patrocinado{/if}">
	{if $p.p_sticky}
		<i class="icon sticky" title="Sticky"></i>
	{/if}
	<i class="icon" title="{$p.c_name}" style="background: url({$web.icons}/cats/{$p.c_img}) no-repeat;"></i>
	<a href="{$web.url}/posts/{$p.c_seo}/{$p.p_id}/{$p.p_title|seo}.html" title="{$p.p_title}" {if $p.p_status != 1}style="font-weight: normal;{if $p.p_status == 0}color:red{elseif $p.p_status == 2}color:indigo{/if}"{/if}>{$p.p_title}</a>
	{if $p.p_status != 1}
	<a class="stip floatR" title="Este post se encuentra {if $p.p_status == 0}eliminado{elseif $p.p_status == 2}en revisión{/if}">
		<i class="icon info nm"></i>
	</a>
	{/if}
</div>