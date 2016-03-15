<?php /* Smarty version Smarty-3.1.15, created on 2014-08-23 11:24:00
         compiled from ".\themes\smline\Templates\i_admin\stats.tpl" */ ?>
<?php /*%%SmartyHeaderCode:433253f8c020e1fa34-85423353%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8ac79ab9c8e37834c9b66b6cfb90b95ab22f6c46' => 
    array (
      0 => '.\\themes\\smline\\Templates\\i_admin\\stats.tpl',
      1 => 1397064171,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '433253f8c020e1fa34-85423353',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'action' => 0,
    'get_stats' => 0,
    'web' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f8c021019d03_36201022',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f8c021019d03_36201022')) {function content_53f8c021019d03_36201022($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['action']->value=='') {?>
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
					<td><?php echo $_smarty_tpl->tpl_vars['get_stats']->value['users_x_dia'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['get_stats']->value['users_x_semana'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['get_stats']->value['users_x_mes'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['get_stats']->value['users_hoy'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['get_stats']->value['users_ayer'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['get_stats']->value['users_semana'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['get_stats']->value['users_mes'];?>
</td>
				</tr>
				<tr>
					<td colspan="7">
						<div class="chart_body">
							<div class="chart_left">
								<div class="chart_item c_type1 otip" title="<?php echo $_smarty_tpl->tpl_vars['get_stats']->value['users_act_xciento'];?>
% activos" style="width:<?php echo $_smarty_tpl->tpl_vars['get_stats']->value['users_act_xciento'];?>
%">
									&nbsp;<?php echo $_smarty_tpl->tpl_vars['get_stats']->value['users_act_xciento'];?>
% activos
								</div>
								<div class="chart_item c_type2 otip" title="<?php echo $_smarty_tpl->tpl_vars['get_stats']->value['users_ban_xciento'];?>
% baneados" style="width:<?php echo $_smarty_tpl->tpl_vars['get_stats']->value['users_ban_xciento'];?>
%">
									&nbsp;<?php echo $_smarty_tpl->tpl_vars['get_stats']->value['users_ban_xciento'];?>
% baneados
								</div>
								<div class="chart_item c_type3 otip" title="<?php echo $_smarty_tpl->tpl_vars['get_stats']->value['users_inact_xciento'];?>
% inactivos" style="width:<?php echo $_smarty_tpl->tpl_vars['get_stats']->value['users_inact_xciento'];?>
%">
									&nbsp;<?php echo $_smarty_tpl->tpl_vars['get_stats']->value['users_inact_xciento'];?>
% inactivos
								</div>
							</div>
							<div class="chart_right">
								<ul>
									<li class="chart_list">
										<a class="cuadrito2 c_type1"></a> Activos: <b><?php echo $_smarty_tpl->tpl_vars['get_stats']->value['users']['activos'];?>
</b>
									</li>
									<li class="chart_list">
										<a class="cuadrito2 c_type2"></a> Baneados: <b><?php echo $_smarty_tpl->tpl_vars['get_stats']->value['users']['baneados'];?>
</b>
									</li>
									<li class="chart_list">
										<a class="cuadrito2 c_type3"></a> Inactivos: <b><?php echo $_smarty_tpl->tpl_vars['get_stats']->value['users']['inactivos'];?>
</b>
									</li>
									<li class="chart_list">
										<a class="cuadrito2 c_type4"></a> Total: <b><?php echo $_smarty_tpl->tpl_vars['get_stats']->value['users']['registrados'];?>
</b>
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
					<td><?php echo $_smarty_tpl->tpl_vars['get_stats']->value['posts_x_dia'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['get_stats']->value['posts_x_semana'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['get_stats']->value['posts_x_mes'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['get_stats']->value['posts_hoy'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['get_stats']->value['posts_ayer'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['get_stats']->value['posts_semana'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['get_stats']->value['posts_mes'];?>
</td>
				</tr>
				<tr>
					<td colspan="7">
						<div class="chart_body">
							<div class="chart_left">
								<div class="chart_item c_type1 otip" title="<?php echo $_smarty_tpl->tpl_vars['get_stats']->value['posts_act_xciento'];?>
% visibles" style="width:<?php echo $_smarty_tpl->tpl_vars['get_stats']->value['posts_act_xciento'];?>
%">
									&nbsp;<?php echo $_smarty_tpl->tpl_vars['get_stats']->value['posts_act_xciento'];?>
% visibles
								</div>
								<div class="chart_item c_type2 otip" title="<?php echo $_smarty_tpl->tpl_vars['get_stats']->value['posts_del_xciento'];?>
% eliminados" style="width:<?php echo $_smarty_tpl->tpl_vars['get_stats']->value['posts_del_xciento'];?>
%">
									&nbsp;<?php echo $_smarty_tpl->tpl_vars['get_stats']->value['posts_del_xciento'];?>
% eliminados
								</div>
								<div class="chart_item c_type3 otip" title="<?php echo $_smarty_tpl->tpl_vars['get_stats']->value['posts_inact_xciento'];?>
% en revisi&oacute;n" style="width:<?php echo $_smarty_tpl->tpl_vars['get_stats']->value['posts_inact_xciento'];?>
%">
									&nbsp;<?php echo $_smarty_tpl->tpl_vars['get_stats']->value['posts_inact_xciento'];?>
% en revisi&oacute;n
								</div>
							</div>
							<div class="chart_right">
								<ul>
									<li class="chart_list">
										<a class="cuadrito2 c_type1"></a> Visibles: <b><?php echo $_smarty_tpl->tpl_vars['get_stats']->value['posts']['activos'];?>
</b>
									</li>
									<li class="chart_list">
										<a class="cuadrito2 c_type2"></a> Eliminados: <b><?php echo $_smarty_tpl->tpl_vars['get_stats']->value['posts']['eliminados'];?>
</b>
									</li>
									<li class="chart_list">
										<a class="cuadrito2 c_type3"></a> En revisi&oacute;n: <b><?php echo $_smarty_tpl->tpl_vars['get_stats']->value['posts']['inactivos'];?>
</b>
									</li>
									<li class="chart_list">
										<a class="cuadrito2 c_type4"></a> Total: <b><?php echo $_smarty_tpl->tpl_vars['get_stats']->value['posts']['total'];?>
</b>
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
					<td><?php echo $_smarty_tpl->tpl_vars['get_stats']->value['com_x_dia'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['get_stats']->value['com_x_semana'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['get_stats']->value['com_x_mes'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['get_stats']->value['com_hoy'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['get_stats']->value['com_ayer'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['get_stats']->value['com_semana'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['get_stats']->value['com_mes'];?>
</td>
				</tr>
				<tr>
					<td colspan="7">
						<div class="chart_body">
							<div class="chart_left">
								<div class="chart_item c_type1 otip" title="<?php echo $_smarty_tpl->tpl_vars['get_stats']->value['com_post_xciento'];?>
% en posts" style="width:<?php echo $_smarty_tpl->tpl_vars['get_stats']->value['com_post_xciento'];?>
%">
									&nbsp;<?php echo $_smarty_tpl->tpl_vars['get_stats']->value['com_post_xciento'];?>
% en posts
								</div>
								<div class="chart_item c_type1-2 otip" title="<?php echo $_smarty_tpl->tpl_vars['get_stats']->value['com_img_xciento'];?>
% en imágenes" style="width:<?php echo $_smarty_tpl->tpl_vars['get_stats']->value['com_img_xciento'];?>
%">
									&nbsp;<?php echo $_smarty_tpl->tpl_vars['get_stats']->value['com_img_xciento'];?>
% en imágenes
								</div>
								<div class="chart_item c_type1-3 otip" title="<?php echo $_smarty_tpl->tpl_vars['get_stats']->value['com_topic_xciento'];?>
% en temas" style="width:<?php echo $_smarty_tpl->tpl_vars['get_stats']->value['com_topic_xciento'];?>
%">
									&nbsp;<?php echo $_smarty_tpl->tpl_vars['get_stats']->value['com_topic_xciento'];?>
% en temas
								</div>
							</div>
							<div class="chart_right">
								<ul>
									<li class="chart_list">
										<a class="cuadrito2 c_type1"></a> En posts: <b><?php echo $_smarty_tpl->tpl_vars['get_stats']->value['com']['post'];?>
</b>
									</li>
									<li class="chart_list">
										<a class="cuadrito2 c_type1-2"></a> En imágenes: <b><?php echo $_smarty_tpl->tpl_vars['get_stats']->value['com']['img'];?>
</b>
									</li>
									<li class="chart_list">
										<a class="cuadrito2 c_type1-3"></a> En temas: <b><?php echo $_smarty_tpl->tpl_vars['get_stats']->value['com']['topic'];?>
</b>
									</li>
									<li class="chart_list">
										<a class="cuadrito2 c_type4"></a> Total: <b><?php echo $_smarty_tpl->tpl_vars['get_stats']->value['com']['total'];?>
</b>
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
<?php } elseif ($_smarty_tpl->tpl_vars['action']->value=='add') {?>
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
		<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/admin?do=news" class="button_1 floatL">Volver</a>
		<input type="button" class="button_1 b_ok floatR" value="Agregar noticia" onclick="admin.news.add();">
		
	</div>
	
</div>
<?php }?><?php }} ?>
