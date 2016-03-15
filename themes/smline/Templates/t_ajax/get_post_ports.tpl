1: 

<div class="step import-post" style="display: block;">
	<ul>
		{foreach from=$ports item=p}
		<li class="" onclick="new_post.importar_portada($(this).children('img').attr('src'));">
			<img src="{$p}" class="gets-ports">
		</li>
		{/foreach}
	</ul>
</div>
{if !$ports}No se encontraron imágenes en el post{/if}