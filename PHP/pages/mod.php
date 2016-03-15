<?php
$smarty_page = 'mod';
$page['css'] = array('mod', 'admin');
$page['js'] = array();
$page['title'] = $web['title'].' - Sala de moderaci&oacute;n';
require'PHP/class/mod.class.php';
$mod = new mod;

if(empty($user->permits['gomod'])) die('0: No se te permite realizar esta acci&oacute;n');
$action_permit = array(
	'usuarios_suspendidos' => 'su',
	'usuarios_reportados' => 'gomod',
	'posts_aprobar' => 'vpr',
	'posts_eliminados' => 'vpb',
	'posts_reportados' => 'gomod',
	'imagenes_eliminadas' => 'vfb',
	'imagenes_reportadas' => 'gomod',
	'comus_suspendidas' => 'scs',
	'comus_reportadas' => 'gomod',
	'temas_eliminados' => 'bt',
	'temas_reportados' => 'gomod',
	'mensajes_reportados' => 'gomod',
);

$do = secure($_GET['do']);

if(empty($user->permits['gomod']) || (empty($user->permits[$action_permit[$do]]) && $do)){
	$smarty->assign('error', array('Oops!', 'No tienes permiso para esto', 'Ir a moderaci&oacute;n', '/mod'));
	$smarty->assign('page', array('title' => $web['title'].' - Error'));
	$smarty->display('error.tpl');
	die;
}

$status = secure($_GET['status']);
$action = secure($_GET['action']);
$qu = secure($_GET['qu']);
$smarty->assign('do', $do);
$smarty->assign('status', $status);
$smarty->assign('action', $action);
$smarty->assign('global_data', $mod->global_data());
$smarty->assign('qu', $qu);
switch($do){
	case 'usuarios_suspendidos':
		$smarty->assign('usuarios_suspendidos', $mod->usuarios_suspendidos());
	break;
	case 'usuarios_reportados':
		$smarty->assign('usuarios_reportados', $mod->usuarios_reportados());
	break;
	case 'posts_aprobar':
		$smarty->assign('posts_aprobar', $mod->posts_aprobar());
	break;
	case 'posts_eliminados':
		$smarty->assign('posts_eliminados', $mod->posts_eliminados());
	break;
	case 'posts_reportados':
		$smarty->assign('posts_reportados', $mod->posts_reportados());
	break;
	case 'imagenes_eliminadas':
		$smarty->assign('imagenes_eliminadas', $mod->imagenes_eliminadas());
	break;
	case 'imagenes_reportadas':
		$smarty->assign('imagenes_reportadas', $mod->imagenes_reportadas());
	break;
	case 'comus_suspendidas':
		$smarty->assign('comus_suspendidas', $mod->comus_suspendidas());
	break;
	case 'comus_reportadas':
		$smarty->assign('comus_reportadas', $mod->comus_reportadas());
	break;
	case 'temas_eliminados':
		$smarty->assign('temas_eliminados', $mod->temas_eliminados());
	break;
	case 'temas_reportados':
		$smarty->assign('temas_reportados', $mod->temas_reportados());
	break;
	case 'mensajes_reportados':
		$page['css'][] = 'messages';
		$page['css'][] = 'post';
		$smarty->assign('mensajes_reportados', $mod->mensajes_reportados());
	break;
	default:
		$mod->set_access();
		$smarty->assign('get_access', $mod->get_access());
		$smarty->assign('get_mods', $mod->get_mods());
	break;
}

$smarty->assign('page', $page);
?>