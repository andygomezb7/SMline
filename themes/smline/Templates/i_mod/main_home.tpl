		<h2>Sala de moderación</h2>
		
		<p>Hola <strong>{$user->nick}</strong>, bienvenido/a a la sala de moderaci&oacute;n {$web.title}.</p>
		
		<br />
		<br />
		
		<div class="mod_protocol">
			<h3>Protocolo de moderador</h3>
			<ul>
				<li>
					No debe abusar del poder que implica el ser moderador.
				</li>
				<li>
					No debe discriminar a los usuarios por raza, edad, defectos o sexo.
				</li>
				<li>
					No debe hacer uso de un mal vocabulario.
				</li>
				<li>
					Debe respetar las decisiones tomadas por los Administradores.
				</li>
				<li>
					Debe hacer uso de buena ortografía en sus comunicados, mensajes, alertas etc.
				</li>
				<li>
					Debe orientar correctamente a los usuarios con inquietudes o dudas.
				</li>
				<li>
					Debe hacer lo posible porque el <a href="{$web.url}/protocolo" target="_blank">protocolo general</a> sea respetado por los usuarios.
				</li>
				<li>
					Debe evitar que {$web.title} sea blanco fácil de spam, insultos, crap etc.
				</li>
			</ul>
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
						<th>Equipo de moderaci&oacute;n</th>
					</tr>
				</thead>
				<tbody>
					{foreach from=$get_mods item=u}
					<tr>
						<td>
							<a href="{$web.url}/{$u.u_nick}">{$u.u_nick}</a>
						</td>
					</tr>
					{/foreach}
				</tbody>
			</table>
			
		</div>