<?php
if(!defined('UNTARGETED')) die('Lo que buscas no se encuentra por aqu&iacute;');
$can_access = array('home_page', 'show_replies', 'top_comus');
if(empty($user->uid) && !in_array($action, $can_access)) die('0: <a href="/registro">Reg&iacute;strate</a> para tener acceso a todas las funciones de este sitio');
require'PHP/class/comus.class.php';
$comus = new comus;
require'PHP/class/topics.class.php';
$topics = new topics;
switch($action){
	case 'home_page':
		$page = intval($_POST['page']);
		$smarty->assign('last_topics', $topics->home_last_topics($page));
		$smarty_page = 't_ajax/home_page_topics';
	break;
	case 'follow':
		$topic_id = intval($_POST['type_id']);
		echo $topics->follow_topic($topic_id);
	break;
	case 'unfollow':
		$topic_id = intval($_POST['type_id']);
		echo $topics->unfollow_topic($topic_id);
	break;
	case 'favorite':
		$topic_id = secure($_POST['topic_id']);
		$action = $_POST['action'] == 1 ? 1 : 0;
		echo $topics->favorite_topic($topic_id, $action);
	break;
	case 'vote':
		$topic_id = intval($_POST['topic_id']);
		$vote = intval($_POST['vote']);
		echo $comus->vote_topic($topic_id, $vote);
	break;
	
	case 'mod_delete':
		if($_GET['tpl'] == 1){
			require_once'PHP/libs/datos.php';
			$smarty->assign('reasons', $delete_reasons['topic']);
			$smarty_page = 't_ajax/mod_del_topic';
		}else{
			$topic_id = intval($_POST['objid']);
			echo $comus->mod_delete($topic_id);
		}
	break;
	case 'mod_reac':
		$topic_id = intval($_POST['objid']);
		echo $comus->mod_reac($topic_id);
	break;
	case 'mod_add_sticky':
		$topic_id = intval($_POST['objid']);
		echo $comus->mod_add_sticky($topic_id);
	break;
	case 'mod_remove_sticky':
		$topic_id = intval($_POST['objid']);
		echo $comus->mod_remove_sticky($topic_id);
	break;
	
	case 'comment':
		$smarty->assign('comment', $comus->comment_topic());
		$smarty_page = 't_ajax/comment_topic';
	break;
	case 'send_replie':
		$smarty->assign('comment', $comus->send_replie());
		$smarty_page = 't_ajax/new_replie';
	break;
	case 'show_replies':
		$cid = intval($_POST['cid']);
		$smarty->assign('replies', $topics->show_replies($cid));
		$smarty->assign('replies_type', 'topics');
		$smarty_page = 't_ajax/show_replies';
	break;
	case 'get_edit_comment':
		$cid = intval($_POST['cid']);
		echo $topics->get_edit_comment($cid);
	break;
	case 'save_comment':
		$cid = intval($_POST['cid']);
		echo $topics->save_comment($cid);
	break;
	case 'vote_comment':
		$vote = intval($_POST['vote']);
		$cid = intval($_POST['cid']);
		echo $topics->vote_comment($vote, $cid);
	break;
	case 'del_comment':
		$cid = intval($_POST['cid']);
		echo $comus->del_comment($cid);
	break;
	case 'share':
		$topic_id = secure($_POST['topic_id']);
		echo $topics->share_topic($topic_id);
	break;
	case 'top_comus':
		$filter = intval($_POST['filter']);
		if($filter > 5 || $filter < 1) $filter = 5;
		require'PHP/class/tops.class.php';
		$tops = new tops;
		$smarty->assign('top_comus', $tops->get_comus($filter));
		$smarty_page = 't_ajax/top_comus';
	break;
	case 'delete_topic':
		$tid = intval($_POST['tid']);
		echo $topics->delete_topic($tid);
	break;
	default:
		die('0: Lo que buscas no se encuentra por aqu&iacute;');
	break;
}
?>