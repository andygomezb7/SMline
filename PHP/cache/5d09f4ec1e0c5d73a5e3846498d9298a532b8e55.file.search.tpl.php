<?php /* Smarty version Smarty-3.1.15, created on 2014-08-22 16:24:04
         compiled from ".\themes\smline\Templates\search.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2453053f7b4f470a318-15286729%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5d09f4ec1e0c5d73a5e3846498d9298a532b8e55' => 
    array (
      0 => '.\\themes\\smline\\Templates\\search.tpl',
      1 => 1393348373,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2453053f7b4f470a318-15286729',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f7b4f4748b25_62562480',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f7b4f4748b25_62562480')) {function content_53f7b4f4748b25_62562480($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('includes/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<div id="sidebar">
	<?php echo $_smarty_tpl->getSubTemplate ('i_search/filter.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

</div>

<div id="main-col" style="margin-left:5px;">
	<?php echo $_smarty_tpl->getSubTemplate ('i_search/results.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

</div>

<?php echo $_smarty_tpl->getSubTemplate ('includes/footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
