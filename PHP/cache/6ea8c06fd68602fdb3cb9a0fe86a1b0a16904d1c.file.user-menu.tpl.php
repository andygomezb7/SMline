<?php /* Smarty version Smarty-3.1.15, created on 2014-08-22 16:12:26
         compiled from ".\themes\smline\Templates\includes\user-menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:152953f7b23a10b402-39103010%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6ea8c06fd68602fdb3cb9a0fe86a1b0a16904d1c' => 
    array (
      0 => '.\\themes\\smline\\Templates\\includes\\user-menu.tpl',
      1 => 1399235113,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '152953f7b23a10b402-39103010',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'user' => 0,
    'web' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f7b23a188419_45258211',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f7b23a188419_45258211')) {function content_53f7b23a188419_45258211($_smarty_tpl) {?><div class="floatR user_menu">
	<li>
		<a onclick="notifica.last($(this));" class="notis" title="Notificaciones">
			<span id="total_notis"<?php if ($_smarty_tpl->tpl_vars['user']->value->notis==0) {?> style="display:none;"<?php }?>><?php echo $_smarty_tpl->tpl_vars['user']->value->notis;?>
</span>
		</a>
		<div class="modal-dialog" id="dialog-notifications" style="display:none">
			<div class="modal-wrapper">
				<h3>Notificaciones</h3>
				<div class="list" id="notifications-list">
				</div>
				<a class="view-more" href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/monitor">Ver todas</a>
			</div>
		</div>
		
	</li>
	
	<li>
		<a onclick="mensaje.last($(this));" class="mps" title="Mensajes">
			<span id="total_mps"<?php if ($_smarty_tpl->tpl_vars['user']->value->mps==0) {?> style="display:none;"<?php }?>><?php echo $_smarty_tpl->tpl_vars['user']->value->mps;?>
</span>
		</a>
		<div class="modal-dialog" id="dialog-mps" style="display:none">
			<div class="modal-wrapper">
				<h3>Mensajes</h3>
				<div class="list" id="mps-list">
				</div>
				<a class="view-more" href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/mensajes">Ver todos</a>
			</div>
		</div>
	</li>
	<li>
		<a onclick="user.show_menu();" class="a-umenu">
			<?php echo $_smarty_tpl->tpl_vars['user']->value->nick;?>

			<span id="user_link_dd"></span>
		</a>
		<div class="modal-dialog" id="dialog-umenu" style="display:none">
			<div class="modal-wrapper">
				<div class="floatL">
					<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/<?php echo $_smarty_tpl->tpl_vars['user']->value->nick;?>
" title="Ir a mi perfil">
						<img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['avatar'];?>
/<?php echo $_smarty_tpl->tpl_vars['user']->value->uid;?>
_50.jpg?<?php echo $_smarty_tpl->tpl_vars['user']->value->info['u_last_avatar'];?>
" alt="Avatar" class="avatar-2"/>
					</a>
				</div>
				<div class="umenu-options">
					<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/<?php echo $_smarty_tpl->tpl_vars['user']->value->nick;?>
" title="Tu perfil">
						Ver mi perfil
					</a>
					<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/cuenta" title="Tu cuenta">
						Editar mi cuenta
					</a>
					<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/favoritos" title="Tus favoritos">
						Ver mis favoritos
					</a>
					<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/borradores" title="Tus borradores">
						Ver mis borradores
					</a>
				</div>
			</div>
		</div>
	</li>
	<li>
		<a onclick="user.cerrar($(this));" class="cerrar" title="Cerrar sesi&oacute;n"></a>
	</li>
</div><?php }} ?>
