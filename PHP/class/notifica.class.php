<?php
if(!defined('UNTARGETED')) die('Lo que buscas no se encuentra por aqu&iacute;');
class notifica{
	/*
		 2 => Creó un nuevo post
		 4 => Comentó tu post
		 5 => Comentó un post que sigues
		 6 => Dejó x puntos en tu post
		 9 => Te recomienda un post
		10 => Respondió tu comentario en el post
		11 => Votó positivo tu comentario
		12 => Votó negativo tu comentario
		13 => Te está siguiendo
		16 => Comentó tu imagen
		17 => Comentó una imagen que sigues
		18 => Votó positivo tu imagen
		19 => Votó negativo tu imagen
		22 => Te recomienda una imagen
		23 => Respondió tu comentario en la imagen
		24 => Votó positivo tu comentario (img)
		25 => Votó negativo tu comentario (img)
		26 => Publicó un estado en tu muro
		28 => Comentó tu estado
		29 => Comentó el estado de
		30 => Le gusta tu estado
		31 => Le gusta tu comentario
		34 => Respondió tu comentario
		39 => Respondió tu tema
		41 => Votó positivo tu tema
		42 => Votó negativo tu tema
		43 => Respondió un tema que sigues
		44 => Tu rango cambió a
		45 => Nueva medalla
		46 => Te recomienda un tema
		
	*/
	function insert($type, $type_id, $uid, $n_type_for = 0, $from_var = 0){
		global $mysqli, $user;
		$from_var = $from_var == 0 ? $user->uid : $from_var;
		if($uid == $from_var) return;
		//
		$query = $mysqli->query('SELECT u_notifications FROM users_accounts WHERE u_id = \''.$uid.'\' LIMIT 1');
		$data = $query->fetch_assoc();
		$data['notifications'] = unserialize($data['u_notifications']);
		if($data['notifications'][$type] == 1) return;
		//
		$query = $mysqli->query('SELECT n_date FROM notifications WHERE n_type = \''.intval($type).'\' AND '.($n_type_for ? 'n_type_for = \''.intval($n_type_for).'\'' : 'n_type_id = \''.intval($type_id).'\'').' AND n_user_to = \''.intval($uid).'\' AND n_view != \'2\'');
		if($query->num_rows && $type != 13) $mysqli->query('UPDATE notifications SET n_count = n_count + 1 WHERE n_type = \''.intval($type).'\' AND '.($n_type_for ? 'n_type_for = \''.intval($n_type_for).'\'' : 'n_type_id = \''.intval($type_id).'\'').' AND n_user_to = \''.intval($uid).'\'');
		else $mysqli->query('INSERT INTO notifications (n_type, n_type_id, n_user_from, n_user_to, n_date, n_type_for) VALUES (\''.intval($type).'\', \''.intval($type_id).'\', \''.$from_var.'\', \''.intval($uid).'\', \''.time().'\', \''.$n_type_for.'\')');
	}
	
	function insert_to_follows($type, $type_id, $f_type_id, $f_type, $omite = 0){
		global $mysqli;
		// MAXIMO A 50 SEGUIDORES
		$limit = 50;
		$query = $mysqli->query('SELECT f_user, f_type_id FROM follows WHERE f_type_id = \''.$f_type_id.'\' AND f_type = \''.$f_type.'\' ORDER BY RAND() LIMIT '.$limit);
		while($row = $query->fetch_assoc()){
			if($row['f_user'] != $omite) $this->insert($type, $type_id, $row['f_user']);
		}
	}
	
	function delete($type, $type_id, $uid){
		global $mysqli;
		$mysqli->query('DELETE FROM activity WHERE n_type = \''.intval($type).'\' AND n_type_id = \''.intval($type_id).'\' AND n_user = \''.intval($uid).'\' LIMIT 1');
	}
	
