<?php /* Smarty version Smarty-3.1.15, created on 2014-08-23 11:23:35
         compiled from ".\themes\smline\Templates\i_mod\left_menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3084053f8c0077efd65-65357546%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f2b91c7347b535fe73f4690bc06e5d94a6a1ea9c' => 
    array (
      0 => '.\\themes\\smline\\Templates\\i_mod\\left_menu.tpl',
      1 => 1397760281,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3084053f8c0077efd65-65357546',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'do' => 0,
    'web' => 0,
    'global_data' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f8c0079208b9_49285636',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f8c0079208b9_49285636')) {function content_53f8c0079208b9_49285636($_smarty_tpl) {?>			
			<div class="left_menu">
				<div class="menu_head">
					Usuarios
				</div>
				<div class="menu_list<?php if ($_smarty_tpl->tpl_vars['do']->value=='usuarios_suspendidos') {?> active<?php }?>">
					<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/mod?do=usuarios_suspendidos">
						Suspendidos
						<span class="count_info"><?php echo $_smarty_tpl->tpl_vars['global_data']->value['usuarios_suspendidos'];?>
</span>
					</a>
				</div>
				<div class="menu_list<?php if ($_smarty_tpl->tpl_vars['do']->value=='usuarios_reportados') {?> active<?php }?>">
					<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/mod?do=usuarios_reportados">
						Reportados
						<span class="count_info"><?php echo $_smarty_tpl->tpl_vars['global_data']->value['usuarios_reportados'];?>
</span>
					</a>
				</div>
			</div>
			
			<div class="form_separador"></div>
			
			<div class="left_menu">
				<div class="menu_head">
					Posts
				</div>
				<div class="menu_list<?php if ($_smarty_tpl->tpl_vars['do']->value=='posts_aprobar') {?> active<?php }?>">
					<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/mod?do=posts_aprobar">
						Esperando aprobaci&oacute;n
						<span class="count_info"><?php echo $_smarty_tpl->tpl_vars['global_data']->value['posts_aprobar'];?>
</span>
					</a>
				</div>
				<div class="menu_list<?php if ($_smarty_tpl->tpl_vars['do']->value=='posts_eliminados') {?> active<?php }?>">
					<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/mod?do=posts_eliminados">
						Eliminados
						<span class="count_info"><?php echo $_smarty_tpl->tpl_vars['global_data']->value['posts_eliminados'];?>
</span>
					</a>
				</div>
				<div class="menu_list<?php if ($_smarty_tpl->tpl_vars['do']->value=='posts_reportados') {?> active<?php }?>">
					<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/mod?do=posts_reportados">
						Reportados
						<span class="count_info"><?php echo $_smarty_tpl->tpl_vars['global_data']->value['posts_reportados'];?>
</span>
					</a>
				</div>
			</div>
			
			<div class="form_separador"></div>
			
			<div class="left_menu">
				<div class="menu_head">
					Im&aacute;genes
				</div>
				<div class="menu_list<?php if ($_smarty_tpl->tpl_vars['do']->value=='imagenes_eliminadas') {?> active<?php }?>">
					<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/mod?do=imagenes_eliminadas">
						Eliminadas
						<span class="count_info"><?php echo $_smarty_tpl->tpl_vars['global_data']->value['imagenes_eliminadas'];?>
</span>
					</a>
				</div>
				<div class="menu_list<?php if ($_smarty_tpl->tpl_vars['do']->value=='imagenes_reportadas') {?> active<?php }?>">
					<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/mod?do=imagenes_reportadas">
						Reportadas
						<span class="count_info"><?php echo $_smarty_tpl->tpl_vars['global_data']->value['imagenes_reportadas'];?>
</span>
					</a>
				</div>
			</div>
			
			<div class="form_separador"></div>
			
			<div class="left_menu">
				<div class="menu_head">
					Comunidades
				</div>
				<div class="menu_list<?php if ($_smarty_tpl->tpl_vars['do']->value=='comus_suspendidas') {?> active<?php }?>">
					<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/mod?do=comus_suspendidas">
						Suspendidas
						<span class="count_info"><?php echo $_smarty_tpl->tpl_vars['global_data']->value['comus_suspendidas'];?>
</span>
					</a>
				</div>
				<div class="menu_list<?php if ($_smarty_tpl->tpl_vars['do']->value=='comus_reportadas') {?> active<?php }?>">
					<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/mod?do=comus_reportadas">
						Reportadas
						<span class="count_info"><?php echo $_smarty_tpl->tpl_vars['global_data']->value['comus_reportadas'];?>
</span>
					</a>
				</div>
			</div>
			
			<div class="form_separador"></div>
			
			<div class="left_menu">
				<div class="menu_head">
					Temas
				</div>
				<div class="menu_list<?php if ($_smarty_tpl->tpl_vars['do']->value=='temas_eliminados') {?> active<?php }?>">
					<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/mod?do=temas_eliminados">
						Eliminados
						<span class="count_info"><?php echo $_smarty_tpl->tpl_vars['global_data']->value['temas_eliminados'];?>
</span>
					</a>
				</div>
				<div class="menu_list<?php if ($_smarty_tpl->tpl_vars['do']->value=='temas_reportados') {?> active<?php }?>">
					<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/mod?do=temas_reportados">
						Reportados
						<span class="count_info"><?php echo $_smarty_tpl->tpl_vars['global_data']->value['temas_reportados'];?>
</span>
					</a>
				</div>
			</div>
			
			<div class="form_separador"></div>
			
			<div class="left_menu">
				<div class="menu_head">
					Mensajes
				</div>
				<div class="menu_list">
					<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/mod?do=mensajes_reportados">
						Reportados
						<span class="count_info"><?php echo $_smarty_tpl->tpl_vars['global_data']->value['mensajes_reportados'];?>
</span>
					</a>
				</div>
			</div>
			
			<div class="form_separador"></div><?php }} ?>
