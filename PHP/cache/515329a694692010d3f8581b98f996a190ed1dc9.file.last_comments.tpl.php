<?php /* Smarty version Smarty-3.1.15, created on 2014-08-23 11:24:18
         compiled from ".\themes\smline\Templates\i_images\last_comments.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2584053f8c032e910b9-82876157%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '515329a694692010d3f8581b98f996a190ed1dc9' => 
    array (
      0 => '.\\themes\\smline\\Templates\\i_images\\last_comments.tpl',
      1 => 1398820448,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2584053f8c032e910b9-82876157',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'last_comments' => 0,
    'web' => 0,
    'i' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f8c032ec7bb2_17630385',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f8c032ec7bb2_17630385')) {function content_53f8c032ec7bb2_17630385($_smarty_tpl) {?><div class="box margin-top-5">	<div class="box_title">Comentarios recientes</div>	<div class="box_body list_element">		<?php if ($_smarty_tpl->tpl_vars['last_comments']->value) {?>		<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['i']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['last_comments']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value) {
$_smarty_tpl->tpl_vars['i']->_loop = true;
?>		<div class="list-element">			<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/<?php echo $_smarty_tpl->tpl_vars['i']->value['u_nick'];?>
" class="subinfo"><?php echo $_smarty_tpl->tpl_vars['i']->value['u_nick'];?>
</a>			<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/imagenes/<?php echo $_smarty_tpl->tpl_vars['i']->value['i_id'];?>
/<?php echo seo($_smarty_tpl->tpl_vars['i']->value['i_title']);?>
.html"><?php echo $_smarty_tpl->tpl_vars['i']->value['i_title'];?>
</a>		</div>		<?php } ?>		<?php } else { ?>		<div class="emptyData">No hay comentarios nuevos en im&aacute;genes</div>		<?php }?>	</div></div><?php }} ?>
