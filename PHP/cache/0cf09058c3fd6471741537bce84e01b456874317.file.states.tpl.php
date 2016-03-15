<?php /* Smarty version Smarty-3.1.15, created on 2014-08-22 16:25:34
         compiled from ".\themes\smline\Templates\i_profile\states.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2846453f7b54ec98ba5-56681551%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0cf09058c3fd6471741537bce84e01b456874317' => 
    array (
      0 => '.\\themes\\smline\\Templates\\i_profile\\states.tpl',
      1 => 1399144825,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2846453f7b54ec98ba5-56681551',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'u_state' => 0,
    'web' => 0,
    'user' => 0,
    'c' => 0,
    'u_states' => 0,
    's' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f7b54f0b1e79_74206097',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f7b54f0b1e79_74206097')) {function content_53f7b54f0b1e79_74206097($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'C:\\xampp\\htdocs\\PHP\\libs\\plugins\\modifier.date_format.php';
?><?php if ($_smarty_tpl->tpl_vars['u_state']->value) {?>

<div class="box_title"><?php echo $_smarty_tpl->tpl_vars['u_state']->value['u_nick'];?>
</div>
		<div class="profile_status clearfix">
			
			<div id="last_states-data">
				<div class="list_status clearfix" id="status-id-<?php echo $_smarty_tpl->tpl_vars['u_state']->value['s_id'];?>
">
					<div class="floatL">
						<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/<?php echo $_smarty_tpl->tpl_vars['u_state']->value['u_nick'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['avatar'];?>
/<?php echo $_smarty_tpl->tpl_vars['u_state']->value['u_id'];?>
_50.jpg?<?php echo $_smarty_tpl->tpl_vars['u_state']->value['u_last_avatar'];?>
" class="avatar-2"></a>
					</div>
					<div class="floatR list_status_right">
						<span class="status_autor">
							<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/<?php echo $_smarty_tpl->tpl_vars['u_state']->value['u_nick'];?>
"><?php echo $_smarty_tpl->tpl_vars['u_state']->value['u_nick'];?>
</a>
							<?php if ($_smarty_tpl->tpl_vars['user']->value->permits['be']||$_smarty_tpl->tpl_vars['user']->value->permits['ee']||(($_smarty_tpl->tpl_vars['u_state']->value['u_id']==$_smarty_tpl->tpl_vars['user']->value->uid||$_smarty_tpl->tpl_vars['u_state']->value['s_to_user']==$_smarty_tpl->tpl_vars['user']->value->uid)&&($_smarty_tpl->tpl_vars['user']->value->permits['eep']||$_smarty_tpl->tpl_vars['user']->value->permits['bep']))) {?>
							<div class="edit_status">
								<a href="#" onclick="$('.msa-ce-<?php echo $_smarty_tpl->tpl_vars['u_state']->value['s_id'];?>
').toggle('fast');return false;"><i class="icon delete_status"></i></a>
								<div class="mod_status_actions msa-ce-<?php echo $_smarty_tpl->tpl_vars['u_state']->value['s_id'];?>
">
									<?php if ($_smarty_tpl->tpl_vars['user']->value->permits['ee']||(($_smarty_tpl->tpl_vars['u_state']->value['u_id']==$_smarty_tpl->tpl_vars['user']->value->uid||$_smarty_tpl->tpl_vars['u_state']->value['s_to_user']==$_smarty_tpl->tpl_vars['user']->value->uid)&&$_smarty_tpl->tpl_vars['user']->value->permits['eep'])) {?><a onclick="states.get_edit(<?php echo $_smarty_tpl->tpl_vars['u_state']->value['s_id'];?>
);return false;" href="#">Editar estado</a><?php }?>
									<?php if ($_smarty_tpl->tpl_vars['user']->value->permits['be']||(($_smarty_tpl->tpl_vars['u_state']->value['u_id']==$_smarty_tpl->tpl_vars['user']->value->uid||$_smarty_tpl->tpl_vars['u_state']->value['s_to_user']==$_smarty_tpl->tpl_vars['user']->value->uid)&&$_smarty_tpl->tpl_vars['user']->value->permits['bep'])) {?><a onclick="states.del_state(<?php echo $_smarty_tpl->tpl_vars['u_state']->value['s_id'];?>
);return false;" href="#">Borrar estado</a><?php }?>
								</div>
							</div>
							<?php }?>
						</span>
						
						<div id="body-state-<?php echo $_smarty_tpl->tpl_vars['u_state']->value['s_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['u_state']->value['s_body'];?>
</div>
						
						<?php if ($_smarty_tpl->tpl_vars['u_state']->value['s_type']==2) {?>
							<a class="s_adj_img" data-open="<?php echo $_smarty_tpl->tpl_vars['u_state']->value['s_adj'];?>
" open-type="<?php echo $_smarty_tpl->tpl_vars['u_state']->value['s_type'];?>
"><img class="i_img" src="<?php echo $_smarty_tpl->tpl_vars['u_state']->value['s_adj'];?>
"/></a>
						<?php } elseif ($_smarty_tpl->tpl_vars['u_state']->value['s_type']==3) {?>
							<div class="video_player">
								<a class="s_adj_img" data-open="<?php echo $_smarty_tpl->tpl_vars['u_state']->value['s_adj'];?>
" open-type="<?php echo $_smarty_tpl->tpl_vars['u_state']->value['s_type'];?>
">
									<img class="i_img" src="http://img.youtube.com/vi/<?php echo $_smarty_tpl->tpl_vars['u_state']->value['s_adj'];?>
/mqdefault.jpg">
									<i class="player_icon"></i>
									<span class="vid_title"><?php echo $_smarty_tpl->tpl_vars['u_state']->value['s_adj_title'];?>
</span>
								</a>
							</div>
						<?php }?>

						<span class="status_actions">
							<?php if ($_smarty_tpl->tpl_vars['user']->value->uid) {?>
							<?php if ($_smarty_tpl->tpl_vars['u_state']->value['like']) {?><a href="#" onclick="states.like(<?php echo $_smarty_tpl->tpl_vars['u_state']->value['s_id'];?>
, 0, $(this)); return false;">Ya no me gusta</a> &#8226; 
							<?php } else { ?> <a href="#" onclick="states.like(<?php echo $_smarty_tpl->tpl_vars['u_state']->value['s_id'];?>
, 1, $(this)); return false;">Me gusta</a> &#8226; <?php }?>
							<a id="commnet-status" onclick="states.show_new_comment(<?php echo $_smarty_tpl->tpl_vars['u_state']->value['s_id'];?>
, $(this))">Comentar</a> &#8226; 
							<?php }?>
							<a id="show-commnets-status" onclick="states.show_new_comment(<?php echo $_smarty_tpl->tpl_vars['u_state']->value['s_id'];?>
, $(this))" class="require-login"><i class="like"></i><span class="likes-total-<?php echo $_smarty_tpl->tpl_vars['u_state']->value['s_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['u_state']->value['s_likes'];?>
</span><i class="comments"></i><span class="comments-total-<?php echo $_smarty_tpl->tpl_vars['u_state']->value['s_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['u_state']->value['s_comments'];?>
</span></a> &#8226; 
							<a class="date stip" href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/<?php echo $_smarty_tpl->tpl_vars['user']->value->get_nick($_smarty_tpl->tpl_vars['u_state']->value['s_to_user']);?>
/status/<?php echo $_smarty_tpl->tpl_vars['u_state']->value['s_id'];?>
" title="<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['u_state']->value['s_date'],"%d/%m/%Y %I:%M %p");?>
"><?php echo hace($_smarty_tpl->tpl_vars['u_state']->value['s_date']);?>
</a>
						</span>
						
						<div class="s_comments_actions clearfix" id="s-comment-<?php echo $_smarty_tpl->tpl_vars['u_state']->value['s_id'];?>
" style="">
							<span class="top-pico"></span>
							
							<?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['u_state']->value['comments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value) {
$_smarty_tpl->tpl_vars['c']->_loop = true;
?>
								<div class="status_for_comments clearfix" id="state-comment-<?php echo $_smarty_tpl->tpl_vars['c']->value['c_id'];?>
">
									<div class="floatL">
										<img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['avatar'];?>
/<?php echo $_smarty_tpl->tpl_vars['c']->value['u_id'];?>
_32.jpg?<?php echo $_smarty_tpl->tpl_vars['c']->value['u_last_avatar'];?>
" />
									</div>
									<div class="comment_body">
										<?php if ((($_smarty_tpl->tpl_vars['c']->value['c_user']==$_smarty_tpl->tpl_vars['user']->value->uid||$_smarty_tpl->tpl_vars['u_state']->value['s_user']==$_smarty_tpl->tpl_vars['user']->value->uid||$_smarty_tpl->tpl_vars['u_state']->value['s_to_user']==$_smarty_tpl->tpl_vars['user']->value->uid)&&$_smarty_tpl->tpl_vars['user']->value->permits['bcp'])||$_smarty_tpl->tpl_vars['user']->value->permits['bc']) {?>
										<div class="edit_status">
											<a href="#" onclick="states.comment_del(<?php echo $_smarty_tpl->tpl_vars['c']->value['c_id'];?>
, false, <?php echo $_smarty_tpl->tpl_vars['u_state']->value['s_id'];?>
);return false;" title="Borrar comentario">
												<i class="icon delete_status"></i>
											</a>
										</div>
										<?php }?>
										<span class="status_autor">
											<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/<?php echo $_smarty_tpl->tpl_vars['c']->value['u_nick'];?>
"><?php echo $_smarty_tpl->tpl_vars['c']->value['u_nick'];?>
</a>
										</span>
										<?php echo $_smarty_tpl->tpl_vars['c']->value['c_body'];?>

										<span class="status_actions">
											<?php if ($_smarty_tpl->tpl_vars['user']->value->uid) {?>
											<?php if ($_smarty_tpl->tpl_vars['c']->value['like']) {?><a href="#" onclick="states.comments.like(<?php echo $_smarty_tpl->tpl_vars['c']->value['c_id'];?>
, 0, $(this)); return false;">Ya no me gusta</a> &#8226; 
											<?php } else { ?> <a href="#" onclick="states.comments.like(<?php echo $_smarty_tpl->tpl_vars['c']->value['c_id'];?>
, 1, $(this)); return false;">Me gusta</a> &#8226; <?php }?>
											<?php }?>
											<a id="show-commnets-status" onclick="states.comments.show_likes(<?php echo $_smarty_tpl->tpl_vars['c']->value['c_id'];?>
)"><i class="like"></i><span class="likes-total-c-<?php echo $_smarty_tpl->tpl_vars['c']->value['c_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['c']->value['c_votos'];?>
</span></a> &#8226; 
											<a class="date stip" href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/<?php echo $_smarty_tpl->tpl_vars['user']->value->get_nick($_smarty_tpl->tpl_vars['u_state']->value['s_to_user']);?>
/status/<?php echo $_smarty_tpl->tpl_vars['u_state']->value['s_id'];?>
" title="<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['c']->value['c_date'],"%d/%m/%Y %I:%M %p");?>
"><?php echo hace($_smarty_tpl->tpl_vars['c']->value['c_date']);?>
</a>
										</span>
									</div>
								</div>
							<?php } ?>
							<div class="is-new-c-<?php echo $_smarty_tpl->tpl_vars['u_state']->value['s_id'];?>
" id="new-co-<?php echo $_smarty_tpl->tpl_vars['u_state']->value['s_id'];?>
"></div>
							<?php if ($_smarty_tpl->tpl_vars['u_state']->value['s_comments']>30) {?>
							<div class="more-comments-sid-<?php echo $_smarty_tpl->tpl_vars['u_state']->value['s_id'];?>
">
							</div>
							<a href="#" onclick="states.show_comments(<?php echo $_smarty_tpl->tpl_vars['u_state']->value['s_id'];?>
, $(this)); return false;" class="show_all_comments"><i class="comments"></i>Mostrar <?php echo $_smarty_tpl->tpl_vars['u_state']->value['s_comments']-30;?>
 comentario<?php if (($_smarty_tpl->tpl_vars['u_state']->value['s_comments']-30)>1) {?>s<?php }?> más</a>
							<?php }?>
							<div class="floatL">
								<img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['avatar'];?>
/<?php echo $_smarty_tpl->tpl_vars['user']->value->uid;?>
_32.jpg?<?php echo $_smarty_tpl->tpl_vars['user']->value->info['u_last_avatar'];?>
" />
							</div>
							<div class="floatR">
								<textarea name="new_comment" id="autosize" class="inp_text newc-<?php echo $_smarty_tpl->tpl_vars['u_state']->value['s_id'];?>
" placeholder="Escribe un comentario" status-id="<?php echo $_smarty_tpl->tpl_vars['u_state']->value['s_id'];?>
"></textarea>
								<input type="button" class="button_1 b_ok" value="Enviar" onclick="states.send_comment(<?php echo $_smarty_tpl->tpl_vars['u_state']->value['s_id'];?>
, $(this));">
							</div>
							
						</div>
					</div>
				</div>
			</div>
			
		</div>

<?php } else { ?>

<div class="box_title">Estados</div>
		<div class="profile_status clearfix">
		
			<?php if ($_smarty_tpl->tpl_vars['user']->value->uid) {?>
			<div class="new_status_text clearfix">
				<div class="floatL">
					<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/<?php echo $_smarty_tpl->tpl_vars['user']->value->nick;?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['avatar'];?>
/<?php echo $_smarty_tpl->tpl_vars['user']->value->uid;?>
_50.jpg?<?php echo $_smarty_tpl->tpl_vars['user']->value->info['u_last_avatar'];?>
" class="avatar-2"/></a>
				</div>
				<div class="floatR new_status_right">
					<textarea id="r_status" class="inp_text" name="r_status" placeholder="Comparte algo" autocomplete="off"></textarea>
				</div>
			</div>
			
			<div class="new_status_types">
				<div class="my-shout-attach menu clearfix attach-i_vid" style="display: none;">
					<a class="remove-attach"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['img'];?>
/close.png" /></a>
					<div class="add-url clearfix">
						<label>URL</label>
						<form>
							<input class="inp_text" type="text" name="import" placeholder="URL del vídeo" autocomplete="off">
							<a href="#" class="button_3 type_4" onclick="states.import_($(this)); return false;" maxlenght="500">Agregar</a>
						</form>
					</div>
				</div>
				<div class="my-shout-attach menu clearfix attach-i_img" style="display: none;">
					<a class="remove-attach"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['img'];?>
/close.png" /></a>
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
			<?php }?>
			<?php if (!$_smarty_tpl->tpl_vars['u_states']->value) {?><div class="emptyData">No hay estados recientes.</div><?php }?>
			<div id="last_states-data">
			<?php  $_smarty_tpl->tpl_vars['s'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['s']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['u_states']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['s']->key => $_smarty_tpl->tpl_vars['s']->value) {
$_smarty_tpl->tpl_vars['s']->_loop = true;
?>
				<div class="list_status clearfix" id="status-id-<?php echo $_smarty_tpl->tpl_vars['s']->value['s_id'];?>
">
					<div class="floatL">
						<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/<?php echo $_smarty_tpl->tpl_vars['s']->value['u_nick'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['avatar'];?>
/<?php echo $_smarty_tpl->tpl_vars['s']->value['u_id'];?>
_50.jpg?<?php echo $_smarty_tpl->tpl_vars['s']->value['u_last_avatar'];?>
" class="avatar-2"></a>
					</div>
					<div class="floatR list_status_right">
						<span class="status_autor">
							<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/<?php echo $_smarty_tpl->tpl_vars['s']->value['u_nick'];?>
"><?php echo $_smarty_tpl->tpl_vars['s']->value['u_nick'];?>
</a>
							<?php if ($_smarty_tpl->tpl_vars['user']->value->permits['be']||$_smarty_tpl->tpl_vars['user']->value->permits['ee']||(($_smarty_tpl->tpl_vars['s']->value['u_id']==$_smarty_tpl->tpl_vars['user']->value->uid||$_smarty_tpl->tpl_vars['s']->value['s_to_user']==$_smarty_tpl->tpl_vars['user']->value->uid)&&($_smarty_tpl->tpl_vars['user']->value->permits['eep']||$_smarty_tpl->tpl_vars['user']->value->permits['bep']))) {?>
							<div class="edit_status">
								<a href="#" onclick="$('.msa-ce-<?php echo $_smarty_tpl->tpl_vars['s']->value['s_id'];?>
').toggle('fast');return false;"><i class="icon delete_status"></i></a>
								<div class="mod_status_actions msa-ce-<?php echo $_smarty_tpl->tpl_vars['s']->value['s_id'];?>
">
									<?php if ($_smarty_tpl->tpl_vars['user']->value->permits['ee']||(($_smarty_tpl->tpl_vars['s']->value['u_id']==$_smarty_tpl->tpl_vars['user']->value->uid||$_smarty_tpl->tpl_vars['s']->value['s_to_user']==$_smarty_tpl->tpl_vars['user']->value->uid)&&$_smarty_tpl->tpl_vars['user']->value->permits['eep'])) {?><a onclick="states.get_edit(<?php echo $_smarty_tpl->tpl_vars['s']->value['s_id'];?>
);return false;" href="#">Editar estado</a><?php }?>
									<?php if ($_smarty_tpl->tpl_vars['user']->value->permits['be']||(($_smarty_tpl->tpl_vars['s']->value['u_id']==$_smarty_tpl->tpl_vars['user']->value->uid||$_smarty_tpl->tpl_vars['s']->value['s_to_user']==$_smarty_tpl->tpl_vars['user']->value->uid)&&$_smarty_tpl->tpl_vars['user']->value->permits['bep'])) {?><a onclick="states.del_state(<?php echo $_smarty_tpl->tpl_vars['s']->value['s_id'];?>
);return false;" href="#">Borrar estado</a><?php }?>
								</div>
							</div>
							<?php }?>
						</span>
						
						<div id="body-state-<?php echo $_smarty_tpl->tpl_vars['s']->value['s_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['s']->value['s_body'];?>
</div>
						
						<?php if ($_smarty_tpl->tpl_vars['s']->value['s_type']==2) {?>
							<a class="s_adj_img" data-open="<?php echo $_smarty_tpl->tpl_vars['s']->value['s_adj'];?>
" open-type="<?php echo $_smarty_tpl->tpl_vars['s']->value['s_type'];?>
"><img class="i_img" src="<?php echo $_smarty_tpl->tpl_vars['s']->value['s_adj'];?>
"/></a>
						<?php } elseif ($_smarty_tpl->tpl_vars['s']->value['s_type']==3) {?>
							<div class="video_player">
								<a class="s_adj_img" data-open="<?php echo $_smarty_tpl->tpl_vars['s']->value['s_adj'];?>
" open-type="<?php echo $_smarty_tpl->tpl_vars['s']->value['s_type'];?>
">
									<img class="i_img" src="http://img.youtube.com/vi/<?php echo $_smarty_tpl->tpl_vars['s']->value['s_adj'];?>
/mqdefault.jpg">
									<i class="player_icon"></i>
									<span class="vid_title"><?php echo $_smarty_tpl->tpl_vars['s']->value['s_adj_title'];?>
</span>
								</a>
							</div>
						<?php }?>

						<span class="status_actions">
							<?php if ($_smarty_tpl->tpl_vars['user']->value->uid) {?>
							<?php if ($_smarty_tpl->tpl_vars['s']->value['like']) {?><a href="#" onclick="states.like(<?php echo $_smarty_tpl->tpl_vars['s']->value['s_id'];?>
, 0, $(this)); return false;">Ya no me gusta</a> &#8226; 
							<?php } else { ?> <a href="#" onclick="states.like(<?php echo $_smarty_tpl->tpl_vars['s']->value['s_id'];?>
, 1, $(this)); return false;">Me gusta</a> &#8226; <?php }?>
							<a id="commnet-status" onclick="states.show_new_comment(<?php echo $_smarty_tpl->tpl_vars['s']->value['s_id'];?>
, $(this))">Comentar</a> &#8226; 
							<?php }?>
							<a id="show-commnets-status" onclick="states.show_new_comment(<?php echo $_smarty_tpl->tpl_vars['s']->value['s_id'];?>
, $(this))"><i class="like"></i><span class="likes-total-<?php echo $_smarty_tpl->tpl_vars['s']->value['s_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['s']->value['s_likes'];?>
</span><i class="comments"></i><span class="comments-total-<?php echo $_smarty_tpl->tpl_vars['s']->value['s_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['s']->value['s_comments'];?>
</span></a> &#8226; 
							<a class="date stip" href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/<?php echo $_smarty_tpl->tpl_vars['user']->value->get_nick($_smarty_tpl->tpl_vars['s']->value['s_to_user']);?>
/status/<?php echo $_smarty_tpl->tpl_vars['s']->value['s_id'];?>
" title="<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['s']->value['s_date'],"%d/%m/%Y %I:%M %p");?>
"><?php echo hace($_smarty_tpl->tpl_vars['s']->value['s_date']);?>
</a>
						</span>
						
						<div class="s_comments_actions clearfix" id="s-comment-<?php echo $_smarty_tpl->tpl_vars['s']->value['s_id'];?>
" style="display:none">
							<span class="top-pico"></span>
							
							<?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['s']->value['comments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value) {
$_smarty_tpl->tpl_vars['c']->_loop = true;
?>
								<div class="status_for_comments clearfix" id="state-comment-<?php echo $_smarty_tpl->tpl_vars['c']->value['c_id'];?>
">
									<div class="floatL">
										<img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['avatar'];?>
/<?php echo $_smarty_tpl->tpl_vars['c']->value['u_id'];?>
_32.jpg?<?php echo $_smarty_tpl->tpl_vars['c']->value['u_last_avatar'];?>
" />
									</div>
									<div class="comment_body">
										<?php if ((($_smarty_tpl->tpl_vars['c']->value['c_user']==$_smarty_tpl->tpl_vars['user']->value->uid||$_smarty_tpl->tpl_vars['s']->value['s_user']==$_smarty_tpl->tpl_vars['user']->value->uid||$_smarty_tpl->tpl_vars['s']->value['s_to_user']==$_smarty_tpl->tpl_vars['user']->value->uid)&&$_smarty_tpl->tpl_vars['user']->value->permits['bcp'])||$_smarty_tpl->tpl_vars['user']->value->permits['bc']) {?>
										<div class="edit_status">
											<a href="#" onclick="states.comment_del(<?php echo $_smarty_tpl->tpl_vars['c']->value['c_id'];?>
, false, <?php echo $_smarty_tpl->tpl_vars['s']->value['s_id'];?>
);return false;" title="Borrar comentario">
												<i class="icon delete_status"></i>
											</a>
										</div>
										<?php }?>
										<span class="status_autor">
											<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/<?php echo $_smarty_tpl->tpl_vars['c']->value['u_nick'];?>
"><?php echo $_smarty_tpl->tpl_vars['c']->value['u_nick'];?>
</a>
										</span>
										<?php echo $_smarty_tpl->tpl_vars['c']->value['c_body'];?>

										<span class="status_actions">
											<?php if ($_smarty_tpl->tpl_vars['user']->value->uid) {?>
											<?php if ($_smarty_tpl->tpl_vars['c']->value['like']) {?><a href="#" onclick="states.comments.like(<?php echo $_smarty_tpl->tpl_vars['c']->value['c_id'];?>
, 0, $(this)); return false;">Ya no me gusta</a> &#8226; 
											<?php } else { ?> <a href="#" onclick="states.comments.like(<?php echo $_smarty_tpl->tpl_vars['c']->value['c_id'];?>
, 1, $(this)); return false;">Me gusta</a> &#8226; <?php }?>
											<?php }?>
											<a id="show-commnets-status" onclick="states.comments.show_likes(<?php echo $_smarty_tpl->tpl_vars['c']->value['c_id'];?>
)"><i class="like"></i><span class="likes-total-c-<?php echo $_smarty_tpl->tpl_vars['c']->value['c_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['c']->value['c_votos'];?>
</span></a> &#8226; 
											<a class="date stip" href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/<?php echo $_smarty_tpl->tpl_vars['user']->value->get_nick($_smarty_tpl->tpl_vars['s']->value['s_to_user']);?>
/status/<?php echo $_smarty_tpl->tpl_vars['s']->value['s_id'];?>
" title="<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['c']->value['c_date'],"%d/%m/%Y %I:%M %p");?>
"><?php echo hace($_smarty_tpl->tpl_vars['c']->value['c_date']);?>
</a>
										</span>
									</div>
								</div>
							<?php } ?>
							<div class="is-new-c-<?php echo $_smarty_tpl->tpl_vars['s']->value['s_id'];?>
" id="new-co-<?php echo $_smarty_tpl->tpl_vars['s']->value['s_id'];?>
"></div>
							<?php if ($_smarty_tpl->tpl_vars['s']->value['s_comments']>2) {?>
							<div class="more-comments-sid-<?php echo $_smarty_tpl->tpl_vars['s']->value['s_id'];?>
">
							</div>
							<a href="#" onclick="states.show_comments(<?php echo $_smarty_tpl->tpl_vars['s']->value['s_id'];?>
, $(this)); return false;" class="show_all_comments"><i class="comments"></i>Mostrar <?php echo $_smarty_tpl->tpl_vars['s']->value['s_comments']-2;?>
 comentario<?php if (($_smarty_tpl->tpl_vars['s']->value['s_comments']-2)>1) {?>s<?php }?> más</a>
							<?php }?>
							<div class="floatL">
								<img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['avatar'];?>
/<?php echo $_smarty_tpl->tpl_vars['user']->value->uid;?>
_32.jpg?<?php echo $_smarty_tpl->tpl_vars['user']->value->info['u_last_avatar'];?>
" />
							</div>
							<div class="floatR">
								<textarea name="new_comment" id="autosize" class="inp_text newc-<?php echo $_smarty_tpl->tpl_vars['s']->value['s_id'];?>
" placeholder="Escribe un comentario" status-id="<?php echo $_smarty_tpl->tpl_vars['s']->value['s_id'];?>
"></textarea>
								<input type="button" class="button_1 b_ok" value="Enviar" onclick="states.send_comment(<?php echo $_smarty_tpl->tpl_vars['s']->value['s_id'];?>
, $(this));">
							</div>
							
						</div>
					</div>
				</div>
			<?php } ?>
			</div>
			<?php if (count($_smarty_tpl->tpl_vars['u_states']->value)>=15) {?>
			<a class="load_more" onclick="profile.states_load_more();">Mostrar m&aacute;s estados</a>
			<div id="error" class="no_hay_mas_activity" style="display:none">No hay m&aacute;s estados para mostrar</div>
			<?php }?>
			<input type="hidden" name="states_start" value="1">
		</div>
		
<?php }?><?php }} ?>
