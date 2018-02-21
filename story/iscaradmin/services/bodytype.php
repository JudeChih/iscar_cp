<?php
/**
 * Created by PhpStorm.
 * User: Jason
 * Date: 2016/12/22
 * Time: 13:42
 */
$key = g('search');
$reg = g('reg');
if(!empty($key)){
    if(!empty($reg)){
        $result = $pdo->query("SELECT cbt_fullname,cbt_id FROM carbodytypes WHERE cbt_fullname LIKE '%$key%' AND cbt_published>1 AND cbt_region={$reg}");
    }else {
        $result = $pdo->query("SELECT cbt_fullname,cbt_id FROM carbodytypes WHERE cbt_fullname LIKE '%$key%' AND cbt_published>1 AND cbt_region=3");
    }
    $res['data'] = $result;
}else{
    if(!empty($reg)){
        $terms_bdt = $pdo->query("SELECT cbt_fullname,cbt_id FROM carbodytypes WHERE cbt_published>1 AND cbt_region={$reg}");
    }else {
        $terms_bdt = $pdo->query("SELECT cbt_fullname,cbt_id FROM carbodytypes WHERE cbt_published>1 AND cbt_region=3");
    }
    $res['data'] = $terms_bdt;
}
echo json_encode($res);