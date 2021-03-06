{if $u_state}

<div class="box_title">{$u_state.u_nick}</div>
		<div class="profile_status clearfix">
			
			<div id="last_states-data">
				<div class="list_status clearfix" id="status-id-{$u_state.s_id}">
					<div class="floatL">
						<a href="{$web.url}/{$u_state.u_nick}"><img src="{$web.avatar}/{$u_state.u_id}_50.jpg?{$u_state.u_last_avatar}" class="avatar-2"></a>
					</div>
					<div class="floatR list_status_right">
						<span class="status_autor">
							<a href="{$web.url}/{$u_state.u_nick}">{$u_state.u_nick}</a>
							{if $user->permits['be'] || $user->permits['ee'] || (($u_state.u_id == $user->uid || $u_state.s_to_user == $user->uid) && ($user->permits['eep'] || $user->permits['bep']))}
							<div class="edit_status">
								<a href="#" onclick="$('.msa-ce-{$u_state.s_id}').toggle('fast');return false;"><i class="icon delete_status"></i></a>
								<div class="mod_status_actions msa-ce-{$u_state.s_id}">
									{if $user->permits['ee'] || (($u_state.u_id == $user->uid || $u_state.s_to_user == $user->uid) && $user->permits['eep'])}<a onclick="states.get_edit({$u_state.s_id});return false;" href="#">Editar estado</a>{/if}
									{if $user->permits['be'] || (($u_state.u_id == $user->uid || $u_state.s_to_user == $user->uid) && $user->permits['bep'])}<a onclick="states.del_state({$u_state.s_id});return false;" href="#">Borrar estado</a>{/if}
								</div>
							</div>
							{/if}
						</span>
						
						<div id="body-state-{$u_state.s_id}">{$u_state.s_body}</div>
						
						{if $u_state.s_type == 2}
							<a class="s_adj_img" data-open="{$u_state.s_adj}" open-type="{$u_state.s_type}"><img class="i_img" src="{$u_state.s_adj}"/></a>
						{elseif $u_state.s_type == 3}
							<div class="video_player">
								<a class="s_adj_img" data-open="{$u_state.s_adj}" open-type="{$u_state.s_type}">
									<img class="i_img" src="http://img.youtube.com/vi/{$u_state.s_adj}/mqdefault.jpg">
									<i class="player_icon"></i>
									<span class="vid_title">{$u_state.s_adj_title}</span>
								</a>
							</div>
						{/if}

						<span class="status_actions">
							{if $user->uid}
							{if $u_state.like}<a href="#" onclick="states.like({$u_state.s_id}, 0, $(this)); return false;">Ya no me gusta</a> &#8226; 
							{else} <a href="#" onclick="states.like({$u_state.s_id}, 1, $(this)); return false;">Me gusta</a> &#8226; {/if}
							<a id="commnet-status" onclick="states.show_new_comment({$u_state.s_id}, $(this))">Comentar</a> &#8226; 
							{/if}
							<a id="show-commnets-status" onclick="states.show_new_comment({$u_state.s_id}, $(this))" class="require-login"><i class="like"></i><span class="likes-total-{$u_state.s_id}">{$u_state.s_likes}</span><i class="comments"></i><span class="comments-total-{$u_state.s_id}">{$u_state.s_comments}</span></a> &#8226; 
							<a class="date stip" href="{$web.url}/{$user->get_nick($u_state.s_to_user)}/status/{$u_state.s_id}" title="{$u_state.s_date|date_format:"%d/%m/%Y %I:%M %p"}">{$u_state.s_date|hace}</a>
						</span>
						
						<div class="s_comments_actions clearfix" id="s-comment-{$u_state.s_id}" style="">
							<span class="top-pico"></span>
							
							{foreach from=$u_state.comments item=c}
								<div class="status_for_comments clearfix" id="state-comment-{$c.c_id}">
									<div class="floatL">
										<img src="{$web.avatar}/{$c.u_id}_32.jpg?{$c.u_last_avatar}" />
									</div>
									<div class="comment_body">
										{if (($c.c_user == $user->uid || $u_state.s_user == $user->uid || $u_state.s_to_user == $user->uid) && $user->permits['bcp']) || $user->permits['bc']}
										<div class="edit_status">
											<a href="#" onclick="states.comment_del({$c.c_id}, false, {$u_state.s_id});return false;" title="Borrar comentario">
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
											<a class="date stip" href="{$web.url}/{$user->get_nick($u_state.s_to_user)}/status/{$u_state.s_id}" title="{$c.c_date|date_format:"%d/%m/%Y %I:%M %p"}">{$c.c_date|hace}</a>
										</span>
									</div>
								</div>
							{/foreach}
							<div class="is-new-c-{$u_state.s_id}" id="new-co-{$u_state.s_id}"></div>
							{if $u_state.s_comments > 30}
							<div class="more-comments-sid-{$u_state.s_id}">
							</div>
							<a href="#" onclick="states.show_comments({$u_state.s_id}, $(this)); return false;" class="show_all_comments"><i class="comments"></i>Mostrar {$u_state.s_comments-30} comentario{if ($u_state.s_comments-30) > 1}s{/if} más</a>
							{/if}
							<div class="floatL">
								<img src="{$web.avatar}/{$user->uid}_32.jpg?{$user->info.u_last_avatar}" />
							</div>
							<div class="floatR">
								<textarea name="new_comment" id="autosize" class="inp_text newc-{$u_state.s_id}" placeholder="Escribe un comentario" status-id="{$u_state.s_id}"></textarea>
								<input type="button" class="button_1 b_ok" value="Enviar" onclick="states.send_comment({$u_state.s_id}, $(this));">
							</div>
							
						</div>
					</div>
				</div>
			</div>
			
		</div>

