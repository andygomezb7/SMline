<?php /* Smarty version Smarty-3.1.15, created on 2014-08-22 16:17:28
         compiled from ".\themes\smline\Templates\i_post\content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15253f7b368cb8c52-93540788%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '64bb6c80d1cffb3ebbbc52fb52391e49506ad2fd' => 
    array (
      0 => '.\\themes\\smline\\Templates\\i_post\\content.tpl',
      1 => 1398884794,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15253f7b368cb8c52-93540788',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'post' => 0,
    'user' => 0,
    'web' => 0,
    'h' => 0,
    'x' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f7b368e99443_39447773',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f7b368e99443_39447773')) {function content_53f7b368e99443_39447773($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'C:\\xampp\\htdocs\\PHP\\libs\\plugins\\modifier.date_format.php';
?><?php if ($_smarty_tpl->tpl_vars['post']->value['p_status']==0&&$_smarty_tpl->tpl_vars['user']->value->permits['vpb']) {?>
/info.png">Este post se encuentra actualmente en <b>revisi&oacute;n</b>. Tus privilegios de rango te permiten visualizar posts en revisi&oacute;n. Recuerda que en tus deberes como moderador incluye el revisar y aprobar posts.</div>

"><?php echo hace($_smarty_tpl->tpl_vars['post']->value['p_date']);?>
</a> | <a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/posts/<?php echo $_smarty_tpl->tpl_vars['post']->value['c_seo'];?>
"><?php echo $_smarty_tpl->tpl_vars['post']->value['c_name'];?>
</a></span>
" style="display:inline-block;">
/follow.png"/>Seguir post</a>
', '<?php echo $_smarty_tpl->tpl_vars['post']->value['u_nick'];?>
', <?php echo $_smarty_tpl->tpl_vars['post']->value['p_id'];?>
);" title="Reportar post"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/flag.png" /></a>
/heart_10.png"/>Agregar a favoritos</a>
/heart_10.png"/>Borrar de favoritos</a>
);"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/sok.png"/> Reactivar post</a></li>
);"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/delete.png"/> Borrar post</a></li>
);"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/delete.png"/> Borrar post</a></li>
/agregar-post?pid=<?php echo $_smarty_tpl->tpl_vars['post']->value['p_id'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/edit.png"/> Editar post</a></li>
);"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/cross.png"/> Mandar a revisión</a></li>
);"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/blue_ball.png"/> Aprobar post</a></li>
);"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/sticky.png"/> Fijar post</a></li>
);"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/sticky.png"/> Desfijar post</a></li>
 $_from = $_smarty_tpl->tpl_vars['post']->value['history']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['h']->key => $_smarty_tpl->tpl_vars['h']->value) {
$_smarty_tpl->tpl_vars['h']->_loop = true;
?>
/<?php echo $_smarty_tpl->tpl_vars['h']->value['u_nick'];?>
"><b><?php echo $_smarty_tpl->tpl_vars['h']->value['u_nick'];?>
</b></a></td>
</td>
</td>

</span>
/ok.png"> Puntos agregados!</span>
  if ($_smarty_tpl->tpl_vars['x']->value<=$_smarty_tpl->tpl_vars['user']->value->info['u_points_ava']) { for ($_foo=true;$_smarty_tpl->tpl_vars['x']->value<=$_smarty_tpl->tpl_vars['user']->value->info['u_points_ava']; $_smarty_tpl->tpl_vars['x']->value++) {
?>
" onclick="post.puntuar(<?php echo $_smarty_tpl->tpl_vars['x']->value;?>
)"><?php if ($_smarty_tpl->tpl_vars['x']->value==10) {?>+<?php }?><?php echo $_smarty_tpl->tpl_vars['x']->value;?>
</a>
/info.png"> No tienes puntos para dar por el momento, tus puntos se recargan en <?php if ($_smarty_tpl->tpl_vars['post']->value['horas_recarga']) {?><?php echo $_smarty_tpl->tpl_vars['post']->value['horas_recarga'];?>
<?php } else { ?>una<?php }?> hora<?php if ($_smarty_tpl->tpl_vars['post']->value['horas_recarga']>1) {?>s<?php }?></span>
</b> Puntos
</b> Favoritos
</b> Comentarios
</b> Seguidores
</b> Visitas