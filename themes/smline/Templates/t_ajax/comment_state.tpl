1: 
<div class="status_for_comments clearfix" id="state-comment-{$comment.0}">
	<div class="floatL">
		<img src="{$web.avatar}/{$user->uid}_32.jpg?{$user->info.u_last_avatar}" />
	</div>
	<div class="comment_body">
		{if $user->permits['bcp']}
		<div class="edit_status">
			<a href="#" onclick="states.comment_del({$comment.0}, false, {$comment.3.s_id});return false;" title="Borrar comentario">
				<i class="icon delete_status"></i>
			</a>
		</div>
		{/if}
		<span class="status_autor">
			<a href="{$web.url}/{$user->nick}">{$user->nick}</a>
		</span>
		{$comment.1}
		<span class="status_actions">
			<a href="#" onclick="states.comments.like({$comment.0}, 1, $(this)); return false;">Me gusta</a> &#8226; 
			<a id="show-commnets-status" onclick="states.comments.show_likes({$comment.0})"><i class="like"></i><span class="likes-total-c-{$comment.0}">0</span></a> &#8226; 
			<a class="date stip" href="{$web.url}/{$user->get_nick($comment.3.s_to_user)}/status/{$comment.3.s_id}" title="{$c.c_date|date_format:"%d/%m/%Y %I:%M %p"}">{$comment.2|hace}</a>
		</span>
	</div>
</div>
<div class="is-new-c-{$comment.3.s_id}" id="new-co-{$comment.3.s_id}"></div>