{else}

<div class="box_title">Estados</div>
		<div class="profile_status clearfix">
		
			{if $user->uid}
			<div class="new_status_text clearfix">
				<div class="floatL">
					<a href="{$web.url}/{$user->nick}"><img src="{$web.avatar}/{$user->uid}_50.jpg?{$user->info.u_last_avatar}" class="avatar-2"/></a>
				</div>
				<div class="floatR new_status_right">
					<textarea id="r_status" class="inp_text" name="r_status" placeholder="Comparte algo" autocomplete="off"></textarea>
				</div>
			</div>
			
			<div class="new_status_types">
				<div class="my-shout-attach menu clearfix attach-i_vid" style="display: none;">
					<a class="remove-attach"><img src="{$web.img}/close.png" /></a>
					<div class="add-url clearfix">
						<label>URL</label>
						<form>
							<input class="inp_text" type="text" name="import" placeholder="URL del vídeo" autocomplete="off">
							<a href="#" class="button_3 type_4" onclick="states.import_($(this)); return false;" maxlenght="500">Agregar</a>
						</form>
					</div>
				</div>
				<div class="my-shout-attach menu clearfix attach-i_img" style="display: none;">
					<a class="remove-attach"><img src="{$web.img}/close.png" /></a>
					<div class="add-url clearfix">
						<label>URL</label>
						<form>
							<input class="inp_text" type="text" name="import" placeholder="URL de la imagen" autocomplete="off">
							<a href="#" class="button_3 type_4" onclick="states.import_($(this)); return false;" maxlenght="500">Agregar</a>
						</form>
					</div>
				</div>
			</div>
			
			<div class="new_status_buttons">
				<div class="floatL margin-top-5 buttons_adjs">
					<a href="#" onclick="states.adj('sta', $(this)); return false;" class="button_1 stip active" title="Publicar estado">
						<i class="icon-status"></i> 
					</a>
					<a href="#" onclick="states.adj('img', $(this)); return false;" class="button_1 stip" title="Publicar foto">
						<i class="icon-camera"></i> 
					</a>
					<a href="#" onclick="states.adj('vid', $(this)); return false;" class="button_1 stip" title="Publicar vídeo">
						<i class="icon-player"></i> 
					</a>
				</div>
				<div class="floatR margin-top-5">
					<input type="button" class="button_1 b_ok" value="Enviar" onclick="states.send($(this));"/>
				</div>
			</div>
			<hr class="separate-full" />
			{/if}
			{if !$u_states}<div class="emptyData">No hay estados recientes.</div>{/if}
			<div id="last_states-data">
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
									{if $user->permits['ee'] || (($s.u_id == $user->uid || $s.s_to_user == $user->uid) && $user->permits['eep'])}<a onclick="states.get_edit({$s.s_id});return false;" href="#">Editar estado</a>{/if}
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
			</div>
			{if $u_states|count >= 15}
			<a class="load_more" onclick="profile.states_load_more();">Mostrar m&aacute;s estados</a>
			<div id="error" class="no_hay_mas_activity" style="display:none">No hay m&aacute;s estados para mostrar</div>
			{/if}
			<input type="hidden" name="states_start" value="1">
		</div>
		
{/if}