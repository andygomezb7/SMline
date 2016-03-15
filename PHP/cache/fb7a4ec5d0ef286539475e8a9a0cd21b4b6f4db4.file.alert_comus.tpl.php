<?php /* Smarty version Smarty-3.1.15, created on 2014-08-23 11:24:17
         compiled from ".\themes\smline\Templates\i_communities\home\alert_comus.tpl" */ ?>
<?php /*%%SmartyHeaderCode:158553f8c031be9171-24415643%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fb7a4ec5d0ef286539475e8a9a0cd21b4b6f4db4' => 
    array (
      0 => '.\\themes\\smline\\Templates\\i_communities\\home\\alert_comus.tpl',
      1 => 1391968028,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '158553f8c031be9171-24415643',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'web' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f8c031c4ac18_00480592',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f8c031c4ac18_00480592')) {function content_53f8c031c4ac18_00480592($_smarty_tpl) {?><div class="box">	<div class="box_title">Crea tu comunidad</div>	<div class="box_body">		<div id="error" class="home_new"><b><?php echo $_smarty_tpl->tpl_vars['web']->value['title'];?>
</b> te permite crear tu propia comunidad  para que puedas compartir gustos e intereses con los demás.</div>		<center><a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/comunidades/crear" class="button margin-top-5">&iexcl;Crea la tuya!</a></center>	</div></div><?php }} ?>
