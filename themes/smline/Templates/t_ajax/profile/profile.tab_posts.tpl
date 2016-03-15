1: 
<div class="box_title">
	Posts
</div>
	<div class="box_menu clearfix">
		<span>Ordenar posts por</span>
		<select onchange="profile.posts_load_more($(this).val())" class="for_selector inp_text" name="posts_order">
			<option value="date">Fecha de creación</option>
			<option value="puntos">Puntos</option>
			<option value="comments">Comentarios</option>
			<option value="hits">Visitas</option>
		</select>
	</div>
<div class="profile_status clearfix activity_listest">
	{foreach from=$u_posts item=p}
	<li class="activity-list">
		<i class="etip icon" title="{$p.c_name}" style="background: url({$web.icons}/cats/{$p.c_img}) no-repeat;"></i>
		<a href="{$web.url}/posts/{$p.c_seo}/{$p.p_id}/{$p.p_title|seo}.html" title="{$p.p_title}">{$p.p_title}</a>
		<p>{$p.p_date|hace} &#8226; {$p.p_puntos} puntos</p>
	</li>
	{/foreach}
	{if !$u_posts}<div class="emptyData">Este usuario no ha publicado posts</div>{/if}
</div>

{if $u_posts|count >= 18}
<a class="load_more" onclick="profile.posts_load_more();">Mostrar más posts</a>
<div id="error" class="no_hay_mas_activity" style="display:none">No hay más posts para mostrar</div>
{/if}
<input type="hidden" name="posts_start" value="1" />