<?php /* Smarty version Smarty-3.1.15, created on 2014-08-23 11:22:48
         compiled from ".\themes\smline\Templates\i_admin\ads.tpl" */ ?>
<?php /*%%SmartyHeaderCode:935853f8bf717d23a6-16758947%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'aa09b87b4bff3a67489db353cb9a9fb72b96e532' => 
    array (
      0 => '.\\themes\\smline\\Templates\\i_admin\\ads.tpl',
      1 => 1408810964,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '935853f8bf717d23a6-16758947',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f8bf71885ed6_03006852',
  'variables' => 
  array (
    'web' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f8bf71885ed6_03006852')) {function content_53f8bf71885ed6_03006852($_smarty_tpl) {?><div class="box">	<div class="box_title">Banners de publicidad</div>	<div class="box_body clearfix admin-settings admin-ads">				<ul>			<li class="list_item clearfix">				<label for="ads_script">Script:					<small>Si los banners son mostrados por medio de javascript ingresa el código junto con la etiqueta "script"</small>				</label>				<textarea id="ads_script" class="inp_text" name="ads_script" style="width:350px;min-height:70px;display:inline-block;" autocomplete="off"><?php echo $_smarty_tpl->tpl_vars['web']->value['ads_script'];?>
</textarea>			</li>						<li class="list_item clearfix">				<label for="ads_300">Banner 300x250:				</label>				<textarea id="ads_300" class="inp_text" name="ads_300" style="width:350px;min-height:70px;display:inline-block;" autocomplete="off"><?php echo $_smarty_tpl->tpl_vars['web']->value['ads_300'];?>
</textarea>			</li>						<li class="list_item clearfix">				<label for="ads_468">Banner 468x60:				</label>				<textarea id="ads_468" class="inp_text" name="ads_468" style="width:350px;min-height:70px;display:inline-block;" autocomplete="off"><?php echo $_smarty_tpl->tpl_vars['web']->value['ads_468'];?>
</textarea>			</li>						<li class="list_item clearfix">				<label for="ads_160">Banner 160x600:				</label>				<textarea id="ads_160" class="inp_text" name="ads_160" style="width:350px;min-height:70px;display:inline-block;" autocomplete="off"><?php echo $_smarty_tpl->tpl_vars['web']->value['ads_160'];?>
</textarea>			</li>						<li class="list_item clearfix">				<label for="ads_728">Banner 728x90:				</label>				<textarea id="ads_728" class="inp_text" name="ads_728" style="width:350px;min-height:70px;display:inline-block;" autocomplete="off"><?php echo $_smarty_tpl->tpl_vars['web']->value['ads_728'];?>
</textarea>			</li>		</ul>				<hr>		<input type="button" class="button_1 b_ok floatR" value="Guardar cambios" onclick="admin.ads.save();">			</div>	</div><?php }} ?>
