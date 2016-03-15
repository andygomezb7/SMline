<?php
/*! Powered by SMline.NET */
if(!defined('UNTARGETED')) die('Lo que buscas no se encuentra por aqu&iacute;');
class topics{
	function home_last_topics($page, $cat){
		global $mysqli, $user;
		$web['max_topics'] = 20;
		if(empty($page)){
			$inicio = 0;
			$page = 1;
		}else $inicio = ($page - 1) * $web['max_topics'];
		if($cat){
			$query_cat = $mysqli->query('SELECT c_id FROM comus_cats WHERE c_seo = \''.$cat.'\' LIMIT 1');
			$data_cat = $query_cat->fetch_assoc();
			if(empty($data_cat)) header('location: /comunidades');
			else $w_cat = true;
		}
		if(!$user->permits['goadmin'] && !$user->permits['gomod']) $hide_topics = 'AND t.t_status = \'1\' AND co.comu_status = \'1\'';
		$sql['list'] = $mysqli->query('SELECT t.*, co.*, ca.*, u.u_id, u.u_nick, u.u_last_avatar FROM comus_topics AS t LEFT JOIN comus AS co ON co.comu_id = t.t_comu LEFT JOIN comus_cats AS ca ON ca.c_id = co.comu_cat LEFT JOIN users AS u ON u.u_id = t.t_user WHERE t.t_id '.$hide_topics.' '.($w_cat ? 'AND co.comu_cat = \''.$data_cat['c_id'].'\'' : '').' ORDER BY t.t_id DESC LIMIT '.$inicio.', '.$web['max_topics']);
		while($row = $sql['list']->fetch_assoc()) $result['list'][] = $row;
		// PAGINACION
		$sql['total'] = $mysqli->query('SELECT t.t_id AS total FROM comus_topics AS t LEFT JOIN comus AS co ON co.comu_id = t.t_comu WHERE t.t_id '.$hide_topics.' '.($w_cat ? 'AND co.comu_cat = \''.$data_cat['c_id'].'\'' : '').'');
		$result['pages'] = $this->home_topics_pag($page, $sql['total']->num_rows, $web['max_topics'], $cat);
		return $result;
	}
	
	function home_topics_pag($page, $registros, $max, $cat){
		if($registros <= $max) return false;
		$quote = "'";
		$return = '<div class="paginas pag_recent" align="center">';
		if(($page - 1) > 0) $return .= '<a id="btn" title="Siguiente" onclick="to_page('.($page - 1).', '.$quote.$cat.$quote.')">&#171;</a>';
		$total_pages = ceil($registros / $max);
		for ($i=1; $i<=$total_pages; $i++){
			if($page == $i) $return .= '<a class="numero active">'.$page.'</a>';
			else{
				if(($i < ($page + 4) && $i > ($page - 4)) && $i < ($total_pages+1)) $return .= '<a class="numero" onclick="to_page('.$i.', '.$quote.$cat.$quote.')">'.$i.'</a>';
			}
		}
		if(($page + 1)<=$total_pages) $return .= '<a id="btn" title="Siguiente" onclick="to_page('.($page + 1).', '.$quote.$cat.$quote.')">&#187;</a>';
		$return .= '</div>';
		return $return;
	}
	
	function home_last_comments($cat){
		global $mysqli;
		$query = $mysqli->query('SELECT c.c_seo, c.c_img, c.c_name, t.t_id, t.t_title, cm.c_id, u.u_nick, co.comu_seo FROM comments AS cm LEFT JOIN comus_topics AS t ON t.t_id = cm.c_type_id LEFT JOIN users AS u ON u.u_id = cm.c_user LEFT JOIN comus AS co ON co.comu_id = t.t_comu LEFT JOIN comus_cats AS c ON co.comu_cat = c.c_id WHERE cm.c_status = \'1\' AND (cm.c_type = \'5\' OR cm.c_type = \'6\') AND t.t_status = \'1\' '.($cat ? 'AND c.c_seo = \''.$cat.'\'' : '').' ORDER BY cm.c_id DESC LIMIT 10');
		while($row = $query->fetch_assoc()) $result[] = $row;
		return $result;
	}
	
