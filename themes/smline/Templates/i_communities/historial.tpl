		<table cellpadding="0" cellspacing="0" border="0" class="fav_table" width="100%" align="center">
            <thead>
				<tr>
					<th>Comunidad => Tema</th>
					<th>Acción</th>
					<th>Moderador</th>
					<th>Causa</th>
				</tr>
			</thead>
			<tbody>
				{foreach from=$get_history item=h}
				<tr id="historyid-{$h.h_id}">
					<td><a href="{$web.url}/comunidades/{$h.comu_seo}/">{$h.comu_name}</a> => {$h.t_title}<br />Por <a href="{$web.url}/{$user->get_nick($h.t_user)}">{$user->get_nick($h.t_user)}</a></td>
					<td>
						{if $h.h_action == 1}<span class="color-red">Eliminado</span> 
						{elseif $h.h_action == 2}<span class="color-green">Reactivado</span>
						{elseif $h.h_action == 3}<span class="color-gray">Editado</span>
						{elseif $h.h_action == 6}<span class="color-blue">Fijado</span>
						{elseif $h.h_action == 7}<span class="color-deeppink">Desfijado</span>
						{/if}
					</td>
					<td><a href="{$web.url}/{$h.u_nick}">{$h.u_nick}</a></td>
					<td>{$h.h_reason}</td>
				</tr>
				{/foreach}
				{if !$get_history}<tr><td colspan="4"><div id="error">No hay historial</div></td></tr>{/if}
			</tbody>
		</table>