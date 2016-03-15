1: 
<div class="box_title">
	Comunidades
</div>

<div class="profile_status clearfix activity_listest">
	{foreach from=$u_comus item=co}
	<li class="activity-list clearfix">
			<div class="floatL avatarBox">
				<a href="{$web.url}/comunidades/{$co.comu_seo}/" class="img-comu">
					<img src="{$web.url}/thumbs/comus/t_{$co.comu_id}.jpg?{$co.comu_last_image}" width="50px" height="50px" alt="Ir a la comunidad" title="Ir a la comunidad">
				</a>
			</div>
			<div class="follows_right_content">
				<a href="{$web.url}/comunidades/{$co.comu_seo}/" class="floatL" title="{$co.comu_name}">{$co.comu_name}</a><br>
				<span class="date">{$co.c_name} - <strong>{if $co.r_name == ''}{$co.comu_rank}{else}{$co.r_name}{/if}</strong></span>
			</div>
		
	</li>
	{/foreach}
	{if !$u_comus}<div class="emptyData">Este usuario no se ha unido a ninguna comunidad</div>{/if}
</div>

{if $u_comus|count >= 18}
<a class="load_more" onclick="profile.comus_load_more();">Mostrar más comunidades</a>
<div id="error" class="no_hay_mas_activity" style="display:none">No hay más comunidades para mostrar</div>
{/if}
<input type="hidden" name="comus_start" value="1" />