<?php
if(!defined('UNTARGETED')) die('Lo que buscas no se encuentra por aqu&iacute;');
require'PHP/class/profile.class.php';
$profile = new profile;
switch($action){
	case 'load_tab':
		$tab = secure($_POST['tab']);
		$uid = intval($_POST['user']);
		switch($tab){
			case 'states':
				$start = intval($_POST['start']);
				$smarty->assign('u_states', $profile->states($uid));
				$smarty_page = 't_ajax/profile/profile.tab_states';
			break;
			case 'activity':
				$start = intval($_POST['start']);
				$smarty->assign('activity', $activity->generate($uid, $start));
				$smarty_page = 't_ajax/profile/profile.tab_activity';
			break;
			case 'info':
				$smarty->assign('u_info', $profile->get_info($uid));
				$smarty_page = 't_ajax/profile/profile.tab_info';
			break;
			case 'posts':
				$smarty->assign('u_posts', $profile->get_posts($uid));
				$smarty_page = 't_ajax/profile/profile.tab_posts';
			break;
			case 'topics':
				$smarty->assign('u_topics', $profile->get_topics($uid));
				$smarty_page = 't_ajax/profile/profile.tab_topics';
			break;
			case 'images':
				$smarty->assign('u_images', $profile->get_images($uid));
				$smarty_page = 't_ajax/profile/profile.tab_images';
			break;
			case 'follows':
				require_once'PHP/libs/datos.php';
				$smarty->assign('u_follows', $profile->get_follows($uid));
				$smarty->assign('data_paises', $array_data['paises']);
				$smarty_page = 't_ajax/profile/profile.tab_follows';
			break;
			case 'following':
				require_once'PHP/libs/datos.php';
				$smarty->assign('u_following', $profile->get_following($uid));
				$smarty->assign('data_paises', $array_data['paises']);
				$smarty_page = 't_ajax/profile/profile.tab_following';
			break;
			case 'comus':
				$smarty->assign('u_comus', $profile->get_comus($uid));
				$smarty_page = 't_ajax/profile/profile.tab_comus';
			break;
			case 'medals':
				$smarty->assign('u_medals', $profile->medals($uid, 0, 999));
				$smarty_page = 't_ajax/profile/profile.tab_medals';
			break;
		}
	break;
	case 'activity_load_more':
		$start = intval($_POST['start']);
		$uid = intval($_POST['user']);
		$smarty->assign('activity', $activity->generate($uid, $start));
		$smarty_page = 't_ajax/profile/profile.tab_activity_list';
	break;
	case 'posts_load_more':
		$start = intval($_POST['start']);
		$uid = intval($_POST['user']);
		$smarty->assign('u_posts', $profile->get_posts($uid, $start));
		$smarty_page = 't_ajax/profile/profile.tab_posts_list';
	break;
	case 'topics_load_more':
		$start = intval($_POST['start']);
		$uid = intval($_POST['user']);
		$smarty->assign('u_topics', $profile->get_topics($uid, $start));
		$smarty_page = 't_ajax/profile/profile.tab_topics_list';
	break;
	case 'images_load_more':
		$start = intval($_POST['start']);
		$uid = intval($_POST['user']);
		$smarty->assign('u_images', $profile->get_images($uid, $start));
		$smarty_page = 't_ajax/profile/profile.tab_images_list';
	break;
	case 'states_load_more':
		$start = intval($_POST['start']);
		$uid = intval($_POST['user']);
		$smarty->assign('u_states', $profile->states($uid, $start));
		$smarty_page = 't_ajax/profile/profile.tab_states_list';
	break;
	case 'follows_load_more':
		$start = intval($_POST['start']);
		$uid = intval($_POST['user']);
		require_once'PHP/libs/datos.php';
		$smarty->assign('u_follows', $profile->get_follows($uid, $start));
		$smarty->assign('data_paises', $array_data['paises']);
		$smarty_page = 't_ajax/profile/profile.tab_follows_list';
	break;
	case 'following_load_more':
		$start = intval($_POST['start']);
		$uid = intval($_POST['user']);
		require_once'PHP/libs/datos.php';
		$smarty->assign('u_following', $profile->get_following($uid, $start));
		$smarty->assign('data_paises', $array_data['paises']);
		$smarty_page = 't_ajax/profile/profile.tab_following_list';
	break;
	case 'comus_load_more':
		$start = intval($_POST['start']);
		$uid = intval($_POST['user']);
		$smarty->assign('u_comus', $profile->get_comus($uid, $start));
		$smarty_page = 't_ajax/profile/profile.tab_comus_list';
	break;
	default:
		die('0: Lo que buscas no se encuentra por aqu&iacute;');
	break;
}
?>