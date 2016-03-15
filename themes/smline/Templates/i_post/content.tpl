{if $post.p_status == 0 && $user->permits['vpb']}<div class="item-info error" style="margin-bottom:5px">Este post se encuentra actualmente <b>eliminado</b>. Tus privilegios de rango te permiten visualizar posts eliminados.</div>{elseif $post.p_status == 2 && $user->permits['vpr']}<div class="item-info" style="margin-bottom:5px"><img src="{$web.icons}/info.png">Este post se encuentra actualmente en <b>revisi&oacute;n</b>. Tus privilegios de rango te permiten visualizar posts en revisi&oacute;n. Recuerda que en tus deberes como moderador incluye el revisar y aprobar posts.</div>{/if}<h1 class="post_title">{$post.p_title}</h1>	<div class="post-head-info clearfix">		<span class="post_date"><a class="stip" title="{$post.p_date|date_format:"%d/%m/%Y %I:%M %p"}">{$post.p_date|hace}</a> | <a href="{$web.url}/posts/{$post.c_seo}">{$post.c_name}</a></span>		<div class="actions_follow_and_fav">			<div id="follows-buttons" data-type="posts" type-id="{$post.p_id}" style="display:inline-block;">				<a class="button_1 to_follow require-login" style="{if $user->is_following('post', $post.p_id)}display:none;{/if}"><img src="{$web.icons}/follow.png"/>Seguir post</a>				<a class="button_3 ok_follow" style="{if !$user->is_following('post', $post.p_id)}display:none;{/if}">Siguiendo</a>				<a class="b_cancel un_follow" style="display:none;">Dejar de seguir</a>			</div>						{if $post.p_user != $user->uid && !$user->permits['goadmin'] && !$user->permits['gomod']}			<a class="button_1 type_5 stip require-login" onclick="user.new_report('post', '{$post.p_title}', '{$post.u_nick}', {$post.p_id});" title="Reportar post"><img src="{$web.icons}/flag.png" /></a>			{/if}						{if $post.p_user != $user->uid}			<a class="button_1 post_add_fav require-login" onclick="{if $user->uid}post.fav(0);return false;{/if}" href="#" style="{if $post.p_is_fav}display:none;{/if}"><img src="{$web.icons}/heart_10.png"/>Agregar a favoritos</a>			<a class="button_1 post_remove_fav" onclick="post.fav(1);" style="{if !$post.p_is_fav}display:none;{/if}"><img src="{$web.icons}/heart_10.png"/>Borrar de favoritos</a>			{/if}									{if ($post.u_id == $user->uid && ($user->permits['bpp'] || $user->permits['epp'])) || $user->permits['bp'] || $user->permits['ep'] || $user->permits['apr'] || $user->permits['fp']}			<a class="button_1 post_options" onclick="$('.list_options').toggle(400);">Opciones</a>			<ul class="list_options">				{if $post.p_status == 0 && ($post.u_id != $user->uid || $user->permits['goadmin']) && $user->permits['vpb']}					<li><a onclick="mod.reac('posts', {$post.p_id});"><img src="{$web.icons}/sok.png"/> Reactivar post</a></li>				{elseif $post.u_id == $user->uid && $user->permits['bpp'] && $post.p_status != 0}					<li><a onclick="post.del({$post.p_id});"><img src="{$web.icons}/delete.png"/> Borrar post</a></li>				{elseif $user->permits['bp'] && $post.p_status != 0}					<li><a onclick="mod.del('posts', {$post.p_id});"><img src="{$web.icons}/delete.png"/> Borrar post</a></li>				{/if}				{if ($post.u_id == $user->uid && $user->permits['epp']) || $user->permits['ep']}					<li><a href="{$web.url}/agregar-post?pid={$post.p_id}"><img src="{$web.icons}/edit.png"/> Editar post</a></li>				{/if}				{if $user->permits['apr'] && $post.p_status != 2}					<li><a onclick="mod.revise('posts', {$post.p_id});"><img src="{$web.icons}/cross.png"/> Mandar a revisión</a></li>				{/if}				{if $user->permits['apr'] && $post.p_status == 2}					<li><a onclick="mod.approve('posts', {$post.p_id});"><img src="{$web.icons}/blue_ball.png"/> Aprobar post</a></li>				{/if}				{if $user->permits['fp'] && $post.p_sticky == 0}					<li><a onclick="mod.add_sticky('posts', {$post.p_id});"><img src="{$web.icons}/sticky.png"/> Fijar post</a></li>				{/if}				{if $user->permits['dfp'] && $post.p_sticky == 1}					<li><a onclick="mod.remove_sticky('posts', {$post.p_id});"><img src="{$web.icons}/sticky.png"/> Desfijar post</a></li>				{/if}			</ul>			{/if}											</div>	</div>		{if $post.history}	<div class="post-mod-history">		<center><h3>Historial de moderación del post			<a onclick="$('.post-mod-history table').toggle();" class="floatR" title="Ocultar/Mostrar"><i class="icon expand"></i></a>		</h3></center>		<table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="718" align="center">            <thead>				<tr>					<th>Moderador</th>					<th>Acción</th>					<th>Razón</th>					<th>Fecha</th>				</tr>			</thead>			<tbody>				{foreach from=$post.history item=h}				<tr>					<td><a href="{$web.url}/{$h.u_nick}"><b>{$h.u_nick}</b></a></td>					<td>						{if $h.h_action == 1}<span class="color-red">borró el post</span> 						{elseif $h.h_action == 2}<span class="color-green">reactivó el post</span>						{elseif $h.h_action == 3}<span class="color-gray">editó el post</span>						{elseif $h.h_action == 4}<span class="color-indigo">a revisión</span>						{elseif $h.h_action == 5}<span class="color-coral">aprobó el post</span>						{elseif $h.h_action == 6}<span class="color-blue">fijó el post</span>						{elseif $h.h_action == 7}<span class="color-deeppink">desfijó el post</span>						{/if}					</td>					<td>{$h.h_reason}</td>					<td>{$h.h_date|hace}</td>				</tr>				{/foreach}			</tbody>		</table>	</div>	{/if}	<div class="box_body post_content margin-top-5 clearfix">				{$post.p_body}		<hr class="hr-dashed"/>								<span class="share-title">Recomienda este post a tus amigos.</span>		<script type="text/javascript">var switchTo5x=true;</script>		<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>		<script type="text/javascript">{literal}stLight.options({publisher: "f9eaeb68-1fbe-46ad-9970-5ad61d3aa753", doNotHash: false, doNotCopy: false, hashAddressBar: false});{/literal}</script>		<div class="post-share-bottom">			<span class="st_email_hcount" displayText="Email"></span>			<span class="st_linkedin_hcount" displayText="LinkedIn"></span>			<span class="st_googleplus_hcount" displayText="Google +"></span>			<span class="st_twitter_hcount" displayText="Tweet"></span>			<span class="st_facebook_hcount" displayText="Facebook"></span>			<span class="number-share-t unrated">				<a onclick="{if $user->uid}post.share();return false;{/if}" href="#" class="share-t require-login"></a>				<span class="count-shareds">					<span class="shar-pico"></span>					<span class="total-share">{$post.p_shared}</span>				</span>			</span>		</div>		{if $user->info.u_points_ava && $post.u_id != $user->uid}		<div class="dar-puntos floatR">			<span class="item-info ok margin-top-5" style="display:none"><img src="{$web.icons}/ok.png"> Puntos agregados!</span>			<center>			<span class="share-title center">Califica este post.</span>			{for $x=1; $x<=$user->info.u_points_ava; $x++}			<a class="dar-pts-{$x}" onclick="post.puntuar({$x})">{if $x == 10}+{/if}{$x}</a>			{/for}			</center>		</div>		{elseif $user->uid && $post.u_id != $user->uid}		<div style="clear: both"></div>		<div class="dar-puntos">			<span class="item-info margin-top-5"><img src="{$web.icons}/info.png"> No tienes puntos para dar por el momento, tus puntos se recargan en {if $post.horas_recarga}{$post.horas_recarga}{else}una{/if} hora{if $post.horas_recarga > 1}s{/if}</span>		</div>		{/if}			</div>		<div class="post-head-info pbottom margin-top-10 clearfix">		<ul class="post-metadata">			<li class="floatL">				<i class="icon coins"></i><b id="total-puntos">{$post.p_puntos}</b> Puntos			</li>			<li class="floatL">				<i class="icon heart"></i><b id="post-total-favs">{$post.p_favs}</b> Favoritos			</li>			<li class="floatL">				<i class="icon comments"></i><b id="post-total-comment">{$post.p_comments}</b> Comentarios			</li>			<li class="floatL">				<i class="icon eye"></i><b>{$post.p_follows}</b> Seguidores			</li>			<li class="floatL">				<i class="icon hits"></i><b>{$post.p_hits}</b> Visitas			</li>		</ul>	</div>