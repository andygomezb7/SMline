<?php
$smarty_page = 'communities';
$page['css'] = 'comu';
$page['title'] = $web['title'].' - Comunidades';
require'PHP/class/comus.class.php';
$comus = new comus;
require'PHP/class/topics.class.php';
$topics = new topics;
$c_action = secure($_GET['c_action']);
$comu_seo = secure($_GET['comu_seo']);
$do = secure($_GET['do']);
if($do) $c_action = $do;

if($comu_id) $smarty->assign('c_user', $comus->c_user($comu_id));//myRank

$smarty->assign('c_action', $c_action);

switch($c_action){
	case '':
		$page['css'] = 'home';
		$page['js'] = 'communities-home';
		$cat = secure($_GET['cat']);
		if($cat){
			$cinfo = $comus->cat_info($cat);
			$smarty->assign('cinfo', $cinfo);
			$page['title'] = $cinfo['c_name'].' - '.$web['title'];
		}
		$smarty->assign('last_topics', $topics->home_last_topics(0, $cat));
		$smarty->assign('stats', $comus->stats());
		$smarty->assign('last_comments', $topics->home_last_comments($cat));
		$smarty->assign('top_comus', $comus->home_top_comus());
		$smarty->assign('recent_comus', $comus->recent_comus());
		$smarty->assign('popular_comu', $comus->popular_comu());
		$smarty->assign('comus_cats', $comus->cats());
	break;
	case 'mis-comunidades':
		if(empty($user->uid)) $sm_error = 'Esta secci&oacute;n es exclusiva para usuarios registrados';
		$page['title'] = $web['title'].' - Mis comunidades';
		$smarty->assign('order', secure($_GET['order']));
		$smarty->assign('mis_comus', $comus->mis_comus());
	break;
	case 'crear':
		if(empty($user->uid)) $sm_error = 'Esta secci&oacute;n es exclusiva para usuarios registrados';
		if(empty($user->permits['ccs'])) $sm_error = 'Tu rango no te permite crear comunidades';
		$page['css'] = 'add';
		$page['js'] = 'add-comu';
		$smarty->assign('cats', $comus->cats());
	break;
	case 'edit-comu':
		if(empty($user->permits['ecsp'])) $sm_error = 'Tu rango no te permite editar esta comunidad';
		$page['css'] = 'add';
		$page['js'] = 'add-comu';
		$smarty->assign('cats', $comus->cats());
		$comu_id = $comus->comu_id($comu_seo);
		if(empty($comu_id)) $sm_error = 'La comunidad que buscas no existe';
		$me = $comus->me($comu_id);
		if($me['m_rank'] != 1 && empty($user->permits['ecs'])) $sm_error = 'No tienes permiso para editar esta comunidad';
		$smarty->assign('me', $me);
		$comu = $comus->comu_data($comu_id);
		if($comu['comu_status'] == 0 && !$user->permits['rcs']) $sm_error = 'Esta comunidad se encuentra suspendida';
		$smarty->assign('comu', $comu);
	break;
	case 'admin-members':
		$page['js'] = 'admin-comu';
		$comu_id = $comus->comu_id($comu_seo);
		if(empty($comu_id)) $sm_error = 'La comunidad que buscas no existe';
		$me = $comus->me($comu_id);
		if($me['m_rank'] != 1 && $me['m_rank'] == 2 && !$user->permits['ecs']) $sm_error = 'Solo moderadores de la comunidad puede acceder';
		$smarty->assign('me', $me);
		$comu = $comus->comu_data($comu_id);
		if($comu['comu_status'] == 0 && !$user->permits['rcs']) $sm_error = 'Esta comunidad se encuentra suspendida';
		$smarty->assign('comu', $comu);
		$smarty->assign('comu_members', $topics->comu_members($comu_id, 28));
	break;
	case 'view-comu':
		$comu_id = $comus->comu_id($comu_seo);
		if(empty($comu_id)) $sm_error = 'La comunidad que buscas no existe';
		$me = $comus->me($comu_id);
		if($me['i_admin'] || $me['i_mod']) $comus->auto_unban($comu_id);
		$smarty->assign('me', $me);
		$comu = $comus->comu_data($comu_id);
		if($comu['comu_status'] == 0 && !$user->permits['rcs']) $sm_error = 'Esta comunidad se encuentra suspendida';
		$smarty->assign('comu', $comu);
		$smarty->assign('comu_staff', $topics->comu_staff($comu_id));
		$smarty->assign('last_topics', $topics->last_topics($comu_id));
		$smarty->assign('sticky_topics', $topics->sticky_topics($comu_id));
		$smarty->assign('comu_members', $topics->comu_members($comu_id, 14));
		$smarty->assign('popular_topics', $topics->popular_topics($comu_id));
		$smarty->assign('last_comments', $topics->last_comments($comu_id));
		$page['title'] = $comu['comu_name'].' - '.$web['title'];
		$page['js'] = 'comu';
	break;
	case 'add-topic':
		if(empty($user->permits['pt'])) $sm_error = 'Tu rango no te permite crear temas';
		$comu_id = $comus->comu_id($comu_seo);
		if(empty($comu_id)) $sm_error = 'La comunidad que buscas no existe';
		$me = $comus->me($comu_id);
		$smarty->assign('me', $me);
		$comu = $comus->comu_data($comu_id);
		if($comu['comu_status'] == 0 && !$user->permits['rcs']) $sm_error = 'Esta comunidad se encuentra suspendida';
		if(empty($me['r_id'])) $sm_error = 'Solo miembros de la comunidad puede crear temas en ella';
		if($me['r_id'] > 3) $sm_error = 'Tu rango en esta comunidad no te permite crear temas en ella';
		$smarty->assign('comu', $comu);
		$page['title'] = $comu['comu_name'].' - '.$web['title'];
		$page['js'] = 'add-topic';
	break;
	case 'edit-topic':
		$comu_id = $comus->comu_id($comu_seo);
		if(empty($comu_id)) $sm_error = 'La comunidad que buscas no existe';
		$me = $comus->me($comu_id);
		$smarty->assign('me', $me);
		$comu = $comus->comu_data($comu_id);
		if($comu['comu_status'] == 0 && !$user->permits['rcs']) $sm_error = 'Esta comunidad se encuentra suspendida';
		$edit_topic = $comus->get_edit_topic();
		if(is_array($edit_topic)) $smarty->assign('topic', $edit_topic);
		else $sm_error = $edit_topic;
		$smarty->assign('comu', $comu);
		$page['title'] = $comu['comu_name'].' - '.$web['title'];
		$page['js'] = 'add-topic';
	break;
	case 'view-topic':
		$topic_id = secure($_GET['topic_id']);
		$cat_seo = secure($_GET['comu_seo']);
		$topic_title = secure($_GET['topic_title']);
		$page['css'] = array('post', 'comu');
		$page['js'] = array('topic', 'comu');
		$topic = $comus->get_topic($topic_id, $comu_seo, $topic_title);
		$smarty->assign('topic', $topic);
		// POST ELIMINADO/REVISION
		if(count($topic) == 3){
			$page['title'] = $web['title'].' - Error';
			$smarty->assign('page', $page);
			$smarty->display('topic-error.tpl');
			die;
		}
		$me = $comus->me($topic['comu_id']);
		$smarty->assign('me', $me);
		$page['title'] = $topic['t_title'].' - '.$web['title'];
		if(($me['m_rank'] == 1 || $me['m_rank'] == 2) && !$user->permits['gomod'] && !$user->permits['goadmin']){
			$page['js'][] = 'mod-comu';
			$page['css'][] = 'admin';
		}
		$page['meta_dc']['date'] = date('Y-m-d G:i:s', $topic['t_date']);
		$page['meta_dc']['creator'] = $topic['u_nick'];
		$page['meta']['type'] = 'article';
		$page['meta']['url'] = $web['url'].'/comunidades/'.$topic['comu_seo'].'/'.$topic['t_id'].'/'.seo($topic['t_title']).'.html';
		$page['meta']['title'] = $topic['t_title'];
		$page['meta']['image'] = $web['url'].'/avatar/'.$topic['u_id'].'_120.jpg';
		$page['meta']['description'] =  get_meta_description($topic['t_html'], $topic['t_title']);
	break;
	case 'historial':
		$page['title'] = $web['title'].' - Historial de moderaci&oacute;n';
		$page['css'] = array('favorites', 'history');
		$smarty->assign('get_history', $topics->get_history());
	break;
	default:
		header('location: /comunidades');
	break;
}

if($sm_error){
	$smarty->assign('error', array('Error', $sm_error, 'Ir al inicio', '/comunidades'));
	$smarty->assign('page', array('title' => $web['title'].' - Error'));
	$smarty->display('error.tpl');
	die;
}

$smarty->assign('page', $page);
?>