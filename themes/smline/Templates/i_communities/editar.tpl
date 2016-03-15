<script src="{$web.js}/jquery.imgareaselect.js" type="text/javascript"></script><link href="{$web.css}/img_area_select/imgareaselect.css" rel="stylesheet" type="text/css"><link href="{$web.css}/add_comu.css" rel="stylesheet" type="text/css"><link href="{$web.css}/comu.css" rel="stylesheet" type="text/css"><div class="breadcrump clearfix">	<li class="first"><a href="/comunidades" title="Comunidades">Comunidades</a></li>	<li><a href="/comunidades/home/{$comu.c_seo}" title="{$comu.c_name}">{$comu.c_name}</a></li>	<li><a href="/comunidades/{$comu.comu_seo}/" title="{$comu.comu_name}">{$comu.comu_name}</a></li>	<li>Editar</li>	<li class="last"></li></div><script type="text/javascript" language="javascript" src="{$web.js}/colorPicker.js"></script><link rel="stylesheet" href="{$web.css}/colorPicker.css" type="text/css"></link><div id="main-col">	<div class="post-create">		<ul class="clearfix">			<li class="list_item">				<label class="normal_label" for="comu_name">Nombre</label>				<input type="text" tabindex="1" id="comu_name" class="inp_text" name="comu_name" value="{$comu.comu_name}" autocomplete="off">			</li>			<li class="list_item">				<label class="normal_label" for="comu_seo">Nombre corto</label>				<input type="text" tabindex="2" id="comu_seo" class="inp_text" name="comu_seo" value="{$comu.comu_seo}" autocomplete="off" disabled="">			</li>						<li class="list_item">				<label class="normal_label" for="comu_seo">Categoría</label>				<select class="inp_text" name="comu_cat" tabindex="3">					<option value="" selected="true">Elige una categoría</option>					{foreach from=$cats item=cat}					<option value="{$cat.c_id}" {if $comu.comu_cat == $cat.c_id}selected="selected"{/if}>{$cat.c_name}</option>					{/foreach}				</select>			</li>			<li class="list_item">				<label class="normal_label" for="comu_rank">Rango por defecto</label>				<input type="text" tabindex="4" id="comu_rank" class="inp_text" name="comu_rank" value="{$comu.comu_rank}">			</li>			<li class="list_item">				<label class="normal_label" for="comu_desc">Descripción</label>				<textarea id="comu_desc" class="inp_text" name="comu_desc" tabindex="5" autocomplete="off">{$comu.comu_desc}</textarea>			</li>			<li class="list_item">				<label class="normal_label">Imagen</label>				<div class="thumbnail-prev-block">					<a class="import-image">						<img src="{$web.url}/thumbs/comus/t_{$comu.comu_id}.jpg?{$comu.comu_last_image}" class="thumbnail-preview">					</a>				</div>				<div class="img-positions">					<input type="hidden" name="thumb_x1" value="0">					<input type="hidden" name="thumb_y1" value="0">					<input type="hidden" name="thumb_x2" value="154">					<input type="hidden" name="thumb_y2" value="115">					<input type="hidden" name="thumb_w" value="154">					<input type="hidden" name="thumb_h" value="115">					<input type="hidden" name="img_url" value="">					<input type="hidden" name="comu_id" value="{$comu.comu_id}">				</div>			</li>						<li class="list_item">				<label class="normal_label" for="comu_image">Imagen de fondo <small>(opcional)</small></label>				<input type="text" tabindex="200" id="comu_image" class="inp_text" name="comu_image" placeholder="URL de la imagen" value="{$comu.comu_image}" style="display: inline-block;">				<input name="comu_image_repeat" id="comu_image_repeat" class="stip" title="Repetir fondo" type="checkbox" {if $comu.comu_image_repeat}checked="checked"{/if}>			</li>						<li class="list_item">				<label class="normal_label" for="comu_color">Color de fondo <small>(opcional)</small></label>				<input type="text" tabindex="7" id="comu_color" class="inp_text" name="comu_color" placeholder="Color HTML" value="{$comu.comu_color}" style="width: 70px;min-width: 70px;" onclick="startColorPicker(this)" onkeyup="maskedHex(this)">			</li>			<div style="clear:both"></div>			<li class="list_item">				<label class="normal_label">Opciones</label>				<div class="left_options">					<input type="checkbox" name="p_postear" class="floatL" {if $comu.comu_p_post}checked="checked"{/if}>					<label style="display: table-cell;">Postear</label>					<p style="font-size:11px; color:#999;">Los miembros de la comunidad podrán publicar temas.</p>										<input type="checkbox" name="p_comentar" class="floatL" {if $comu.comu_p_com}checked="checked"{/if}>					<label style="display: table-cell;">Comentar</label>					<p style="font-size:11px; color:#999;">Los miembros de la comunidad podrán responder en los temas temas.</p>				</div>			</li>					</ul>		<hr />		<center>			<input type="button" class="button_1 b_ok" value="Guardar cambios" onclick="new_comu.add_save();"/>		</center>	</div></div>	<div id="sidebar" style="margin-left: 5px;">		<div class="sidebar-add-post clearfix">			<div class="clearfix">				<p class="floatL" style="margin-top;margin-botom:0">					<span class="stitle">						<b>Antes de editar una comunidad, ten en cuenta estos puntos:</b>					</span>				</p>			</div>			<ul>				<li>Si puede contener preguntas o consultas.</li>				<li>Si puede contener ideas y pensamientos.</li>				<li>Si puede ser interesante para otras personas.</li>				<li>Si puede contener gustos y experiencias personales.</li>				<li>Si puede contener links de descarga.</li>				<li>No puede generar odio o violencia.</li>				<li>No puede contener información personal o de un tercero.</li>				<li>No puede contener fotos de personas menores de edad.</li>				<li>No puede contener muertos, sangre, vómitos, etc.</li>				<li>No puede contener nada racista y/o peyorativo.</li>				<li>No puede contener insultos o malos modos.</li>				<li>No puede contener software spyware, malware, virus o troyanos.</li>				<li>No puede ser creada con intención de armar polémica.</li>			</ul>			<hr />			<p class="foo_red">Si tu comunidad no cumple el protocolo es muy probable que sea suspendida.</p>		</div>	</div>