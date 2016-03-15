<div class="emptyData admin_member_error" style="display:none"></div>

<div class="spoiler" style="width:400px">
	<a class="spoiler-title" onclick="$('.spoiler-body').slideUp();spoiler($(this));set_admin_action(0);">Detalles</a>
	<div class="spoiler-body" style="">
		
		<div class="form" id="error">
			Nombre de usuario:<br />
			<strong>{$admin_member.u_nick}</strong>
			<br />
			<br />
			
			Rango en la comunidad:<br />
			<strong>{$admin_member.r_name}</strong>
			<br />
			<br />
			
			Miembro desde:<br />
			<strong>{$admin_member.m_date|hace}</strong>
			
		</div>
		
	</div>
</div>

<hr />

{if $admin_member.m_status == 1}
<div class="spoiler" style="width:400px">
	<a class="spoiler-title" onclick="$('.spoiler-body').slideUp();spoiler($(this));set_admin_action('ban');">Suspender</a>
	<div class="spoiler-body" style="display: none;">
		
		<div class="form" id="error">
			Suspender a:<br />
			<strong>{$admin_member.u_nick}</strong>
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
		
	</div>
</div>
{else}
<div class="spoiler" style="width:400px">
	<a class="spoiler-title" onclick="$('.spoiler-body').slideUp();spoiler($(this));set_admin_action('unban');">Reactivar</a>
	<div class="spoiler-body" style="display: none;">
		
		<div class="form" id="error">
			Reactivar a: <strong>{$admin_member.u_nick}</strong>
			<br />
			<br />
			Suspendido: <strong>{$admin_member.ban.b_date|hace}</strong>
			<br />
			<br />
			Por: <strong><a href="{$web.url}/{$admin_member.ban.u_nick}" target="_blank">{$admin_member.ban.u_nick}</a></strong>
			<br />
			<br />
			Raz&oacute;n: <strong>{$admin_member.ban.b_reason}</strong>
			<br />
			<br />
			Termina: <strong>{$admin_member.ban.b_end}</strong>
			<br />
			<br />
			Reactivar:
			<br />
			<select name="reactivar" class="inp_text" style="width: 70px;">
				<option value="1" selected="selected">Si</option>
				<option value="0">No</option>
			</select>
		</div>
		
	</div>
</div>
{/if}

{if $admin_member.change_rank}
<hr />

<div class="spoiler" style="width:400px">
	<a class="spoiler-title" onclick="$('.spoiler-body').slideUp();spoiler($(this));set_admin_action('rank');">Cambiar rango</a>
	<div class="spoiler-body" style="display: none;">
		
		<div class="form" id="error">
			Cambiar rango de:<br />
			<strong>{$admin_member.u_nick}</strong>
			<br />
			<br />
			Rango actual:<br />
			<strong>{$admin_member.r_name}</strong>
			<br />
			<br />
			Nuevo rango:
			<br />
			<select name="new_rank" class="inp_text" style="width: 150px;">
				{foreach from=$admin_member.list_ranks item=r}
				<option value="{$r.r_id}"{if $r.r_id == $admin_member.r_id} selected="selected"{/if}>{if $r.r_name == ''}{$admin_member.comu_rank}{else}{$r.r_name}{/if}</option>
				{/foreach}
			</select>
			
		</div>
		
	</div>
</div>
{/if}