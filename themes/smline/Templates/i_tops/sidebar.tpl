<div class="box">
	<div class="box_title">Filtrar tops</div>
	<div class="box_body all_filters" style="position: relative;">
		
		<span class="fil_tit">Periodo...</span>
		<div class="fil_list list_order_search">
			<li class="list_fil{if !$filter.date || $filter.date == 5} active{/if}">
				<a href="?date=0&cat={$filter.cat}">Hist&oacute;rico</a>
			</li>
			<li class="list_fil{if $filter.date == 1} active{/if}">
				<a href="?date=1&cat={$filter.cat}">Hoy</a>
			</li>
			<li class="list_fil{if $filter.date == 2} active{/if}">
				<a href="?date=2&cat={$filter.cat}">Ayer</a>
			</li>
			<li class="list_fil{if $filter.date == 3} active{/if}">
				<a href="?date=3&cat={$filter.cat}">&Uacute;ltima semana</a>
			</li>
			<li class="list_fil{if $filter.date == 4} active{/if}">
				<a href="?date=4&cat={$filter.cat}">&Uacute;ltimo mes</a>
			</li>
		</div>
		
		{if $t_action != 'usuarios'}
		
		<hr />
		
		<span class="fil_tit">Categor&iacute;as</span>
		<div class="fil_list">
			<li class="list_fil active">
				<select class="inp_text" onchange="location.href='?date={$filter.date}&cat='+$(this).val();">
				<option selected="selected" value="">Seleccionar categor&iacute;a</option>
				<option value="0">Todas las categor&iacute;as</option>
				<optgroup label="-"></optgroup>
				{foreach from=$cats item=c}
				<option value="{$c.c_id}"{if $filter.cat == $c.c_id}selected="selected"{/if}>{$c.c_name}</option>
				{/foreach}
			</select>
			</li>
		</div>
		
		{/if}
		
	</div>
</div>