{if $links_i}
<div class="box margin-top-5">
	<div class="box_title">Links de interés</div>
	<div class="box_body list_element webs_amigas">
		<center>
		{foreach from=$links_i item=l}
		<a href="{$l.l_url}" rel="nofollow" target="_blank">{$l.l_title}</a><hr>
		{/foreach}
		</center>
	</div>
</div>
{/if}