<div id="main-col" style="margin-left:5px;">
	<div class="box">
		<div class="box_title">&Uacute;ltimas notificaciones</div>
		<div class="box_body all_filters" style="position: relative;">
			
			<div class="list-header clearfix">
				{if $notifications|count == 0}
				<div id="error" style="margin: 0 1px 1px 1px;">No hay notificaciones</div>
				{/if}
				{foreach from=$notifications item=n}
				<div class="thread clearfix">
					<a class="author-avatar" href="{$web.url}/{$n.user}">
						<img src="{$web.avatar}/{$n.n_user_from}_32.jpg?{$n.u_last_avatar}">
					</a>
					<div class="info">
						{if $n.show_user}<a href="{$web.url}/{$n.user}">{$n.user}</a> {/if}{$n.text} <a href="{$n.link}" class="stip" title="{$n.title}">{$n.obj}</a>{if $n.complement} {$n.complement}{/if}
						<span>
							{$n.date}
						</span>
					</div>
				</div>
				{/foreach}
				{if $notifications|count == $limit}
				<a class="load_more" onclick="monitor.view_more($(this))">Mostrar m&aacute;s</a>
				{/if}
			</div>
		</div>
	</div>
</div>