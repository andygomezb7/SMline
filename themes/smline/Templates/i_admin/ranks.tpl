{if $action == ''}

<div class="box crear-rango-paso-1">
	<div class="box_title">Todos los rangos</div>
	<div class="box_body clearfix" style="padding-top:0;">
		{if $status == 'ok_add'}<span class="item-info ok margin-top-5"><img src="{$web.icons}/ok.png">El rango ha sido agregado!</span>{/if}
		{if $status == 'ok_save'}<span class="item-info ok margin-top-5"><img src="{$web.icons}/ok.png">El rango ha sido editado!</span>{/if}
		<span class="head_text"><span>Rangos especiales</span></span>
		<table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="780" align="center">
            <thead>
				<tr>
					<th></th>
					<th>Rango</th>
					<th>Usuarios</th>
					<th>Puntos para dar</th>
					<th>Anti-flood</th>
					<th>Imagen</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
				{foreach from=$ranks_e item=r}
				<tr>
					<td><a class="cuadrito stip" style="background:#{$r.r_color}" title="Color: #{$r.r_color}"></a></td>
					<td><a href="?do=ranks&action=see&r_id={$r.r_id}">{$r.r_name}</a></td>
					<td>{$r.r_users}</td>
					<td><b>{$r.r_pxd}</b> cada {$web.points_update} hora{if $web.points_update > 1}s{/if}</td>
					<td><b>{$r.r_flood}</b> seg.</td>
					<td><img src="{$web.icons}/ranks/{$r.r_image}"></td>
					<td class="admin_actions">
						<a class="stip" title="editar rango" href="?do=ranks&action=edit&r_id={$r.r_id}"><img src="{$web.icons}/editar.png"></a>
						<a class="stip" title="ver usuarios que tienen el rango" href="?do=ranks&action=see&r_id={$r.r_id}"><img src="{$web.icons}/users.png"></a>
						<a class="stip" title="borrar rango" onclick="admin.ranks.del({$r.r_id});"><img src="{$web.icons}/delete_.png"></a>
					</td>
				</tr>
				{/foreach}
			</tbody>
		</table>

		<span class="head_text"><span>Rangos condicionales</span></span>
		
		<table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="780" align="center">
            <thead>
				<tr>
					<th></th>
					<th>Rango</th>
					<th>Usuarios</th>
					<th>Puntos para dar</th>
					<th>Se obtiene con</th>
					<th>Anti-flood</th>
					<th>Imagen</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
				{foreach from=$ranks_n item=r}
				<tr>
					<td><a class="cuadrito stip" style="background:#{$r.r_color}" title="Color: #{$r.r_color}"></a></td>
					<td><a href="?do=ranks&action=see&r_id={$r.r_id}">{$r.r_name}</a></td>
					<td>{$r.r_users}</td>
					<td><b>{$r.r_pxd}</b> cada {$web.points_update} hora{if $web.points_update > 1}s{/if}</td>
					<td>
						{if $r.r_points_require}<b>{$r.r_points_require}</b> puntos<br />{/if}
					</td>
					<td><b>{$r.r_flood}</b> seg.</td>
					<td><img src="{$web.icons}/ranks/{$r.r_image}"></td>
					<td class="admin_actions">
						<a class="stip" title="Editar rango" href="?do=ranks&action=edit&r_id={$r.r_id}"><img src="{$web.icons}/editar.png"></a>
						<a class="stip" title="Ver usuarios que tienen el rango" href="?do=ranks&action=see&r_id={$r.r_id}"><img src="{$web.icons}/users.png"></a>
						<a class="stip" title="Borrar rango" onclick="admin.ranks.del({$r.r_id});"><img src="{$web.icons}/delete_.png"></a>
					</td>
				</tr>
				{/foreach}
			</tbody>
		</table>
	
		<hr>
		<a href="{$web.url}/admin?do=ranks&action=add" class="button_1 b_ok floatR">Agregar nuevo rango</a>
		
	</div>
	
</div>

{elseif $action == 'see'}

