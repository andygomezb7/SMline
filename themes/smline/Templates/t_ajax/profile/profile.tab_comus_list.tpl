{if $u_comus}1: {else}2: {/if} 
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