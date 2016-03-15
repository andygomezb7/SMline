{if !$user->permits['bf']}0: Imposible continuar
{else}
1: 
<label>Razón para borrar esta imagen:</label>
<br />
<br />
<select name="reason" class="inp_text" onchange="{literal}if($(this).val().substr(0, 4) == 'Otra'){$('input[name=razon_desc]').show().focus();}else{$('input[name=razon_desc]').hide();}{/literal}" style="width: 300px;">
	{foreach from=$reasons item=r}
	<option value="{$r}">{$r}</option>
	{/foreach}
</select>
<br />
<br />
<input type="text" class="inp_text" name="razon_desc" maxlength="150" placeholder="Especifica la razón" style="width: 290px;display: none">
{/if}