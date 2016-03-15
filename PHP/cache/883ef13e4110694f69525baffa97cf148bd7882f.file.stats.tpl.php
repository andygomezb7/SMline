<?php /* Smarty version Smarty-3.1.15, created on 2014-08-23 11:24:17
         compiled from ".\themes\smline\Templates\i_communities\home\stats.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2552553f8c0319703e6-46253878%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '883ef13e4110694f69525baffa97cf148bd7882f' => 
    array (
      0 => '.\\themes\\smline\\Templates\\i_communities\\home\\stats.tpl',
      1 => 1397173061,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2552553f8c0319703e6-46253878',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'stats' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f8c03198f7f7_07074359',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f8c03198f7f7_07074359')) {function content_53f8c03198f7f7_07074359($_smarty_tpl) {?><div class="box">
	<div class="box_title">Estadísticas</div>
	<div class="box_body">
		<div class="box_content clearfix">
			<ul class="estadisticas floatL">
				<li><b><?php echo $_smarty_tpl->tpl_vars['stats']->value['online'];?>
</b> Usuarios Online</li>
				<li><b><?php echo $_smarty_tpl->tpl_vars['stats']->value['topics'];?>
</b> Temas</li>
			</ul>
			<ul class="estadisticas floatR">
				<li><b><?php echo $_smarty_tpl->tpl_vars['stats']->value['comus'];?>
</b> Comunidades</li>
				<li><b><?php echo $_smarty_tpl->tpl_vars['stats']->value['replies'];?>
</b> Respuestas</li>
			</ul>
		</div>
		
	</div>
</div><?php }} ?>
