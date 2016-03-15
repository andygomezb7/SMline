<?php
$smarty_page = 'images';
$page['title'] = 'Galer&iacute;a de im&aacute;genes - '.$web['title'];
require'PHP/class/images.class.php';
$img = new img;
$img_id = intval($_GET['img_id']);
$do = secure($_GET['do']);
if($img_id){
	$img_title = secure($_GET['img_title']);
	$smarty_page = 'image';
	$page['css'] = 'post';
	$page['js'] = 'image';
	$image = $img->get_img($img_id, $img_title);
	$smarty->assign('image', $image);
	$page['title'] = $image['i_title'].' - '.$web['title'];
}else{
	switch($do){
		case 'agregar':
			$page['title'] = 'Agregar imagen - '.$web['title'];
			$page['css'] = 'add';
			$page['js'] = 'agregar-img';
			$imgid = intval($_GET['imgid']);
			if($imgid){
				$imginfo = $img->get_edit_img($imgid);
				if(is_array($imginfo)){
					$smarty->assign('imginfo', $imginfo);
					$page['title'] = 'Editar imagen - '.$web['title'];
				}else{
					$smarty->assign('error', array('Oops!', $imginfo, 'Ir al inicio', '/'));
					$smarty->assign('page', array('title' => $web['title'].' - Error'));
					$smarty->display('error.tpl');
					die;
				}
			}
		break;
		case 'historial':
			$page['title'] = $web['title'].' - Historial de moderaci&oacute;n';
			$page['css'] = array('favorites', 'history');
			$smarty->assign('get_history', $img->get_history());
		break;
		default:
			$page['css'] = 'images';
			$page['js'] = 'images';
			$smarty->assign('last_images', $img->last_images());
			$smarty->assign('stats', $img->stats());
			$smarty->assign('last_comments', $img->last_comments());
		break;
	}
}
$smarty->assign('sm_page', $smarty_page);
$smarty->assign('page', $page);
$smarty->assign('do', $do);
?>