<center>{if $rank.e.users > 0}Este rango cuenta con <b>{$rank.e.users}</b> usuarios que serán cambiados de rango.
<span class="head_text"><span>Mover usuarios a</span></span>
<select style="width:200px;" name="new_rank" class="inp_text">
	{foreach from=$ranks1 item=r}
	{if $r.r_id != 1 && $r.r_id != 2 && $r.r_name != $rank.e.r_name}<option value="{$r.r_id}">{$r.r_name}</option>{/if}
	{/foreach}
	{foreach from=$ranks0 item=r}
	{if $r.r_id != 1 && $r.r_id != 2 && $r.r_name != $rank.e.r_name}<option value="{$r.r_id}">{$r.r_name}</option>{/if}
	{/foreach}
</select>
<br /><br />
{/if}
¿Deseas continuar y eliminar el rango <b>{$rank.e.r_name}</b>?</center>