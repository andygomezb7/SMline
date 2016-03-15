<?php
if(!defined('UNTARGETED')) die('Lo que buscas no se encuentra por aqu&iacute;');
if(empty($user->permits['goadmin'])) die('0: No se te permite realizar esta acci&oacute;n');
$action_permit = array(
					// CONFIGS
					'save_settings' => 'ecds',
					'save_setting' => 'ecds',
					// NOTICIAS
					'add_new' => 'aebn',
					'upd_new' => 'aebn',
					'del_new' => 'aebn',
					// PUBLI
					'save_ads' => 'ebp',
					// LINKS
					'add_link' => 'aebli',
					'upd_link' => 'aebli',
					'del_link' => 'aebli',
					// BLOQUEOS
					'add_lock' => 'abib',
					'del_lock' => 'abib',
					// CENSURAS
					'add_cen' => 'abpc',
					'del_cen' => 'abpc',
					// MEDALLAS
					'add_medal' => 'aebm',
					'save_medal' => 'aebm',
					'del_medal' => 'aebm',
					'del_medal_assign' => 'aebm',
					// RANGOS
					'add_rank' => 'aebr',
					'save_rank' => 'aebr',
					'rank_del_form' => 'aebr',
					'rank_del' => 'aebr',
					// CATS
					'add_cat' => 'aebc',
					'save_cat' => 'aebc',
					'cat_del_form' => 'aebc',
					'cat_del' => 'aebc',
					// USERS
					'user_save' => 'aeu',
					// MENSAJES
					'read_mp' => 'acm',
					'del_mp' => 'acm',
				);
if(empty($user->permits[$action_permit[$action]])) die('0: No tienes permisos para realizar esta acci&oacute;n');
require'PHP/class/admin.class.php';
$admin = new admin;
switch($action){
	case 'save_settings':
		echo $admin->save_settings();
	break;
	case 'save_setting':
		$_POST['val'] = empty($_POST['val']) ? 0 : 1;
		echo $admin->save_settings();
	break;
	case 'add_new':
		echo $admin->add_new();
	break;
	case 'upd_new':
		echo $admin->upd_new();
	break;
	case 'del_new':
		echo $admin->del_new();
	break;
	case 'save_ads':
		echo $admin->save_ads();
	break;
	case 'add_link':
		echo $admin->add_link();
	break;
	case 'upd_link':
		echo $admin->upd_link();
	break;
	case 'del_link':
		echo $admin->del_link();
	break;
	case 'add_lock':
		echo $admin->add_lock();
	break;
	case 'del_lock':
		echo $admin->del_lock();
	break;
	case 'add_cen':
		echo $admin->add_cen();
	break;
	case 'del_cen':
		echo $admin->del_cen();
	break;
	case 'add_rank':
		echo $admin->add_rank();
	break;
	case 'save_rank':
		$r_id = intval($_POST['r_id']);
		echo $admin->save_rank($r_id);
	break;
	case 'rank_del_form':
		$r_id = intval($_POST['r_id']);
		$smarty->assign('rank', $admin->rank_info($r_id));
		$smarty->assign('ranks1', $admin->ranks(1));
		$smarty->assign('ranks0', $admin->ranks(0));
		$smarty_page = 't_ajax/rank_del_form';
	break;
	case 'rank_del':
		$r_id = intval($_POST['r_id']);
		echo $admin->rank_del($r_id);
	break;
	case 'add_medal':
		echo $admin->add_medal();
	break;
	case 'save_medal':
		$m_id = intval($_POST['m_id']);
		echo $admin->save_medal($m_id);
	break;
	case 'del_medal':
		$m_id = intval($_POST['m_id']);
		echo $admin->del_medal($m_id);
	break;
	case 'del_medal_assign':
		$ma_id = intval($_POST['ma_id']);
		echo $admin->del_medal_assign($ma_id);
	break;
	
	case 'read_mp':
		$mp_id = intval($_POST['mp_id']);
		$smarty->assign('data_mp', $admin->read_mp($mp_id));
		$smarty_page = 't_ajax/admin.read_mp';
		if(!is_array($admin->read_mp($mp_id))){
			echo $admin->read_mp($mp_id);
			die;
		}
	break;
	case 'del_mp':
		$mp_id = intval($_POST['mp_id']);
		echo $admin->del_mp($mp_id);
	break;
	
	case 'add_cat':
		echo $admin->add_cat();
	break;
	case 'save_cat':
		echo $admin->save_cat();
	break;
	case 'cat_del_form':
		$c_id = intval($_POST['c_id']);
		$smarty->assign('cinfo', $admin->cat_info($c_id));
		$smarty->assign('cats', $admin->cats());
		$smarty_page = 't_ajax/cat_del_form';
	break;
	case 'cat_del':
		$c_id = intval($_POST['c_id']);
		echo $admin->cat_del($c_id);
	break;
	case 'user_save':
		$uid = intval($_POST['u_id']);
		echo $admin->user_save($uid);
	break;
	default:
		die('0: Lo que buscas no se encuentra por aqu&iacute;');
	break;
}
?>