<div class="box crear-rango-paso-1">
	<div class="box_title">Todos los rangos</div>
	<div class="box_body clearfix" style="padding-top:0;">
		<span class="head_text"><span>Usuarios con el rango: {$see_rank.r.0.r_name}</span></span>
		
		<table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="780" align="center">
            <thead>
				<tr>
					<th>Usuario</th>
					<th>Email</th>
					<th>Última vez activo</th>
					<th>Fecha de registro</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
				{if $see_rank.users}
				{foreach from=$see_rank.users item=u}
				<tr>
					<td><a href="{$web.url}/{$u.u_nick}">{$u.u_nick}</a></td>
					<td>{$u.u_email}</td>
					<td><span class="stip" title="{$u.u_last_active|date_format:"%d/%m/%Y %I:%M %p"}">{$u.u_last_active|hace}</span></td>
					<td><span class="stip" title="{$u.u_date|date_format:"%d/%m/%Y %I:%M %p"}">{$u.u_date|hace}</span></td>
					<td class="admin_actions">
						<a class="stip" title="editarle el rango" href="?do=users&action=edit&uid={$u.u_id}"><img src="{$web.icons}/editar.png"></a>
					</td>
				</tr>
				{/foreach}
				{else}
				<tr><td colspan="5"><div id="error">Nadie a obtenido este rango</div></td></tr>
				{/if}
			</tbody>
		</table>
		
		<hr>
		<a href="{$web.url}/admin?do=ranks" class="button_1 floatL">Volver</a>
	</div>
</div>

{elseif $action == 'add' || $action == 'edit'}

