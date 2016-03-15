<?php /* Smarty version Smarty-3.1.15, created on 2014-08-22 15:59:58
         compiled from ".\themes\smline\Templates\i_home\last_members.tpl" */ ?>
<?php /*%%SmartyHeaderCode:861453f7af4e8cc965-95336237%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e13fca4be01b7273047a67c8c3570b6c281885c3' => 
    array (
      0 => '.\\themes\\smline\\Templates\\i_home\\last_members.tpl',
      1 => 1392503496,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '861453f7af4e8cc965-95336237',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'last_members' => 0,
    'web' => 0,
    'u' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f7af4e8f3a62_57676174',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f7af4e8f3a62_57676174')) {function content_53f7af4e8f3a62_57676174($_smarty_tpl) {?><div class="box">	<div class="box_title">Últimos registrados</div>	<div class="box_body last_members list_element">		<?php if ($_smarty_tpl->tpl_vars['last_members']->value) {?>		<?php  $_smarty_tpl->tpl_vars['u'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['u']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['last_members']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['u']->key => $_smarty_tpl->tpl_vars['u']->value) {
$_smarty_tpl->tpl_vars['u']->_loop = true;
?>		<div class="list-element">			<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/<?php echo $_smarty_tpl->tpl_vars['u']->value['u_nick'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['avatar'];?>
/<?php echo $_smarty_tpl->tpl_vars['u']->value['u_id'];?>
_32.jpg?<?php echo $_smarty_tpl->tpl_vars['u']->value['u_last_avatar'];?>
" /></a>			<a class="u_nick" href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/<?php echo $_smarty_tpl->tpl_vars['u']->value['u_nick'];?>
">@<?php echo $_smarty_tpl->tpl_vars['u']->value['u_nick'];?>
</a>		</div>		<?php } ?>		<?php } else { ?>		<div id="error">No hay miembros nuevos</div>		<?php }?>	</div></div><?php }} ?>
