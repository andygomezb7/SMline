<div class="box box-top">	<div class="box_title">Posts con más puntos</div>		<div class="box_body list_element">		{if !$posts_puntos}<div class="emptyData">Nada por aqu&iacute;</div>{/if}		{foreach from=$posts_puntos item=p key=i}		<div class="list-element">			<span class="number-list">{$i+1}</span>			<i class="icon" title="{$p.c_name}" style="background: url({$web.icons}/cats/{$p.c_img}) no-repeat;"></i>			<a href="{$web.url}/posts/{$p.c_seo}/{$p.p_id}/{$p.p_title|seo}.html" title="{$p.p_title}">{$p.p_title|substr:0:28}</a>			<span class="value">{$p.p_puntos}</span>		</div>		{/foreach}	</div></div><div class="box box-top">	<div class="box_title">Posts con más favoritos</div>		<div class="box_body list_element">		{if !$posts_favoritos}<div class="emptyData">Nada por aqu&iacute;</div>{/if}		{foreach from=$posts_favoritos item=p key=i}		<div class="list-element">			<span class="number-list">{$i+1}</span>			<i class="icon" title="{$p.c_name}" style="background: url({$web.icons}/cats/{$p.c_img}) no-repeat;"></i>			<a href="{$web.url}/posts/{$p.c_seo}/{$p.p_id}/{$p.p_title|seo}.html" title="{$p.p_title}">{$p.p_title|substr:0:28}</a>			<span class="value">{$p.p_favs}</span>		</div>		{/foreach}	</div></div><div class="box margin-top-5 box-top">	<div class="box_title">Posts con más seguidores</div>		<div class="box_body list_element">		{if !$posts_seguidores}<div class="emptyData">Nada por aqu&iacute;</div>{/if}		{foreach from=$posts_seguidores item=p key=i}		<div class="list-element">			<span class="number-list">{$i+1}</span>			<i class="icon" title="{$p.c_name}" style="background: url({$web.icons}/cats/{$p.c_img}) no-repeat;"></i>			<a href="{$web.url}/posts/{$p.c_seo}/{$p.p_id}/{$p.p_title|seo}.html" title="{$p.p_title}">{$p.p_title|substr:0:28}</a>			<span class="value">{$p.p_follows}</span>		</div>		{/foreach}	</div></div><div class="box margin-top-5 box-top">	<div class="box_title">Posts con más comentarios</div>		<div class="box_body list_element">		{if !$posts_comentarios}<div class="emptyData">Nada por aqu&iacute;</div>{/if}		{foreach from=$posts_comentarios item=p key=i}		<div class="list-element">			<span class="number-list">{$i+1}</span>			<i class="icon" title="{$p.c_name}" style="background: url({$web.icons}/cats/{$p.c_img}) no-repeat;"></i>			<a href="{$web.url}/posts/{$p.c_seo}/{$p.p_id}/{$p.p_title|seo}.html" title="{$p.p_title}">{$p.p_title|substr:0:28}</a>			<span class="value">{$p.p_comments}</span>		</div>		{/foreach}	</div></div>