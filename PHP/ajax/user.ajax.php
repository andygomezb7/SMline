<?php
if(!defined('UNTARGETED')) die('Lo que buscas no se encuentra por aqu&iacute;');
if(empty($user->uid)) die('0: Solo usuarios registrados pueden usar esta funci&oacute;n. <a href="/registro/">Reg&iacute;strate</a> para participar');
switch($action){
	case 'follow':
		$type_id = secure($_POST['type_id']);
		echo $user->follow($type_id);
	break;
	case 'unfollow':
		$type_id = secure($_POST['type_id']);
		echo $user->unfollow($type_id);
	break;
	case 'cerrar':;
		echo $user->cerrar();
	break;
	case 'notifica':
		$start = $_POST['start'] ? intval($_POST['start']) : 0;
		$limit = 15;
		$smarty->assign('limit', $limit);
		$smarty->assign('notifications', $notifica->generate($start, $limit, false));
		$smarty_page = 't_ajax/user.notifications';
	break;
	case 'monitor':
		$start = $_POST['start'] ? intval($_POST['start']) : 0;
		$limit = 20;
		$smarty->assign('limit', $limit);
		$smarty->assign('notifications', $notifica->generate($start, $limit, false));
		$smarty_page = 't_ajax/monitor.view_more';
	break;
	case 'mps':
		require'PHP/class/mps.class.php';
		$mps = new mps;
		$start = $_POST['start'] ? intval($_POST['start']) : 0;
		$limit = 8;
		$smarty->assign('limit', $limit);
		$smarty->assign('mps', $mps->generate('monitor', $start, $limit));
		$smarty_page = 't_ajax/user.last_mps';
	break;
	case 'ban':
		// TPL IS FORM
		if(empty($user->permits['su'])) die('0: No tienes permiso para esto');
		$uid = intval($_POST['uid']);
		if($_GET['tpl'] == 1){
			$smarty->assign('us_nick', $user->get_nick($uid));
			$smarty_page = 't_ajax/mod_ban_user';
		}else{
			echo $user->banned($uid);
		}
	break;
	case 'unban':
		$uid = intval($_POST['uid']);
		echo $user->unbanned($uid);
	break;
	case 'check-notis':
		echo $notifica->check_news();
	break;
	case 'send_report':
		$tid = intval($_POST['tid']);
		$type = secure($_POST['type']);
		echo $user->send_report($tid, $type);
	break;
	case 'set_block':
		$uid = intval($_POST['uid']);
		echo $user->set_block($uid);
	break;
	case 'set_unblock':
		$uid = intval($_POST['uid']);
		echo $user->set_unblock($uid);
	break;
	default:
		die('0: Lo que buscas no se encuentra por aqu&iacute;');
	break;
}
?>