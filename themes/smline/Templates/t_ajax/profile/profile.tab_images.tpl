1: 
<div class="box_title">
	Imágenes
</div>
	<div class="box_menu clearfix">
		<span>Ordenar imágenes por</span>
		<select onchange="profile.images_load_more($(this).val())" class="for_selector inp_text" name="posts_order">
			<option value="date">Fecha de creación</option>
			<option value="comments">Comentarios</option>
			<option value="hits">Visitas</option>
		</select>
	</div>
<div class="profile_status clearfix activity_listest">
	{foreach from=$u_images item=i}
	<li class="activity-list clearfix">
		<a href="{$web.url}/imagenes/{$i.i_id}/{$i.i_title|seo}.html" class="left-img">
			<img src="{$web.url}/thumbs/images/t_{$i.i_id}.jpg" />
		</a>
		<div class="right-desc">
			<a href="{$web.url}/imagenes/{$i.i_id}/{$i.i_title|seo}.html" title="{$i.i_title}">{$i.i_title}</a>
			<p>{$i.i_description}</p>
		</div>
	</li>
	{/foreach}
	{if !$u_images}<div class="emptyData">Este usuario no ha agregado im&aacute;genes</div>{/if}
</div>

{if $u_images|count >= 10}
<a class="load_more" onclick="profile.images_load_more();">Mostrar más imágenes</a>
<div id="error" class="no_hay_mas_activity" style="display:none">No hay más imágenes para mostrar</div>
{/if}
<input type="hidden" name="posts_start" value="1" />