<div class="box margin-top-5">
	<div class="box_title">Top usuarios</div>
	<div class="box_filter filter_users clearfix">
		<a onclick="tops_filter('users', 1, 'ho')" class="f_p_ho">Hoy</a>
		<a onclick="tops_filter('users', 2, 'ay')" class="f_p_ay">Ayer</a>
		<a onclick="tops_filter('users', 3, 'se')" class="f_p_se">Semana</a>
		<a onclick="tops_filter('users', 4, 'me')" class="f_p_me">Mes</a>
		<a onclick="tops_filter('users', 5, 'hi')" class="f_p_hi active">Histórico</a>
	</div>
	<div class="box_body top_users list_element">
		{if !$top_users}<div class="emptyData">No hay usuarios en este rango de tiempo</div>{/if}
		{foreach from=$top_users item=u key=i}
		<div class="list-element">
			<span class="number-list">{$i+1}</span>
			<a href="{$web.url}/{$u.u_nick}">{$u.u_nick}</a>
			<span class="value">{$u.u_points}</span>
		</div>
		{/foreach}
		<div class="box_more">
			<a href="{$web.url}/tops/users">Ver más</a>
		</div>
	</div>
</div>