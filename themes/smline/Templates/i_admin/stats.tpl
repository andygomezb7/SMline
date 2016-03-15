{if $action == ''}
<div class="box">
	<div class="box_body clearfix admin-settings">
		
		<div class="box_title">Usuarios</div>
		
		<table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="100%" align="center">
            <thead>
				<tr>
					<th>Registrados por d&iacute;a</th>
					<th>Registrados por semana</th>
					<th>Registrados por mes</th>
					<th>Hoy</th>
					<th>Ayer</th>
					<th>Esta semana</th>
					<th>Este mes</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>{$get_stats.users_x_dia}</td>
					<td>{$get_stats.users_x_semana}</td>
					<td>{$get_stats.users_x_mes}</td>
					<td>{$get_stats.users_hoy}</td>
					<td>{$get_stats.users_ayer}</td>
					<td>{$get_stats.users_semana}</td>
					<td>{$get_stats.users_mes}</td>
				</tr>
				<tr>
					<td colspan="7">
						<div class="chart_body">
							<div class="chart_left">
								<div class="chart_item c_type1 otip" title="{$get_stats.users_act_xciento}% activos" style="width:{$get_stats.users_act_xciento}%">
									&nbsp;{$get_stats.users_act_xciento}% activos
								</div>
								<div class="chart_item c_type2 otip" title="{$get_stats.users_ban_xciento}% baneados" style="width:{$get_stats.users_ban_xciento}%">
									&nbsp;{$get_stats.users_ban_xciento}% baneados
								</div>
								<div class="chart_item c_type3 otip" title="{$get_stats.users_inact_xciento}% inactivos" style="width:{$get_stats.users_inact_xciento}%">
									&nbsp;{$get_stats.users_inact_xciento}% inactivos
								</div>
							</div>
							<div class="chart_right">
								<ul>
									<li class="chart_list">
										<a class="cuadrito2 c_type1"></a> Activos: <b>{$get_stats.users.activos}</b>
									</li>
									<li class="chart_list">
										<a class="cuadrito2 c_type2"></a> Baneados: <b>{$get_stats.users.baneados}</b>
									</li>
									<li class="chart_list">
										<a class="cuadrito2 c_type3"></a> Inactivos: <b>{$get_stats.users.inactivos}</b>
									</li>
									<li class="chart_list">
										<a class="cuadrito2 c_type4"></a> Total: <b>{$get_stats.users.registrados}</b>
									</li>
								</ul>
							</div>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
		
		<hr />
		
		<div class="box_title">Posts</div>
		
		<table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="100%" align="center">
            <thead>
				<tr>
					<th>Posts por d&iacute;a</th>
					<th>Posts por semana</th>
					<th>Posts por mes</th>
					<th>Posts de hoy</th>
					<th>Posts de ayer</th>
					<th>De esta semana</th>
					<th>De este mes</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>{$get_stats.posts_x_dia}</td>
					<td>{$get_stats.posts_x_semana}</td>
					<td>{$get_stats.posts_x_mes}</td>
					<td>{$get_stats.posts_hoy}</td>
					<td>{$get_stats.posts_ayer}</td>
					<td>{$get_stats.posts_semana}</td>
					<td>{$get_stats.posts_mes}</td>
				</tr>
				<tr>
					<td colspan="7">
						<div class="chart_body">
							<div class="chart_left">
								<div class="chart_item c_type1 otip" title="{$get_stats.posts_act_xciento}% visibles" style="width:{$get_stats.posts_act_xciento}%">
									&nbsp;{$get_stats.posts_act_xciento}% visibles
								</div>
								<div class="chart_item c_type2 otip" title="{$get_stats.posts_del_xciento}% eliminados" style="width:{$get_stats.posts_del_xciento}%">
									&nbsp;{$get_stats.posts_del_xciento}% eliminados
								</div>
								<div class="chart_item c_type3 otip" title="{$get_stats.posts_inact_xciento}% en revisi&oacute;n" style="width:{$get_stats.posts_inact_xciento}%">
									&nbsp;{$get_stats.posts_inact_xciento}% en revisi&oacute;n
								</div>
							</div>
							<div class="chart_right">
								<ul>
									<li class="chart_list">
										<a class="cuadrito2 c_type1"></a> Visibles: <b>{$get_stats.posts.activos}</b>
									</li>
									<li class="chart_list">
										<a class="cuadrito2 c_type2"></a> Eliminados: <b>{$get_stats.posts.eliminados}</b>
									</li>
									<li class="chart_list">
										<a class="cuadrito2 c_type3"></a> En revisi&oacute;n: <b>{$get_stats.posts.inactivos}</b>
									</li>
									<li class="chart_list">
										<a class="cuadrito2 c_type4"></a> Total: <b>{$get_stats.posts.total}</b>
									</li>
								</ul>
							</div>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
		
		<hr />
		
		<div class="box_title">Comentarios y respuestas</div>
		
		<table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="100%" align="center">
            <thead>
				<tr>
					<th>Por d&iacute;a</th>
					<th>Por semana</th>
					<th>Por mes</th>
					<th>De hoy</th>
					<th>De ayer</th>
					<th>De esta semana</th>
					<th>De este mes</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>{$get_stats.com_x_dia}</td>
					<td>{$get_stats.com_x_semana}</td>
					<td>{$get_stats.com_x_mes}</td>
					<td>{$get_stats.com_hoy}</td>
					<td>{$get_stats.com_ayer}</td>
					<td>{$get_stats.com_semana}</td>
					<td>{$get_stats.com_mes}</td>
				</tr>
				<tr>
					<td colspan="7">
						<div class="chart_body">
							<div class="chart_left">
								<div class="chart_item c_type1 otip" title="{$get_stats.com_post_xciento}% en posts" style="width:{$get_stats.com_post_xciento}%">
									&nbsp;{$get_stats.com_post_xciento}% en posts
								</div>
								<div class="chart_item c_type1-2 otip" title="{$get_stats.com_img_xciento}% en imágenes" style="width:{$get_stats.com_img_xciento}%">
									&nbsp;{$get_stats.com_img_xciento}% en imágenes
								</div>
								<div class="chart_item c_type1-3 otip" title="{$get_stats.com_topic_xciento}% en temas" style="width:{$get_stats.com_topic_xciento}%">
									&nbsp;{$get_stats.com_topic_xciento}% en temas
								</div>
							</div>
							<div class="chart_right">
								<ul>
									<li class="chart_list">
										<a class="cuadrito2 c_type1"></a> En posts: <b>{$get_stats.com.post}</b>
									</li>
									<li class="chart_list">
										<a class="cuadrito2 c_type1-2"></a> En imágenes: <b>{$get_stats.com.img}</b>
									</li>
									<li class="chart_list">
										<a class="cuadrito2 c_type1-3"></a> En temas: <b>{$get_stats.com.topic}</b>
									</li>
									<li class="chart_list">
										<a class="cuadrito2 c_type4"></a> Total: <b>{$get_stats.com.total}</b>
									</li>
								</ul>
							</div>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
		
	</div>
</div>
{elseif $action == 'add'}
<div class="box">
	<div class="box_title">Agregar noticia</div>
	<div class="box_body clearfix admin-settings">
		
		<ul>
			<li class="list_item clearfix">
				<label for="n_body">Cuerpo de la noticia:
					<small>Acepta BBcode y emoticonos</small>
				</label>
				<textarea id="n_body" class="inp_text" name="n_body" style="width:350px;min-height:70px;display:inline-block;" autocomplete="off"></textarea>
			</li>
			
			
			<li class="list_item clearfix">
				<label for="n_status">Estado de la noticia:</label>	
				<select id="n_status" style="width:100px;" name="n_status" class="inp_text">
					<option value="1">Activa</option>
					<option value="0">Oculta</option>
				</select>
			</li>

		</ul>
		
		<hr>
		<a href="{$web.url}/admin?do=news" class="button_1 floatL">Volver</a>
		<input type="button" class="button_1 b_ok floatR" value="Agregar noticia" onclick="admin.news.add();">
		
	</div>
	
</div>
{/if}