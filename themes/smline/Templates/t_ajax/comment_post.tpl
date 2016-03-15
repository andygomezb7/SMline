1:
<div id="comment-{$comment.0}" class="list-comment clearfix">
	<div class="floatL">
		<a href="{$web.url}/{$user->nick}"><img src="{$web.avatar}/{$user->uid}_50.jpg?{$user->info.u_last_avatar}" class="avatar-2"/></a>
	</div>
	<div class="floatR c-body">
		<span class="dialog-comment"></span>
		<div class="comment-info">
			<a href="{$web.url}/{$user->nick}" class="hovercard" uid="{$user->uid}">{$user->nick}</a>
			 <span class="stip" title="{$comment.2|date_format:"%d/%m/%Y %I:%M %p"}">{$comment.2|hace}</span>
			 <div class="comment-options">
				<a onclick="post.comments.del({$comment.0})" class="button_1 type_3 stip" title="Borrar comentario"><img src="{$web.icons}/delete_.png"></a>
			</div>
		</div>
		<div class="comment-body">{$comment.1}</div>
	</div>
</div>