<?php
if(!defined('UNTARGETED')) die('Lo que buscas no se encuentra por aqu&iacute;');
$can_access = array('home_page', 'prev_img', 'show_replies');
if(empty($user->uid) && !in_array($action, $can_access)) die('0: <a href="/registro">Reg&iacute;strate</a> para tener acceso a todas las funciones de este sitio');
require'PHP/class/images.class.php';
$img = new img;
switch($action){
	case 'add':
		echo $img->add();
	break;
	case 'save':
		echo $img->save();
	break;
	case 'home_page':
		$page = intval($_POST['page']);
		$smarty->assign('last_images', $img->last_images($page));
		$smarty_page = 't_ajax/home_page_images';
	break;
	case 'prev_img':
		$imgid = intval($_POST['imgid']);
		$smarty->assign('img', $img->get_img_ajax($imgid));
		$smarty_page = 't_ajax/get_image';
	break;
	case 'follow':
		$imgid = intval($_POST['type_id']);
		echo $img->follow($imgid);
	break;
	case 'unfollow':
		$imgid = intval($_POST['type_id']);
		echo $img->unfollow($imgid);
	break;
	case 'favorite':
		$img_id = secure($_POST['img_id']);
		$action = $_POST['action'] == 1 ? 1 : 0;
		echo $img->favorite($img_id, $action);
	break;
	case 'vote':
		$imgid = intval($_POST['imgid']);
		$vote = intval($_POST['vote']);
		echo $img->vote($imgid, $vote);
	break;
	case 'delete':
		$i_id = intval($_POST['i_id']);
		echo $img->delete($i_id);
	break;
	case 'mod_delete':
		if($_GET['tpl'] == 1){
			require_once'PHP/libs/datos.php';
			$smarty->assign('reasons', $delete_reasons['image']);
			$smarty_page = 't_ajax/mod_del_image';
		}else{
			$i_id = intval($_POST['objid']);
			echo $img->mod_delete($i_id);
		}
	break;
	case 'mod_reac':
		$i_id = intval($_POST['objid']);
		echo $img->mod_reac($i_id);
	break;
	case 'comment':
		$smarty->assign('comment', $img->comment());
		$smarty_page = 't_ajax/comment_image';
	break;
	case 'send_replie':
		$smarty->assign('comment', $img->send_replie());
		$smarty_page = 't_ajax/new_replie';
	break;
	case 'show_replies':
		$cid = intval($_POST['cid']);
		$smarty->assign('replies', $img->show_replies($cid));
		$smarty->assign('replies_type', 'images');
		$smarty_page = 't_ajax/show_replies';
	break;
	case 'get_edit_comment':
		$cid = intval($_POST['cid']);
		echo $img->get_edit_comment($cid);
	break;
	case 'save_comment':
		$cid = intval($_POST['cid']);
		echo $img->save_comment($cid);
	break;
	case 'vote_comment':
		$vote = intval($_POST['vote']);
		$cid = intval($_POST['cid']);
		echo $img->vote_comment($vote, $cid);
	break;
	case 'del_comment':
		$cid = intval($_POST['cid']);
		echo $img->del_comment($cid);
	break;
	case 'share':
		$imgid = secure($_POST['imgid']);
		echo $img->share($imgid);
	break;
	default:
		die('0: Lo que buscas no se encuentra por aqu&iacute;');
	break;
}
?>