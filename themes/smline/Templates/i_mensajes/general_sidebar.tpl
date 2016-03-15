<div class="box">
	<div class="box_title">Mis mensajes</div>
	<div class="box_body list-sidebar">
		<div class="new-msg-compose">
			<a class="button_1 b_ok" style="display:inline-block;" href="{$web.url}/mensajes/redactar">
				Redactar mensaje
			</a>
		</div>
		<div class="slist{if $m_action == '' || $m_action == 'recibidos'} active{/if}">
			<a href="{$web.url}/mensajes">
				Recibidos
				<span class="scount">{$mps_data.recibidos}</span>
			</a>
		</div>
		<div class="slist{if $m_action == 'enviados'} active{/if}">
			<a href="{$web.url}/mensajes/enviados">
				Enviados
				<span class="scount">{$mps_data.enviados}</span>
			</a>
		</div>
		<div class="slist{if $m_action == 'eliminados'} active{/if}">
			<a href="{$web.url}/mensajes/eliminados">
				Eliminados
				<span class="scount">{$mps_data.eliminados}</span>
			</a>
		</div>
	</div>
</div>