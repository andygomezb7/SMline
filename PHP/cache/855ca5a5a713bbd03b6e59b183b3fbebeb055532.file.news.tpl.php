<?php /* Smarty version Smarty-3.1.15, created on 2014-08-22 15:59:58
         compiled from ".\themes\smline\Templates\i_home\news.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1970853f7af4e6c5067-30613516%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '855ca5a5a713bbd03b6e59b183b3fbebeb055532' => 
    array (
      0 => '.\\themes\\smline\\Templates\\i_home\\news.tpl',
      1 => 1392503479,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1970853f7af4e6c5067-30613516',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'h_news' => 0,
    'i' => 0,
    'n' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f7af4e6d88e3_16071713',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f7af4e6d88e3_16071713')) {function content_53f7af4e6d88e3_16071713($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['h_news']->value) {?><div class="all_news">	<div class="home_news">		<?php  $_smarty_tpl->tpl_vars['n'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['n']->_loop = false;
 $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['h_news']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['n']->key => $_smarty_tpl->tpl_vars['n']->value) {
$_smarty_tpl->tpl_vars['n']->_loop = true;
 $_smarty_tpl->tpl_vars['i']->value = $_smarty_tpl->tpl_vars['n']->key;
?>		<div id="error" class="home_new" style="<?php if ($_smarty_tpl->tpl_vars['i']->value!=0) {?>display: none;<?php }?>"><?php echo $_smarty_tpl->tpl_vars['n']->value['n_body'];?>
</div>		<?php } ?>	</div></div><?php }?><?php }} ?>