	function follow_topic($topic_id){
		global $mysqli, $user, $activity;
		if($user->info['u_flood_follow'] > $user->info['flood']) return '0: No puedes realizar tantas acciones seguidas, int&eacute;ntalo de nuevo en unos instantes';
		$query_topic = $mysqli->query('SELECT t_user FROM comus_topics WHERE t_id = \''.$topic_id.'\' LIMIT 1');
		$data_topic = $query_topic->fetch_assoc();
		if(!$data_topic['t_user']) return '0: El tema no existe o fue eliminado';
		if($data_topic['t_user'] == $user->uid) return '0: No puedes seguir temas que tu iniciaste';
		$query = $mysqli->query('SELECT f_type FROM follows WHERE f_user = \''.$user->uid.'\' AND f_type_id = \''.$topic_id.'\' AND f_type = \'5\' LIMIT 1');
		$data = $query->fetch_assoc();
		if(empty($data['f_type'])){
			if($mysqli->query('INSERT INTO follows (f_type, f_type_id, f_user, f_date) VALUES (\'5\', \''.$topic_id.'\', \''.$user->uid.'\', \''.time().'\')')){
				$mysqli->query('UPDATE comus_topics SET t_followers = t_followers + 1 WHERE t_id = \''.$topic_id.'\'');
				$mysqli->query('UPDATE users_stats SET u_flood_follow = \''.time().'\' WHERE u_id = \''.$user->uid.'\'');
				//$activity->insert(20, $topic_id, $user->uid);
				return '1: Software by <b>SMline</b>';
			}else return '0: No se pudo completar lo operaci&oacute;n';
		}else return '0: Ya est&aacute;s siguiendo este tema';
	}
	
	function unfollow_topic($topic_id){
		global $mysqli, $user, $activity;
		$query = $mysqli->query('SELECT f_type FROM follows WHERE f_user = \''.$user->uid.'\' AND f_type_id = \''.$topic_id.'\' AND f_type = \'5\' LIMIT 1');
		$data = $query->fetch_assoc();
		if($data['f_type']){
			if($mysqli->query('DELETE FROM follows WHERE f_type = \'5\' AND f_user = \''.$user->uid.'\' AND f_type_id = \''.$topic_id.'\' LIMIT 1')){
				$mysqli->query('UPDATE comus_topics SET t_followers = t_followers - 1 WHERE t_id = \''.$topic_id.'\'');
				//$activity->delete(20, $topic_id, $user->uid);
				return '1: Software by <b>SMline</b>';
			}else return '0: No se pudo completar lo operaci&oacute;n';
		}else return '0: No est&aacute;s siguiendo este tema';
	}

