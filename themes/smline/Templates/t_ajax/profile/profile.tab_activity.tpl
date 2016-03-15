1: 
<div class="box_title">
	Actividad reciente
</div>
<div class="profile_status clearfix activity_listest">
	{foreach from=$activity item=a}
	<li class="activity-list">
		<i class="smarticon {$a.css}"></i>{$a.text} <a href="{$a.link}">{$a.text_link}</a> {if $a.complement}{$a.complement.text}{if $a.complement.text_link} <a href="{$a.complement.link}">{$a.complement.text_link}</a>{/if} {/if}<span class="activity-date">{$a.date}</span>
	</li>
	{/foreach}
</div>

{if !$activity}<div class="emptyData">Este usuario no tiene actividad en {$web.title}</div>{/if}

{if $activity|count >= 20}
<a class="load_more" onclick="profile.activity_load_more();">Mostrar más actividad</a>
<div id="error" class="no_hay_mas_activity" style="display:none">No hay más actividad para mostrar</div>
{/if}
<input type="hidden" name="activity_start" value="1" />