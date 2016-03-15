1: 
{foreach from=$comments.list item=c}
	<div class="status_for_comments clearfix">
		<div class="floatL">
			<img src="{$web.avatar}/{$c.u_id}_32.jpg?{$c.u_last_avatar}" />
		</div>
		<div class="comment_body">
			{if (($c.u_id == $user->uid || $comments.status.s_user == $user->uid || $comments.status.s_to_user == $user->uid) && $user->permits['bcp']) || $user->permits['bc']}
				<div class="edit_status">
					<a href="#" onclick="states.comment_del({$c.c_id}, false, {$s.s_id});return false;" title="Borrar comentario">
						<i class="icon delete_status"></i>
					</a>
				</div>
			{/if}
			<span class="status_autor">
				<a href="{$web.url}/{$c.u_nick}">{$c.u_nick}</a>
			</span>
			{$c.c_body}
			<span class="status_actions">
				{if $user->uid}
				{if $c.like}<a href="#" onclick="states.comments.like({$c.c_id}, 0, $(this)); return false;">Ya no me gusta</a> &#8226; 
				{else} <a href="#" onclick="states.comments.like({$c.c_id}, 1, $(this)); return false;">Me gusta</a> &#8226; {/if}
				{/if}
				<a id="show-commnets-status" onclick="states.comments.show_likes({$c.c_id})"><i class="like"></i><span class="likes-total-c-{$c.c_id}">{$c.c_votos}</span></a> &#8226; 
				<a class="date stip" href="{$web.url}/{$comments.status.u_nick}/status/{$comments.status.s_id}" title="{$c.c_date|date_format:"%d/%m/%Y %I:%M %p"}">{$c.c_date|hace}</a>
			</span>
		</div>
	</div>
{/foreach}
<div class="is-new-c-{$comments.status.s_id}" id="new-co-{$comments.status.s_id}"></div>