		<h2>Comunidades reportadas</h2>

		<table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="100%">
			<thead>
				<tr>
					<th>Cat.</th>
					<th>Comunidad</th>
					<th>Creada por</th>
					<th>Reportada por</th>
					<th>Raz&oacute;n</th>
					<th>Estado</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				{foreach from=$comus_reportadas.list item=co}
				<tr id="comu-{$co.comu_id}">
					<td>
						<img src="{$web.icons}/comus-cats/{$co.c_img}" class="stip" title="{$co.c_name}"/>
					</td>
					<td>
						<a href="{$web.url}/comunidades/{$co.comu_seo}/">{$co.comu_name}</a>
					</td>
					<td>
						<a href="{$web.url}/{$co.u_nick}">{$co.u_nick}</a> - {$co.comu_date|hace}
					</td>
					<td>
						<a href="{$web.url}/{$user->get_nick($co.r_user)}">{$user->get_nick($co.r_user)}</a> - {$co.r_date|hace}
					</td>
					<td>
						{$co.r_reason}
					</td>
					<td id="not-status">
						{if $co.comu_status == 0}<span class="color-red">Suspendida</span>
						{else}<span class="color-green">Activa</span>
						{/if}
					</td>
					<td class="admin_actions">
						{if $co.comu_status == 0}
						<a class="stip" title="Reactivar comunidad" onclick="mod.comus.unban({$co.comu_id})"><img src="{$web.icons}/power_on.png"></a>
						{else}
						<a class="stip" title="Suspender comunidad" onclick="mod.comus.ban({$co.comu_id})"><img src="{$web.icons}/power_off.png"></a>
						{/if}
						<a class="stip" title="Borrar reporte" onclick="mod.reports.del({$co.r_id});"><img src="{$web.icons}/delete_.png"></a>
					</td>
				</tr>
				{/foreach}
				{if !$comus_reportadas.list}<tr><td colspan="7"><div id="error">No hay comunidades reportadas.</div></td></tr>{/if}
				<tr>
					<td colspan="7">
						<form action="/mod" class="mod_buscar" name="search_u" method="get">
							<input type="text" class="input_text" name="qu" placeholder="Buscar comunidad..." value="{$qu}" autocomplete="off">
							<input type="hidden" name="do" value="comus_reportadas" />
							<a class="button_next" onclick="document.forms.search_u.submit()">Buscar</a>
						</form>
					</td>
				</tr>
			</tbody>
		</table>
		{if $comus_reportadas.list}{$comus_reportadas.pages}{/if}
			