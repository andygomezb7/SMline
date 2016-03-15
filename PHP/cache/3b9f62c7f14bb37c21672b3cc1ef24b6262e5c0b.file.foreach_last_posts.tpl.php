<?php /* Smarty version Smarty-3.1.15, created on 2014-08-22 16:17:42
         compiled from ".\themes\smline\Templates\i_home\foreach_last_posts.tpl" */ ?>
<?php /*%%SmartyHeaderCode:510953f7b376086b89-15740103%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3b9f62c7f14bb37c21672b3cc1ef24b6262e5c0b' => 
    array (
      0 => '.\\themes\\smline\\Templates\\i_home\\foreach_last_posts.tpl',
      1 => 1401317032,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '510953f7b376086b89-15740103',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'p' => 0,
    'web' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f7b37611f122_82540729',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f7b37611f122_82540729')) {function content_53f7b37611f122_82540729($_smarty_tpl) {?><div class="list-element<?php if ($_smarty_tpl->tpl_vars['p']->value['p_sticky']==2) {?> patrocinado<?php }?>">
	<?php if ($_smarty_tpl->tpl_vars['p']->value['p_sticky']) {?>
		<i class="icon sticky" title="Sticky"></i>
	<?php }?>
	<i class="icon" title="<?php echo $_smarty_tpl->tpl_vars['p']->value['c_name'];?>
" style="background: url(<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/cats/<?php echo $_smarty_tpl->tpl_vars['p']->value['c_img'];?>
) no-repeat;"></i>
	<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/posts/<?php echo $_smarty_tpl->tpl_vars['p']->value['c_seo'];?>
/<?php echo $_smarty_tpl->tpl_vars['p']->value['p_id'];?>
/<?php echo seo($_smarty_tpl->tpl_vars['p']->value['p_title']);?>
.html" title="<?php echo $_smarty_tpl->tpl_vars['p']->value['p_title'];?>
" <?php if ($_smarty_tpl->tpl_vars['p']->value['p_status']!=1) {?>style="font-weight: normal;<?php if ($_smarty_tpl->tpl_vars['p']->value['p_status']==0) {?>color:red<?php } elseif ($_smarty_tpl->tpl_vars['p']->value['p_status']==2) {?>color:indigo<?php }?>"<?php }?>><?php echo $_smarty_tpl->tpl_vars['p']->value['p_title'];?>
</a>
	<?php if ($_smarty_tpl->tpl_vars['p']->value['p_status']!=1) {?>
	<a class="stip floatR" title="Este post se encuentra <?php if ($_smarty_tpl->tpl_vars['p']->value['p_status']==0) {?>eliminado<?php } elseif ($_smarty_tpl->tpl_vars['p']->value['p_status']==2) {?>en revisión<?php }?>">
		<i class="icon info nm"></i>
	</a>
	<?php }?>
</div><?php }} ?>
