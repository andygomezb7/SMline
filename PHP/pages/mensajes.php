<?php
$smarty_page = 'mensajes';
$page['css'] = array('messages', 'search', 'post');
$page['js'] = 'messages';
$page['title'] = $web['title'].' - Mensajes';
// CLASE
require'PHP/class/mps.class.php';
$mps = new mps;

if(empty($user->uid)){
	$smarty->assign('error', array('Oops!', 'Solo usuarios registrados pueden recibir y enviar mensjes', 'Registrarme', '/registro'));
	$smarty->assign('page', array('title' => $web['title'].' - Error'));
	$smarty->display('error.tpl');
	die;
}

$m_action = empty($_GET['m_action']) ? secure($_GET['do']) : secure($_GET['m_action']);

switch($m_action){
	case 'write':
	case 'redactar':
		$page['title'] = $web['title'].' - Redactar mensaje';
		$mp_to = secure($_GET['mp_to']);
		$smarty->assign('mp_to', $mp_to);
	break;
	case 'read':
		$mp_id = secure($_GET['mp_id']);
		$data_mp = $mps->read_mp($mp_id);
		if(!is_array($data_mp)){
			$smarty->assign('error', array('Oops!', $data_mp, 'Volver a mensajes', '/mensajes'));
			$smarty->assign('page', array('title' => $web['title'].' - Error'));
			$smarty->display('error.tpl');
			die;
		}
		$smarty->assign('data_mp', $data_mp);
	break;
	case 'recibidos':
	case '':
		$ok_act = secure($_GET['ok_act']);
		$limit = 10;
		$smarty->assign('mps', $mps->generate('recibidos', 0, $limit));
		$smarty->assign('ok_act', $ok_act);
	break;
	case 'enviados':
		$limit = 10;
		$smarty->assign('mps', $mps->generate('enviados', 0, $limit));
	break;
	case 'eliminados':
		$limit = 10;
		$smarty->assign('mps', $mps->generate('eliminados', 0, $limit));
	break;
}

$smarty->assign('mps_data', $mps->mps_data());
$smarty->assign('m_action', $m_action);

/*
$limit = 20;
$start = 0;
$smarty->assign('limit', $limit);
$smarty->assign('notifications', $notifica->generate($start, $limit, false));*/

// ARRAY VARS
$smarty->assign('page', $page);
?>