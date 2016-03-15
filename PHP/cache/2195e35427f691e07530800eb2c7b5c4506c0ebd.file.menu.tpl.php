<?php /* Smarty version Smarty-3.1.15, created on 2014-08-22 15:59:58
         compiled from ".\themes\smline\Templates\includes\menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:174253f7af4e4f80f8-69104225%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2195e35427f691e07530800eb2c7b5c4506c0ebd' => 
    array (
      0 => '.\\themes\\smline\\Templates\\includes\\menu.tpl',
      1 => 1398467790,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '174253f7af4e4f80f8-69104225',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'web' => 0,
    'user' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f7af4e52ec01_09050778',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f7af4e52ec01_09050778')) {function content_53f7af4e52ec01_09050778($_smarty_tpl) {?>		<div id="menu_1">
			<div id="wrapper">
				<div class="floatL">
					<li>
						<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/" title="Ir a la p&aacute;gina principal">Posts</a>
					</li>
					<li>
						<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/comunidades" title="Ir a las comunidades">Comunidades</a>
					</li>
					<li>
						<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/imagenes" title="Ir a las im&aacute;genes">Im&aacute;genes</a>
					</li>
					<li>
						<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/tops" title="Ir al ranking">Tops</a>
					</li>
					<?php if ($_smarty_tpl->tpl_vars['user']->value->permits['gomod']) {?><li>
						<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/mod" title="Ir a la sala de moderaci&oacute;n">Moderaci&oacute;n</a>
					</li><?php }?>
					<?php if ($_smarty_tpl->tpl_vars['user']->value->permits['goadmin']) {?><li>
						<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/admin" title="Ir a la sala de administraci&oacute;n">Admin</a>
					</li><?php }?>
				</div>
				<?php if (!$_smarty_tpl->tpl_vars['user']->value->uid) {?>
				<div class="floatR user_menu">
					<li><a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/registro" title="Reg&iacute;strate, es gratis">Crear cuenta</a></li>
					<li>
						<a onclick="anonimo.show_login();" class="a-login" title="Entrar a mi cuenta">Acceder</a>
						
						<div class="modal-dialog" id="dialog-login" style="display:none">
							<div class="modal-wrapper">
								<h3 class="clearfix">
									Ingresa tus datos
									<a onclick="anonimo.show_login();" title="Cerrar login" class="floatR">
										<i class="modal-close"></i>
									</a>
								</h3>
								<div id="login">
									<div id="error" style="display:none;"></div>
									<ul>
										<li class="list_item">
											<label for="il_nick">Nick o email:</label>
											<input type="text" tabindex="1" id="il_nick" class="inp_text" name="rl_nick" maxlength="40" value="" autocomplete="off">
										</li>
										<li class="list_item">
											<label for="il_pass">Contrase&ntilde;a:</label>
											<input type="password" tabindex="2" id="il_pass" class="inp_text" name="rl_pass" maxlength="40" value="" autocomplete="off">
										</li>
									</ul>
									<hr>
									<center><input class="loguearme" style="color:#fff !important;" type="submit" onclick="anonimo.login();" name="regSubmit" value="Identificarme" role="button" aria-disabled="false"></center>
									<hr />
									<center>
									<p>
										<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/recover" title="&iquest;No puedes ingresar a tu cuenta?">No puedo ingresar a mi cuenta</a>
										<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/registro" title="&iquest;No tienes cuenta?">No tengo cuenta</a>
									</p>
									</center>
									</div>	
								</div>
							</div>
						</div>
						
					</li>
				</div>
				<?php } else { ?>
				<?php echo $_smarty_tpl->getSubTemplate ('includes/user-menu.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

				<?php }?>
			</div>
		</div><?php }} ?>
