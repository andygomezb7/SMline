
	
	<div class="breadcrump clearfix">
		<li class="first"><a href="{$web.url}/mensajes">Mensajes</a></li>
		{if ($data_mp.mp_del_to == 1 && $data_mp.mp_to == $user->uid) || ($data_mp.mp_del_from == 1 && $data_mp.mp_user == $user->uid)}<li><a href="{$web.url}/mensajes/eliminados">Eliminados</a></li>
		{elseif $data_mp.mp_user == $user->uid}<li><a href="{$web.url}/mensajes/enviados">Enviados</a></li>
		{else}<li><a href="{$web.url}/mensajes/recibidos">Recibidos</a></li>{/if}
		<li>{$data_mp.mp_subject}</li>
		<li class="last"></li>
	</div>
	
	<div class="box readMessage">
		
		<div class="box_body" style="position: relative;">
			
			<div class="clearfix bar-menu">
				<div class="floatR">
					{if ($data_mp.mp_del_to == 1 && $data_mp.mp_to == $user->uid) || ($data_mp.mp_del_from == 1 && $data_mp.mp_user == $user->uid)}
					<a class="button_1" style="display: inline-block;" onclick="mps.res({$data_mp.mp_id});"><img src="{$web.icons}/sok.png"/>Restaurar</a>
					<a class="button_1" style="display: inline-block;" onclick="mps.del({$data_mp.mp_id}, false, 1);"><img src="{$web.icons}/delete.png"/>Eliminar por completo</a>
					{else}
					<a class="button_1" style="display: inline-block;" onclick="mps.del({$data_mp.mp_id});"><img src="{$web.icons}/delete.png"/>Eliminar</a>
					{/if}
					{if $data_mp.mp_user != $user->uid}
					<a class="button_1 type_5 stip" style="display: inline-block;" onclick="user.new_report('mensaje', '{$data_mp.mp_subject}', '{$user->get_nick($data_mp.mp_user)}', {$data_mp.mp_id});" title="Reportar mensaje"><img src="{$web.icons}/flag.png" /></a>
					{/if}
				</div>
				
				<div class="floatL">
					{if $data_mp.mp_user == $user->uid}
					<a class="button_1 type_5" style="display: inline-block;" href="{$web.url}/mensajes/enviados">&#171; Volver a enviados</a>
					{elseif ($data_mp.mp_del_to == 1 && $data_mp.mp_to == $user->uid) || ($data_mp.mp_del_from == 1 && $data_mp.mp_user == $user->uid)}
					<a class="button_1 type_5" style="display: inline-block;" href="{$web.url}/mensajes/eliminados">&#171; Volver a eliminados</a>
					{else}<a class="button_1 type_5" style="display: inline-block;" href="{$web.url}/mensajes">&#171; Volver a recibidos</a>{/if}
				</div>
			</div>
		
			<h1 class="post_title mpSubject">{$data_mp.mp_subject}</h1>
			
			<div class="rps-list">
				{foreach from=$data_mp.replies item=r}
				<div id="mp-rpta-id-{$r.rp_id}" class="list-comment clearfix">
					<div class="floatL">
						<a href="{$web.url}/{$r.u_nick}"><img src="{$web.avatar}/{$r.rp_user}_50.jpg?{$r.u_last_avatar}" class="avatar-2"/></a>
					</div>
					<div class="floatR c-body">
						<span class="dialog-comment"></span>
						<div class="comment-info">
							<a href="{$web.url}/{$r.u_nick}" class="hovercard" uid="{$r.rp_user}"><b>{$r.u_nick}</b></a>
							 <span class="stip" title="{$r.rp_date|date_format:"%d/%m/%Y %I:%M %p"}">{$r.rp_date|hace}</span>
						 </div>
						<div class="comment-body">{$r.rp_body}</div>
					</div>
				</div>
				{/foreach}
			</div>
		
			<div class="clearfix">
				<div class="floatL">
					<a href="{$web.url}/{$user->nick}">
						<img src="{$web.url}/avatar/{$user->uid}_50.jpg?{$user->u_last_avatar}" class="avatar-2">
					</a>
				</div>
				<textarea tabindex="3" id="mp_body" class="inp_text newReplie" name="mp_body" autocomplete="off" placeholder="Responde este mensaje"></textarea>
				<div class="floatR margin-top-5">
					<input type="button" class="button_1 b_ok" value="Responder" onclick="mps.send_replie($(this));"/>
				</div>
				<input type="hidden" name="mp_id" value="{$data_mp.mp_id}" />
			</div>
			
		</div>
	</div>
