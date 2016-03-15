<div class="floatR user_menu">
	<li>
		<a onclick="notifica.last($(this));" class="notis" title="Notificaciones">
			<span id="total_notis"{if $user->notis == 0} style="display:none;"{/if}>{$user->notis}</span>
		</a>
		<div class="modal-dialog" id="dialog-notifications" style="display:none">
			<div class="modal-wrapper">
				<h3>Notificaciones</h3>
				<div class="list" id="notifications-list">
				</div>
				<a class="view-more" href="{$web.url}/monitor">Ver todas</a>
			</div>
		</div>
		
	</li>
	
	<li>
		<a onclick="mensaje.last($(this));" class="mps" title="Mensajes">
			<span id="total_mps"{if $user->mps == 0} style="display:none;"{/if}>{$user->mps}</span>
		</a>
		<div class="modal-dialog" id="dialog-mps" style="display:none">
			<div class="modal-wrapper">
				<h3>Mensajes</h3>
				<div class="list" id="mps-list">
				</div>
				<a class="view-more" href="{$web.url}/mensajes">Ver todos</a>
			</div>
		</div>
	</li>
	<li>
		<a onclick="user.show_menu();" class="a-umenu">
			{$user->nick}
			<span id="user_link_dd"></span>
		</a>
		<div class="modal-dialog" id="dialog-umenu" style="display:none">
			<div class="modal-wrapper">
				<div class="floatL">
					<a href="{$web.url}/{$user->nick}" title="Ir a mi perfil">
						<img src="{$web.avatar}/{$user->uid}_50.jpg?{$user->info.u_last_avatar}" alt="Avatar" class="avatar-2"/>
					</a>
				</div>
				<div class="umenu-options">
					<a href="{$web.url}/{$user->nick}" title="Tu perfil">
						Ver mi perfil
					</a>
					<a href="{$web.url}/cuenta" title="Tu cuenta">
						Editar mi cuenta
					</a>
					<a href="{$web.url}/favoritos" title="Tus favoritos">
						Ver mis favoritos
					</a>
					<a href="{$web.url}/borradores" title="Tus borradores">
						Ver mis borradores
					</a>
				</div>
			</div>
		</div>
	</li>
	<li>
		<a onclick="user.cerrar($(this));" class="cerrar" title="Cerrar sesi&oacute;n"></a>
	</li>
</div>