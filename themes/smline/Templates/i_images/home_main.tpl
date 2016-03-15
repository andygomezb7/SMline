<div class="box">
	<div class="box_title">Imágenes recientes</div>
	<div class="box_body last_images clearfix" style="padding: 4px;padding-left:0;">
		{foreach from=$last_images.list item=i}
		<div class="img-list">
			<div class="img-head"><a class="img-title stip" href="{$web.url}/imagenes/{$i.i_id}/{$i.i_title|seo}.html" title="{$i.i_title}">{$i.i_title|substr:0:30}</a><a onclick="img.prev({$i.i_id}, $(this));" class="stip floatR" title="Previsualizar imagen" style="margin-top: 3px;"><img src="{$web.icons}/eye_.png" /></a></div>
			<a href="{$web.url}/imagenes/{$i.i_id}/{$i.i_title|seo}.html"><img src="{$web.url}/thumbs/images/t_{$i.i_id}.jpg" class="img-src" /></a>
			<span class="img-desc">{$i.i_description|substr:0:220}</span>
			<span class="img-date">{$i.i_date|hace} por @<a href="{$web.url}/{$i.u_nick}">{$i.u_nick}</a></span>
		</div>
		{/foreach}
		{if $last_images.pages}
		<div style="margin-left:5px;clear: both;">{$last_images.pages}</div>
		{/if}
		{if !$last_images.list}<div class="emptyData">No hay im&aacute;genes recientes</div>{/if}
	</div>
</div>