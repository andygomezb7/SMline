<div class="box">
	<div class="box_title">Administración SMLine</div>
	<div class="box_body clearfix">
		<span class="item-info"><img src="{$web.icons}/info.png" />Hola <strong>{$user->nick}</strong>. Tu rango te da el privilegio de administrar este sitio web. Recuerda visitar regularmente el <a href="http://smline.net/" target="_blank">foro oficial</a> para estar al tanto de cada novedad.</span>
		<hr />
		
		{literal}
		<script type="text/javascript">
		$(document).ready(function(){
			$.ajax({
				type: 'GET',
				url: '/ajax/sm/news',
				dataType: 'json',
				success: function(h) {
					$('.SMnews').html('');
					for(var i = 0; i < h.length; i++){
						var html = '<li>';
						html += '<div class="title"><a href="' + h[i]['link'] + '" target="_blank">' + h[i]['title'] +'</a><span class="ldate">' + h[i]['date'] +'</span></div>';
						html += '<div class="body">' + h[i]['desc'] +'</div>';
						html += '</li>';
						$('.SMnews').append(html);
					}
				}
			});

		});
		</script>
		{/literal}
		
		<div class="box boxy_main">
			<div class="box_title">En vivo desde SMline</div>
			<div class="boxy_body">
				<div class="boxy_content SMnews">
					
					<div class="emptyData">
						Cargando contenidos desde SMline...
					</div>
					
				</div>
				
			</div>
		</div>
		
		<div class="list_tables">		
			
			<table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="250" align="right">
				<thead>
					<tr>
						<th colspan="2">Accesos recientes</th>
					</tr>
				</thead>
				<tbody>
					{foreach from=$get_access item=u}
					<tr class="Tleft">
						<td>
							<a href="{$web.url}/{$u.u_nick}">{$u.u_nick}</a> <small>(<a href="http://geoiptool.com/es/?IP={$u.a_ip}" target="_blank">{$u.a_ip}</a>)</small>
						</td>
						<td>{$u.a_date|hace}</td>
					</tr>
					{/foreach}
				</tbody>
			</table>
			
			<table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="250" align="right">
				<thead>
					<tr>
						<th>Equipo de administraci&oacute;n</th>
					</tr>
				</thead>
				<tbody>
					{foreach from=$get_admins item=u}
					<tr>
						<td>
							<a href="{$web.url}/{$u.u_nick}">{$u.u_nick}</a>
						</td>
					</tr>
					{/foreach}
				</tbody>
			</table>
			
			<table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="250" align="right">
				<thead>
					<tr>
						<th colspan="2">Versiones</th>
					</tr>
				</thead>
				<tbody>
					<tr class="Tleft">
						<td>Versión de SMLine</td>
						<td><b>{$web.smline_version}</b></td>
					</tr>
					<tr class="Tleft">
						<td>Versión de Smarty</td>
						<td><b>{$version.smarty}</b></td>
					</tr>
					<tr class="Tleft">
						<td>Versión de de PHP</td>
						<td><b>{$version.php}</b></td>
					</tr>
					<tr class="Tleft">
						<td>Versi&oacute;n de MySQLi</td>
						<td><b>{$version.mysqli.version}</b></td>
					</tr>
					
				</tbody>
			</table>
			
		</div>
		
	</div>
</div>