	function get_oracion($n_type){
		$oraciones = array(
			 2 => array(//=>OK
				'text' => 'cre&oacute; un nuevo',
				'obj' => 'post',
				'css' => 'new_post'
				),
			 4 => array(//=>OK
				'text' => array('coment&oacute; tu', '__CANTIDAD__ nuevos comentarios en tu'),
				'obj' => 'post',
				'css' => 'new_comment'
				),
			 5 => array(//=>OK
				'text' => array('coment&oacute; un', '__CANTIDAD__ nuevos comentarios en un'),
				'obj' => 'post',
				'complement' => 'que sigues',
				'css' => 'new_comment'
				),
			 6 => array(//=>OK
				'text' => 'dej&oacute; __CANTIDAD__ puntos en tu',
				'obj' => 'post',
				'css' => 'vote'
				),
			 9 => array(//=>OK
				'text' => array('te recomienda un post', '__CANTIDAD__ usuarios te recomiendan un'),
				'obj' => 'post',
				'css' => 'share_post'
				),
			10 => array(//=>OK
				'text' => array('respondi&oacute; tu', '__CANTIDAD__ nuevas respuestas a tu'),
				'obj' => 'comentario',
				'css' => 'new_repli'
				),
			11 => array(//=>OK
				'text' => array('le gusta tu', 'a __CANTIDAD__ usuarios les gusta tu'),
				'obj' => 'comentario',
				'css' => 'vote_pos'
				),
			12 => array(//=>OK
				'text' => array('no le gusta tu', 'a __CANTIDAD__ usuarios no les gusta tu'),
				'obj' => 'comentario',
				'css' => 'vote_neg'
				),
			13 => array(//=>OK
				'text' => 'te est&aacute; siguiendo',
				'css' => 'follow_post'
				),
			16 => array(//=>OK
				'text' => array('coment&oacute; tu', '__CANTIDAD__ nuevos comentarios en tu'),
				'obj' => 'imagen',
				'css' => 'new_comment'
				),
			17 => array(//=>OK
				'text' => array('coment&oacute; una', '__CANTIDAD__ nuevos comentarios en una'),
				'obj' => 'imagen',
				'complement' => 'que sigues',
				'css' => 'new_comment'
				),
			18 => array(//=>OK
				'text' => array('le gusta tu', 'a __CANTIDAD__ usuarios les gusta tu'),
				'obj' => 'imagen',
				'css' => 'vote_pos'
				),
			19 => array(//=>OK
				'text' => array('no le gusta tu', 'a __CANTIDAD__ usuarios no les gusta tu'),
				'obj' => 'imagen',
				'css' => 'vote_neg'
				),
			22 => array(//=>OK
				'text' => array('te recomienda una imagen', '__CANTIDAD__ usuarios te recomiendan una'),
				'obj' => 'imagen',
				'css' => 'share_post'
				),
			23 => array(//=>OK
				'text' => array('respondi&oacute; tu', '__CANTIDAD__ nuevas respuestas a tu'),
				'obj' => 'comentario',
				'css' => 'new_repli'
				),
			24 => array(//=>OK
				'text' => array('le gusta tu', 'a __CANTIDAD__ usuarios les gusta tu'),
				'obj' => 'comentario',
				'css' => 'vote_pos'
				),
			25 => array(//=>OK
				'text' => array('no le gusta tu', 'a __CANTIDAD__ usuarios no les gusta tu'),
				'obj' => 'comentario',
				'css' => 'vote_neg'
				),
			26 => array(//=>OK
				'text' => 'escribi&oacute; en tu',
				'obj' => 'muro',
				'css' => 'new_publi'
				),
			28 => array(//=>OK
				'text' => array('coment&oacute; un', '__CANTIDAD__ nuevos comentarios en un'),
				'obj' => 'estado',
				'css' => 'new_comment'
				),
			29 => array(//=>OK
				'text' => array('coment&oacute; el', '__CANTIDAD__ nuevos comentarios en el'),
				'obj' => 'estado',
				'css' => 'new_comment'
				),
			30 => array(//=>OK
				'text' => array('le gusta tu', 'a __CANTIDAD__ usuarios les gusta tu'),
				'obj' => 'estado',
				'css' => 'vote_pos'
				),
			31 => array(//=>OK
				'text' => array('le gusta tu', 'a __CANTIDAD__ usuarios les gusta tu'),
				'obj' => 'comentario',
				'css' => 'vote_pos'
				),
			34 => array(//=>OK
				'text' => array('respondi&oacute; tu', '__CANTIDAD__ nuevas respuestas a tu'),
				'obj' => 'comentario',
				'css' => 'new_repli'
				),
			39 => array(//=>OK
				'text' => array('respondi&oacute; tu', '__CANTIDAD__ nuevas respuestas en tu'),
				'obj' => 'tema',
				'css' => 'new_comment'
				),
			41 => array(//=>OK
				'text' => array('le gusta tu', 'a __CANTIDAD__ usuarios les gusta tu'),
				'obj' => 'tema',
				'css' => 'vote_pos'
				),
			42 => array(//=>OK
				'text' => array('no le gusta tu', 'a __CANTIDAD__ usuarios no les gusta tu'),
				'obj' => 'tema',
				'css' => 'vote_neg'
				),
			43 => array(//=>OK
				'text' => array('respondi&oacute; un', '__CANTIDAD__ nuevas respuestas en un'),
				'obj' => 'tema',
				'complement' => 'que sigues',
				'css' => 'new_comment'
				),
			44 => array(//=>OK
				'text' => 'Tu rango cambi&oacute; a'
				),
			45 => array(//=>OK
				'text' => 'Recibiste una nueva',
				'obj' => 'medalla'
				),
			46 => array(//=>OK
				'text' => array('te recomienda un', '__CANTIDAD__ usuarios te recomiendan un'),
				'obj' => 'tema',
				'css' => 'share_post'
				),
		);
		return $oraciones[$n_type];
	}
	
