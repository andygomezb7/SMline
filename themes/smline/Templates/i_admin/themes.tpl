{if $action == 'install'}
		
		<div class="box box_main">
			<div class="box_title">{if $action == 'edit'}Editar{else}Instalar{/if} tema</div>
			<div class="box_body clearfix admin-settings">
				
				{if $install_error}
				<span class="item-info error margin-top-5"><img src="{$web.icons}/delete_.png">{$install_error}</span>
				{else}
				<span class="item-info margin-top-5"><img src="{$web.icons}/info.png">El nombre de la carpeta del tema debe tener letras, n&uacute;meros y/o guiones (no bajos).</span>
				{/if}
				
				<form action="{$web.url}/admin?do=themes&action=install" method="post" name="sm_install">
				
					<ul>
						
						<li class="list_item clearfix">
							<label for="t_seo">Nombre de la carpeta del tema:
								<small>{$web.url}/themes/<strong class="dirtheme">{$t_seo}</strong></small>
							</label>
							<input type="text" id="t_seo" class="inp_text" name="t_seo" autocomplete="off" style="display:inline-block;" onchange="$('.dirtheme').html($(this).val())" onkeyup="$('.dirtheme').html($(this).val())" value="{$t_seo}">
						</li>
						
						<input type="hidden" value="1" name="install">
					
					</ul>
					
					<hr>
					<a href="{$web.url}/admin?do=themes" class="button_1 floatL">Volver</a>
					<input type="button" class="button_1 b_ok floatR" value="Instalar tema" onclick="document.forms.sm_install.submit();">
					
				</form>
				
			</div>
		</div>
		
{elseif $action == 'uninstall'}
	
<div class="box">
	<div class="box_title">Desinstalar tema: {$data_theme.t_name}</div>
	<div class="box_body clearfix admin-settings">
		
		<form action="{$web.url}/admin?do=themes&action=uninstall&tid={$data_theme.t_id}" method="post" name="sm_uninstall">
			<input type="hidden" value="1" name="uninstall">
		
			<center><h4>&iquest;Realmente deseas desinstalar este tema?</h4></center>
			{*
			<ul>
				<li class="list_item clearfix">
					<label for="t_del">Eliminar archivos del tema (.tpl, .js, .css e im&aacute;genes):</label>	
					<select id="t_del" style="width:100px;" name="t_del" class="inp_text">
						<option value="0">No</option>
						<option value="1">Si</option>
					</select>
				</li>
			</ul>
			*}
			<hr>
			<a href="{$web.url}/admin?do=themes" class="button_1 floatL">Volver</a>
			<input type="button" class="button_1 b_ok floatR" value="Desinstalar tema" onclick="document.forms.sm_uninstall.submit();">
		
		</form>
		
	</div>
	
</div>

{elseif $action == 'aplicar'}
	
<div class="box">
	<div class="box_title">Aplicar tema: {$data_theme.t_name}</div>
	<div class="box_body clearfix admin-settings">
		
		<form action="{$web.url}/admin?do=themes&action=aplicar&tid={$data_theme.t_id}" method="post" name="sm_aplicar">
			<input type="hidden" value="1" name="aplicar">
			
			<span class="item-info margin-top-5"><img src="{$web.icons}/info.png">El contenido de la carpeta de cach&eacute; se eliminar&aacute;.</span>
			
			<br />
			
			<center><h4>&iquest;Realmente deseas aplicar este tema?</h4></center>
			
			<hr>
			<a href="{$web.url}/admin?do=themes" class="button_1 floatL">Volver</a>
			<input type="button" class="button_1 b_ok floatR" value="Aplicar tema" onclick="document.forms.sm_aplicar.submit();">
		
		</form>
		
	</div>
	
</div>

{else}

<div class="box">
	<div class="box_title">Temas</div>
	<div class="box_body clearfix">
	
		{if $status == 'error_uninstall'}
		<span class="item-info error margin-top-5"><img src="{$web.icons}/delete_.png">Error al desinstalar el tema.</span><hr />
		{elseif $status == 'error_aplicar'}
		<span class="item-info error margin-top-5"><img src="{$web.icons}/delete_.png">Error al aplicar el tema.</span><hr />
		{elseif $status == 'ok_uninstall'}
		<span class="item-info ok margin-top-5"><img src="{$web.icons}/ok.png">El tema fue desinstalado correctamente!</span><hr />
		{elseif $status == 'ok_install'}
		<span class="item-info ok margin-top-5"><img src="{$web.icons}/ok.png">El tema fue instalado correctamente!</span><hr />
		{/if}
		
		<div class="box box_main">
			<div class="box_title">Instalados</div>
			<div class="boxy_body">
				<div class="box_content SMnews">
					
					{foreach from=$themes item=t}
					
					<li class="themes">
						<div class="title">
							
							<img src="{$web.url}/themes/{$t.t_seo}/css/img/thumbnail.png" alt="thumbnail" title="theme tumbnail" class="theme_thumb" />
							<h3>{$t.t_name}</h3>
							<span class="ldate">Instalado el {$t.t_install|date_format:"%d/%m/%Y a las %I:%M %p"}</span>
						</div>
						
						<div class="body">Directorio: <strong>{$web.url}/themes/{$t.t_seo}</strong></div>
						
						<div class="body">Dise&ntilde;ado por: <a href="{$t.t_author_link}">{$t.t_author}</a></div>
						
						<div class="body">
							{if $t.t_seo != $web.theme}
								Acciones: 
								<a href="{$web.url}/admin?do=themes&action=uninstall&tid={$t.t_id}">Desinstalar tema</a> - 
								<a href="{$web.url}/admin?do=themes&action=aplicar&tid={$t.t_id}">Aplicar este tema</a>
							{else}
								<strong style="color:#00B147">Tema aplicado</strong>
							{/if}
						</div>
					</li>
									
					{/foreach}
					
				</div>
					
			</div>
		</div>
		
		<hr>
		<a class="button_1 b_ok floatR" href="{$web.url}/admin?do=themes&action=install">Instalar un tema</a>
		
	</div>
</div>

{/if}