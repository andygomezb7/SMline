<?php /* Smarty version Smarty-3.1.15, created on 2014-08-22 16:17:12
         compiled from ".\themes\smline\Templates\agregar-post.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2424253f7b358439322-13668891%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ba39fb6682938ce90f676ef2bd245051044f6766' => 
    array (
      0 => '.\\themes\\smline\\Templates\\agregar-post.tpl',
      1 => 1399078860,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2424253f7b358439322-13668891',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'web' => 0,
    'cats_list' => 0,
    'c' => 0,
    'user' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f7b3584b24c6_47076542',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f7b3584b24c6_47076542')) {function content_53f7b3584b24c6_47076542($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('includes/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php if ($_smarty_tpl->tpl_vars['web']->value['port_posts']) {?><script src="<?php echo $_smarty_tpl->tpl_vars['web']->value['js'];?>
/jquery.imgareaselect.js" type="text/javascript"></script><link href="<?php echo $_smarty_tpl->tpl_vars['web']->value['css'];?>
/img_area_select/imgareaselect.css" rel="stylesheet" type="text/css"><?php }?><div id="main-col">	<div class="post-create">		<ul class="clearfix">			<li class="list_item">				<label for="i_title">T&iacute;tulo</label>				<div id="add_error">					<span class="pico"></span>					<span class="text"></span>				</div>				<input type="text" tabindex="1" id="i_title" class="inp_text required" name="r_title" value="" autocomplete="off">			</li>						<li class="list_item">				<label for="markItUp">Contenido del post</label>				<div id="add_error">					<span class="pico"></span>					<span class="text"></span>				</div>				<textarea id="markItUp" class="inp_text required" name="r_body" tabindex="2" autocomplete="off"></textarea>			</li>						<li class="list_item">				<label>Tags <a onclick="new_post.generate_tags($('#i_title').val());" class="stip" title="Generar tags autom&aacute;ticos"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['img'];?>
/icons/reboot.png" width="12px" height="12px" /></a></label>				<div id="add_error">					<span class="pico"></span>					<span class="text"></span>				</div>				<input type="text" tabindex="3" id="i_tags" style="width:690px" class="inp_text required" name="r_tags" value="" autocomplete="off">				<p style="font-size:11px; color:#999;">4 palabras distintas separadas por comas que describan el contenido del post, por ejemplo: "gol, brasileños, Mundial 14, fútbol, Falcão, Colombia"</p>			</li>						<li class="list_item item_left" style="width: 300px;">				<label for="i_cat">Categoría</label>				<div id="add_error">					<span class="pico"></span>					<span class="text"></span>				</div>				<select tabindex="4" id="i_cat" size="10" style="width:300px" class="inp_text required" name="r_cat">					<option value="">Seleccionar categoría</option>					<?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['cats_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value) {
$_smarty_tpl->tpl_vars['c']->_loop = true;
?>						<option value="<?php echo $_smarty_tpl->tpl_vars['c']->value['c_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['c']->value['c_name'];?>
</option>					<?php } ?>				</select>			</li>						<li class="list_item item_right">				<input type="checkbox" tabindex="6" name="r_nocomments" id="i_nocomments" class="floatL">				<label for="i_nocomments" style="display: table-cell;">Cerrar comentarios</label>				<p style="font-size:11px; color:#999;">Nadie podr&aacute; comentar este post. Activa esta opción en caso de que tu post sea polémico.</p>																<?php if ($_smarty_tpl->tpl_vars['user']->value->permits['fp']) {?>				<input type="checkbox" tabindex="6" name="r_sticky" id="i_sticky" class="floatL">				<label for="i_sticky" style="display: table-cell;">Sticky</label>				<p style="font-size:11px; color:#999;">El post será fijado en la home como post importante.</p>				<?php }?>				<?php if ($_smarty_tpl->tpl_vars['user']->value->permits['fp']&&$_smarty_tpl->tpl_vars['user']->value->permits['goadmin']) {?>				<input type="checkbox" tabindex="6" name="r_patro" id="i_patro" class="floatL">				<label for="i_patro" style="display: table-cell;">Patrocionado</label>				<p style="font-size:11px; color:#999;">El post será resaltado entre los demás.</p>				<?php }?>			</li>			<?php if ($_smarty_tpl->tpl_vars['web']->value['port_posts']) {?>			<li class="list_item" style="width: 170px;margin:auto;">				<label for="i_cat">Imagen de portada</label>				<div id="add_error">					<span class="pico"></span>					<span class="text"></span>				</div>				<div class="thumbnail-prev-block">					<img src="" class="thumbnail-preview" />				</div>				<div class="thumb-select">Subir imagen					<div class="thumb-options">						<div class="from-url">Desde una URL</div>						<div class="from-post">Desde el post</div>					</div>				</div>				<div class="img-positions">					<input type="hidden" name="thumb_x1" value="0" />					<input type="hidden" name="thumb_y1" value="0" />					<input type="hidden" name="thumb_x2" value="154" />					<input type="hidden" name="thumb_y2" value="115" />					<input type="hidden" name="thumb_w" value="154" />					<input type="hidden" name="thumb_h" value="115" />					<input type="hidden" name="img_url" value="" />				</div>			</li>			<?php }?>					</ul>		<hr />		<div class="emptyData borrador_status" style="display:none;margin-bottom:5px"></div>		<center>			<input type="button" class="button_1 b_ok" value="Continuar &#187;" onclick="new_post.prev();"/>			<input type="button" class="button_1" value="Guardar en borradores" onclick="new_post.save_borrador();"/>		</center>	</div></div>	<div id="sidebar" style="margin-left: 5px;">		<div class="sidebar-add-post clearfix">			<div class="clearfix">				<p class="floatL" style="margin-top;margin-botom:0">					<span class="stitle">						<b>Antes de agregar un post, ten en cuenta estos puntos:</b>					</span>				</p>			</div>			<ul>				<li>El título debe ser descriptivo.</li>				<li>El título no puede estar en mayúscula.</li>				<li>El título no puede ser exagerado.</li>				<li>No puede contener información personal o de un tercero.</li>				<li>No puede contener fotos de personas menores de edad.</li>				<li>No puede contener muertos, sangre, vómitos, etc.</li>				<li>No puede contener nada racista y/o peyorativo.</li>				<li>No puede contener preguntas o críticas.</li>				<li>No puede contener insultos o malos modos.</li>				<li>No puede contener software spyware, malware, virus o troyanos.</li>				<li>No puede ser creado con intención de armar polémica.</li>			</ul>			<hr />			<p class="foo_red">Si el post no cumple el protocolo es muy probable que sea eliminado.</p>		</div>	</div><?php echo $_smarty_tpl->getSubTemplate ('includes/footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
