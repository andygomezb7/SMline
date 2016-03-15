<?php /* Smarty version Smarty-3.1.15, created on 2014-08-22 16:35:46
         compiled from ".\themes\smline\Templates\mod-history.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3138153f7b7b2516c21-43451103%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a3577c5b3f06093793772472f8bb6129e68ddc48' => 
    array (
      0 => '.\\themes\\smline\\Templates\\mod-history.tpl',
      1 => 1397154999,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3138153f7b7b2516c21-43451103',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'get_history' => 0,
    'h' => 0,
    'web' => 0,
    'user' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f7b7b25a74c3_56129229',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f7b7b25a74c3_56129229')) {function content_53f7b7b25a74c3_56129229($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('includes/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>



		<table cellpadding="0" cellspacing="0" border="0" class="fav_table" width="100%" align="center">
            <thead>
				<tr>
					<th>Post</th>
					<th>Acción</th>
					<th>Moderador</th>
					<th>Causa</th>
				</tr>
			</thead>
			<tbody>
				<?php  $_smarty_tpl->tpl_vars['h'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['h']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['get_history']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['h']->key => $_smarty_tpl->tpl_vars['h']->value) {
$_smarty_tpl->tpl_vars['h']->_loop = true;
?>
				<tr id="historyid-<?php echo $_smarty_tpl->tpl_vars['h']->value['h_id'];?>
">
					<td><?php echo $_smarty_tpl->tpl_vars['h']->value['p_title'];?>
<br />Por <a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/<?php echo $_smarty_tpl->tpl_vars['user']->value->get_nick($_smarty_tpl->tpl_vars['h']->value['p_user']);?>
"><?php echo $_smarty_tpl->tpl_vars['user']->value->get_nick($_smarty_tpl->tpl_vars['h']->value['p_user']);?>
</a></td>
					<td>
						<?php if ($_smarty_tpl->tpl_vars['h']->value['h_action']==1) {?><span class="color-red">Eliminado</span> 
						<?php } elseif ($_smarty_tpl->tpl_vars['h']->value['h_action']==2) {?><span class="color-green">Reactivado</span>
						<?php } elseif ($_smarty_tpl->tpl_vars['h']->value['h_action']==3) {?><span class="color-gray">Editado</span>
						<?php } elseif ($_smarty_tpl->tpl_vars['h']->value['h_action']==4) {?><span class="color-indigo">A revisión</span>
						<?php } elseif ($_smarty_tpl->tpl_vars['h']->value['h_action']==5) {?><span class="color-coral">Aprobado</span>
						<?php } elseif ($_smarty_tpl->tpl_vars['h']->value['h_action']==6) {?><span class="color-blue">Fijado</span>
						<?php } elseif ($_smarty_tpl->tpl_vars['h']->value['h_action']==7) {?><span class="color-deeppink">Desfijado</span>
						<?php }?>
					</td>
					<td><a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/<?php echo $_smarty_tpl->tpl_vars['h']->value['u_nick'];?>
"><?php echo $_smarty_tpl->tpl_vars['h']->value['u_nick'];?>
</a></td>
					<td><?php echo $_smarty_tpl->tpl_vars['h']->value['h_reason'];?>
</td>
				</tr>
				<?php } ?>
				<?php if (!$_smarty_tpl->tpl_vars['get_history']->value) {?><tr><td colspan="4"><div id="error">No hay acciones</div></td></tr><?php }?>
			</tbody>
		</table>



<?php echo $_smarty_tpl->getSubTemplate ('includes/footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
