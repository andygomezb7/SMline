<?php
if($web['port_posts']) $smarty_page = 'home_portadas';
else $smarty_page = 'home';
$page['title'] = $web['title'].' - '.$web['slogan'];
require'PHP/class/posts.class.php';
$posts = new posts;
$post_id = intval($_GET['post_id']);
if($post_id){
	$cat_seo = secure($_GET['cat_seo']);
	$post_title = secure($_GET['post_title']);
	$smarty_page = 'post';
	$page['css'] = 'post';
	$page['js'] = 'post';
	$post = $posts->get_post($post_id, $cat_seo, $post_title);
	$smarty->assign('post', $post);
	// POST ELIMINADO/REVISION
	if(count($post) == 3){
		$page['title'] = $web['title'].' - Error';
		$smarty->assign('page', $page);
		$smarty->display('post-error.tpl');
		die;
	}
	$page['title'] = $post['p_title'].' - '.$web['title'];
	
	$page['meta_dc']['date'] = date('Y-m-d G:i:s', $post['p_date']);
	$page['meta_dc']['creator'] = $post['u_nick'];
	$page['meta']['type'] = 'article';
	$page['meta']['url'] = $web['url'].'/posts/'.$post['c_seo'].'/'.$post['p_id'].'/'.seo($post['p_title']).'.html';
	$page['meta']['title'] = $post['p_title'];
	$page['meta']['image'] = $web['url'].'/avatar/'.$post['u_id'].'_120.jpg';
	$page['meta']['description'] =  get_meta_description($post['p_html'], $post['p_title']);
	$page['meta_tags'] = $post['p_tags'];
}else{
	if($web['port_posts']) $page['css'] = 'home_portadas';
	else $page['css'] = 'home';
	$page['js'] = 'home';
	$cat = secure($_GET['cat_seo']);
	if($cat){
		$cinfo = $posts->cat_info($cat);
		$smarty->assign('cinfo', $cinfo);
		$page['title'] = $cinfo['c_name'].' - '.$web['title'];
	}
	$smarty->assign('last_posts', $posts->last_posts(0, false, $cat));
	if(empty($cat)) $smarty->assign('last_stickys', $posts->last_posts(0, true));
	$smarty->assign('stats', $posts->stats());
	$smarty->assign('last_comments', $posts->last_comments($cat));
	$smarty->assign('top_posts', $posts->top_posts());
	$smarty->assign('top_users', $posts->top_users());
	$smarty->assign('h_news', $posts->news());
	$smarty->assign('links_i', $posts->links_i());
	$smarty->assign('last_members', $posts->last_members());
}
$smarty->assign('cats', $posts->cats());
$smarty->assign('page', $page);
?>