	function get_query($n_type, $n_type_id){
		switch($n_type){
			case 2:
			case 5:
			case 8:
			case 9:
				return 'SELECT p.p_id, p.p_title, c.c_seo FROM posts AS p LEFT JOIN posts_cats AS c ON c.c_id = p.p_cat WHERE p.p_id = \''.$n_type_id.'\' LIMIT 1';
			break;
			case 4:
			case 11:
			case 12:
				return 'SELECT cm.c_id, cm.c_body, cm.c_user, p.p_id, p.p_title, p.p_user, c.c_seo FROM comments AS cm LEFT JOIN posts AS p ON p.p_id = cm.c_type_id LEFT JOIN posts_cats AS c ON c.c_id = p.p_cat WHERE cm.c_id = \''.$n_type_id.'\' AND (cm.c_type = \'1\' OR cm.c_type = \'2\')';
			break;
			case 6:
				return 'SELECT v.v_val, p.p_id, p.p_title, p.p_user, c.c_seo FROM votes AS v LEFT JOIN posts AS p ON p.p_id = v.v_type_id LEFT JOIN posts_cats AS c ON c.c_id = p.p_cat WHERE v.v_id = \''.$n_type_id.'\' AND v.v_type = \'1\' LIMIT 1';
			break;
			case 10:
				return 'SELECT cm.c_id, cm.c_body, p.p_id, p.p_title, p.p_user, c.c_seo FROM comments AS cm LEFT JOIN posts AS p ON p.p_id = cm.c_type_id LEFT JOIN posts_cats AS c ON c.c_id = p.p_cat WHERE cm.c_id = \''.$n_type_id.'\' AND cm.c_type = \'1\'';
			break;
			case 13:
				return 'SELECT u_nick FROM users WHERE u_id = \''.$n_type_id.'\' LIMIT 1';
			break;
			case 17:
			case 18:
			case 19:
			case 22:
				return 'SELECT i.i_id, i.i_title FROM images AS i WHERE i.i_id = \''.$n_type_id.'\'';
			break;
			case 16:
			case 24:
			case 25:
				return 'SELECT cm.c_id, cm.c_body, cm.c_user, i.i_id, i.i_title, i.i_user FROM comments AS cm LEFT JOIN images AS i ON i.i_id = cm.c_type_id WHERE cm.c_id = \''.$n_type_id.'\' AND (cm.c_type = \'3\' OR cm.c_type = \'4\')';
			break;
			case 23:
				return 'SELECT cm.c_id, cm.c_user, cm.c_body, i.i_id, i.i_title, i.i_user FROM comments AS cm LEFT JOIN images AS i ON i.i_id = cm.c_type_id WHERE cm.c_id = \''.$n_type_id.'\' AND cm.c_type = \'3\'';
			break;
			case 26:
			case 30:
				return 'SELECT s.s_id, s.s_to_user, s.s_type, s.s_body, u.u_id, u.u_nick FROM states AS s LEFT JOIN users AS u ON u.u_id = s.s_to_user WHERE s.s_id = \''.$n_type_id.'\' LIMIT 1';
			break;
			case 28:
			case 29:
			case 31:
				return 'SELECT cm.c_id, cm.c_body, cm.c_user, s.s_id, s.s_body, s.s_user, s.s_to_user, u.u_nick FROM comments AS cm LEFT JOIN states AS s ON s.s_id = cm.c_type_id LEFT JOIN users AS u ON u.u_id = s.s_to_user WHERE cm.c_id = \''.$n_type_id.'\' AND cm.c_type = \'8\'';
			break;
			case 34:
			case 39:
				return 'SELECT cm.c_id, cm.c_body, t.t_id, t.t_title, t.t_user, co.comu_seo FROM comments AS cm LEFT JOIN comus_topics AS t ON t.t_id = cm.c_type_id LEFT JOIN comus AS co ON co.comu_id = t.t_comu WHERE cm.c_id = \''.$n_type_id.'\' AND (cm.c_type = \'5\' OR cm.c_type = \'6\')';
			break;
			case 41:
			case 42:
			case 43:
			case 46:
				return 'SELECT t.t_id, t.t_title, co.comu_seo FROM comus_topics AS t LEFT JOIN comus AS co ON co.comu_id = t.t_comu WHERE t.t_id = \''.$n_type_id.'\' LIMIT 1';
			break;
			case 44:
				return 'SELECT r_name, r_image FROM users_ranks WHERE r_id = \''.$n_type_id.'\' LIMIT 1';
			break;
			case 45:
				return 'SELECT m_title, m_image FROM admin_medals WHERE m_id = \''.$n_type_id.'\' LIMIT 1';
			break;
		}
	}
	
