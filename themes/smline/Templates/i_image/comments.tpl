<div class="box margin-top-5">
	<div class="box_title"><span id="post-total-comment">{$image.i_comments}</span> comentarios</div>
	<div class="box_body clearfix">
		{if $image.i_comments == '0' && $image.i_comments_status == '1'}<div id="error">No hay comentarios, {if $user->uid}sé el primero!{else}regístrate y comenta!{/if}</div>{/if}
		<div id="last_comments">
			{foreach from=$image.comments item=c}
			<div id="comment-{$c.c_id}" class="list-comment clearfix">
				<div class="floatL">
					<a href="{$web.url}/{$c.u_nick}"><img src="{$web.avatar}/{$c.u_id}_50.jpg?{$c.u_last_avatar}" class="avatar-2"/></a>
				</div>
				<div class="floatR c-body">
					<span class="dialog-comment"></span>
					<div class="comment-info">
						@<a href="{$web.url}/{$c.u_nick}" class="hovercard" uid="{$c.u_id}">{$c.u_nick}</a>
						 <span class="stip" title="{$c.c_date|date_format:"%d/%m/%Y %I:%M %p"}">{$c.c_date|hace}</span>
						<span class="cm-votes cm-v-id-{$c.c_id}{if !$c.c_votos} hide{/if}{if $c.c_votos > 0} positives{/if}{if $c.c_votos < 0} negatives{/if}">
							<span class="total-vptes">{if $c.c_votos > 0}+{/if}{$c.c_votos}</span>
						</span>
						 <div class="comment-options">
							<a onclick="{if $user->uid}img.comments.replie({$c.c_id}); return false;{/if}" href="#" class="button_1 type_3 stip require-login" title="Responder comentario"><img src="{$web.icons}/reply.png"></a>
							{if $c.u_id != $user->uid && $user->permits['vpc'] && !$c.vote}<a onclick="img.comments.vote(1,{$c.c_id}, $(this))" class="button_1 type_3 stip" title="Me gusta"><img src="{$web.icons}/up.png"></a>{/if}
							{if $c.u_id != $user->uid && $user->permits['vnc'] && !$c.vote}<a onclick="img.comments.vote(0,{$c.c_id}, $(this))" class="button_1 type_3 stip" title="No me gusta"><img src="{$web.icons}/down.png"></a>{/if}
							{if ($c.u_id == $user->uid && $user->permits['ecp']) || $user->permits['ec']}<a onclick="img.comments.get_edit({$c.c_id})" class="button_1 type_3 stip" title="Editar comentario"><img src="{$web.icons}/editar.png"></a>{/if}
							{if ($c.u_id == $user->uid && $user->permits['bcp']) || $user->permits['bc']}<a onclick="img.comments.del({$c.c_id})" class="button_1 type_3 stip" title="Borrar comentario"><img src="{$web.icons}/delete_.png"></a>{/if}
						 </div>
					 </div>
					<div class="comment-body" id="body-comment-{$c.c_id}">{$c.c_body}</div>
				</div>
				<div class="comments-replies" id="new-replie-{$c.c_id}" {if $c.c_replies}style="display: block;"{/if}>
					<div class="list-replies">
					{if $c.c_replies}
						<a class="show-replies" onclick="img.comments.show_replies({$c.c_id}, $(this));">Mostrar {$c.c_replies} respuesta{if $c.c_replies > 1}s{/if} a este comentario</a>
					{/if}
					</div>
					<div class="my-new-replie clearfix">
					</div>
				</div>
			</div>
			{/foreach}
		</div>
		{if $image.i_comments_status == '0'}
		<div id="error">Este post tiene los comentarios cerrados</div>
		{/if}
		{if $user->uid && $image.i_comments_status == '1'}
		<hr />
		<div class="floatL">
			<a href="{$web.url}/{$user->nick}"><img src="{$web.avatar}/{$user->uid}_50.jpg?{$user->info.u_last_avatar}" class="avatar-2"/></a>
		</div>
		<div class="floatR" style="width: 650px;">
			<textarea id="r_comment" class="inp_text required newe-c" name="r_body" tabindex="2" placeholder="Escribe un comentario" autocomplete="off"></textarea>
		</div>
		<div class="floatR margin-top-5">
			<input type="button" class="button_1" value="Previsualizar" onclick="comment.prev();"/>
			<input type="button" class="button_1 b_ok" value="Enviar comentario" onclick="img.comment($(this));"/>
		</div>
		{/if}
	</div>
</div>