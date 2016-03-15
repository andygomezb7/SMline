<div class="box">
	<div class="box_title">{$s_filtros.total} resultados de "<h1>{$q}</h1>"</div>
	<div class="box_body all_filters" style="position: relative;">
		
		<div class="list-header clearfix">
			{foreach from=$s_filtros.list item=p}
			<div class="thread clearfix">
				<a class="author-avatar" href="{$web.url}/{$p.u_nick}">
					<img src="{$web.avatar}/{$p.u_id}_32.jpg?{$p.u_last_avatar}">
				</a>
				<div class="info">
					<a href="{$web.url}/posts/{$p.c_seo}/{$p.p_id}/{$p.p_title|seo}.html" class="topic-title">
						{$p.p_title}
					</a>
					<span>
						Por <a class="nick" href="{$web.url}/{$p.u_nick}">{$p.u_nick}</a> {$p.p_date|hace:true}
					</span>
				</div>
				<div class="topic-stats">
					<div class="button-action-s">
						<i class="smarticon new_comment"></i>
						<div class="action-number">
							<span>{$p.p_comments}</span>
						</div>
					</div>
					<div class="button-action-s">
						<i class="smarticon vote"></i>
						<div class="action-number">
							<span>{$p.p_puntos}</span>
						</div>
					</div>
				</div>
			</div>
			{/foreach}
		</div>
		
		{if $s_filtros.list}{$s_filtros.pages}
		{else}
		<div id="error">No encontramos resultados relacionados con tu b&uacute;squeda :(</div>
		{/if}
	</div>
</div>