<?php
// VARIABLES PRINCIPALES
$smarty_page = 'tops';
$page['css'] = array('tops', 'home', 'search');
$page['js'] = '';
$page['title'] = $web['title'].' - Tops';

// FILTRO
$date = intval($_GET['date']);
$cat = intval($_GET['cat']);
$do = secure($_GET['do']);
if($date > 5 || $date < 1) $date = 5;

// CLASE
require'PHP/class/tops.class.php';
$tops = new tops;

// ASIGNAMOS VARIABLES
switch($do){
	case 'usuarios':
		$smarty->assign('users_puntos', $tops->get_users($date, 'puntos'));
		$smarty->assign('users_seguidores', $tops->get_users($date, 'seguidores'));
		$smarty->assign('users_comentarios', $tops->get_users($date, 'comentarios'));
		$smarty->assign('users_posts', $tops->get_users($date, 'posts'));
	break;
	case 'comunidades':
		$smarty->assign('comus_populares', $tops->get_comus($date, 'populares'));
		$smarty->assign('comus_temas', $tops->get_comus($date, 'temas'));
		$smarty->assign('comus_seguidores', $tops->get_comus($date, 'seguidores'));
		$smarty->assign('cats', $tops->comus_cats());
	break;
	default:
		$smarty->assign('posts_puntos', $tops->get_posts($date, 'puntos'));
		$smarty->assign('posts_favoritos', $tops->get_posts($date, 'favoritos'));
		$smarty->assign('posts_seguidores', $tops->get_posts($date, 'seguidores'));
		$smarty->assign('posts_comentarios', $tops->get_posts($date, 'comentarios'));
		$smarty->assign('cats', $tops->posts_cats());
	break;
}

$smarty->assign('filter', array('date' => $date, 'cat' => $cat));
$smarty->assign('t_action', $do);

$smarty->assign('page', $page);
?>