<script type="text/javascript" language="javascript" src="{$web.js}/colorPicker.js"></script>
<link rel="stylesheet" href="{$web.css}/colorPicker.css" type="text/css"></link>
{if $rinfo.e.r_id}
<script type="text/javascript">
{literal}
$(document).ready(function(){
$('input#r_name').val('{/literal}{$rinfo.e.r_name}{literal}');
$('input#r_pxd').val('{/literal}{$rinfo.e.r_pxd}{literal}');
$('input#r_flood').val('{/literal}{$rinfo.e.r_flood}{literal}');
$('input#r_color').val('{/literal}{$rinfo.e.r_color}{literal}');
$('select#r_icon').val('{/literal}{$rinfo.e.r_image}{literal}');
$('input#r_points_require').val('{/literal}{$rinfo.e.r_points_require}{literal}');
$('input#r_ppm').val('{/literal}{$rinfo.r.ppm}{literal}');
$('input#r_sprrp').val('{/literal}{$rinfo.r.sprrp}{literal}');
$('input#r_pfm').val('{/literal}{$rinfo.r.pfm}{literal}');
$('input#r_ptm').val('{/literal}{$rinfo.r.ptm}{literal}');
$('input#r_vptm').val('{/literal}{$rinfo.r.vptm}{literal}');
$('input#r_vntm').val('{/literal}{$rinfo.r.vntm}{literal}');
$('input#r_ccsm').val('{/literal}{$rinfo.r.ccsm}{literal}');
$('input#r_pcm').val('{/literal}{$rinfo.r.pcm}{literal}');
$('input#r_emm').val('{/literal}{$rinfo.r.emm}{literal}');
$('input#r_vpcm').val('{/literal}{$rinfo.r.vpcm}{literal}');
$('input#r_vncm').val('{/literal}{$rinfo.r.vncm}{literal}');
$('input#r_vpfm').val('{/literal}{$rinfo.r.vpfm}{literal}');
$('input#r_vnfm').val('{/literal}{$rinfo.r.vnfm}{literal}');
$('input#r_pem').val('{/literal}{$rinfo.r.pem}{literal}');
$('.list_item span').removeClass('button_3');
$('.list_item span').removeClass('b_cancel');
$('.list_item span#goadmin').{/literal}addClass('{if $rinfo.r.goadmin == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.goadmin == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#gomod').{/literal}addClass('{if $rinfo.r.gomod == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.gomod == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#bp').{/literal}addClass('{if $rinfo.r.bp == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.bp == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#ep').{/literal}addClass('{if $rinfo.r.ep == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.ep == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#vpb').{/literal}addClass('{if $rinfo.r.vpb == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.vpb == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#vpr').{/literal}addClass('{if $rinfo.r.vpr == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.vpr == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#apr').{/literal}addClass('{if $rinfo.r.apr == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.apr == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#fp').{/literal}addClass('{if $rinfo.r.fp == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.fp == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#dfp').{/literal}addClass('{if $rinfo.r.dfp == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.dfp == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#bf').{/literal}addClass('{if $rinfo.r.bf == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.bf == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#ef').{/literal}addClass('{if $rinfo.r.ef == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.ef == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#vfb').{/literal}addClass('{if $rinfo.r.vfb == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.vfb == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#be').{/literal}addClass('{if $rinfo.r.be == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.be == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#ee').{/literal}addClass('{if $rinfo.r.ee == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.ee == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#veb').{/literal}addClass('{if $rinfo.r.veb == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.veb == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#scs').{/literal}addClass('{if $rinfo.r.scs == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.scs == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#rcs').{/literal}addClass('{if $rinfo.r.rcs == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.rcs == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#ecs').{/literal}addClass('{if $rinfo.r.ecs == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.ecs == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#ecds').{/literal}addClass('{if $rinfo.r.ecds == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.ecds == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#etds').{/literal}addClass('{if $rinfo.r.etds == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.etds == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#vmcs').{/literal}addClass('{if $rinfo.r.vmcs == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.vmcs == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#bt').{/literal}addClass('{if $rinfo.r.bt == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.bt == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#et').{/literal}addClass('{if $rinfo.r.et == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.et == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#ft').{/literal}addClass('{if $rinfo.r.ft == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.ft == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#dt').{/literal}addClass('{if $rinfo.r.dt == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.dt == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#bc').{/literal}addClass('{if $rinfo.r.bc == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.bc == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#oc').{/literal}addClass('{if $rinfo.r.oc == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.oc == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#ec').{/literal}addClass('{if $rinfo.r.ec == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.ec == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#acc').{/literal}addClass('{if $rinfo.r.acc == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.acc == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#vcb').{/literal}addClass('{if $rinfo.r.vcb == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.vcb == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#su').{/literal}addClass('{if $rinfo.r.su == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.su == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#ru').{/literal}addClass('{if $rinfo.r.ru == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.ru == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#aebn').{/literal}addClass('{if $rinfo.r.aebn == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.aebn == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#ebp').{/literal}addClass('{if $rinfo.r.ebp == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.ebp == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#aebli').{/literal}addClass('{if $rinfo.r.aebli == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.aebli == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#acp').{/literal}addClass('{if $rinfo.r.acp == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.acp == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#acf').{/literal}addClass('{if $rinfo.r.acf == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.acf == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#acm').{/literal}addClass('{if $rinfo.r.acm == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.acm == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#aebc').{/literal}addClass('{if $rinfo.r.aebc == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.aebc == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#aeu').{/literal}addClass('{if $rinfo.r.aeu == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.aeu == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#aebm').{/literal}addClass('{if $rinfo.r.aebm == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.aebm == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#aebr').{/literal}addClass('{if $rinfo.r.aebr == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.aebr == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#abpc').{/literal}addClass('{if $rinfo.r.abpc == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.abpc == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#abib').{/literal}addClass('{if $rinfo.r.abib == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.abib == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#as').{/literal}addClass('{if $rinfo.r.as == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.as == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#pp').{/literal}addClass('{if $rinfo.r.pp == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.pp == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#cp').{/literal}addClass('{if $rinfo.r.cp == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.cp == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#sprr').{/literal}addClass('{if $rinfo.r.sprr == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.sprr == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#bpp').{/literal}addClass('{if $rinfo.r.bpp == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.bpp == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#epp').{/literal}addClass('{if $rinfo.r.epp == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.epp == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#pf').{/literal}addClass('{if $rinfo.r.pf == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.pf == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#efp').{/literal}addClass('{if $rinfo.r.efp == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.efp == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#bfp').{/literal}addClass('{if $rinfo.r.bfp == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.bfp == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#pt').{/literal}addClass('{if $rinfo.r.pt == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.pt == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#etp').{/literal}addClass('{if $rinfo.r.etp == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.etp == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#btp').{/literal}addClass('{if $rinfo.r.btp == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.btp == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#vpt').{/literal}addClass('{if $rinfo.r.vpt == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.vpt == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#vnt').{/literal}addClass('{if $rinfo.r.vnt == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.vnt == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#ccs').{/literal}addClass('{if $rinfo.r.ccs == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.ccs == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#ecsp').{/literal}addClass('{if $rinfo.r.ecsp == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.ecsp == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#bcsp').{/literal}addClass('{if $rinfo.r.bcsp == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.bcsp == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#pc').{/literal}addClass('{if $rinfo.r.pc == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.pc == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#em').{/literal}addClass('{if $rinfo.r.em == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.em == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#cm').{/literal}addClass('{if $rinfo.r.cm == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.cm == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#ecp').{/literal}addClass('{if $rinfo.r.ecp == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.ecp == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#bcp').{/literal}addClass('{if $rinfo.r.bcp == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.bcp == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#vpc').{/literal}addClass('{if $rinfo.r.vpc == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.vpc == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#vnc').{/literal}addClass('{if $rinfo.r.vnc == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.vnc == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#vnf').{/literal}addClass('{if $rinfo.r.vnf == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.vnf == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#vpf').{/literal}addClass('{if $rinfo.r.vpf == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.vpf == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#pe').{/literal}addClass('{if $rinfo.r.pe == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.pe == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#eep').{/literal}addClass('{if $rinfo.r.eep == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.eep == 1}Activado{else}Desactivado{/if}');{literal}
$('.list_item span#bep').{/literal}addClass('{if $rinfo.r.bep == 1}button_3{else}b_cancel{/if}').text('{if $rinfo.r.bep == 1}Activado{else}Desactivado{/if}');{literal}
});
{/literal}
</script>
{/if}

