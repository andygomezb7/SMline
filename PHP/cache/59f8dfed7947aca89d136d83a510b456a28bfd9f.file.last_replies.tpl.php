<?php /* Smarty version Smarty-3.1.15, created on 2014-08-23 11:24:17
         compiled from ".\themes\smline\Templates\i_communities\home\last_replies.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1901853f8c0319e9588-10926276%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '59f8dfed7947aca89d136d83a510b456a28bfd9f' => 
    array (
      0 => '.\\themes\\smline\\Templates\\i_communities\\home\\last_replies.tpl',
      1 => 1398819496,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1901853f8c0319e9588-10926276',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'last_comments' => 0,
    'web' => 0,
    't' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f8c031a23f16_96549303',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f8c031a23f16_96549303')) {function content_53f8c031a23f16_96549303($_smarty_tpl) {?><div class="box margin-top-5">	<div class="box_title">Respuestas recientes</div>	<div class="box_body list_element">		<?php if ($_smarty_tpl->tpl_vars['last_comments']->value) {?>		<?php  $_smarty_tpl->tpl_vars['t'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['t']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['last_comments']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['t']->key => $_smarty_tpl->tpl_vars['t']->value) {
$_smarty_tpl->tpl_vars['t']->_loop = true;
?>		<div class="list-element">			<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/<?php echo $_smarty_tpl->tpl_vars['t']->value['u_nick'];?>
" class="subinfo"><?php echo $_smarty_tpl->tpl_vars['t']->value['u_nick'];?>
</a>			<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/comunidades/<?php echo $_smarty_tpl->tpl_vars['t']->value['comu_seo'];?>
/<?php echo $_smarty_tpl->tpl_vars['t']->value['t_id'];?>
/<?php echo seo($_smarty_tpl->tpl_vars['t']->value['t_title']);?>
.html"><?php echo $_smarty_tpl->tpl_vars['t']->value['t_title'];?>
</a>		</div>		<?php } ?>		<?php } else { ?>		<div class="emptyData">No hay respuestas nuevas</div>		<?php }?>	</div></div><?php }} ?>
