{if $activity}1: {else}2: {/if} 
{foreach from=$activity item=a}
	<li class="activity-list">
		<i class="smarticon {$a.css}"></i>{$a.text} <a href="{$a.link}">{$a.text_link}</a> {if $a.complement}{$a.complement.text}{if $a.complement.text_link} <a href="{$a.complement.link}">{$a.complement.text_link}</a>{/if} {/if}<span class="activity-date">{$a.date}</span>
	</li>
{/foreach}