<div class="new-rank">

<div class="box crear-rango-paso-1">
	<div class="box_title">Detalles del rango</div>
	<div class="box_body clearfix admin-settings rank-config">
		
		<ul>
			<li class="list_item clearfix">
				<label for="r_name">Nombre del rango:</label>
				<input type="text" id="r_name" class="inp_text" maxlength="32" name="r_name" value="" style="width:200px;display:inline-block;" autocomplete="off">
			</li>
			
			<li class="list_item clearfix">
				<label for="r_pxd">Puntos para dar:
				<small>Cantidad máxima de puntos que podrán dar en un rango de {$web.points_update} horas.</small>
				</label>
				<input type="text" id="r_pxd" class="inp_text" maxlength="5" name="r_pxd" value="" style="width:45px;display:inline-block;" autocomplete="off">
			</li>
			
			<li class="list_item clearfix">
				<label for="r_points_require">Puntos necesarios:
				<small><b>0</b> si el rango es especial o será asignado a un usuario en específico</small>
				</label>
				<input type="text" id="r_points_require" class="inp_text" maxlength="10" name="r_points_require" value="0" style="width:90px;display:inline-block;" autocomplete="off">
			</li>
			
			<li class="list_item clearfix">
				<label for="r_flood">Anti flood:
				<small>Tiempo que deben esperar entre acción</small>
				</label>
				<input type="text" id="r_flood" class="inp_text" maxlength="4" name="r_flood" value="" style="width:45px;display:inline-block;" autocomplete="off"> segundos
			</li>
			
			<li class="list_item clearfix">
				<label for="r_color">Color del rango:</label>
				<input type="text" id="r_color" class="inp_text" maxlength="7" name="r_color" value="" style="width:70px;display:inline-block;" autocomplete="off" onclick="startColorPicker(this)" onkeyup="maskedHex(this)">
			</li>
			
			<li class="list_item clearfix">
				<label for="r_icon">Icono del rango:</label>	
				<select id="r_icon" style="width:200px;" name="r_icon" class="inp_text" onchange="$('.ra_icon').attr('src', '{$web.icons}/ranks/'+$(this).val())">
					{foreach from=$r_icons item=icon}
					<option value="{$icon}">{$icon}</option>
					{/foreach}
				</select>
				<img src="{$web.icons}/ranks/{if $rinfo.e.r_image}{$rinfo.e.r_image}{else}1.gif{/if}" class="ra_icon"/>
			</li>

		</ul>
		
		<hr>
		<a href="{$web.url}/admin?do=ranks" class="button_1 floatL">Cancelar</a>
		<input type="button" class="button_1 b_ok floatR" value="Siguiente" onclick="$('.crear-rango-paso-1').hide('fast');$('.crear-rango-paso-3').show('slow');">
		
	</div>
	
