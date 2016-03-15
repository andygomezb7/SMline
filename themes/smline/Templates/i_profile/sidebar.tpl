<div class="profile_sidebar clearfix">
	<div class="box box_autor">
		<div class="box_title">Estadísticas</div>
		<div class="box_body clearfix no-padding">
			<ul class="list_stats">
				<li class="list_stat left bottom">
					<span class="list_count">{$u_info.u_images}</span>
					<span class="list_name">Imágenes</span>
				</li>
				<li class="list_stat left bottom">
					<span class="list_count">{$u_info.u_follows}</span>
					<span class="list_name">Seguidores</span>
				</li>
				<li class="list_stat left">
					<span class="list_count">{$u_info.u_topics}</span>
					<span class="list_name">Temas</span>
				</li>
			</ul>
			<ul class="list_stats">
				<li class="list_stat bottom">
					<span class="list_count">{$u_info.u_posts}</span>
					<span class="list_name">Posts</span>
				</li>
				<li class="list_stat bottom">
					<span class="list_count" id="autor-total-puntos">{$u_info.u_points}</span>
					<span class="list_name">Puntos</span>
				</li>
				<li class="list_stat">
					<span class="list_count">{$u_info.u_comments}</span>
					<span class="list_name">Comentarios</span>
				</li>
			</ul>
		</div>
	</div>
	
	{include file='i_profile/side_medals.tpl'}
	
	{include file='i_profile/side_followers.tpl'}	
</div>