	function favorite_topic($topic, $action){
		global $mysqli, $user, $activity;
		if($action == 0){
			if($user->info['u_flood_topics'] > $user->info['flood']) return '0: No puedes realizar tantas acciones seguidas, int&eacute;ntalo de nuevo en unos instantes';
			$query_topic = $mysqli->query('SELECT t_user FROM comus_topics WHERE t_id = \''.$topic.'\' LIMIT 1');
			$data_topic = $query_topic->fetch_assoc();
			if(!$data_topic['t_user']) return '0: El tema que buscas no existe o fue eliminado';
			if($user->uid == $data_topic['t_user']) return '0: No puedes agregar a favoritos tus propios temas';
			$query = $mysqli->query('SELECT f_id FROM favorites WHERE f_user = \''.$user->uid.'\' AND f_type_id = \''.$topic.'\' AND f_type = \'5\' LIMIT 1');
			$data = $query->fetch_assoc();
			if(empty($data['f_id'])){
				if($mysqli->query('INSERT INTO favorites (f_type, f_type_id, f_user, f_date) VALUES (\'5\', \''.$topic.'\', \''.$user->uid.'\', \''.time().'\')')){
					$mysqli->query('UPDATE users_stats SET u_flood_topics = \''.time().'\' WHERE u_id = \''.$user->uid.'\'');
					$mysqli->query('UPDATE comus_topics SET t_favs = t_favs + 1 WHERE t_id = \''.$topic.'\'');
					$activity->insert(40, $topic, $user->uid);
					return '1: Software by <b>SMline</b>';
				}else return '0: No se pudo completar lo operaci&oacute;n';
			}else return '0: Ya est&aacute; en tu lista de <a href="/favoritos">favoritos</a>';
		}
		if($action == 1){
			$query_topic = $mysqli->query('SELECT t_user FROM comus_topics WHERE t_id = \''.$topic.'\' LIMIT 1');
			$data_topic = $query_topic->fetch_assoc();
			if(!$data_topic['t_user']) return '0: El tema que buscas no existe o fue eliminado';
			$query = $mysqli->query('SELECT f_id FROM favorites WHERE f_user = \''.$user->uid.'\' AND f_type_id = \''.$topic.'\' AND f_type = \'5\' LIMIT 1');
			$data = $query->fetch_assoc();
			if($data['f_id']){
				if($mysqli->query('DELETE FROM favorites WHERE f_id = \''.$data['f_id'].'\' LIMIT 1')){
					$mysqli->query('UPDATE comus_topics SET t_favs = t_favs - 1 WHERE t_id = \''.$topic.'\'');
					$activity->delete(40, $topic, $user->uid);
					return '1: Software by <b>SMline</b>';
				}else return '0: No se pudo completar lo operaci&oacute;n';
			}else return '0: No est&aacute; en tu lista de <a href="/favoritos">favoritos</a>';
		}
	}
	
	function share_topic($topic_id){
		global $mysqli, $user, $activity, $notifica;
			$query_topic = $mysqli->query('SELECT t_user FROM comus_topics WHERE t_id = \''.$topic_id.'\' AND t_status = \'1\' LIMIT 1');
			$query_follows = $mysqli->query('SELECT f_type FROM follows WHERE f_type_id = \''.$user->uid.'\' AND f_type = \'1\'');
			if($query_follows->num_rows == 0) return '0: No puedes recomendar temas si no tienes seguidores';
			$data_topic = $query_topic->fetch_assoc();
			if(!$data_topic['t_user']) return '0: El tema que buscas se encuentra eliminado';
			if($user->uid == $data_topic['t_user']) return '0: No puedes recomendar tus propios temas';
			$query = $mysqli->query('SELECT s_type FROM shared WHERE s_type = \'5\' AND s_type_id = \''.$topic_id.'\' AND s_user = \''.$user->uid.'\' LIMIT 1');
			$data = $query->fetch_assoc();
			if(empty($data['s_type'])){
				if($mysqli->query('INSERT INTO shared (s_type, s_type_id, s_user, s_date) VALUES (\'5\', \''.$topic_id.'\', \''.$user->uid.'\', \''.time().'\')')){
					$activity->insert(46, $topic_id, $user->uid);
					$notifica->insert_to_follows(46, $topic_id, $user->uid, 1, $data_post['t_user']);
					$mysqli->query('UPDATE comus_topics SET t_shared = t_shared + 1 WHERE t_id = \''.$topic_id.'\'');
					return '1: El tema fue recomendado a todos tus seguidores';
				}else return '0: No se pudo completar lo operaci&oacute;n';
			}else return '0: Ya has recomendado este tema antes';
	}
	
	function get_edit_comment($cid){
		global $mysqli, $user;
		$query = $mysqli->query('SELECT c_body, c_user FROM comments WHERE c_type = \'5\' AND c_id = \''.$cid.'\' LIMIT 1');
		$data = $query->fetch_assoc();
		if(!$query->num_rows) return '0: La respuesta que buscas ha sido eliminada';
		if(!$user->permits['ec'] && $user->uid != $data['c_user']) return '0: Esta respuesta no te pertenece, no la puedes editar';
		if($user->permits['ecp']){
			return '1: '.$data['c_body'];
		}else return '0: Tu rango no te permite editar repuestas';
	}
	