	function get_data($n_type, $data, $uid, $n_type_for = 0){
		global $web, $user;
		switch($n_type){
			case 2:
			case 5:
			case 7:
			case 8:
			case 9:
				$row['link'] = $web['url'].'/posts/'.$data['c_seo'].'/'.$data['p_id'].'/'.seo($data['p_title']).'.html';
				$row['title'] = $data['p_title'];
			break;
			case 4:
			case 10:
			case 11:
			case 12:
				$row['link'] = $web['url'].'/posts/'.$data['c_seo'].'/'.$data['p_id'].'/'.seo($data['p_title']).'.html'.($data['c_id'] ? '#comment-'.$data['c_id'] : '').'';
				$row['title'] = $data['p_title'];
				if($n_type > 5) $row['title'] = get_meta_description($data['c_body']);
			break;
			case 6:
				$row['link'] = $web['url'].'/posts/'.$data['c_seo'].'/'.$data['p_id'].'/'.seo($data['p_title']).'.html';
				$row['title'] = $data['p_title'];
				$row['puntos'] = $data['v_val'];
			break;
			case 13:
				$row['link'] = $web['url'].'/'.$data['u_nick'];
			break;
			case 14:
			case 15:
			case 17:
				$row['link'] = $web['url'].'/imagenes/'.$data['i_id'].'/'.seo($data['i_title']).'.html';
			break;
			case 16:
			case 18:
			case 19:
			case 24:
			case 25:
			case 22:
				$row['link'] = $web['url'].'/imagenes/'.$data['i_id'].'/'.seo($data['i_title']).'.html'.($data['c_id'] ? '#comment-'.$data['c_id'] : '').'';
				$row['title'] = $data['i_title'];
				if($n_type > 19) $row['title'] = get_meta_description($data['c_body']);
			break;
			case 23:
				$row['link'] =  $web['url'].'/imagenes/'.$data['i_id'].'/'.seo($data['i_title']).'.html#comment-'.$data['c_id'];
				$row['title'] = get_meta_description($data['c_body']);
			break;
			case 26:
			case 30:
				$row['link'] =  $web['url'].'/'.$data['u_nick'].'/status/'.$data['s_id'];
				$row['title'] = $data['s_body'];
			break;
			case 28:
			case 29:
			case 31:
				$row['link'] = $web['url'].'/'.$data['u_nick'].'/status/'.$data['s_id'];
				$row['title'] = $data['s_body'];
				if($n_type == 28){
					if($data['s_to_user'] != $user->uid) $row['complement'] = 'de <a href="'.$web['url'].'/'.$data['u_nick'].'">'.$data['u_nick'].'</a>';
					else $row['complement'] = 'de tu muro';
				}
				if($n_type == 29) $row['complement'] = 'de <a href="'.$web['url'].'/'.$data['u_nick'].'">'.$data['u_nick'].'</a>';
				if($n_type == 31) $row['title'] = $data['c_body'];
			break;
			case 34:
			case 39:
				$row['link'] =  $web['url'].'/comunidades/'.$data['comu_seo'].'/'.$data['t_id'].'/'.seo($data['t_title']).'.html#comment-'.$data['c_id'];
				if($n_type == 35) $row['title'] = $data['t_title'];
				else $row['title'] = $data['c_body'];
			break;
			case 41:
			case 42:
			case 43:
			case 46:
				$row['link'] =  $web['url'].'/comunidades/'.$data['comu_seo'].'/'.$data['t_id'].'/'.seo($data['t_title']).'.html';
				$row['title'] = $data['t_title'];
			break;
			case 44:
				$row['link'] = $web['url'].'/'.$user->nick;
				$row['obj'] = $data['r_name'];
				$row['css'] = '" style="background-image:url('.$web['icons'].'/ranks/'.$data['r_image'].');background-size: contain;';
			break;
			case 45:
				$row['link'] = $web['url'].'/'.$user->nick.'#Medallas';
				$row['title'] = $data['m_title'];
				$row['css'] = '" style="background-image:url('.$web['icons'].'/medals/'.$data['m_image'].');background-size: contain;';
			break;
		}
		return $row;
	}
	
