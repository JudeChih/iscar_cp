<?php

$type=g('type');
$car_id=g('com_id');
$content=g('content');
date_default_timezone_set("Asia/Shanghai");
$time=date("Y-m-d H:i:s");
if($type=='car'){
    $tt='汽车';
    $car_val="(SELECT ca_main_id FROM carinfo WHERE ci_id = $car_id )";
}else{
    $tt='文章';
    $car_val="$car_id";
}
$sql="INSERT INTO jw_comments(
	user_id ,
	comment_content ,
	comment_post_ID ,
	comment_date,
	comment_date_gmt
)
VALUES
	(
    '$u_id',
    '$content' ,
	$car_val,
    '$time',
    '$time'
	)";

$data = $pdo->execute($sql);
setLog($u_name,0,$sid,6,'评论、'.$tt.$car_id);
print_r('评论成功');

