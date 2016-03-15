<?php
$smarty_page = 'profile';
$page['css'] = 'profile';
$page['js'] = 'profile';
$page['title'] = $web['title'].' - '.$web['slogan'];
require'PHP/class/profile.class.php';
$profile = new profile;
$u_nick = $act;
$u_info = $profile->get($u_nick);
$state_id = intval($_GET['status_id']);
if($u_info['u_id']){
	$smarty->assign('u_info', $u_info);
	$smarty->assign('u_states', $profile->states($u_info['u_id']));
	$smarty->assign('list_medals', $profile->medals($u_info['u_id']));
	$smarty->assign('u_followers', $profile->followers($u_info['u_id']));
	$smarty->assign('u_following', $profile->following($u_info['u_id']));
	$page['title'] = $u_info['u_nick'].' - '.$web['title'];
	//
	if($state_id) $smarty->assign('u_state', $profile->get_state($state_id));
	// METAS
	$page['meta_dc']['date'] = date('Y-m-d G:i:s', $u_info['u_date']);
	$page['meta']['type'] = 'profile';
	$page['meta']['title'] = 'Perfil de '.$u_info['u_nick'].' en '.$web['title'];
	$page['meta']['image'] = $web['url'].'/avatar/'.$u_info['u_id'].'_120.jpg';
	$page['meta']['description'] = $u_info['u_nick'].' es '.($u_info['u_sex'] == 0 ? 'un hombre' : 'una mujer').', vive en '.$u_info['u_country_name'].' y se registr&oacute; el '.$u_info['u_register'][0].' de '.$u_info['u_register'][1].' del '.$u_info['u_register'][2];

}else{
	$smarty->assign('error', array('Error 404', 'Lo que buscas no se encuentra por aqu&iacute;', 'Ir al inicio', '/'));
	$smarty->assign('page', array('title' => $web['title'].' - Error'));
	$smarty->display('error.tpl');
	die;
}
$smarty->assign('page', $page);
?>