<?php /* Smarty version Smarty-3.1.15, created on 2014-08-22 16:25:34
         compiled from ".\themes\smline\Templates\profile.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2398153f7b54ea3b391-84561415%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3ebfc89bf31a43679f75b4ba5844a639d5094c3a' => 
    array (
      0 => '.\\themes\\smline\\Templates\\profile.tpl',
      1 => 1388510486,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2398153f7b54ea3b391-84561415',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'web' => 0,
    'u_info' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f7b54ea818a6_75080582',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f7b54ea818a6_75080582')) {function content_53f7b54ea818a6_75080582($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('includes/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<script src="<?php echo $_smarty_tpl->tpl_vars['web']->value['js'];?>
/jquery.autosize.min.js" type="text/javascript"></script>
<link href="<?php echo $_smarty_tpl->tpl_vars['web']->value['css'];?>
/images.css" rel="stylesheet" type="text/css">
<input type="hidden" name="to_user" value="<?php echo $_smarty_tpl->tpl_vars['u_info']->value['u_id'];?>
" />
<div class="profile-content clearfix">
<?php echo $_smarty_tpl->getSubTemplate ('i_profile/left.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ('i_profile/main.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ('i_profile/sidebar.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

</div>

<?php echo $_smarty_tpl->getSubTemplate ('includes/footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
