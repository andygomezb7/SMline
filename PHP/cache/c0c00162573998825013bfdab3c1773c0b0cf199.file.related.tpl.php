<?php /* Smarty version Smarty-3.1.15, created on 2014-08-22 16:17:28
         compiled from ".\themes\smline\Templates\i_post\related.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1662553f7b368f1e164-35911417%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c0c00162573998825013bfdab3c1773c0b0cf199' => 
    array (
      0 => '.\\themes\\smline\\Templates\\i_post\\related.tpl',
      1 => 1388963711,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1662553f7b368f1e164-35911417',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'post' => 0,
    'p' => 0,
    'web' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f7b369006ce8_70754409',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f7b369006ce8_70754409')) {function content_53f7b369006ce8_70754409($_smarty_tpl) {?><div class="related-left">	<div class="box margin-top-5 posts-related">		<div class="box_title">Posts relacionados</div>		<div class="box_body clearfix">			<?php if (!$_smarty_tpl->tpl_vars['post']->value['related']) {?><div id="error">No hay posts relacionados</div><?php }?>			<?php  $_smarty_tpl->tpl_vars['p'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['p']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['post']->value['related']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['p']->key => $_smarty_tpl->tpl_vars['p']->value) {
$_smarty_tpl->tpl_vars['p']->_loop = true;
?>			<div class="list-element"><i class="etip icon" title="<?php echo $_smarty_tpl->tpl_vars['p']->value['c_name'];?>
" style="background: url(<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/cats/<?php echo $_smarty_tpl->tpl_vars['p']->value['c_img'];?>
) no-repeat;"></i><a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/posts/<?php echo $_smarty_tpl->tpl_vars['p']->value['c_seo'];?>
/<?php echo $_smarty_tpl->tpl_vars['p']->value['p_id'];?>
/<?php echo seo($_smarty_tpl->tpl_vars['p']->value['p_title']);?>
.html" title="<?php echo $_smarty_tpl->tpl_vars['p']->value['p_title'];?>
"><?php echo $_smarty_tpl->tpl_vars['p']->value['p_title'];?>
</a></div>			<?php } ?>		</div>	</div></div><?php }} ?>
