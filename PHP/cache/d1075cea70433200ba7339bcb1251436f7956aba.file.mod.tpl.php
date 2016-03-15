<?php /* Smarty version Smarty-3.1.15, created on 2014-08-23 11:23:35
         compiled from ".\themes\smline\Templates\mod.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2197953f8c007592550-02084848%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd1075cea70433200ba7339bcb1251436f7956aba' => 
    array (
      0 => '.\\themes\\smline\\Templates\\mod.tpl',
      1 => 1397764039,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2197953f8c007592550-02084848',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'do' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f8c0077383c4_12708931',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f8c0077383c4_12708931')) {function content_53f8c0077383c4_12708931($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('i_admin/admin_header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<div class="mod_content">

	<div class="left_menu">
		<?php echo $_smarty_tpl->getSubTemplate ('i_mod/left_menu.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	</div>

	<div class="mod_main">
		<?php if ($_smarty_tpl->tpl_vars['do']->value=='usuarios_suspendidos') {?><?php echo $_smarty_tpl->getSubTemplate ('i_mod/usuarios_suspendidos.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		<?php } elseif ($_smarty_tpl->tpl_vars['do']->value=='usuarios_reportados') {?><?php echo $_smarty_tpl->getSubTemplate ('i_mod/usuarios_reportados.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		<?php } elseif ($_smarty_tpl->tpl_vars['do']->value=='posts_aprobar') {?><?php echo $_smarty_tpl->getSubTemplate ('i_mod/posts_aprobar.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		<?php } elseif ($_smarty_tpl->tpl_vars['do']->value=='posts_eliminados') {?><?php echo $_smarty_tpl->getSubTemplate ('i_mod/posts_eliminados.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		<?php } elseif ($_smarty_tpl->tpl_vars['do']->value=='posts_reportados') {?><?php echo $_smarty_tpl->getSubTemplate ('i_mod/posts_reportados.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		<?php } elseif ($_smarty_tpl->tpl_vars['do']->value=='imagenes_eliminadas') {?><?php echo $_smarty_tpl->getSubTemplate ('i_mod/imagenes_eliminadas.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		<?php } elseif ($_smarty_tpl->tpl_vars['do']->value=='imagenes_reportadas') {?><?php echo $_smarty_tpl->getSubTemplate ('i_mod/imagenes_reportadas.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		<?php } elseif ($_smarty_tpl->tpl_vars['do']->value=='comus_suspendidas') {?><?php echo $_smarty_tpl->getSubTemplate ('i_mod/comus_suspendidas.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		<?php } elseif ($_smarty_tpl->tpl_vars['do']->value=='comus_reportadas') {?><?php echo $_smarty_tpl->getSubTemplate ('i_mod/comus_reportadas.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		<?php } elseif ($_smarty_tpl->tpl_vars['do']->value=='temas_eliminados') {?><?php echo $_smarty_tpl->getSubTemplate ('i_mod/temas_eliminados.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		<?php } elseif ($_smarty_tpl->tpl_vars['do']->value=='temas_reportados') {?><?php echo $_smarty_tpl->getSubTemplate ('i_mod/temas_reportados.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		<?php } elseif ($_smarty_tpl->tpl_vars['do']->value=='mensajes_reportados') {?><?php echo $_smarty_tpl->getSubTemplate ('i_mod/mensajes_reportados.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		<?php } else { ?><?php echo $_smarty_tpl->getSubTemplate ('i_mod/main_home.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }?>
	</div>

</div>




</div>
<div class="notification-board right bottom"></div>
</body>
</html><?php }} ?>
