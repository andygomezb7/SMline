{if $u_states}1: {else}2: {/if} 
			{foreach from=$u_states item=s}
				<div class="list_status clearfix" id="status-id-{$s.s_id}">
					<div class="floatL">
						<a href="{$web.url}/{$s.u_nick}"><img src="{$web.avatar}/{$s.u_id}_50.jpg?{$s.u_last_avatar}" class="avatar-2"></a>
					</div>
					<div class="floatR list_status_right">
						<span class="status_autor">
							<a href="{$web.url}/{$s.u_nick}">{$s.u_nick}</a>
							{if $user->permits['be'] || $user->permits['ee'] || (($s.u_id == $user->uid || $s.s_to_user == $user->uid) && ($user->permits['eep'] || $user->permits['bep']))}
							<div class="edit_status">
								<a href="#" onclick="$('.msa-ce-{$s.s_id}').toggle('fast');return false;"><i class="icon delete_status"></i></a>
								<div class="mod_status_actions msa-ce-{$s.s_id}">
									{if $user->permits['ee'] || (($s.u_id == $user->uid || $s.s_to_user == $user->uid) && $user->permits['eep'])}<a onclick="states.get_edit({$s.s_id})" href="#">Editar estado</a>{/if}
									{if $user->permits['be'] || (($s.u_id == $user->uid || $s.s_to_user == $user->uid) && $user->permits['bep'])}<a onclick="states.del_state({$s.s_id});return false;" href="#">Borrar estado</a>{/if}
								</div>
							</div>
							{/if}
						</span>
						
						<div id="body-state-{$s.s_id}">{$s.s_body}</div>
						
						{if $s.s_type == 2}
							<a class="s_adj_img" data-open="{$s.s_adj}" open-type="{$s.s_type}"><img class="i_img" src="{$s.s_adj}"/></a>
						{elseif $s.s_type == 3}
							<div class="video_player">
								<a class="s_adj_img" data-open="{$s.s_adj}" open-type="{$s.s_type}">
									<img class="i_img" src="http://img.youtube.com/vi/{$s.s_adj}/mqdefault.jpg">
									<i class="player_icon"></i>
									<span class="vid_title">{$s.s_adj_title}</span>
								</a>
							</div>
						{/if}

						<span class="status_actions">
							{if $user->uid}
							{if $s.like}<a href="#" onclick="states.like({$s.s_id}, 0, $(this)); return false;">Ya no me gusta</a> &#8226; 
							{else} <a href="#" onclick="states.like({$s.s_id}, 1, $(this)); return false;">Me gusta</a> &#8226; {/if}
							<a id="commnet-status" onclick="states.show_new_comment({$s.s_id}, $(this))">Comentar</a> &#8226; 
							{/if}
							<a id="show-commnets-status" onclick="states.show_new_comment({$s.s_id}, $(this))"><i class="like"></i><span class="likes-total-{$s.s_id}">{$s.s_likes}</span><i class="comments"></i><span class="comments-total-{$s.s_id}">{$s.s_comments}</span></a> &#8226; 
							<a class="date stip" href="{$web.url}/{$user->get_nick($s.s_to_user)}/status/{$s.s_id}" title="{$s.s_date|date_format:"%d/%m/%Y %I:%M %p"}">{$s.s_date|hace}</a>
						</span>
						
						<div class="s_comments_actions clearfix" id="s-comment-{$s.s_id}" style="display:none">
							<span class="top-pico"></span>
							
							{foreach from=$s.comments item=c}
								<div class="status_for_comments clearfix" id="state-comment-{$c.c_id}">
									<div class="floatL">
										<img src="{$web.avatar}/{$c.u_id}_32.jpg?{$c.u_last_avatar}" />
									</div>
									<div class="comment_body">
										{if (($c.c_user == $user->uid || $s.s_user == $user->uid || $s.s_to_user == $user->uid) && $user->permits['bcp']) || $user->permits['bc']}
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
											<a class="date stip" href="{$web.url}/{$user->get_nick($s.s_to_user)}/status/{$s.s_id}" title="{$c.c_date|date_format:"%d/%m/%Y %I:%M %p"}">{$c.c_date|hace}</a>
										</span>
									</div>
								</div>
							{/foreach}
							<div class="is-new-c-{$s.s_id}" id="new-co-{$s.s_id}"></div>
							{if $s.s_comments > 2}
							<div class="more-comments-sid-{$s.s_id}">
							</div>
							<a href="#" onclick="states.show_comments({$s.s_id}, $(this)); return false;" class="show_all_comments"><i class="comments"></i>Mostrar {$s.s_comments-2} comentario{if ($s.s_comments-2) > 1}s{/if} más</a>
							{/if}
							<div class="floatL">
								<img src="{$web.avatar}/{$user->uid}_32.jpg?{$user->info.u_last_avatar}" />
							</div>
							<div class="floatR">
								<textarea name="new_comment" id="autosize" class="inp_text newc-{$s.s_id}" placeholder="Escribe un comentario" status-id="{$s.s_id}"></textarea>
								<input type="button" class="button_1 b_ok" value="Enviar" onclick="states.send_comment({$s.s_id}, $(this));">
							</div>
							
						</div>
					</div>
				</div>
			{/foreach}