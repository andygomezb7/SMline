1: 
<div class="box_title">
	Sobre {$u_info.u_nick}
</div>
<div class="profile_status clearfix info_listest">
	<ul>
	
		<li class="info-list">
			<label>Rango</label>
			<strong style="color:#{$u_info.r_color}">{$u_info.r_name}</strong>
		</li>
		{if $u_info.u_names || $u_info.u_surnames}
		<li class="info-list">
			<label>Nombre</label>
			<strong>{$u_info.u_names} {$u_info.u_surnames}</strong>
		</li>
		{/if}
		{if $u_info.u_bio}
		<li class="info-list">
			<label>Mensaje personal</label>
			<strong>{$u_info.u_bio}</strong>
		</li>
		{/if}
		<li class="info-list">
			<label>Pais</label>
			<strong>{$u_info.u_country_name}</strong>
		</li>
		<li class="info-list">
			<label>Se registró</label>
			<strong>{$u_info.u_register.0} de {$u_info.u_register.1} de {$u_info.u_register.2}</strong>
		</li>
		<li class="info-list">
			<label>Última vez activo</label>
			<strong>{$u_info.last_active}</strong>
		</li>
		{if $u_info.u_site}
		<li class="info-list">
			<label>Sitio web</label>
			<strong><a href="{$u_info.u_site}" target="_blank">{$u_info.u_site}</a></strong>
		</li>
		{/if}
	</ul>
</div>