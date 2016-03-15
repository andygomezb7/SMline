<?php
$smarty_page = 'admin';
$page['js'] = array('admin');
$page['title'] = $web['title'];

if(empty($user->permits['goadmin'])) die('0: No se te permite realizar esta acci&oacute;n');
$action_permit = array(
	'settings' => 'ecds',
	'themes' => 'etds',
	'news' => 'aebn',
	'links' => 'aebli',
	'ads' => 'ebp',
	'blocked' => 'abib',
	'censored' => 'abpc',
	'posts' => 'acp',
	'gallery' => 'acf',
	'users' => 'aeu',
	'cats' => 'aebc',
	'ranks' => 'aebr',
	'medals' => 'aebm',
	'mps' => 'acm',
	'stats' => 'as'
);

require'PHP/class/admin.class.php';
$admin = new admin;
$do = secure($_GET['do']);

if(empty($user->permits['goadmin']) || (empty($user->permits[$action_permit[$do]]) && $do)){
	$smarty->assign('error', array('Oops!', 'No tienes permiso para esto', 'Ir a administraci&oacute;n', '/admin'));
	$smarty->assign('page', array('title' => $web['title'].' - Error'));
	$smarty->display('error.tpl');
	die;
}

$status = secure($_GET['status']);
$action = secure($_GET['action']);
$r_id = intval($_GET['r_id']);
$smarty->assign('do', $do);
$smarty->assign('status', $status);
$smarty->assign('action', $action);
switch($do){
	case 'news':
		$smarty->assign('news', $admin->news());
	break;
	case 'themes':
		switch($action){
			case 'install':
				if($_POST['install']){
					$smarty->assign('t_seo', secure($_POST['t_seo']));
					$result_install = $admin->install_theme();
					if(!is_array($result_install)) $smarty->assign('install_error', $result_install);
					else ira($web['url'].'/admin?do=themes&status=ok_install');
				}
			break;
			case 'uninstall':
				$data_theme = $admin->data_theme();
				if(!is_array($data_theme) || $data_theme['t_seo'] == $web['theme']) ira($web['url'].'/admin?do=themes');
				$smarty->assign('data_theme', $data_theme);
				if($_POST['uninstall']){
					$result_uninstall = $admin->uninstall_theme();
					if(!$result_uninstall) ira($web['url'].'/admin?do=themes&status=error_uninstall');
					else ira($web['url'].'/admin?do=themes&status=ok_uninstall');
				}
			break;
			case 'aplicar':
				$data_theme = $admin->data_theme();
				if(!is_array($data_theme) || $data_theme['t_seo'] == $web['theme']) ira($web['url'].'/admin?do=themes');
				$smarty->assign('data_theme', $data_theme);
				if($_POST['aplicar']){
					$result_aplicar = $admin->aplicar_theme();
					if(!$result_aplicar) ira($web['url'].'/admin?do=themes&status=error_aplicar');
					else ira($web['url'].'/admin?do=themes&status=ok_aplicar');
				}
			break;
			default:
				$page['css'][] = 'favorites';
				$smarty->assign('themes', $admin->get_themes());
			break;
		}
	break;
	case 'links':
		$smarty->assign('links_i', $admin->links_i());
	break;
	case 'blocked':
		$smarty->assign('get_locks', $admin->get_locks());
	break;
	case 'censored':
		$smarty->assign('censored', $admin->censored());
	break;
	case 'posts':
		$smarty->assign('a_posts', $admin->posts());
	break;
	case 'gallery':
		$smarty->assign('get_images', $admin->get_images());
	break;
	case 'users':
		switch($action){
			case 'add':
			case 'edit':
				$uid = intval($_GET['uid']);
				$smarty->assign('ranks_e', $admin->ranks(1));
				$smarty->assign('ranks_n', $admin->ranks(0));
				$smarty->assign('u_info', $admin->user_info($uid));
			break;
			default:
				$qu = secure($_GET['qu']);
				$smarty->assign('qu', $qu);
				$smarty->assign('adm_users', $admin->get_users());
			break;
		}
	break;
	case 'cats':
		switch($action){
			case 'add':
			case 'edit':
				$c_id = intval($_GET['c_id']);
				$smarty->assign('c_icons', $admin->get_icons('cats'));
				if($action == 'edit') $smarty->assign('cinfo', $admin->cat_info($c_id));
			break;
			default:
				$smarty->assign('cats', $admin->cats());
			break;
		}
	break;
	case 'ranks':
		switch($action){
			case 'add':
			case 'edit':
				$smarty->assign('r_icons', $admin->get_icons('ranks'));
				if($action == 'edit') $smarty->assign('rinfo', $admin->rank_info($r_id));
			break;
			case 'see':
				$smarty->assign('see_rank', $admin->see_rank($r_id));
			break;
			default:
				$smarty->assign('ranks_e', $admin->ranks(1));
				$smarty->assign('ranks_n', $admin->ranks(0));
			break;
		}
	break;
	case 'medals':
		$m_id = intval($_GET['m_id']);
		switch($action){
			case 'add':
			case 'edit':
				$smarty->assign('m_icons', $admin->get_icons('medals'));
				$smarty->assign('m_types', $admin->medals_types());
				$smarty->assign('ranks_e', $admin->ranks(1));
				$smarty->assign('ranks_n', $admin->ranks(0));
				if($action == 'edit') $smarty->assign('minfo', $admin->medal_info($m_id));
			break;
			case 'see':
				$smarty->assign('see_medal', $admin->see_medal($m_id));
			break;
			default:
				$smarty->assign('get_medals', $admin->get_medals(1));
			break;
		}
	break;
	case 'mps':
		$page['css'][] = 'messages';
		$page['css'][] = 'post';
		$smarty->assign('get_mps', $admin->get_mps());
	break;
	case 'stats':
		$smarty->assign('get_stats', $admin->get_stats());
	break;
	default:
		$admin->set_access();
		$version_data = array(
			'smarty' => $smarty->SMARTY_VERSION,
			'php' => PHP_VERSION,
			'mysqli' => $mysqli->query('SELECT VERSION() AS version')->fetch_assoc(),
		);
		$smarty->assign('version', $version_data);
		$smarty->assign('get_access', $admin->get_access());
		$smarty->assign('get_admins', $admin->get_admins());
	break;
}

$smarty->assign('page', $page);
?>