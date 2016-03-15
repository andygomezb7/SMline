<div class="filterBy filterFull clearfix ui-corner-all">
	<div class="floatL xResults">
		Mostrando <strong>{$mis_comus.start} - {if $mis_comus.end < $mis_comus.total}{$mis_comus.end}{else}{$mis_comus.total}{/if}</strong> resultados de <strong>{$mis_comus.total}</strong>	</div>
	<ul class="floatR">
		<li class="orderTxt">Ordenar por</li>
		<li{if $order == 'nombre'} class="here"{/if}><a href="{$web.url}/comunidades/mis-comunidades/nombre">Nombre</a></li>
		<li{if $order == 'rango' || $order == ''} class="here"{/if}><a href="{$web.url}/comunidades/mis-comunidades/rango">Rango</a></li>
		<li{if $order == 'miembros'} class="here"{/if}><a href="{$web.url}/comunidades/mis-comunidades/miembros">Miembros</a></li>
		<li{if $order == 'temas'} class="here"{/if}><a href="{$web.url}/comunidades/mis-comunidades/temas">Temas</a></li>
	</ul>
	<div class="clearBoth"></div>
</div>

<div id="showResult" class="resultFull mis-comunidades">
	<ul class="clearfix">

	{foreach from=$mis_comus.list item=m}
		<li class="resultBox clearfix">
			<div class="floatL avatarBox">
				<a href="{$web.url}/comunidades/{$m.comu_seo}/" class="img-comu">
					<img src="{$web.url}/thumbs/comus/t_{$m.comu_id}.jpg?{$m.comu_last_image}" alt="Ir a la comunidad" title="Ir a la comunidad">
				</a>
			</div>
			<div class="floatL infoBox">
				<h4><a href="{$web.url}/comunidades/{$m.comu_seo}/">{$m.comu_name}</a></h4>
				<ul>
					<li>Categor&iacute;a: <strong>{$m.c_name}</strong></li>
					<li title="{$m.comu_desc}">{$m.comu_desc|substr:70}</li>
					<li>Miembros: <strong>{$m.comu_members}</strong> - Temas: <strong>{$m.comu_topics}</strong></li>
					<li>Mi rango: <strong>{if $m.r_name == ''}{$m.comu_rank}{else}{$m.r_name}{/if}</strong></li>
				</ul>
			</div>
		</li>
	{/foreach}
	
	{if !$mis_comus.list}<div class="emptyData">No eres miembro de ninguna comunidad</div>{/if}
	
	</ul>
</div>
{$mis_comus.pages}