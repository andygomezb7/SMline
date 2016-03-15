<?php /* Smarty version Smarty-3.1.15, created on 2014-08-22 16:17:29
         compiled from ".\themes\smline\Templates\i_post\comments.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1314353f7b3690a6f90-81666595%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4e6ffb50fd24351bb600b478f222065c423c2878' => 
    array (
      0 => '.\\themes\\smline\\Templates\\i_post\\comments.tpl',
      1 => 1398993433,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1314353f7b3690a6f90-81666595',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'post' => 0,
    'web' => 0,
    'user' => 0,
    'c' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f7b3691bc554_36555032',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f7b3691bc554_36555032')) {function content_53f7b3691bc554_36555032($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'C:\\xampp\\htdocs\\PHP\\libs\\plugins\\modifier.date_format.php';
?><div class="box margin-top-5 post-comments">
	<div class="box_title"><span id="post-total-comment"><?php echo $_smarty_tpl->tpl_vars['post']->value['p_comments'];?>
</span> comentarios</div>
	<div class="box_body clearfix list-post-comments">
		<script type="text/javascript">
			web_max_comments = <?php echo $_smarty_tpl->tpl_vars['web']->value['max_comm'];?>
;
		</script>
		<div class="pagination_post">
			<?php echo $_smarty_tpl->tpl_vars['post']->value['comments_pages'];?>

			<?php if ($_smarty_tpl->tpl_vars['post']->value['p_comments']=='0'&&$_smarty_tpl->tpl_vars['post']->value['p_comments_status']=='1') {?><div id="error">No hay comentarios, <?php if ($_smarty_tpl->tpl_vars['user']->value->uid) {?>sé el primero!<?php } else { ?>regístrate y comenta!<?php }?></div><?php }?>
			<div id="last_comments">
				<?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['post']->value['comments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value) {
$_smarty_tpl->tpl_vars['c']->_loop = true;
?>
				<div id="comment-<?php echo $_smarty_tpl->tpl_vars['c']->value['c_id'];?>
" class="list-comment clearfix">
					<div class="floatL">
						<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/<?php echo $_smarty_tpl->tpl_vars['c']->value['u_nick'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['avatar'];?>
/<?php echo $_smarty_tpl->tpl_vars['c']->value['u_id'];?>
_50.jpg?<?php echo $_smarty_tpl->tpl_vars['c']->value['u_last_avatar'];?>
" class="avatar-2"/></a>
					</div>
					<div class="floatR c-body">
						<span class="dialog-comment"></span>
						<div class="comment-info">
							<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/<?php echo $_smarty_tpl->tpl_vars['c']->value['u_nick'];?>
" class="hovercard" uid="<?php echo $_smarty_tpl->tpl_vars['c']->value['u_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['c']->value['u_nick'];?>
</a>
							 <span class="stip" title="<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['c']->value['c_date'],"%d/%m/%Y %I:%M %p");?>
"><?php echo hace($_smarty_tpl->tpl_vars['c']->value['c_date']);?>
</span>
							<span class="cm-votes cm-v-id-<?php echo $_smarty_tpl->tpl_vars['c']->value['c_id'];?>
<?php if (!$_smarty_tpl->tpl_vars['c']->value['c_votos']) {?> hide<?php }?><?php if ($_smarty_tpl->tpl_vars['c']->value['c_votos']>0) {?> positives<?php }?><?php if ($_smarty_tpl->tpl_vars['c']->value['c_votos']<0) {?> negatives<?php }?>">
								<span class="total-vptes"><?php if ($_smarty_tpl->tpl_vars['c']->value['c_votos']>0) {?>+<?php }?><?php echo $_smarty_tpl->tpl_vars['c']->value['c_votos'];?>
</span>
							</span>
							 <div class="comment-options">
								<a onclick="<?php if ($_smarty_tpl->tpl_vars['user']->value->uid) {?>post.comments.replie(<?php echo $_smarty_tpl->tpl_vars['c']->value['c_id'];?>
); return false;<?php }?>" href="#" class="button_1 type_3 stip require-login" title="Responder comentario"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/reply.png"></a>
								<?php if ($_smarty_tpl->tpl_vars['c']->value['u_id']!=$_smarty_tpl->tpl_vars['user']->value->uid&&$_smarty_tpl->tpl_vars['user']->value->permits['vpc']&&!$_smarty_tpl->tpl_vars['c']->value['vote']) {?><a onclick="post.comments.vote(1,<?php echo $_smarty_tpl->tpl_vars['c']->value['c_id'];?>
, $(this))" class="button_1 type_3 stip" title="Me gusta"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/up.png"></a><?php }?>
								<?php if ($_smarty_tpl->tpl_vars['c']->value['u_id']!=$_smarty_tpl->tpl_vars['user']->value->uid&&$_smarty_tpl->tpl_vars['user']->value->permits['vnc']&&!$_smarty_tpl->tpl_vars['c']->value['vote']) {?><a onclick="post.comments.vote(0,<?php echo $_smarty_tpl->tpl_vars['c']->value['c_id'];?>
, $(this))" class="button_1 type_3 stip" title="No me gusta"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/down.png"></a><?php }?>
								<?php if (($_smarty_tpl->tpl_vars['c']->value['u_id']==$_smarty_tpl->tpl_vars['user']->value->uid&&$_smarty_tpl->tpl_vars['user']->value->permits['ecp'])||$_smarty_tpl->tpl_vars['user']->value->permits['ec']) {?><a onclick="post.comments.get_edit(<?php echo $_smarty_tpl->tpl_vars['c']->value['c_id'];?>
)" class="button_1 type_3 stip" title="Editar comentario"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/editar.png"></a><?php }?>
								<?php if (($_smarty_tpl->tpl_vars['c']->value['u_id']==$_smarty_tpl->tpl_vars['user']->value->uid&&$_smarty_tpl->tpl_vars['user']->value->permits['bcp'])||$_smarty_tpl->tpl_vars['user']->value->permits['bc']||$_smarty_tpl->tpl_vars['post']->value['p_user']==$_smarty_tpl->tpl_vars['user']->value->uid) {?><a onclick="post.comments.del(<?php echo $_smarty_tpl->tpl_vars['c']->value['c_id'];?>
)" class="button_1 type_3 stip" title="Borrar comentario"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/delete_.png"></a><?php }?>
							 </div>
						 </div>
						<div class="comment-body" id="body-comment-<?php echo $_smarty_tpl->tpl_vars['c']->value['c_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['c']->value['c_body'];?>
</div>
					</div>
					<div class="comments-replies" id="new-replie-<?php echo $_smarty_tpl->tpl_vars['c']->value['c_id'];?>
" <?php if ($_smarty_tpl->tpl_vars['c']->value['c_replies']) {?>style="display: block;"<?php }?>>
						<div class="list-replies">
						<?php if ($_smarty_tpl->tpl_vars['c']->value['c_replies']) {?>
							<a class="show-replies" onclick="post.comments.show_replies(<?php echo $_smarty_tpl->tpl_vars['c']->value['c_id'];?>
, $(this));">Mostrar <?php echo $_smarty_tpl->tpl_vars['c']->value['c_replies'];?>
 respuesta<?php if ($_smarty_tpl->tpl_vars['c']->value['c_replies']>1) {?>s<?php }?> a este comentario</a>
						<?php }?>
						</div>
						<div class="my-new-replie clearfix">
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
			<?php echo $_smarty_tpl->tpl_vars['post']->value['comments_pages'];?>

		</div>
		<?php if ($_smarty_tpl->tpl_vars['post']->value['p_comments_status']=='0') {?>
		<div id="error">Este post tiene los comentarios cerrados</div>
		<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['user']->value->uid&&$_smarty_tpl->tpl_vars['post']->value['p_comments_status']=='1') {?>
		<hr />
		<div class="emptyData comment-status" style="display:none;margin-bottom:5px;"></div>
		<div class="floatL">
			<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/<?php echo $_smarty_tpl->tpl_vars['user']->value->nick;?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['avatar'];?>
/<?php echo $_smarty_tpl->tpl_vars['user']->value->uid;?>
_50.jpg?<?php echo $_smarty_tpl->tpl_vars['user']->value->info['u_last_avatar'];?>
" class="avatar-2"/></a>
		</div>
		<div class="floatR" style="width: 650px;">
			<textarea id="r_comment" class="inp_text required newe-c" name="r_body" tabindex="2" placeholder="Escribe un comentario" autocomplete="off"></textarea>
		</div>
		<div class="floatR margin-top-5">
			<input type="button" class="button_1 b_ok" value="Enviar comentario" onclick="post.comment($(this));"/>
		</div>
		<?php }?>
	</div>
</div><?php }} ?>
