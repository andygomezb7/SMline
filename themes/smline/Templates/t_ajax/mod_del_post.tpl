{if !$user->permits['bp']}0: Imposible continuar
{else}
1: 
<label>Razón:</label>
<br />
<select name="reason" class="inp_text" onchange="{literal}if($(this).val().substr(0, 4) == 'Otra'){$('input[name=razon_desc]').show().focus();}else{$('input[name=razon_desc]').hide();}{/literal}" style="width: 300px;">
	{foreach from=$reasons item=r}
	<option value="{$r}">{$r}</option>
	{/foreach}
</select>
<br />
<input type="text" class="inp_text" name="razon_desc" maxlength="150" placeholder="Especifica la razón" style="width: 290px;display: none">
<br />
<label>Enviar a borradores:</label>
<br />
<select name="save_borrador" class="inp_text" style="width: 60px;">
	<option value="0" selected="selected">No</option>
	<option value="1">Si</option>
</select>
{/if}