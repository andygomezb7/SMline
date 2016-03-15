<div id="comm-thread-list">
	<div class="list-header clearfix">
		<h3>Temas</h3>
		{if $me.m_user}
			{if $tsUser->is_admod || $myRank.me_rango == 1 || $myRank.me_rango == 2 && $action != 'temas-borrados'}
			<a class="btn r floatR" href="{$web.url}/comunidades/{$comu.comu_seo}/temas-borrados/" style="display: inline-block;">
				<div class="btn-text unfollow-text">Temas borrados</div>
			</a>
			{/if}
			<a class="button_1 b_ok floatR" href="{$web.url}/comunidades/{$comu.comu_seo}/agregar/">Nuevo Tema</a>
		{/if}
	</div>
	{foreach from=$sticky_topics.list item=t}
	<div class="thread clearfix">
		<a class="author-avatar" href="{$web.url}/{$t.u_nick}">
			<img src="{$web.avatar}/{$t.t_user}_32.jpg?{$t.u_last_avatar}">
		</a>
		<div class="info">
			<i class="icon sticky" title="Sticky"></i>
			<a href="{$web.url}/comunidades/{$t.comu_seo}/{$t.t_id}/{$t.t_title|seo}.html" class="topic-title">
				{$t.t_title}
			</a>
			<span>
				Por <a class="nick" href="{$web.url}/{$t.u_nick}">{$t.u_nick}</a> {$t.t_date|hace:true}
			</span>
		</div>
		<div class="topic-stats">
			<div class="button-action-s">
				<i class="smarticon new_comment"></i>
				<div class="action-number">
					<span>{$t.t_comments}</span>
				</div>
			</div>
			<div class="button-action-s">
				<i class="smarticon vote_pos"></i>
				<div class="action-number">
					<span>{$t.t_positives}</span>
				</div>
			</div>
		</div>
	</div>
	{/foreach}
</div>
	
<div id="comm-thread-list" {if $sticky_topics}style="margin-top:10px"{/if}>
	
	{foreach from=$last_topics.list item=t}
	<div class="thread clearfix">
		<a class="author-avatar" href="{$web.url}/{$t.u_nick}">
			<img src="{$web.avatar}/{$t.t_user}_32.jpg?{$t.u_last_avatar}">
		</a>
		<div class="info">
			<a href="{$web.url}/comunidades/{$t.comu_seo}/{$t.t_id}/{$t.t_title|seo}.html" class="topic-title">
				{$t.t_title}
			</a>
			<span>
				Por <a class="nick" href="{$web.url}/{$t.u_nick}">{$t.u_nick}</a> {$t.t_date|hace:true}
			</span>
		</div>
		<div class="topic-stats">
			<div class="button-action-s">
				<i class="smarticon new_comment"></i>
				<div class="action-number">
					<span>{$t.t_comments}</span>
				</div>
			</div>
			<div class="button-action-s">
				<i class="smarticon vote_pos"></i>
				<div class="action-number">
					<span>{$t.t_positives}</span>
				</div>
			</div>
		</div>
	</div>
	{/foreach}
	
	{$last_topics.pages}
	
	
	
</div>