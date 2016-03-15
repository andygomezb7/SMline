1: 
<div class="box_title">
	Medallas
</div>

<div class="profile_status clearfix activity_listest">
	{foreach from=$u_medals item=m}
	<li class="activity-list clearfix">
			<div class="floatL avatarBox">
				<img src="{$web.icons}/medals/{$m.m_image}" title="{$m.m_title}" alt="Imagen de la medalla" />
			</div>

			<div class="follows_right_content" style="width: 467px;">
				<strong>{$m.m_title}</strong>
				<span class="date"> - {$m.m_date|date_format:"%d/%m/%Y a las %I:%M %p"}<br>
				{$m.m_desc}</span>
			</div>
		
	</li>
	{/foreach}
	{if !$u_medals}<div class="emptyData">Este usuario no ha obtenido medallas</div>{/if}
</div>