<?php

$car_id=explode(',',substr(g('car_id'),1,strlen(g('car_id'))-2));
foreach ($car_id as $c){
    $com_sql="UPDATE myfavorite SET status = 0 WHERE uid='$u_id' AND oid=$c";
    $data = $pdo->execute($com_sql);
    setLog($u_name,0,$sid,5,'取消收藏 汽车ID='.$c);
}
echo ('1');