	function save_comment($cid){
		global $mysqli, $user, $activity;
		$query = $mysqli->query('SELECT c_body, c_user FROM comments WHERE c_type = \'5\' AND c_id = \''.$cid.'\' LIMIT 1');
		$data = $query->fetch_assoc();
		if(!$query->num_rows) return '0: La respuesta que buscas no existe';
		if(!$user->permits['ec'] && $user->uid != $data['c_user']) return '0: Esta respuesta no te pertenece, no la puedes editar';
		if($user->permits['ecp']){
			$body = secure($_POST['comment'], false, true);
			if(es_nulo($body)) return '0: Ingresa una respuesta';
			if($data['c_body'] != $body){
				$mysqli->query('UPDATE comments SET c_body = \''.$body.'\' WHERE c_id = \''.$cid.'\' LIMIT 1');
				//if($user->uid == $data['c_user']) $activity->insert(5, $cid, $user->uid);
			}
			require_once'PHP/libs/bbcode.inc.php';
			$bbcode = new bbcode;
			$body_bb = $bbcode->start(secure($body, false, true));
			return '1: '.$body_bb;
		}else return '0: Tu rango no te permite editar respuestas';
	}
	
	function show_replies($cid){
		global $mysqli;
		$query_comments = $mysqli->query('SELECT c.*, u.u_id, u.u_nick, u.u_last_avatar FROM comments AS c LEFT JOIN users AS u ON u.u_id = c.c_user WHERE c.c_type = \'6\' AND c.c_replie_id = \''.$cid.'\' ORDER BY c.c_id ASC');
		$i = 0;
		require_once'PHP/libs/bbcode.inc.php';
		$bbcode = new bbcode;
		while($row = $query_comments->fetch_assoc()){
			$query_vote = $mysqli->query('SELECT v_id FROM votes WHERE v_type = \'6\' AND v_type_id = \''.$row['c_id'].'\' AND v_user = \''.$user->uid.'\' LIMIT 1');
			$data_vote = $query_vote->fetch_assoc();
			$data[$i] = $row;
			if(!empty($data_vote)) $data['comments'][$i]['vote'] = true;
			$data[$i]['c_body'] = $bbcode->start(secure($row['c_body'], false, true));
			$i++;
		}
		return $data;
	}
	
	function vote_comment($vote, $cid){
		global $mysqli, $user, $activity;
		// VALIDAMOS LA IP
		$_SERVER['REMOTE_ADDR'] = $_SERVER['X_FORWARDED_FOR'] ? $_SERVER['X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
        if(!filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP)) return '0: Su ip no se pudo validar';
		$vote = ($vote == 0) ? '-' : '+';
		// TIENE PERMISOS PARA VOTAR?
		if(!$user->permits['vnc'] && $vote == '-') return '0: Tu rango no te permite votar negativo a las respuestas';
		if(!$user->permits['vpc'] && $vote == '+') return '0: Tu rango no te permite votar positivo a las respuestas';
		// COMPROBAMOS EXCESO DE VOTOS
		$hora = time()-(60*60);
		$query_votes_pos = $mysqli->query('SELECT v_id FROM votes WHERE v_type = \'6\' AND v_val = \'+\' AND v_user = \''.$user->uid.'\' AND v_date > \''.$hora.'\'');
		$query_votes_neg = $mysqli->query('SELECT v_id FROM votes WHERE v_type = \'6\' AND v_val = \'-\' AND v_user = \''.$user->uid.'\' AND v_date > \''.$hora.'\'');
		if($query_votes_pos->num_rows > $user->permits['vpcm']) '0: Ya haz votado positivo bastantes veces por el momento';
		if($query_votes_neg->num_rows > $user->permits['vncm']) '0: Ya haz votado negativo bastantes veces por el momento';
		// OBTENEMOS LOS DATOS DEL COMENTARIO
		$query['comment'] = $mysqli->query('SELECT c_id, c_user, c_votos FROM comments WHERE c_id = \''.$cid.'\' AND c_status = \'1\' LIMIT 1');
		$data['comment'] = $query['comment']->fetch_assoc();
		if(empty($data['comment']['c_id'])) return '0: La respuesta que buscas se encuentra eliminada';
		if($data['comment']['c_user'] == $user->uid) return '0: No puedes votar tus propios comentarios';
		$query['vote'] = $mysqli->query('SELECT v_id FROM votes WHERE v_type = \'6\' AND v_type_id = \''.$cid.'\' AND v_user = \''.$user->uid.'\' LIMIT 1');
		$data['vote'] = $query['vote']->fetch_assoc();
		if(!empty($data['vote']['v_id'])) return '0: No es posible votar a una misma respuesta m&aacute;s de una vez';
		// ACTUALIZAMOS E INSERTAMOS
		$mysqli->query('UPDATE comments SET c_votos = c_votos '.($vote == '+' ? '+ 1' : '- 1').' WHERE c_id = \''.$cid.'\'');
		$mysqli->query('INSERT INTO votes (v_user, v_type, v_type_id, v_val, v_date, v_ip) VALUES (\''.$user->uid.'\', \'6\', \''.$cid.'\', \''.$vote.'\', \''.time().'\', \''.$_SERVER['REMOTE_ADDR'].'\')');
		$actividad = ($vote == '+') ? 11 : 12;
		//$activity->insert($actividad, $cid, $user->uid);
		$new_total = ($vote == '+') ? $data['comment']['c_votos'] + 1 :  $data['comment']['c_votos'] - 1;
		$return = $new_total > 0 ? '+'.$new_total : $new_total;
		return '1: '.$return;
	}
	
