<?php
if(!defined('UNTARGETED')) die('Lo que buscas no se encuentra por aqu&iacute;');
$can_access = array();
if(empty($user->uid) && !in_array($action, $can_access)) die('0: <a href="/registro">Reg&iacute;strate</a> para tener acceso a todas las funciones de este sitio');
require'PHP/class/comus.class.php';
$comus = new comus;
switch($action){
	
	case 'load_members':
		$smarty->assign('members', $comus->load_members());
		$smarty_page = 't_ajax/comus/load_members';
	break;
	case 'admin_member':
		$smarty->assign('admin_member', $comus->admin_member());
		$smarty_page = 't_ajax/comus/admin_member';
	break;
	case 'save_member':
		$uid = intval($_POST['uid']);
		$cid = intval($_POST['cid']);
		$admin_action = secure($_POST['admin_action']);
		if($admin_action == 'ban') echo $comus->ban_member($uid, $cid);
		elseif($admin_action == 'unban') echo $comus->unban_member($uid, $cid);
		elseif($admin_action == 'rank') echo $comus->change_rank_member($uid, $cid);
		else echo '0: Powered By David077';
	break;
	
	case 'get_seo':
		echo secure(seo(strtolower($_POST['comu_name'])));
	break;
	case 'img_port':
		$url = secure($_POST['url']);
		echo $comus->img_port($url);
	break;
	case 'create':
		echo $comus->create();
	break;
	case 'add-topic':
		echo $comus->add_topic();
	break;
	case 'save-topic':
		echo $comus->save_topic();
	break;
	case 'save':
		echo $comus->save();
	break;
	case 'join':
		$comu_id = intval($_POST['comu_id']);
		echo $comus->join($comu_id);
	break;
	case 'leave':
		$comu_id = intval($_POST['comu_id']);
		echo $comus->leave($comu_id);
	break;
	case 'ban':
		$comu_id = intval($_POST['comu_id']);
		echo $comus->ban($comu_id);
	break;
	case 'unban':
		$comu_id = intval($_POST['comu_id']);
		echo $comus->unban($comu_id);
	break;
	case 'follow':
		$type_id = secure($_POST['type_id']);
		echo $comus->follow($type_id);
	break;
	case 'unfollow':
		$type_id = secure($_POST['type_id']);
		echo $comus->unfollow($type_id);
	break;
	default:
		die('0: Lo que buscas no se encuentra por aqu&iacute;');
	break;
}
?>