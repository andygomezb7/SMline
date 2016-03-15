<?php /* Smarty version Smarty-3.1.15, created on 2014-08-23 11:24:18
         compiled from ".\themes\smline\Templates\i_images\stats.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1873953f8c032e08512-20261246%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'efd733237d804933bafdf3e5e039fe86c18070f6' => 
    array (
      0 => '.\\themes\\smline\\Templates\\i_images\\stats.tpl',
      1 => 1397173052,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1873953f8c032e08512-20261246',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'stats' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f8c032e2b796_12542423',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f8c032e2b796_12542423')) {function content_53f8c032e2b796_12542423($_smarty_tpl) {?><div class="box">	<div class="box_title">Estadísticas</div>	<div class="box_body">		<div class="box_content clearfix">			<ul class="estadisticas floatL">				<li><b><?php echo $_smarty_tpl->tpl_vars['stats']->value['online'];?>
</b> Usuarios Online</li>				<li><b><?php echo $_smarty_tpl->tpl_vars['stats']->value['members'];?>
</b> Miembros</li>			</ul>			<ul class="estadisticas floatR">				<li><b><?php echo $_smarty_tpl->tpl_vars['stats']->value['images'];?>
</b> Imágenes</li>				<li><b><?php echo $_smarty_tpl->tpl_vars['stats']->value['images_comments'];?>
</b> Comentarios</li>			</ul>		</div>			</div></div><?php }} ?>
