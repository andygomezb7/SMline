<?php /* Smarty version Smarty-3.1.15, created on 2014-08-22 16:25:33
         compiled from ".\themes\smline\Templates\t_ajax\user.last_mps.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1275953f7b54d7ed1f7-89993595%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '31724da2473baf3e95f5446824bd09dfae506f21' => 
    array (
      0 => '.\\themes\\smline\\Templates\\t_ajax\\user.last_mps.tpl',
      1 => 1396627633,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1275953f7b54d7ed1f7-89993595',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'mps' => 0,
    'm' => 0,
    'web' => 0,
    'limit' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f7b54d87da97_41877285',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f7b54d87da97_41877285')) {function content_53f7b54d87da97_41877285($_smarty_tpl) {?>1: 
<?php if (count($_smarty_tpl->tpl_vars['mps']->value)==0) {?>
<div class="modal-error">No tienes mensajes nuevos</div>
<?php }?>
<?php  $_smarty_tpl->tpl_vars['m'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['m']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['mps']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['m']->key => $_smarty_tpl->tpl_vars['m']->value) {
$_smarty_tpl->tpl_vars['m']->_loop = true;
?>

<div class="list-element-two msg clearfix<?php if ($_smarty_tpl->tpl_vars['m']->value['rp_read']==0) {?> unread<?php }?>">
	<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/mensajes/leer/<?php echo $_smarty_tpl->tpl_vars['m']->value['mp_id'];?>
#mp-rpta-id-<?php echo $_smarty_tpl->tpl_vars['m']->value['rp_id'];?>
" class="msg-element"></a>
	<a href="/Hainner">
		<img class="avatar-2" src="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/avatar/<?php echo $_smarty_tpl->tpl_vars['m']->value['mp_user'];?>
_32.jpg?<?php echo $_smarty_tpl->tpl_vars['m']->value['u_last_avatar'];?>
">
	</a>
	<div class="info-msg">
		<a class="msg-nick" href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/<?php echo $_smarty_tpl->tpl_vars['m']->value['u_nick'];?>
"><?php echo $_smarty_tpl->tpl_vars['m']->value['u_nick'];?>
</a>
		<br>
		<a class="asunto" style="overflow:hidden" href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/mensajes/leer/<?php echo $_smarty_tpl->tpl_vars['m']->value['mp_id'];?>
#mp-rpta-id-<?php echo $_smarty_tpl->tpl_vars['m']->value['rp_id'];?>
"><?php echo substr($_smarty_tpl->tpl_vars['m']->value['rp_body'],0,30);?>
<?php if (strlen($_smarty_tpl->tpl_vars['m']->value['rp_body'])>30) {?>...<?php }?></a>
	</div>
</div>

<?php } ?>
<?php if (count($_smarty_tpl->tpl_vars['mps']->value)==$_smarty_tpl->tpl_vars['limit']->value) {?>
<a class="load_more" onclick="mensaje.view_more($(this))">Cargar m&aacute;s</a>
<?php }?><?php }} ?>
