<?php
header("Content-Type: application/xml; charset=utf-8");
echo '<?xml-stylesheet type="text/xsl" href="/xml-sitemap.php"?>';

require('includes/jw-config.php');

$mysqli = new mysqli($JWDB_HOST, $JWDB_USER,$JWDB_PASSWORD,$JWDB_NAME);
// $mysqli = new mysqli('localhost','tales');
if(mysqli_connect_errno()) {
    echo mysqli_connect_errer();
}
$mysqli->query("SET NAMES utf8");
//
if(! isset($_SESSION)) {
    session_start();
}
$url = 'http://'.$_SERVER['HTTP_HOST'].'/car_detail.php';
$sql = sprintf("SELECT * FROM carinfo AS info WHERE info.ci_published=3");
$result = $mysqli->query($sql);

?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php while($row=$result->fetch_assoc()): ?>
<url>
    <loc><?= $url.'?car_id='.$row['ci_id'] ?></loc>
    <?php date_default_timezone_set("Asia/Taipei"); ?>
    <?php $dateTime = new DateTime($row['ci_last_update_date']); ?>
    <lastmod><?= $dateTime->format("Y-m-d\TH:i:sP") ?></lastmod>
    <changefreq>daily</changefreq>
    <priority>0.6</priority>
</url>
<?php endwhile; ?>
</urlset>
<!-- <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

<url>
    <loc></loc>
    <lastmod></lastmod>
    <changefreq>daily</changefreq>
    <priority>0.6</priority>
</url>

</urlset> -->