<div class="vertical_tabbed_tabs" id="profile_tabs">
	<p class="short photo_holder">
		<img class="profile_avatar" id="profile_photo" src="{$web.url}/avatar/{$u_info.u_id}_120.jpg?{$u_info.u_last_avatar}" alt="Foto de {$u_info.u_nick}">
	</p>
	<ul class="tabs_links">
		<li class="tab_link_core tab_states active">
			<a onclick="profile.load_tab('states');" href="#estados" class="a-estados">Estados</a>
		</li>
		<li class="tab_link_core tab_info">
			<a onclick="profile.load_tab('info');" href="#informacion" class="a-informacion">Información</a>
		</li>
		<li class="tab_link_core tab_activity">
			<a onclick="profile.load_tab('activity');" href="#actividad" class="a-actividad">Actividad</a>
		</li>
		<li class="tab_link_core tab_posts">
			<a onclick="profile.load_tab('posts');" href="#posts" class="a-posts">Posts</a>
		</li>
		<li class="tab_link_core tab_topics">
			<a onclick="profile.load_tab('topics');" href="#temas" class="a-temas">Temas</a>
		</li>
		<li class="tab_link_core tab_images">
			<a onclick="profile.load_tab('images');" href="#imagenes" class="a-imagenes">Imágenes</a>
		</li>
		<li class="tab_link_core tab_follows">
			<a onclick="profile.load_tab('follows');" href="#seguidores" class="a-seguidores">Seguidores</a>
		</li>
		<li class="tab_link_core tab_following">
			<a onclick="profile.load_tab('following');" href="#siguiendo" class="a-siguiendo">Siguiendo</a>
		</li>
		<li class="tab_link_core tab_comus">
			<a onclick="profile.load_tab('comus');" href="#comunidades" class="a-comunidades">Comunidades</a>
		</li>
		<li class="tab_link_core tab_medals">
			<a onclick="profile.load_tab('medals');" href="#medallas" class="a-medallas">Medallas</a>
		</li>
	</ul>
</div>