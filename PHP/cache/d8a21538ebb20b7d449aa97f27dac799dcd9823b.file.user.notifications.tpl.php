<?php /* Smarty version Smarty-3.1.15, created on 2014-08-23 10:50:50
         compiled from ".\themes\smline\Templates\t_ajax\user.notifications.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1761153f8b85ac7a702-72461501%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd8a21538ebb20b7d449aa97f27dac799dcd9823b' => 
    array (
      0 => '.\\themes\\smline\\Templates\\t_ajax\\user.notifications.tpl',
      1 => 1396746295,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1761153f8b85ac7a702-72461501',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'notifications' => 0,
    'n' => 0,
    'web' => 0,
    'limit' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f8b85b15ad79_32282223',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f8b85b15ad79_32282223')) {function content_53f8b85b15ad79_32282223($_smarty_tpl) {?>1: 
<?php if (count($_smarty_tpl->tpl_vars['notifications']->value)==0) {?>
<div class="modal-error">No tienes notificaciones nuevas</div>
<?php }?>
<?php  $_smarty_tpl->tpl_vars['n'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['n']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['notifications']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['n']->key => $_smarty_tpl->tpl_vars['n']->value) {
$_smarty_tpl->tpl_vars['n']->_loop = true;
?>
<li class="activity-list<?php if ($_smarty_tpl->tpl_vars['n']->value['n_view']!=2) {?> notview<?php }?>">
	<i class="smarticon <?php echo $_smarty_tpl->tpl_vars['n']->value['css'];?>
"></i>
	<?php if ($_smarty_tpl->tpl_vars['n']->value['show_user']) {?><a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/<?php echo $_smarty_tpl->tpl_vars['n']->value['user'];?>
"><?php echo $_smarty_tpl->tpl_vars['n']->value['user'];?>
</a> <?php }?><?php echo $_smarty_tpl->tpl_vars['n']->value['text'];?>
 <a href="<?php echo $_smarty_tpl->tpl_vars['n']->value['link'];?>
" class="stip" title="<?php echo $_smarty_tpl->tpl_vars['n']->value['title'];?>
"><?php echo $_smarty_tpl->tpl_vars['n']->value['obj'];?>
</a><?php if ($_smarty_tpl->tpl_vars['n']->value['complement']) {?> <?php echo $_smarty_tpl->tpl_vars['n']->value['complement'];?>
<?php }?>
</li>
<?php } ?>
<?php if (count($_smarty_tpl->tpl_vars['notifications']->value)==$_smarty_tpl->tpl_vars['limit']->value) {?>
<a class="load_more" onclick="notifica.view_more($(this))">Cargar m&aacute;s</a>
<?php }?><?php }} ?>
