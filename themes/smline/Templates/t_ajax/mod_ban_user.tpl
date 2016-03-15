1: 
<div class="form" id="error">
	Suspender a:<br />
	<b>{$us_nick}</b>
	<br />
	<br />
	Duraci&oacute;n:
	<br />
	<select name="duration" class="inp_text" onchange="{literal}$('.duration_type_2, .duration_type_1').hide();if($(this).val() == 1){$('.duration_type_1').show();}else if($(this).val() == 2){$('.duration_type_2').show();}else{$('.duration_type_2, .duration_type_1').hide();}{/literal}" style="width: 100px;">
		<option value="0">Indefinida</option>
		<option value="1">Horas</option>
		<option value="2">D&iacute;as</option>
	</select>
	<br />
	<br />
	<div class="duration_type_2" style="display:none">
		Cu&aacute;ntos:
		<br />
		<input class="inp_text" name="total_val" maxlength="5" style="width: 50px;"></textarea>
		<br />
		<br />
	</div>
	<div class="duration_type_1" style="display:none">
		Cu&aacute;ntas:
		<br />
		<input class="inp_text" name="total_val" maxlength="5" style="width: 50px;"></textarea>
		<br />
		<br />
	</div>
	Raz&oacute;n:<br />
	<textarea class="inp_text" name="razon_desc" maxlength="200" placeholder="Ingresa la raz&oacute;n" style="width: 290px;"></textarea>
</div>