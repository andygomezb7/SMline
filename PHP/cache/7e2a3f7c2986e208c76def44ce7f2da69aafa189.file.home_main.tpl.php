<?php /* Smarty version Smarty-3.1.15, created on 2014-08-23 11:24:18
         compiled from ".\themes\smline\Templates\i_images\home_main.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2269053f8c032d39456-95372373%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7e2a3f7c2986e208c76def44ce7f2da69aafa189' => 
    array (
      0 => '.\\themes\\smline\\Templates\\i_images\\home_main.tpl',
      1 => 1399040887,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2269053f8c032d39456-95372373',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'last_images' => 0,
    'web' => 0,
    'i' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f8c032ddd582_83812390',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f8c032ddd582_83812390')) {function content_53f8c032ddd582_83812390($_smarty_tpl) {?><div class="box">
	<div class="box_title">Imágenes recientes</div>
	<div class="box_body last_images clearfix" style="padding: 4px;padding-left:0;">
		<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['i']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['last_images']->value['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value) {
$_smarty_tpl->tpl_vars['i']->_loop = true;
?>
		<div class="img-list">
			<div class="img-head"><a class="img-title stip" href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/imagenes/<?php echo $_smarty_tpl->tpl_vars['i']->value['i_id'];?>
/<?php echo seo($_smarty_tpl->tpl_vars['i']->value['i_title']);?>
.html" title="<?php echo $_smarty_tpl->tpl_vars['i']->value['i_title'];?>
"><?php echo substr($_smarty_tpl->tpl_vars['i']->value['i_title'],0,30);?>
</a><a onclick="img.prev(<?php echo $_smarty_tpl->tpl_vars['i']->value['i_id'];?>
, $(this));" class="stip floatR" title="Previsualizar imagen" style="margin-top: 3px;"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/eye_.png" /></a></div>
			<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/imagenes/<?php echo $_smarty_tpl->tpl_vars['i']->value['i_id'];?>
/<?php echo seo($_smarty_tpl->tpl_vars['i']->value['i_title']);?>
.html"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/thumbs/images/t_<?php echo $_smarty_tpl->tpl_vars['i']->value['i_id'];?>
.jpg" class="img-src" /></a>
			<span class="img-desc"><?php echo substr($_smarty_tpl->tpl_vars['i']->value['i_description'],0,220);?>
</span>
			<span class="img-date"><?php echo hace($_smarty_tpl->tpl_vars['i']->value['i_date']);?>
 por @<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/<?php echo $_smarty_tpl->tpl_vars['i']->value['u_nick'];?>
"><?php echo $_smarty_tpl->tpl_vars['i']->value['u_nick'];?>
</a></span>
		</div>
		<?php } ?>
		<?php if ($_smarty_tpl->tpl_vars['last_images']->value['pages']) {?>
		<div style="margin-left:5px;clear: both;"><?php echo $_smarty_tpl->tpl_vars['last_images']->value['pages'];?>
</div>
		<?php }?>
		<?php if (!$_smarty_tpl->tpl_vars['last_images']->value['list']) {?><div class="emptyData">No hay im&aacute;genes recientes</div><?php }?>
	</div>
</div><?php }} ?>
