		<div id="menu_1">
			<div id="wrapper">
				<div class="floatL">
					<li>
						<a href="{$web.url}/" title="Ir a la p&aacute;gina principal">Posts</a>
					</li>
					<li>
						<a href="{$web.url}/comunidades" title="Ir a las comunidades">Comunidades</a>
					</li>
					<li>
						<a href="{$web.url}/imagenes" title="Ir a las im&aacute;genes">Im&aacute;genes</a>
					</li>
					<li>
						<a href="{$web.url}/tops" title="Ir al ranking">Tops</a>
					</li>
					{if $user->permits['gomod']}<li>
						<a href="{$web.url}/mod" title="Ir a la sala de moderaci&oacute;n">Moderaci&oacute;n</a>
					</li>{/if}
					{if $user->permits['goadmin']}<li>
						<a href="{$web.url}/admin" title="Ir a la sala de administraci&oacute;n">Admin</a>
					</li>{/if}
				</div>
				{if !$user->uid}
				<div class="floatR user_menu">
					<li><a href="{$web.url}/registro" title="Reg&iacute;strate, es gratis">Crear cuenta</a></li>
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
										<a href="{$web.url}/recover" title="&iquest;No puedes ingresar a tu cuenta?">No puedo ingresar a mi cuenta</a>
										<a href="{$web.url}/registro" title="&iquest;No tienes cuenta?">No tengo cuenta</a>
									</p>
									</center>
									</div>	
								</div>
							</div>
						</div>
						
					</li>
				</div>
				{else}
				{include file='includes/user-menu.tpl'}
				{/if}
			</div>
		</div>