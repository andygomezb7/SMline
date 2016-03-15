1: 
{if $mps|count == 0}
<div class="modal-error">No tienes mensajes nuevos</div>
{/if}
{foreach from=$mps item=m}

<div class="list-element-two msg clearfix{if $m.rp_read == 0} unread{/if}">
	<a href="{$web.url}/mensajes/leer/{$m.mp_id}#mp-rpta-id-{$m.rp_id}" class="msg-element"></a>
	<a href="/Hainner">
		<img class="avatar-2" src="{$web.url}/avatar/{$m.mp_user}_32.jpg?{$m.u_last_avatar}">
	</a>
	<div class="info-msg">
		<a class="msg-nick" href="{$web.url}/{$m.u_nick}">{$m.u_nick}</a>
		<br>
		<a class="asunto" style="overflow:hidden" href="{$web.url}/mensajes/leer/{$m.mp_id}#mp-rpta-id-{$m.rp_id}">{$m.rp_body|substr:0:30}{if $m.rp_body|strlen > 30}...{/if}</a>
	</div>
</div>

{/foreach}
{if $mps|count == $limit}
<a class="load_more" onclick="mensaje.view_more($(this))">Cargar m&aacute;s</a>
{/if}