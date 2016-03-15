1: 
{if $notifications|count == 0}
<div class="modal-error">No tienes notificaciones nuevas</div>
{/if}
{foreach from=$notifications item=n}
<li class="activity-list{if $n.n_view != 2} notview{/if}">
	<i class="smarticon {$n.css}"></i>
	{if $n.show_user}<a href="{$web.url}/{$n.user}">{$n.user}</a> {/if}{$n.text} <a href="{$n.link}" class="stip" title="{$n.title}">{$n.obj}</a>{if $n.complement} {$n.complement}{/if}
</li>
{/foreach}
{if $notifications|count == $limit}
<a class="load_more" onclick="notifica.view_more($(this))">Cargar m&aacute;s</a>
{/if}