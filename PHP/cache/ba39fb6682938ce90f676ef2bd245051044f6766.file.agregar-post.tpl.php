<?php /* Smarty version Smarty-3.1.15, created on 2014-08-22 16:17:12
         compiled from ".\themes\smline\Templates\agregar-post.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2424253f7b358439322-13668891%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ba39fb6682938ce90f676ef2bd245051044f6766' => 
    array (
      0 => '.\\themes\\smline\\Templates\\agregar-post.tpl',
      1 => 1399078860,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2424253f7b358439322-13668891',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'web' => 0,
    'cats_list' => 0,
    'c' => 0,
    'user' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f7b3584b24c6_47076542',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f7b3584b24c6_47076542')) {function content_53f7b3584b24c6_47076542($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('includes/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

/jquery.imgareaselect.js" type="text/javascript"></script>
/img_area_select/imgareaselect.css" rel="stylesheet" type="text/css">
/icons/reboot.png" width="12px" height="12px" /></a></label>
 $_from = $_smarty_tpl->tpl_vars['cats_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value) {
$_smarty_tpl->tpl_vars['c']->_loop = true;
?>
"><?php echo $_smarty_tpl->tpl_vars['c']->value['c_name'];?>
</option>
<?php }} ?>