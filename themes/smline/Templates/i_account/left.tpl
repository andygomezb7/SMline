<div class="vertical_tabbed_tabs" id="profile_tabs">
	<p class="short photo_holder">
		<a class="button_1 edit-avatar" onclick="account.change_avatar();"><img src="{$web.icons}/edit.png" /> Cambiar</a>
		<img class="profile_avatar" id="profile_photo" src="{$web.url}/avatar/{$u_info.u_id}_120.jpg?{$user->info.u_last_avatar}" alt="Mi avatar">
		<div class="img-positions">
			<input type="hidden" name="thumb_x1" value="0" />
			<input type="hidden" name="thumb_y1" value="0" />
			<input type="hidden" name="thumb_x2" value="120" />
			<input type="hidden" name="thumb_y2" value="120" />
			<input type="hidden" name="thumb_w" value="120" />
			<input type="hidden" name="thumb_h" value="120" />
			<input type="hidden" name="img_url" value="" />
		</div>
	</p>
	<ul class="tabs_links">
		<li class="tab_link_core tab_my-general active">
			<a onclick="account.load_tab('my-general')" href="#general" class="a-general">General</a>
		</li>
		<li class="tab_link_core tab_my-profile">
			<a onclick="account.load_tab('my-profile')" href="#perfil" class="a-perfil">Perfil</a>
		</li>
		<li class="tab_link_core tab_my-options">
			<a onclick="account.load_tab('my-options')" href="#opciones" class="a-opciones">Opciones</a>
		</li>
		<li class="tab_link_core tab_my-notifications">
			<a onclick="account.load_tab('my-notifications')" href="#notificaciones" class="a-notificaciones">Notificaciones</a>
		</li>
		<li class="tab_link_core tab_my-blocked">
			<a onclick="account.load_tab('my-blocked')" href="#bloqueos" class="a-bloqueados">Bloqueados</a>
		</li>
		<li class="tab_link_core tab_change-password">
			<a onclick="account.load_tab('change-password')" href="#cambiar-clave" class="a-cambiar-clave">Cambiar clave</a>
		</li>
	</ul>
</div>