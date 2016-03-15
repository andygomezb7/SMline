<?php /* Smarty version Smarty-3.1.15, created on 2014-08-23 11:24:18
         compiled from ".\themes\smline\Templates\images.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2161353f8c032c0c793-52107860%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7cedfdc3ef2056af5c654242613ca6c90cdfbf51' => 
    array (
      0 => '.\\themes\\smline\\Templates\\images.tpl',
      1 => 1399042552,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2161353f8c032c0c793-52107860',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'imginfo' => 0,
    'do' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f8c032ccfcc6_26858822',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f8c032ccfcc6_26858822')) {function content_53f8c032ccfcc6_26858822($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('includes/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php if ($_smarty_tpl->tpl_vars['imginfo']->value) {?>	<?php echo $_smarty_tpl->getSubTemplate ('i_images/edit.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php } elseif ($_smarty_tpl->tpl_vars['do']->value=='agregar') {?>	<?php echo $_smarty_tpl->getSubTemplate ('i_images/add.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php } elseif ($_smarty_tpl->tpl_vars['do']->value=='historial') {?>	<?php echo $_smarty_tpl->getSubTemplate ('i_images/historial.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
	<?php } else { ?><div id="main-col" style="width: 708px;">	<?php echo $_smarty_tpl->getSubTemplate ('i_images/home_main.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
</div><div id="sidebar" style="margin-left:5px;">	<?php echo $_smarty_tpl->getSubTemplate ('i_images/stats.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
	<?php echo $_smarty_tpl->getSubTemplate ('i_images/last_comments.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
	<?php echo $_smarty_tpl->getSubTemplate ('i_banners/160.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
</div><?php }?><?php echo $_smarty_tpl->getSubTemplate ('includes/footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
