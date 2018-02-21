<?php
$url = 'http://'.$_SERVER['HTTP_HOST'].'/car_detail.php';
$sql = sprintf("SELECT * FROM carinfo AS info WHERE info.ci_published=3");
$result = $mysqli->query($sql);
?>