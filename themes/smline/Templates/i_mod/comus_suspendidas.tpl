		<h2>Comunidades suspendidas</h2>

		<table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="100%">
			<thead>
				<tr>
					<th>ID</th>
					<th>Cat.</th>
					<th>Comunidad</th>
					<th>Creada por</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				{foreach from=$comus_suspendidas.list item=co}
				<tr id="report-{$co.r_id}">
					<td>
						{$co.comu_id}
					</td>
					<td>
						<img src="{$web.icons}/comus-cats/{$co.c_img}" class="stip" title="{$co.c_name}"/>
					</td>
					<td>
						<a href="{$web.url}/comunidades/{$co.comu_seo}/">{$co.comu_name}</a>
					</td>
					<td>
						<a href="{$web.url}/{$co.u_nick}">{$co.u_nick}</a> - {$co.comu_date|hace}
					</td>
					<td class="admin_actions">
						<a class="stip" title="Reactivar comunidad" onclick="mod.comus.unban({$co.comu_id})"><img src="{$web.icons}/power_on.png"></a>
					</td>
				</tr>
				{/foreach}
				{if !$comus_suspendidas.list}<tr><td colspan="5"><div id="error">No hay comunidades suspendidas.</div></td></tr>{/if}
				<tr>
					<td colspan="5">
						<form action="/mod" class="mod_buscar" name="search_u" method="get">
							<input type="text" class="input_text" name="qu" placeholder="Buscar comunidad..." value="{$qu}" autocomplete="off">
							<input type="hidden" name="do" value="comus_suspendidas" />
							<a class="button_next" onclick="document.forms.search_u.submit()">Buscar</a>
						</form>
					</td>
				</tr>
			</tbody>
		</table>
		{if $comus_suspendidas.list}{$comus_suspendidas.pages}{/if}
			