<?php
header("Content-Type: text/xml");
echo '<?xml version="1.0" encoding="UTF-8"?>';
$sistemapx = true;
require('SM_start.php');
$query_posts = $mysqli->query('SELECT c.c_seo, p.p_id, p.p_title FROM posts AS p LEFT JOIN posts_cats AS c ON p.p_cat = c.c_id WHERE p.p_status = \'1\' ORDER BY p.p_id DESC');
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php
while($row = $query_posts->fetch_assoc()){
?>
<url>
  <loc><?=$web['url']?>/posts/<?=$row['c_seo']?>/<?=$row['p_id']?>/<?=seo($row['p_title'])?>.html</loc>
  <changefreq>daily</changefreq>
</url>
<?php
}
?>
</urlset>