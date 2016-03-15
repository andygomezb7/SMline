<?php /* Smarty version Smarty-3.1.15, created on 2014-08-22 15:59:58
         compiled from ".\themes\smline\Templates\i_home\last_posts.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1626153f7af4e73e204-35518719%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ee6ef788322b81de8bc4f92412b905591c555cab' => 
    array (
      0 => '.\\themes\\smline\\Templates\\i_home\\last_posts.tpl',
      1 => 1401316948,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1626153f7af4e73e204-35518719',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'last_stickys' => 0,
    'last_posts' => 0,
    'web' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f7af4e761484_31944149',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f7af4e761484_31944149')) {function content_53f7af4e761484_31944149($_smarty_tpl) {?><div class="box">
	<div class="box_title">Posts recientes</div>
	<div class="box_body last_posts" style="position: relative;">
		<?php  $_smarty_tpl->tpl_vars['p'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['p']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['last_stickys']->value['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['p']->key => $_smarty_tpl->tpl_vars['p']->value) {
$_smarty_tpl->tpl_vars['p']->_loop = true;
?>
			<?php echo $_smarty_tpl->getSubTemplate ('i_home/foreach_last_posts.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		<?php } ?>
		<?php if (!$_smarty_tpl->tpl_vars['last_posts']->value['list']&&!$_smarty_tpl->tpl_vars['last_stickys']->value['list']) {?><div class="emptyData">No hay posts en <?php echo $_smarty_tpl->tpl_vars['web']->value['title'];?>
</div><?php }?>
		<?php  $_smarty_tpl->tpl_vars['p'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['p']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['last_posts']->value['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['p']->key => $_smarty_tpl->tpl_vars['p']->value) {
$_smarty_tpl->tpl_vars['p']->_loop = true;
?>
			<?php echo $_smarty_tpl->getSubTemplate ('i_home/foreach_last_posts.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		<?php } ?>
		<?php echo $_smarty_tpl->tpl_vars['last_posts']->value['pages'];?>

	</div>
</div><?php }} ?>
