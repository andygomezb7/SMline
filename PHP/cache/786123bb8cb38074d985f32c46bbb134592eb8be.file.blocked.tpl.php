<?php /* Smarty version Smarty-3.1.15, created on 2014-08-23 11:24:06
         compiled from ".\themes\smline\Templates\i_admin\blocked.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3114353f8c026e6b347-86697351%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '786123bb8cb38074d985f32c46bbb134592eb8be' => 
    array (
      0 => '.\\themes\\smline\\Templates\\i_admin\\blocked.tpl',
      1 => 1396625734,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3114353f8c026e6b347-86697351',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'action' => 0,
    'status' => 0,
    'web' => 0,
    'get_locks' => 0,
    'l' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f8c027032970_90885955',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f8c027032970_90885955')) {function content_53f8c027032970_90885955($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'C:\\xampp\\htdocs\\PHP\\libs\\plugins\\modifier.date_format.php';
?><?php if ($_smarty_tpl->tpl_vars['action']->value=='') {?>
<div class="box">
	<div class="box_title">Bloqueos</div>
	<div class="box_body clearfix admin-settings">
		<?php if ($_smarty_tpl->tpl_vars['status']->value=='ok_add') {?><span class="item-info ok margin-top-5"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/ok.png">El bloqueo ha sido agregado!</span>
		<hr />
		<?php } else { ?><span class="item-info margin-top-5"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/info.png">Esta herramiente impide el registro de usuarios con filtros en la lista de bloqueos.</span>
		<hr />
		<?php }?>
		
		<table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="780" align="center">
            <thead>
				<tr>
					<th>Bloqueo</th>
					<th>Tipo</th>
					<th>Por</th>
					<th>Fecha</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
				<?php  $_smarty_tpl->tpl_vars['l'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['l']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['get_locks']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['l']->key => $_smarty_tpl->tpl_vars['l']->value) {
$_smarty_tpl->tpl_vars['l']->_loop = true;
?>
				<tr id="l-id-<?php echo $_smarty_tpl->tpl_vars['l']->value['l_id'];?>
">
					<td><?php echo $_smarty_tpl->tpl_vars['l']->value['l_lock'];?>
</td>
					<td><?php if ($_smarty_tpl->tpl_vars['l']->value['l_type']==1) {?>IP<?php } elseif ($_smarty_tpl->tpl_vars['l']->value['l_type']==2) {?>Servidor email<?php } else { ?>Nombre de usuario<?php }?></td>
					<td><a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/<?php echo $_smarty_tpl->tpl_vars['l']->value['u_nick'];?>
"><?php echo $_smarty_tpl->tpl_vars['l']->value['u_nick'];?>
</a></td>
					<td><span class="stip" title="<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['l']->value['l_date'],"%d/%m/%Y %I:%M %p");?>
"><?php echo hace($_smarty_tpl->tpl_vars['l']->value['l_date']);?>
</span></td>
					<td class="admin_actions">
						<a class="stip" title="Eliminar bloqueo" onclick="admin.locks.del(<?php echo $_smarty_tpl->tpl_vars['l']->value['l_id'];?>
);"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/delete_.png"></a>
					</td>
				</tr>
				<?php } ?>
				<?php if (!$_smarty_tpl->tpl_vars['get_locks']->value) {?><tr><td colspan="5"><div id="error">No hay bloqueos hasta el momento</div></td></tr><?php }?>
			</tbody>
		</table>
		
		<hr />
		<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/admin?do=blocked&action=add" class="button_1 b_ok floatR">Agregar bloqueo</a>
		
	</div>
</div>
<?php } elseif ($_smarty_tpl->tpl_vars['action']->value=='add') {?>
<div class="box">
	<div class="box_title">Agregar bloqueo</div>
	<div class="box_body clearfix admin-settings">
		
		<span class="item-info margin-top-5"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/info.png">Esta herramiente impide el registro de usuarios con filtros en la lista de bloqueos.</span>
		<hr />
		
		<ul>
			
			<li class="list_item clearfix">
				<label for="l_type">Tipo de bloqueo:</label>	
				<select id="l_type" style="width:150px;" name="l_type" class="inp_text">
					<option value="1">IP</option>
					<option value="2">Servidor email</option>
					<option value="3">Nombre de usuario</option>
				</select>
			</li>
		
			<li class="list_item clearfix">
				<label for="l_lock">Bloqueo:</label>
				<input type="text" id="l_lock" class="inp_text" name="l_lock" autocomplete="off" style="display:inline-block;">
			</li>

		</ul>
		
		<hr>
		<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/admin?do=blocked" class="button_1 floatL">Volver</a>
		<input type="button" class="button_1 b_ok floatR" value="Continuar" onclick="admin.locks.add();">
		
	</div>
	
</div>
<?php }?><?php }} ?>
