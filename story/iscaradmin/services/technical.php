<?php
/**
 * Created by PhpStorm.
 * User: Jason
 * Date: 2016/12/22
 * Time: 10:13
 */
$key = g('search');
$reg = g('reg');
if(!empty($key)){
    if(!empty($reg)){
        $result = $pdo->query("SELECT value,keyword FROM carterms WHERE term='技术合作' AND value LIKE '%$key%' AND ct_region={$reg}");
    }else {
        $result = $pdo->query("SELECT value,keyword FROM carterms WHERE term='技术合作' AND value LIKE '%$key%' AND ct_region=3");
    }
    $res['data'] = $result;
}else{
    $terms_tec = getTerms("技术合作", $reg);
    $res['data'] = $terms_tec;
}
echo json_encode($res);