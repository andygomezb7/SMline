<?php /* Smarty version Smarty-3.1.15, created on 2014-08-22 15:59:58
         compiled from ".\themes\smline\Templates\i_home\links.tpl" */ ?>
<?php /*%%SmartyHeaderCode:611953f7af4e91ab70-92668910%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '67dcef8ebf302df998c425d5e603011dd19e4b8e' => 
    array (
      0 => '.\\themes\\smline\\Templates\\i_home\\links.tpl',
      1 => 1397929767,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '611953f7af4e91ab70-92668910',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'links_i' => 0,
    'l' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f7af4e92a579_61164255',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f7af4e92a579_61164255')) {function content_53f7af4e92a579_61164255($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['links_i']->value) {?>
<div class="box margin-top-5">
	<div class="box_title">Links de interés</div>
	<div class="box_body list_element webs_amigas">
		<center>
		<?php  $_smarty_tpl->tpl_vars['l'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['l']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['links_i']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['l']->key => $_smarty_tpl->tpl_vars['l']->value) {
$_smarty_tpl->tpl_vars['l']->_loop = true;
?>
		<a href="<?php echo $_smarty_tpl->tpl_vars['l']->value['l_url'];?>
" rel="nofollow" target="_blank"><?php echo $_smarty_tpl->tpl_vars['l']->value['l_title'];?>
</a><hr>
		<?php } ?>
		</center>
	</div>
</div>
<?php }?><?php }} ?>
