{include file='includes/header.tpl'}

<div id="main-col" style="margin-right:5px;">
	
	{if !$do}
	
	<div class="box box_main">
		<div class="box_title">Mis borradores</div>
		<div class="boxy_body">
			<div class="box_content SMnews">
				
				{foreach from=$get_borradores.normal item=p}
				<li id="borrador-id-{$p.p_id}">
					<div class="title">
						<i class="icon" title="{$p.c_name}" style="background: url({$web.icons}/cats/{$p.c_img}) no-repeat;"></i>
						<a href="{$web.url}/agregar-post?bid={$p.p_id}" title="{$p.p_title}" target="_blank">{$p.p_title}</a>
						<span class="ldate">{$p.p_date|date_format:"%d/%m/%Y a las %I:%M %p"}</span>
					</div>
					<div class="body">Acciones: <a onclick="del_borrador({$p.p_id})">Eliminar borrador</a> - <a href="{$web.url}/agregar-post?bid={$p.p_id}">Editar borrador</a></div>
				</li>
				{/foreach}
				
				{if !$get_borradores.normal}<div class="emptyData">No tienes borradores guardados.</div>{/if}
				
			</div>
				
		</div>
	</div>
	
	{else}
	
	<div class="box box_main">
		<div class="box_title">Mis posts eliminados</div>
		<div class="boxy_body">
			<div class="box_content SMnews">
				
				{foreach from=$get_borradores.eliminados item=p}
				<li id="borrador-id-{$p.p_id}">
					<div class="title">
						<i class="icon" title="{$p.c_name}" style="background: url({$web.icons}/cats/{$p.c_img}) no-repeat;"></i>
						<a href="{$web.url}/agregar-post?bid={$p.p_id}" title="{$p.p_title}" target="_blank">{$p.p_title}</a>
						<span class="ldate">{$p.p_date|date_format:"%d/%m/%Y a las %I:%M %p"}</span>
					</div>
					<div class="body">Acciones: <a onclick="del_borrador({$p.p_id})">Eliminar borrador</a> - <a href="{$web.url}/agregar-post?bid={$p.p_id}">Editar borrador</a></div>
				</li>
				{/foreach}
				
				{if !$get_borradores.eliminados}<div class="emptyData">No tienes posts eliminados.</div>{/if}
				
			</div>
				
		</div>
	</div>
	
	{/if}
	
</div>

<div id="sidebar">
	<div class="box">
		<div class="box_title">Filtros</div>
		<div class="box_body list-sidebar">
			
			<div class="slist{if !$do} active{/if}">
				<a href="{$web.url}/borradores">
					Mis borradores
					<span class="scount">{$get_borradores.normal|count}</span>
				</a>
			</div>
			
			<div class="slist{if $do} active{/if}">
				<a href="{$web.url}/borradores?do=eliminados">
					Mis posts eliminados
					<span class="scount">{$get_borradores.eliminados|count}</span>
				</a>
			</div>
			
		</div>
	</div>
</div>

{include file='includes/footer.tpl'}