<?php
$SM_DB = array();

$SM_DB[] = "CREATE TABLE IF NOT EXISTS `activity` (
  `a_id` int(20) NOT NULL AUTO_INCREMENT,
  `a_type` int(3) NOT NULL,
  `a_type_id` int(15) NOT NULL,
  `a_user` int(15) NOT NULL,
  `a_date` int(12) NOT NULL,
  `a_count` int(10) DEFAULT '1',
  `a_type_for` int(15) DEFAULT '0',
  PRIMARY KEY (`a_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

$SM_DB[] = "CREATE TABLE IF NOT EXISTS `admin_access` (
  `a_id` int(12) NOT NULL AUTO_INCREMENT,
  `a_ip` varchar(30) NOT NULL,
  `a_user` int(15) NOT NULL,
  `a_date` int(12) NOT NULL,
  PRIMARY KEY (`a_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

$SM_DB[] = "CREATE TABLE IF NOT EXISTS `admin_links` (
  `l_id` int(12) NOT NULL AUTO_INCREMENT,
  `l_url` varchar(200) NOT NULL,
  `l_user` int(15) NOT NULL,
  `l_date` int(12) NOT NULL,
  `l_status` int(1) DEFAULT '1',
  `l_title` varchar(50) NOT NULL,
  PRIMARY KEY (`l_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

$SM_DB[] = "CREATE TABLE IF NOT EXISTS `admin_locks` (
  `l_id` int(12) NOT NULL AUTO_INCREMENT,
  `l_lock` varchar(100) NOT NULL,
  `l_type` int(15) DEFAULT '1',
  `l_date` int(12) NOT NULL,
  `l_user` int(15) NOT NULL,
  PRIMARY KEY (`l_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;";

$SM_DB[] = "INSERT INTO `admin_locks` (`l_id`, `l_lock`, `l_type`, `l_date`, `l_user`) VALUES
(1, '999.999.999.99', 1, 1396625873, 32),
(2, 'ThisIsExample', 3, 1396625966, 32),
(3, 'yopmail.com', 2, 1396625937, 32);";

$SM_DB[] = "CREATE TABLE IF NOT EXISTS `admin_medals` (
  `m_id` int(12) NOT NULL AUTO_INCREMENT,
  `m_autor` int(15) NOT NULL,
  `m_title` varchar(70) NOT NULL,
  `m_image` varchar(120) NOT NULL,
  `m_cant` int(12) DEFAULT '0',
  `m_type` int(1) NOT NULL,
  `m_rank` int(10) DEFAULT '0',
  `m_date` int(12) NOT NULL,
  `m_desc` varchar(180) NOT NULL,
  PRIMARY KEY (`m_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";

$SM_DB[] = "CREATE TABLE IF NOT EXISTS `admin_medals_assign` (
  `ma_id` int(12) NOT NULL AUTO_INCREMENT,
  `m_id` int(12) NOT NULL,
  `ma_user` int(15) NOT NULL,
  `ma_date` int(12) NOT NULL,
  PRIMARY KEY (`ma_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";


$SM_DB[] = "CREATE TABLE IF NOT EXISTS `borradores` (
  `p_id` int(15) NOT NULL AUTO_INCREMENT,
  `p_user` int(15) NOT NULL,
  `p_cat` int(10) NOT NULL,
  `p_title` varchar(65) NOT NULL,
  `p_body` mediumtext NOT NULL,
  `p_date` int(12) NOT NULL,
  `p_tags` varchar(128) NOT NULL,
  `p_comments_status` int(1) DEFAULT '1',
  `p_type` int(1) DEFAULT '1',
  PRIMARY KEY (`p_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

$SM_DB[] = "CREATE TABLE IF NOT EXISTS `censored` (
  `c_id` int(12) NOT NULL AUTO_INCREMENT,
  `c_val` varchar(80) NOT NULL,
  `c_por` varchar(80) NOT NULL,
  `c_ireplace` int(1) DEFAULT '0',
  `c_admin` int(12) NOT NULL,
  `c_date` int(12) NOT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

$SM_DB[] = "CREATE TABLE IF NOT EXISTS `comments` (
  `c_id` int(15) NOT NULL AUTO_INCREMENT,
  `c_type` int(2) DEFAULT NULL,
  `c_type_id` int(15) NOT NULL,
  `c_user` int(15) NOT NULL,
  `c_date` int(12) NOT NULL,
  `c_body` varchar(5000) DEFAULT NULL,
  `c_votos` int(3) NOT NULL DEFAULT '0',
  `c_status` int(1) NOT NULL DEFAULT '1',
  `c_replies` int(10) DEFAULT '0',
  `c_replie_id` int(15) DEFAULT '0',
  PRIMARY KEY (`c_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

$SM_DB[] = "CREATE TABLE IF NOT EXISTS `comus` (
  `comu_id` int(15) NOT NULL AUTO_INCREMENT,
  `comu_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `comu_seo` varchar(25) NOT NULL,
  `comu_last_image` int(12) NOT NULL DEFAULT '0',
  `comu_country` varchar(2) NOT NULL,
  `comu_cat` int(11) NOT NULL,
  `comu_desc` varchar(1600) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `comu_p_post` int(1) NOT NULL,
  `comu_p_com` int(1) NOT NULL,
  `comu_date` int(12) NOT NULL,
  `comu_rank` varchar(30) NOT NULL,
  `comu_admin` int(12) NOT NULL,
  `comu_topics` int(12) NOT NULL DEFAULT '0',
  `comu_members` int(12) NOT NULL DEFAULT '0',
  `comu_followers` int(12) NOT NULL DEFAULT '0',
  `comu_status` int(2) NOT NULL DEFAULT '1',
  `comu_image` varchar(200) NOT NULL,
  `comu_image_repeat` int(1) DEFAULT NULL,
  `comu_color` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`comu_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

$SM_DB[] = "CREATE TABLE IF NOT EXISTS `comus_bans` (
  `b_id` int(12) NOT NULL AUTO_INCREMENT,
  `b_user` int(15) NOT NULL,
  `b_comu` int(15) NOT NULL,
  `b_reason` varchar(30) NOT NULL,
  `b_mod` int(12) NOT NULL,
  `b_date` int(12) NOT NULL,
  `b_end` int(12) NOT NULL,
  PRIMARY KEY (`b_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

$SM_DB[] = "CREATE TABLE IF NOT EXISTS `comus_cats` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_name` text NOT NULL,
  `c_img` text NOT NULL,
  `c_seo` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;";

$SM_DB[] = "INSERT INTO `comus_cats` (`c_id`, `c_name`, `c_img`, `c_seo`) VALUES
(1, 'Arte y literatura', 'book.png', 'arte-literatura'),
(2, 'Diversi&oacute;n y esparcimiento', 'cool.png', 'diversion-esparcimiento'),
(3, 'Manga y anime', 'manga.png', 'manga-anime'),
(4, 'Entretenimiento y medios', 'tv.png', 'entretenimiento-medios'),
(5, 'Grupos y organizaciones', 'group.png', 'grupos-organizaciones'),
(6, 'Inter&eacute;s general', 'mundo.png', 'interes-general'),
(7, 'Internet y tecnolog&iacute;a', 'processor.png', 'internet-tecnologia'),
(8, 'M&uacute;sica y bandas', 'guitar.png', 'musica-bandas'),
(9, 'Regiones', 'world.png', 'regiones'),
(10, 'Deportes', 'ball.png', 'deportes'),
(11, 'Programas y juegos', 'cdrom.png', 'programas-juegos'),
(12, 'Lenguajes de programaci&oacute;n', 'prog.png', 'lenguajes-programacion');";

$SM_DB[] = "CREATE TABLE IF NOT EXISTS `comus_members` (
  `m_id` int(12) NOT NULL AUTO_INCREMENT,
  `m_user` int(12) NOT NULL,
  `m_comu` int(12) NOT NULL,
  `m_topics` int(12) NOT NULL,
  `m_rank` int(12) NOT NULL,
  `m_date` int(12) NOT NULL,
  `m_status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`m_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

$SM_DB[] = "CREATE TABLE IF NOT EXISTS `comus_ranks` (
  `r_id` int(11) NOT NULL AUTO_INCREMENT,
  `r_name` varchar(25) NOT NULL,
  PRIMARY KEY (`r_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;";

$SM_DB[] = "INSERT INTO `comus_ranks` (`r_id`, `r_name`) VALUES
(1, 'Administrador'),
(2, 'Moderador'),
(3, ''),
(4, 'Comentador'),
(5, 'Visitante');";

$SM_DB[] = "CREATE TABLE IF NOT EXISTS `comus_topics` (
  `t_id` int(15) unsigned NOT NULL AUTO_INCREMENT,
  `t_body` mediumtext NOT NULL,
  `t_title` varchar(60) NOT NULL,
  `t_user` int(12) NOT NULL,
  `t_comu` int(12) NOT NULL,
  `t_status` int(1) DEFAULT '1',
  `t_sticky` int(1) DEFAULT '0',
  `t_favs` int(12) NOT NULL,
  `t_comments_status` int(1) DEFAULT '1',
  `t_hits` int(15) DEFAULT '1',
  `t_negatives` int(10) DEFAULT '0',
  `t_positives` int(10) DEFAULT '0',
  `t_date` int(12) NOT NULL,
  `t_comments` int(12) DEFAULT '0',
  `t_ip` varchar(30) DEFAULT NULL,
  `t_followers` int(12) DEFAULT '0',
  `t_follow` int(1) DEFAULT '0',
  `t_shared` int(6) DEFAULT '0',
  PRIMARY KEY (`t_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

$SM_DB[] = "CREATE TABLE IF NOT EXISTS `emails` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `e_user` int(15) DEFAULT NULL,
  `e_email` varchar(200) DEFAULT NULL,
  `e_code` varchar(20) DEFAULT NULL,
  `e_key` int(20) DEFAULT NULL,
  `e_ip` varchar(40) DEFAULT NULL,
  `e_type` int(1) DEFAULT NULL,
  `e_date` int(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";


$SM_DB[] = "CREATE TABLE IF NOT EXISTS `favorites` (
  `f_id` int(15) NOT NULL AUTO_INCREMENT,
  `f_type` int(2) NOT NULL,
  `f_type_id` int(15) NOT NULL,
  `f_user` int(15) NOT NULL,
  `f_date` int(15) NOT NULL,
  PRIMARY KEY (`f_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

$SM_DB[] = "CREATE TABLE IF NOT EXISTS `follows` (
  `f_type` int(2) NOT NULL,
  `f_type_id` int(15) NOT NULL,
  `f_user` int(15) NOT NULL,
  `f_date` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

$SM_DB[] = "CREATE TABLE IF NOT EXISTS `history` (
  `h_id` int(15) NOT NULL AUTO_INCREMENT,
  `h_type` int(1) DEFAULT NULL,
  `h_type_id` int(15) DEFAULT NULL,
  `h_action` int(1) DEFAULT NULL,
  `h_mod` int(15) DEFAULT NULL,
  `h_reason` varchar(150) NOT NULL,
  `h_date` int(12) NOT NULL,
  PRIMARY KEY (`h_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

$SM_DB[] = "CREATE TABLE IF NOT EXISTS `hits` (
  `h_type` int(2) NOT NULL,
  `h_type_id` int(15) NOT NULL,
  `h_user` int(15) NOT NULL,
  `h_ip` varchar(15) NOT NULL,
  `h_date` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

$SM_DB[] = "CREATE TABLE IF NOT EXISTS `images` (
  `i_id` int(15) NOT NULL AUTO_INCREMENT,
  `i_user` int(15) NOT NULL,
  `i_title` varchar(65) NOT NULL,
  `i_description` varchar(1000) NOT NULL,
  `i_date` int(12) NOT NULL,
  `i_shared` int(6) DEFAULT '0',
  `i_favs` int(6) DEFAULT '0',
  `i_comments` int(10) DEFAULT '0',
  `i_follows` int(10) DEFAULT '0',
  `i_positives` int(10) DEFAULT '0',
  `i_hits` int(15) NOT NULL DEFAULT '0',
  `i_comments_status` int(1) DEFAULT '1',
  `i_ip` varchar(15) NOT NULL,
  `i_status` int(1) DEFAULT '1',
  `i_url` varchar(300) NOT NULL,
  `i_negatives` int(10) DEFAULT '0',
  `i_follow` int(1) DEFAULT '1',
  PRIMARY KEY (`i_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

$SM_DB[] = "CREATE TABLE IF NOT EXISTS `mod_access` (
  `a_id` int(12) NOT NULL AUTO_INCREMENT,
  `a_ip` varchar(30) NOT NULL,
  `a_user` int(15) NOT NULL,
  `a_date` int(12) NOT NULL,
  PRIMARY KEY (`a_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

$SM_DB[] = "CREATE TABLE IF NOT EXISTS `mps` (
  `mp_id` int(15) NOT NULL AUTO_INCREMENT,
  `mp_user` int(15) NOT NULL,
  `mp_to` int(15) NOT NULL,
  `mp_subject` varchar(50) NOT NULL,
  `mp_view` int(1) DEFAULT '0',
  `mp_date` int(12) NOT NULL,
  `mp_update` int(12) DEFAULT '0',
  `mp_ip` varchar(15) NOT NULL,
  `mp_del_from` int(1) DEFAULT '0',
  `mp_del_to` int(1) DEFAULT '0',
  `mp_read` int(1) DEFAULT '0',
  PRIMARY KEY (`mp_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

$SM_DB[] = "CREATE TABLE IF NOT EXISTS `mps_replies` (
  `rp_id` int(15) NOT NULL AUTO_INCREMENT,
  `mp_id` int(15) DEFAULT '0',
  `rp_user` int(15) NOT NULL,
  `rp_to` int(15) NOT NULL,
  `rp_body` text NOT NULL,
  `rp_view` int(1) DEFAULT '0',
  `rp_date` int(12) NOT NULL,
  `rp_ip` varchar(15) NOT NULL,
  `rp_read` int(1) DEFAULT '0',
  PRIMARY KEY (`rp_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

$SM_DB[] = "CREATE TABLE IF NOT EXISTS `news` (
  `n_id` int(12) NOT NULL AUTO_INCREMENT,
  `n_body` varchar(2000) NOT NULL,
  `n_user` int(15) NOT NULL,
  `n_date` int(12) NOT NULL,
  `n_status` int(1) DEFAULT '1',
  PRIMARY KEY (`n_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

$SM_DB[] = "CREATE TABLE IF NOT EXISTS `notifications` (
  `n_id` int(20) NOT NULL AUTO_INCREMENT,
  `n_type` int(3) NOT NULL,
  `n_type_id` int(15) NOT NULL DEFAULT '0',
  `n_user_from` int(15) NOT NULL,
  `n_user_to` int(15) NOT NULL,
  `n_date` int(12) NOT NULL,
  `n_count` int(10) DEFAULT '1',
  `n_view` int(1) DEFAULT '0',
  `n_type_for` int(15) DEFAULT '0',
  PRIMARY KEY (`n_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

$SM_DB[] = "CREATE TABLE IF NOT EXISTS `posts` (
  `p_id` int(15) NOT NULL AUTO_INCREMENT,
  `p_user` int(15) NOT NULL,
  `p_cat` int(10) NOT NULL,
  `p_title` varchar(65) NOT NULL,
  `p_body` mediumtext NOT NULL,
  `p_date` int(12) NOT NULL,
  `p_tags` varchar(128) NOT NULL,
  `p_shared` int(6) DEFAULT '0',
  `p_favs` int(6) DEFAULT '0',
  `p_comments` int(10) DEFAULT '0',
  `p_follows` int(10) DEFAULT '0',
  `p_puntos` int(12) DEFAULT '0',
  `p_hits` int(15) NOT NULL DEFAULT '0',
  `p_comments_status` int(1) DEFAULT '1',
  `p_ip` varchar(15) NOT NULL,
  `p_sticky` int(1) DEFAULT '0',
  `p_status` int(1) DEFAULT '1',
  `p_follow` int(1) DEFAULT '1',
  `p_update` int(12) NOT NULL,
  PRIMARY KEY (`p_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

$SM_DB[] = "CREATE TABLE IF NOT EXISTS `posts_cats` (
  `c_id` int(10) NOT NULL AUTO_INCREMENT,
  `c_name` varchar(32) NOT NULL,
  `c_seo` varchar(32) NOT NULL,
  `c_img` varchar(32) NOT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=43 ;";

$SM_DB[] = "INSERT INTO `posts_cats` (`c_id`, `c_name`, `c_seo`, `c_img`) VALUES
(1, 'Animaciones', 'animaciones', 'Animaciones.png'),
(2, 'Apuntes y Monografi­as', 'apuntesymonografias', 'ApuntesMonografias.png'),
(3, 'Arte', 'arte', 'Arte.png'),
(4, 'Autos y Motos', 'autosymotos', 'AutosMotos.png'),
(5, 'Celulares', 'celulares', 'CelularesAccesorios.png'),
(6, 'Ciencia y educaci&oacute;n', 'ciencia-y-educacion', 'CienciaEducacion.png'),
(7, 'Comics', 'comics', 'Comics.png'),
(8, 'Deportes', 'deportes', 'Deportes.png'),
(9, 'Descargas', 'descargas', 'Descargas.png'),
(11, 'Ecologi­a', 'ecologia', 'Ecologia.png'),
(12, 'Economi­a y Negocios', 'economiaynegocios', 'economy.png'),
(13, 'Temas Femeninos', 'temasfemeninos', 'Femenino.png'),
(14, 'Hazlo tu mismo', 'hazlotumismo', 'HazloTuMismo.png'),
(15, 'Humor', 'humor', 'humor.png'),
(16, 'Imagenes', 'imagenes', 'Imagenes.png'),
(17, 'Informacion', 'informacion', 'Informacion.png'),
(18, 'Juegos', 'juegos', 'Juegos16px.png'),
(19, 'Enlaces', 'enlaces', 'Enlaces.png'),
(20, 'Linux', 'linux', 'LinuxGNU.png'),
(21, 'Mac', 'mac', 'mac.png'),
(22, 'Manga y Anime', 'mangayanime', 'MangaAnime.png'),
(23, 'Mascotas', 'mascotas', 'Mascotas.png'),
(24, 'Musica', 'musica', 'Musica16.png'),
(25, 'Noticias', 'noticias', 'Noticiasinfo.png'),
(26, 'Sin Topico', 'sintopico', 'SinTopico.png'),
(27, 'Recetas y Cocina', 'recetasycocina', 'RecetasCocina.png'),
(28, 'Salud y Bienestar', 'saludybienestar', 'SaludBienestar.png'),
(29, 'Solidaridad', 'solidaridad', 'Solidaridad.png'),
(30, 'SMline', 'smline', 'Super-Stremo1.png'),
(31, 'Tecnologia', 'tecnologia', 'Tecnologia.png'),
(32, 'TV, Peliculas y series', 'tvpeliculasyseries', 'TvPeliculasSeries.png'),
(33, 'Videos en l&iacute;nea', 'videosenlnea', 'VideosOnline.png'),
(34, 'Enlaces Mediafire', 'enlacesmediafire', 'EnlacesMediafire.png'),
(35, 'Inform&aacute;tica y Computaci&oacute;n', 'informticaycomputacin', 'InformaticaComputacion.png'),
(36, 'Photoshop', 'photoshop', 'Photoshop.png'),
(37, 'Programaci&oacute;n', 'programacion', 'Programacion.png'),
(38, 'Emule', 'emule', 'TorrentsEmule.png'),
(39, 'Tutoriales y Cursos', 'tutorialesycursos', 'TutorialesCursos.png'),
(40, 'Paranormal', 'paranormal', 'eye.png'),
(41, 'Mega', 'mega', 'mega.png');";

$SM_DB[] = "CREATE TABLE IF NOT EXISTS `reports` (
  `r_id` int(15) NOT NULL AUTO_INCREMENT,
  `r_type` int(2) DEFAULT NULL,
  `r_type_id` int(15) DEFAULT NULL,
  `r_user` int(15) DEFAULT NULL,
  `r_reason` varchar(500) DEFAULT NULL,
  `r_date` int(12) NOT NULL,
  PRIMARY KEY (`r_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

$SM_DB[] = "CREATE TABLE IF NOT EXISTS `searches` (
  `ss_id` int(15) NOT NULL AUTO_INCREMENT,
  `ss_user` int(15) NOT NULL,
  `see_id` int(15) NOT NULL,
  `ss_date` int(15) NOT NULL,
  PRIMARY KEY (`ss_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";


$SM_DB[] = "CREATE TABLE IF NOT EXISTS `search_filters` (
  `se_id` int(15) NOT NULL AUTO_INCREMENT,
  `se_body` varchar(100) NOT NULL,
  `se_repeats` int(15) DEFAULT '1',
  PRIMARY KEY (`se_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

$SM_DB[] = "CREATE TABLE IF NOT EXISTS `sessions` (
  `s_id` int(15) NOT NULL AUTO_INCREMENT,
  `s_key` varchar(15) NOT NULL,
  `s_user` int(15) DEFAULT '0',
  `s_ip` varchar(40) NOT NULL,
  `s_date` int(10) NOT NULL,
  `s_remember` int(1) DEFAULT '0',
  `s_update` int(12) DEFAULT '0',
  PRIMARY KEY (`s_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

$SM_DB[] = "CREATE TABLE IF NOT EXISTS `shared` (
  `s_type` int(3) NOT NULL,
  `s_type_id` int(15) NOT NULL,
  `s_user` int(15) NOT NULL,
  `s_date` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

$SM_DB[] = "CREATE TABLE IF NOT EXISTS `states` (
  `s_id` int(15) NOT NULL AUTO_INCREMENT,
  `s_user` int(15) NOT NULL,
  `s_body` varchar(1000) NOT NULL,
  `s_date` int(12) NOT NULL,
  `s_comments` int(10) DEFAULT '0',
  `s_likes` int(12) DEFAULT '0',
  `s_type` int(1) DEFAULT '1',
  `s_adj` varchar(500) DEFAULT NULL,
  `s_ip` varchar(15) NOT NULL,
  `s_status` int(1) DEFAULT '1',
  `s_to_user` int(15) DEFAULT NULL,
  `s_adj_title` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`s_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";


$SM_DB[] = "CREATE TABLE IF NOT EXISTS `users` (
  `u_id` int(12) NOT NULL AUTO_INCREMENT,
  `u_nick` varchar(16) DEFAULT NULL,
  `u_pass` varchar(35) DEFAULT NULL,
  `u_email` varchar(40) DEFAULT NULL,
  `u_rank` int(3) NOT NULL DEFAULT '3',
  `u_points_ava` int(2) DEFAULT '0',
  `u_date` int(12) DEFAULT '0',
  `u_last_active` int(12) DEFAULT '0',
  `u_last_ip` varchar(15) DEFAULT '0',
  `u_status` int(1) DEFAULT '0',
  `u_country` varchar(2) DEFAULT 'AR',
  `u_online` int(1) DEFAULT '0',
  `u_sex` int(1) DEFAULT '0',
  `u_last_avatar` int(12) DEFAULT '0',
  `u_update_points` int(12) NOT NULL DEFAULT '0',
  PRIMARY KEY (`u_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";


$SM_DB[] = "CREATE TABLE IF NOT EXISTS `users_accounts` (
  `u_id` int(12) NOT NULL AUTO_INCREMENT,
  `u_bio` varchar(80) DEFAULT NULL,
  `u_site` varchar(30) DEFAULT NULL,
  `fb_user` int(40) DEFAULT NULL,
  `tw_user` int(40) DEFAULT NULL,
  `u_options` varchar(5000) DEFAULT NULL,
  `u_privacy` varchar(100) DEFAULT NULL,
  `u_names` varchar(30) DEFAULT NULL,
  `u_surnames` varchar(30) DEFAULT NULL,
  `u_day` int(2) NOT NULL,
  `u_month` int(2) NOT NULL,
  `u_year` int(4) NOT NULL,
  `u_image` varchar(200) DEFAULT NULL,
  `u_color` varchar(6) DEFAULT NULL,
  `u_image_repeat` int(1) DEFAULT '1',
  `u_notifications` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`u_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

$SM_DB[] = "CREATE TABLE IF NOT EXISTS `users_bans` (
  `ub_id` int(12) NOT NULL AUTO_INCREMENT,
  `ub_user` int(15) NOT NULL,
  `ub_reason` varchar(200) NOT NULL,
  `ub_mod` int(12) NOT NULL,
  `ub_date` int(12) NOT NULL,
  `ub_end` int(12) NOT NULL,
  PRIMARY KEY (`ub_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

$SM_DB[] = "CREATE TABLE IF NOT EXISTS `users_blocks` (
  `b_id` int(15) NOT NULL AUTO_INCREMENT,
  `b_user` int(15) NOT NULL,
  `b_to_user` int(15) NOT NULL,
  PRIMARY KEY (`b_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

$SM_DB[] = "CREATE TABLE IF NOT EXISTS `users_ranks` (
  `r_id` int(3) NOT NULL AUTO_INCREMENT,
  `r_name` varchar(32) NOT NULL,
  `r_color` varchar(6) NOT NULL DEFAULT '000',
  `r_image` varchar(32) NOT NULL DEFAULT 'new.png',
  `r_pxd` int(5) NOT NULL DEFAULT '0',
  `r_type` int(1) NOT NULL DEFAULT '0',
  `r_permits` varchar(2000) NOT NULL,
  `r_points_require` int(10) DEFAULT NULL,
  `r_flood` int(4) DEFAULT NULL,
  PRIMARY KEY (`r_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;";

$SM_DB[] = "INSERT INTO `users_ranks` (`r_id`, `r_name`, `r_color`, `r_image`, `r_pxd`, `r_type`, `r_permits`, `r_points_require`, `r_flood`) VALUES
(1, 'Administrador', 'FF0000', 'padre.gif', 200, 1, 'a:87:{s:7:\"goadmin\";i:1;s:5:\"gomod\";i:1;s:2:\"bp\";i:1;s:2:\"ep\";i:1;s:3:\"vpb\";i:1;s:3:\"vpr\";i:1;s:3:\"apr\";i:1;s:2:\"fp\";i:1;s:3:\"dfp\";i:1;s:2:\"bf\";i:1;s:2:\"ef\";i:1;s:3:\"vfb\";i:1;s:2:\"be\";i:1;s:2:\"ee\";i:1;s:3:\"veb\";i:1;s:3:\"scs\";i:1;s:3:\"rcs\";i:1;s:3:\"ecs\";i:1;s:4:\"vmcs\";i:1;s:2:\"bt\";i:1;s:2:\"et\";i:1;s:2:\"ft\";i:1;s:2:\"dt\";i:1;s:2:\"bc\";i:1;s:2:\"oc\";i:1;s:2:\"ec\";i:1;s:3:\"acc\";i:1;s:3:\"vcb\";i:1;s:2:\"su\";i:1;s:2:\"ru\";i:1;s:4:\"ecds\";i:1;s:4:\"etds\";i:1;s:4:\"aebn\";i:1;s:3:\"ebp\";i:1;s:5:\"aebli\";i:1;s:3:\"acp\";i:1;s:3:\"acf\";i:1;s:3:\"acm\";i:1;s:4:\"aebc\";i:1;s:3:\"aeu\";i:1;s:4:\"aebm\";i:1;s:4:\"aebr\";i:1;s:4:\"abpc\";i:1;s:4:\"abib\";i:1;s:2:\"as\";i:1;s:2:\"pp\";i:1;s:2:\"cp\";i:0;s:4:\"sprr\";i:0;s:3:\"bpp\";i:1;s:3:\"epp\";i:1;s:2:\"pf\";i:1;s:3:\"efp\";i:1;s:3:\"bfp\";i:1;s:3:\"vpf\";i:1;s:3:\"vnf\";i:1;s:2:\"pt\";i:1;s:3:\"etp\";i:1;s:3:\"btp\";i:1;s:3:\"vpt\";i:1;s:3:\"vnt\";i:1;s:3:\"ccs\";i:1;s:4:\"ecsp\";i:1;s:4:\"bcsp\";i:1;s:2:\"pc\";i:1;s:2:\"em\";i:1;s:2:\"cm\";i:0;s:3:\"ecp\";i:1;s:3:\"bcp\";i:1;s:3:\"vpc\";i:1;s:3:\"vnc\";i:1;s:2:\"pe\";i:1;s:3:\"eep\";i:1;s:3:\"bep\";i:1;s:3:\"ppm\";i:500;s:5:\"sprrp\";i:0;s:3:\"pfm\";i:500;s:4:\"vpfm\";i:500;s:4:\"vnfm\";i:500;s:3:\"ptm\";i:500;s:4:\"vptm\";i:500;s:4:\"vntm\";i:500;s:4:\"ccsm\";i:50;s:3:\"pcm\";i:500;s:3:\"emm\";i:500;s:4:\"vpcm\";i:500;s:4:\"vncm\";i:500;s:3:\"pem\";i:500;}', 0, 1),
(2, 'Moderador global', 'FF9900', '1.gif', 60, 1, 'a:86:{s:7:\"goadmin\";i:0;s:5:\"gomod\";i:1;s:2:\"bp\";i:1;s:2:\"ep\";i:1;s:3:\"vpb\";i:1;s:3:\"vpr\";i:1;s:3:\"apr\";i:1;s:2:\"fp\";i:1;s:3:\"dfp\";i:1;s:2:\"bf\";i:1;s:2:\"ef\";i:1;s:3:\"vfb\";i:1;s:2:\"be\";i:1;s:2:\"ee\";i:1;s:3:\"veb\";i:1;s:3:\"scs\";i:1;s:3:\"rcs\";i:1;s:3:\"ecs\";i:1;s:4:\"vmcs\";i:1;s:2:\"bt\";i:1;s:2:\"et\";i:1;s:2:\"ft\";i:1;s:2:\"dt\";i:1;s:2:\"bc\";i:1;s:2:\"oc\";i:1;s:2:\"ec\";i:1;s:3:\"acc\";i:1;s:3:\"vcb\";i:1;s:2:\"su\";i:1;s:2:\"ru\";i:1;s:4:\"ecds\";i:0;s:4:\"aebn\";i:0;s:3:\"ebp\";i:0;s:5:\"aebli\";i:0;s:3:\"acp\";i:0;s:3:\"acf\";i:0;s:3:\"acm\";i:0;s:4:\"aebc\";i:0;s:3:\"aeu\";i:0;s:4:\"aebm\";i:0;s:4:\"aebr\";i:0;s:4:\"abpc\";i:0;s:4:\"abib\";i:0;s:2:\"as\";i:0;s:2:\"pp\";i:1;s:2:\"cp\";i:0;s:4:\"sprr\";i:0;s:3:\"bpp\";i:1;s:3:\"epp\";i:1;s:2:\"pf\";i:1;s:3:\"efp\";i:1;s:3:\"bfp\";i:1;s:3:\"vpf\";i:1;s:3:\"vnf\";i:1;s:2:\"pt\";i:1;s:3:\"etp\";i:1;s:3:\"btp\";i:1;s:3:\"vpt\";i:1;s:3:\"vnt\";i:1;s:3:\"ccs\";i:1;s:4:\"ecsp\";i:1;s:4:\"bcsp\";i:1;s:2:\"pc\";i:1;s:2:\"em\";i:1;s:2:\"cm\";i:0;s:3:\"ecp\";i:1;s:3:\"bcp\";i:1;s:3:\"vpc\";i:1;s:3:\"vnc\";i:1;s:2:\"pe\";i:1;s:3:\"eep\";i:1;s:3:\"bep\";i:1;s:3:\"ppm\";i:50;s:5:\"sprrp\";i:0;s:3:\"pfm\";i:50;s:4:\"vpfm\";i:200;s:4:\"vnfm\";i:200;s:3:\"ptm\";i:50;s:4:\"vptm\";i:200;s:4:\"vntm\";i:200;s:4:\"ccsm\";i:20;s:3:\"pcm\";i:500;s:3:\"emm\";i:500;s:4:\"vpcm\";i:200;s:4:\"vncm\";i:200;s:3:\"pem\";i:500;}', 0, 5),
(3, 'Newbie', '000000', '6.gif', 5, 1, 'a:86:{s:7:\"goadmin\";i:0;s:5:\"gomod\";i:0;s:2:\"bp\";i:0;s:2:\"ep\";i:0;s:3:\"vpb\";i:0;s:3:\"vpr\";i:0;s:3:\"apr\";i:0;s:2:\"fp\";i:0;s:3:\"dfp\";i:0;s:2:\"bf\";i:0;s:2:\"ef\";i:0;s:3:\"vfb\";i:0;s:2:\"be\";i:0;s:2:\"ee\";i:0;s:3:\"veb\";i:0;s:3:\"scs\";i:0;s:3:\"rcs\";i:0;s:3:\"ecs\";i:0;s:4:\"vmcs\";i:0;s:2:\"bt\";i:0;s:2:\"et\";i:0;s:2:\"ft\";i:0;s:2:\"dt\";i:0;s:2:\"bc\";i:0;s:2:\"oc\";i:0;s:2:\"ec\";i:0;s:3:\"acc\";i:0;s:3:\"vcb\";i:0;s:2:\"su\";i:0;s:2:\"ru\";i:0;s:4:\"ecds\";i:0;s:4:\"aebn\";i:0;s:3:\"ebp\";i:0;s:5:\"aebli\";i:0;s:3:\"acp\";i:0;s:3:\"acf\";i:0;s:3:\"acm\";i:0;s:4:\"aebc\";i:0;s:3:\"aeu\";i:0;s:4:\"aebm\";i:0;s:4:\"aebr\";i:0;s:4:\"abpc\";i:0;s:4:\"abib\";i:0;s:2:\"as\";i:0;s:2:\"pp\";i:1;s:2:\"cp\";i:1;s:4:\"sprr\";i:0;s:3:\"bpp\";i:1;s:3:\"epp\";i:1;s:2:\"pf\";i:1;s:3:\"efp\";i:1;s:3:\"bfp\";i:1;s:3:\"vpf\";i:1;s:3:\"vnf\";i:1;s:2:\"pt\";i:1;s:3:\"etp\";i:1;s:3:\"btp\";i:1;s:3:\"vpt\";i:1;s:3:\"vnt\";i:1;s:3:\"ccs\";i:0;s:4:\"ecsp\";i:1;s:4:\"bcsp\";i:1;s:2:\"pc\";i:1;s:2:\"em\";i:1;s:2:\"cm\";i:0;s:3:\"ecp\";i:1;s:3:\"bcp\";i:1;s:3:\"vpc\";i:1;s:3:\"vnc\";i:1;s:2:\"pe\";i:1;s:3:\"eep\";i:1;s:3:\"bep\";i:1;s:3:\"ppm\";i:8;s:5:\"sprrp\";i:0;s:3:\"pfm\";i:10;s:4:\"vpfm\";i:20;s:4:\"vnfm\";i:15;s:3:\"ptm\";i:8;s:4:\"vptm\";i:20;s:4:\"vntm\";i:15;s:4:\"ccsm\";i:0;s:3:\"pcm\";i:30;s:3:\"emm\";i:3;s:4:\"vpcm\";i:20;s:4:\"vncm\";i:15;s:3:\"pem\";i:10;}', 0, 20),
(4, 'New Full User', '0015FF', 'fire.png', 20, 0, 'a:92:{s:7:\"goadmin\";i:0;s:5:\"gomod\";i:0;s:2:\"bp\";i:0;s:2:\"ep\";i:0;s:3:\"vpb\";i:0;s:3:\"vpr\";i:0;s:3:\"apr\";i:0;s:2:\"fp\";i:0;s:3:\"dfp\";i:0;s:2:\"bf\";i:0;s:2:\"ef\";i:0;s:3:\"vfb\";i:0;s:2:\"be\";i:0;s:2:\"ee\";i:0;s:3:\"veb\";i:0;s:3:\"scs\";i:0;s:3:\"rcs\";i:0;s:3:\"ecs\";i:0;s:4:\"vmcs\";i:0;s:2:\"bt\";i:0;s:2:\"et\";i:0;s:2:\"ft\";i:0;s:2:\"dt\";i:0;s:2:\"bc\";i:0;s:2:\"oc\";i:0;s:2:\"ec\";i:0;s:3:\"acc\";i:0;s:3:\"vcb\";i:0;s:2:\"su\";i:0;s:2:\"ru\";i:0;s:4:\"ecds\";i:0;s:3:\"eas\";i:0;s:4:\"aebn\";i:0;s:3:\"ebp\";i:0;s:5:\"aebwa\";i:0;s:3:\"acp\";i:0;s:4:\"accs\";i:0;s:3:\"acf\";i:0;s:3:\"acm\";i:0;s:4:\"accm\";i:0;s:4:\"aebc\";i:0;s:3:\"aeu\";i:0;s:4:\"aebm\";i:0;s:4:\"aebr\";i:0;s:4:\"abpc\";i:0;s:4:\"abib\";i:0;s:3:\"vrd\";i:0;s:4:\"aebe\";i:0;s:2:\"as\";i:0;s:3:\"vbr\";i:0;s:2:\"pp\";i:1;s:2:\"cp\";i:0;s:4:\"sprr\";i:0;s:3:\"bpp\";i:1;s:3:\"epp\";i:1;s:2:\"pf\";i:1;s:3:\"efp\";i:1;s:3:\"bfp\";i:1;s:3:\"vpf\";i:1;s:3:\"vnf\";i:1;s:2:\"pt\";i:1;s:3:\"etp\";i:1;s:3:\"btp\";i:1;s:3:\"vpt\";i:1;s:3:\"vnt\";i:1;s:3:\"ccs\";i:1;s:4:\"ecsp\";i:1;s:4:\"bcsp\";i:1;s:2:\"pc\";i:1;s:2:\"em\";i:1;s:2:\"cm\";i:0;s:3:\"ecp\";i:1;s:3:\"bcp\";i:1;s:3:\"vpc\";i:1;s:3:\"vnc\";i:1;s:2:\"pe\";i:1;s:3:\"eep\";i:1;s:3:\"bep\";i:1;s:3:\"ppm\";i:15;s:5:\"sprrp\";i:0;s:3:\"pfm\";i:15;s:4:\"vpfm\";i:60;s:4:\"vnfm\";i:15;s:3:\"ptm\";i:15;s:4:\"vptm\";i:60;s:4:\"vntm\";i:15;s:4:\"ccsm\";i:1;s:3:\"pcm\";i:100;s:3:\"emm\";i:10;s:4:\"vpcm\";i:50;s:4:\"vncm\";i:15;s:3:\"pem\";i:15;}', 50, 15),
(5, 'Full User', 'C40000', 'GreatUser2.png', 30, 0, 'a:92:{s:7:\"goadmin\";i:0;s:5:\"gomod\";i:0;s:2:\"bp\";i:0;s:2:\"ep\";i:0;s:3:\"vpb\";i:0;s:3:\"vpr\";i:0;s:3:\"apr\";i:0;s:2:\"fp\";i:0;s:3:\"dfp\";i:0;s:2:\"bf\";i:0;s:2:\"ef\";i:0;s:3:\"vfb\";i:0;s:2:\"be\";i:0;s:2:\"ee\";i:0;s:3:\"veb\";i:0;s:3:\"scs\";i:0;s:3:\"rcs\";i:0;s:3:\"ecs\";i:0;s:4:\"vmcs\";i:0;s:2:\"bt\";i:0;s:2:\"et\";i:0;s:2:\"ft\";i:0;s:2:\"dt\";i:0;s:2:\"bc\";i:0;s:2:\"oc\";i:0;s:2:\"ec\";i:0;s:3:\"acc\";i:0;s:3:\"vcb\";i:0;s:2:\"su\";i:0;s:2:\"ru\";i:0;s:4:\"ecds\";i:0;s:3:\"eas\";i:0;s:4:\"aebn\";i:0;s:3:\"ebp\";i:0;s:5:\"aebwa\";i:0;s:3:\"acp\";i:0;s:4:\"accs\";i:0;s:3:\"acf\";i:0;s:3:\"acm\";i:0;s:4:\"accm\";i:0;s:4:\"aebc\";i:0;s:3:\"aeu\";i:0;s:4:\"aebm\";i:0;s:4:\"aebr\";i:0;s:4:\"abpc\";i:0;s:4:\"abib\";i:0;s:3:\"vrd\";i:0;s:4:\"aebe\";i:0;s:2:\"as\";i:0;s:3:\"vbr\";i:0;s:2:\"pp\";i:1;s:2:\"cp\";i:0;s:4:\"sprr\";i:0;s:3:\"bpp\";i:1;s:3:\"epp\";i:1;s:2:\"pf\";i:1;s:3:\"efp\";i:1;s:3:\"bfp\";i:1;s:3:\"vpf\";i:1;s:3:\"vnf\";i:1;s:2:\"pt\";i:1;s:3:\"etp\";i:1;s:3:\"btp\";i:1;s:3:\"vpt\";i:1;s:3:\"vnt\";i:1;s:3:\"ccs\";i:1;s:4:\"ecsp\";i:1;s:4:\"bcsp\";i:1;s:2:\"pc\";i:1;s:2:\"em\";i:1;s:2:\"cm\";i:0;s:3:\"ecp\";i:1;s:3:\"bcp\";i:1;s:3:\"vpc\";i:1;s:3:\"vnc\";i:1;s:2:\"pe\";i:1;s:3:\"eep\";i:1;s:3:\"bep\";i:1;s:3:\"ppm\";i:20;s:5:\"sprrp\";i:0;s:3:\"pfm\";i:20;s:4:\"vpfm\";i:70;s:4:\"vnfm\";i:20;s:3:\"ptm\";i:20;s:4:\"vptm\";i:70;s:4:\"vntm\";i:20;s:4:\"ccsm\";i:2;s:3:\"pcm\";i:120;s:3:\"emm\";i:20;s:4:\"vpcm\";i:70;s:4:\"vncm\";i:20;s:3:\"pem\";i:20;}', 500, 14),
(6, 'Great User', 'FF0000', 'rosette_16.png', 35, 0, 'a:86:{s:7:\"goadmin\";i:0;s:5:\"gomod\";i:0;s:2:\"bp\";i:0;s:2:\"ep\";i:0;s:3:\"vpb\";i:0;s:3:\"vpr\";i:0;s:3:\"apr\";i:0;s:2:\"fp\";i:0;s:3:\"dfp\";i:0;s:2:\"bf\";i:0;s:2:\"ef\";i:0;s:3:\"vfb\";i:0;s:2:\"be\";i:0;s:2:\"ee\";i:0;s:3:\"veb\";i:0;s:3:\"scs\";i:0;s:3:\"rcs\";i:0;s:3:\"ecs\";i:0;s:4:\"vmcs\";i:0;s:2:\"bt\";i:0;s:2:\"et\";i:0;s:2:\"ft\";i:0;s:2:\"dt\";i:0;s:2:\"bc\";i:0;s:2:\"oc\";i:0;s:2:\"ec\";i:0;s:3:\"acc\";i:0;s:3:\"vcb\";i:0;s:2:\"su\";i:0;s:2:\"ru\";i:0;s:4:\"ecds\";i:0;s:4:\"aebn\";i:0;s:3:\"ebp\";i:0;s:5:\"aebli\";i:0;s:3:\"acp\";i:0;s:3:\"acf\";i:0;s:3:\"acm\";i:0;s:4:\"aebc\";i:0;s:3:\"aeu\";i:0;s:4:\"aebm\";i:0;s:4:\"aebr\";i:0;s:4:\"abpc\";i:0;s:4:\"abib\";i:0;s:2:\"as\";i:0;s:2:\"pp\";i:1;s:2:\"cp\";i:0;s:4:\"sprr\";i:0;s:3:\"bpp\";i:1;s:3:\"epp\";i:1;s:2:\"pf\";i:1;s:3:\"efp\";i:1;s:3:\"bfp\";i:1;s:3:\"vpf\";i:1;s:3:\"vnf\";i:1;s:2:\"pt\";i:1;s:3:\"etp\";i:1;s:3:\"btp\";i:1;s:3:\"vpt\";i:1;s:3:\"vnt\";i:1;s:3:\"ccs\";i:1;s:4:\"ecsp\";i:1;s:4:\"bcsp\";i:1;s:2:\"pc\";i:1;s:2:\"em\";i:1;s:2:\"cm\";i:0;s:3:\"ecp\";i:1;s:3:\"bcp\";i:1;s:3:\"vpc\";i:1;s:3:\"vnc\";i:1;s:2:\"pe\";i:1;s:3:\"eep\";i:1;s:3:\"bep\";i:1;s:3:\"ppm\";i:30;s:5:\"sprrp\";i:0;s:3:\"pfm\";i:30;s:4:\"vpfm\";i:70;s:4:\"vnfm\";i:20;s:3:\"ptm\";i:30;s:4:\"vptm\";i:70;s:4:\"vntm\";i:20;s:4:\"ccsm\";i:3;s:3:\"pcm\";i:150;s:3:\"emm\";i:30;s:4:\"vpcm\";i:70;s:4:\"vncm\";i:20;s:3:\"pem\";i:30;}', 1000, 10),
(7, 'Gold User', 'F1BD01', 'gold.png', 50, 0, 'a:92:{s:7:\"goadmin\";i:0;s:5:\"gomod\";i:0;s:2:\"bp\";i:0;s:2:\"ep\";i:0;s:3:\"vpb\";i:0;s:3:\"vpr\";i:0;s:3:\"apr\";i:0;s:2:\"fp\";i:0;s:3:\"dfp\";i:0;s:2:\"bf\";i:0;s:2:\"ef\";i:0;s:3:\"vfb\";i:0;s:2:\"be\";i:0;s:2:\"ee\";i:0;s:3:\"veb\";i:0;s:3:\"scs\";i:0;s:3:\"rcs\";i:0;s:3:\"ecs\";i:0;s:4:\"vmcs\";i:0;s:2:\"bt\";i:0;s:2:\"et\";i:0;s:2:\"ft\";i:0;s:2:\"dt\";i:0;s:2:\"bc\";i:0;s:2:\"oc\";i:0;s:2:\"ec\";i:0;s:3:\"acc\";i:0;s:3:\"vcb\";i:0;s:2:\"su\";i:0;s:2:\"ru\";i:0;s:4:\"ecds\";i:0;s:3:\"eas\";i:0;s:4:\"aebn\";i:0;s:3:\"ebp\";i:0;s:5:\"aebwa\";i:0;s:3:\"acp\";i:0;s:4:\"accs\";i:0;s:3:\"acf\";i:0;s:3:\"acm\";i:0;s:4:\"accm\";i:0;s:4:\"aebc\";i:0;s:3:\"aeu\";i:0;s:4:\"aebm\";i:0;s:4:\"aebr\";i:0;s:4:\"abpc\";i:0;s:4:\"abib\";i:0;s:3:\"vrd\";i:0;s:4:\"aebe\";i:0;s:2:\"as\";i:0;s:3:\"vbr\";i:0;s:2:\"pp\";i:1;s:2:\"cp\";i:0;s:4:\"sprr\";i:0;s:3:\"bpp\";i:1;s:3:\"epp\";i:1;s:2:\"pf\";i:1;s:3:\"efp\";i:1;s:3:\"bfp\";i:1;s:3:\"vpf\";i:1;s:3:\"vnf\";i:1;s:2:\"pt\";i:1;s:3:\"etp\";i:1;s:3:\"btp\";i:1;s:3:\"vpt\";i:1;s:3:\"vnt\";i:1;s:3:\"ccs\";i:1;s:4:\"ecsp\";i:1;s:4:\"bcsp\";i:1;s:2:\"pc\";i:1;s:2:\"em\";i:1;s:2:\"cm\";i:0;s:3:\"ecp\";i:1;s:3:\"bcp\";i:1;s:3:\"vpc\";i:1;s:3:\"vnc\";i:1;s:2:\"pe\";i:1;s:3:\"eep\";i:1;s:3:\"bep\";i:1;s:3:\"ppm\";i:50;s:5:\"sprrp\";i:3;s:3:\"pfm\";i:50;s:4:\"vpfm\";i:100;s:4:\"vnfm\";i:20;s:3:\"ptm\";i:50;s:4:\"vptm\";i:100;s:4:\"vntm\";i:20;s:4:\"ccsm\";i:5;s:3:\"pcm\";i:200;s:3:\"emm\";i:50;s:4:\"vpcm\";i:100;s:4:\"vncm\";i:20;s:3:\"pem\";i:50;}', 5000, 10),
(8, 'Legend User', '616161', 'leecher.gif', 50, 1, 'a:86:{s:7:\"goadmin\";i:0;s:5:\"gomod\";i:0;s:2:\"bp\";i:0;s:2:\"ep\";i:0;s:3:\"vpb\";i:0;s:3:\"vpr\";i:0;s:3:\"apr\";i:0;s:2:\"fp\";i:0;s:3:\"dfp\";i:0;s:2:\"bf\";i:0;s:2:\"ef\";i:0;s:3:\"vfb\";i:0;s:2:\"be\";i:0;s:2:\"ee\";i:0;s:3:\"veb\";i:0;s:3:\"scs\";i:0;s:3:\"rcs\";i:0;s:3:\"ecs\";i:0;s:4:\"vmcs\";i:0;s:2:\"bt\";i:0;s:2:\"et\";i:0;s:2:\"ft\";i:0;s:2:\"dt\";i:0;s:2:\"bc\";i:0;s:2:\"oc\";i:0;s:2:\"ec\";i:0;s:3:\"acc\";i:0;s:3:\"vcb\";i:0;s:2:\"su\";i:0;s:2:\"ru\";i:0;s:4:\"ecds\";i:0;s:4:\"aebn\";i:0;s:3:\"ebp\";i:0;s:5:\"aebli\";i:0;s:3:\"acp\";i:0;s:3:\"acf\";i:0;s:3:\"acm\";i:0;s:4:\"aebc\";i:0;s:3:\"aeu\";i:0;s:4:\"aebm\";i:0;s:4:\"aebr\";i:0;s:4:\"abpc\";i:0;s:4:\"abib\";i:0;s:2:\"as\";i:0;s:2:\"pp\";i:1;s:2:\"cp\";i:0;s:4:\"sprr\";i:0;s:3:\"bpp\";i:1;s:3:\"epp\";i:1;s:2:\"pf\";i:1;s:3:\"efp\";i:1;s:3:\"bfp\";i:1;s:3:\"vpf\";i:1;s:3:\"vnf\";i:1;s:2:\"pt\";i:1;s:3:\"etp\";i:1;s:3:\"btp\";i:1;s:3:\"vpt\";i:1;s:3:\"vnt\";i:1;s:3:\"ccs\";i:1;s:4:\"ecsp\";i:1;s:4:\"bcsp\";i:1;s:2:\"pc\";i:1;s:2:\"em\";i:1;s:2:\"cm\";i:0;s:3:\"ecp\";i:1;s:3:\"bcp\";i:1;s:3:\"vpc\";i:1;s:3:\"vnc\";i:1;s:2:\"pe\";i:1;s:3:\"eep\";i:1;s:3:\"bep\";i:1;s:3:\"ppm\";i:50;s:5:\"sprrp\";i:3;s:3:\"pfm\";i:50;s:4:\"vpfm\";i:100;s:4:\"vnfm\";i:15;s:3:\"ptm\";i:50;s:4:\"vptm\";i:100;s:4:\"vntm\";i:15;s:4:\"ccsm\";i:5;s:3:\"pcm\";i:210;s:3:\"emm\";i:40;s:4:\"vpcm\";i:100;s:4:\"vncm\";i:15;s:3:\"pem\";i:40;}', 0, 5),
(9, 'Uploader', '00D10A', 'silver2.gif', 35, 1, 'a:86:{s:7:\"goadmin\";i:0;s:5:\"gomod\";i:0;s:2:\"bp\";i:0;s:2:\"ep\";i:0;s:3:\"vpb\";i:0;s:3:\"vpr\";i:0;s:3:\"apr\";i:0;s:2:\"fp\";i:0;s:3:\"dfp\";i:0;s:2:\"bf\";i:0;s:2:\"ef\";i:0;s:3:\"vfb\";i:0;s:2:\"be\";i:0;s:2:\"ee\";i:0;s:3:\"veb\";i:0;s:3:\"scs\";i:0;s:3:\"rcs\";i:0;s:3:\"ecs\";i:0;s:4:\"vmcs\";i:0;s:2:\"bt\";i:0;s:2:\"et\";i:0;s:2:\"ft\";i:0;s:2:\"dt\";i:0;s:2:\"bc\";i:0;s:2:\"oc\";i:0;s:2:\"ec\";i:0;s:3:\"acc\";i:0;s:3:\"vcb\";i:0;s:2:\"su\";i:0;s:2:\"ru\";i:0;s:4:\"ecds\";i:0;s:4:\"aebn\";i:0;s:3:\"ebp\";i:0;s:5:\"aebli\";i:0;s:3:\"acp\";i:0;s:3:\"acf\";i:0;s:3:\"acm\";i:0;s:4:\"aebc\";i:0;s:3:\"aeu\";i:0;s:4:\"aebm\";i:0;s:4:\"aebr\";i:0;s:4:\"abpc\";i:0;s:4:\"abib\";i:0;s:2:\"as\";i:0;s:2:\"pp\";i:1;s:2:\"cp\";i:0;s:4:\"sprr\";i:0;s:3:\"bpp\";i:1;s:3:\"epp\";i:1;s:2:\"pf\";i:1;s:3:\"efp\";i:1;s:3:\"bfp\";i:1;s:3:\"vpf\";i:1;s:3:\"vnf\";i:1;s:2:\"pt\";i:1;s:3:\"etp\";i:1;s:3:\"btp\";i:1;s:3:\"vpt\";i:1;s:3:\"vnt\";i:1;s:3:\"ccs\";i:1;s:4:\"ecsp\";i:1;s:4:\"bcsp\";i:1;s:2:\"pc\";i:1;s:2:\"em\";i:1;s:2:\"cm\";i:0;s:3:\"ecp\";i:1;s:3:\"bcp\";i:1;s:3:\"vpc\";i:1;s:3:\"vnc\";i:1;s:2:\"pe\";i:1;s:3:\"eep\";i:1;s:3:\"bep\";i:1;s:3:\"ppm\";i:100;s:5:\"sprrp\";i:0;s:3:\"pfm\";i:50;s:4:\"vpfm\";i:70;s:4:\"vnfm\";i:10;s:3:\"ptm\";i:100;s:4:\"vptm\";i:70;s:4:\"vntm\";i:10;s:4:\"ccsm\";i:4;s:3:\"pcm\";i:150;s:3:\"emm\";i:50;s:4:\"vpcm\";i:70;s:4:\"vncm\";i:10;s:3:\"pem\";i:40;}', 0, 8);";

$SM_DB[] = "CREATE TABLE IF NOT EXISTS `users_stats` (
  `u_id` int(15) NOT NULL,
  `u_posts` int(15) DEFAULT '0',
  `u_comments` int(15) DEFAULT '0',
  `u_topics` int(15) DEFAULT '0',
  `u_replies` int(15) DEFAULT '0',
  `u_states` int(15) DEFAULT '0',
  `u_states_comments` int(15) DEFAULT '0',
  `u_flood_post` int(15) DEFAULT '0',
  `u_flood_comment` int(15) DEFAULT '0',
  `u_flood_comu` int(15) DEFAULT '0',
  `u_flood_state` int(15) DEFAULT '0',
  `u_follows` int(15) DEFAULT '0',
  `u_following` int(15) DEFAULT '0',
  `u_points` int(15) DEFAULT '0',
  `u_flood_follow` int(15) DEFAULT '0',
  `u_images` int(15) DEFAULT '0',
  `u_flood_image` int(15) DEFAULT '0',
  `u_flood_topics` int(15) DEFAULT NULL,
  `u_flood_mp` int(15) DEFAULT '0',
  `u_update_medals` int(15) DEFAULT '0',
  PRIMARY KEY (`u_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

$SM_DB[] = "CREATE TABLE IF NOT EXISTS `votes` (
  `v_id` int(15) NOT NULL AUTO_INCREMENT,
  `v_user` int(15) NOT NULL,
  `v_type` int(2) NOT NULL,
  `v_type_id` int(15) NOT NULL,
  `v_val` varchar(2) DEFAULT NULL,
  `v_date` int(12) NOT NULL,
  `v_ip` varchar(20) NOT NULL,
  PRIMARY KEY (`v_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

$SM_DB[] = "CREATE TABLE IF NOT EXISTS `web_settings` (
  `w_type` varchar(3) NOT NULL,
  `title` varchar(40) DEFAULT 'SfeScript',
  `slogan` varchar(40) DEFAULT 'Independiente Santa Fe',
  `url` varchar(40) DEFAULT NULL,
  `theme` VARCHAR(100) NOT NULL DEFAULT 'smline',
  `offline` int(1) DEFAULT '0',
  `offline_message` varchar(300) DEFAULT NULL,
  `live` int(1) DEFAULT '1',
  `live_timeout` int(2) DEFAULT '15',
  `chat` int(1) DEFAULT '1',
  `welcome` int(1) DEFAULT '0',
  `welcome_message` varchar(300) DEFAULT NULL,
  `user_online` int(2) DEFAULT '10',
  `user_robot` int(12) DEFAULT '1',
  `ads_300` varchar(3000) DEFAULT NULL,
  `ads_468` varchar(3000) DEFAULT NULL,
  `ads_160` varchar(3000) DEFAULT NULL,
  `ads_728` varchar(3000) DEFAULT NULL,
  `reg_active` int(1) DEFAULT '1',
  `active_user` int(1) DEFAULT '1',
  `default_rank` int(3) DEFAULT '4',
  `min_age` int(2) DEFAULT '12',
  `max_posts` int(2) DEFAULT '50',
  `max_comm` int(2) DEFAULT '50',
  `recover_active` int(1) DEFAULT '1',
  `box_title` varchar(6) DEFAULT '0066CC',
  `links_color` varchar(6) DEFAULT '006AD5',
  `header_back` varchar(20) DEFAULT 'fire-blue.png',
  `box_title_text` varchar(6) DEFAULT 'FFFFFF',
  `box_title_shadow` varchar(6) DEFAULT '333333',
  `h_logo` varchar(20) DEFAULT NULL,
  `descripcion` varchar(300) DEFAULT 'SMline es un sitio donde encontrar&aacute;s todo tipo de contenidos de tu interes, adem&aacute;s podr&aacute;s compartir tus ideas y ser alguien reconocido en la web',
  `tags` varchar(300) DEFAULT 'M&uacute;sica, pel&iacute;culas, v&iacute;deos, juegos, download, mega, descarga directa, mediafire, descargas',
  `ads_script` varchar(1000) DEFAULT NULL,
  `port_posts` int(1) DEFAULT '0',
  `points_update` int(3) DEFAULT '24',
  `smline_version` varchar(30) DEFAULT '1.1.2 Prime',
  PRIMARY KEY (`w_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

$SM_DB[] = "INSERT INTO `web_settings` (`w_type`, `title`, `slogan`, `url`, `offline`, `offline_message`, `live`, `live_timeout`, `chat`, `welcome`, `welcome_message`, `user_online`, `user_robot`, `ads_300`, `ads_468`, `ads_160`, `ads_728`, `reg_active`, `active_user`, `default_rank`, `min_age`, `max_posts`, `max_comm`, `recover_active`, `box_title`, `links_color`, `header_back`, `box_title_text`, `box_title_shadow`, `h_logo`, `descripcion`, `tags`, `ads_script`, `port_posts`, `points_update`, `smline_version`) VALUES
('GLO', 'SMtitle', 'SMslogan', '', 0, 'Sitio temporalmente en mantenimiento, por favor tenga paciencia e intente ingresar de nuevo en unas horas.', 1, 5, 1, 0, 'Hola [nick], bienvenid[f_o_m] a [web], espero que te sientas c&oacute;mod[f_o_m] en esta gran comunidad.', 10, 1, '<div style=\"width:314px;height:244px;border: 3px dashed #CCC;position: relative;background: rgba(152, 205, 255, 0.15);\">\n  <span style=\"position: absolute;left: 0px;top: 42%;width: 100%;text-align: center;font-size: 20px;color: #8697AD;font-weight:normal\">Tu publicidad 300x250 aqu&iacute;</span>\n<a id=\"SmartecEffect\" href=\"http://smline.net\" target=\"_blank\" style=\"font-family: courier new;font-size: 12px;color: #7997D6; position: absolute;bottom: 0;right: 3px;\">by SMLine</a>\n</div>', '<div style=\"width:462px;height:54px;border: 3px dashed #CCC;position: relative;background: rgba(152, 205, 255, 0.15);\">\n  <span style=\"position: absolute;left: 0px;top: 42%;width: 100%;text-align: center;font-size: 20px;color: #8697AD;font-weight:normal\">Tu publicidad 468x60 aqu&iacute;</span>\n<a id=\"SmartecEffect\" href=\"http://smline.net\" target=\"_blank\" style=\"font-family: courier new;font-size: 12px;color: #7997D6; position: absolute;bottom: 0;right: 3px;\">by SMLine</a>\n</div>', '<div style=\"width:154px;height:594px;border: 3px dashed #CCC;position: relative;background: rgba(152, 205, 255, 0.15);\">\n  <span style=\"position: absolute;left: 0px;top: 42%;width: 150px;font-size: 20px;color: #8697AD;font-weight:normal\">Tu publicidad 160x600 aqu&iacute;</span>\n<a id=\"SmartecEffect\" href=\"http://smline.net\" target=\"_blank\" style=\"font-family: courier new;font-size: 12px;color: #7997D6; position: absolute;bottom: 0;right: 3px;\">by SMLine</a>\n</div>', '<div style=\"width:722px;height:84px;border: 3px dashed #CCC;position: relative;background: rgba(152, 205, 255, 0.15);\">\n  <span style=\"position: absolute;left: 0px;top: 42%;width: 100%;text-align: center;font-size: 20px;color: #8697AD;font-weight:normal\">Tu publicidad 728x90 aqu&iacute;</span>\n<a id=\"SmartecEffect\" href=\"http://smline.net\" target=\"_blank\" style=\"font-family: courier new;font-size: 12px;color: #7997D6; position: absolute;bottom: 0;right: 3px;\">by SMLine</a>\n</div>', 1, 0, 4, 12, 40, 20, 1, '0066CC', '006AD5', 'fire-blue.png', 'FFFFFF', '333333', NULL, 'SMsite es un sitio donde encontrar&aacute;s todo tipo de contenidos de tu interes, adem&aacute;s podr&aacute;s compartir tus ideas y ser alguien reconocido en la web', 'M&uacute;sica,pel&iacute;culas,v&iacute;deos,juegos,download,mega,descarga,directa,mediafire,descargas', '', 0, 24, '1.1.2 Prime');";

$SM_DB[] = "CREATE TABLE IF NOT EXISTS `web_stats` (
  `w_type` varchar(3) NOT NULL,
  `members` int(15) DEFAULT '0',
  `posts` int(15) DEFAULT '0',
  `comments` int(15) DEFAULT '0',
  `comus` int(15) DEFAULT '0',
  `topics` int(15) DEFAULT '0',
  `replies` int(15) DEFAULT '0',
  `states` int(15) DEFAULT '0',
  `states_comments` int(15) DEFAULT '0',
  `images` int(15) DEFAULT '0',
  `images_comments` int(15) DEFAULT '0',
  PRIMARY KEY (`w_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

$SM_DB[] = "INSERT INTO `web_stats` (`w_type`, `members`, `posts`, `comments`, `comus`, `topics`, `replies`, `states`, `states_comments`, `images`, `images_comments`) VALUES
('GLO', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);";

$SM_DB[] = "CREATE TABLE IF NOT EXISTS  `admin_themes` (
 `t_id` INT( 10 ) NOT NULL AUTO_INCREMENT ,
 `t_name` VARCHAR( 100 ) NOT NULL ,
 `t_seo` VARCHAR( 100 ) NOT NULL ,
 `t_author` VARCHAR( 100 ) NOT NULL ,
 `t_author_link` VARCHAR( 300 ) NOT NULL ,
 `t_install` int( 12 ) NOT NULL ,
PRIMARY KEY (  `t_id` )
) ENGINE = MYISAM DEFAULT CHARSET = utf8 AUTO_INCREMENT =2;";

$SM_DB[] = "INSERT INTO  `admin_themes` (  `t_id` ,  `t_name` ,  `t_seo` ,  `t_author` ,  `t_author_link` ,  `t_install` ) 
VALUES ( 1,  'SMline Default',  'smline',  'David077',  'https://www.facebook.com/cristian.anzola.35', '".time()."');";

?>