<?php
if(!defined('UNTARGETED')) die('Lo que buscas no se encuentra por aqu&iacute;');
$can_access = array('show_comments');
if(empty($user->uid) && !in_array($action, $can_access)) die('0: <a href="/registro">Reg&iacute;strate</a> para tener acceso a todas las funciones de este sitio');
require'PHP/class/states.class.php';
$states = new states;
switch($action){
	case 'import':
		echo $states->import();
	break;
	case 'send':
		echo $states->send();
	break;
	case 'like':
		$type = intval($_POST['type']);
		$sid = intval($_POST['sid']);
		echo $states->like($sid, $type);
	break;
	case 'like_comment':
		$type = intval($_POST['type']);
		$cid = intval($_POST['cid']);
		echo $states->like_comment($cid, $type);
	break;
	case 'comment':
		$smarty->assign('comment', $states->comment());
		$smarty_page = 't_ajax/comment_state';
	break;
	case 'show_comments':
		$sid = intval($_POST['sid']);
		$smarty->assign('comments', $states->show_comments($sid));
		$smarty_page = 't_ajax/states_show_comments';
	break;
	case 'comment_del':
		$cid = intval($_POST['cid']);
		echo $states->del_comment($cid);
	break;
	case 'del_state':
		$sid = intval($_POST['sid']);
		echo $states->del_state($sid);
	break;
	case 'get_edit':
		$sid = intval($_POST['sid']);
		echo $states->get_edit($sid);
	break;
	case 'save_state':
		$sid = intval($_POST['sid']);
		echo $states->save_state($sid);
	break;
	default:
		die('0: Lo que buscas no se encuentra por aqu&iacute;');
	break;
}
?>