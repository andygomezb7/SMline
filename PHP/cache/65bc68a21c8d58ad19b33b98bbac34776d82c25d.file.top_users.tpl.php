<?php /* Smarty version Smarty-3.1.15, created on 2014-08-22 16:18:16
         compiled from ".\themes\smline\Templates\t_ajax\top_users.tpl" */ ?>
<?php /*%%SmartyHeaderCode:421253f7b3980c1198-82078950%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '65bc68a21c8d58ad19b33b98bbac34776d82c25d' => 
    array (
      0 => '.\\themes\\smline\\Templates\\t_ajax\\top_users.tpl',
      1 => 1398819288,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '421253f7b3980c1198-82078950',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'top_users' => 0,
    'i' => 0,
    'web' => 0,
    'u' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f7b3981170b2_32287536',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f7b3981170b2_32287536')) {function content_53f7b3981170b2_32287536($_smarty_tpl) {?><?php if (!$_smarty_tpl->tpl_vars['top_users']->value) {?><div class="emptyData">No hay usuarios en este rango de tiempo</div><?php }?><?php  $_smarty_tpl->tpl_vars['u'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['u']->_loop = false;
 $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['top_users']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['u']->key => $_smarty_tpl->tpl_vars['u']->value) {
$_smarty_tpl->tpl_vars['u']->_loop = true;
 $_smarty_tpl->tpl_vars['i']->value = $_smarty_tpl->tpl_vars['u']->key;
?><div class="list-element">	<span class="number-list"><?php echo $_smarty_tpl->tpl_vars['i']->value+1;?>
</span>	<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/<?php echo $_smarty_tpl->tpl_vars['u']->value['u_nick'];?>
"><?php echo $_smarty_tpl->tpl_vars['u']->value['u_nick'];?>
</a>	<span class="value"><?php echo $_smarty_tpl->tpl_vars['u']->value['total'];?>
</span></div><?php } ?><div class="box_more">	<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/tops/users">Ver más</a></div><?php }} ?>
