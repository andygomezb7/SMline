<?php
if(!defined('UNTARGETED')) die('Lo que buscas no se encuentra por aqu&iacute;');
$can_access = array('home_page', 'top_posts', 'top_users', 'show_replies', 'comments_pages');
if(empty($user->uid) && !in_array($action, $can_access)) die('0: <a href="/registro">Reg&iacute;strate</a> para tener acceso a todas las funciones de este sitio');
require'PHP/class/posts.class.php';
$posts = new posts;
switch($action){
	case 'prev':
		require_once'PHP/libs/bbcode.inc.php';
		$bbcode = new bbcode;
		$smarty->assign('post_body', $bbcode->start(secure($_POST['body'], false, true)));
		$smarty_page = 't_ajax/preview_post';
	break;
	case 'img_port':
		$url = secure($_POST['url']);
		echo $posts->img_port($url);
	break;
	case 'add':
		echo $posts->add();
	break;
	case 'save':
		echo $posts->save();
	break;
	case 'save_borrador':
		echo $posts->save_borrador();
	break;
	case 'del_borrador':
		echo $posts->del_borrador();
	break;
	case 'puntuar':
		$puntos = intval($_POST['puntos']);
		$post_id = intval($_POST['post_id']);
		echo $posts->puntuar($puntos, $post_id);
	break;
	case 'follow':
		$type_id = secure($_POST['type_id']);
		echo $posts->follow($type_id);
	break;
	case 'unfollow':
		$type_id = secure($_POST['type_id']);
		echo $posts->unfollow($type_id);
	break;
	case 'favorite':
		$post_id = secure($_POST['post_id']);
		$action = $_POST['action'] == 1 ? 1 : 0;
		echo $posts->favorite($post_id, $action);
	break;
	case 'share':
		$pid = secure($_POST['pid']);
		echo $posts->share($pid);
	break;
	case 'delete':
		$pid = intval($_POST['pid']);
		echo $posts->delete($pid);
	break;
	case 'mod_delete':
		if($_GET['tpl'] == 1){
			require_once'PHP/libs/datos.php';
			$smarty->assign('reasons', $delete_reasons['post']);
			$smarty_page = 't_ajax/mod_del_post';
		}else{
			$pid = intval($_POST['objid']);
			echo $posts->mod_delete($pid);
		}
	break;
	case 'mod_reac':
		$pid = intval($_POST['objid']);
		echo $posts->mod_reac($pid);
	break;
	case 'mod_revise':
		$pid = intval($_POST['objid']);
		echo $posts->mod_revise($pid);
	break;
	case 'mod_approve':
		$pid = intval($_POST['objid']);
		echo $posts->mod_approve($pid);
	break;
	case 'mod_add_sticky':
		$pid = intval($_POST['objid']);
		echo $posts->mod_add_sticky($pid);
	break;
	case 'mod_remove_sticky':
		$pid = intval($_POST['objid']);
		echo $posts->mod_remove_sticky($pid);
	break;
	case 'home_page':
		$page = intval($_POST['page']);
		$cat = secure($_POST['cat']);
		$smarty->assign('last_posts', $posts->last_posts($page, false, $cat));
		if($web['port_posts']) $smarty_page = 't_ajax/home_page_ports';
		else $smarty_page = 't_ajax/home_page';
	break;
	case 'top_posts':
		$filter = intval($_POST['filter']);
		if($filter > 5 || $filter < 1) $filter = 5;
		require'PHP/class/tops.class.php';
		$tops = new tops;
		$smarty->assign('top_posts', $tops->get_posts($filter));
		$smarty_page = 't_ajax/top_posts';
	break;
	case 'top_users':
		$filter = intval($_POST['filter']);
		if($filter > 5 || $filter < 1) $filter = 5;
		require'PHP/class/tops.class.php';
		$tops = new tops;
		$smarty->assign('top_users', $tops->get_users($filter));
		$smarty_page = 't_ajax/top_users';
	break;
	case 'get_ports':
		$smarty->assign('ports', $posts->get_ports());
		$smarty_page = 't_ajax/get_post_ports';
	break;
	case 'comment':
		$smarty->assign('comment', $posts->comment());
		$smarty_page = 't_ajax/comment_post';
	break;
	case 'send_replie':
		$smarty->assign('comment', $posts->send_replie());
		$smarty_page = 't_ajax/new_replie';
	break;
	case 'show_replies':
		$cid = intval($_POST['cid']);
		$smarty->assign('replies', $posts->show_replies($cid));
		$smarty_page = 't_ajax/show_replies';
	break;
	case 'get_edit_comment':
		$cid = intval($_POST['cid']);
		echo $posts->get_edit_comment($cid);
	break;
	case 'save_comment':
		$cid = intval($_POST['cid']);
		echo $posts->save_comment($cid);
	break;
	case 'vote_comment':
		$vote = intval($_POST['vote']);
		$cid = intval($_POST['cid']);
		echo $posts->vote_comment($vote, $cid);
	break;
	case 'del_comment':
		$cid = intval($_POST['cid']);
		echo $posts->del_comment($cid);
	break;
	case 'del_fav':
		$fid = intval($_POST['fid']);
		echo $posts->del_fav($fid);
	break;
	case 'comments_pages':
		$pid = intval($_POST['pid']);
		$started = intval($_POST['page']);
		$result['post'] = $posts->get_comments($started, $pid);
		$smarty->assign('post', $result['post']);
		$smarty_page = 't_ajax/post_ajax_comments';
	break;
	default:
		die('0: Lo que buscas no se encuentra por aqu&iacute;');
	break;
}
?>