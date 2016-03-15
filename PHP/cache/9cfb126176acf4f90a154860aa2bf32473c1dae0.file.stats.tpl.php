<?php /* Smarty version Smarty-3.1.15, created on 2014-08-22 15:59:58
         compiled from ".\themes\smline\Templates\i_home\stats.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1685853f7af4e788595-40626039%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9cfb126176acf4f90a154860aa2bf32473c1dae0' => 
    array (
      0 => '.\\themes\\smline\\Templates\\i_home\\stats.tpl',
      1 => 1397172975,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1685853f7af4e788595-40626039',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'stats' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f7af4e797f96_91536610',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f7af4e797f96_91536610')) {function content_53f7af4e797f96_91536610($_smarty_tpl) {?><div class="box">
	<div class="box_title">Estadísticas</div>
	<div class="box_body">
		<div class="box_content clearfix">
			<ul class="estadisticas floatL">
				<li><b><?php echo $_smarty_tpl->tpl_vars['stats']->value['online'];?>
</b> Usuarios Online</li>
				<li><b><?php echo $_smarty_tpl->tpl_vars['stats']->value['members'];?>
</b> Miembros</li>
			</ul>
			<ul class="estadisticas floatR">
				<li><b><?php echo $_smarty_tpl->tpl_vars['stats']->value['posts'];?>
</b> Posts</li>
				<li><b><?php echo $_smarty_tpl->tpl_vars['stats']->value['comments'];?>
</b> Comentarios</li>
			</ul>
		</div>
		
	</div>
</div><?php }} ?>
