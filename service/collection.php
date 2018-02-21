<?php

$car_id=g('car_id');
$sql="SELECT COUNT(*) AS line from myfavorite WHERE uid='$u_id' AND oid=$car_id AND status = 1";
$line = $pdo->query($sql);

if($line[0][line]==1){
    $com_sql="UPDATE myfavorite SET status = 0 WHERE uid='$u_id' AND oid=$car_id";
    $data = $pdo->execute($com_sql);
    print_r('取消成功');
    setLog($u_name,0,$sid,5,'取消收藏 汽车ID='.$car_id);
}else{
    $com_sql="INSERT INTO myfavorite(
	oid ,
	uid ,
	create_date
)
VALUES
	(
	$car_id,
	'$u_id',
      NOW()
	)";
    $data = $pdo->execute($com_sql);
    setLog($u_name,0,$sid,5,'添加收藏 汽车ID='.$car_id);
    print_r('收藏成功');
}