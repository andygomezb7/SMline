<?php /* Smarty version Smarty-3.1.15, created on 2014-08-22 16:35:29
         compiled from ".\themes\smline\Templates\home_portadas.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2764253f7b7a18eb645-37439264%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '07722d88ec834ceb7d8b2d7a5dddf8722d7ebf48' => 
    array (
      0 => '.\\themes\\smline\\Templates\\home_portadas.tpl',
      1 => 1397250413,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2764253f7b7a18eb645-37439264',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f7b7a192dcd2_44545522',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f7b7a192dcd2_44545522')) {function content_53f7b7a192dcd2_44545522($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('includes/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<?php echo $_smarty_tpl->getSubTemplate ('i_home/news.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<div class="home_left">
	<?php echo $_smarty_tpl->getSubTemplate ('i_home/last_posts_portadas.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

</div>

<div class="home_right">
	<?php echo $_smarty_tpl->getSubTemplate ('i_home/stats.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	<?php echo $_smarty_tpl->getSubTemplate ('i_home/last_comments.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	<?php echo $_smarty_tpl->getSubTemplate ('i_home/top_posts.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	<?php echo $_smarty_tpl->getSubTemplate ('i_home/top_users.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	<?php echo $_smarty_tpl->getSubTemplate ('i_home/links.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

</div>

<?php echo $_smarty_tpl->getSubTemplate ('includes/footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