</div>


<div class="box crear-rango-paso-3" style="display:none;">
	<div class="box_title">Permisos y privilegios del rango</div>
	<div class="box_body clearfix admin-settings rank-config">
		
		<ul>
			
			<li class="list_item type_but clearfix">
				<label for="goadmin">Ingresar al panel de administración:</label>
				<span id="goadmin" onclick="ranks_activate('admin', $(this))" class="b_cancel">Desactivado</span>
			</li>
			
			<li class="list_item type_but clearfix">
				<label for="gomod">Ingresar al panel de moderación:</label>
				<span id="gomod" onclick="ranks_activate('mod', $(this))" class="b_cancel">Desactivado</span>
			</li>
			
			<div class="box_divididos permits_mod" style="width: 50%;float: left;">
				<div class="box_title">Privilegios de moderador</div>
				
				<li class="list_item type_but clearfix">
					<label for="bp">Borrar posts:</label>
					<span id="bp" class="b_cancel">Desactivado</span>
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="ep">Editar posts:</label>
					<span id="ep" class="b_cancel">Desactivado</span>
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="vpb">Ver posts borrados:</label>
					<span id="vpb" class="b_cancel">Desactivado</span>
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="vpr">Ver posts en revisión:</label>
					<span id="vpr" class="b_cancel">Desactivado</span>
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="apr">Aprobar posts en revisión:</label>
					<span id="apr" class="b_cancel">Desactivado</span>
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="fp">Fijar posts:</label>
					<span id="fp" class="b_cancel">Desactivado</span>
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="dfp">Desfijar posts:</label>
					<span id="dfp" class="b_cancel">Desactivado</span>
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="bf">Borrar imágenes:</label>
					<span id="bf" class="b_cancel">Desactivado</span>
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="ef">Editar imágenes:</label>
					<span id="ef" class="b_cancel">Desactivado</span>
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="vfb">Ver imágenes borradas:</label>
					<span id="vfb" class="b_cancel">Desactivado</span>
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="be">Borrar estados:</label>
					<span id="be" class="b_cancel">Desactivado</span>
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="ee">Editar estados:</label>
					<span id="ee" class="b_cancel">Desactivado</span>
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="veb">Ver estados borrados:</label>
					<span id="veb" class="b_cancel">Desactivado</span>
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="scs">Suspender comunidades:</label>
					<span id="scs" class="b_cancel">Desactivado</span>
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="rcs">Reactivar comunidades:</label>
					<span id="rcs" class="b_cancel">Desactivado</span>
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="ecs">Editar comunidades:</label>
					<span id="ecs" class="b_cancel">Desactivado</span>
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="vmcs">Editar miembros en comunidades:</label>
					<span id="vmcs" class="b_cancel">Desactivado</span>
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="bt">Borrar temas:</label>
					<span id="bt" class="b_cancel">Desactivado</span>
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="et">Editar temas:</label>
					<span id="et" class="b_cancel">Desactivado</span>
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="ft">Fijar temas:</label>
					<span id="ft" class="b_cancel">Desactivado</span>
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="dt">Desfijar temas:</label>
					<span id="dt" class="b_cancel">Desactivado</span>
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="bc">Borrar comentarios:</label>
					<span id="bc" class="b_cancel">Desactivado</span>
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="oc">Ocultar comentarios:</label>
					<span id="oc" class="b_cancel">Desactivado</span>
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="ec">Editar comentarios:</label>
					<span id="ec" class="b_cancel">Desactivado</span>
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="acc">Abrir/cerrar comentarios:</label>
					<span id="acc" class="b_cancel">Desactivado</span>
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="vcb">Ver comentarios borrados:</label>
					<span id="vcb" class="b_cancel">Desactivado</span>
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="su">Suspender usuarios:</label>
					<span id="su" class="b_cancel">Desactivado</span>
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="ru">Reactivar usuarios:</label>
					<span id="ru" class="b_cancel">Desactivado</span>
				</li>
			</div>
			
			<div class="box_divididos permits_admin" style="width: 50%;float: left;">
				<div class="box_title">Privilegios de administrador</div>
				
				<li class="list_item type_but clearfix">
					<label for="ecds">Editar configuraciones del sitio:</label>
					<span id="ecds" class="b_cancel">Desactivado</span>
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="etds">Administrar temas:</label>
					<span id="etds" class="b_cancel">Desactivado</span>
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="aebn">Administrar noticias:</label>
					<span id="aebn" class="b_cancel">Desactivado</span>
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="ebp">Administrar banners:</label>
					<span id="ebp" class="b_cancel">Desactivado</span>
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="aebli">Administrar links de interés:</label>
					<span id="aebli" class="b_cancel">Desactivado</span>
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="acp">Administrar posts:</label>
					<span id="acp" class="b_cancel">Desactivado</span>
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="acf">Administrar imágenes:</label>
					<span id="acf" class="b_cancel">Desactivado</span>
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="acm">Administrar mensajes:</label>
					<span id="acm" class="b_cancel">Desactivado</span>
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="aebc">Administrar categorías:</label>
					<span id="aebc" class="b_cancel">Desactivado</span>
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="aeu">Administrar usuarios:</label>
					<span id="aeu" class="b_cancel">Desactivado</span>
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="aebm">Administrar medallas:</label>
					<span id="aebm" class="b_cancel">Desactivado</span>
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="aebr">Administrar rangos:</label>
					<span id="aebr" class="b_cancel">Desactivado</span>
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="abpc">Administrar palabras censuradas:</label>
					<span id="abpc" class="b_cancel">Desactivado</span>
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="abib">Administrar bloqueos:</label>
					<span id="abib" class="b_cancel">Desactivado</span>
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="as">Administrar estadísticas:</label>
					<span id="as" class="b_cancel">Desactivado</span>
				</li>
			</div>
			
			<hr style="clear:both"/>
			
			<div >
				<div class="box_title">Permisos del rango</div>
				
				<li class="list_item type_but clearfix">
					<label for="pp">Publicar post:</label>
					<span id="pp" class="button_3">Activado</span>
					 máximo <input type="text" id="r_ppm" class="inp_text" maxlength="10" name="ppm" value="5" style="width:30px;display:inline-block;" autocomplete="off"> posts por hora.
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="cp" class="etip" title="Antes de publicar un post, deberán ingresar el código de seguridad">Captcha en posts:</label>
					<span id="cp" class="b_cancel">Desactivado</span>
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="sprr" class="etip" title="Sus posts serán revisados por un moderador antes de ser publicados">Sus posts requieren de revisión:</label>
					<span id="sprr" class="b_cancel">Desactivado</span>
					 máximo <input type="text" id="r_sprrp" class="inp_text" maxlength="5" name="sprrp" value="3" style="width:30px;display:inline-block;" autocomplete="off"> posts.
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="bpp">Borrar posts propios:</label>
					<span id="bpp" class="button_3">Activado</span>
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="epp">Editar posts propios:</label>
					<span id="epp" class="button_3">Activado</span>
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="pf">Publicar imágenes:</label>
					<span id="pf" class="button_3">Activado</span>
					 máximo <input type="text" id="r_pfm" class="inp_text" maxlength="10" name="pfm" value="15" style="width:30px;display:inline-block;" autocomplete="off"> imágenes por hora.
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="efp">Editar imágenes propias:</label>
					<span id="efp" class="button_3">Activado</span>
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="bfp">Borrar imágenes propias:</label>
					<span id="bfp" class="button_3">Activado</span>
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="vpf">Votar positivo en imágenes:</label>
					<span id="vpf" class="button_3">Activado</span>
					 máximo <input type="text" id="r_vpfm" class="inp_text" maxlength="10" name="vpfm" value="30" style="width:30px;display:inline-block;" autocomplete="off"> votos positivos por hora.
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="vnf">Votar negativo en imágenes:</label>
					<span id="vnf" class="button_3">Activado</span>
					 máximo <input type="text" id="r_vnfm" class="inp_text" maxlength="10" name="vnfm" value="5" style="width:30px;display:inline-block;" autocomplete="off"> votos negativos por hora.
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="pt">Publicar temas:</label>
					<span id="pt" class="button_3">Activado</span>
					 máximo <input type="text" id="r_ptm" class="inp_text" maxlength="10" name="ptm" value="15" style="width:30px;display:inline-block;" autocomplete="off"> temas por hora.
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="etp">Editar temas propios:</label>
					<span id="etp" class="button_3">Activado</span>
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="btp">Borrar temas propios:</label>
					<span id="btp" class="button_3">Activado</span>
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="vpt">Votar positivo en temas:</label>
					<span id="vpt" class="button_3">Activado</span>
					 máximo <input type="text" id="r_vptm" class="inp_text" maxlength="10" name="vptm" value="30" style="width:30px;display:inline-block;" autocomplete="off"> votos positivos por hora.
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="vnt">Votar Negativo en temas:</label>
					<span id="vnt" class="button_3">Activado</span>
					 máximo <input type="text" id="r_vntm" class="inp_text" maxlength="10" name="vntm" value="5" style="width:30px;display:inline-block;" autocomplete="off"> votos negativos por hora.
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="ccs">Crear comunidades:</label>
					<span id="ccs" class="button_3">Activado</span>
					 máximo <input type="text" id="r_ccsm" class="inp_text" maxlength="3" name="ccsm" value="3" style="width:30px;display:inline-block;" autocomplete="off"> comunidades.
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="ecsp">Editar comunidades propias:</label>
					<span id="ecsp" class="button_3">Activado</span>
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="bcsp">Borrar comunidades propias:</label>
					<span id="bcsp" class="button_3">Activado</span>
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="pc" class="etip" title="Válido para comentarios en posts, imágenes, temas y estados">Publicar comentarios:</label>
					<span id="pc" class="button_3">Activado</span>
					 máximo <input type="text" id="r_pcm" class="inp_text" maxlength="10" name="pcm" value="50" style="width:30px;display:inline-block;" autocomplete="off"> comentarios por hora.
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="em">Enviar mensajes:</label>
					<span id="em" class="button_3">Activado</span>
					 máximo <input type="text" id="r_emm" class="inp_text" maxlength="10" name="emm" value="10" style="width:30px;display:inline-block;" autocomplete="off"> mensajes por hora.
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="cm" class="etip" title="Antes de enviar un mensaje, deberán ingresar el código de seguridad">Captcha en mensajes:</label>
					<span id="cm" class="b_cancel">Desactivado</span>
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="ecp">Editar comentarios propios:</label>
					<span id="ecp" class="button_3">Activado</span>
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="bcp">Borrar comentarios propios:</label>
					<span id="bcp" class="button_3">Activado</span>
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="vpc">Votar positivo en comentarios:</label>
					<span id="vpc" class="button_3">Activado</span>
					 máximo <input type="text" id="r_vpcm" class="inp_text" maxlength="10" name="vpcm" value="30" style="width:30px;display:inline-block;" autocomplete="off"> votos positivos por hora.
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="vnc">Votar Negativo en comentarios:</label>
					<span id="vnc" class="button_3">Activado</span>
					 máximo <input type="text" id="r_vncm" class="inp_text" maxlength="10" name="vncm" value="5" style="width:30px;display:inline-block;" autocomplete="off"> votos negativos por hora.
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="pe">Publicar estados:</label>
					<span id="pe" class="button_3">Activado</span>
					 máximo <input type="text" id="r_pem" class="inp_text" maxlength="10" name="pem" value="15" style="width:30px;display:inline-block;" autocomplete="off"> estados por hora.
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="eep">Editar estados propios:</label>
					<span id="eep" class="button_3">Activado</span>
				</li>
				
				<li class="list_item type_but clearfix">
					<label for="bep">Borrar estados propios:</label>
					<span id="bep" class="button_3">Activado</span>
				</li>

			</div>
			
		</ul>
		
		<hr>
		<input type="button" class="button_2 floatL" value="Anterior" onclick="$('.crear-rango-paso-3').hide('fast');$('.crear-rango-paso-1').show('slow');">
		{if $rinfo.e.r_id}<a class="button_1 b_ok floatR" onclick="admin.ranks.save({$rinfo.e.r_id});">Guardar cambios</a>
		{else}<a class="button_1 b_ok floatR" onclick="admin.ranks.add();">Agregar rango</a>{/if}
		
	</div>
	
</div>

</div>
{/if}