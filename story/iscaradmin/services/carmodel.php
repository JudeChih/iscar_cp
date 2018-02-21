<?php
/**
 * Created by PhpStorm.
 * User: Jason
 * Date: 2016/12/23
 * Time: 17:26
 */
$key = g('search');
$cb_id = g('cb_id');
$reg = g('reg');
if(!empty($key)){
    if(!empty($reg)){
        $result = $pdo->query("SELECT cm_fullname,cm_id FROM carmodels WHERE cm_fullname LIKE '%$key%' AND cm_published>1 AND cm_region={$reg}");
    }else {
        $result = $pdo->query("SELECT cm_fullname,cm_id FROM carmodels WHERE cm_fullname LIKE '%$key%' AND cm_published>1 AND cm_region=3");
    }
    $res['data'] = $result;
}else{
    if(!empty($reg)){
        $terms_cm = $pdo->query("SELECT cm_fullname,cm_id FROM carmodels WHERE cb_id={$cb_id} AND cm_published>1 AND cm_region={$reg}");
    }else {
        $terms_cm = $pdo->query("SELECT cm_fullname,cm_id FROM carmodels WHERE cb_id={$cb_id} AND cm_published>1 AND cm_region=3");
    }
    $res['data'] = $terms_cm;
}
echo json_encode($res);