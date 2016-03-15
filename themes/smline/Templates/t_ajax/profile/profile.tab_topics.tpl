1: 
<div class="box_title">
	Temas
</div>
	<div class="box_menu clearfix">
		<span>Ordenar temas por</span>
		<select onchange="profile.topics_load_more($(this).val())" class="for_selector inp_text" name="posts_order">
			<option value="date">Fecha de creación</option>
			<option value="comments">Respuestas</option>
			<option value="hits">Visitas</option>
		</select>
	</div>
<div class="profile_status clearfix activity_listest">
	{foreach from=$u_topics item=t}
	<li class="activity-list">
		<i class="etip icon" title="{$t.c_name}" style="background: url({$web.icons}/comus-cats/{$t.c_img}) no-repeat;"></i>
		<a href="{$web.url}/comunidades/{$t.comu_seo}/{$t.t_id}/{$t.t_title|seo}.html" title="{$t.t_title}">{$t.t_title}</a>
		<p>{$t.t_date|hace} en <a href="{$web.url}/comunidades/{$t.comu_seo}/">{$t.comu_name}</a></p>
	</li>
	{/foreach}
	{if !$u_topics}<div class="emptyData">Este usuario no ha iniciado temas</div>{/if}
</div>

{if $u_topics|count >= 18}
<a class="load_more" onclick="profile.topics_load_more();">Mostrar más temas</a>
<div id="error" class="no_hay_mas_activity" style="display:none">No hay más temas para mostrar</div>
{/if}
<input type="hidden" name="posts_start" value="1" />