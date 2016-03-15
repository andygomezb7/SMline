<?php /* Smarty version Smarty-3.1.15, created on 2014-08-23 11:24:02
         compiled from ".\themes\smline\Templates\tops.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2834753f8c022b74745-32892202%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4aef79f2a2d9a10b7e50a3552d2e544d0370f3f0' => 
    array (
      0 => '.\\themes\\smline\\Templates\\tops.tpl',
      1 => 1397091522,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2834753f8c022b74745-32892202',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    't_action' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f8c022bfd2e0_42024460',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f8c022bfd2e0_42024460')) {function content_53f8c022bfd2e0_42024460($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('includes/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>



<div id="main-col" style="width: 725px;">
<?php if ($_smarty_tpl->tpl_vars['t_action']->value=='usuarios') {?>
	<?php echo $_smarty_tpl->getSubTemplate ('i_tops/top_users.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php } elseif ($_smarty_tpl->tpl_vars['t_action']->value=='comunidades') {?>
	<?php echo $_smarty_tpl->getSubTemplate ('i_tops/top_comus.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php } else { ?>
	<?php echo $_smarty_tpl->getSubTemplate ('i_tops/top_posts.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php }?>
</div>

<div class="home_right">
	<?php echo $_smarty_tpl->getSubTemplate ('i_tops/sidebar.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

</div>

<?php echo $_smarty_tpl->getSubTemplate ('includes/footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