	function delete_topic($tid){
		global $mysqli, $user, $activity;
		$query_topic = $mysqli->query('SELECT t_user, t_comu FROM comus_topics WHERE t_id = \''.$tid.'\' AND t_status != \'0\' LIMIT 1');
		$data_topic = $query_topic->fetch_assoc();
		if(empty($user->permits['btp'])) return '0: Tu rango no te permite borrar tus temas';
		if($data_topic['t_user'] != $user->uid) return '0: Este tema no te pertenece, no lo puedes borrar';
		if($data_topic){
			$mysqli->query('UPDATE comus_topics SET t_status = \'0\' WHERE t_id = \''.$tid.'\'');
			$mysqli->query('UPDATE web_stats SET topics = topics - 1');
			$mysqli->query('UPDATE users_stats SET u_topics = u_topics - 1 WHERE u_id = \''.$data_topic['t_user'].'\'');
			$mysqli->query('UPDATE comus SET comu_topics = comu_topics - 1 WHERE comu_id = \''.$data_topic['t_comu'].'\'');
			return '1: El tema fue eliminado correctamente';
		}else return '0: Este tema ya se encuentra eliminado';
	}
	
	function get_history(){
		global $mysqli;
		$query_history = $mysqli->query('SELECT h.h_action, h.h_mod, h.h_reason, h.h_date, u.u_id, u.u_nick, t.t_title, t.t_user, co.comu_name, co.comu_seo FROM history AS h LEFT JOIN users AS u ON u.u_id = h.h_mod LEFT JOIN comus_topics AS t ON t.t_id = h.h_type_id LEFT JOIN comus AS co ON co.comu_id = t.t_comu WHERE h.h_type = \'5\' ORDER BY h.h_id DESC LIMIT 20');
		while($history = $query_history->fetch_assoc()) $data[] = $history;
		return $data;
	}
	
	function last_topics($comu_id){
		global $mysqli;
		$page = intval($_GET['page']);
		$limit = 15;
		if(empty($page)){
			$start = 0;
			$page = 1;
		} else $start = ($page - 1) * $limit;
		$sql['list'] = $mysqli->query('SELECT t.*, co.*, ca.*, u.u_id, u.u_nick, u.u_last_avatar FROM comus_topics AS t LEFT JOIN comus AS co ON co.comu_id = t.t_comu LEFT JOIN comus_cats AS ca ON ca.c_id = co.comu_cat LEFT JOIN users AS u ON u.u_id = t.t_user WHERE t.t_comu = \''.$comu_id.'\' AND t.t_status = \'1\' AND t.t_sticky = \'0\' ORDER BY t.t_id DESC LIMIT '.$start.', '.$limit);
		while($row = $sql['list']->fetch_assoc()) $data['list'][] = $row;
		$sql['total'] = $mysqli->query('SELECT t_id FROM comus_topics WHERE t_comu = \''.$comu_id.'\' AND t_status = \'1\' AND t_sticky = \'0\'');
		if($sql['total']->num_rows > $limit) $data['pages'] = $this->pag($page, $sql['total']->num_rows, $limit, '?', false);
		return $data;
	}
	
