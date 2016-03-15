<?php
if(!defined('UNTARGETED')) die('Lo que buscas no se encuentra por aqu&iacute;');
if(empty($user->uid)) die('0: <a href="/registro">Reg&iacute;strate</a> para tener acceso a todas las funciones de este sitio');
require'PHP/class/mps.class.php';
$mps = new mps;
switch($action){
	case 'send':
		echo $mps->send_mp();
	break;
	case 'send_replie':
		$smarty->assign('rp_data', $mps->send_replie());
		$smarty_page = 't_ajax/mp_replie';
	break;
	case 'del':
		$mp_id = intval($_POST['mp_id']);
		$del_type = intval($_POST['del_type']);
		echo $mps->del_mp($mp_id, $del_type);
	break;
	case 'restaurar':
		$mp_id = intval($_POST['mp_id']);
		echo $mps->restaurar_mp($mp_id);
	break;
	case 'is_noread':
		$mp_id = intval($_POST['mp_id']);
		echo $mps->is_noread($mp_id);
	break;
	case 'is_read':
		$mp_id = intval($_POST['mp_id']);
		echo $mps->is_read($mp_id);
	break;
	default:
		die('0: Lo que buscas no se encuentra por aqu&iacute;');
	break;
}
?>