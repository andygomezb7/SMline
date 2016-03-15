<div class="breadcrump clearfix">
	<li class="first"><a href="{$web.url}/mensajes">Mensajes</a></li>
	{if $m_action == 'enviados'}<li>Enviados</li>
	{elseif $m_action == 'eliminados'}<li>Eliminados</li>
	{else}<li>Recibidos</li>{/if}
	<li class="last"></li>
</div>

{if $ok_act == 'send'}
<span class="item-info ok margin-top-5">
	<img src="{$web.icons}/ok.png">El mensaje fue enviado exitosamente
</span>
<br />
{elseif $ok_act == 'del'}
<span class="item-info ok margin-top-5">
	<img src="{$web.icons}/ok.png">El mensaje fue eliminado exitosamente
</span>
<br />
{/if}

<div class="m-select clearfix">
	<select name="marcar" onchange="mps.select($(this).val())">
		<option value="0">Seleccionar:</option>
		<option value="1">Todos</option>
		<option value="2">Ninguno</option>
		<option value="3">Le&iacute;dos</option>
		<option value="4">No le&iacute;dos</option>	
	</select>
	<select name="marcar" onchange="mps.checked_actions($(this).val())">
		<option value="0">Acciones:</option>
		<option value="1">Marcar como le&iacute;do</option>
		<option value="2">Marcar como no le&iacute;do</option>
		<option value="3">Eliminar</option>
	</select>
</div>

<div class="m-top clearfix">
	<div class="m-opciones"></div>
	<div class="m-remitente">{if $m_action == 'enviados'}Destinatario{else}Remitente{/if}</div>
	<div class="m-asunto">Asunto</div>
</div>

<div class="list-messages">
	{if !$mps.list}<div id="error">No hay mensajes para mostrar</div>{/if}
	{foreach from=$mps.list item=m}
	<div class="m-linea-mensaje{if $m.rp_read || $m.rp_user == $user->uid} open{/if} clearfix" id="mp-id-{$m.mp_id}">
		<div class="m-opciones open">
			<span class="ui-checkbox" mp-read="{if $m.rp_read}1{else}0{/if}" mp-id="{$m.mp_id}"></span>
		</div>
		<div class="m-remitente open">
			<a href="{$web.url}/{$m.u_nick}">
				<img class="avatar-2" src="{$web.url}/avatar/{$m.u_id}_32.jpg?{$m.u_last_avatar}" alt="Avatar">
			</a>
			<div class="remitente-info">
				<a href="{$web.url}/{$m.u_nick}" class="hovercard" uid="{$m.u_id}">
					{$m.u_nick}
				</a>
				<span class="date">{$m.rp_date|hace}</span>
			</div>
		</div>
		<div class="subject-message m-asunto open">
			<a class="message-link" href="{$web.url}/mensajes/leer/{$m.mp_id}#mp-rpta-id-{$m.rp_id}" alt="Leer mensaje">
				{$m.mp_subject}
				<br />
				<span>
					{$m.rp_body|substr:0:130}{if $m.rp_body|strlen > 130}...{/if}
				</span>
			</a>
		</div>
	</div>
	{/foreach}
</div>
	
{$mps.pages}