	function sticky_topics($comu_id){
		global $mysqli;
		$page = intval($_GET['page']);
		if($page > 1) return false;
		$sql['list'] = $mysqli->query('SELECT t.*, co.*, ca.*, u.u_id, u.u_nick, u.u_last_avatar FROM comus_topics AS t LEFT JOIN comus AS co ON co.comu_id = t.t_comu LEFT JOIN comus_cats AS ca ON ca.c_id = co.comu_cat LEFT JOIN users AS u ON u.u_id = t.t_user WHERE t.t_comu = \''.$comu_id.'\' AND t.t_status = \'1\' AND t.t_sticky = \'1\' ORDER BY t.t_id');
		while($row = $sql['list']->fetch_assoc()) $data['list'][] = $row;
		return $data;
	}
	
	function last_comments($comu_id){
		global $mysqli;
		$query = $mysqli->query('SELECT c.c_seo, c.c_img, c.c_name, t.t_id, t.t_title, cm.c_id, u.u_nick, co.comu_seo FROM comments AS cm LEFT JOIN comus_topics AS t ON t.t_id = cm.c_type_id LEFT JOIN users AS u ON u.u_id = cm.c_user LEFT JOIN comus AS co ON co.comu_id = t.t_comu LEFT JOIN comus_cats AS c ON co.comu_cat = c.c_id WHERE cm.c_status = \'1\' AND (cm.c_type = \'5\' OR cm.c_type = \'6\') AND t.t_status = \'1\' AND co.comu_id = \''.$comu_id.'\' ORDER BY cm.c_id DESC LIMIT 10');
		while($row = $query->fetch_assoc()) $result[] = $row;
		return $result;
	}
	
	function popular_topics($comu_id){
		global $mysqli;
		$sql['list'] = $mysqli->query('SELECT t.*, co.*, ca.* FROM comus_topics AS t LEFT JOIN comus AS co ON co.comu_id = t.t_comu LEFT JOIN comus_cats AS ca ON ca.c_id = co.comu_cat WHERE t.t_comu = \''.$comu_id.'\' AND t.t_status = \'1\' ORDER BY t.t_positives DESC LIMIT 10');
		while($row = $sql['list']->fetch_assoc()) $data['list'][] = $row;
		return $data;
	}
	
	function pag($page, $registros, $max, $url, $border = true){
		if($registros <= $max) return false;
		$quote = "'";
		$return = '<div class="paginas pag_recent" align="center"'.($border == false ? ' style="border:none;"' : '').'>';
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
	
	function comu_staff($comu_id){
		global $mysqli;
		$query = $mysqli->query('SELECT co.*, m.*, u.u_id, u.u_nick FROM comus_members AS m LEFT JOIN users AS u ON u.u_id = m.m_user LEFT JOIN comus AS co ON co.comu_id = m.m_comu WHERE co.comu_id = \''.$comu_id.'\' AND (m.m_rank = \'1\' OR m.m_rank = \'2\')') or die($mysqli->error);
		while($row = $query->fetch_assoc()) $data[] = $row;
		return $data;
	}
	
	function comu_members($comu_id, $limit){
		global $mysqli;
		$query = $mysqli->query('SELECT m.m_rank, u.u_id, u.u_nick FROM comus_members AS m LEFT JOIN users AS u ON u.u_id = m.m_user LEFT JOIN comus_ranks AS r ON r.r_id = m.m_rank LEFT JOIN comus AS co ON co.comu_id = m.m_comu WHERE co.comu_id = \''.$comu_id.'\' AND m.m_status = \'1\' ORDER BY m.m_id DESC LIMIT '.$limit);
		while($row = $query->fetch_assoc()) $data[] = $row;
		return $data;
	}
}
?>