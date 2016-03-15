<script type="text/javascript">
{literal}
$(document).ready(function(){
$('.list_item span#r_offline').{/literal}addClass('{if $web.offline == 1}button_3{else}b_cancel{/if}').text('{if $web.offline == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#r_welcome').{/literal}addClass('{if $web.welcome == 1}button_3{else}b_cancel{/if}').text('{if $web.welcome == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#r_reg_active').{/literal}addClass('{if $web.reg_active == 1}button_3{else}b_cancel{/if}').text('{if $web.reg_active == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#r_recover_active').{/literal}addClass('{if $web.recover_active == 1}button_3{else}b_cancel{/if}').text('{if $web.recover_active == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#r_active_user').{/literal}addClass('{if $web.active_user == 1}button_3{else}b_cancel{/if}').text('{if $web.active_user == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#r_live').{/literal}addClass('{if $web.live == 1}button_3{else}b_cancel{/if}').text('{if $web.live == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#r_port_posts').{/literal}addClass('{if $web.port_posts == 1}button_3{else}b_cancel{/if}').text('{if $web.port_posts == 1}Activado{else}Desactivado{/if}');{literal}
$('.settings-no-load').fadeIn(450);
$('.settings-loading').remove();
});
{/literal}
</script>

<div class="box">
	<div class="box_title">Configuraciones del sitio</div>
	<div class="box_body clearfix admin-settings">
		<span class="item-info"><img src="{$web.icons}/info.png" />Haz click sobre la configuración que quieres editar y presiona enter para guardar cambios.</span>
		<hr />
		<center class="settings-loading"><img src="{$web.img}/loading.gif" /></center>
		<ul style="display:none;" class="settings-no-load">
		
			<li class="list_item type_text clearfix">
				<label id="r_title">Título de la web:</label>
				<span id="r_title">{$web.title}</span><input type="text" id="r_title" class="inp_text" maxlength="40" value="{$web.title}" autocomplete="off">
			</li>
			
			<li class="list_item type_text clearfix">
				<label id="r_slogan">Lema de la web:</label>
				<span id="r_slogan">{$web.slogan}</span><input type="text" id="r_slogan" class="inp_text" maxlength="40" value="{$web.slogan}" autocomplete="off">
			</li>
			
			<li class="list_item type_text clearfix">
				<label id="r_url">URL de la web:</label>
				<span id="r_url">{$web.url}</span><input type="text" id="r_url" class="inp_text" maxlength="40" value="{$web.url}" autocomplete="off">
			</li>
			
			<li class="list_item type_text clearfix">
				<label id="r_descripcion">Descripción del sitio:<small>Descripción de los contenidos de tu web para Google, Bing, Yahoo etc</small></label>
				<span id="r_descripcion">{$web.descripcion}</span><input type="text" id="r_descripcion" class="inp_text" maxlength="300" value="{$web.descripcion}" autocomplete="off">
			</li>
			
			<li class="list_item type_text clearfix">
				<label id="r_tags">Tags del sitio:<small>Etiquetas o keywords que identifiquen tu web para Google, Bing, Yahoo etc</small></label>
				<span id="r_tags">{$web.tags}</span><input type="text" id="r_tags" class="inp_text" maxlength="300" value="{$web.tags}" autocomplete="off">
			</li>
			
			<li class="list_item type_but clearfix">
				<label id="r_offline">Mantenimiento:</label>
				<span id="r_offline" class="">Desactivado</span>
			</li>
			
			<li class="list_item type_text clearfix">
				<label id="r_offline_message">Mensaje de mantenimiento:</label>
				<span id="r_offline_message">{$web.offline_message}</span><input type="text" id="r_offline_message" style="width:370px;" class="inp_text" maxlength="300" value="{$web.offline_message}" autocomplete="off">
			</li>
			
			<li class="list_item type_but clearfix">
				<label id="r_welcome">Dar bienvenida:</label>
				<span id="r_welcome" class="">Desactivado</span>
			</li>
			
			<li class="list_item type_text clearfix">
				<label id="r_welcome_message">Mensaje de bienvenida:</label>
				<span id="r_welcome_message">{$web.welcome_message}</span><input type="text" id="r_welcome_message" style="width:370px;" class="inp_text" maxlength="300" value="{$web.welcome_message}" autocomplete="off">
			</li>
			
			<li class="list_item type_text clearfix">
				<label id="r_user_robot">ID de usuario "robot":</label>
				<span id="r_user_robot">{$web.user_robot}</span><input type="text" id="r_user_robot" class="inp_text" maxlength="12" value="{$web.user_robot}" style="width:110px;" autocomplete="off">
			</li>
			
			<li class="list_item type_but clearfix">
				<label id="r_reg_active">Registro:</label>
				<span id="r_reg_active" class="button_3">Activado</span>
			</li>
			
			<li class="list_item type_but clearfix">
				<label id="r_active_user">Activación de cuentas por e-mail:</label>
				<span id="r_active_user" class="">Desactivado</span>
			</li>
			
			<li class="list_item type_but clearfix">
				<label id="r_recover_active">Recuperación de cuentas por e-mail:</label>
				<span id="r_recover_active" class="">Activado</span>
			</li>
			
			<li class="list_item type_text clearfix">
				<label id="r_min_age">Edad requerida:</label>
				<span id="r_min_age">{$web.min_age}</span><input type="text" id="r_min_age" class="inp_text" maxlength="2" value="{$web.min_age}" style="width:20px;" autocomplete="off"> años.
			</li>
			
			<li class="list_item type_text clearfix">
				<label id="r_points_update">Actualizar/Recargar puntos cada:</label>
				<span id="r_points_update">{$web.points_update}</span><input type="text" id="r_points_update" class="inp_text" maxlength="3" value="{$web.points_update}" style="width:20px;" autocomplete="off"> horas.
			</li>
			
			<li class="list_item type_but clearfix">
				<label id="r_live">Notificaciones en vivo:</label>
				<span id="r_live" class="">Activado</span>
			</li>
			
			<li class="list_item type_text clearfix">
				<label id="r_live_timeout">Comprobar nuevas notificaciones cada:</label>
				<span id="r_live_timeout">{$web.live_timeout}</span><input type="text" id="r_live_timeout" class="inp_text" maxlength="2" value="{$web.live_timeout}" style="width:20px;" autocomplete="off"> segundos.
			</li>
			
			<li class="list_item type_but clearfix">
				<label id="r_port_posts">Home con portadas:<small>Los últimos posts en el inicio mostrarán su imágen de portada</small></label>
				<span id="r_port_posts" class="">Activado</span>
			</li>
			
			<li class="list_item type_text clearfix">
				<label id="r_user_online">Usuario online:</label>
				<span id="r_user_online">{$web.user_online}</span><input type="text" id="r_user_online" class="inp_text" maxlength="2" value="{$web.user_online}" style="width:20px;" autocomplete="off"> minutos.
			</li>
			
			<li class="list_item type_text clearfix">
				<label id="r_max_posts">Posts por página:</label>
				<span id="r_max_posts">{$web.max_posts}</span><input type="text" id="r_max_posts" class="inp_text" maxlength="2" value="{$web.max_posts}" style="width:20px;" autocomplete="off"> posts.
			</li>
			
			<li class="list_item type_text clearfix">
				<label id="r_max_comm">Comentarios por post:</label>
				<span id="r_max_comm">{$web.max_comm}</span><input type="text" id="r_max_comm" class="inp_text" maxlength="2" value="{$web.max_comm}" style="width:20px;" autocomplete="off"> comentarios.
			</li>
			
		</ul>
		
	</div>
</div>