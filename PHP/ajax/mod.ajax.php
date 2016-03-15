<?php
if(!defined('UNTARGETED')) die('Lo que buscas no se encuentra por aqu&iacute;');
if(empty($user->permits['gomod'])) die('0: No se te permite realizar esta acci&oacute;n');
$action_permit = array();
//if(empty($user->permits[$action_permit[$action]])) die('0: No tienes permisos para realizar esta acci&oacute;n');
require'PHP/class/mod.class.php';
$mod = new mod;
switch($action){
	case 'del_report':
		$r_id = intval($_POST['r_id']);
		echo $mod->del_report($r_id);
	break;
	case 'read_mp':
		$mp_id = intval($_POST['mp_id']);
		$smarty->assign('data_mp', $mod->read_mp($mp_id));
		$smarty_page = 't_ajax/admin.read_mp';
		if(!is_array($mod->read_mp($mp_id))){
			echo $mod->read_mp($mp_id);
			die;
		}
	break;
	default:
		die('0: Lo que buscas no se encuentra por aqu&iacute;');
	break;
}
?>