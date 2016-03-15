{if $action == ''}
<div class="box">
	<div class="box_title">Palabras censuradas</div>
	<div class="box_body clearfix admin-settings">
		{if $status == 'ok_add'}<span class="item-info ok margin-top-5"><img src="{$web.icons}/ok.png">La censura ha sido agregada!</span>
		{else}<span class="item-info margin-top-5"><img src="{$web.icons}/info.png">Con esta función podrás evitar spam e insultos en tu web</span>
		{/if}
		
		<table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="780" align="center">
            <thead>
				<tr>
					<th>Censuar</th>
					<th>Por</th>
					<th>Conflictiva</th>
					<th>Admin.</th>
					<th>Fecha</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
				{foreach from=$censored item=c}
				<tr id="c-id-{$c.c_id}">
					<td>{$c.c_val}</td>
					<td>{$c.c_por}</td>
					<td>{if $c.c_ireplace}<span class="color-red">Si</span>{else}No{/if}</td>
					<td><a href="{$web.url}/{$c.u_nick}">{$c.u_nick}</a></td>
					<td><span class="stip" title="{$c.c_date|date_format:"%d/%m/%Y %I:%M %p"}">{$c.c_date|hace}</span></td>
					<td class="admin_actions">
						<a class="stip" title="Remover censura" onclick="admin.cens.del({$c.c_id});"><img src="{$web.icons}/delete_.png"></a>
					</td>
				</tr>
				{/foreach}
				{if !$censored}<tr><td colspan="6"><div id="error">No hay censuras en {$web.title}</div></td></tr>{/if}
			</tbody>
		</table>
		
		<hr />
		<a href="{$web.url}/admin?do=censored&action=add" class="button_1 b_ok floatR">Censurar palabra</a>
		
	</div>
</div>
{elseif $action == 'add'}
<div class="box">
	<div class="box_title">Censurar palabra</div>
	<div class="box_body clearfix admin-settings">
		
		<ul>
			<li class="list_item clearfix">
				<label for="c_val">Palabra a censurar:</label>
				<input type="text" id="c_val" class="inp_text" name="c_val" autocomplete="off" style="display:inline-block;">
			</li>
			
			<li class="list_item clearfix">
				<label for="c_por">Reemplazar por:</label>
				<input type="text" id="c_por" class="inp_text" name="c_por" autocomplete="off" style="display:inline-block;">
			</li>
			
			<li class="list_item clearfix">
				<label for="c_ireplace">Conflictiva:</label>	
				<select id="c_ireplace" style="width:100px;" name="c_ireplace" class="inp_text">
					<option value="1">Si</option>
					<option value="0">No</option>
				</select>
			</li>
		</ul>
		
		<hr>
		<a href="{$web.url}/admin?do=censored" class="button_1 floatL">Volver</a>
		<input type="button" class="button_1 b_ok floatR" value="Censurar palabra" onclick="admin.cens.add();">
		
	</div>
	
</div>
{/if}