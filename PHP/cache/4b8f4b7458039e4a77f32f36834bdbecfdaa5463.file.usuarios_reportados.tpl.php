<?php /* Smarty version Smarty-3.1.15, created on 2014-08-23 11:23:40
         compiled from ".\themes\smline\Templates\i_mod\usuarios_reportados.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2987953f8c00c4149e3-27886292%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4b8f4b7458039e4a77f32f36834bdbecfdaa5463' => 
    array (
      0 => '.\\themes\\smline\\Templates\\i_mod\\usuarios_reportados.tpl',
      1 => 1397699374,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2987953f8c00c4149e3-27886292',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'usuarios_reportados' => 0,
    'u' => 0,
    'web' => 0,
    'user' => 0,
    'qu' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f8c00c4e7910_84128375',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f8c00c4e7910_84128375')) {function content_53f8c00c4e7910_84128375($_smarty_tpl) {?>		<h2>Usuarios reportados</h2>

		<p>No suspendas a un usuario sin una causa razonable, si no tu podr&iacute;as hacerle compa&ntilde;ia.</p>
		
		<br />
		
		<table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="100%">
			<thead>
				<tr>
					<th>Usuario</th>
					<th>Reportado por</th>
					<th>Raz&oacute;n</th>
					<th>Fecha</th>
					<th>Estado</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php  $_smarty_tpl->tpl_vars['u'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['u']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['usuarios_reportados']->value['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['u']->key => $_smarty_tpl->tpl_vars['u']->value) {
$_smarty_tpl->tpl_vars['u']->_loop = true;
?>
				<tr id="report-<?php echo $_smarty_tpl->tpl_vars['u']->value['r_id'];?>
">
					<td>
						<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/<?php echo $_smarty_tpl->tpl_vars['u']->value['u_nick'];?>
"><?php echo $_smarty_tpl->tpl_vars['u']->value['u_nick'];?>
</a>
					</td>
					<td>
						<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/<?php echo $_smarty_tpl->tpl_vars['user']->value->get_nick($_smarty_tpl->tpl_vars['u']->value['r_user']);?>
"><?php echo $_smarty_tpl->tpl_vars['user']->value->get_nick($_smarty_tpl->tpl_vars['u']->value['r_user']);?>
</a>
					</td>
					<td>
						<?php echo $_smarty_tpl->tpl_vars['u']->value['r_reason'];?>

					</td>
					<td><?php echo hace($_smarty_tpl->tpl_vars['u']->value['r_date']);?>
</td>
					<td id="not-status">
						<?php if ($_smarty_tpl->tpl_vars['u']->value['u_status']==3) {?><span class="color-red">Suspendido</span>
						<?php } elseif ($_smarty_tpl->tpl_vars['u']->value['u_status']==1) {?><span class="color-green">Activo</span>
						<?php } elseif ($_smarty_tpl->tpl_vars['u']->value['u_status']==2) {?><span class="color-indigo">Inactivo</span>
						<?php }?>
					</td>
					<td class="admin_actions">
						<?php if ($_smarty_tpl->tpl_vars['u']->value['u_status']==3) {?>
						<a class="stip" title="Reactivar usuario" onclick="mod.unbanned(<?php echo $_smarty_tpl->tpl_vars['u']->value['u_id'];?>
, '<?php echo $_smarty_tpl->tpl_vars['u']->value['u_nick'];?>
');"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/power_on.png"></a>
						<?php } else { ?>
						<a class="stip" title="Suspender usuario" onclick="mod.banned(<?php echo $_smarty_tpl->tpl_vars['u']->value['u_id'];?>
);"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/power_off.png"></a>
						<?php }?>
						<a class="stip" title="Borrar reporte" onclick="mod.reports.del(<?php echo $_smarty_tpl->tpl_vars['u']->value['r_id'];?>
);"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/delete_.png"></a>
					</td>
				</tr>
				<?php } ?>
				<?php if (!$_smarty_tpl->tpl_vars['usuarios_reportados']->value['list']) {?><tr><td colspan="6"><div id="error">No hay usuarios reportados</div></td></tr><?php }?>
				<tr>
					<td colspan="6">
						<form action="/mod" class="mod_buscar" name="search_u" method="get">
							<input type="text" class="input_text" name="qu" placeholder="Buscar usuario..." value="<?php echo $_smarty_tpl->tpl_vars['qu']->value;?>
" autocomplete="off">
							<input type="hidden" name="do" value="usuarios_reportados" />
							<a class="button_next" onclick="document.forms.search_u.submit()">Buscar</a>
						</form>
					</td>
				</tr>
			</tbody>
		</table>
		<?php if ($_smarty_tpl->tpl_vars['usuarios_reportados']->value['list']) {?><?php echo $_smarty_tpl->tpl_vars['usuarios_reportados']->value['pages'];?>
<?php }?>
			<?php }} ?>
