1: 
{foreach from=$replies item=c}
<div id="comment-{$c.c_id}" class="list-comment clearfix">
	<div class="floatL">
		<a href="{$web.url}/{$c.u_nick}"><img src="{$web.avatar}/{$c.u_id}_32.jpg?{$c.u_last_avatar}" class="avatar-2"/></a>
	</div>
	<div class="floatR c-body c-is-replie">
		<span class="dialog-comment"></span>
		<div class="comment-info">
			<a href="{$web.url}/{$c.u_nick}" class="hovercard" uid="{$c.u_id}">{$c.u_nick}</a>
			 <span class="stip" title="{$c.c_date|date_format:"%d/%m/%Y %I:%M %p"}">{$c.c_date|hace}</span>
			 <span class="cm-votes cm-v-id-{$c.c_id}{if !$c.c_votos} hide{/if}{if $c.c_votos > 0} positives{/if}{if $c.c_votos < 0} negatives{/if}">
				<span class="total-vptes">{if $c.c_votos > 0}+{/if}{$c.c_votos}</span>
			</span>
			 <div class="comment-options">
					{if $c.u_id != $user->uid && $user->permits['vpc'] && !$c.vote}<a onclick="{if $replies_type == 'images'}img{elseif $replies_type == 'topics'}topic{else}post{/if}.comments.vote(1,{$c.c_id}, $(this))" class="button_1 type_3 stip" title="Me gusta"><img src="{$web.icons}/up.png"></a>{/if}
					{if $c.u_id != $user->uid && $user->permits['vnc'] && !$c.vote}<a onclick="{if $replies_type == 'images'}img{elseif $replies_type == 'topics'}topic{else}post{/if}.comments.vote(0,{$c.c_id}, $(this))" class="button_1 type_3 stip" title="No me gusta"><img src="{$web.icons}/down.png"></a>{/if}
				<a onclick="{if $replies_type == 'images'}img{elseif $replies_type == 'topics'}topic{else}post{/if}.comments.del({$c.c_id})" class="button_1 type_3 stip" title="Borrar respuesta"><img src="{$web.icons}/delete_.png"></a>
			</div>
		</div>
		<div class="comment-body">{$c.c_body}</div>
	</div>
</div>
{/foreach}