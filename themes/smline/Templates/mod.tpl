{include file='i_admin/admin_header.tpl'}

<div class="mod_content">

	<div class="left_menu">
		{include file='i_mod/left_menu.tpl'}
	</div>

	<div class="mod_main">
		{if $do == 'usuarios_suspendidos'}{include file='i_mod/usuarios_suspendidos.tpl'}
		{elseif $do == 'usuarios_reportados'}{include file='i_mod/usuarios_reportados.tpl'}
		{elseif $do == 'posts_aprobar'}{include file='i_mod/posts_aprobar.tpl'}
		{elseif $do == 'posts_eliminados'}{include file='i_mod/posts_eliminados.tpl'}
		{elseif $do == 'posts_reportados'}{include file='i_mod/posts_reportados.tpl'}
		{elseif $do == 'imagenes_eliminadas'}{include file='i_mod/imagenes_eliminadas.tpl'}
		{elseif $do == 'imagenes_reportadas'}{include file='i_mod/imagenes_reportadas.tpl'}
		{elseif $do == 'comus_suspendidas'}{include file='i_mod/comus_suspendidas.tpl'}
		{elseif $do == 'comus_reportadas'}{include file='i_mod/comus_reportadas.tpl'}
		{elseif $do == 'temas_eliminados'}{include file='i_mod/temas_eliminados.tpl'}
		{elseif $do == 'temas_reportados'}{include file='i_mod/temas_reportados.tpl'}
		{elseif $do == 'mensajes_reportados'}{include file='i_mod/mensajes_reportados.tpl'}
		{else}{include file='i_mod/main_home.tpl'}{/if}
	</div>

</div>

{*<div class="footer">
	<a href="http://smartec.net" target="_blank">Smartec</a> © 2014
</div>*}


</div>
<div class="notification-board right bottom"></div>
</body>
</html>