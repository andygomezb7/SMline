<?php /* Smarty version Smarty-3.1.15, created on 2014-08-22 15:59:58
         compiled from ".\themes\smline\Templates\home.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1736053f7af4e2a6469-13998038%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a71244b058a03a0d2b91e260f70bb08c23b1c897' => 
    array (
      0 => '.\\themes\\smline\\Templates\\home.tpl',
      1 => 1396558671,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1736053f7af4e2a6469-13998038',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f7af4e323483_00040294',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f7af4e323483_00040294')) {function content_53f7af4e323483_00040294($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('includes/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<?php echo $_smarty_tpl->getSubTemplate ('i_home/news.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<div class="home_left">
	<?php echo $_smarty_tpl->getSubTemplate ('i_home/last_posts.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

</div>

<div class="home_center">
	<?php echo $_smarty_tpl->getSubTemplate ('i_home/stats.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	<?php echo $_smarty_tpl->getSubTemplate ('i_home/last_comments.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	<?php echo $_smarty_tpl->getSubTemplate ('i_home/top_posts.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	<?php echo $_smarty_tpl->getSubTemplate ('i_home/top_users.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

</div>

<div class="home_right">
	<?php echo $_smarty_tpl->getSubTemplate ('i_home/last_members.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	<?php echo $_smarty_tpl->getSubTemplate ('i_home/links.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	<?php echo $_smarty_tpl->getSubTemplate ('i_banners/160.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

</div>

<?php echo $_smarty_tpl->getSubTemplate ('includes/footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
