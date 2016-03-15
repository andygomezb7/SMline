<?php /* Smarty version Smarty-3.1.15, created on 2014-08-23 11:23:35
         compiled from ".\themes\smline\Templates\i_mod\main_home.tpl" */ ?>
<?php /*%%SmartyHeaderCode:289753f8c00794f6b8-82206568%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7d5adf74cbbc7bf8a45197a3d1f2f1e65e98e9ad' => 
    array (
      0 => '.\\themes\\smline\\Templates\\i_mod\\main_home.tpl',
      1 => 1398212799,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '289753f8c00794f6b8-82206568',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'user' => 0,
    'web' => 0,
    'get_access' => 0,
    'u' => 0,
    'get_mods' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f8c0079a55d7_28187098',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f8c0079a55d7_28187098')) {function content_53f8c0079a55d7_28187098($_smarty_tpl) {?>		<h2>Sala de moderación</h2>
		
		<p>Hola <strong><?php echo $_smarty_tpl->tpl_vars['user']->value->nick;?>
</strong>, bienvenido/a a la sala de moderaci&oacute;n <?php echo $_smarty_tpl->tpl_vars['web']->value['title'];?>
.</p>
		
		<br />
		<br />
		
		<div class="mod_protocol">
			<h3>Protocolo de moderador</h3>
			<ul>
				<li>
					No debe abusar del poder que implica el ser moderador.
				</li>
				<li>
					No debe discriminar a los usuarios por raza, edad, defectos o sexo.
				</li>
				<li>
					No debe hacer uso de un mal vocabulario.
				</li>
				<li>
					Debe respetar las decisiones tomadas por los Administradores.
				</li>
				<li>
					Debe hacer uso de buena ortografía en sus comunicados, mensajes, alertas etc.
				</li>
				<li>
					Debe orientar correctamente a los usuarios con inquietudes o dudas.
				</li>
				<li>
					Debe hacer lo posible porque el <a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/protocolo" target="_blank">protocolo general</a> sea respetado por los usuarios.
				</li>
				<li>
					Debe evitar que <?php echo $_smarty_tpl->tpl_vars['web']->value['title'];?>
 sea blanco fácil de spam, insultos, crap etc.
				</li>
			</ul>
		</div>
		
		<div class="list_tables">		
			
			<table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="250" align="right">
				<thead>
					<tr>
						<th colspan="2">Accesos recientes</th>
					</tr>
				</thead>
				<tbody>
					<?php  $_smarty_tpl->tpl_vars['u'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['u']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['get_access']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['u']->key => $_smarty_tpl->tpl_vars['u']->value) {
$_smarty_tpl->tpl_vars['u']->_loop = true;
?>
					<tr class="Tleft">
						<td>
							<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/<?php echo $_smarty_tpl->tpl_vars['u']->value['u_nick'];?>
"><?php echo $_smarty_tpl->tpl_vars['u']->value['u_nick'];?>
</a> <small>(<a href="http://geoiptool.com/es/?IP=<?php echo $_smarty_tpl->tpl_vars['u']->value['a_ip'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['u']->value['a_ip'];?>
</a>)</small>
						</td>
						<td><?php echo hace($_smarty_tpl->tpl_vars['u']->value['a_date']);?>
</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			
			<table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="250" align="right">
				<thead>
					<tr>
						<th>Equipo de moderaci&oacute;n</th>
					</tr>
				</thead>
				<tbody>
					<?php  $_smarty_tpl->tpl_vars['u'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['u']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['get_mods']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['u']->key => $_smarty_tpl->tpl_vars['u']->value) {
$_smarty_tpl->tpl_vars['u']->_loop = true;
?>
					<tr>
						<td>
							<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/<?php echo $_smarty_tpl->tpl_vars['u']->value['u_nick'];?>
"><?php echo $_smarty_tpl->tpl_vars['u']->value['u_nick'];?>
</a>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			
		</div><?php }} ?>
