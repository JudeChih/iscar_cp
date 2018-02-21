<?php
/**
 * Created by PhpStorm.
 * User: Jason
 * Date: 2016/12/22
 * Time: 9:55
 */
$key = g('search');
$reg = g('reg');
if(!empty($key)){
    if(!empty($reg)){
        $result = $pdo->query("SELECT value,keyword FROM carterms WHERE term='产地' AND value LIKE '%$key%' AND ct_region={$reg}");
    }else {
        $result = $pdo->query("SELECT value,keyword FROM carterms WHERE term='产地' AND value LIKE '%$key%' AND ct_region=3");
    }
    $res['data'] = $result;
}else{
    $terms_ca = getTerms("产地", $reg);
    $res['data'] = $terms_ca;
}
echo json_encode($res);