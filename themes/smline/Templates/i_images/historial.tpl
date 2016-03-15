<table cellpadding="0" cellspacing="0" border="0" class="fav_table" width="100%" align="center">
	<thead>
		<tr>
			<th>Título</th>
			<th>Acción</th>
			<th>Moderador</th>
			<th>Causa</th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$get_history item=h}
		<tr id="historyid-{$h.h_id}">
			<td>{$h.i_title}<br />Por <a href="{$web.url}/{$user->get_nick($h.i_user)}">{$user->get_nick($h.i_user)}</a></td>
			<td>
				{if $h.h_action == 1}<span class="color-red">Eliminada</span> 
				{elseif $h.h_action == 2}<span class="color-green">Reactivada</span>
				{elseif $h.h_action == 3}<span class="color-gray">Editada</span>
				{/if}
			</td>
			<td><a href="{$web.url}/{$h.u_nick}">{$h.u_nick}</a></td>
			<td>{$h.h_reason}</td>
		</tr>
		{/foreach}
		{if !$get_history}<tr><td colspan="4"><div id="error">No hay historial</div></td></tr>{/if}
	</tbody>
</table>