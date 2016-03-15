<center>{if $cinfo.posts > 0}Esta categoría cuenta con <b>{$cinfo.posts}</b> posts que serán movidos.
<span class="head_text"><span>Mover posts a</span></span>
<select style="width:200px;" name="new_cat" class="inp_text">
	{foreach from=$cats item=c}
	{if $c.c_id != $cinfo.c_id}<option value="{$c.c_id}">{$c.c_name}</option>{/if}
	{/foreach}
</select>
<br /><br />
{/if}
¿Deseas continuar y eliminar la categoría <b>{$cinfo.c_name}</b>?</center>