<?php
/**
 * Created by PhpStorm.
 * User: Jason
 * Date: 2016/12/23
 * Time: 16:49
 */
$key = g('search');
$reg = g('reg');
if(!empty($key)){
    if(!empty($reg)){
        $result = $pdo->query("SELECT cb_fullname,cb_id FROM carbrands WHERE cb_fullname LIKE '%$key%' AND cb_published>1 AND cb_region={$reg}");
    }else {
        $result = $pdo->query("SELECT cb_fullname,cb_id FROM carbrands WHERE cb_fullname LIKE '%$key%' AND cb_published>1 AND cb_region=3");
    }
    $res['data'] = $result;
}else{
    if(!empty($reg)){
        $terms_cb = $pdo->query("SELECT cb_fullname,cb_id FROM carbrands WHERE cb_published>1 AND cb_region={$reg}");
    }else {
        $terms_cb = $pdo->query("SELECT cb_fullname,cb_id FROM carbrands WHERE cb_published>1 AND cb_region=3");
    }
    $res['data'] = $terms_cb;
}
echo json_encode($res);