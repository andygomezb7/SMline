<?php
if(!defined('UNTARGETED')) die('Lo que buscas no se encuentra por aqu&iacute;');
class search{
	function buscar($q, $get_data){
		global $mysqli;
		// VARIABLE SEGURA
		$q = secure($q);
		// PAGINACION
		$limit = 20;
		$page = intval($_GET['page']);
		if(empty($page)){
			$start = 0;
			$page = 1;
		}else $start = ($page - 1) * $limit;
		// TIPOS DE BUSQUEDA
		switch($type){
			case 'temas':
			break;
			default:
				// BUSCAR COMO
				$search_in = array('body' => 'p_body', 'tags' => 'p_tags');
				$search_as = $search_in[$get_data['as']];
				if(empty($search_as)) $search_as = 'p_title';
				// ORDEN
				$search_order = array('puntos' => 'p.p_puntos', 'fecha' => 'p.p_date');
				$s_order = $search_order[$get_data['order']];
				if(empty($s_order)) $s_order = 'us.u_points';
				// CATEGORIA
				if($get_data['cat'] > 0) $w_cat = 'AND p.p_cat = \''.$get_data['cat'].'\'';
				if($get_data['author']) $w_autor = 'AND LOWER(u.u_nick) = \''.strtolower($get_data['author']).'\'';
				// MODO DE BUSQUEDA MAS CONVENIENTE
				$espacios = explode(' ', $q);
				if(count($espacios) > 2) $buscar = 'AND MATCH (p.'.$search_as.') AGAINST (\''.$q.'\' IN BOOLEAN MODE)';
				else $buscar = 'AND p.'.$search_as.' LIKE \'%'.$q.'%\'';
				// COLSUTA :3
				$query = $mysqli->query('SELECT c.c_seo, c.c_img, c.c_name, p.p_id, p.p_title, p.p_status, p.p_sticky, p.p_update, p.p_hits, p.p_puntos, p.p_comments, p.p_date, u.u_id, u.u_nick, u.u_last_avatar FROM posts AS p LEFT JOIN posts_cats AS c ON p.p_cat = c.c_id LEFT JOIN users AS u ON u.u_id = p.p_user LEFT JOIN users_stats AS us ON us.u_id = u.u_id WHERE p.p_status = \'1\' '.$buscar.' '.$w_cat.' '.$w_autor.' ORDER BY '.$s_order.' DESC LIMIT '.$start.', '.$limit) or die($mysqli->error);
				$result['total'] = $mysqli->query('SELECT c.c_seo, c.c_img, c.c_name, p.p_id, p.p_title, p.p_status, p.p_sticky, p.p_update, p.p_hits, p.p_puntos, p.p_comments, p.p_date, u.u_nick FROM posts AS p LEFT JOIN posts_cats AS c ON p.p_cat = c.c_id LEFT JOIN users AS u ON u.u_id = p.p_user LEFT JOIN users_stats AS us ON us.u_id = u.u_id WHERE p.p_status = \'1\' '.$buscar.' '.$w_cat.' '.$w_autor)->num_rows;
			break;
		}
		while($row = $query->fetch_assoc()) $result['list'][] = $row;
		
		$s_url = '/buscar?';
		foreach($get_data AS $key => $val){
			$s_url .= $key.'='.$val.'&';
		}
		// PAGINAS
		if($result['total']) $result['pages'] = $this->pag($page, $result['total'], $limit, $s_url);
		return $result;
	}
	
	// PAGINACION
	function pag($page, $registros, $max, $url){
		$return = '<div class="paginas pag_recent" align="center">';
		if(($page - 1) > 0) $return .= '<a id="btn" title="Anterior" href="'.$url.'page='.($page - 1).'">&#171;</a>';
		$total_pages = ceil($registros / $max);
		for ($i=1; $i<=$total_pages; $i++){
			if($page == $i) $return .= '<a class="numero active">'.$page.'</a>';
			else{
				if(($i < ($page + 4) && $i > ($page - 4)) && $i < ($total_pages+1)) $return .= '<a class="numero" href="'.$url.'page='.$i.'">'.$i.'</a>';
			}
		}
		if(($page + 1)<=$total_pages) $return .= '<a id="btn" title="Siguiente" href="'.$url.'page='.($page + 1).'">&#187;</a>';
		$return .= '</div>';
		return $return;
	}
	
}
?>