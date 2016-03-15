<?php /* Smarty version Smarty-3.1.15, created on 2014-08-22 16:17:28
         compiled from ".\themes\smline\Templates\post.tpl" */ ?>
<?php /*%%SmartyHeaderCode:461853f7b368af39e8-80610618%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '93fc270f3a0d4c130b938ea37a27f62335b551c7' => 
    array (
      0 => '.\\themes\\smline\\Templates\\post.tpl',
      1 => 1388963648,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '461853f7b368af39e8-80610618',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f7b368b321f4_26102580',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f7b368b321f4_26102580')) {function content_53f7b368b321f4_26102580($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('includes/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<div id="sidebar">	<?php echo $_smarty_tpl->getSubTemplate ('i_post/author.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
</div><div id="main-col" style="margin-left:5px;">	<?php echo $_smarty_tpl->getSubTemplate ('i_post/content.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
	<?php echo $_smarty_tpl->getSubTemplate ('i_post/related.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
	<div class="publi-right">	<?php echo $_smarty_tpl->getSubTemplate ('i_banners/300.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
	</div>	<?php echo $_smarty_tpl->getSubTemplate ('i_post/comments.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
</div><?php echo $_smarty_tpl->getSubTemplate ('includes/footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