	function generate($start = 0, $limit = 15, $live){
		global $mysqli, $web, $user;
		if($live){
			$start = 0;
			$limit = 100;
			$time_live = time()-60;
			$query = $mysqli->query('SELECT n.n_id, n.n_type, n.n_type_id, n.n_user_from, n.n_user_to, n.n_date, n.n_count, n.n_type_for, n.n_view, u.u_last_avatar FROM notifications AS n LEFT JOIN users AS u ON u.u_id = n.n_user_from WHERE n.n_user_to = \''.$user->uid.'\' AND n.n_view = \'0\' AND n.n_date > \''.$time_live.'\' ORDER BY n.n_date DESC');
		}else{
			$nofilter = secure($_POST['nofilter']);
			$nofilter = substr($_POST['nofilter'], 0, -1);
			$no_filtrar = explode(',', $nofilter);
			
			$query = $mysqli->query('SELECT n.n_id, n.n_type, n.n_type_id, n.n_user_from, n.n_user_to, n.n_date, n.n_count, n.n_type_for, n.n_view, u.u_last_avatar, u.u_nick FROM notifications AS n LEFT JOIN users AS u ON u.u_id = n.n_user_from WHERE n.n_user_to = \''.$user->uid.'\' ORDER BY n.n_date DESC');
		}
		while($row = $query->fetch_assoc()) $data_each[] = $row;
		$limite_f = $limit*($start+1);
		$start_i = $limit * $start;
		$i = 1;
		foreach($data_each AS $row){
			if($i > $start_i && $i <= $limite_f){
				$query_a = $mysqli->query($this->get_query($row['n_type'], $row['n_type_id'])) or die('1: '.$mysqli->error);
				$data = $query_a->fetch_assoc();
				if($query_a->num_rows && !in_array($row['n_type'], $no_filtrar)){
					$row['data'] = array_merge($this->get_data($row['n_type'], $data, $user->uid, $row['n_type_for']), $this->get_oracion($row['n_type']));
					if(is_array($row['data']['text']) && $row['n_count'] > 1) $row['data']['text'] = str_replace('__CANTIDAD__', '<b>'.$row['n_count'].'</b>', $row['data']['text'][1]);
					else if(is_array($row['data']['text'])) $row['data']['text'] = $row['data']['text'][0];
					$row['data']['user'] = $user->get_nick($row['n_user_from']);
					$row['data']['n_user_from'] = $row['n_user_from'];
					// A VARIOS USUARIOS
					$row['data']['show_user'] = true;
					$varios_users = array(4,5,9,10,11,12,16,17,18,19,22,23,28,29,31,30,31,34,39,41,42,43,46);
					if($row['n_count'] > 1 && in_array($row['n_type'], $varios_users)) $row['data']['show_user'] = false;
					if($row['n_type'] == 44 || $row['n_type'] == 45) $row['data']['show_user'] = false;
					if($row['n_type'] == 6) $row['data']['text'] = str_replace('__CANTIDAD__', '<b>'.$row['data']['puntos'].'</b>', $row['data']['text']);
					$row['data']['n_view'] = $row['n_view'];
					$row['data']['title'] = strlen($row['data']['title']) > 60 ? substr($row['data']['title'], 0, 60).'...' : $row['data']['title'];
					$row['data']['date'] = hace($row['n_date']);
					$row['data']['n_date'] = $row['n_date'];
					$result[] = $row['data'];
					if(!$live) $mysqli->query('UPDATE notifications SET n_view = \'2\' WHERE n_user_to = \''.$row['n_user_to'].'\' AND n_user_from = \''.$row['n_user_from'].'\' AND n_date = \''.$row['n_date'].'\' AND n_view != \'2\' LIMIT 1');
				}elseif(!$query_a->num_rows){
					$i--;
					$mysqli->query('DELETE FROM notifications WHERE n_id = \''.$row['n_id'].'\' LIMIT 1');
				}
			}
			$i++;
		}
		if($live) $mysqli->query('UPDATE notifications SET n_view = \'1\' WHERE n_user_to = \''.$user->uid.'\' AND n_view = \'0\'');
		return $result;
	}
	
