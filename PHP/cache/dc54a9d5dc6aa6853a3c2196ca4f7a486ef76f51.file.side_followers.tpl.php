<?php /* Smarty version Smarty-3.1.15, created on 2014-08-22 16:25:35
         compiled from ".\themes\smline\Templates\i_profile\side_followers.tpl" */ ?>
<?php /*%%SmartyHeaderCode:123153f7b54f1afd22-48489060%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dc54a9d5dc6aa6853a3c2196ca4f7a486ef76f51' => 
    array (
      0 => '.\\themes\\smline\\Templates\\i_profile\\side_followers.tpl',
      1 => 1399043423,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '123153f7b54f1afd22-48489060',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'u_info' => 0,
    'u_followers' => 0,
    'web' => 0,
    'u' => 0,
    'u_following' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f7b54f2194c4_85303360',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f7b54f2194c4_85303360')) {function content_53f7b54f2194c4_85303360($_smarty_tpl) {?><div class="box box_autor margin-top-5">
	<div class="box_title">Seguidores<span class="title_right_info"><?php echo $_smarty_tpl->tpl_vars['u_info']->value['u_follows'];?>
</span></div>
	<div class="box_body <?php if ($_smarty_tpl->tpl_vars['u_info']->value['u_followers']) {?>for_followers<?php }?>">
		<div class="profile_side_lists clearfix">
			<?php if (!$_smarty_tpl->tpl_vars['u_followers']->value) {?><div id="error"><?php echo $_smarty_tpl->tpl_vars['u_info']->value['u_nick'];?>
 no tiene seguidores</div><?php }?>
			<?php  $_smarty_tpl->tpl_vars['u'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['u']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['u_followers']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['u']->key => $_smarty_tpl->tpl_vars['u']->value) {
$_smarty_tpl->tpl_vars['u']->_loop = true;
?>
				<li class="list_follows">
					<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/<?php echo $_smarty_tpl->tpl_vars['u']->value['u_nick'];?>
" class="hovercard" uid="<?php echo $_smarty_tpl->tpl_vars['u']->value['u_id'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['u']->value['u_nick'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['avatar'];?>
/<?php echo $_smarty_tpl->tpl_vars['u']->value['u_id'];?>
_50.jpg?<?php echo $_smarty_tpl->tpl_vars['u']->value['u_last_avatar'];?>
" /></a>
				</li>
			<?php } ?>
		</div>
		<?php if ($_smarty_tpl->tpl_vars['u_info']->value['u_follows']>18) {?>
			<div class="box_more">
				<a onclick="profile.load_tab('follows');" href="#seguidores">Ver más</a>
			</div>
		<?php }?>
	</div>
</div>

<div class="box box_autor margin-top-5">
	<div class="box_title">Siguiendo<span class="title_right_info"><?php echo $_smarty_tpl->tpl_vars['u_info']->value['u_following'];?>
</span></div>
	<div class="box_body <?php if ($_smarty_tpl->tpl_vars['u_info']->value['u_following']) {?>for_followers<?php }?>">
		<div class="profile_side_lists clearfix">
			<?php if (!$_smarty_tpl->tpl_vars['u_following']->value) {?><div id="error"><?php echo $_smarty_tpl->tpl_vars['u_info']->value['u_nick'];?>
 no sigue usuarios</div><?php }?>
			<?php  $_smarty_tpl->tpl_vars['u'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['u']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['u_following']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['u']->key => $_smarty_tpl->tpl_vars['u']->value) {
$_smarty_tpl->tpl_vars['u']->_loop = true;
?>
				<li class="list_follows">
					<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/<?php echo $_smarty_tpl->tpl_vars['u']->value['u_nick'];?>
" class="hovercard" uid="<?php echo $_smarty_tpl->tpl_vars['u']->value['u_id'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['u']->value['u_nick'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['avatar'];?>
/<?php echo $_smarty_tpl->tpl_vars['u']->value['u_id'];?>
_50.jpg?<?php echo $_smarty_tpl->tpl_vars['u']->value['u_last_avatar'];?>
" /></a>
				</li>
			<?php } ?>
		</div>
		<?php if ($_smarty_tpl->tpl_vars['u_info']->value['u_following']>18) {?>
			<div class="box_more">
				<a onclick="profile.load_tab('following');" href="#siguiendo">Ver más</a>
			</div>
		<?php }?>
	</div>
</div>	<?php }} ?>
