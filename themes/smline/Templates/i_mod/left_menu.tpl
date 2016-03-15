			
			<div class="left_menu">
				<div class="menu_head">
					Usuarios
				</div>
				<div class="menu_list{if $do == 'usuarios_suspendidos'} active{/if}">
					<a href="{$web.url}/mod?do=usuarios_suspendidos">
						Suspendidos
						<span class="count_info">{$global_data.usuarios_suspendidos}</span>
					</a>
				</div>
				<div class="menu_list{if $do == 'usuarios_reportados'} active{/if}">
					<a href="{$web.url}/mod?do=usuarios_reportados">
						Reportados
						<span class="count_info">{$global_data.usuarios_reportados}</span>
					</a>
				</div>
			</div>
			
			<div class="form_separador"></div>
			
			<div class="left_menu">
				<div class="menu_head">
					Posts
				</div>
				<div class="menu_list{if $do == 'posts_aprobar'} active{/if}">
					<a href="{$web.url}/mod?do=posts_aprobar">
						Esperando aprobaci&oacute;n
						<span class="count_info">{$global_data.posts_aprobar}</span>
					</a>
				</div>
				<div class="menu_list{if $do == 'posts_eliminados'} active{/if}">
					<a href="{$web.url}/mod?do=posts_eliminados">
						Eliminados
						<span class="count_info">{$global_data.posts_eliminados}</span>
					</a>
				</div>
				<div class="menu_list{if $do == 'posts_reportados'} active{/if}">
					<a href="{$web.url}/mod?do=posts_reportados">
						Reportados
						<span class="count_info">{$global_data.posts_reportados}</span>
					</a>
				</div>
			</div>
			
			<div class="form_separador"></div>
			
			<div class="left_menu">
				<div class="menu_head">
					Im&aacute;genes
				</div>
				<div class="menu_list{if $do == 'imagenes_eliminadas'} active{/if}">
					<a href="{$web.url}/mod?do=imagenes_eliminadas">
						Eliminadas
						<span class="count_info">{$global_data.imagenes_eliminadas}</span>
					</a>
				</div>
				<div class="menu_list{if $do == 'imagenes_reportadas'} active{/if}">
					<a href="{$web.url}/mod?do=imagenes_reportadas">
						Reportadas
						<span class="count_info">{$global_data.imagenes_reportadas}</span>
					</a>
				</div>
			</div>
			
			<div class="form_separador"></div>
			
			<div class="left_menu">
				<div class="menu_head">
					Comunidades
				</div>
				<div class="menu_list{if $do == 'comus_suspendidas'} active{/if}">
					<a href="{$web.url}/mod?do=comus_suspendidas">
						Suspendidas
						<span class="count_info">{$global_data.comus_suspendidas}</span>
					</a>
				</div>
				<div class="menu_list{if $do == 'comus_reportadas'} active{/if}">
					<a href="{$web.url}/mod?do=comus_reportadas">
						Reportadas
						<span class="count_info">{$global_data.comus_reportadas}</span>
					</a>
				</div>
			</div>
			
			<div class="form_separador"></div>
			
			<div class="left_menu">
				<div class="menu_head">
					Temas
				</div>
				<div class="menu_list{if $do == 'temas_eliminados'} active{/if}">
					<a href="{$web.url}/mod?do=temas_eliminados">
						Eliminados
						<span class="count_info">{$global_data.temas_eliminados}</span>
					</a>
				</div>
				<div class="menu_list{if $do == 'temas_reportados'} active{/if}">
					<a href="{$web.url}/mod?do=temas_reportados">
						Reportados
						<span class="count_info">{$global_data.temas_reportados}</span>
					</a>
				</div>
			</div>
			
			<div class="form_separador"></div>
			
			<div class="left_menu">
				<div class="menu_head">
					Mensajes
				</div>
				<div class="menu_list">
					<a href="{$web.url}/mod?do=mensajes_reportados">
						Reportados
						<span class="count_info">{$global_data.mensajes_reportados}</span>
					</a>
				</div>
			</div>
			
			<div class="form_separador"></div>