	function check_news(){
		global $mysqli, $user, $web;
		// NOTIFICACIONES
		$live_list = $this->generate(false, false, true);		
		$data['live_nots_total'] = count($live_list);
		$data['live_list'] = '';
		
		if($user->mps){
			require'PHP/class/mps.class.php';
			$mps = new mps;
			$live_mps = $mps->generate('live');
			$data['live_mps_total'] = count($live_mps);
			foreach($live_mps AS $row){
				$data['live_list'] .= '<div class="notification hover" timepub="'.time().'" style="">';
				$data['live_list'] .= '<div class="close" onclick="$(this).parent().remove();"></div>';
				$data['live_list'] .= '<a href="'.$web['url'].'/'.$row['u_nick'].'"><img href="'.$web['url'].'/'.$row['u_nick'].'" width="32" height="32" src="/avatar/'.$row['rp_user'].'_32.jpg?'.$row['u_last_avatar'].'"></a><p><a href="'.$web['url'].'/'.$row['u_nick'].'">'.$row['u_nick'].'</a> - '.substr($row['mp_subject'], 0, 20).(strlen($row['mp_subject']) > 20 ? '...' : '').'<br /><a href="'.$web['url'].'/mensajes/leer/'.$row['mp_id'].'#mp-rpta-id-'.$row['rp_id'].'" class="important">'.substr(get_meta_description($row['rp_body']), 0, 25).(strlen($row['rp_body']) > 25 ? '...' : '').'</a></p></div>';
			}
		}
		
		foreach($live_list AS $row){
			$data['live_list'] .= '<div class="notification hover" timepub="'.time().'" style="">';
			$data['live_list'] .= '<div class="close" onclick="$(this).parent().remove();"></div>';
			$data['live_list'] .= '<a href="'.$web['url'].'/'.$row['user'].'"><img href="'.$web['url'].'/'.$row['user'].'" width="32" height="32" src="/avatar/'.$row['n_user_from'].'_32.jpg?'.$row['u_last_avatar'].'"></a><i class="smarticon '.$row['css'].'"></i>'.($row['show_user'] ? '<p><a href="'.$web['url'].'/'.$row['user'].'">'.$row['user'].'</a>' : '').' '.$row['text'].' <a href="'.$row['link'].'" class="important" title="'.$row['title'].'">'.$row['obj'].'</a>'.($row['complement'] ? ' '.$row['complement'] : '').'</p></div>';
		}

		$data['nots'] = $user->notis;
		$data['mps'] = $user->mps;
		$data['sound'] = $data['live_list'] ? true : false;
		$data['max_time'] = time()-30;
		return json($data);
	}

}
?>