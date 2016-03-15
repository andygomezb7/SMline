<?php /* Smarty version Smarty-3.1.15, created on 2014-08-22 16:21:44
         compiled from ".\themes\smline\Templates\t_ajax\comment_post.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2155353f7b468e65159-63861535%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f601c9d4f032bd542d6f56d2f77420ac26eb7ce7' => 
    array (
      0 => '.\\themes\\smline\\Templates\\t_ajax\\comment_post.tpl',
      1 => 1390080877,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2155353f7b468e65159-63861535',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'comment' => 0,
    'web' => 0,
    'user' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f7b469015090_62866191',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f7b469015090_62866191')) {function content_53f7b469015090_62866191($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'C:\\xampp\\htdocs\\PHP\\libs\\plugins\\modifier.date_format.php';
?>1:
<div id="comment-<?php echo $_smarty_tpl->tpl_vars['comment']->value[0];?>
" class="list-comment clearfix">
	<div class="floatL">
		<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/<?php echo $_smarty_tpl->tpl_vars['user']->value->nick;?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['avatar'];?>
/<?php echo $_smarty_tpl->tpl_vars['user']->value->uid;?>
_50.jpg?<?php echo $_smarty_tpl->tpl_vars['user']->value->info['u_last_avatar'];?>
" class="avatar-2"/></a>
	</div>
	<div class="floatR c-body">
		<span class="dialog-comment"></span>
		<div class="comment-info">
			<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/<?php echo $_smarty_tpl->tpl_vars['user']->value->nick;?>
" class="hovercard" uid="<?php echo $_smarty_tpl->tpl_vars['user']->value->uid;?>
"><?php echo $_smarty_tpl->tpl_vars['user']->value->nick;?>
</a>
			 <span class="stip" title="<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['comment']->value[2],"%d/%m/%Y %I:%M %p");?>
"><?php echo hace($_smarty_tpl->tpl_vars['comment']->value[2]);?>
</span>
			 <div class="comment-options">
				<a onclick="post.comments.del(<?php echo $_smarty_tpl->tpl_vars['comment']->value[0];?>
)" class="button_1 type_3 stip" title="Borrar comentario"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/delete_.png"></a>
			</div>
		</div>
		<div class="comment-body"><?php echo $_smarty_tpl->tpl_vars['comment']->value[1];?>
</div>
	</div>
</div><?php }} ?>
