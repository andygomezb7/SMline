<?php /* Smarty version Smarty-3.1.15, created on 2014-08-22 16:24:21
         compiled from ".\themes\smline\Templates\admin.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2472153f7b50583aca0-52335223%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bd4a6558eb586e7fc0d30e9518dcb33262fbe119' => 
    array (
      0 => '.\\themes\\smline\\Templates\\admin.tpl',
      1 => 1396992409,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2472153f7b50583aca0-52335223',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'do' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f7b5058c3848_02963894',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f7b5058c3848_02963894')) {function content_53f7b5058c3848_02963894($_smarty_tpl) {?>
<?php echo $_smarty_tpl->getSubTemplate ('i_admin/admin_header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<div id="content" class="clearfix" style="padding: 0;border: 0;background: transparent;width: 1000px;">

<div id="sidebar" style="width: 200px;">
	<?php echo $_smarty_tpl->getSubTemplate ('i_admin/sidebar.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

</div>

<div id="main-col" class="admin-main" style="width: 798px;">
	<?php if ($_smarty_tpl->tpl_vars['do']->value=='settings') {?><?php echo $_smarty_tpl->getSubTemplate ('i_admin/settings.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	<?php } elseif ($_smarty_tpl->tpl_vars['do']->value=='themes') {?><?php echo $_smarty_tpl->getSubTemplate ('i_admin/themes.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	<?php } elseif ($_smarty_tpl->tpl_vars['do']->value=='news') {?><?php echo $_smarty_tpl->getSubTemplate ('i_admin/news.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	<?php } elseif ($_smarty_tpl->tpl_vars['do']->value=='ads') {?><?php echo $_smarty_tpl->getSubTemplate ('i_admin/ads.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	<?php } elseif ($_smarty_tpl->tpl_vars['do']->value=='censored') {?><?php echo $_smarty_tpl->getSubTemplate ('i_admin/censored.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	<?php } elseif ($_smarty_tpl->tpl_vars['do']->value=='links') {?><?php echo $_smarty_tpl->getSubTemplate ('i_admin/links.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	<?php } elseif ($_smarty_tpl->tpl_vars['do']->value=='posts') {?><?php echo $_smarty_tpl->getSubTemplate ('i_admin/posts.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	<?php } elseif ($_smarty_tpl->tpl_vars['do']->value=='cats') {?><?php echo $_smarty_tpl->getSubTemplate ('i_admin/cats.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	<?php } elseif ($_smarty_tpl->tpl_vars['do']->value=='medals') {?><?php echo $_smarty_tpl->getSubTemplate ('i_admin/medals.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	<?php } elseif ($_smarty_tpl->tpl_vars['do']->value=='ranks') {?><?php echo $_smarty_tpl->getSubTemplate ('i_admin/ranks.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	<?php } elseif ($_smarty_tpl->tpl_vars['do']->value=='users') {?><?php echo $_smarty_tpl->getSubTemplate ('i_admin/users.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	<?php } elseif ($_smarty_tpl->tpl_vars['do']->value=='blocked') {?><?php echo $_smarty_tpl->getSubTemplate ('i_admin/blocked.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	<?php } elseif ($_smarty_tpl->tpl_vars['do']->value=='mps') {?><?php echo $_smarty_tpl->getSubTemplate ('i_admin/mps.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	<?php } elseif ($_smarty_tpl->tpl_vars['do']->value=='gallery') {?><?php echo $_smarty_tpl->getSubTemplate ('i_admin/gallery.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	<?php } elseif ($_smarty_tpl->tpl_vars['do']->value=='stats') {?><?php echo $_smarty_tpl->getSubTemplate ('i_admin/stats.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	<?php } else { ?><?php echo $_smarty_tpl->getSubTemplate ('i_admin/main_home.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }?>
	<?php echo $_smarty_tpl->getSubTemplate ('includes/admin_footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

</div>

</div>
</div>
<div class="notification-board right bottom"></div>
</body>
</html><?php }} ?>
