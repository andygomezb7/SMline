1: 
{$post.pages}
			{if $post.p_comments == '0' && $post.p_comments_status == '1'}<div id="error">No hay m&aacute;s comentarios</div>{/if}
			<div id="last_comments">
				{foreach from=$post.list item=c}
				<div id="comment-{$c.c_id}" class="list-comment clearfix">
					<div class="floatL">
						<a href="{$web.url}/{$c.u_nick}"><img src="{$web.avatar}/{$c.u_id}_50.jpg?{$c.u_last_avatar}" class="avatar-2"/></a>
					</div>
					<div class="floatR c-body">
						<span class="dialog-comment"></span>
						<div class="comment-info">
							<a href="{$web.url}/{$c.u_nick}" class="hovercard" uid="{$c.u_id}">{$c.u_nick}</a>
							 <span class="stip" title="{$c.c_date|date_format:"%d/%m/%Y %I:%M %p"}">{$c.c_date|hace}</span>
							<span class="cm-votes cm-v-id-{$c.c_id}{if !$c.c_votos} hide{/if}{if $c.c_votos > 0} positives{/if}{if $c.c_votos < 0} negatives{/if}">
								<span class="total-vptes">{if $c.c_votos > 0}+{/if}{$c.c_votos}</span>
							</span>
							 <div class="comment-options">
								<a onclick="{if $user->uid}post.comments.replie({$c.c_id}); return false;{/if}" href="#" class="button_1 type_3 stip require-login" title="Responder comentario"><img src="{$web.icons}/reply.png"></a>
								{if $c.u_id != $user->uid && $user->permits['vpc'] && !$c.vote}<a onclick="post.comments.vote(1,{$c.c_id}, $(this))" class="button_1 type_3 stip" title="Me gusta"><img src="{$web.icons}/up.png"></a>{/if}
								{if $c.u_id != $user->uid && $user->permits['vnc'] && !$c.vote}<a onclick="post.comments.vote(0,{$c.c_id}, $(this))" class="button_1 type_3 stip" title="No me gusta"><img src="{$web.icons}/down.png"></a>{/if}
								{if ($c.u_id == $user->uid && $user->permits['ecp']) || $user->permits['ec']}<a onclick="post.comments.get_edit({$c.c_id})" class="button_1 type_3 stip" title="Editar comentario"><img src="{$web.icons}/editar.png"></a>{/if}
								{if ($c.u_id == $user->uid && $user->permits['bcp']) || $user->permits['bc'] || $post.p_user == $user->uid}<a onclick="post.comments.del({$c.c_id})" class="button_1 type_3 stip" title="Borrar comentario"><img src="{$web.icons}/delete_.png"></a>{/if}
							 </div>
						 </div>
						<div class="comment-body" id="body-comment-{$c.c_id}">{$c.c_body}</div>
					</div>
					<div class="comments-replies" id="new-replie-{$c.c_id}" {if $c.c_replies}style="display: block;"{/if}>
						<div class="list-replies">
						{if $c.c_replies}
							<a class="show-replies" onclick="post.comments.show_replies({$c.c_id}, $(this));">Mostrar {$c.c_replies} respuesta{if $c.c_replies > 1}s{/if} a este comentario</a>
						{/if}
						</div>
						<div class="my-new-replie clearfix">
						</div>
					</div>
				</div>
				{/foreach}
			</div>
			{$post.pages}