<?php /* Smarty version Smarty-3.1.15, created on 2014-08-22 15:59:58
         compiled from ".\themes\smline\Templates\i_home\last_comments.tpl" */ ?>
<?php /*%%SmartyHeaderCode:973953f7af4e7d2920-21805361%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1f9f47f5d77b2ea5872e63058da755015ce878ab' => 
    array (
      0 => '.\\themes\\smline\\Templates\\i_home\\last_comments.tpl',
      1 => 1398819573,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '973953f7af4e7d2920-21805361',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'last_comments' => 0,
    'web' => 0,
    'p' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f7af4e801736_20393872',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f7af4e801736_20393872')) {function content_53f7af4e801736_20393872($_smarty_tpl) {?><div class="box margin-top-5">	<div class="box_title">Comentarios recientes</div>	<div class="box_body list_element">		<?php if ($_smarty_tpl->tpl_vars['last_comments']->value) {?>		<?php  $_smarty_tpl->tpl_vars['p'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['p']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['last_comments']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['p']->key => $_smarty_tpl->tpl_vars['p']->value) {
$_smarty_tpl->tpl_vars['p']->_loop = true;
?>		<div class="list-element">			<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/<?php echo $_smarty_tpl->tpl_vars['p']->value['u_nick'];?>
" class="subinfo"><?php echo $_smarty_tpl->tpl_vars['p']->value['u_nick'];?>
</a>			<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/posts/<?php echo $_smarty_tpl->tpl_vars['p']->value['c_seo'];?>
/<?php echo $_smarty_tpl->tpl_vars['p']->value['p_id'];?>
/<?php echo seo($_smarty_tpl->tpl_vars['p']->value['p_title']);?>
.html"><?php echo $_smarty_tpl->tpl_vars['p']->value['p_title'];?>
</a>		</div>		<?php } ?>		<?php } else { ?>		<div class="emptyData">No hay comentarios en <?php echo $_smarty_tpl->tpl_vars['web']->value['title'];?>
</div>		<?php }?>	</div></div><?php }} ?>
